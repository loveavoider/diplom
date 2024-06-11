<?php

namespace App\Document\Controller;

use App\Document\Repository\DocumentRepository;
use App\User\Entity\User;
use App\Util\ControllerUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DocumentController extends AbstractController
{
    public function __construct(
        private readonly DocumentRepository $repo,
        private readonly ControllerUtil $serializer
    ) {}

    public function getDoc(int $task): Response {
        $entity = $this->repo->get($task);

        return new Response($this->serializer->serializeResponse($entity));
    }
}