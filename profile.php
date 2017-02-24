<?php
ob_start();
require_once('startsession.php');
$page_title='Профиль пользователя';
require_once('header.php');
include("includes/db.php");
require_once('navmenu.php');


require_once('other.php');
?>
<div id="goods">
<?php
$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
if(isset($_SESSION['user_id'])) {
$user_id=$_SESSION['user_id'];

$query="SELECT user_id, name, email FROM users WHERE user_id='$user_id'";
$result=mysqli_query($dbc,$query);
$row=mysqli_fetch_array($result);
$name=$row['name'];
$email=$row['email'];

$query2="SELECT user_id, phone, city, address FROM customers WHERE user_id='$user_id'";
$result2=mysqli_query($dbc,$query2);
$row=mysqli_fetch_array($result2);
$city=$row['city'];
$address=$row['address'];
$phone=$row['phone'];

?>
<table id="settings_user">
<tr>
<th colspan="5"><h2>Личные данные</h2></th>
</tr>
<tr>
<td><b>Ваше имя:</b></td>
<td><?php echo $name;?></td>
</tr>
<tr>
<td><b>E-mail:</b></td>
<td><?php echo $email;?></td>
</tr>
<tr>
<td><b>Город:</b></td>
<td><? echo $city;?></td>
</tr>
<tr>
<td><b>Адресс:</b></td>
<td><?php echo $address;?></td>
</tr>
<tr>
<td><b>Телефон:</b></td>
<td><?php echo $phone;?></td>
</tr>
<tr>
<td colspan="2"><a href="edit_profile.php">Редактировать профиль</a></td>
</tr>
</table>
<?php




$query3="SELECT orders.user_id, orders.product_id, orders.quantity, orders.price, orders.buy_date, orders.status, orders.date_get, products.product_id, products.name, products.description FROM orders INNER JOIN products USING(product_id) WHERE orders.user_id='$user_id' AND orders.order_id>=1";
$result3=mysqli_query($dbc, $query3);
if(mysqli_num_rows($result3)) {
?>
<form method="post" action=<?php echo $_SERVER['PHP_SELF']; ?>">
<table id="orders_history">
<tr>
<th colspan="7"><h2>Заказы</h2></th>
</tr>
<tr>
<th>Дата</th>
<th>Наименование</th>
<th>Описание</th>
<th>Количество</th>
<th>Цена</th>
<th>Статус</th>
<th>Дата получения</th>
</tr>
<?php
while($row=mysqli_fetch_array($result3)) {
$picture=$row['picture'];
$date=$row['buy_date'];
$name=$row['name'];
$description=$row['description'];
$quantity=$row['quantity'];
$status=$row['status'];
$price=$row['price'];
$date_get=$row['date_get'];
?>
<tr>
<td><?php echo $date;?></td>
<td><?php echo $name;?></td>
<td><?php echo $description;?></td>
<td><?php echo $quantity;?></td>
<td><?php echo $price;?></td>
<td><?php echo $status;?></td>
<td><?php echo $date_get;?></td>
</tr>
<?php
}
}

}
else {
echo '<h2 class="color_orange">Вы не можете проссматривать данные, пожалуйста <a href="signup.php">зарегистрируйтесь!</a></h2>';
}
mysqli_close($dbc);
?>
</table>
</form>
</div>
<?php


ob_end_flush();
require_once('footer.php');
?>