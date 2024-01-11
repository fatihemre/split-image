<?php

include("function.php");

$mainImage = dirname(__DIR__) . '/img/example.png';
$outputFolder = dirname(__DIR__) . '/img/parts';

$horizontalPieces = 4;
$verticalPieces = 2;

$output = splitImage($mainImage, $outputFolder, $horizontalPieces, $verticalPieces);

print_r($output);

/**
 * Output:
 *
 * Array
 * (
 *      [0] => img/iParts/1704902429_0.png
 *      [1] => img/iParts/1704902429_1.png
 *      [2] => img/iParts/1704902429_2.png
 *      [3] => img/iParts/1704902429_3.png
 *      [4] => img/iParts/1704902429_4.png
 *      [5] => img/iParts/1704902429_5.png
 *      [6] => img/iParts/1704902429_6.png
 *      [7] => img/iParts/1704902429_7.png
 * )
 */