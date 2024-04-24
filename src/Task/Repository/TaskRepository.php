<?php

namespace App\Task\Repository;

use App\Task\dto\UpdateTask;
use App\Task\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

class TaskRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ){}

    public function add(Task $task): int
    {
        $this->entityManager->persist($task);

        $this->entityManager->flush();

        return $task->getId();
    }

    public function update(UpdateTask $task, $id): void
    {
        $t = $this->entityManager->getRepository(Task::class)->find($id);

        $title = $task->title ?? null;
        $status = $task->status ?? null;
        $owner = $task->owner ?? null;

        if ($title !== null) {
            $t->setTitle($title);
        }

        if ($status !== null) {
            $t->setStatus($status);
        }

        if ($owner !== null) {
            $t->setOwner($owner);
        }

        $this->entityManager->flush();
    }

    public function delete(int $id): void
    {
        $task = $this->entityManager->getRepository(Task::class)->find($id);
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function getTask(int $id): Task {
        return $this->entityManager->getRepository(Task::class)->find($id);
    }

    public function getList(int $userId): array {
        return $this->entityManager->getRepository(Task::class)->findBy(['owner' => intval($userId)]);
    }
}