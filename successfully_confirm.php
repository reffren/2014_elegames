<?php
ob_start();
require_once('startsession.php');
$page_title='Ссылка на страницу смены пароля выслана на ваш электроный адрес';
require_once('header.php');
include("includes/db.php");
$page_title = 'Игры и игрушки';
require_once('navmenu.php');
require_once('other.php');;
?>
<div id="goods">
<h3 id="deliveryh">Ссылка на страницу смены пароля выслана на ваш электроный адрес. Если в течение нескольких минут вы не получили письмо, пожалуйста, свяжитесь с нами.</h3>
</div>

<?php

ob_end_flush();
require_once('footer.php');
?>