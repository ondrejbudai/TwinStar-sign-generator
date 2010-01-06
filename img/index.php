<?php

if(!isset($_GET['q']))exit;
$q = $_GET['q'];
$pos1 = strpos($q,'/');
$q = substr($q,0,$pos1);

if(!is_numeric($q))exit;
header('Content-type: image/gif');
require("./{$q}.gif");

?>
