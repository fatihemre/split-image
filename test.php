<?php

include("function.php"); # Call php image split function file

$AnaResimYolu = 'img/test.png';   # Import image file
$KayitKlasoru = 'img/iParts'      # Output image path
$GenislikParcaSayisi = 4;         #
$YukseklikParcaSayisi = 2;        #

$Output = ResimAyir($AnaResimYolu,$KayitKlasoru,$GenislikParcaSayisi,$YukseklikParcaSayisi);

echo '<pre>';
Print_r($Output);
echo '</pre>';





# If everything goes well, the output should be like this:
/*

Array
(
    [0] => img/iParts/1704902429_0.png     # Image file 1
    [1] => img/iParts/1704902429_1.png     # Image file 2
    [2] => img/iParts/1704902429_2.png     # Image file 3
    [3] => img/iParts/1704902429_3.png     # Image file 4
    [4] => img/iParts/1704902429_4.png     # Image file 5
    [5] => img/iParts/1704902429_5.png     # Image file 6
    [6] => img/iParts/1704902429_6.png     # Image file 7
    [7] => img/iParts/1704902429_7.png     # Image file 8
    [KesiSayisi] => 8                      # Total number of divided images
)

*/

?>
