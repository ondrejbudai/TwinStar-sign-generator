AlTER TABLE `stats_template` ADD `postfix` VARCHAR( 5 ) NOT NULL

ALTER TABLE `stats_template` CHANGE `var_name` `var_name` VARCHAR( 25 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;

TRUNCATE stats_template ;

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
(24, 'spellHasteRating', 'increasedHastePercent', 'Spell haste', '%');
