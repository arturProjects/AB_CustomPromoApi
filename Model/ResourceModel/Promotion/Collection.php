<?php

namespace AB\CustomPromoApi\Model\ResourceModel\Promotion;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use AB\CustomPromoApi\Model\Promotion;
use AB\CustomPromoApi\Model\ResourceModel\Promotion as PromotionResource;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'promotion_id';
    protected $_model = Promotion::class;

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(Promotion::class, PromotionResource::class);
    }
}
