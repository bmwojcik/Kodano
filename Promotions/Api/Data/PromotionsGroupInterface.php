<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Data;

interface PromotionsGroupInterface
{
    public const ID = "entity_id";
    public const NAME = "name";
    public const CREATED_AT = "created_at";
    public const UPDATED_AT = "updated_at";

    public const TABLE_NAME = 'kodano_promotions_group';

    /**
     * @return string | null
     */
    public function getId(): ?string;

    /**
     * @param $id
     *
     * @return void
     */
    public function setId($id): void;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void;
}
