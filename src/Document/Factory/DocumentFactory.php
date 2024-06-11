<?php

namespace App\Document\Factory;

use App\Document\Entity\Document;

class DocumentFactory
{
    public function document(int $type, int $task, string $path): Document {
        $doc = new Document();
        $doc->type = $type;
        $doc->task = $task;
        $doc->path = $path;
        return $doc;
    }
}