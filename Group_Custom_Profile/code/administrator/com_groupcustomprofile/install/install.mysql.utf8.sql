CREATE TABLE IF NOT EXISTS `jos_groupcustomprofile_profiles` (
  `id` bigint(11) unsigned NOT NULL auto_increment,
  `actor_id` bigint(11) unsigned NOT NULL default '0',
  `customfield1` VARCHAR(255),
  `customfield2` VARCHAR(255),
  `customfield3` VARCHAR(255),
  `customfield4` VARCHAR(255),
  `customfield5` VARCHAR(255),
  PRIMARY KEY  (`id`),
  KEY `node_id` (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;

