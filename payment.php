<?php
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Оплата';
require_once('navmenu.php');

?>
<div id="delivery">
<table id="deliverytable">
<tr>
<td>
<h2>Оплата</h2>
</td>
</tr>
<tr>
<td>
<h3 id="deliveryh">Сделать заказ в нашем интернет-магазине можно, заполнив форму заказа на сайте или позвонив по телефону: <b class="color_orange">8(843)240-46-23.</b></h3>
</td>
</tr>
<tr>
<td>
<h2>Оплата наличными</h2>
</td>
</tr>
<tr>
<td>
<h3 id="deliveryh">Оплата осуществляется наличными курьеру при получении заказа. Оплата принимается только в российских рублях.</h3>
</td>
</tr>
</table>
</div>
<?php
require_once('footer.php');
?>