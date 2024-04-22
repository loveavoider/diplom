<?php

namespace App\User\Repository;

use App\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserRepository implements UserLoaderInterface
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ){}

    public function loadUserByIdentifier(string $identifier): ?UserInterface
    {
        return $this->entityManager->getRepository(User::class)->findOneBy(['login' => $identifier]);
    }

    public function add(User $user): int {
        $this->entityManager->persist($user);

        $this->entityManager->flush();

        return $user->getId();
    }

    public function getUser($id): User {
        return $this->entityManager->getRepository(User::class)->find($id);
    }
}