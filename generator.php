<?php
/*
 * Generátor podpisu z dat stažených z armory.twinstar.cz .
 *
 * Testováno na PHP 5.2 s nainstalovanou GD knihovnou
 *
 * Vytvořeno v NetBeans IDE.
 *
 */

//Unauthorized running of script
if(!isset($cid,$char)) exit;

//Require config file
require_once('inc/config.php');

//Require classes files
require_once('inc/classes/page.php');
require_once('inc/classes/image.php');

//Initialize classes
$page = new page($char);
$image = new image();

//Write name
$image->write_text(12,10,7,'orange',$char,B);

//If char is in guild, draw it
if($page->check_guild()){
    $guild = $page->get_from_html("</h2>\r\n<h3>","</h3>");
    $image->write_text(10,10,24,'orange',"<{$guild}>",N);
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
$image->write_text(8,200,7,'orange',"Health: $hp",N);

//If char is not Rogue or Warrior, get and draw mana
if($base_info[1]!= 'Rogue' && $base_info[1]!= 'Warrior'){
    $mp = $page->get_from_html("Mana</h4>\r\n<p>\r\n<span>",'</span>');
    $image->write_text(8,200,20,'orange',"Mana: $mp",N);
}

//Get settings for char from database
$result = $mysqli->query("SELECT st.parent, st.var_name, st.name, st.postfix
    FROM stats_template st, characters_stats s, characters c
    WHERE c.name='{$char}'
    AND c.cid={$cid}
    AND c.cid=s.cid
    AND s.stid=st.stid
    LIMIT 0,4");
$y=7;
while($value = $result->fetch_assoc()){
    if($value['parent']=='SCRIPT'){
        $fce = "parse_{$value['var_name']}";
        $data[0] = $fce();
    }
    else {
        $pos = strpos($page->page,"function {$value['parent']}Object(");
        $data = $page->get_infos(array("this.{$value['var_name']}"),$pos);
    }
    $image->write_text(8,330,$y,'orange',"{$value['name']}: {$data[0]}{$value['postfix']}",N);
    $y += 13;
}

//Show image
$image->show_image();

//Close database connection
$mysqli->close();

//Unset objects
unset($page,$image,$mysqli);

?>