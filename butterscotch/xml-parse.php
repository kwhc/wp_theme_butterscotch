<?php 

	$awsfeed = simplexml_load_file('http://www.astorwines.com/xml/snoothxml.xml');	
	//$skulist = array(27603,25396,23296);
	  $sku1 = get_post_meta($post->ID, 'item_01',true);
	  $sku2 = get_post_meta($post->ID, 'item_02',true);
	  $sku3 = get_post_meta($post->ID, 'item_03',true);
	  $sku4 = get_post_meta($post->ID, 'item_04',true);
	  $sku5 = get_post_meta($post->ID, 'item_05',true);
	  $sku6 = get_post_meta($post->ID, 'item_06',true);
	  $sku7 = get_post_meta($post->ID, 'item_07',true);
	  $sku8 = get_post_meta($post->ID, 'item_08',true);
	  $sku9 = get_post_meta($post->ID, 'item_09',true);
	  $sku10 = get_post_meta($post->ID, 'item_10',true);
	  $sku11 = get_post_meta($post->ID, 'item_11',true);
	  $skulist = array($sku1, $sku2, $sku3, $sku4, $sku5, $sku6, $sku7, $sku8, $sku9, $sku10, $sku11);
    $category = get_the_category();
    $specialcharacterarray = array(':','?');
    $title=strtolower(str_replace(' ', '_', get_the_title()));
    $title=str_replace($specialcharacterarray,"",$title);

	echo "<ul id='productList'>";
	foreach ($awsfeed->wine as $productinfo){
		$name=$productinfo->name;
		$sku=$productinfo->sku;
		$imgURL=$productinfo->image_url;
		$region=$productinfo->appellation;
		$country=$productinfo->country;
		$itemURL=$productinfo->product_url."&utm_source=tastingnotes&utm_campaign="."ct_".get_the_date('ymd')."_tastingnotes"."&utm_content=".$title."&utm_medium=referral";
		
		foreach($skulist as $item){
			if ($sku == $item){
				echo "<li class='clearfix'><a href='".$itemURL."'><img src='http://www.astorwines.com/images/itemimages/sm/",$sku,"_sm.jpg' /></a><h3><a href='",$itemURL,"'>",$name,"</a></h3><div>",$region,", ",$country,"</div><div><a href='",$itemURL,"'>Buy Now &raquo;</a></div></li>";
			}
		}
		
	}
	echo "</ul>";
	
?>