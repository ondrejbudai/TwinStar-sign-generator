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

        //Set content-type to gif
        Header('Content-type: image/gif');

        //Initialize colors
        $this->set_color('orange',0xFF,0xA8,0x41);
    }

    private function set_color($name,$r,$g,$b){

        $this->colors[$name] = imagecolorallocate($this->image,$r,$g,$b);

    }

    public function show_image(){

        imagegif($this->image);
        imagedestroy($this->image);
    }

    public function write_text($size,$x,$y,$color,$text,$font_type){

        $y = $y + $size;

        imagettftext($this->image,$size,0,$x,$y,$this->colors[$color],$this->font[$font_type],$text);
    }
}
?>