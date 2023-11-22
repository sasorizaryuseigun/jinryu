<?php
session_start();
$path='./';
$to_path='/';
require($path.'include/logincheck.php');
$command='main/.Jinryu_cache/Scripts/python.exe main/hub_cache.py '.$_GET['no'].' '.$_GET['lat'].' '.$_GET['lon'].' '.$_GET['rad'].' '.$_SESSION['id'];
exec($command,$output);
echo $output[0];
?>