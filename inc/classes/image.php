<?php
/*
 * Třída image pro manipulaci s výsledným obrázkem.
 *
 */

//Constants

define('N','normal');
define('B','bold');

class image {
    private $image;
    private $colors;
    private $font;

    public function __construct(){
        global $config;

        $this->image = imagecreate(468,60);
        imagecolorallocate($this->image,0,0,0);

        //Initialize fonts
        $this->font['normal'] = $config['font']['normal'];
        $this->font['bold'] = $config['font']['bold'];

        //Initialize colors
        $this->set_color('orange',0xFF,0xA8,0x41);
    }

    private function set_color($name,$r,$g,$b){

        //Set color
        $this->colors[$name] = imagecolorallocate($this->image,$r,$g,$b);

    }

    public function show_image(){

        //Show image in gif format
        imagegif($this->image,'tmp.gif');

        //Destroy image
        imagedestroy($this->image);

        echo '<img src="tmp.gif" />';
    }

    public function write_text($size,$x,$y,$color,$text,$font_type){

        //Add font size to vertical position
        $y = $y + $size;

        //Draw text
        imagettftext($this->image,$size,0,$x,$y,$this->colors[$color],$this->font[$font_type],$text);
    }
}
?>