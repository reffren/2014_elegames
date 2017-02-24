<?php
$page_title = 'Авторизация';
$error_msg = "";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if(!isset($_SESSION['user_id']))  {
    if(isset($_POST['entrance']))  {
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
      $entlogin = mysqli_real_escape_string($dbc, trim($_POST ['entlogin']));
      $password = mysqli_real_escape_string($dbc, trim($_POST ['password']));
        if(!empty($entlogin) && !empty($password)) {
          $query = "SELECT user_id, name, email FROM users WHERE email = '$entlogin' AND pass = SHA('$password')";
          $data = mysqli_query($dbc, $query);
            if(mysqli_num_rows($data)==1) {
              $row = mysqli_fetch_array($data);
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['name'] = $row['name'];
              setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
              setcookie('name', $row['name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
              header('Location: ' . $home_url);
              mysqli_close($dbc);
              exit();
            }  
            else  {
              $els1 = 1;
            }
          
          }
            else  {
              $els1 = 2;
            }
        }
}

if(isset($_POST['register'])) {

  $name = mysqli_real_escape_string($dbc, trim($_POST ['name']));
  $email = mysqli_real_escape_string($dbc, trim($_POST ['email']));
  $password1 = mysqli_real_escape_string($dbc, trim($_POST ['password1']));
  $password2 = mysqli_real_escape_string($dbc, trim($_POST ['password2']));
  $getnews = mysqli_real_escape_string($dbc, trim($_POST ['getnews']));


  if(!empty($name) && !empty($email) && !empty($password1) && !empty($password2)) {
  if($password1==$password2) {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 0) {
    $query = "INSERT INTO users (name, email, pass, getnews) VALUES ('$name', '$email', SHA('$password1'), '$getnews')";
    $result = mysqli_query($dbc, $query);
     
      if($result)  {
        $to=$email;
        $subject="Your confirmation link here";
        $header="from: your name <your email>";  //from
        $message="Your Comfirmation link \r\n";  // Your message
        $message.="Click on this link to activate your account \r\n";
        $message.="http://www.elegames.ru/confirmation.php?passkey=$confirm_code";
        $sentmail = mail($to,$subject,$message,$header); // send email
      }
}
        else {
         $els = 4;
}   
//if для того, чтобы не заходил на главную, как зареганный юзер
        if (mysqli_num_rows($data) == 0) {
        $query2 = "SELECT user_id, name FROM users WHERE name = '$name'";
        $data2 = mysqli_query($dbc, $query2);

        if (mysqli_num_rows($data2) == 1) {

          $row = mysqli_fetch_array($data2); 
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['name'] = $row['name'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
          setcookie('name', $row['name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
          header('Location: ' . $home_url);



    mysqli_close($dbc);
    exit();
  }
}
}
else {
$els = 1;
   }
}
   else {
$els = 2;
   }
}
   else {
$els = 3;
   }

mysqli_close($dbc);
require_once('header.php');
require_once('navmenu.php');
?>
<div id="entrance">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
      <tr>
        <th colspan="2" class="orange">Для зарегистрированных пользователей.</th>
        <th></th>
      </tr>
<?php
switch($els1) {
case 1:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пользователь не существует</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 2:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Необходимо ввести логин и пароль</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
default:
}
?>
      <tr>
        <th colspan="2" class="th">Введите логин и пароль для входа.</th>
        <th></th>
      </tr>
      <tr>
        <td colspan="2" class="th">Логин (Эл. почта):<br /><input type="text" id ="entlogin" name="entlogin" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2" class="th">Пароль:<br /><input type="password" id="password" name="password" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Забыли пароль?</td>
        <td id="submitright"> <input type="submit" name="entrance" value="Войти"/></td>
      </tr>
    </table>
  </form>
</div> 

<div id="signup">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
      <tr>
        <th colspan="2" class="orange">Регистрация нового пользователя</th>
        <th></th>
      </tr>
<?php
switch($els) {
case 1:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Пароли не совпадают!</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 2:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">-Заполнены не все обязательные поля!</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 3:
      echo '<tr>';
      echo '<th colspan="2" class="th">Пожалуйста, заполните все поля для регистрации.</th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 4:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">Данный адрес электронной почты зарегистрирован</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
default:
} 

?>
      <tr>
        <td class="th">Имя:<br /><input type="text" id ="name" name="name" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">E-mail (используется для входа в магазин):<br /><input type="text" id ="email" name="email" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Пароль (мин. 6 символов):<br /><input type="password" id="password1" name="password1" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Подтверждение пароля:<br /><input type="password" id="password2" name="password2" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class ="th"><input type="checkbox" name="getnews" value="1" checked />Получать новости интернет-магазина</td>
      </tr>
      <tr>
        <td id="submitleft"> <input type="submit" value="Зарегистрироваться" name="register" /></td>
      </tr>
      <tr>
        <td class="th">Телефон:<br /><input type="text" id ="name" name="phone" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Город:<br /><input type="text" id ="name" name="city" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th">Адрес:<br /><input type="text" id ="name" name="address" size="50" /></td>
        <td></td>
      </tr>
    </table>
  </form>
</div> 

<?php
  require_once('footer.php');
?>