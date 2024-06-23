<?php

namespace App\Task\Controller;

use App\Document\Entity\Document;
use App\Document\Factory\DocumentFactory;
use App\Document\Repository\DocumentRepository;
use App\Integration\Controller\IntegrationController;
use App\Task\dto\CreateTaskDto;
use App\Task\dto\UpdateTask;
use App\Task\Entity\Task;
use App\Task\Repository\TaskRepository;
use App\User\Entity\User;
use App\Util\ControllerUtil;
use PhpOffice\PhpWord\TemplateProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TaskController extends AbstractController
{
    public function __construct(
        private readonly ControllerUtil $serializer,
        private readonly TaskRepository $repo,
        private readonly Security $security,
        private readonly KernelInterface $appKernel,
        private readonly Filesystem $filesystem,
        private readonly HttpClientInterface $client,
        private readonly DocumentRepository $documentRepository,
        private readonly DocumentFactory $documentFactory
    ){}

    const TYPES = [
        '1' => 'Исполнение',
        '2' => 'Участие',
        '3' => 'БГОГ',
        '4' => 'Возврат аванса',
    ];

    public function getTask(int $id): Response {
        $entity = $this->repo->getTask($id);

        $user = $this->security->getUser();

        if ($user->getRole() === User::ROLE_USER && $user->getId() !== $entity->getOwner()) {
            return new Response($this->serializer->serializeResponse('У вас нет доступа'), 401);
        }

        return new Response($this->serializer->serializeResponse($entity));
    }

    public function createTask(Request $request): Response {
        $dto = $this->serializer->derializeRequest(CreateTaskDto::class, $request);
        $user = $this->security->getUser();

        if (!isset($dto->owner)) {
            $dto->owner = $user->getId();
        }

        $successScore = true;

        if (!$this->scoring($dto->auc, $dto->sum_bg)) {
            $successScore = false;
//            return new Response(204);
        }

        $hasPrepaid = $dto->has_prepaid === '1';
        $multiLot = $dto->multi_lot === '2';

        $task = $this->repo->add(new Task(
            $dto->title, $dto->owner, $dto->inn, $dto->auc, $hasPrepaid, $multiLot, $dto->sum_bg,
            $dto->sum_deal, $dto->type, $successScore ? 2 : 1
        ));

        $id = $task->getId();

        if ($successScore) {
            $this->createFile($dto, $id, true);
        }

        return new Response($this->serializer->serializeResponse(['id' => $id, 'score' => $successScore]), 201);
    }

    public function updateTask(Request $request, int $id): Response {
        $dto = $this->serializer->derializeRequest(UpdateTask::class, $request);

        if (!$this->scoring($dto->auc, $dto->sum_bg)) {
            return new Response('',204);
        }

        $this->createFile($dto, $id, true);

        $this->repo->update($dto, $id, 2);

        $entity = $this->repo->getTask($id);

        $this->createFile($entity, $id);

        return new Response();
    }

    public function deleteTask(int $id): Response {
        $this->repo->delete($id);
        return new Response('', 204);
    }

    public function getList(): Response {
        $data = $this->repo->getList($this->security->getUser());

        return new Response($this->serializer->serializeResponse($data));
    }

    private function scoring($auc, $price) {
        $data = $this->kostyl1($auc);

        $res = intval($price) * 0.5 - intval($data['max_price']);

        return $res < 0;
    }

    public function makeBg($id): Response {

        $user = $this->security->getUser();

        if ($user->getRole() !== User::ROLE_BANK) {
            return new Response('У вас нет доступа', 401);
        }

        $dto = $this->repo->getTask($id);

        $templateProcessor = new TemplateProcessor(__DIR__ . '/bg_template.docx');
        $templateProcessor->setValue('date', date('d.m.Y'));
        $templateProcessor->setValue('endDate', date('d.m.Y', strtotime('+2 month')));
        $templateProcessor->setValue('id', $id);

        $numAuction = $dto->getAuc();

        $templateProcessor->setValue('zakupNumber', $numAuction);
        $templateProcessor->setValue('sum', $dto->getSumBg());

        // p - dadata (kos)
        $principalData = $this->kostyl($dto->getInn())['suggestions'][0]['data'];

        $templateProcessor->setValue('nameP', $principalData['name']['full_with_opf']);
        $templateProcessor->setValue('innP', $principalData['inn']);
        $templateProcessor->setValue('kppP', $principalData['kpp']);
        $templateProcessor->setValue('oktP', $principalData['oktmo']);
        $templateProcessor->setValue('addresP', $principalData['address']['value']);

        // b - zakup (kos1)
        $zakupData = $this->kostyl1($numAuction);

        $beneficiarInfo = $zakupData['responsible_org'];

        $templateProcessor->setValue('zakupName', $zakupData['purchase_object_info']);
        $templateProcessor->setValue('nameB', $beneficiarInfo['full_name']);
        $templateProcessor->setValue('innB', $beneficiarInfo['inn']);
        $templateProcessor->setValue('kppB', $beneficiarInfo['kpp']);
        $templateProcessor->setValue('oktB', $beneficiarInfo['reg_num']);
        $templateProcessor->setValue('addresB', $beneficiarInfo['post_address']);

        $this->filesystem->mkdir($this->appKernel->getProjectDir() . "/public/bg_files/$id");

        $pathToSave = $this->appKernel->getProjectDir() . "/public/bg_files/$id/bg.docx";

        $templateProcessor->saveAs($pathToSave);

        $updateTaskDto = new UpdateTask();
        $this->repo->update($updateTaskDto, $id, 3);

        $this->checkAndWriteDoc(
            $id, 'bg_files',
            'bg.docx', Document::DOCUMENT_TYPE_BG
        );

        return new Response('', 200);
    }

    public function dropApp(int $id): Response {
        $user = $this->security->getUser();

        if ($user->getRole() !== User::ROLE_BANK) {
            return new Response('У вас нет доступа', 401);
        }

        $updateTaskDto = new UpdateTask();
        $this->repo->update($updateTaskDto, $id, 4);

        return new Response('', 200);
    }

    private function checkAndWriteDoc(int $taskId, string $folder, string $name, int $type) {
        $doc = $this->documentRepository->getByType($taskId, $type);

        if (!$doc) {
            $doc = $this->documentFactory->document($type, $taskId,
                "/$folder/$taskId/$name");
            $this->documentRepository->add($doc);
        }
    }

    private function createFile($dto, $id, $db = false) {
        $templateProcessor = new TemplateProcessor(__DIR__ . '/reshenie_template.docx');
        $templateProcessor->setValue('name', $dto->getTitle());
        $templateProcessor->setValue('price', $dto->getSumBg());
        $templateProcessor->setValue('inn', $dto->getInn());
        $templateProcessor->setValue('type', self::TYPES[$dto->getType()]);
        $templateProcessor->setValue('date', date('d.m.Y'));
        $templateProcessor->setValue('id', $id);

        // данные о директоре
        $dirData = $this->kostyl($dto->getInn())['suggestions'][0]['data'];
        $pos = $dirData['management']['post'];
        $fio = $dirData['management']['name'];

        $templateProcessor->setValue('position', $pos);
        $templateProcessor->setValue('fio', $fio);

        $this->filesystem->mkdir($this->appKernel->getProjectDir() . "/public/files/$id");

        $pathToSave = $this->appKernel->getProjectDir() . "/public/files/$id/reshenie.docx";

        $templateProcessor->saveAs($pathToSave);

        if ($db) {
            $this->checkAndWriteDoc(
                $id, 'files',
                'reshenie.docx', Document::DOCUMENT_TYPE_DECISION
            );
        }
    }

    private function kostyl($inn) {
        $response = $this->client->request(
            'POST',
            'http://suggestions.dadata.ru/suggestions/api/4_1/rs/findById/party',
            [
                'body' => json_encode(['query' => $inn]),
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Token bbcdca16d6aec398e5ef99ccde8b5f153f2654b1'
                ],
            ]
        );

        return json_decode($response->getContent(), true);
    }

    private function kostyl1($number) {
        $response = $this->client->request(
            'GET',
            'https://fz44.gosplan.info/api/v1/purchases/' . $number,
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer ' . IntegrationController::AUC_JWT
                ]
            ]
        );

        return json_decode($response->getContent(), true);
    }
}