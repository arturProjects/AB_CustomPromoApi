<?php

namespace AB\CustomPromoApi\Model;

use Magento\Framework\Model\AbstractModel;
use AB\CustomPromoApi\Model\ResourceModel\Promotion as PromotionResource;

/**
 * @method setCreatedAt(string $date)
 * @method setUpdatedAt(string $date)
 */
class Promotion extends AbstractModel
{
    protected $_idFieldName = 'promotion_id';
    protected string $_model = PromotionResource::class;
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(PromotionResource::class);
    }

    /**
     * @return string
     */
    public function getPromotionName(): string
    {
        return $this->_getData('promotion_name');
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setPromotionName(string $name): self
    {
        return $this->setData('promotion_name', $name);
    }
}
