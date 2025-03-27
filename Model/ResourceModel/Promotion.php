<?php

namespace AB\CustomPromoApi\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Promotion extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('ab_custom_promo_promotion', 'promotion_id');
    }
}
