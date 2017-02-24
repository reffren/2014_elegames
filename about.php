<?php
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'О магазине радиоуправляемых игрушек';
require_once('navmenu.php');

?>
<div id="delivery">
<table id="deliverytable">
<tr>
<td>
<h2>О Нас</h2>
</td>
</tr>
<tr>
<td>
<h3 id="deliveryh">Магазин <b class="ele">Ele</b><b class="color_orange">Games</b> - это магазин электронных и радиоуправляемых моделей игрушек, где представлен широкий ассортимент продукции. Мы хотим, чтобы вы и ваши близкие приобщались вместе с нами к различным моделям игрушек.
 А если вы купили радиоуправляемую модель ребенку, то этой покупке будет рад не только он, но и вы, потому что это воистину захватывающе, так что не теряйте времени и <a href="index.php" class="color_orange">присоединяйтесь!</a></h3>
</td>
</tr>
</table>
</div>
<?php
require_once('footer.php');
?>