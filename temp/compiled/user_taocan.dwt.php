<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<link href="/js/submodal/submodal.css" rel="stylesheet" type="text/css" />

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,user.js')); ?>
</head>
<body>
<?php echo $this->fetch('library/page_header.lbi'); ?>

<div class="block box">
 <div id="ur_here">
  <?php echo $this->fetch('library/ur_here.lbi'); ?>
 </div>
</div>

<div class="blank"></div>
<div class="block clearfix">
  
  <div class="AreaL">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox">
        <?php echo $this->fetch('library/user_menu.lbi'); ?>
      </div>
     </div>
    </div>
  </div>
  
  
  <div class="AreaR">
    <div class="box">
     <div class="box_1">
      <div class="userCenterBox boxCenterList clearfix" style="_height:1%;">
     
      
       <?php if ($this->_var['action'] == 'taocan'): ?>
       <h5><span>我的套餐</span></h5>
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
          <?php $_from = $this->_var['taocans']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['item']):
?>
          <tr>
            <td align="center" bgcolor="#ffffff"><a href="user.php?act=order_detail&order_id=<?php echo $this->_var['item']['order_id']; ?>" class="f6"><?php echo $this->_var['item']['taocan_name']; ?></a></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['start_time']; ?></td>
            <td align="right" bgcolor="#ffffff"><?php echo $this->_var['item']['taocan_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['song_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['y_weight']; ?></td>
            <td align="center" bgcolor="#ffffff"><?php echo $this->_var['item']['status']; ?></td>
            <td align="center" bgcolor="#ffffff"><font class="f6"><?php echo $this->_var['item']['handler']; ?></font></td>
          </tr>
         
          <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
          </table>
        <div class="blank5"></div>
       <?php echo $this->fetch('library/pages.lbi'); ?>
       <?php endif; ?>
      
    
     <?php if ($this->_var['action'] == 'rili'): ?>
      
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
<script type="text/javascript" src="/js/submodal/submodalsource.js"></script>

<script type="text/javascript">
function getTaoCan(date)
{
	showPopWin('gettaocan.php?date='+date+'&tid=<?php echo $this->_var['taocan']['tid']; ?>',960,600,null);
	
	}
</script>

<div class="blank"></div>
 <h5><span>我的配送日历</span></h5>
 <div style="padding:10px">
   <p>原味生活首创——最大程度的满足会员喜好、且逐步缩减农场库存浪费的订餐系统说明：
     
     </p>
   <p>①、我们为您列出了当前有效的套餐。如果发现您的套餐没有显示可能是您没有支付的原因。如果是其他原因请联系客服人员。
     
     </p>
   <p>②、请点击系统显示的配送日期进行选菜，此时会弹出配菜界面，可完全根据自己喜好进行选择。
     
     </p>
   <p>③、点击周三或周六的配送日期后，则会弹出具体的选菜界面。原则上，如同套餐说明一样，2人套餐每次4斤、3人套餐每次6斤、4人套餐每次8斤，最小选菜单位0.5斤，加起来和等于相应套餐每次的重量即可。
     
     </p>
   <p>④、该系统可以满足因为家里来客人、或者有特别想吃的而选择提前消费的想法，超出系统默认的斤数后，系统会自动跳出提醒，可以随意增减，自由度较大。
     
     </p>
   <p>⑤、因为出差、亲人朋友赠送菜等原因，可以自由在系统界面暂停和开始。
     
     </p>
<p>⑥ 、取菜点在您选择订单的时候就需要选择，之后则无需每次重复选择。若是之后有所变化，请在选菜界面具体更改。
  
  </p>
<p>⑦、请您务必在每次的配送日的前日am:12点前将您的订餐计划确定完毕，超过这个时间后，系统将自动关闭套餐更新配置，您的更改将不再生效。  </p>
<p>⑧因为蔬菜不是工业产品，因此蔬菜上市，一开始都是少量、之后逐步趋稳，因此对于这类品种，会出现"谁先点到谁先吃"供不应求的状态，尽请大家谅解。  </p>
<p>⑨其他不懂事宜尽请咨询客服人员，谢谢！</p>
 </div>
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
     
    <?php endif; ?>  
   




      </div>
     </div>
    </div>
  </div>
  
</div>
<div class="blank"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</body>
</html>
