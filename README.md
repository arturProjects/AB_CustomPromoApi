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
