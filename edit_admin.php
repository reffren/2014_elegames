<?php
include("includes/authorize.php");
ob_start();
require_once('startsession.php');
require_once('header.php');
include("includes/db.php");
include("includes/image_name.php");
require_once('navmenu.php');
require_once('other.php');

$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");


if(isset($_POST['productid']))  {
$id=mysqli_real_escape_string($dbc, trim($_POST['productid']));
$query01="SELECT* FROM products WHERE product_id='$id'";
$result01=mysqli_query($dbc, $query01);
$row01=mysqli_fetch_array($result01);
$num_category=$row01['category_id'];
$name=$row01['name'];
$description=$row01['description'];
$price=$row01['price'];
$pic1=$row01['picture'];
$query02="SELECT* FROM product_subcategory WHERE product_id='$id'";
$result02=mysqli_query($dbc, $query02);
$row02=mysqli_fetch_array($result02);
$num_subcategory=$row02['subcategory_id'];
$num_subcategory2=$row02['subcategory_id'];

$query03="SELECT* FROM haracteristiki WHERE product_id='$id'";
$result03=mysqli_query($dbc, $query03);
$row03=mysqli_fetch_array($result03);
$t1=$row03['first'];
$o1=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t2=$row03['first'];
$o2=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t3=$row03['first'];
$o3=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t4=$row03['first'];
$o4=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t5=$row03['first'];
$o5=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t6=$row03['first'];
$o6=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t7=$row03['first'];
$o7=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t8=$row03['first'];
$o8=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t9=$row03['first'];
$o9=$row03['second'];
$row03=mysqli_fetch_array($result03);
$t10=$row03['first'];
$o10=$row03['second'];

$query04="SELECT* FROM komplect WHERE product_id='$id'";
$result04=mysqli_query($dbc, $query04);
$row04=mysqli_fetch_array($result04);
$k1=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k2=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k3=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k4=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k5=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k6=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k7=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k8=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k9=$row04['kompl'];
$row04=mysqli_fetch_array($result04);
$k10=$row04['kompl'];

$query05="SELECT* FROM description WHERE product_id='$id'";
$result05=mysqli_query($dbc, $query05);
$row05=mysqli_fetch_array($result05);
$describe=$row05['descript'];

$query06="SELECT* FROM img WHERE product_id='$id'";
$result06=mysqli_query($dbc, $query06);
$row06=mysqli_fetch_array($result06);
$pic2=$row06['img1'];
$img3=$row06['img2'];

$query07="SELECT* FROM img_other WHERE product_id='$id'";
$result07=mysqli_query($dbc, $query07);
$row07=mysqli_fetch_array($result07);
$img4=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img5=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img6=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img7=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img8=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img9=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img10=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img11=$row07['img'];
$row07=mysqli_fetch_array($result07);
$img12=$row07['img'];

}


if(isset($_POST['save']))  {

$name=mysqli_real_escape_string($dbc, trim($_POST['name']));
$description=mysqli_real_escape_string($dbc, trim($_POST['description']));
$price=mysqli_real_escape_string($dbc, trim($_POST['price']));
$num_category=mysqli_real_escape_string($dbc, trim($_POST['num_category']));
$num_subcategory=mysqli_real_escape_string($dbc, trim($_POST['num_subcategory']));
$num_subcategory2=mysqli_real_escape_string($dbc, trim($_POST['num_subcategory2']));



$t1=mysqli_real_escape_string($dbc, trim($_POST['t1']));
$o1=mysqli_real_escape_string($dbc, trim($_POST['o1']));
$t2=mysqli_real_escape_string($dbc, trim($_POST['t2']));
$o2=mysqli_real_escape_string($dbc, trim($_POST['o2']));
$t3=mysqli_real_escape_string($dbc, trim($_POST['t3']));
$o3=mysqli_real_escape_string($dbc, trim($_POST['o3']));
$t4=mysqli_real_escape_string($dbc, trim($_POST['t4']));
$o4=mysqli_real_escape_string($dbc, trim($_POST['o4']));
$t5=mysqli_real_escape_string($dbc, trim($_POST['t5']));
$o5=mysqli_real_escape_string($dbc, trim($_POST['o5']));
$t6=mysqli_real_escape_string($dbc, trim($_POST['t6']));
$o6=mysqli_real_escape_string($dbc, trim($_POST['o6']));
$t7=mysqli_real_escape_string($dbc, trim($_POST['t7']));
$o7=mysqli_real_escape_string($dbc, trim($_POST['o7']));
$t8=mysqli_real_escape_string($dbc, trim($_POST['t8']));
$o8=mysqli_real_escape_string($dbc, trim($_POST['o8']));
$t9=mysqli_real_escape_string($dbc, trim($_POST['t9']));
$o9=mysqli_real_escape_string($dbc, trim($_POST['o9']));
$t10=mysqli_real_escape_string($dbc, trim($_POST['t10']));
$o10=mysqli_real_escape_string($dbc, trim($_POST['o10']));

$first=array($t1,$t2,$t3,$t4,$t5,$t6,$t7,$t8,$t9,$t10);  //Помещаем в массив данные из формы
$second=array($o1,$o2,$o3,$o4,$o5,$o6,$o7,$o8,$o9,$o10); 

$k1=mysqli_real_escape_string($dbc, trim($_POST['k1']));
$k2=mysqli_real_escape_string($dbc, trim($_POST['k2']));
$k3=mysqli_real_escape_string($dbc, trim($_POST['k3']));
$k4=mysqli_real_escape_string($dbc, trim($_POST['k4']));
$k5=mysqli_real_escape_string($dbc, trim($_POST['k5']));
$k6=mysqli_real_escape_string($dbc, trim($_POST['k6']));
$k7=mysqli_real_escape_string($dbc, trim($_POST['k7']));
$k8=mysqli_real_escape_string($dbc, trim($_POST['k8']));
$k9=mysqli_real_escape_string($dbc, trim($_POST['k9']));
$k10=mysqli_real_escape_string($dbc, trim($_POST['k10']));

$kompl=array($k1,$k2,$k3,$k4,$k5,$k6,$k7,$k8,$k9,$k10);

$desc=mysqli_real_escape_string($dbc, trim($_POST['describe']));


$ava=$_FILES['ava']['name']; //извлекаем файл из формы
$target=GW_UPLOADPATH.$ava; //ссылка на папку img

if(move_uploaded_file($_FILES['ava']['tmp_name'],$target) /* здесь перемещаем картинку из временного хранилища в папку img */ && isset($name)&&isset($description)&&isset($price)&&isset($num_category)&&isset($num_subcategory)) {
$query="UPDATE products SET category_id='$num_category', name='$name', description='$description', price='$price', picture=$target WHERE product_id='$id'";
$result=mysqli_query($dbc, $query);
$query2="SELECT product_id FROM products WHERE picture='$target'";
$result2=mysqli_query($dbc, $query2);
$row=mysqli_fetch_array($result2);
$product_id=$row['product_id'];
$query3="INSERT INTO product_subcategory(product_id, subcategory_id) VALUES('$product_id','$num_subcategory')";
$result3=mysqli_query($dbc, $query3);
if(isset($num_subcategory2))  {
$query4="INSERT INTO product_subcategory(product_id, subcategory_id) VALUES('$product_id','$num_subcategory2')";
$result4=mysqli_query($dbc, $query4);
}
for($i=0; $i<10; $i++) { // тут мы вносим данные в бд с полей техн характеристики с массива
 if($first[$i] && $second[$i]) {
  $query5="INSERT INTO haracteristiki(product_id, first, second) VALUES('$product_id','$first[$i]','$second[$i]')";
  $result5=mysqli_query($dbc, $query5);
 }
}
for($i=0; $i<10; $i++) { // тут мы вносим данные в бд с полей комплектация с массива
 if($kompl[$i]) {
  $query6="INSERT INTO komplect(product_id, kompl) VALUES('$product_id','$kompl[$i]')";
  $result6=mysqli_query($dbc, $query6);
 }
}
if($desc) { // тут мы вводим данные с поля описание
  $query7="INSERT INTO description(product_id, descript) VALUES ('$product_id','$desc')";
  $result7=mysqli_query($dbc, $query7);
}

$img1=$_FILES['img1']['name']; //извлекаем файл из формы
$target11=GW_UPLOADPATH.$img1; //ссылка на папку img
$img2=$_FILES['img2']['name']; //извлекаем файл из формы
$target22=GW_UPLOADPATH.$img2; //ссылка на папку img

if(move_uploaded_file($_FILES['img1']['tmp_name'],$target11) /* здесь перемещаем картинку из временного хранилища в папку img */ & move_uploaded_file($_FILES['img2']['tmp_name'],$target22)) { // тут мы вводим картинки описания img1 - это с шириной 400, img2 - с любым разрешением
  $query8="INSERT INTO img(product_id, img1, img2) VALUES('$product_id','$target11','$target22')";
  $result8=mysqli_query($dbc, $query8);
}

  $img3=$_FILES['img3']['name'];   // Эт имя изображения
  $img4=$_FILES['img4']['name'];
  $img5=$_FILES['img5']['name'];
  $img6=$_FILES['img6']['name'];
  $img7=$_FILES['img7']['name'];
  $img8=$_FILES['img8']['name'];
  $img9=$_FILES['img9']['name'];
  $img10=$_FILES['img10']['name'];
  $img11=$_FILES['img11']['name'];
  $img12=$_FILES['img12']['name'];


  $target3=GW_UPLOADPATH.$img3; // это полная ссылка /images/photo.jpg т.е. складываем строки
  $target4=GW_UPLOADPATH.$img4;
  $target5=GW_UPLOADPATH.$img5;
  $target6=GW_UPLOADPATH.$img6;
  $target7=GW_UPLOADPATH.$img7;
  $target8=GW_UPLOADPATH.$img8;
  $target9=GW_UPLOADPATH.$img9;
  $target10=GW_UPLOADPATH.$img10;
  $target11=GW_UPLOADPATH.$img11;
  $target12=GW_UPLOADPATH.$img12;

$t=array(3=>$target3, 4=>$target4, 5=>$target5, 6=>$target6, 7=>$target7, 8=>$target8, 9=>$target9, 10=>$target10, 11=>$target11, 12=>$target12); //здесь мы создаем массив по принципу ключ=> значение, потому что цикл и картинка начинается с 3, а массив с 0


for($j=3; $j<13; $j++) { //перебираем все картинки

   if(move_uploaded_file($_FILES['img'.$j]['tmp_name'],$t[$j])) {  //Здесь используем конкатенацию 'img'.$j(img3) т.е. складываем строки и берем значение с массива $t[$j] ($target3)
   $query9="INSERT INTO img_other(product_id, img) VALUES('$product_id', '$t[$j]')";
   $result9=mysqli_query($dbc, $query9);
   }
}

   $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . 'index.php';
   header('Location: ' . $home_url);

   mysqli_close($dbc);
   exit();
}  // Это скобка if на поля
else {

echo '<h3 class = "erroradmin">*Заполнены не все обязатльные поля!</h3>';
}
} // Эта скобка кнопки



?>
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<b class="staradmin">*</b><b class="color_orange">Обязательные поля для заполнения</b>
<table>
  <tr>
    <td><b class="staradmin">*</b><b class="color_orange">Название товара</b><br /><input type="text" name="name" value="<?php echo $name; ?>" size="30" /></td>
    <td><b class="staradmin">*</b><b class="color_orange">Описание товара</b><br /><input type="text" name="description" value="<?php echo $description; ?>" size="30" /></td>
    <td><b class="staradmin">*</b><b class="color_orange">Цена</b><br /><input type="text" name="price" value="<?php echo $price; ?>" size="30" /></td>
    <td><img src="<?php echo $pic1; ?>" height="100" width="100"><br /><b class="error"> Для аватарки горизонт должен быть 200px(200x200)</b><br /><b class="staradmin">*</b><input type="file" id="ava" name="ava" /></td>
  </tr>
  <tr>
    <td><b class="color_orange"><br /><b class="staradmin">*</b>Номер категории</b><br /><input type="text" name="num_category" value="<?php echo $num_category; ?>" size="30" /></td>
    <td><b class="color_orange"><br /><b class="staradmin">*</b>Номер подкатегории</b><br /><input type="text" name="num_subcategory" value="<?php echo $num_subcategory; ?>" size="30" /></td>
    <td><b class="color_orange"><b class="staradmin">*</b>Второй номер подкатегории(если есть)</b><br /><input type="text" name="num_subcategory2" value="<?php echo $num_subcategory2; ?>" size="30" /></td>
    <td><b class="color_orange"><a href="categoryforadmin.php">Воспользуйтесь справкой </a>по категориям</b><br /></td>
</table>
  <div id="to">
  <table> 
    <tr>
      <td class="color_orange" colspan="2"><h3>Технические характеристики</h3></td>
    </tr>  
    <tr>
      <td><input type="text" id="text" name="t1" value="<?php echo $t1; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o1" value="<?php echo $o1; ?>" size="50" /></td>
    </tr>  
    <tr>
      <td><input type="text" id="text" name="t2" value="<?php echo $t2; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o2" value="<?php echo $o2; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t3" value="<?php echo $t3; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o3" value="<?php echo $o3; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t4" value="<?php echo $t4; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o4" value="<?php echo $o4; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t5" value="<?php echo $t5; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o5" value="<?php echo $o5; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t6" value="<?php echo $t6; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o6" value="<?php echo $o6; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t7" value="<?php echo $t7; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o7" value="<?php echo $o7; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t8" value="<?php echo $t8; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o84" value="<?php echo $o84; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t9" value="<?php echo $t9; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o9" value="<?php echo $o9; ?>" size="50" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="t10" value="<?php echo $t10; ?>" size="20" /></td>
      <td><input type="text" id="text" name="o10" value="<?php echo $o10; ?>" size="50" /></td>
    </tr>
    <tr>
      <td colspan="2"><img src="<?php echo $pic2; ?>" height="100" width="100"><br /><b class="error">Для картинки горизонт должен быть 400px!</b><br /><b class="staradmin">*</b><input type="file" id="img1" name="img1" size="20" /></td>
    </tr>
  </table>
</div>
<div id="k">
  <table>
    <tr>  
      <td class="color_orange"><h3>Комплектация</h3></td>
    </tr>  
    <tr>
      <td><input type="text" id="text" name="k1" value="<?php echo $k1; ?>" size="30" /></td>
    </tr>  
    <tr>
      <td><input type="text" id="text" name="k2" value="<?php echo $k2; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k3" value="<?php echo $k3; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k4" value="<?php echo $k4; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k5" value="<?php echo $k5; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k6" value="<?php echo $k6; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k7" value="<?php echo $k7; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k8" value="<?php echo $k8; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k9" value="<?php echo $k9; ?>" size="30" /></td>
    </tr>
    <tr>
      <td><input type="text" id="text" name="k10" value="<?php echo $k10; ?>" size="30" /></td>
    </tr>
  </table>
</div>
  <table>
    <tr>
      <td class="color_orange"><b>Описание</b><br /><textarea name="describe" rows="5" cols="89"><?php echo $describe; ?></textarea></td>
    </tr>
  </table>
<table id="adsave">
  <tr>
    <td><b class="error">Допускаются картинки любого разрешения!</b><br /><b class="staradmin">*</b><input type="file" id="img2" name="img2" /></td>
  </tr>
  <tr>
    <td><input type="file" id="img3" name="img3" /><img src="<?php echo $img3; ?>" height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img4" name="img4" /><img src="<?php echo $img4; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img5" name="img5" /><img src="<?php echo $img5; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img6" name="img6" /><img src="<?php echo $img6; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img7" name="img7" /><img src="<?php echo $img7; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img8" name="img8" /><img src="<?php echo $img8; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img9" name="img9" /><img src="<?php echo $img9; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img10" name="img10" /><img src="<?php echo $img10; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img11" name="img11" /><img src="<?php echo $img11; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td><input type="file" id="img12" name="img12" /><img src="<?php echo $img12; ?>"height="100" width="100"></td>
  </tr>
  <tr>
    <td id="adsave2"><input type="submit" value="Сохранить" name="save" /></td>
  </tr>
</table>
</form>

<?php
  require_once('footer.php');
?>