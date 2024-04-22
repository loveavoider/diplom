<?php

namespace App\User\Controller;

use App\User\Entity\User;
use App\User\Repository\UserRepository;
use App\Util\ControllerUtil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    public function __construct(
        private readonly ControllerUtil $serializer,
        private readonly UserRepository $repo,
        private readonly UserPasswordHasherInterface $hasher,
        private readonly Security $security
    ){}

    public function getMe(): Response {
        $user = $this->security->getUser();

        return new Response($this->serializer->serializeResponse($user));
    }

    public function getList(): Response {
        $user = $this->security->getUser();

//        $this->repo->
        return new Response(123);
    }

    public function logUp(Request $request): Response {
        $entity = $this->serializer->derializeRequest(User::class, $request);

        $password = $entity->getPassword();
        if (empty($password)) {
            return new Response($this->serializer->serializeResponse(['error' => 'не указан пароль']), 400);
        }

        $hashedPass = $this->hasher->hashPassword($entity, $password);
        $entity->setPassword($hashedPass);

        $id = $this->repo->add($entity);

        return new Response($this->serializer->serializeResponse(['id' => $id]), 201);
    }

//    public function updateTask(Request $request, int $id): Response {
//        $dto = $this->serializer->derializeRequest(UpdateTask::class, $request);
//
//        $this->repo->update($dto, $id);
//
//        return new Response();
//    }
}