<?php

 function get_frontend_form($error=0){
    global $mysqli;
    $result = $mysqli->query("SELECT stid, name FROM stats_template ORDER by name ASC");
    while($value[] = $result->fetch_assoc());
    $mysqli->close();
    unset($value[count($value)-1]);
    array_unshift($value,array('stid' => 'no', 'name' => 'Nevykreslovat'));
     ?>
     <h1>Generátor podpisů pro WoW server Twinstar.cz</h1><br>
     <?php
     if($error)echo("<strong>ERROR! {$error}<strong><br><br>");
     ?>
        <form action="index.php" method="post">
            <table>
                <tr>
                    <td>
                        Jméno postavy:
                    </td>
                    <td>
                        <input type="text" name="name">
                    </td>
                </tr>

                        <?php
                        for($i=1;$i<5;$i++){
                            echo "<tr><td>Požadovaný stat {$i}:</td><td><select name=\"stat[]\">";
                            foreach($value as $tmp){
                                echo "<option value=\"{$tmp['stid']}\">{$tmp['name']}";

                            }
                            echo '</select></td></tr>';
                        }
                        ?>
            </table>
            <input type="hidden" name="skript">
            <br>
            <input type="submit" value="Vygenerovat podpis">
        </form>
     </body>
</html>
     <?php
     exit;
 }

?>