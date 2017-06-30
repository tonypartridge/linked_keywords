CREATE TABLE IF NOT EXISTS `#__xws_linked_keywords` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL ,
`created_by` INT(11)  NOT NULL ,
`modified_by` INT(11)  NOT NULL ,
`name` VARCHAR(255)  NOT NULL ,
`link_externally` VARCHAR(255)  NOT NULL ,
`menuitem` INT(11)  NOT NULL ,
`externalurl` VARCHAR(255)  NOT NULL ,
`limit_use_global` TINYINT(1)  NOT NULL ,
`limit` INT(9)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8mb4_unicode_ci;

