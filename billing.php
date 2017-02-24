<?php
include("includes/db.php");
include("includes/functions.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
$user_id = $_SESSION['user_id'];
$max=count($_SESSION['cart']);

  if(isset($_SESSION['user_id']))  {
    $query1= "SELECT customers_id FROM customers WHERE user_id='$user_id'"; //Проверяем есть ли в действительности такой пользователь.
        $data1 = mysqli_query($dbc, $query1);
      if(mysqli_num_rows($data1)==1)  { 

        $query4 = "SELECT users.name, users.email, customers.city, customers.address FROM users INNER JOIN customers USING(user_id) WHERE user_id='$user_id'";
        $data4 = mysqli_query($dbc, $query4);
    $row=mysqli_fetch_array($data4);
    $name=$row['name'];
    $email=$row['email'];
    $city=$row['city'];
    $address=$row['address'];
          if(mysqli_num_rows($data4)==1) {
            for($i=0;$i<$max;$i++){
	      $pid=$_SESSION['cart'][$i]['productid'];
	      $q=$_SESSION['cart'][$i]['qty'];
	      $price=get_price($pid);
              $query3 = "INSERT INTO orders (user_id, product_id, quantity, price, buy_date, status) VALUES ('$user_id', $pid,'$q','$price', NOW(),'В ожидании')";
              $result3 = mysqli_query($dbc, $query3);
}
if($result3) {
        $to=$email;
        $from = "От кого";
        $subject="Заказ от ".$name."! на www.elegames.ru";
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=windows-1251\r\n";
        $headers .= "From: EleGames.ru <info@elegames.ru>\r\n";
        $message="<h2>Уважаемый(ая) ".$name."!</h2><br />Благодарим Вас за покупку в нашем магазине www.elegames.ru<br /> Ваш логин для входа на сайт: ".$email."<br /><h3>Cумма вашего заказа составляет ".get_order_total()." руб.</b> и в кратчайшие сроки товар будет доставлен по адресу г. ". $city .", " . $address."!</h3><br />Наши контакты: г.Казань, тел.: 8(843)240-46-23<br />С уважением, www.elegames.ru";  // Your message
        $sentmail = mail($to,$subject,$message,$headers); // send email

      
            $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'endorder.php';
            header('Location: ' . $home_url);
            mysqli_close($dbc);
 
           exit();

}
}
}
    if(isset($_POST['command']))     {  

//Если есть, идем дальше и вставляем в таблице данные о покупателе.
      $city = mysqli_real_escape_string($dbc, trim($_POST ['city']));
      $address = mysqli_real_escape_string($dbc, trim($_POST ['address']));
      $phone = mysqli_real_escape_string($dbc, trim($_POST ['phone'])); 
     if (!empty($city) && !empty($address) && !empty($phone))  {
        $query2 = "INSERT INTO customers (user_id, phone, city, address) VALUES ('$user_id','$phone','$city','$address')";
        $result2 = mysqli_query($dbc, $query2);        
        $max=count($_SESSION['cart']);  // в этом цикле мы проходимся по корзине и собираем все данные о покупках(их мб несколько) и записываем в таблицу.
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=$_SESSION['cart'][$i]['qty'];
			$price=get_price($pid);
                        $query3 = "INSERT INTO orders (user_id, product_id, quantity, price, buy_date, status) VALUES ('$user_id', $pid,'$q','$price', NOW(),'в ожидании')";
                        $result3 = mysqli_query($dbc, $query3);
       }
 
        if($result2&&$result3) {
       $query4="SELECT name, email FROM users WHERE user_id='$user_id'";
       $result4=mysqli_query($dbc, $query4);
       $row=mysqli_fetch_array($result4);
       $name=$row['name'];
       $email=$row['email'];

        $to=$email;
        $from = "От кого";
        $subject="Заказ от ".$name."! на www.elegames.ru";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=windows-1251\r\n";
        $headers .= "From: EleGames.ru <info@elegames.ru>\r\n";
        $message="<h2>Уважаемый(ая) ".$name."!</h2><br />Благодарим Вас за покупку в нашем магазине www.elegames.ru<br /> Ваш логин для входа на сайт: ".$email."<br /><h3>Cумма вашего заказа составляет ".get_order_total()." руб.</b> и в кратчайшие сроки товар будет доставлен по адресу г. ". $city .", " . $address."!</h3><br />Наши контакты: г.Казань, тел.: 8(843)240-46-23<br />С уважением, www.elegames.ru";  // Your message
        $sentmail = mail($to,$subject,$message,$headers); // send email

//Если все прошло хорошо, то переходим на страницу с результатом о заказе.
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'endorder.php';
              header('Location: ' . $home_url);
              mysqli_close($dbc);
              exit();
            }  
}

else {
$ech="Заполнены не все обязательные поля!";
}
      }

     }
		
   
else 
{
$home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'ssignup.php';
              header('Location: ' . $home_url);
mysqli_close($dbc);
              exit();
}
     

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<?php
echo '<title>' . $page_title . '</title>';
?>
    <link type="text/css" rel="stylesheet" href = "index.css" />

<script language="javascript">
	function validate(){
		var f=document.form1;
		if(f.name.value==''){
			alert('Your name is required');
			f.name.focus();
			return false;
		}
		f.command.value='update';
		f.submit();
	}
</script>
</head>


<body>
<?php 
require_once('navmenu.php');
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="hidden" name="command" />
  <div id="billing" align="center">
    <table border="0" cellpadding="2px">
      <tr>
        <th colspan="2"><p id = "errorbill"><?php echo $ech; ?></p></th>
        <th></th>
      </tr>
      <tr>
        <th colspan="2" class="orange">Информация о заказе</th>
        <th></th>
      </tr>
      <tr>
        <th colspan="2" class="th">Ваш заказ на сумму: <?=get_order_total()?> руб.</th>
        <th></th>
      </tr>
      <tr>
        <td class="th">Телефон:<br /><input type="text" id ="phon" name="phone" size="50" value="<?php echo $phone; ?>" /></td>
        <td></td>
      </tr>
      <tr>
      <tr>
        <td class="th">Город:<br /><input type="text" id ="city" name="city" size="50" value="<?php echo $city; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Адрес:<br /><input type="text" id ="address" name="address" size="50" value="<?php echo $address; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td id="submitleft"> <input type="submit" value="Оформить заказ" name="register" /></td>
      </tr>        
    </table>
  </div>
</form>
<?php
require_once('footer.php');
?>