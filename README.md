## Installation instructions:
1. The module is installed in the AB namespace. It should be created in Magento 2 in the app/code/AB directory. 
   Go to the AB directory and use the `git clone git@github.com:arturProjects/AB_CustomPromoApi.git` to copy the module. 
   The AB_CustomPromoApi directory will be created. The directory should be renamed to CustomPromoApi.
2. In Magento you need to run the commands that will install the module.
   ```
    bin/magento setup:upgrade
    bin/magento setup:di:compile
    bin/magento cache:flush
   ```

## Rest API call examples:
