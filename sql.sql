ALTER TABLE `users` ADD `cnpj` INT NOT NULL AFTER `Email`;
ALTER TABLE `users` CHANGE `cnpj` `cnpj` VARCHAR( 14 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;
