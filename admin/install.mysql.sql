CREATE TABLE IF NOT EXISTS `#__faq_categories` (
 `id` INT NOT NULL AUTO_INCREMENT ,
 `name` VARCHAR(255) NOT NULL ,
 `alias` VARCHAR(255) NOT NULL ,
 `description` TEXT NULL ,
 `published` TINYINT NOT NULL DEFAULT '1' ,
 `featured` TINYINT NOT NULL DEFAULT '0' ,
 `ordering` INT NOT NULL ,
 `image` VARCHAR(255) NULL ,
 `params` TEXT NULL ,
 `trash` TINYINT NOT NULL DEFAULT '0' ,
 `language` VARCHAR(10) NOT NULL DEFAULT '*' ,
 `plugins` TEXT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `#__faq_sections` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NOT NULL ,
  `alias` INT(255) NOT NULL ,
  `description` TEXT NULL DEFAULT NULL ,
  `published` TINYINT NOT NULL DEFAULT '1' ,
  `featured` TINYINT NOT NULL ,
  `ordering` INT NOT NULL ,
  `trash` TINYINT NOT NULL DEFAULT '0' ,
  `language` VARCHAR(10) NOT NULL DEFAULT '*' ,
  `category_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`)
);

CREATE TABLE `#__faq_questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `question` TEXT NOT NULL ,
  `answer` TEXT NOT NULL ,
  `section_id` INT(11) NOT NULL ,
  `ordering` INT(11) NOT NULL ,
  `published` TINYINT NOT NULL DEFAULT '1' ,
  `featured` TINYINT NOT NULL DEFAULT '0' ,
  `trash` TINYINT NOT NULL DEFAULT '0' ,
  `language` VARCHAR(10) NOT NULL DEFAULT '*' ,
  `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modified` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `modified_by` INT(11) NOT NULL ,
  `created_by` INT(11) NOT NULL ,
  `publish_up` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
  `publish_down` DATETIME NOT NULL ,
  PRIMARY KEY (`id`)
);

