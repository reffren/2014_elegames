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
	function addtocart(pid){ //����� ��������� id �������� ����� ������� ������ �������������
		document.form1.productid.value=pid; //������������� �������� id ��� ����� � ������� productid
		document.form1.submit(); // �������� ����� ������� ������
	}
</script>

<body>
<form name="form1" method="post" action="edit_admin.php"> //����� �������� ������� ������ ����� �������� ������� ���� �������� id
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
                    			����:<big style="color:green">
                    			<?=$row['price']?> ���.</big><br /><br />
                    			<input type="button" value="�������������" onclick="addtocart(<?=$row['product_id']?>)" />// ����� �������� ������ addtocart() id ��������
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