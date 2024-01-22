USE `supermarketdb`;


CREATE TABLE `products`
(
    `id`           Int(255) AUTO_INCREMENT                                 NOT NULL,
    `product_name` VarChar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `product_code` VarChar(20) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL,
    `unit_price`   Decimal(10, 2) UNSIGNED                                 NOT NULL,
    PRIMARY KEY (`id`)
)
    CHARACTER SET = utf8
    COLLATE = utf8_general_ci
    COMMENT 'Table for products'
    ENGINE = InnoDB
    AUTO_INCREMENT = 1;


CREATE TABLE `shopping_cart`
(
    `id`            Int(255) AUTO_INCREMENT NOT NULL,
    `date_and_time` DateTime                NOT NULL,
    `payment_type`  TinyInt(255) UNSIGNED   NOT NULL DEFAULT '1' COMMENT 'Payment Type: 1 - Cash, 2 - Credit Card',
    PRIMARY KEY (`id`)
)
    CHARACTER SET = utf8
    COLLATE = utf8_general_ci
    COMMENT 'Represents Customers shopping cart'
    ENGINE = InnoDB
    AUTO_INCREMENT = 1;


CREATE TABLE `cart_items`
(
    `id`             Int(255) UNSIGNED AUTO_INCREMENT NOT NULL,
    `product_id`     Int(255)                         NOT NULL,
    `cart_id`        Int(255)                         NOT NULL,
    `product_amount` Decimal(10, 3) UNSIGNED          NOT NULL,
    PRIMARY KEY (`id`)
)
    CHARACTER SET = utf8
    COLLATE = utf8_general_ci
    COMMENT 'The products in a cart'
    ENGINE = InnoDB
    AUTO_INCREMENT = 1;

BEGIN;

INSERT INTO `products`(`id`, `product_name`, `product_code`, `unit_price`)
VALUES ('1', 'IBM Mleko', '111111', '42.00');
INSERT INTO `products`(`id`, `product_name`, `product_code`, `unit_price`)
VALUES ('2', 'Kokta 2L', '22222222', '65.00');
COMMIT;

BEGIN;

INSERT INTO `shopping_cart`(`id`, `date_and_time`, `payment_type`)
VALUES ('1', '2014-05-09 00:44:52', '1');
INSERT INTO `shopping_cart`(`id`, `date_and_time`, `payment_type`)
VALUES ('2', '2014-05-09 00:45:08', '2');
COMMIT;

BEGIN;

INSERT INTO `cart_items`(`id`, `product_id`, `cart_id`, `product_amount`)
VALUES ('1', '2', '1', '2.000');
INSERT INTO `cart_items`(`id`, `product_id`, `cart_id`, `product_amount`)
VALUES ('3', '1', '2', '5.000');
INSERT INTO `cart_items`(`id`, `product_id`, `cart_id`, `product_amount`)
VALUES ('4', '1', '1', '1.000');
COMMIT;

ALTER TABLE `cart_items`
    ADD CONSTRAINT `lnk_shopping_cart_cart_items` FOREIGN KEY (`cart_id`) REFERENCES `shopping_cart` (`id`) ON DELETE Cascade ON UPDATE Cascade;

ALTER TABLE `cart_items`
    ADD CONSTRAINT `lnk_products_cart_items` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE Cascade ON UPDATE Cascade;


# drop statements
# drop table if exists `cart_items`;
# drop table if exists `shopping_cart`;
# drop table if exists `products`;

