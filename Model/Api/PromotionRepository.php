<?php

namespace AB\CustomPromoApi\Model\Api;

use AB\CustomPromoApi\Api\PromotionRepositoryInterface;
use AB\CustomPromoApi\Model\ResourceModel\Promotion as PromotionResource;
use AB\CustomPromoApi\Model\PromotionFactory;
use AB\CustomPromoApi\Model\ResourceModel\Promotion\Collection;
use AB\CustomPromoApi\Model\ResourceModel\Promotion\CollectionFactory;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Exception;

class PromotionRepository implements PromotionRepositoryInterface
{
    /**
     * @var AuthorizationInterface
     */
    protected AuthorizationInterface $authorization;

    /**
     * @var PromotionFactory
     */
    protected PromotionFactory $promotionFactory;

    /**
     * @var PromotionResource
     */
    protected PromotionResource $promotionResource;

    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $promotionCollectionFactory;

    /**
     * @param AuthorizationInterface $authorization
     * @param PromotionFactory $promotionFactory
     * @param PromotionResource $promotionResource
     * @param CollectionFactory $promotionCollectionFactory
     */
    public function __construct(
        AuthorizationInterface $authorization,
        PromotionFactory $promotionFactory,
        PromotionResource $promotionResource,
        CollectionFactory $promotionCollectionFactory
    ) {
        $this->authorization = $authorization;
        $this->promotionFactory = $promotionFactory;
        $this->promotionResource = $promotionResource;
        $this->promotionCollectionFactory = $promotionCollectionFactory;
    }

    /**
     * @return array
     * @throws LocalizedException
     */
    public function getPromotionList(): array
    {
        if (!$this->isAllowed('AB_CustomPromoApi::view_promotion_list')) {
            throw new LocalizedException(__('You do not have permission to view the promotion list.'));
        }
        $promotionList = $this->getPromotionCollection()->getItems();
        $promotionData = [];
        foreach ($promotionList as $promotion) {
            $promotionData[] = $promotion->toArray();
        }
        return $promotionData;
    }

    /**
     * @param int $promotionId
     * @return array
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getPromotion(int $promotionId): array
    {
        if (!$this->authorization->isAllowed('AB_CustomPromoApi::view_single_promotion')) {
            throw new LocalizedException(__('You do not have permission to view the promotion.'));
        }
        $promotionCollection = $this->getPromotionCollection();
        $promotionCollection->addFieldToFilter('promotion_id', ['eq' => $promotionId]);
        if ($promotionCollection->getSize() > 0) {
            $promotion = $promotionCollection->getFirstItem();
            return $promotion->toArray();
        }
        throw new NoSuchEntityException(__('Promotion with ID %1 does not exist.', $promotionId));
    }

    /**
     * @param $promotion
     * @return string
     * @throws LocalizedException
     */
    public function addPromotion($promotion): string
    {
        if (!$this->authorization->isAllowed('AB_CustomPromoApi::add_promotion')) {
            throw new LocalizedException(__('You do not have permission to add a promotion.'));
        }
        try {
                $newPromotion = $this->promotionFactory->create();
                $newPromotion->setPromotionName($promotion['promotion_name']);
                $newPromotion->setCreatedAt(date('Y-m-d H:i:s'));
                $newPromotion->setUpdatedAt(date('Y-m-d H:i:s'));
                $this->promotionResource->save($newPromotion);
                return json_encode($newPromotion->toArray());
        } catch (Exception $e) {
                throw new CouldNotSaveException(__('Could not create promotion: %1', $e->getMessage()));
        }

    }

    /**
     * @param int $promotionId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws LocalizedException
     */
    public function deletePromotion(int $promotionId): bool
    {
        if (!$this->authorization->isAllowed('AB_CustomPromoApi::delete_promotion')) {
            throw new LocalizedException(__('You do not have permission to delete a promotion.'));
        }
        try {
                $promotionCollection = $this->getPromotionCollection();
                $promotionCollection->addFieldToFilter('promotion_id', ['eq' => $promotionId]);
                if ($promotionCollection->getSize() > 0) {
                    $promotion = $promotionCollection->getFirstItem();
                    $this->promotionResource->delete($promotion);
                    return true;
                }
                throw new NoSuchEntityException(__('Promotion with ID %1 does not exist.', $promotionId));
        } catch (Exception $e) {
                throw new CouldNotDeleteException(__('Could not delete promotion: %1', $e->getMessage()));
        }
    }


    /**
     * @return Collection
     */
    private function getPromotionCollection(): Collection
    {
        return $this->promotionCollectionFactory->create();
    }

    /**
     * @param string $resource
     * @return bool
     */
    public function isAllowed(string $resource): bool
    {
        return $this->authorization->isAllowed($resource);
    }

}
