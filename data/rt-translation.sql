--
-- Structure de la table `translation_key`
--

CREATE TABLE IF NOT EXISTS `translation_key` (
  `key_id` int(11) NOT NULL AUTO_INCREMENT,
  `key_message` varchar(512) CHARACTER SET utf8 NOT NULL,
  `key_text_domain` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'default',
  PRIMARY KEY (`key_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `translation_locale`
--

CREATE TABLE IF NOT EXISTS `translation_locale` (
  `locale_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `locale_locale` varchar(6) CHARACTER SET utf8 NOT NULL,
  `locale_published` tinyint(1) NOT NULL,
  `locale_default` tinyint(1) NOT NULL,
  `locale_plural_forms` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'nplurals=2; plural=(n==1 ? 0 : 1)',
  PRIMARY KEY (`locale_locale`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `translation_translation`
--

CREATE TABLE IF NOT EXISTS `translation_translation` (
  `translation_id` int(11) NOT NULL AUTO_INCREMENT,
  `translation_locale` varchar(6) CHARACTER SET utf8 NOT NULL,
  `translation_key_id` int(11) NOT NULL,
  `translation_translation` text CHARACTER SET utf8 NOT NULL,
  `translation_plural_index` tinyint(3) NOT NULL DEFAULT '1',
  `translation_author` int(11) NOT NULL,
  `translation_version` int(11) NOT NULL DEFAULT '0',
  `translation_timestamp` int(11) NOT NULL,
  `translation_published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`translation_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
