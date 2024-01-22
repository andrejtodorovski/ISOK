<?php
$prvaFilePath = 'files/prva.txt';
$vtoraFilePath = 'files/vtora.txt';
$rezultatFilePath = 'files/rezultat.txt';

$prvaOpener = fopen($prvaFilePath, "r");
$prvaContent = fread($prvaOpener, filesize($prvaFilePath));
$vtoraOpener = fopen($vtoraFilePath, "r");
$vtoraContent = fread($vtoraOpener, filesize($vtoraFilePath));

$rezultatOpener = fopen($rezultatFilePath, "w+");
fwrite($rezultatOpener, str_replace('-', ' ', $prvaContent));
fwrite($rezultatOpener, $vtoraContent);


fclose($prvaOpener);
fclose($vtoraOpener);
fclose($rezultatOpener);