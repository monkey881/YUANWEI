<?php
	ob_start();
	session_start();
	    define('IN_ECS', true);
require_once(dirname(__FILE__) . '/includes/init.php');


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>原味生活投票系统</title>
<style type="text/css">
/*ȫ����ʽ*/
body {
	font-family: "����";
	font-size: 12pt;
	color: #333333;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	margin-left: 0px;
} 
table { font-family: "����"; font-size: 9pt; line-height: 20px; color: #333333; margin-top:50px;}
a:link { font-size: 9pt; color: #333333; text-decoration: none} 
a:visited { font-size: 9pt; color: #333333; text-decoration: none} 
a:hover { font-size: 9pt; color: #E7005C; text-decoration: underline} 
a:active { font-size: 9pt; color: #333333; text-decoration: none} 
/*ȫ����ʽ����*/
</style>
<script language="javascript">
	function check()
	{
		node=frm.itm;
		flag=false;
		for(i=0;i<node.length;i++)
		{
			if(node[i].checked)
			{
				flag=true;
			}
		}
		if(!flag)
		{
			alert("您没有选择")
			return false;
		}
		return true;
	}
</script>

<?php

    if($_POST["submit"]){
	
	if($_SESSION["vote"]==session_id())
	{
		?>
		<script language="javascript">
			alert("您已经投过票�?);
			location.href="ecvote.php";
		</script>
		<?php
		exit();
	}
	$id=$_POST["itm"];
	$sql="update vote set count=count+1 where id=$id";
	if(mysql_query($sql))
	{
		$_SESSION["vote"]=session_id();
	?>
	<script language="javascript">alert("投票成功,点确定查看结�?);location.href="ecvote.php?id=ck";</script>
	<?php
	}
	else
	{
	?>
	<script language="javascript">alert("投票失败");location.href="ecvote.php";</script>
	<?php
	}
}
?>

</head>
<body>
<?php if($_GET["id"]!="ck"){?>
<form name="frm" action="" method="post" onsubmit=return(check()) style="margin-bottom:5px;">
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
<tr>
	<th bgcolor="#FFFFCC">
	<?php
		$sql="select * from votetitle";
		$rs=mysql_query($sql);
		$row=mysql_fetch_assoc($rs);
		echo $row["votetitle"];
	?>	</th>
</tr>
<?php
	$sql="select * from vote";
	$rs=mysql_query($sql);
	while($rows=mysql_fetch_assoc($rs))
	{
	?>
	<tr>
	  <td bgcolor="#FFFFFF"><input type="radio" name="itm" value="<?php echo $rows["id"]?>" />&nbsp;&nbsp;<?php echo $rows["item"]?></td>
	</tr>
	<?php
	}
?>
<tr>
	<td align="center" bgcolor="#FFFFFF"><input type="submit" name="submit" value="投票" style=" background-color:#FFBF85; cursor: pointer;" onMouseOver="this.style.background='#FF8C24'" onMouseOut="this.style.background='#FFBF85'"/>
	<input type="button" value="查看结果" onClick="location.href='ecvote.php?id=ck'" style=" background-color:#FFBF85; cursor: pointer;" onMouseOver="this.style.background='#FF8C24'" onMouseOut="this.style.background='#FFBF85'"/></td>
</tr>
</table>
</form>
<?php } else if($_GET["id"]=="ck"){
	if($_SESSION["vote"]!=session_id())
	{
		?>
		<script language="javascript">
			alert("您还未投�?);
			location.href="ecvote.php";
		</script>
		<?php
		exit();
	}
?>

<?php
	$sql="select sum(count) as 'total' from vote";
	$rs=mysql_query($sql);
	$rows=mysql_fetch_assoc($rs);
	$sum=$rows["total"];	 //得出总票�?
	$sql="select * from vote";
	$rs=mysql_query($sql);
?>

<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#C2C2C2">
<tr>
	<th bgcolor="#FFFFFF">项目</th>
	<th bgcolor="#FFFFFF">票数</th>
	<th bgcolor="#FFFFFF">百分�?/th>
</tr>
<?php
	while($rows=mysql_fetch_assoc($rs))
	{
	?>
	<tr>
		<td bgcolor="#FFFFFF"><?php echo $rows["item"]?></td>
		<td bgcolor="#FFFFFF"><?php echo $rows["count"]?></td>
		<td bgcolor="#FFFFFF">
			<?php
				$per=$rows["count"]/$sum;
				$per=number_format($per,4);
			?>
			<img src="100.jpg" height="4" width="<?php echo $per*100?>" />
			<?php echo $per*100?>%		</td>
	</tr>
	<?php
	}
?>
</table>
<div align="center">
<a href="ecvote.php">隐藏结果</a>&nbsp;
<a href="./">回到首页</a>
</div>
<?php } ?>
</body>
</html>
