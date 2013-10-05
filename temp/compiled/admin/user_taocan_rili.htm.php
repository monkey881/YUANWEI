<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- 订单搜索 -->
<div class="form-div">
  
</div>
<?php endif; ?>

 <!--<?php if ($this->_var['action'] == 'rili'): ?>-->
 <div style=" width:90%">
      <!--配送日历开始-->
<style type="text/css">
	  .rili  {
	
	width: 100%;
}
.rili tr td {
	text-align: center;
	vertical-align: middle;
	width: 14%;
	background-color:#F5FACD;
}
.rili tr td a{
	color:#006acd; text-decoration:none;
	line-height:30px;
	
	}
.rili tr th {
	padding: 5px;
	background-color:#F5FACD;
}
.rili tr .psr {
	background-color: #C1F9CB;
	font-weight:bold;
	font-size:16px;
}
.rili tr .f {
	background-color: #FEC0C0;
}
.rili .songed {
	background-color: #999;
	font-weight:bold;
	font-size:16px;
}
.rili .shezhi {
	background-color: #F9D095;
	font-weight:bold;
	font-size:16px;
}
.rili a {
	display:block;
	width:99%;
	height:30px;
	border:solid 1px #fff;
}
.rili a:hover {
	border:solid 1px #F00;
	
}
.rili tr.top td {
	height: 20px;
}
.rili tr .psr span {
	font-size: 12px;
}
</style>

<script type="text/javascript">
function getTaoCan(date)
{
	window.location.href='gettaocan.php?date='+date+'&tid=<?php echo $this->_var['taocan']['tid']; ?>';
	
	
	}
</script>

<div class="blank"></div>
 <h5><span>我的配送日历</span></h5>

 <div class="blank"></div>
       <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#dddddd">
          <tr align="center">
            <td bgcolor="#ffffff">套餐名称</td>
            <td bgcolor="#ffffff">开始日期</td>
            <td bgcolor="#ffffff">套餐数量</td>
            <td bgcolor="#ffffff">已配送</td>
            <td bgcolor="#ffffff">还有</td>
            <td bgcolor="#ffffff">状态</td>
            <td bgcolor="#ffffff">操作</td>
          </tr>
          <tr>
            <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['taocan']['order_id']; ?>" class="f6"><?php echo $this->_var['taocan']['taocan_name']; ?></a></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['taocan']['start_time']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['taocan']['taocan_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['taocan']['song_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['taocan']['y_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['taocan']['status']; ?></td>
            <td align="center" bgcolor="#ffffff"><font class="f6"><?php echo $this->_var['taocan']['handler']; ?></font></td>
          </tr>
</table>
          <div class="blank"></div>
       <table width="100%" border="0" align="center" cellpadding="10" cellspacing="0">
  <tr>
    <td width="63" bgcolor="#C1F9CB">配送日</td>
    <td width="11">&nbsp;</td>
    <td width="63" bgcolor="#F9D095">已设置</td>
    <td width="15">&nbsp;</td>
    <td width="50" bgcolor="#999999">已配送</td>
    <td width="92">&nbsp;</td>
  </tr>
</table>
      <?php echo $this->_var['cal']; ?>
     <!-- 配送日历结束-->
     </div>
    <!--<?php endif; ?>-->  


   

<?php if ($this->_var['full_page']): ?>

 

<script language="JavaScript">

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>



</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>