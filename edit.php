<?php
include('includes/authorize.php');
ob_start();
require_once('header.php');
include('includes/db.php');
require_once('navmenu.php');
require_once('other.php');

$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");


?>

<script language="javascript">
	function addtocart(pid){ //метод принимает id продукта после нажатия кнопки редактировать
		document.form1.productid.value=pid; //присваивается значение id для формы с имненем productid
		document.form1.submit(); // вызывает метод нажатия кнопки
	}
</script>

<body>
<form name="form1" method="post" action="edit_admin.php"> //после имитации нажатия кнопки форма передает методом пост значение id
	<input type="hidden" name="productid" />
</form>
<div id="goods">

	<table id = "products">
		<?
                        $query = "SELECT * FROM products";
                        mysqli_query($dbc,"SET NAMES 'cp1251'");
			$result=mysqli_query($dbc, $query);
			$output = 0; 
                        $itemsinrow=4;
			while($row=mysqli_fetch_array($result)){
				if ($output%$itemsinrow == 0)
					echo '<tr>';
				$output = $output + 1;
		?>

        			<td>
 
					<img src="<?=$row['picture']?>" /><br />
              				<b><a href="product.php?id=<?=$row['product_id']?>&amp;cost=<?=$row['price']?>"><?=$row['name']?></a></b><br />
            				<?=$row['description']?><br />
                    			Цена:<big style="color:green">
                    			<?=$row['price']?> руб.</big><br /><br />
                    			<input type="button" value="Редактировать" onclick="addtocart(<?=$row['product_id']?>)" />// здесь передаем методу addtocart() id продукта
				</td>
			<?php
				if ($output%$itemsinrow == 0)
					echo '</tr>';
			}
			?>		

    </table>
</div>

<?php
require_once('footer.php');
?>