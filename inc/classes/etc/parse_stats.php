<?php

function parse_defense(){
    global $page;

    $pos = strpos($page->page,'function defensesDefenseObject(');
    $tmp[1] = $page->get_infos(array('this.plusDefense'),$pos);
    $tmp[2] = $page->get_infos(array('this.value'),$pos);

    $tmp[2] = substr($tmp[2][0],0,strpos($tmp[2][0],' '));
    return $tmp[1][0] + $tmp[2];
}

function parse_spell_crit(){
    return parse_spell_stats('spellCritChance');
}

function parse_spell_dmg(){
    return parse_spell_stats('spellBonusDamage');
}

function parse_spell_stats($stat){
    global $page;

    static $schools = array('holy','fire','nature','frost','shadow','arcane');

    $pos = strpos($page->page,"function {$stat}Object(");

    $return = 0;
    for($i=0;$i<6;$i++){

        $tmp = $page->get_infos(array("this.{$schools[$i]}"),$pos);
        if($tmp[0]>$return) $return = $tmp[0];

    }

    return $return;

}

?>
