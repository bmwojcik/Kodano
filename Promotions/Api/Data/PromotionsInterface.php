<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Data;

interface PromotionsInterface
{
    public const ID = 'entity_id';
    public const NAME = 'name';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public const TABLE_NAME = 'kodano_promotions';

    /**
     * @return string | null
     */
    public function getId(): ?string;

    /**
     * @param $id
     * @return void
     */
    public function setId($id): void;

    /**
     * @return string | null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     *
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return string | null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string $createdAt
     *
     * @return void
     */
    public function setCreatedAt(string $createdAt): void;

    /**
     * @return string | null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(string $updatedAt): void;
}
