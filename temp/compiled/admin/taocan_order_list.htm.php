<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<script type="text/javascript">
function get_taocan_order(status)
{
	listTable.query = "query";
	listTable.filter['order_status']=status;
	listTable.filter['page']='1';
	listTable.loadList();
	}
</script>

<!-- 订单搜索 -->
<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    <?php echo $this->_var['lang']['order_sn']; ?><input name="order_sn" type="text" id="order_sn" size="15">
    <?php echo htmlspecialchars($this->_var['lang']['consignee']); ?><input name="consignee" type="text" id="consignee" size="15">
    <?php echo $this->_var['lang']['all_status']; ?>
    <select name="status" id="status">
      <option value="-1"><?php echo $this->_var['lang']['select_please']; ?></option>
      <?php echo $this->html_options(array('options'=>$this->_var['status_list'])); ?>
    </select>
    <input type="submit" value="<?php echo $this->_var['lang']['button_search']; ?>" class="button" />
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['os_unconfirmed']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['os_unconfirmed']]; ?></a>
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['cs_await_pay']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['cs_await_pay']]; ?></a>
    <a href="order.php?act=list&composite_status=<?php echo $this->_var['cs_await_ship']; ?>"><?php echo $this->_var['lang']['cs'][$this->_var['cs_await_ship']]; ?></a>
 
  <input name="" type="button" value="进行中"  onclick="get_taocan_order(2)"/>  <input onclick="get_taocan_order(3)" name="" type="button" value="已暂停" /> <input onclick="get_taocan_order(4)" name="" type="button" value="已结束" /> </form>
</div> 
<?php endif; ?>
 <!--<?php if ($this->_var['action'] == 'list' || $this->_var['action'] == 'query'): ?>-->
<!-- 订单列表 -->
<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv">


<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />套餐名称
    </th>
    <th>用户名</th>
    <th>总重量</th>
    <th>开始时间</th>
    <th>结束时间</th>
    <th>已配送</th>
    <th>还有</th>
    <th>状态</th>
    <th>操作</th>
  <tr>
  <?php $_from = $this->_var['order_taocan']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('okey', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['okey'] => $this->_var['order']):
?>
  <tr>
    <td valign="top" nowrap="nowrap"><input type="checkbox" name="checkboxes" value="<?php echo $this->_var['order']['tid']; ?>" /><a href="order.php?act=info&order_id=<?php echo $this->_var['order']['order_id']; ?>" id="order_<?php echo $this->_var['okey']; ?>"><?php echo $this->_var['order']['taocan_name']; ?></a></td>
    <td><?php echo htmlspecialchars($this->_var['order']['buyer']); ?></td>
    <td align="left" valign="top"><?php echo $this->_var['order']['taocan_weight']; ?></td>
    <td align="right" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['start_time']; ?></td>
    <td align="right" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['end_time']; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['song_weight']; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['hy_weight']; ?></td>
    <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['order']['status']; ?></td>
    <td align="center" valign="top"  nowrap="nowrap">
     <a href="taocan_order.php?act=edit&tid=<?php echo $this->_var['order']['tid']; ?>">编辑</a> | 
    <a href="taocan_order.php?act=del&tid=<?php echo $this->_var['order']['tid']; ?>">删除</a> | 
    <a href="user_taocan.php?act=rili&tid=<?php echo $this->_var['order']['tid']; ?>">设置套餐</a>
    </td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<!--<?php endif; ?>-->
 <!--<?php if ($this->_var['action'] == 'sztaocan'): ?>-->
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
    <!--<?php endif; ?>-->  
   

<?php if ($this->_var['full_page']): ?>
  </div>
  <div>
    <input name="confirm" type="submit" id="btnSubmit" value="<?php echo $this->_var['lang']['op_confirm']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="invalid" type="submit" id="btnSubmit1" value="<?php echo $this->_var['lang']['op_invalid']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="cancel" type="submit" id="btnSubmit2" value="<?php echo $this->_var['lang']['op_cancel']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="remove" type="submit" id="btnSubmit3" value="<?php echo $this->_var['lang']['remove']; ?>" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="print" type="submit" id="btnSubmit4" value="<?php echo $this->_var['lang']['print_order']; ?>" class="button" disabled="true" onclick="this.form.target = '_blank'" />
    <input name="batch" type="hidden" value="1" />
    <input name="order_id" type="hidden" value="" />
  </div>
</form>
<script language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>



</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>