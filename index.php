<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Generátor podpisů pro WoW server Twinstar.cz</title>
    </head>
    <body>

<?php
require_once('inc/config.php');
require_once('inc/frontend_form.php');

$mysqli = new mysqli($config['mysql']['server'],$config['mysql']['user'],$config['mysql']['pass'],$config['mysql']['database']);

if(!isset($_POST['skript']))get_frontend_form();
else{
    if(isset($_POST['stat']) && isset($_POST['name'])){
        $ctx = stream_context_create(array('http' => array('timeout' => 15)));
        $tmp = @file_get_contents ("http://armory.twinstar.cz/index.php?searchType=profile&character={$_POST['name']}&realm=Twinstar",0,$ctx);
        if(!$tmp)get_frontend_form('Armory je dočasně nedostupná zkuste to prosím za chvíli!');
        if(strpos($tmp,'Error - character'))get_frontend_form("Postava s nickem \"{$_POST['name']}\" nebyla nalezena!");
        if(strpos($tmp,'Přetížení webu / Website overloaded'))get_frontend_form('Armory je přetížené, zkuste to prosím znovu za chvíli!');

        $name = $mysqli->real_escape_string($_POST['name']);
        $name = ucfirst($name);
        $result = $mysqli->query("INSERT INTO characters (name) VALUES ('{$name}')");
        $result = $mysqli->query("SELECT LAST_INSERT_ID() AS cid");
        $cid = $result->fetch_assoc();
        $cid = $cid['cid'];
        
        $query = '';
        foreach($_POST['stat'] as $value){
            if($value!='no'){
                $value = $mysqli->real_escape_string($value);
                $query .= "({$cid},{$value}),";
            }
        }
        if(!empty($query)){
            $query = substr($query,0,strlen($query)-1);
            $query = "INSERT INTO characters_stats (cid,stid) VALUES $query";
            $mysqli->query($query);
            
        }
        $char = $name;
        require('generator.php');

    }
}

echo "<img src=\"img/{$cid}/img.gif\"><br><br>
HTML kód:<br>
<textarea cols=\"60\" rows=\"3\"><img src=\"{$config['server']}/img/{$cid}/img.gif\" /></textarea><br><br>
BBCode (na fóra):<br>
<textarea cols=\"60\" rows=\"3\">[IMG]{$config['server']}/img/{$cid}/img.gif[/IMG]</textarea>";
?>
        <br><br>
        <a href="?">Zpět</a>

    </body>
</html>
