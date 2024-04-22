<?php

namespace App\Task\dto;

class UpdateTask
{
    public string|null $title;
    public bool|null $status;
    public int|null $owner;
}