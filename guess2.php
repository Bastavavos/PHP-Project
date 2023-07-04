<?php
var_dump("limite :");
$x = (int) fgets(STDIN);
$valUtil = NULL;
$nbAleatoire = rand(0 , $x);
$nbEssai = 0;

while ($valUtil != $nbAleatoire) {
    $nbEssai ++;
    $valUtil = (int)fgets(STDIN);
    $diff = abs($nbAleatoire-$valUtil);
    if($diff < 50 && $diff > 25) {
        var_dump("tu es proche");
    }
    if($diff >= 50 ) {
        var_dump("tu es loin");
    }
    if($diff > 100) {
        var_dump("tu es très loin");
    }
    if($diff < 25 && $diff > 10) {
        var_dump("tu chauffes vraiment");
    }
    if($diff < 10) {
        var_dump("t'es en feu omg");
    }
    if ($diff > 200) {
        var_dump("t'es gelé bro");
    }

}

if($valUtil == $nbAleatoire) {
    var_dump("Bien joué !");
    var_dump("nombre d'éssai : ".$nbEssai);
}
