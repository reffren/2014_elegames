<?php


	include("includes/db.php");
	include("includes/functions.php");
$dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
mysqli_query($dbc,"SET NAMES 'cp1251'");
	
if($_REQUEST['command']=='add' && $_REQUEST['productid']>0){
		$pid=$_REQUEST['productid'];
		addtocart($pid,1);
		header("location:shoppingcart.php");
		exit();
	}
?>

<script language="javascript">
	function addtocart(pid){
		document.form1.productid.value=pid;
		document.form1.command.value='add';
		document.form1.submit();
	}
</script>

<body>
<form name="form1">
	<input type="hidden" name="productid" />
    <input type="hidden" name="command" />
</form>
<div id="goods">

	<table id = "products">
		<?
                        $query = "SELECT * FROM products ORDER BY product_id DESC";
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
                    			<input type="button" value="������" onclick="addtocart(<?=$row['product_id']?>)" />
				</td>
			<?php
				if ($output%$itemsinrow == 0)
					echo '</tr>';
			}
			?>		

    </table>
</div>
