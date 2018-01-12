
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- inter_exclude_category
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `inter_exclude_category`;

CREATE TABLE `inter_exclude_category`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `first_category_id` INTEGER NOT NULL,
    `second_category_id` INTEGER NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`id`),
    INDEX `FI_category_first_category_id` (`first_category_id`),
    INDEX `FI_category_second_category_id` (`second_category_id`),
    CONSTRAINT `fk_category_first_category_id`
        FOREIGN KEY (`first_category_id`)
        REFERENCES `category` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE,
    CONSTRAINT `fk_category_second_category_id`
        FOREIGN KEY (`second_category_id`)
        REFERENCES `category` (`id`)
        ON UPDATE RESTRICT
        ON DELETE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
