<?php

require_once 'db.php';

sql("CREATE TABLE IF NOT EXISTS `$database['table']` ( `id` INT(11) NOT NULL AUTO_INCREMENT , `text` VARCHAR(1000) NOT NULL , `user` VARCHAR(500) NOT NULL , `date` VARCHAR(20) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");

echo 'Installed successfully.';
