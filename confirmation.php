<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Смена пароля';
require_once('navmenu.php');
require_once('other.php');
?>
<div id="goods">
<?php
$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
$flag='';
$passkey=$_GET['passkey'];
$email=$_GET['email'];
if(isset($email)&&isset($passkey)) {
if(isset($_POST['save_pass']))  {
$query="SELECT confirm_code FROM confirm WHERE confirm_code='$passkey'";
$data=mysqli_query($dbc, $query);
if(mysqli_num_rows($data)==1) {

$password = mysqli_real_escape_string($dbc, trim($_POST['password']));
$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
if($password==$password1) {

$query2 = "UPDATE users SET pass=SHA('$password') WHERE email='$email'";
$result2 = mysqli_query($dbc, $query2);
if($result2) {
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'successfully_confirmation.php';
              header('Location: ' . $home_url);
              mysqli_close($dbc);
              exit();
}
}
else  {
$flag=1;
}
}
}
?> 
<form method="post">
    <table id="confirmation">
      <tr>
        <th colspan="2" class="orange">Смена пароля</th>
        <th></th>
      </tr>
<?php
if($flag==1) {
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пароли не совпадают</p></th>';
      echo '<th></th>';
      echo '</tr>';
}
?>
      <tr>
        <td class="th">Введите новый пароль(мин. 6 символов):<br /><input type="password" id="password" name="password" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Подтверждение нового пароля:<br /><input type="password" id="password1" name="password1" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td id="submitleft"> <input type="submit" value="Сохранить" name="save_pass" /></td>
      </tr>
    </table>
  </form>
<?php
}
?>   
</table>
</div>
<?php
mysqli_close($dbc);

ob_end_flush();
require_once('footer.php');
?>