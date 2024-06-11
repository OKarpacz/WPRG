<?php
require_once "autoClass.php";
//Test
$auto = new Ubezpieczenie("BMW", 123442, 4, 1, 350, 0.06, 0.15, 11);
echo $auto ->obliczCene();
?>