<?php

namespace AB\CustomPromoApi\Api;
interface PromotionRepositoryInterface
{

    /**
     * @param string[] $promotion
     * @return string
     */
    public function addPromotion(array $promotion): string;

    /**
     * @return mixed
     */
    public function getPromotionList(): mixed;

    /**
     * @param int $promotionId
     * @return mixed
     */
    public function getPromotion(int $promotionId): mixed;

    /**
     * @param int $promotionId
     * @return bool
     */
    public function deletePromotion(int $promotionId): bool;
}
