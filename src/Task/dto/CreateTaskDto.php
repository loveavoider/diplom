<?php

namespace App\Task\dto;

class CreateTaskDto
{
    public string $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isStatus(): bool
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getOwner(): int
    {
        return $this->owner;
    }

    /**
     * @return string
     */
    public function getInn(): string
    {
        return $this->inn;
    }

    /**
     * @return string
     */
    public function getAuc(): string
    {
        return $this->auc;
    }

    /**
     * @return string
     */
    public function getHasPrepaid(): string
    {
        return $this->has_prepaid;
    }

    /**
     * @return string
     */
    public function getMultiLot(): string
    {
        return $this->multi_lot;
    }

    /**
     * @return string
     */
    public function getSumBg(): string
    {
        return $this->sum_bg;
    }

    /**
     * @return string
     */
    public function getSumDeal(): string
    {
        return $this->sum_deal;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
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