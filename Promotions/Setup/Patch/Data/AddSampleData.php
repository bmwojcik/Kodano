<?php

declare(strict_types=1);

namespace Kodano\Promotions\Setup\Patch\Data;

use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddSampleData implements DataPatchInterface, PatchRevertableInterface
{
    private const SAMPLE_DATA = [
        PromotionsInterface::TABLE_NAME => [
            ['name' => 'Shoes'],
            ['name' => 'Jackets'],
            ['name' => 'Computer'],
            ['name' => 'Glasses']
        ],
        PromotionsGroupInterface::TABLE_NAME => [
            ['name' => 'Clothes'],
            ['name' => 'Electronic'],
            ['name' => 'Gadgets']
        ],
        PromotionsRelationInterface::TABLE_NAME => [
            ['promotions_id' => 1, 'group_id' => 1],
            ['promotions_id' => 1, 'group_id' => 2],
            ['promotions_id' => 2, 'group_id' => 2],
            ['promotions_id' => 3, 'group_id' => 2],
        ]
    ];

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup
    )
    {
    }

    /** @inheritdoc */
    public function apply(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        foreach (self::SAMPLE_DATA as $tableName => $sampleData) {
            $this->moduleDataSetup->getConnection()->insertMultiple(
                $this->moduleDataSetup->getTable($tableName),
                $sampleData
            );
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /** @inheritdoc */
    public static function getDependencies(): array
    {
        return [];
    }

    /** @inheritdoc */
    public function getAliases(): array
    {
        return [];
    }

    /** @inheritdoc */
    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        foreach (self::SAMPLE_DATA as $tableName => $sampleData) {
            $nameValues = array_column($sampleData, 'name');

            if (!empty($nameValues)) {
                $this->moduleDataSetup->getConnection()->delete(
                    $this->moduleDataSetup->getTable($tableName),
                    ['name IN (?)' => $nameValues]
                );
            }
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }
}
