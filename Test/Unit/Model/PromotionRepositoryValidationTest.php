<?php

namespace AB\CustomPromoApi\Test\Unit\Model;

use Magento\Framework\Exception\LocalizedException;
use AB\CustomPromoApi\Model\Api\PromotionRepository;
//use AB\CustomPromoApi\Api\Data\PromotionInterface;
use PHPUnit\Framework\TestCase;

class PromotionRepositoryValidationTest extends TestCase
{
    /**
     * @var PromotionRepository
     */
    private $promotionRepository;

    /**
     * @var PromotionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $promotionDataMock;

    protected function setUp(): void
    {
        // Tworzymy mock
        $this->promotionDataMock = $this->createMock(PromotionInterface::class);
        $this->promotionRepository = new PromotionRepository(
            $this->createMock(PromotionFactory::class),
            $this->createMock(PromotionResource::class)
        );
    }

    /**
     * Test walidacji danych wejściowych
     */
    public function testAddPromotionValidation()
    {
        $this->promotionDataMock->method('getName')->willReturn(null);  // Brak nazwy promocji

        $this->expectException(LocalizedException::class);
        $this->expectExceptionMessage('Promotion name is required.');

        $this->promotionRepository->addPromotion($this->promotionDataMock);
    }

}
