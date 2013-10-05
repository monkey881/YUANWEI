<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js,../taocan.js')); ?>


<script type="text/javascript">
<!--
var process_request = "<?php echo $this->_var['lang']['process_request']; ?>";
function getlist(key)
{
	listTable.query='gettaocan';
	  listTable.filter['brand_id'] = key;
	  listTable.filter['ps_id'] = "<?php echo $this->_var['ps_id']; ?>";
	  listTable.filter['tid'] = "<?php echo $this->_var['tid']; ?>";
	  listTable.loadList();

}	
function addshop(id,num)
{
	listTable.query='addshop';
	  listTable.filter['goods_id'] = id;
	  listTable.filter['num'] = num;
	  listTable.filter['ps_id'] = "<?php echo $this->_var['ps_id']; ?>";
	  listTable.filter['tid'] = "<?php echo $this->_var['tid']; ?>";
	  listTable.addshop();
	
	}
$(document).ready(function(){
$('#listdiv .select').mouseover(function(){
$(this).stop().animate({"top":"-180px"}, 200);
})
$('#listdiv .select').mouseout(function(){
$(this).stop().animate({"top":"0"}, 200);
})
})
	-->
</script>
<!-- 订单搜索 -->
<div class="form-div">
  

<div class="mydesket">
     <div class="title">
       <h1>我的菜篮子</h1><span class="weight">共：<?php echo $this->_var['z_weight']; ?>斤</span> <span class="address">配送地点：<select name="psAddress" id="psAddress" onchange="changeAddress(this)">
      <option value="-1">选择配送地点</option>
      <?php $_from = $this->_var['shipping_area']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'area');if (count($_from)):
    foreach ($_from AS $this->_var['area']):
?>
      <option value="<?php echo $this->_var['area']['shipping_area_id']; ?>" <?php if ($this->_var['area']['shipping_area_id'] == $this->_var['order_taocan']['peisong_area_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['area']['shipping_area_name']; ?></option>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </select></span>
     </div>
     
     <div class="myclz" id="mycl"> 
    <ul>
     <?php $_from = $this->_var['basket_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <li style="background-color:<?php echo $this->_var['bgcolor']; ?>"><a class="title"><?php echo $this->_var['item']['goods_name']; ?></a><span onclick="listTable.edit(this, 'edit_mygood_num', <?php echo $this->_var['item']['basket_id']; ?>)" title="点击修改内容" ><?php echo $this->_var['item']['weigth']; ?></span>斤
    <span class="del" onclick="listTable.delshop(<?php echo $this->_var['item']['basket_id']; ?>)">×</span>
    </li>
    <?php endforeach; else: ?>
       你的菜篮里还没有菜，快去挑选吧
     <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
   
   
</div>

   </div>

 </div>

    
   <div class="form-div">

    <h1><span>可选商品</span></h1>
    <div class="sx">
    <ul class="brand">
    <?php $_from = $this->_var['brands']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
    <li onclick=""><img src="/data/brandlogo/<?php echo $this->_var['item']['brand_logo']; ?>" width="100" height="100"  onclick="getlist(<?php echo $this->_var['item']['brand_id']; ?>);"/><span><?php echo $this->_var['item']['brand_name']; ?></span></li>
     <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </ul>
    </div>
   
    <div class="goods_list" id="listdiv">
      <ul class="goods_list_taocan" >
        <?php $_from = $this->_var['goods_taocan_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>
        <li>
          <a class="pic" href="#"><img width="120" height="120" alt="" src="/<?php echo $this->_var['goods']['goods_thumb']; ?>" /></a>
          <a class="title" href=""><?php echo htmlspecialchars($this->_var['goods']['goods_name']); ?></a>
          <div class="info"><span class="price"><?php echo $this->_var['goods']['shop_price']; ?></span><span class="kc"><?php echo $this->_var['goods']['weigth']; ?>斤</span></div>
          <div class="select">
		<b></b>
		<span>
	<dl>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,1);">0.5斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,2);">1斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,3);">1.5斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,4);">2斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,5);">2.5斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,6);">3斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,8);">4斤</a></dt>
        <dt><a href="#" onclick="addshop(<?php echo $this->_var['goods']['goods_id']; ?>,10);">5斤</a></dt>
        <dt class="zdy">自定义<input type="text" size="6" /></dt>
        </dl>
		</span>
	</div>
        </li>
        <?php endforeach; else: ?>
        <?php echo $this->_var['lang']['no_records']; ?>
        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
        <div class="clear"></div>
      </ul>
     </div>
     <div class="clear"></div>
</div>
<?php echo $this->fetch('pagefooter.htm'); ?>
