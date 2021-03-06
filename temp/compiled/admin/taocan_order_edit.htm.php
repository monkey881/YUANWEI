<!-- $Id: topic_edit.htm 16992 2010-01-19 08:45:49Z wangleisvn $ -->

<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,selectzone.js,colorselector_topic.js')); ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php if ($this->_var['warning']): ?>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
  <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;" ><?php echo $this->_var['warning']; ?></li>
</ul>
<?php endif; ?>
<!-- start goods form -->
<div class="tab-div">
  <!-- tab bar -->
  <div id="tabbar-div">
    <p> <span class="tab-front" id="general-tab">套餐订单管理</span>  </p>
  </div>
  <!-- tab body -->
  <div id="tabbody-div">
    <form action="?act=edit_save" method="post" name="theForm" enctype="multipart/form-data">
    <input name="tid" type="hidden" value="<?php echo $this->_var['order_taocan']['tid']; ?>" />
      <table cellspacing="1"  id="general-table" cellpadding="3" width="100%">
        <tr>
          <td class="label">套餐商品</td>
          <td><?php echo $this->_var['order_taocan']['taocan_name']; ?></td>
        </tr>
        <tr>
          <td class="label">订单号</td>
          <td><?php echo $this->_var['order_taocan']['order_id']; ?></td>
        </tr>
        <tr>
          <td class="label">用户</td>
          <td><?php echo $this->_var['order_taocan']['user_name']; ?></td>
        </tr>
        <tr>
          <td class="label">添加日期</td>
          <td><input type="text" name="add_time" id="add_time" value="<?php echo $this->_var['order_taocan']['add_time']; ?>" size="35" /></td>
        </tr>
        <tbody id="content_01">
          <tr>
            <td  class="label">
             
            开始日期</td>
            <td><input type="text" name="start_time" id="start_time" value="<?php echo $this->_var['order_taocan']['start_time']; ?>" size="35" />
          </td>
          </tr>
          <tr>
            <td class="label">结束日期</td>
            <td><input type="text" name="end_time" id="end_time" value="<?php echo $this->_var['order_taocan']['end_time']; ?>" size="35" /></td>
          </tr>
        </tbody>
        
        <tbody id="edit_img">
          <tr>
            <td class="label">总重量</td>
            <td><input type="text" name="taocan_weight" id="taocan_weight" value="<?php echo $this->_var['order_taocan']['taocan_weight']; ?>" size="35" readonly="readonly"/></td>
          </tr>
        </tbody>

        <tbody id="content_23">
          <tr>
            <td class="label">已配送</td>
            <td><input type="text" name="song_weight" id="song_weight" value="<?php echo $this->_var['order_taocan']['song_weight']; ?>" size="35" /></td>
          </tr>
        </tbody>
        
        <tr>
          <td  class="label">状态</td>
          <td><table width="200">
            <tr>
              <td><label>
                <input name="status" type="radio" id="status_0" value="0" <?php if ($this->_var['order_taocan']['status'] == 0): ?>checked="checked"<?php endif; ?> />
                未确认</label></td>
            </tr>
            <tr>
              <td><label>
                <input type="radio" name="status" value="1" id="status_1" <?php if ($this->_var['order_taocan']['status'] == 1): ?>checked="checked"<?php endif; ?> />
                未开始</label></td>
            </tr>
            <tr>
              <td><label>
                <input type="radio" name="status" value="2" id="status_2" <?php if ($this->_var['order_taocan']['status'] == 2): ?>checked="checked"<?php endif; ?>/>
                进行中</label></td>
            </tr>
            <tr>
              <td><label>
                <input type="radio" name="status" value="3" id="status_3" <?php if ($this->_var['order_taocan']['status'] == 3): ?>checked="checked"<?php endif; ?>/>
                已暂停</label></td>
            </tr>
          </table></td>
        </tr>

        <tbody id="edit_title_img">
        </tbody>
      </table>
      
      
      
      <div class="button-div">
      
        <input type="submit"  name="Submit"       value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" onclick="return checkForm()"/>
        <input type="reset"   name="Reset"        value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button"/>
      </div>
    </form>
  </div>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'validator.js,tab.js')); ?>
<script type="Text/Javascript" language="JavaScript">
<!--
var data = '<?php echo $this->_var['topic']['data']; ?>';
var defaultClass = "<?php echo $this->_var['lang']['default_class']; ?>";

var myTopic = Object();
var status_code = "<?php echo $this->_var['topic']['topic_type']; ?>"; // 初始页面参数

onload = function()
{
  
  // 开始检查订单
  startCheckOrder();
  var classList = document.getElementById("topic_class_list");

  // 初始化表单项
  initialize_form(status_code);

  if (data == "")
  {
    
    classList.innerHTML = "";
    myTopic['default'] = new Array();
    var newOpt    = document.createElement("OPTION");
    newOpt.value  = -1;
    newOpt.text   = defaultClass;
    classList.options.add(newOpt);
    return;
  }
  var temp    = data.parseJSON();

  var counter = 0;
  for (var k in temp)
  {
    if(typeof(myTopic[k]) != "function")
    {
      myTopic[k] = temp[k];
      var newOpt    = document.createElement("OPTION");
      newOpt.value  = k == "default" ? -1 : counter;
      newOpt.text   = k == "default" ? defaultClass : k;
      classList.options.add(newOpt);
      counter++;
    }
  }
  showTargetList();
}

/**
 * 初始化表单项目
 */
function initialize_form(status_code)
{
  var nt = navigator_type();
  var display_yes = (nt == 'IE') ? 'block' : 'table-row-group';
  status_code = parseInt(status_code);
  status_code = status_code ? status_code : 0;
  document.getElementById('topic_type').options[status_code].selected = true;

  switch (status_code)
  {
    case 0 :
      document.getElementById('content_01').style.display = display_yes;
      document.getElementById('content_23').style.display = 'none';
			document.getElementById('title_upload').innerHTML = '<?php echo $this->_var['width_height']; ?>';
			document.getElementById('edit_img').style.display = display_yes;
    break;
		
    case 1 :
      document.getElementById('content_01').style.display = display_yes;
      document.getElementById('content_23').style.display = 'none';
			document.getElementById('title_upload').innerHTML = '<?php echo $this->_var['lang']['tips_upload_notice']; ?>';
			document.getElementById('edit_img').style.display = display_yes;
    break;
		
    case 2 :
      document.getElementById('content_01').style.display = 'none';
      document.getElementById('content_23').style.display = display_yes;
			document.getElementById('edit_img').style.display = 'none';
    break;
  }

	<?php if ($this->_var['isadd'] == 'isadd'): ?>
	document.getElementById('edit_img').style.display = 'none';
	document.getElementById('edit_title_img').style.display = 'none';
	<?php endif; ?>

  return true;
}

/**
 * 类型表单项切换
 */
function showMedia(code)
{
  var obj = document.getElementById('topic_type');

  initialize_form(code);
}

function checkForm()
{
  var validator = new Validator('theForm');
  validator.required('topic_name', topic_name_empty);
  validator.required('start_time', start_time_empty);
  validator.required('end_time', end_time_empty);
  validator.islt('start_time', 'end_time', start_lt_end);

  document.getElementById("topic_data").value = myTopic.toJSONString();

  return validator.passed();
}

function chanageSize(num, id)
{
  var obj = document.getElementById(id);
  if (obj.tagName == "TEXTAREA")
  {
    var tmp = parseInt(obj.rows);
    tmp += num;
    if (tmp <= 0) return;
    obj.rows = tmp;
  }
}

function searchGoods(catId, brandId, keyword)
{
  var elements = document.forms['theForm'].elements;
  var filters = new Object;
  filters.cat_id = elements[catId].value;
  filters.brand_id = elements[brandId].value;
  filters.keyword = Utils.trim(elements[keyword].value);
  Ajax.call("topic.php?act=get_goods_list", filters, function(result)
  {
    clearOptions("source_select");
    var obj = document.getElementById("source_select");
    for (var i=0; i < result.content.length; i++)
    {
      var opt   = document.createElement("OPTION");
      opt.value = result.content[i].value;
      opt.text  = result.content[i].text;
      opt.id    = result.content[i].data;
      obj.options.add(opt);
    }
  }, "GET", "JSON");
}

function clearOptions(id)
{
  var obj = document.getElementById(id);
  while(obj.options.length>0)
  {
    obj.remove(0);
  }
}

function addAllItem(sender)
{
  if(sender.options.length == 0) return false;
  for (var i = 0; i < sender.options.length; i++)
  {
    var opt = sender.options[i];
    addItem(null, opt.value, opt.text);
  }
}

function addItem(sender, value, text)
{
  var target_select = document.getElementById("target_select");
  var sortList = document.getElementById("topic_class_list");
  var newOpt   = document.createElement("OPTION");
  if (sender != null)
  {
    if(sender.options.length == 0) return false;
    var option = sender.options[sender.selectedIndex];
    newOpt.value = option.value;
    newOpt.text  = option.text;
  }
  else
  {
    newOpt.value = value;
    newOpt.text  = text;
  }
  if (targetItemExist(newOpt)) return false;
  if (target_select.length>=50)
  {
    alert(item_upper_limit);
  }
  target_select.options.add(newOpt);
  var key = sortList.options[sortList.selectedIndex].value == "-1" ? "default" : sortList.options[sortList.selectedIndex].text;
  
  if(!myTopic[key])
  {
    myTopic[key] = new Array();
  }
  myTopic[key].push(newOpt.text + "|" + newOpt.value);
}

// 商品是否存在
function targetItemExist(opt)
{
  var options = document.getElementById("target_select").options;
  for ( var i = 0; i < options.length; i++)
  {
    if(options[i].text == opt.text && options[i].value == opt.value) 
    {
      return true;
    }
  }
  return false;
}

function addClass()
{
  var obj = document.getElementById("topic_class_list");
  var newClassName = document.getElementById("new_cat_name");
  var regExp = /^[a-zA-Z0-9]+$/;
  if (newClassName.value == ""){
    alert(sort_name_empty);
    return;
  }
  for(var i=0;i < obj.options.length; i++)
  {
    if(obj.options[i].text == newClassName.value)
    {
      alert(sort_name_exist);
      newClassName.focus(); 
      return;
    }
  }
  var className = document.getElementById("new_cat_name").value;
  document.getElementById("new_cat_name").value = "";
  var newOpt    = document.createElement("OPTION");
  newOpt.value  = obj.options.length;
  newOpt.text   = className;
  obj.options.add(newOpt);
  newOpt.selected = true;
  if ( obj.options[0].value == "-1")
  {
    if (myTopic["default"].length > 0)
      alert(move_item_confirm.replace("className",className));
    myTopic[className] = myTopic["default"];
    delete myTopic["default"];
    obj.remove(0);
  }
  else
  {
    myTopic[className] = new Array();
    clearOptions("target_select");
  }
}

function deleteClass()
{
  var classList = document.getElementById("topic_class_list");
  if (classList.value != "-1")
  {
    delete myTopic[classList.options[classList.selectedIndex].text];
    classList.remove(classList.selectedIndex);
    clearOptions("target_select");
  }
  if (classList.options.length < 1)
  {
    var newOpt    = document.createElement("OPTION");
    newOpt.value  = "-1";
    newOpt.text   = defaultClass;
    classList.options.add(newOpt);
    myTopic["default"] = new Array();
  }
}

function showTargetList()
{
  clearOptions("target_select");
  var obj = document.getElementById("topic_class_list");
  var index = obj.options[obj.selectedIndex].text;
  if (index == defaultClass)
  {
    index = "default";
  }
  var options = myTopic[index];
  
  for ( var i = 0; i < options.length; i++)
  {
    var newOpt    = document.createElement("OPTION");
    var arr = options[i].split('|');
    newOpt.value  = arr[1];
    newOpt.text   = arr[0];
    document.getElementById("target_select").options.add(newOpt);
  }
}

function removeItem(sender,isAll)
{
  var classList = document.getElementById("topic_class_list");
  var key = 'default';
  if (classList.value != "-1")
  {
    key = classList.options[classList.selectedIndex].text;
  }
  var arr = myTopic[key];
  if (!isAll)
  {
    var goodsName = sender.options[sender.selectedIndex].text;
    for (var j = 0; j < arr.length; j++)
    {
      if (arr[j].indexOf(goodsName) >= 0)
      {
          myTopic[key].splice(j,1);
      }
    }

    for (var i = 0; i < sender.options.length;)
    {
      if (sender.options[i].selected) {
        sender.remove(i);
        myTopic[key].splice(i, 0);
      }
      else
      {
        i++;
      }
    }
  }
  else
  {
    myTopic[key] = new Array();
    sender.innerHTML = "";
  }
}

/**
 * 判断当前浏览器类型
 */
function navigator_type()
{
  var type_name = '';

  if (navigator.userAgent.indexOf('MSIE') != -1)
  {
    type_name = 'IE'; // IE
  }
  else if(navigator.userAgent.indexOf('Firefox') != -1)
  {
    type_name = 'FF'; // FF
  }
  else if(navigator.userAgent.indexOf('Opera') != -1)
  {
    type_name = 'Opera'; // Opera
  }
  else if(navigator.userAgent.indexOf('Safari') != -1)
  {
    type_name = 'Safari'; // Safari
  }
  else if(navigator.userAgent.indexOf('Chrome') != -1)
  {
    type_name = 'Chrome'; // Chrome
  }

  return type_name;
}

//-->
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
