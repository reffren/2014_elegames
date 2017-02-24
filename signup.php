<?php
include("includes/db.php");
$page_title = '�����������';
$error_msg = "";
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
if(!isset($_SESSION['user_id']))  {
    if(isset($_POST['entrance']))  {
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
      $entlogin = mysqli_real_escape_string($dbc, trim($_POST ['entlogin']));
      $password = mysqli_real_escape_string($dbc, trim($_POST ['password']));
        if(!empty($entlogin) && !empty($password)) {
          $query = "SELECT user_id, name, email FROM users WHERE email = '$entlogin' AND pass = SHA('$password')";
          mysqli_query($dbc,"SET NAMES 'cp1251'");         
          $data = mysqli_query($dbc, $query);
            if(mysqli_num_rows($data)==1) {
              $row = mysqli_fetch_array($data);
              $_SESSION['user_id'] = $row['user_id'];
              $_SESSION['name'] = $row['name'];
              setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
              setcookie('name', $row['name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
              $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
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
  $regex = '/^\d{6}/';
 
  if(!empty($name) && !empty($email) && !empty($password1) && !empty($password2)) {
   if($password1==$password2) {
    if(preg_match($regex, $password1)) {
    $query = "SELECT * FROM users WHERE email = '$email'";
    $data = mysqli_query($dbc, $query);
    if (mysqli_num_rows($data) == 0) {
    $query = "INSERT INTO users (name, email, pass, getnews) VALUES ('$name', '$email', SHA('$password1'), '$getnews')";
    $result = mysqli_query($dbc, $query);
     
      if($result)  {
        $to=$email;
        $from = "�� ����";
        $subject="����������� � �������� �������� ���������������� ������� elegames.ru!";
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=windows-1251\r\n";
        $headers .= "From: EleGames.ru <info@elegames.ru>\r\n";
        $message="<h2>������������, ".$name."!</h2><br />���������� ��� �� ����������� � ����� �������� www.elegames.ru<br /> ��� ����� ��� ����� �� ����: ".$email."<br />���� ��������: �.������, ���.: 8(843)240-46-23<br />� ���������, www.elegames.ru";  // Your message
        $sentmail = mail($to,$subject,$message,$headers); // send email
      }
}
        else {
         $els = 4;
}   

        if (mysqli_num_rows($data) == 0) {
        $query2 = "SELECT user_id, name FROM users WHERE email = '$email'";
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
$els = 5;
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
        <th colspan="2" class="orange">��� ������������������ �������������.</th>
        <th></th>
      </tr>
<?php
switch($els1) {
case 1:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">������ �� ����� ��� ������������ �� ����������</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 2:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">���������� ������ ����� � ������</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
default:
}
?>
      <tr>
        <th colspan="2" class="th">������� ����� � ������ ��� �����.</th>
        <th></th>
      </tr>
      <tr>
        <td colspan="2" class="th">����� (��. �����):<br /><input type="text" id ="entlogin" name="entlogin" size="50" value="<?php echo $entlogin; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="2" class="th">������:<br /><input type="password" id="password" name="password" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td id="submitright"> <input type="submit" name="entrance" value="�����"/></td>
        <td id="forgetpass"><a href="forget_password.php">������ ������?</a></td>
      </tr>
    </table>
  </form>
</div> 

<div id="signup">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <table>
      <tr>
        <th colspan="2" class="orange">����������� ������ ������������</th>
        <th></th>
      </tr>
<?php
switch($els) {
case 1:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">������ �� ���������!</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 2:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">-��������� �� ��� ������������ ����!</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 3:
      echo '<tr>';
      echo '<th colspan="2" class="th">����������, ��������� ��� ���� ��� �����������.<b class="star">*</b></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 4:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">������ ����� ����������� ����� ���������������</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
case 5:
      echo '<tr>';
      echo '<th colspan="2"><p class = "error">������ ������ �������� ����� ��� �� 6 ��������</p></th>';
      echo '<th></th>';
      echo '</tr>';
break;
default:
} 

?>
      <tr>
        <td class="th"><b class="star">*</b>���:<br /><input type="text" id ="name" name="name" size="50" value="<?php echo $name; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th"><b class="star">*</b>E-mail (������������ ��� ����� � �������):<br /><input type="text" id ="email" name="email" size="50" value="<?php echo $email; ?>" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th"><b class="star">*</b>������ (���. 6 ��������):<br /><input type="password" id="password1" name="password1" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class="th"><b class="star">*</b>������������� ������:<br /><input type="password" id="password2" name="password2" size="50" /></td>
        <td></td>
      </tr>
      <tr>
        <td class ="th"><input type="checkbox" name="getnews" value="1" checked />�������� ������� ��������-��������</td>
      </tr>
      <tr>
        <td id="submitleft"> <input type="submit" value="������������������" name="register" /></td>
      </tr>
    </table>
  </form>
</div> 

<?php
  require_once('footer.php');
?>