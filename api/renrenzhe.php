<?php 
/**
 * ECGROUPON 团购接口
 * ============================================================================
 * 网站地址: http://www.ecgroupon.com；
 */
define('IN_ECS', true);
define('INIT_NO_USERS', true);
define('INIT_NO_SMARTY', true);
require('./init.php');
require_once(ROOT_PATH . 'includes/lib_group.php');
header('Content-Type: application/xml; charset=' . EC_CHARSET);
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Thu, 27 Mar 1975 07:38:00 GMT');
header('Last-Modified: ' . date('r'));
header('Pragma: no-cache');
	$sql = "SELECT a.group_id,a.group_name,a.group_image,a.start_time,a.group_need,a.is_hdfk,a.already_orders,a.group_type,a.end_time,a.past_time,a.market_price,a.ext_info,a.city_id,a.group_desc,a.group_keywords,b.suppliers_name,b.suppliers_site,b.west_way,b.east_way,b.phone,b.address " .
            "FROM " . $GLOBALS['ecs']->table('group_activity')." AS a, ". $GLOBALS['ecs']->table('suppliers')." AS b ";
	$now = gmtime();
	$where = " WHERE a.start_time <= '$now' AND a.is_finished ='0' AND a.suppliers_id = b.suppliers_id ";
	$where .= 'AND a.activity_type=1 AND a.is_show = 1';
	$sql .= $where . " ORDER BY a.group_type ASC, a.start_time DESC, sort_order DESC";
    $res = $GLOBALS['db']->query($sql);
	$weburl = $ecs->url();
	$weburl = str_replace('/api', '',$weburl);
    $xml = '<?xml version="1.0" encoding="utf-8"?><urlset>';
    while ($group_buy = $GLOBALS['db']->fetchRow($res))
	{
	   
	     $ext_info = unserialize($group_buy['ext_info']);
         $group_buy = array_merge($group_buy, $ext_info);
         $price_ladder = $group_buy['price_ladder'];
         if (!is_array($price_ladder) || empty($price_ladder))
         {
            $price_ladder = array(array('amount' => 0, 'price' => 0));
         }
         else
        {
           foreach ($price_ladder as $key => $amount_price)
           {   
            $price_ladder[$key]['formated_price'] = $amount_price['price'];
           }
		}
		$orders_num = get_group_orders($group_buy['group_id'], $group_buy['group_need'],$group_buy['is_hdfk']);
		$group_buy['orders_num'] = $orders_num + $group_buy['already_orders'];
        $group_buy['price_ladder'] = $price_ladder;
	    $group_buy['group_price'] = $price_ladder[0]['formated_price'];
	    $group_buy['group_rebate'] = number_format($price_ladder[0]['price']/$group_buy['market_price'], 2, '.', '');
		$group_buy['lack_price'] = $group_buy['market_price']- $group_buy['group_price'];
		$group_url = rewrite_groupurl('team.php',array('id' => $group_buy['group_id']));
		if($group_buy['group_type'] == 1){
			$major = 1;
		}else{
			$major = 0;
		}
	    $group_id = $group_buy['group_id'];
		$city_id = $group_buy['city_id'];
	    $sql = 'SELECT city_name,eng_name FROM ' . $GLOBALS['ecs']->table('group_city') . 
		       " WHERE city_id ='$city_id'";
		$city = $db->getRow($sql);		
          $xml .= '<url>';
          $xml .= '<loc><![CDATA['.$weburl.$group_url.']]></loc>';
          $xml .= '<data>';
          $xml .= '<display>';
          $xml .= '<website>'. $_CFG['group_shopname'] .'</website>';
          $xml .= '<identifier>'.$group_buy['group_id'].'</identifier>';
          $xml .= '<siteurl>'.$weburl. '</siteurl>';
          $xml .= '<city>'. $city['city_name'] .'</city>';
          $xml .= '<title>' . $group_buy['group_name'] . '</title>';
          $xml .= '<major>'.$major.'</major>';
		  if ($group_buy['goods_type'] == 2)
		  {
		   $post = 'yes';
		  }
		  else
		  {
		   $post = 'no';
		  }
		  $xml .= '<post>'. $post .'</post>';
		
		  $cat_type_num = '';
		  $xml .= '<category>'.$cat_type_num.'</category>';
		  $xml .= '<tag>'.$group_buy['group_keywords'].'</tag>';
          $xml .= '<image>'. $weburl . $group_buy['group_image'] .'</image>';
          $xml .= '<startTime>'. $group_buy['start_time'] .'</startTime>';
          $xml .=  '<endTime>'. $group_buy['end_time'] .'</endTime>';
          $xml .= '<value>'. $group_buy['market_price'] .'</value>';
          $xml .= '<price>'.$group_buy['group_price'].'</price>';	
		  $xml .= '<bought>'.$group_buy['orders_num'].'</bought>';
		  if ($group_buy['is_finished'] == 2 || $group_buy['is_finished'] == 5)
			{
		   $soldOut = '1';
			}
		  else
			{
		   $soldOut = '0';
			}
		  $xml .= '<soldOut>'.$soldOut.'</soldOut>';
		  $xml .= '<goodsDueTime>' . $group_buy['past_time'] . '</goodsDueTime>';
		  $xml .= '<tip><![CDATA['.strip_tags($group_buy['goods_comment']).']]></tip>';
		  $xml .= '<detail><![CDATA['.$group_buy['group_desc'].']]></detail>';
         $xml .= '</display><shops><shop>';
         $xml .= '<name>'.$group_buy['suppliers_name'].'</name>';
		 $xml .= '<tel>'.$group_buy['phone'].'</tel>';
		 $xml .= '<addr>'.$group_buy['address'].'</addr>';
		 $xml .= '<area>'.$group_buy['suppliers_site'].'</area>';
         $xml .= '<longitude>'.$group_buy['west_way'].'</longitude>';
         $xml .= '<latitude>'.$group_buy['east_way'].'</latitude>';
		 $xml .= '</shop></shops></data></url>';
	}
	$xml .= '</urlset>';
echo $xml;
?>