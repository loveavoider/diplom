<?php

namespace App\Task\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends AbstractController
{
    public function getTask(int $id): Response
    {
        return new Response($id);
    }
}