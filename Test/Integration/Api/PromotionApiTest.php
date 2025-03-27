<?php

namespace AB\CustomPromoApi\Test\Integration\Api;

use Magento\TestFramework\TestCase\WebapiAbstract;
use Magento\TestFramework\TestCase\WebapiAbstractTestCase;

class PromotionApiTest extends WebapiAbstract implements WebapiAbstractTestCase
{
    const URL_PATH = '/V1/promo_api/';

    public function testPostAddPromotion()
    {
        $data = [
            'name' => 'New Promotion',
            'created_at' => '2025-03-28 10:00:00',
            'updated_at' => '2025-03-28 10:00:00',
        ];

        $response = $this->_webApiCall((array)'POST', self::URL_PATH, $data);

        $this->assertArrayHasKey('promotion_id', $response);
        $this->assertEquals(1, $response['promotion_id']);
    }
}
