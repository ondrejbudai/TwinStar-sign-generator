SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Databáze: `sign`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `characters`
--

CREATE TABLE `characters` (
  `cid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `characters_stats`
--

CREATE TABLE `characters_stats` (
  `sid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cid` smallint(5) unsigned NOT NULL,
  `stid` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`sid`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabulky `stats_template`
--

CREATE TABLE `stats_template` (
  `stid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent` varchar(20) NOT NULL,
  `var_name` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `postfix` varchar(5) NOT NULL,
  PRIMARY KEY (`stid`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Vypisuji data pro tabulku `stats_template`
--

INSERT INTO `stats_template` (`stid`, `parent`, `var_name`, `name`, `postfix`) VALUES
(1, 'meleePower', 'effective', 'Attack Power', ''),
(2, 'agility', 'effective', 'Agility', ''),
(3, 'armor', 'effective', 'Armor', ''),
(4, 'defensesBlock', 'percent', 'Block', '%'),
(5, 'meleeCritChance', 'percent', 'Critical chance', '%'),
(6, 'defensesDodge', 'percent', 'Dodge', '%'),
(7, 'spellBonusHealing', 'value', 'Bonus Healing', ''),
(8, 'SCRIPT', 'defense', 'Defense', ''),
(9, 'intellect', 'effective', 'Intellect', ''),
(10, 'spellManaRegen', 'casting', 'MP5 while cast', ''),
(11, 'spellManaRegen', 'notCasting', 'MP5 while not cast', ''),
(12, 'defensesParry', 'percent', 'Parry', '%'),
(13, 'rangedCritChance', 'percent', 'Ranged critical', '%'),
(14, 'rangedHitRating', 'value', 'Ranged hit rating', ''),
(15, 'defensesResilience', 'value', 'Resilience', ''),
(16, 'SCRIPT', 'spell_crit', 'Spell critical', '%'),
(17, 'SCRIPT', 'spell_dmg', 'Spell damage', ''),
(18, 'spellHitRating', 'value', 'Spell hit rating', ''),
(19, 'spirit', 'effective', 'Spirit', ''),
(20, 'stamina', 'effective', 'Stamina', ''),
(21, 'strength', 'effective', 'Strength', ''),
(22, 'meleeMainHandSpeed', 'hastePercent', 'Haste', '%'),
(23, 'rangedSpeed', 'hastePercent', 'Ranged haste', '%'),
(24, 'spellHasteRating', 'increasedHastePercent', 'Spell haste', '%'),
(25, 'meleeHitRating', 'value', 'Hit rating', '' );