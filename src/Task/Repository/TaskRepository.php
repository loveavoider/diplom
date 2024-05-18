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
        $tab = $task->tab ?? null;
        $inn = $task->inn ?? null;
        $auc = $task->auc ?? null;
        $has_prepaid = $task->has_prepaid ?? null;
        $multi_lot = $task->multi_lot ?? null;
        $sum_bg = $task->sum_bg ?? null;
        $sum_deal = $task->sum_deal ?? null;
        $type = $task->type ?? null;

        if ($title !== null) {
            $t->setTitle($title);
        }

        if ($status !== null) {
            $t->setStatus($status);
        }

        if ($owner !== null) {
            $t->setOwner($owner);
        }

        if ($tab !== null) {
            $t->setTab($tab);
        }

        if ($inn !== null) {
            $t->setInn($inn);
        }

        if ($auc !== null) {
            $t->setAuc($auc);
        }

        if ($has_prepaid !== null) {
            $hasPrepaid = $has_prepaid === '1';
            $t->setHasPrepaid($hasPrepaid);
        }

        if ($multi_lot !== null) {
            $multiLot = $multi_lot === '2';
            $t->setMultiLot($multiLot);
        }

        if ($sum_bg !== null) {
            $t->setSumBg($sum_bg);
        }

        if ($sum_deal !== null) {
            $t->setSumDeal($sum_deal);
        }

        if ($type !== null) {
            $t->setType($type);
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