<?php

namespace App\Task\Entity;

class Task
{
    private int $id;
    private string $title;
    private bool $status = true;
    private int $owner;

    public function __construct(string $title, int $owner)
    {
        $this->title = $title;
        $this->owner = $owner;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function setStatus($status): void
    {
        $this->status = $status;
    }

    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function isStatus(): bool
    {
        return $this->status;
    }

    public function getOwner(): int
    {
        return $this->owner;
    }
}