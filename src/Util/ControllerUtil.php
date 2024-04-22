<?php

namespace App\Util;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class ControllerUtil
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {}

    public function derializeRequest(string $type, Request $request): mixed {
        return $this->serializer->deserialize($request->getContent(), $type, 'json');
    }

    public function serializeResponse($data): string {
        return $this->serializer->serialize($data, 'json');
    }
}