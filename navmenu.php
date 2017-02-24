<div id=all>
<div id="top">
<table id="tabletop" summary="В этой таблице находится информация">
<tr>
<td rowspan="2" id="logo"><a href = "index.php"><img src= "images/wew.gif"/></a></td>
<?php       
if (isset($_SESSION['name'])) { 
echo '<td id="hiuser"><h3>Здравствуйте,'.' '.$_SESSION['name'] .'</h3></td>';
echo '<td class="bottom"><a href="shoppingcart.php"><img src= "images/cart.gif"/>Корзина</a></td>';
echo '<td class="bottom"><a href="profile.php">Личный кабинет</a></td>';
echo '<td class="bottom"><a href="logout.php">Выход</a></td>';
echo '</tr>';
echo '<tr>';
echo '<td  colspan="4" id="phone"><h2>8(843)240-46-23</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<div id="info">';
echo '<table>';
echo '<tr>';
echo '<td id="title"><a href="index.php">Главная</a></td>';
echo '<td id="video"><a href="payment.php">Оплата</a></td>';
echo '<td id="help"><a href="delivery.php">Доставка</a></td>';
echo '<td id="aboutshop"><a href="about.php">О Магазине</a></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}
else {
echo '<td id="hi"><h3>Здравствуйте, Уважаемый Посетитель!</h3></td>';
echo '<td class="bottom"><a href="shoppingcart.php"><img src= "images/cart.gif"/>Корзина</a></td>';
echo '<td class="bottom"><a href="signup.php">Вход</a></td>';
echo '<tr>';
echo '<td colspan="3" id="phone"><h2>8(843)240-46-23</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<div id="info">';
echo '<table>';
echo '<tr>';
echo '<td id="title"><a href="index.php">Главная</a></td>';
echo '<td id="video"><a href="payment.php">Оплата</a></td>';
echo '<td id="help"><a href="delivery.php">Доставка</a></td>';
echo '<td id="aboutshop"><a href="about.php">О Магазине</a></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}
?>