<?php
/*
 * Třída Page pro manipulaci s obsahem stránky s údaji o postavě
 *
 */

class page {

    public $page;

    /*
     * Konstruktor se pokusí získat zdrojový kód stránky s postavou danou v parametru.
     * Pokud je adresa nedostupná, vypíše chybu a ukončí skript.
     * Poté zkotroluje, jestli postava existuje, pokud ne, metoda vrátí 0, pokud ano, vrátí 1.
     */

    public function __construct($char){

        $tmp = file_get_contents ("http://armory.twinstar.cz/index.php?searchType=profile&character={$char}&realm=Twinstar");

        if($tmp) {
            if(strpos($tmp,'Error - character')){
                $this->page = $tmp;
                return true;
            }
            else return false;

        }
        else exit("Fatal Error: Adresa nedostupná!");

    }
}
?>