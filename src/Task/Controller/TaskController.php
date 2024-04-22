<?php

namespace App\Task\Controller;


use App\Task\dto\CreateTaskDto;
use App\Task\dto\UpdateTask;
use App\Task\Entity\Task;
use App\Task\Repository\TaskRepository;
use App\Util\ControllerUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    public function __construct(
        private readonly ControllerUtil $serializer,
        private readonly TaskRepository $repo,
        private readonly Security $security
    ){}

    public function getTask(int $id): Response {
        $entity = $this->repo->getTask($id);
        return new Response($this->serializer->serializeResponse($entity));
    }

    public function createTask(Request $request): Response {
        $dto = $this->serializer->derializeRequest(CreateTaskDto::class, $request);
        $user = $this->security->getUser();

        if (!isset($dto->owner)) {
            $dto->owner = $user->getId();
        }

        $id = $this->repo->add(new Task($dto->title, $dto->owner));

        return new Response($this->serializer->serializeResponse(['id' => $id]), 201);
    }

    public function updateTask(Request $request, int $id): Response {
        $dto = $this->serializer->derializeRequest(UpdateTask::class, $request);

        $this->repo->update($dto, $id);

        return new Response();
    }

    public function deleteTask(int $id): Response {
        $this->repo->delete($id);
        return new Response('', 204);
    }

    public function getList(): Response {
        $user = $this->security->getUser();
        $data = $this->repo->getList($user->getId());

        return new Response($this->serializer->serializeResponse($data));
    }

    public function draw(): Response {
        return $this->render('@build/index.html');
    }
}