<?php

namespace App\Task\dto;

class CreateTaskDto
{
    public string $title;
    public bool $status;
    public int $owner;
    public string $inn;
    public string $auc;
    public string $has_prepaid;
    public string $multi_lot;
    public string $sum_bg;
    public string $sum_deal;
    public string $type;
}