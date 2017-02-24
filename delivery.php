<?php
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Доставка';
require_once('navmenu.php');

?>
<div id="delivery">
<table id="deliverytable">
<tr>
<td>
<h2>Доставка по г. Казань</h2>
</td>
</tr>
<tr>
<td>
<h3 id="deliveryh">Стоимость доставки по г. Казань - 100р. Время доставки вы можете уточнить в комментарии к заказу. При заказе на сумму более 2000 рублей, достака по г. Казань осуществляется бесплатно!
Курьеры интернет-магазина могут проконсультировать Вас по вопросам работы приобретенных товаров, а также помогут в их настройке.</h3>
</td>
</tr>
</table>
</div>
<?php
require_once('footer.php');
?>