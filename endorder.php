<?php
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Информация о заказе';
require_once('navmenu.php');
include("includes/functions.php");
?>
<div id="endorder">
<?php

$user_id=$_SESSION['user_id'];
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
$query="SELECT city, address FROM customers WHERE user_id = '$user_id'";
$data=mysqli_query($dbc, $query);
$row=mysqli_fetch_array($data);
$city = $row['city'];
$address = $row['address'];
if(mysqli_num_rows($data) == 1) {
$max=count($_SESSION['cart']);
                                       for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
}			
echo '<h2 id="endorderh"><b class="color_orange">Благодарим Вас за покупку!</b> Cумма вашего заказа составляет <b class="color_orange">'.get_order_total().' руб.</b> и в кратчайшие сроки товар будет доставлен по адресу<b class="color_orange"> г. '. $city .', ' . $address.'!</b></h2>';

}
$_SESSION['cart']=array();
$email = 'reffren@mail.ru';
        $to=$email;
        $from = "От кого";
        $subject="ЗАКАЗ elegames.ru!";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=windows-1251\r\n";
        $headers .= "From: EleGames.ru <info@elegames.ru>\r\n";
        $message="Произведен заказ!";  // Your message
        $sentmail = mail($to,$subject,$message,$headers); // send email
echo '</div>';
require_once('footer.php');
?>