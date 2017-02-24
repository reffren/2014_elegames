<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Радиоуправляемые модели игрушек';
require_once('navmenu.php');


require_once('other.php');
require_once('products.php');
ob_end_flush();
require_once('footer.php');
?>