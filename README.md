## Installation instructions:
1. The module is installed in the AB namespace. It should be created in Magento 2 in the app/code/AB directory. 
   Go to the AB directory and use the `git clone git@github.com:arturProjects/CustomPromoApi.git` to copy the module. 
   The CustomPromoApi directory will be created.
2. In Magento you need to run the commands that will install the module.
   ```
    bin/magento setup:upgrade
    bin/magento setup:di:compile
    bin/magento cache:flush
   ```

## Rest API call examples:
RestApi endpoints:
   ```
   /V1/promo_api/addPromotion
   /V1/promo_api/getPromotion/:promotion_id
   /V1/promo_api/deletePromotion/:promotion_id
   /V1/promo_api/getPromotionList
   ```
1. /V1/promo_api/addPromotion
   ```
   "{\"promotion_name\":\"Last promotion before the end\",\"created_at\":\"2025-03-27 13:46:18\",\"updated_at\":\"2025-03-27 13:46:18\",\"promotion_id\":\"7\"}"
   ```
   
3. /V1/promo_api/getPromotion/:promotion_id
 ```
[
    "1",
    "Promotion 1",
    "2025-03-26 16:24:46",
    "2025-03-26 16:24:46"
]
```
4. /V1/promo_api/deletePromotion/:promotion_id
   ```
   true
   ```
5. /V1/promo_api/getPromotionList
   ```
   [
    {
        "promotion_id": "3",
        "promotion_name": "Promotion 3",
        "created_at": "2025-03-26 16:33:58",
        "updated_at": "2025-03-26 16:33:58"
    },
    {
        "promotion_id": "5",
        "promotion_name": "Promotion 4",
        "created_at": "2025-03-26 16:39:58",
        "updated_at": "2025-03-26 16:39:58"
    },
    {
        "promotion_id": "6",
        "promotion_name": "Promotion on Thursday",
        "created_at": "2025-03-27 08:54:21",
        "updated_at": "2025-03-27 08:54:21"
    }
   ]
   
   ```
