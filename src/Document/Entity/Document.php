<?php

namespace App\Document\Entity;

class Document
{
    const DOCUMENT_TYPE_DECISION = 1;
    const DOCUMENT_TYPE_BG = 2;

    public int $id;
    public int $type;
    public int $task;
    public string $path;
}