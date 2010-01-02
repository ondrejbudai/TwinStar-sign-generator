<?php
/*
 * Generátor podpisu z dat stažených z armory.twinstar.cz .
 *
 * Testováno na PHP 5.2 s nainstalovanou GD knihovnou
 *
 * Vytvořeno v NetBeans IDE.
 *
 */

//For testing...
$char = 'Alia';

//Require config file
require_once('inc/config.php');

//Require classes files
require_once('inc/classes/page.php');
require_once('inc/classes/image.php');

//Initialize classes

$page = new page($char);
$image = new image();

//Write name
$image->write_text(12,10,10,'orange',$char,B);

//If char is in guild, draw it
if($page->check_guild()){
    $guild = $page->get_from_html("</h2>\r\n<h3>","</h3>");
    $image->write_text(10,10,27,'orange',"<{$guild}>",N);
}

//Get raceid, class and level
$info = array('var theRaceId','var theClassName','var theLevel');
$base_info = $page->get_infos($info);

//Get race from raceid
$base_info[3] = $page->get_race($base_info[0]);

//Draw level, race and class
$image->write_text(8,10,45,'orange',"Level {$base_info[2]}, {$base_info[3]} {$base_info[1]}",N);

//Draw server name => twinstar.cz
$image->write_text(8,200,45,'orange','Server: twinstar.cz',N);

//Get and draw health
$hp = $page->get_from_html("Health:</h4>\r\n<p>\r\n<span>",'</span>');
$image->write_text(8,200,10,'orange',"Health: $hp",N);

//If char is not Rogue and Druid, get and draw mana
if($base_info[1]!= 'Rogue' && $base_info[1]!= 'Warrior'){
    $mp = $page->get_from_html("Mana</h4>\r\n<p>\r\n<span>",'</span>');
    $image->write_text(8,200,23,'orange',"Mana: $mp",N);
}
//Show image
$image->show_image();

//Unset objects
unset($page,$image);

?>