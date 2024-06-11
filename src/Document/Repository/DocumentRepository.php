<?php

namespace App\Document\Repository;

use App\Document\Entity\Document;
use Doctrine\ORM\EntityManagerInterface;

class DocumentRepository
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    ){}

    public function add(Document $doc): int
    {
        $this->entityManager->persist($doc);

        $this->entityManager->flush();

        return $doc->id;
    }

    public function get($task): array {
        return $this->entityManager->getRepository(Document::class)->findBy(['task' => intval($task)]);
    }

    public function getByType($task, $type): array {
        return $this->entityManager->getRepository(Document::class)->findBy(
            [
                'task' => intval($task),
                'type' => $type
            ]
        );
    }
}