<!-- $Id: goods_list.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<style type="text/css">

.ps_shop_list a:visited, .ps_shop_list a:link {
 text-decoration: none;
	background-color: #DEFAFC;
	line-height: 20px;
	margin-right: 10px;
}
</style>


<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="form-div">
 <input name="" type="button" value="最近配送"  onclick="getpeisong('jj')"/> <input name="" type="button" value="未设置用户"  onclick="getusertaocan()"/> <input name="" type="button" value="已配货" onclick="getpeisong('yph')" /> <input name="" type="button" value="已结束" onclick="getpeisong('yjs')"/> 
<a href="?act=excel" target="_blank">下载EXCEL</a></div>
<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <!-- start goods list -->
  <div class="list-div" id="listDiv">
<?php endif; ?>
<?php if ($this->_var['act'] == 'wsz'): ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="2%">
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
      全选
    </th>
    <th width="5%">用户名</th>
    <th width="55%">套餐名</th>
    <th width="10%">还有</th>
     <th width="5%">状态</th>
    
    <th width="5%" >操作</th>
  <tr>
  <?php $_from = $this->_var['taocan_urer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'user');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['user']):
?>
  <tr>
    <td><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['peisong']['ps_id']; ?>" /><?php echo $this->_var['user']['tid']; ?></td>
    <td class="first-cell"><?php echo htmlspecialchars($this->_var['user']['user_name']); ?></td>
    <td class="ps_shop_list">
    <?php echo $this->_var['user']['taocan_name']; ?>
    </td>
    <td align="right">
<?php echo $this->_var['user']['hy_weight']; ?>
   </td>
   
    <td align="center"><?php echo $this->_var['user']['status']; ?></td>
   
    <td align="center">
   
    
    </td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<!-- end goods list -->

<?php else: ?>

<table cellpadding="3" cellspacing="1">
  <tr>
    <th width="2%">
      <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
      全选
    </th>
    <th width="5%">用户名</th>
    <th width="55%">配送商品</th>
    <th width="5%">配送日期</th>
    <th width="10%">配送地</th>
     <th width="5%">状态</th>
    
    <th width="5%" >操作</th>
  <tr>
  <?php $_from = $this->_var['peisong']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'peisong_0_99029100_1373860259');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['peisong_0_99029100_1373860259']):
?>
  <tr>
    <td><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['peisong_0_99029100_1373860259']['ps_id']; ?>" /><?php echo $this->_var['peisong_0_99029100_1373860259']['ps_id']; ?></td>
    <td class="first-cell" style="<?php if ($this->_var['goods']['is_promote']): ?>color:red;<?php endif; ?>"><?php echo htmlspecialchars($this->_var['peisong_0_99029100_1373860259']['user_name']); ?></td>
    <td class="ps_shop_list">
     <?php $_from = $this->_var['peisong_shop_list'][$this->_var['sn']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'shop');if (count($_from)):
    foreach ($_from AS $this->_var['shop']):
?>
     <a href="../goods.php?id=<?php echo $this->_var['shop']['goods_id']; ?>" target="_blank" ><?php echo $this->_var['shop']['goods_name']; ?> <?php echo $this->_var['shop']['weight']; ?>斤</a>
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    
    </td>
    <td align="right">
<?php echo $this->_var['peisong_0_99029100_1373860259']['ps_time']; ?>
   </td>
    <td align="center"><?php echo $this->_var['peisong_0_99029100_1373860259']['address']; ?></td>
    <td align="center"><?php echo $this->_var['peisong_0_99029100_1373860259']['status']; ?></td>
   
    <td align="center">
   
    
    </td>
  </tr>
  <?php endforeach; else: ?>
  <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>
<!-- end goods list -->
<?php endif; ?>
<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="right" nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>

<?php if ($this->_var['full_page']): ?>
</div>

<div>
 <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />
      全选  <input name="" type="button" value="最近配送设为已配货"  onclick="setStatus('ph')"/> <input name="" type="button" value="已配送设为已发货"  onclick="setStatus('fh')"/> 
</div>
</form>

<script type="text/javascript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  function getpeisong(psDate){
	  listTable.query='query';
	  listTable.filter.psDate=psDate;
	  listTable.loadList();
  }
  function getexcel(){
	   listTable.filter.psDate='jj';
	   listTable.query='excel';
	   listTable.filter.page_size = '200';
	  listTable.loadList();
	  }
function getusertaocan(){
	   listTable.query='wsz';
	   listTable.filter.psDate='jj';
	   listTable.filter.page_size = '200';
	  listTable.loadList();
	  }
	  
function setStatus(status){
	   listTable.query='setStatus';
	   listTable.filter.status=status;
	   listTable.filter.page_size = '200';
	  listTable.loadList();
	  }
  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    startCheckOrder(); // 开始检查订单
    document.forms['listForm'].reset();
  }

  /**
   * @param: bool ext 其他条件：用于转移分类
   */
  function confirmSubmit(frm, ext)
  {
      if (frm.elements['type'].value == 'trash')
      {
          return confirm(batch_trash_confirm);
      }
      else if (frm.elements['type'].value == 'not_on_sale')
      {
          return confirm(batch_no_on_sale);
      }
      else if (frm.elements['type'].value == 'move_to')
      {
          ext = (ext == undefined) ? true : ext;
          return ext && frm.elements['target_cat'].value != 0;
      }
      else if (frm.elements['type'].value == '')
      {
          return false;
      }
      else
      {
          return true;
      }
  }

  function changeAction()
  {
      var frm = document.forms['listForm'];

      // 切换分类列表的显示
      frm.elements['target_cat'].style.display = frm.elements['type'].value == 'move_to' ? '' : 'none';
			
			<?php if ($this->_var['suppliers_list'] > 0): ?>
      frm.elements['suppliers_id'].style.display = frm.elements['type'].value == 'suppliers_move_to' ? '' : 'none';
			<?php endif; ?>

      if (!document.getElementById('btnSubmit').disabled &&
          confirmSubmit(frm, false))
      {
          frm.submit();
      }
  }

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>