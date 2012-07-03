<?php

/**
 * First migration creates the table
 * 
 * Creates a table for the invite request. 
 */
function invite_1()
{
    dbexec("CREATE TABLE `#__invite_requests` (
    `id` bigint(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `meta` TEXT   
    ) ENGINE=InnoDB CHARACTER SET `utf8` COLLATE `utf8_general_ci`");
}

?>