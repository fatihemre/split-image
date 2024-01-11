<?php

/**
 * Split an image into multiple pieces and save them to a specified folder.
 *
 * @param string $imagePath The path to the image file.
 * @param string $saveTo The folder to save the split images to.
 * @param int $horizontalPieces The number of horizontal pieces to split the image into.
 * @param int $verticalPieces The number of vertical pieces to split the image into.
 * @return array|string An array containing the paths to the split images if successful, or a string with an error message if unsuccessful.
 */
function splitImage(string $imagePath, string $saveTo, int $horizontalPieces, int $verticalPieces): array|string
{
	$allowedMimeTypes = ['image/jpg', 'image/jpe', 'image/jpeg', 'image/gif', 'image/png'];
	if(!file_exists($imagePath)) {
		return 'The specified file does not exist!';
	}

	if(!is_writable($saveTo)) {
		return 'The destination folder is not writable!';
	}

	if(($horizontalPieces + $verticalPieces) <= 2) {
		return 'You must select a sufficient number of pieces.';
	}

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mimeType = $finfo->file($imagePath);

	if(!in_array($mimeType, $allowedMimeTypes, true)) {
		return 'MIME type can\'t be detected!';
	}

	$originalExtension = pathinfo($imagePath, PATHINFO_EXTENSION);

	$mainImage = match ($originalExtension) {
		'jpe', 'jpeg', 'jpg' => imagecreatefromjpeg($imagePath),
		'png' => imagecreatefrompng($imagePath),
		'gif' => imagecreatefromgif($imagePath),
		default => null
	};

	if(!($mainImage instanceof GdImage)) {
		return 'Please check file extension';
	}

	$imageWidth = imagesx($mainImage);
	$imageHeight = imagesy($mainImage);

	$widthPerPiece = $imageWidth / $horizontalPieces;
	$heightPerPiece = $imageHeight / $verticalPieces;

	$pieceCount = 0;
	$output = [];

	for($i=0;$i<$verticalPieces;$i++) {
		$verticalStart = $heightPerPiece * $i;

		for($n=0;$n<$horizontalPieces;$n++) {
			$horizontalStart = $widthPerPiece * $n;

			$image = imagecrop($mainImage, [
				'x' => $horizontalStart,
				'y' => $verticalStart,
				'width' => $widthPerPiece,
				'height' => $heightPerPiece
			]);

			if($image !== false) {
				$output[$pieceCount] = $saveTo . DIRECTORY_SEPARATOR . time() . '_' . $pieceCount.'.'.$originalExtension;
				match ($originalExtension) {
					'jpg', 'jpeg', 'jpe' => imagejpeg($image, $output[$pieceCount]),
					'png' => imagepng($image, $output[$pieceCount]),
					'gif' => imagegif($image, $output[$pieceCount])
				};
				$pieceCount++;
				imagedestroy($image);
			}
		}
	}

	return $output;
}
