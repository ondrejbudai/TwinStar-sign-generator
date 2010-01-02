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
            if(!strpos($tmp,'Error - character') && !strpos($tmp,'Přetížení webu / Website overloaded')){
                $this->page = $tmp;
                return true;
            }
            else return false;

        }
        else exit('Fatal Error: Adresa nedostupná!');

    }

    /*
     * Metoda, která zjistí info z javascript
     */

    public function get_infos($strs){

        foreach($strs as $value){

            $tmp = $this->get_info($value);

            //Clean "" from chars
            if($tmp[0]=="\"") $return[] = substr($tmp,1,strlen($tmp)-2);
            else $return[] = $tmp;

        }
        return $return;
    }

    private function get_info($parse_str) {
        
        $pos1 = strpos($this->page,$parse_str);
        $pos2 = strpos($this->page,';',$pos1);
        $pos1 += 3 + strlen($parse_str);
        return substr($this->page,$pos1,$pos2-$pos1);
    }

    public function get_race($id){
        $return = array('Human','Orc','Dwarf','Night Elf','Undead','Tauren','Gnome','Troll','','Blood Elf','Draenei');
        return $return[$id-1];
    }

    public function get_from_html($start,$end){
        $pos1 = strpos($this->page,$start);
        $pos2 = strpos($this->page,$end,$pos1);
        $pos1 += strlen($start);
        return substr($this->page,$pos1,$pos2-$pos1);
    }

    public function check_guild(){
        if(strpos($this->page,"</h2>\r\n<h4>") === false) return 1;
        else return 0;
    }
}
?>