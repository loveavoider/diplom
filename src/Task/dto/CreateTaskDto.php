<?php

namespace App\Task\dto;

class CreateTaskDto
{
    public string|null $title;
    public bool|null $status;
    public int|null $owner;
}