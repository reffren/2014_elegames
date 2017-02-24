<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Восстановление пароля';
require_once('navmenu.php');
require_once('other.php');
?>
<div id="forget">
    <table id="pass">
      <tr>
        <th colspan="2" class="orange">Восстановление пароля</th>
        <th></th>
      </tr>
<?php
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");

if(isset($_POST['send'])) {
$confirm_code=md5(uniqid(rand())); 
$email=mysqli_real_escape_string($dbc, trim($_POST['email']));
$query="SELECT name, email FROM users WHERE email='$email'";
$data=mysqli_query($dbc, $query);
if(mysqli_num_rows($data)==1) {
$row=mysqli_fetch_array($data);
$name=$row['name'];
$query2="INSERT INTO confirm (confirm_code) VALUES ('$confirm_code')";
$result= mysqli_query($dbc, $query2);
echo $name;
  if($result) {
echo $name;
        $to=$email;
        $from = "От кого";
        $subject="Смена пароля в магазине радиоуправляемых игрушек elegames.ru!";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=windows-1251\r\n";
        $headers .= "From: EleGames.ru <info@elegames.ru>\r\n";
        $message="<h2>Здравствуйте, ".$name."!</h2><br />Для восстановления пароля, пожалуйста перейдите по ссылке http://www.elegames.ru/confirmation.php?email=$email&amp;passkey=$confirm_code<br />Если вы не отправляли запрос на восстановление пароля, просто проигнорируйте это письмо.<br />Это письмо сформировано автоматически, не отвечайте на него.<br />Наши контакты: г.Казань, тел.: 8(843)240-46-23<br />С уважением, www.elegames.ru";  
        $sentmail = mail($to,$subject,$message,$headers); // send email
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'successfully_confirm.php';
        header('Location: ' . $home_url);
    mysqli_close($dbc);
    exit();
      }
}

else {
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Данный адрес электронной почты не существует</p></th>';
      echo '<th></th>';
      echo '</tr>';
      echo '</table>';
}
}
?>
   <table>
    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
      <tr>        
        <td class="th"><b>Пожалуйста, введите логин(e-mail), указанный при регистрации. Ссылка на страницу смены пароля будет выслана на ваш электронный адрес.</b></td>
      </tr>     
      <tr>        
        <td  id="em" class="th">Логин(e-mail):<br /><input type="email" id="text" name="email" size="50" /></td>
      </tr>
      <tr>
        <td  id="ems"><input type="submit" value="Отправить" name="send" /></td>
      </tr>
    </form>
  </table>
</div>
<?php
ob_end_flush();
require_once('footer.php');
?>