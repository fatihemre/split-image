<?php
$AnaResimYolu = 'img/test.png';    # Import image file
$KayitKlasoru = 'img/iParts'       # Output image path
$GenislikParcaSayisi = 4           #
$YukseklikParcaSayisi = 2          #

$Output = ResimAyir($AnaResimYolu,$KayitKlasoru,$GenislikParcaSayisi,$YukseklikParcaSayisi);

Print_r($Output);

# If everything goes well, the output should be like this:
#
# array(
#
#

?>
