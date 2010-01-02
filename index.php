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

$image->show_image();

?>