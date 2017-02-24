<?php
include('includes/authorize.php');
ob_start();
require_once('header.php');
include('includes/db.php');
require_once('navmenu.php');
require_once('other.php');

$dbc=mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
$query="SELECT* FROM category";
$data=mysqli_query($dbc,$query);

$query2="SELECT*FROM subcategory";
$data2=mysqli_query($dbc, $query2);

echo '<div id="allcategforadmindiv">';
echo '<b><a href="admin.php">Назад к администрированию</a></b>';
echo '<div id="category_div">';
echo '<table id="category_admin">';
echo '<th colspan="2"><h3>Категории</h3></th>';
while($row=mysqli_fetch_array($data)) {
echo '<tr>';
echo '<td>'.$row['category_id'].'</td>';
echo '<td>'.$row['category_name'].'</td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '<div id="subcategory_div">';
echo '<table id="subcategory_admin">';
echo '<th colspan="2"><h3>Подкатегории</h3></th>';
while($row=mysqli_fetch_array($data2)) {
echo '<tr>';
echo '<td>'.$row['subcategory_id'].'</td>';
echo '<td>'.$row['subcategory_name'].'</td>';
echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '</div>';
require_once('footer.php');
?>