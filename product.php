<?php
ob_start();
include("includes/functions.php");
require_once('startsession.php');

$page_title='Радиоуправляемая модель с видеокамерой и Wi-Fi управлением через смартфон/планшет';

require_once('header.php');
include("includes/db.php");
$page_title = 'Игры и игрушки';
require_once('navmenu.php');
require_once('other.php');


$id=$_GET['id'];
$cost=$_GET['cost'];
$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		addtocart($pid,1);
		header("location:shoppingcart.php");
		exit();
	}


$query="SELECT first, second FROM haracteristiki WHERE product_id='$id'";
$data=mysqli_query($dbc, $query);

$query2="SELECT kompl FROM komplect WHERE product_id='$id'";
$data2=mysqli_query($dbc, $query2);

$query3="SELECT descript FROM description WHERE product_id='$id'";
$data3=mysqli_query($dbc, $query3);

$query4="SELECT product_id, img1, img2 FROM img WHERE product_id='$id'";
$data4=mysqli_query($dbc, $query4);
$row4=mysqli_fetch_array($data4);

$query5="SELECT product_id, img FROM img_other WHERE product_id='$id'";
$data5=mysqli_query($dbc, $query5);


?>
<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();
	}

</script>
<div id="buy">
<form name="form1">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div id="photo">
<table>
  <tr>
    <td><img src="<?php echo $row4['img1'];?>" /></td>
  </tr>
</table>
</div>
<div id="tehn">
<table>
  <tr>
      <td id="character"><h3>Технические характеристики</h3></td>
 </tr>

<?php
echo $row['first'];
while($row=mysqli_fetch_array($data)) {
?>
    <tr>
      <ul>
      <td><li><b><?php echo $row['first'];?>:</b> <?php echo $row['second'];?></li></td>
    </tr>
<?php
}
?>
</ul>
</table>
</div>
<div id="kompl">
<table>
  <tr>
    <td><h3>Комплектация</h3></td>
 </tr>
<?php
while($row=mysqli_fetch_array($data2)) {
?>
<tr>
    <ul>
      <td><li><?php echo $row['kompl'];?></li></td>
    </tr>
<?php
}
?>
</ul>
</table>
</div>
<div id="button_har">
<table id="button">
    <tr>
      <td id="buttoncost">Цена:</td>
      <td><h2 id="h2"><?php echo $cost.' руб.';?></h2></td>
      <td><a href="#" onclick="addtocart(<?=$id?>)"><img src="images/button.gif" /></a></td> 
    </tr>
  </table>
</div>	

<?php
if($row=mysqli_fetch_array($data3)) {
echo '<div id="descript">';
echo '<table id="descripttable">';
echo '<tr>';
echo '<td><h3>Описание</h3></td>';
echo '</tr>';
echo '<tr>';
echo '<td><b id="descriptb">'. $row['descript'].'</b></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}

if($row4['img2']) {
echo '<div id="photo2">';
echo '<table>';
echo '<tr>';
echo '<td><img src='.$row4['img2'].' /></td>';
echo '</tr>';
}
while($row5=mysqli_fetch_array($data5)) {
echo '<tr>';
echo '<td><img src='.$row5['img'].' /></td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';

?>
</div>
<?php
ob_end_flush();
require_once('footer.php');
?>