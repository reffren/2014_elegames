<?php
ob_start();
require_once('startsession.php');
$page_title='������ �� �������� ����� ������ ������� �� ��� ���������� �����';
require_once('header.php');
include("includes/db.php");
$page_title = '���� � �������';
require_once('navmenu.php');
require_once('other.php');;
?>
<div id="goods">
<h3 id="deliveryh">������ �� �������� ����� ������ ������� �� ��� ���������� �����. ���� � ������� ���������� ����� �� �� �������� ������, ����������, ��������� � ����.</h3>
</div>

<?php

ob_end_flush();
require_once('footer.php');
?>