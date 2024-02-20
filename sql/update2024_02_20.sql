    RENAME TABLE `project_database`.`cart_item` TO `project_database`.`nckp1tyung_cart_item`; 
    RENAME TABLE `project_database`.`order_details` TO `project_database`.`nckp1tyung_order_details`; 
    RENAME TABLE `project_database`.`order_items` TO `project_database`.`nckp1tyung_order_items`; 
    RENAME TABLE `project_database`.`product` TO `project_database`.`nckp1tyung_product`; 
    RENAME TABLE `project_database`.`product_category` TO `project_database`.`nckp1tyung_product_category`; 
    RENAME TABLE `project_database`.`properties` TO `project_database`.`nckp1tyung_properties`; 
    RENAME TABLE `project_database`.`shopping_session` TO `project_database`.`nckp1tyung_shopping_session`; 
    RENAME TABLE `project_database`.`user` TO `project_database`.`nckp1tyung_user`; 
    RENAME TABLE `project_database`.`user_address` TO `project_database`.`nckp1tyung_user_address`; 

ALTER TABLE `nckp1tyung_user` ADD `admin` BOOLEAN NOT NULL AFTER `email`; 