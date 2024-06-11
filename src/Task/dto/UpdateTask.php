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

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return bool|null
     */
    public function getStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool|null $status
     */
    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getOwner(): ?int
    {
        return $this->owner;
    }

    /**
     * @param int|null $owner
     */
    public function setOwner(?int $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return int|null
     */
    public function getTab(): ?int
    {
        return $this->tab;
    }

    /**
     * @param int|null $tab
     */
    public function setTab(?int $tab): void
    {
        $this->tab = $tab;
    }

    /**
     * @return string|null
     */
    public function getInn(): ?string
    {
        return $this->inn;
    }

    /**
     * @param string|null $inn
     */
    public function setInn(?string $inn): void
    {
        $this->inn = $inn;
    }

    /**
     * @return string|null
     */
    public function getAuc(): ?string
    {
        return $this->auc;
    }

    /**
     * @param string|null $auc
     */
    public function setAuc(?string $auc): void
    {
        $this->auc = $auc;
    }

    /**
     * @return string|null
     */
    public function getHasPrepaid(): ?string
    {
        return $this->has_prepaid;
    }

    /**
     * @param string|null $has_prepaid
     */
    public function setHasPrepaid(?string $has_prepaid): void
    {
        $this->has_prepaid = $has_prepaid;
    }

    /**
     * @return string|null
     */
    public function getMultiLot(): ?string
    {
        return $this->multi_lot;
    }

    /**
     * @param string|null $multi_lot
     */
    public function setMultiLot(?string $multi_lot): void
    {
        $this->multi_lot = $multi_lot;
    }

    /**
     * @return string|null
     */
    public function getSumBg(): ?string
    {
        return $this->sum_bg;
    }

    /**
     * @param string|null $sum_bg
     */
    public function setSumBg(?string $sum_bg): void
    {
        $this->sum_bg = $sum_bg;
    }

    /**
     * @return string|null
     */
    public function getSumDeal(): ?string
    {
        return $this->sum_deal;
    }

    /**
     * @param string|null $sum_deal
     */
    public function setSumDeal(?string $sum_deal): void
    {
        $this->sum_deal = $sum_deal;
    }

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }
    public string|null $type;
}