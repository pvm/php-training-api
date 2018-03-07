<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * Trait Timestamps
 *
 * @package App\Trait\Timestamps
 */
trait Timestamps
{
    /**
     * @var DateTime $createdAt
     *
     * @ORM\Column(type="datetime", name="created_at")
     */
    private $createdAt;

    /**
     * @var DateTime $updatedAt
     *
     * @ORM\Column(type="datetime", name="updated_at", nullable=true)
     */
    private $updatedAt;

    /**
     * @var DateTime $deletedAt
     *
     * @ORM\Column(type="datetime", name="deleted_at", nullable=true)
     */
    private $deletedAt;

    /**
     * Get Created At
     *
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->createdAt);
    }

    /**
     * Set Created At
     *
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Get Updated At
     *
     * @return DateTime
     */
    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->updatedAt);
    }

    /**
     * Set Updated At
     *
     * @param DateTime $updatedAt
     */
    public function setUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * Get Deleted At
     *
     * @return DateTime
     */
    public function getDeletedAt(): DateTime
    {
        return new DateTime($this->deletedAt);
    }

    /**
     * Set Deleted At
     *
     * @param DateTime $deletedAt
     */
    public function setDeletedAt(DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

    /**
     * Gets triggered only on insert
     *
     * @ORM\PrePersist
     */
    public function onPrePersist()
    {
        $this->createdAt = new DateTime('now');
    }

    /**
     * Gets triggered only on update
     *
     * @ORM\PreUpdate
     */
    public function onPreUpdate()
    {
        $this->updatedAt = new DateTime('now');
    }

    /**
     * Gets triggered before remove a row
     *
     * @ORM\PreRemove
     */
    public function onPreRemove()
    {
        $this->deletedAt = new DateTime('now');
    }
}
