<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Ваши пароль успешно сохранен!';
require_once('navmenu.php');
require_once('other.php');;
header('Refresh: 1; url=http://www.elegames.ru/edit_profile.php');
?>
<div id="goods">
<h2 class="color_orange">Ваши пароль успешно сохранен!</h2>
</div>

<?php

ob_end_flush();
require_once('footer.php');
?>