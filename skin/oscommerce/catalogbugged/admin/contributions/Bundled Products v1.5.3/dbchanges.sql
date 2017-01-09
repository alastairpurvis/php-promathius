ALTER TABLE `products` ADD `products_bundle` TINYTEXT NOT NULL;
CREATE TABLE `products_bundles` (`bundle_id` SMALLINT NOT NULL, `subproduct_id` SMALLINT NOT NULL, `subproduct_qty` TINYINT NOT NULL , PRIMARY KEY (`bundle_id`, `subproduct_id`));
