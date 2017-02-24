<?
	include("includes/db.php");
	include("includes/functions.php");
	
	if($_REQUEST['command']=='delete' && $_REQUEST['pid']>0){
		remove_product($_REQUEST['pid']);
	}
	else if($_REQUEST['command']=='clear'){
		unset($_SESSION['cart']);
	}
	else if($_REQUEST['command']=='update'){
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$pid=$_SESSION['cart'][$i]['productid'];
			$q=intval($_REQUEST['product'.$pid]);
			if($q>0 && $q<=999){
				$_SESSION['cart'][$i]['qty']=$q;
			}
			else{
				$msg='Some proudcts not updated!, quantity must be a number between 1 and 999';
			}
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" xml:lang="ru">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251"/>
<?php
echo '<title>' . $page_title . '</title>';
?>
    <link type="text/css" rel="stylesheet" href = "index.css" />
<script language="javascript">
	function del(pid){
		if(confirm('Do you really mean to delete this item')){
			document.form1.pid.value=pid;
			document.form1.command.value='delete';
			document.form1.submit();
		}
	}
	function clear_cart(){
		if(confirm('This will empty your shopping cart, continue?')){
			document.form1.command.value='clear';
			document.form1.submit();
		}
	}
	function update_cart(){
		document.form1.command.value='update';
		document.form1.submit();
	}


</script>
</head>

<body>
<?php 
require_once('navmenu.php');
?>
<form name="form1" method="post">
<input type="hidden" name="pid" />
<input type="hidden" name="command" />
	<div style="margin:0px auto; width:600px; padding-bottom:400px;" >
    <div style="padding-bottom:10px">
    	<h2 style = "color: #FD6904" align="center">���� �������</h2>
    <input type="button" value="���������� �������" onclick="window.location='index.php'" />
    </div>
    	<div style="color:#F00"><?=$msg?></div>
    	<table border="0" cellpadding="5px" cellspacing="1px" style="font-family:Verdana, Geneva, sans-serif; font-size:11px; background-color:#E1E1E1; text-align: center" width="105%">
    	<?
			if(is_array($_SESSION['cart'])){
            	echo '<tr bgcolor="#FFFFFF" style="font-weight:bold"><td>�</td><td>������������</td><td>����</td><td>����������</td><td>�����</td><td>�����</td></tr>';
				$max=count($_SESSION['cart']);
				for($i=0;$i<$max;$i++){
					$pid=$_SESSION['cart'][$i]['productid'];
					$q=$_SESSION['cart'][$i]['qty'];
					$pname=get_product_name($pid);
					if($q==0) continue;
			?>
            		<tr bgcolor="#FFFFFF"><td><?=$i+1?></td><td><?=$pname?></td>
                    <td><?=get_price($pid)?> ���.</td>
                    <td><input type="text" name="product<?=$pid?>" value="<?=$q?>" maxlength="3" size="2" /></td>                    
                    <td><?=get_price($pid)*$q?> ���.</td>
                    <td><a href="javascript:del(<?=$pid?>)">�������</a></td></tr>
            <?					
				}
			?>
				<tr><td colspan="2" align="right"><b>����� ������: <?=get_order_total()?> ���.</b></td><td colspan="4" align="right"><input type="button" value="�������� �������" onclick="clear_cart()"><input type="button" value="�������� �������" onclick="update_cart()"><input type="button" value="�������� �����" onclick="window.location='billing.php'"></td></tr>
			<?
            }
			else{
				echo "<tr bgColor='#FFFFFF'><td>� ����� ������� �����!</td>";
			}
		?>
        </table>
    </div>
</form>
<?php
require_once('footer.php');
?>