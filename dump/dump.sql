CREATE TABLE IF NOT EXISTS `phaldoc_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned NOT NULL DEFAULT '1',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1',
  `is_parent` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `ordinal` smallint(4) unsigned NOT NULL DEFAULT '1',
  `rst` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`),
  KEY `parent_id` (`parent_id`),
  KEY `is_parent` (`is_parent`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `phaldoc_langs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL DEFAULT '',
  `langname` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


INSERT INTO `phaldoc_langs` (`id`, `lang`, `langname`) VALUES
(1, 'pl', 'Polski');


CREATE TABLE IF NOT EXISTS `phaldoc_lines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `ordinal` smallint(4) unsigned NOT NULL DEFAULT '1',
  `is_translate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_empty` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` varchar(32) NOT NULL DEFAULT 'empty',
  `updated` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `phaldoc_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project` varchar(64) NOT NULL DEFAULT '',
  `describe` varchar(255) NOT NULL DEFAULT '',
  `version` varchar(24) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `phaldoc_translates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `line_id` int(10) unsigned NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT '',
  `translate` text COLLATE utf8_unicode_ci,
  `updated` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `line_id` (`line_id`),
  KEY `lang` (`lang`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


ALTER TABLE `phaldoc_lines`
  ADD CONSTRAINT `phaldoc_lines_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phaldoc_files` (`id`) ON DELETE CASCADE;

ALTER TABLE `phaldoc_translates`
  ADD CONSTRAINT `phaldoc_translates_ibfk_1` FOREIGN KEY (`line_id`) REFERENCES `phaldoc_lines` (`id`) ON DELETE CASCADE;