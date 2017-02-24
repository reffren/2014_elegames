<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Пароль успешно сохранен!';
require_once('navmenu.php');
require_once('other.php');;
header('Refresh: 2; url=http://www.elegames.ru/signup.php');
?>
<div id="goods">
<h2 class="color_orange">Ваш пароль успешно сохранен!</h2>
</div>

<?php

ob_end_flush();
require_once('footer.php');
?>