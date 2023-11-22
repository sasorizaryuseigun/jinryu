<?php
if (!isset($_SESSION["id"])) {
    $url=$path.'login/?next='.$to_path;
    foreach ($_GET as $key => $get)
    $url= $url.'&'.$key.'='.$get;
    header('Location:'.$url,true);
    exit;
}
?>