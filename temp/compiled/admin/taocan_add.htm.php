<!-- $Id: taocan.htm 16752 2009-10-20 09:59:38Z wangleisvn $ -->
<link href="../js/submodal/submodal.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<!-- start add new category form -->
<div class="main-div">

<script type="text/javascript" src="../js/submodal/submodal.js"></script>

  <form action="taocan.php" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
  <table width="100%" id="general-table">
      <tr>
        <td class="label">套餐名称:</td>
        <td>
          <input type='text' name='taocan_name' maxlength="20" value='' size='27' id="taocan_name" /> <font color="red">*</font>
        </td>
      </tr>
      <tr>
        <td class="label">绑定商品ID:</td>
        <td>
         <input type="text" name='goods_id' value='' size="12" id="goods_id" />
        <font color="red">*</font></td>
      </tr>

      <tr id="measure_unit">
        <td class="label">配送下限:</td>
        <td>
          <input type="text" name='shxiaxian' value='' size="12" id="shxiaxian" />斤
        <font color="red">*</font></td>
      </tr>

      <tr>
        <td class="label">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      </table>
      <div class="button-div">
        <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" />
        <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" />
      </div>
    <input type="hidden" name="act" value="insert" />
  </form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
document.forms['theForm'].elements['cat_name'].focus();
/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("cat_name",      catname_empty);
  if (parseInt(document.forms['theForm'].elements['grade'].value) >10 || parseInt(document.forms['theForm'].elements['grade'].value) < 0)
  {
    validator.addErrorMsg('<?php echo $this->_var['lang']['grade_error']; ?>');
  }
  return validator.passed();
}
onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

/**
 * 新增一个筛选属性
 */
function addFilterAttr(obj)
{
  var src = obj.parentNode.parentNode;
  var tbl = document.getElementById('tbody-attr');

  var validator  = new Validator('theForm');
  var filterAttr = document.getElementsByName("filter_attr[]");

  if (filterAttr[filterAttr.length-1].selectedIndex == 0)
  {
    validator.addErrorMsg(filter_attr_not_selected);
  }
  
  for (i = 0; i < filterAttr.length; i++)
  {
    for (j = i + 1; j <filterAttr.length; j++)
    {
      if (filterAttr.item(i).value == filterAttr.item(j).value)
      {
        validator.addErrorMsg(filter_attr_not_repeated);
      } 
    } 
  }

  if (!validator.passed())
  {
    return false;
  }

  var row  = tbl.insertRow(tbl.rows.length);
  var cell = row.insertCell(-1);
  cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addFilterAttr)(.*)(\[)(\+)/i, "$1removeFilterAttr$3$4-");
  filterAttr[filterAttr.length-1].selectedIndex = 0;
}

/**
 * 删除一个筛选属性
 */
function removeFilterAttr(obj)
{
  var row = rowindex(obj.parentNode.parentNode);
  var tbl = document.getElementById('tbody-attr');

  tbl.deleteRow(row);
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>