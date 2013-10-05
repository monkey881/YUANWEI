<!-- $Id: goods_list_taocan.htm 17126 2010-04-23 10:30:26Z liuhui $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<!-- 商品搜索 -->
<?php echo $this->fetch('goods_search.htm'); ?>


<!-- 商品列表 -->
<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <!-- start goods list -->
  <div class="list-div" id="listDiv">
<?php endif; ?>

  
  
  <style type="text/css">
ul {
	margin: 0px;
	padding: 0px;
	display: block;
}
.goods_list_taocan li a {
	display: block;
}
.goods_list_taocan li .pic {
	padding: 2px;
	height: 122px;
	width: 122px;
	border: 1px solid #CCC;
}
.goods_list_taocan li .title {
	color: #333;
	text-decoration: none;
	line-height: 30px;
}
.goods_list_taocan li .info .price {
	color: #F00;
	width: 50px;
	display: block;
	float: left;
}
.goods_list_taocan li .info .kc {
	display: block;
	color: #999;
	float: right;
	width: 60px;
	text-align: right;
}
.goods_list_taocan li .info {
	height: 25px;
}
.goods_list_taocan li {
	display: block;
	float: left;
	height: 220px;
	width: 132px;
	padding: 5px;
}
.goods_list_taocan li .select #issle {
	float: right;
}
.goods_list_taocan li .select #num {
	float: left;
}
</style>

<!-- end goods list -->
<ul class="goods_list_taocan">
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
  <li>
  <a class="pic" href="#"><img width="120" height="120" alt="" src="/<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a>
  <a class="title" href=""><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></a>
  <div class="info"><span class="price"><?php echo $this->_var['goods']['shop_price']; ?></span><span class="kc"><?php echo $this->_var['goods']['goods_number']; ?></span></div>
  <div class="select"><input name="num<?php echo $this->_var['goods']['goods_id']; ?>" type="text" id="num<?php echo $this->_var['goods']['goods_id']; ?>" size="8" /><input type="checkbox" name="checkboxes[]" value="<?php echo $this->_var['goods']['goods_id']; ?>" /></div>
  </li>
  <?php endforeach; else: ?>
  <?php echo $this->_var['lang']['no_records']; ?>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </ul>
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
<input type="hidden" name="tid" value="<?php echo $this->_var['tid']; ?>" />
  <input type="hidden" name="act" value="addshop" /><input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />全选
  <input type="submit" value="添加" id="btnSubmit" name="btnSubmit" class="button" />
</div>
</form>

<script type="text/javascript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

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