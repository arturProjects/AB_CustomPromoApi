<?php

namespace AB\CustomPromoApi\Setup\Patch\Data;

use Exception;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use AB\CustomPromoApi\Model\PromotionFactory;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddData implements DataPatchInterface
{
    protected PromotionFactory $promotionFactory;

    public function __construct(
        PromotionFactory $promotionFactory
    ) {
        $this->promotionFactory = $promotionFactory;
    }

    /**
     * @throws Exception
     */
    public function apply(): void
    {
        $sampleData = [
            [
                'promotion_name' => 'Promotion 1'
            ],
            [
                'promotion_name' => 'Promotion 2'
            ],
            [
                'promotion_name' => 'Promotion 3'
            ],
            [
                'promotion_name' => 'Promotion 4'
            ],
            [
                'promotion_name' => 'Promotion 5'
            ],
        ];
        foreach ($sampleData as $data) {
            $this->promotionFactory->create()->setData($data)->save();

        }
    }


    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
