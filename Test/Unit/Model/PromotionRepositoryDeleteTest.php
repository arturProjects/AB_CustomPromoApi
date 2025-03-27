<?php

namespace AB\CustomPromoApi\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use AB\CustomPromoApi\Model\Api\PromotionRepository;
use AB\CustomPromoApi\Model\PromotionFactory;
use AB\CustomPromoApi\Model\ResourceModel\Promotion as PromotionResource;
use AB\CustomPromoApi\Model\Promotion;
use Magento\Framework\Exception\LocalizedException;
use PHPUnit\Framework\MockObject\MockObject;

class PromotionRepositoryDeleteTest extends TestCase
{
    /**
     * @var PromotionRepository
     */
    private PromotionRepository $promotionRepository;

    /**
     * @var PromotionFactory|MockObject
     */
    private PromotionFactory|MockObject $promotionFactoryMock;

    /**
     * @var PromotionResource|MockObject
     */
    private PromotionResource|MockObject $promotionResourceMock;

    /**
     * @var Promotion|MockObject
     */
    private Promotion|MockObject $promotionMock;

    protected function setUp(): void
    {
        $this->promotionFactoryMock = $this->createMock(PromotionFactory::class);
        $this->promotionResourceMock = $this->createMock(PromotionResource::class);
        $this->promotionMock = $this->createMock(Promotion::class);

        $this->promotionRepository = new PromotionRepository(
            $this->promotionFactoryMock,
            $this->promotionResourceMock
        );
    }

    /**
     * Test metody deletePromotion
     *
     * @throws LocalizedException
     */
    public function testDeletePromotion()
    {
        $this->promotionFactoryMock->expects($this->once())
            ->method('addPromotion')
            ->willReturn($this->promotionMock);

        $this->promotionMock->expects($this->once())
            ->method('getPromotion')
            ->willReturn(1);

        $this->promotionResourceMock->expects($this->once())
            ->method('deletePromotion')
            ->with($this->promotionMock);

        $result = $this->promotionRepository->deletePromotion(1);
        $this->assertTrue($result);
    }
}
