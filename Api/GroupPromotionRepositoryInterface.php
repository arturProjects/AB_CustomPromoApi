<?php

namespace AB\CustomPromoApi\Api;

interface GroupPromotionRepositoryInterface
{

    /**
     * @param string[] $groupPromotion
     * @return string
     */
    public function addGroupPromotion(array $groupPromotion): string;

    /**
     * @return mixed
     */
    public function getGroupPromotionList(): mixed;

    /**
     * @param int $groupPromotionId
     * @return mixed
     */
    public function getGroupPromotion(int $groupPromotionId): mixed;

    /**
     * @param int $groupPromotionId
     * @return bool
     */
    public function deleteGroupPromotion(int $groupPromotionId): bool;
}
