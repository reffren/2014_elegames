<?php
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
$page_title = 'Редактирование профиля пользователя';
require_once('navmenu.php');
require_once('other.php');

$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
?>
<div id="all_edit">
<?php
if(isset($_SESSION['user_id'])) {
$user_id=$_SESSION['user_id'];
$query="SELECT user_id, name, email, pass FROM users WHERE user_id='$user_id'";
$result=mysqli_query($dbc,$query);
if(mysqli_num_rows($result))  {
$row=mysqli_fetch_array($result);
$name=$row['name'];
$email=$row['email'];
$pass=$row['pass'];
$query2="SELECT user_id, phone, city, address FROM customers WHERE user_id='$user_id'";
$result2=mysqli_query($dbc,$query2);
$row=mysqli_fetch_array($result2);
$city=$row['city'];
$address=$row['address'];
$phone=$row['phone'];

if(isset($_POST['save'])) {
  $name = mysqli_real_escape_string($dbc, trim($_POST ['name']));
  $email = mysqli_real_escape_string($dbc, trim($_POST ['email']));
  $phone = mysqli_real_escape_string($dbc, trim($_POST ['phone']));
  $city = mysqli_real_escape_string($dbc, trim($_POST ['city']));
  $address = mysqli_real_escape_string($dbc, trim($_POST ['address']));
  $getnews = mysqli_real_escape_string($dbc, trim($_POST ['getnews']));


  if(!empty($name) && !empty($email)) {
$query8="SELECT email FROM users WHERE email='$email' AND user_id != '$user_id'";
$result8 = mysqli_query($dbc, $query8);
if(mysqli_num_rows($result8)==0) {

$query3 = "UPDATE users SET name='$name', email='$email', getnews='$getnews' WHERE user_id='$user_id'";
$result3 = mysqli_query($dbc, $query3);
    $query4 = "UPDATE customers SET user_id='$user_id', phone='$phone', city='$city', address='$address' WHERE user_id='$user_id'";
    $result4 = mysqli_query($dbc, $query4);
    $_SESSION['name']=$name;
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'successfully_profile.php';
              header('Location: ' . $home_url);
              mysqli_close($dbc);
              exit();
}
else {
$flag=5;
}
}
else {
$flag=4;
}
}
}
if(isset($_POST['save_pass']))  {
  $password1 = mysqli_real_escape_string($dbc, trim($_POST ['password1']));
  $password3 = mysqli_real_escape_string($dbc, trim($_POST ['password3']));
  $password4 = mysqli_real_escape_string($dbc, trim($_POST ['password4']));
if(!empty($password1) && !empty($password3) && !empty($password4)) {
$query5="SELECT pass FROM users WHERE pass=SHA('$password1') AND user_id='$user_id'";
$result5 = mysqli_query($dbc, $query5);

  if(mysqli_num_rows($result5)==1) { 
if($password3==$password4) {
$query6 = "UPDATE users SET pass=SHA('$password3') WHERE user_id='$user_id'";
$result6 = mysqli_query($dbc, $query6);
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'successfully_pass.php';
              header('Location: ' . $home_url);
              mysqli_close($dbc);
              exit();
}
else  {
$flag2=1;
}
}
else  {
$flag2=2;
}
}
else  {
$flag2=3;
}
}
?> 
<div id="edit_pass">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
      <tr>
        <th colspan="2" class="orange">Смена пароля</th>
        <th></th>
      </tr>
<?php
switch($flag2) {
case 1:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пароли не совпадают</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 2:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Старый пароль не верен</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 3:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пожалуйста, заполните все поля</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
default:
}
?>
      <tr>
        <td class="th">Введите старый пароль:<br /><input type="password" id="password1" name="password1" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Введите новый пароль(мин. 6 символов):<br /><input type="password" id="password3" name="password3" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Подтверждение нового пароля:<br /><input type="password" id="password4" name="password4" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td id="submitleft"> <input type="submit" value="Сохранить" name="save_pass" /></td>
      </tr>
    </table>
  </form>
</div>
      
<div id="edit_profile">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
      <tr>
        <th colspan="2" class="orange">Редактирование профиля</th>
        <th></th>
      </tr>
<?php
if($flag==4) {
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пожалуйста, заполните все поля обязательные для заполнения<b class="star">*</b></p></th>';
      echo '<th></th>';
      echo '</tr>';
}
if($flag==5) {
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">E-mail c таким именем уже существует<b class="star">*</b></p></th>';
      echo '<th></th>';
      echo '</tr>';
}
?>
      <tr>
        <td class="th"><b class="star">*</b>Имя:<br /><input type="text" id ="name" name="name" size="50" value="<?php echo $name; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th"><b class="star">*</b>E-mail:<br /><input type="text" id ="email" name="email" size="50" value="<?php echo $email; ?>" /></td>
        <td></td>
      </tr>
      <?php
      $query7="SELECT user_id FROM customers WHERE user_id='$user_id'";
      $result7=mysqli_query($dbc, $query7);
      if(mysqli_num_rows($result7)) {
?>
      <tr>
        <td class="th">Телефон:<br /><input type="text" id ="phon" name="phone" size="50" value="<?php echo $phone; ?>"/></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Город:<br /><input type="text" id ="city" name="city" size="50" value="<?php echo $city; ?>"/></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Адрес для доставки:<br /><input type="text" id ="address" name="address" size="50" value="<?php echo $address; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td class ="th"><input type="checkbox" name="getnews" value="1" checked />Получать новости интернет-магазина</td>
      </tr>
<?php
}
?>
      <tr>
        <td id="submitleft"> <input type="submit" value="Сохранить" name="save" /></td>
      </tr>
    </table>
  </div>
<?php
}
?>
</div>
<?php
mysqli_close($dbc);
ob_end_flush();
require_once('footer.php');
?>