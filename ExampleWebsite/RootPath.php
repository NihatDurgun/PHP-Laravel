<?php
    //Bu dosya Settings.php ve benzeri dosyaların path'ini bulmaya yarar!

    function getRootPath(){
        $NotEditPath = dirname(__FILE__);
        $Pieces = explode("/", $NotEditPath);
        $Path = "";
        for($i=0;$i<(count($Pieces));$i++) {
            $Path .= $Pieces[$i]."/";
        }
        return $Path;
    }
    
?>