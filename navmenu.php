<div id=all>
<div id="top">
<table id="tabletop" summary="� ���� ������� ��������� ����������">
<tr>
<td rowspan="2" id="logo"><a href = "index.php"><img src= "images/wew.gif"/></a></td>
<?php       
if (isset($_SESSION['name'])) { 
echo '<td id="hiuser"><h3>������������,'.' '.$_SESSION['name'] .'</h3></td>';
echo '<td class="bottom"><a href="shoppingcart.php"><img src= "images/cart.gif"/>�������</a></td>';
echo '<td class="bottom"><a href="profile.php">������ �������</a></td>';
echo '<td class="bottom"><a href="logout.php">�����</a></td>';
echo '</tr>';
echo '<tr>';
echo '<td  colspan="4" id="phone"><h2>8(843)240-46-23</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<div id="info">';
echo '<table>';
echo '<tr>';
echo '<td id="title"><a href="index.php">�������</a></td>';
echo '<td id="video"><a href="payment.php">������</a></td>';
echo '<td id="help"><a href="delivery.php">��������</a></td>';
echo '<td id="aboutshop"><a href="about.php">� ��������</a></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}
else {
echo '<td id="hi"><h3>������������, ��������� ����������!</h3></td>';
echo '<td class="bottom"><a href="shoppingcart.php"><img src= "images/cart.gif"/>�������</a></td>';
echo '<td class="bottom"><a href="signup.php">����</a></td>';
echo '<tr>';
echo '<td colspan="3" id="phone"><h2>8(843)240-46-23</td>';
echo '</tr>';
echo '</table>';
echo '</div>';
echo '<div id="info">';
echo '<table>';
echo '<tr>';
echo '<td id="title"><a href="index.php">�������</a></td>';
echo '<td id="video"><a href="payment.php">������</a></td>';
echo '<td id="help"><a href="delivery.php">��������</a></td>';
echo '<td id="aboutshop"><a href="about.php">� ��������</a></td>';
echo '</tr>';
echo '</table>';
echo '</div>';
}
?>