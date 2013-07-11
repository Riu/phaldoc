CREATE TABLE IF NOT EXISTS `phaldoc_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ordinal` smallint(4) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `rst` varchar(128) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `phaldoc_langs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang` varchar(2) NOT NULL DEFAULT '',
  `langname` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `phaldoc_parts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1',
  `ordinal` smallint(4) unsigned NOT NULL DEFAULT '1',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `file_id` (`file_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;


ALTER TABLE `phaldoc_parts`
  ADD CONSTRAINT `phaldoc_parts_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `phaldoc_files` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phaldoc_parts_ibfk_2` FOREIGN KEY (`parent_id`) REFERENCES `phaldoc_parts` (`id`) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS `phaldoc_docs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lang_id` int(10) unsigned NOT NULL,
  `part_id` int(10) unsigned NOT NULL,
  `title` varchar(32) NOT NULL DEFAULT '',
  `value` text,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `lang_id` (`lang_id`),
  KEY `part_id` (`part_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 ;

ALTER TABLE `phaldoc_docs`
  ADD CONSTRAINT `phaldoc_docs_ibfk_1` FOREIGN KEY (`lang_id`) REFERENCES `phaldoc_langs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `phaldoc_docs_ibfk_2` FOREIGN KEY (`part_id`) REFERENCES `phaldoc_parts` (`id`) ON DELETE CASCADE;
