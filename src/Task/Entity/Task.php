<?php

namespace App\Task\Entity;

class Task
{
    private int $id;
    private string $title;
    private bool $status = true;
    private int $owner;
    private int $tab;
    private string $inn;
    private string $auc;
    private bool $has_prepaid;
    private bool $multi_lot;
    private string $sum_bg;
    private string $sum_deal;
    private string $type;

    public function __construct(
        string $title, int $owner, string $inn, string $auc, bool $has_prepaid, bool $multi_lot,
        string $sum_bg, string $sum_deal, string $type, $tab = 1
    ) {
        $this->title = $title;
        $this->owner = $owner;
        $this->inn = $inn;
        $this->auc = $auc;
        $this->has_prepaid = $has_prepaid;
        $this->multi_lot = $multi_lot;
        $this->sum_bg = $sum_bg;
        $this->sum_deal = $sum_deal;
        $this->type = $type;
        $this->tab = $tab;
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
     * @return bool
     */
    public function isHasPrepaid(): bool
    {
        return $this->has_prepaid;
    }

    /**
     * @return bool
     */
    public function isMultiLot(): bool
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
     * @param string $inn
     */
    public function setInn(string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @param string $auc
     */
    public function setAuc(string $auc): void
    {
        $this->auc = $auc;
    }

    /**
     * @param bool $has_prepaid
     */
    public function setHasPrepaid(bool $has_prepaid): void
    {
        $this->has_prepaid = $has_prepaid;
    }

    /**
     * @param bool $multi_lot
     */
    public function setMultiLot(bool $multi_lot): void
    {
        $this->multi_lot = $multi_lot;
    }

    /**
     * @param string $sum_bg
     */
    public function setSumBg(string $sum_bg): void
    {
        $this->sum_bg = $sum_bg;
    }

    /**
     * @param string $sum_deal
     */
    public function setSumDeal(string $sum_deal): void
    {
        $this->sum_deal = $sum_deal;
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

    public function setTab($tab): void {
        $this->tab = $tab;
    }

    public function getTab(): int {
        return $this->tab;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}