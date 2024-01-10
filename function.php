Function ResimAyir($AnaResimYolu,$KayitKlasoru,$GenislikParcaSayisi,$YukseklikParcaSayisi) {
	
	$KayitKlasoru = str_replace("\\","/",$KayitKlasoru);
	$AnaResimYolu = str_replace("\\","/",$AnaResimYolu);
	
	if (substr($KayitKlasoru, -1) == "/" || substr($KayitKlasoru, -1) == "\\") {
		$KayitKlasoru = rtrim($KayitKlasoru,"/");
		$KayitKlasoru = rtrim($KayitKlasoru,"\\");
	}
	
	
	if (!file_exists($AnaResimYolu))
		return "The specified file does not exist!";

	$DosyaUzantisi = pathinfo($AnaResimYolu, PATHINFO_EXTENSION);
	$KesiSayisi = 0;
	$AnaResim;
	
	if (empty($DosyaUzantisi))
		return "Please define a valid image file.";

	switch ($DosyaUzantisi){
	case 'png':
		$AnaResim = imagecreatefrompng($AnaResimYolu);
		break;

	case 'jpeg':
	case 'jpg':
		$AnaResim = imagecreatefromjpeg($AnaResimYolu);
		break;

	case 'gif':
		$AnaResim = imagecreatefromgif($AnaResimYolu);
		break;
	}

	$Yukseklik 	= imagesy($AnaResim);
	$Genislik 	= imagesx($AnaResim);

	$GenislikParcaTaneBoyutu 	= $Genislik / $GenislikParcaSayisi;
	$YukseklikParcaTaneBoyutu 	= $Yukseklik / $YukseklikParcaSayisi;

	if (($GenislikParcaSayisi+$YukseklikParcaSayisi) <= 2) {
		return "You must select a sufficient number of pieces.";
	} else {
		for ($i=0;$i<$YukseklikParcaSayisi;$i++) {
			$DikeyKesi = $YukseklikParcaTaneBoyutu * $i;
			
			for ($e=0;$e<$GenislikParcaSayisi;$e++) {
				$YatayKesi =  $GenislikParcaTaneBoyutu * $e;
				
				$im2 = imagecrop($AnaResim, ['x' => $YatayKesi, 'y' => $DikeyKesi, 'width' => $GenislikParcaTaneBoyutu, 'height' => $YukseklikParcaTaneBoyutu]);
				
				if ($im2 !== FALSE) {
					$Cikti[$KesiSayisi] = "$KayitKlasoru/".time()."_$KesiSayisi.".$DosyaUzantisi;
					imagejpeg($im2, $Cikti[$KesiSayisi]);
					$KesiSayisi++;
					imagedestroy($im2);
				}
			}
		}
	}

	$Cikti["KesiSayisi"] = $KesiSayisi;
	
	imagedestroy($AnaResim);
	return $Cikti;
}
