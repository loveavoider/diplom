<?php

namespace App\Task\dto;

class UpdateTask
{
    public string|null $title;
    public bool|null $status;
    public int|null $owner;
    public int|null $tab;
    public string|null $inn;
    public string|null $auc;
    public string|null $has_prepaid;
    public string|null $multi_lot;
    public string|null $sum_bg;
    public string|null $sum_deal;
    public string|null $type;
}