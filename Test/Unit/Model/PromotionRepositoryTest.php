<?php

namespace AB\CustomPromoApi\Test\Unit\Model;

use PHPUnit\Framework\TestCase;
use AB\CustomPromoApi\Model\Api\PromotionRepository;
use AB\CustomPromoApi\Model\Promotion;
use AB\CustomPromoApi\Model\ResourceModel\Promotion as PromotionResource;
use AB\CustomPromoApi\Model\PromotionFactory;
use Magento\Framework\Exception\LocalizedException;
use PHPUnit\Framework\MockObject\MockObject;

class PromotionRepositoryTest extends TestCase
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
     * Test metody addPromotion
     *
     * @throws LocalizedException
     */
    public function testAddPromotion()
    {
        $this->promotionFactoryMock->expects($this->once())
            ->method('addPromotion')
            ->willReturn($this->promotionMock);

        $this->promotionMock->expects($this->once())
            ->method('setPromotionName')
            ->with('Test Promotion')
            ->willReturnSelf();
        $this->promotionMock->expects($this->once())
            ->method('setCreatedAt')
            ->with(date('Y-m-d H:i:s'))
            ->willReturnSelf();
        $this->promotionMock->expects($this->once())
            ->method('setUpdatedAt')
            ->with(date('Y-m-d H:i:s'))
            ->willReturnSelf();
        $this->promotionResourceMock->expects($this->once())
            ->method('addPromotion')
            ->with($this->promotionMock);
        $promotionId = $this->promotionRepository->addPromotion($this->promotionMock);
        $this->assertEquals($this->promotionMock->getPromotionId(), $promotionId);
    }

}
