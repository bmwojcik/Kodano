<?php

namespace Kodano\Promotions\Test\Unit\Model;

use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Kodano\Promotions\Api\Data\PromotionsRelationInterfaceFactory;
use Kodano\Promotions\Api\Repository\PromotionsRelationRepositoryInterface;
use Kodano\Promotions\Api\Repository\PromotionsRepositoryInterface;
use Kodano\Promotions\Model\PromotionsManager;
use Magento\Framework\Api\SearchCriteria;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

class PromotionsManagerTest extends TestCase
{
    /** @var PromotionsRelationRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $promotionsRelationRepository;

    /** @var PromotionsRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject */
    private $promotionsRepository;

    /** @var PromotionsRelationFactory|\PHPUnit\Framework\MockObject\MockObject */
    private $promotionsRelationFactory;

    /** @var SearchCriteriaBuilder|\PHPUnit\Framework\MockObject\MockObject */
    private $searchCriteriaBuilder;

    /** @var PromotionsManager */
    private $promotionsManager;

    protected function setUp(): void
    {
        $this->searchCriteriaBuilder = $this->createMock(SearchCriteriaBuilder::class);
        $this->promotionsRelationRepository = $this->createMock(PromotionsRelationRepositoryInterface::class);
        $this->promotionsRelationFactory = $this->createMock(PromotionsRelationInterfaceFactory::class);
        $this->promotionsRepository = $this->createMock(PromotionsRepositoryInterface::class);

        $objectManager = new ObjectManager($this);
        $this->promotionsManager = $objectManager->getObject(
            PromotionsManager::class,
            [
                'searchCriteriaBuilder' => $this->searchCriteriaBuilder,
                'promotionsRelationRepository' => $this->promotionsRelationRepository,
                'promotionsRelationFactory' => $this->promotionsRelationFactory,
            ]
        );
    }

    public function testAssignPromotionsToGroupSuccess()
    {
        $promotionsId = 1;
        $groupId = 2;

        $searchCriteriaMock = $this->createMock(SearchCriteria::class);
        $this->searchCriteriaBuilder->method('addFilter')->willReturnSelf();
        $this->searchCriteriaBuilder->method('create')->willReturn($searchCriteriaMock);

        $searchResultsMock = $this->createMock(SearchResultsInterface::class);
        $searchResultsMock->method('getTotalCount')->willReturn(0);
        $this->promotionsRelationRepository->method('getList')->willReturn($searchResultsMock);

        $relationMock = $this->createMock(PromotionsRelationInterface::class);
        $this->promotionsRelationFactory->method('create')->willReturn($relationMock);

        $this->promotionsRelationRepository->expects($this->once())->method('save')->with($relationMock);

        $this->assertTrue($this->promotionsManager->assignPromotionsToGroup($promotionsId, $groupId));
    }

    public function testAssignPromotionsToGroupAlreadyExists()
    {
        $promotionsId = 1;
        $groupId = 2;

        $searchCriteriaMock = $this->createMock(SearchCriteria::class);
        $this->searchCriteriaBuilder->method('addFilter')->willReturnSelf();
        $this->searchCriteriaBuilder->method('create')->willReturn($searchCriteriaMock);

        $searchResultsMock = $this->createMock(SearchResultsInterface::class);
        $searchResultsMock->method('getTotalCount')->willReturn(1);
        $this->promotionsRelationRepository->method('getList')->willReturn($searchResultsMock);

        $this->expectException(AlreadyExistsException::class);

        $this->promotionsManager->assignPromotionsToGroup($promotionsId, $groupId);
    }
}
