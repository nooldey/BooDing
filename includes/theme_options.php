<?php

$themename = "BooDing";
$shortname = "swt";

$number_entries = array("Select a Number:","1","2","3","4","5","6","7","8","9","10", "12","14", "16", "18", "20" );
$options = array (
	array(  "name" => $themename." Options",
      		"type" => "title"),

//SEO设置
    array(  "type" => "close"),
	array(  "name" => "网站SEO设置(必填)",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "描述（Description）",
			"desc" => "输入你的网站描述，一般不超过200个字符",
			"id" => $shortname."_description",
			"type" => "textarea",
            "std" => "碎碎念致力于构建技术分享平台，记录IT生活，记录wordpress技术，分享电气设计乐趣，与你共同探寻IT妙趣！"),

	array(	"name" => "关键词（KeyWords）",
            "desc" => "输入你的网站关键字，一般不超过100个字符",
            "id" => $shortname."_keywords",
            "type" => "textarea",
            "std" => "碎碎念，碎碎念ZWS，wordpress独立博客，wordpress主题，wordpress建站，电气工程及其自动化"),

//博客概况及链接设置
    array(  "type" => "close"),
	array(  "name" => "博客概况及链接设置(必填)",
			"type" => "section"),
	array(  "type" => "open"),

	array(	"name" => "用户名",
			"desc" => "",
			"id" => $shortname."_user",
            "type" => "text",
            "std" => "碎碎念zws"),

	array(	"name" => "建站日期",
            "desc" => "",
            "id" => $shortname."_builddate",
            "type" => "text",
            "std" => "2013-03-01"),

	array(	"name" => "首页展示友情链接ID",
            "desc" => "",
            "id" => $shortname."_linkscat",
            "type" => "text",
            "std" => "55"),

//网站统计、备案号
    array(  "type" => "close"),
	array(  "name" => "网站统计代码及备案号设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示网站统计",
			"desc" => "默认不显示",
            "id" => $shortname."_tj",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

    array(  "name" => "输入你的网站统计代码",
            "desc" => "",
            "id" => $shortname."_tjcode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示备案号",
			"desc" => "默认不显示",
            "id" => $shortname."_beian",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(  "name" => "输入您的备案号",
			"desc" => "",
            "id" => $shortname."_beianhao",
            "type" => "text",
            "std" => "海外棉被"),

//微博以及订阅设置
    array(  "type" => "close"),
	array(  "name" => "微博以及订阅设置",
			"type" => "section"),
	array(  "type" => "open"),


	array(  "name" => "是否显示新浪微博",
			"desc" => "默认不显示",
            "id" => $shortname."_tsina",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入新浪微博地址",
            "desc" => "",
            "id" => $shortname."_tsinaurl",
            "type" => "text",
            "std" => "http://weibo.com/nooldey"),

	array(  "name" => "是否显示QQ",
			"desc" => "默认不显示",
            "id" => $shortname."_qq",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入QQ",
            "desc" => "",
            "id" => $shortname."_qqhao",
            "type" => "text",
            "std" => ""),

	array(  "name" => "是否显示淘宝",
			"desc" => "默认不显示",
            "id" => $shortname."_taobao",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入淘宝店铺地址",
            "desc" => "",
            "id" => $shortname."_taobaourl",
            "type" => "text",
            "std" => ""),

	array(  "name" => "是否显示自定义网站",
			"desc" => "默认不显示",
            "id" => $shortname."_myweb",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入网站地址",
            "desc" => "",
            "id" => $shortname."_mylink",
            "type" => "text",
            "std" => ""),
	
	

//广告设置
    array(  "type" => "close"),
	array(  "name" => "博客广告设置",
			"type" => "section"),
	array(  "type" => "open"),

	array(  "name" => "是否显示侧边栏广告",
			"desc" => "默认不显示",
            "id" => $shortname."_ada",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入侧边栏广告代码(250*250)",
            "desc" => "",
            "id" => $shortname."_adacode",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => "是否显示文章底部广告",
			"desc" => "默认不显示",
            "id" => $shortname."_adb",
            "type" => "select",
            "std" => "Display",
            "options" => array("Hide", "Display")),

	array(	"name" => "输入文章底部广告代码(宽度需小于620)",
            "desc" => "",
            "id" => $shortname."_adbcode",
            "type" => "textarea",
            "std" => ""),
			
	array(	"type" => "close") 
);

function mytheme_add_admin() {
global $themename, $shortname, $options;
if ( $_GET['page'] == basename(__FILE__) ) {
	if ( 'save' == $_REQUEST['action'] ) {
		foreach ($options as $value) {
	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
foreach ($options as $value) {
	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
	header("Location: admin.php?page=theme_options.php&saved=true");
die;
}
else if( 'reset' == $_REQUEST['action'] ) {
	foreach ($options as $value) {
		delete_option( $value['id'] ); }
	header("Location: admin.php?page=theme_options.php&reset=true");
die;
}
}
add_theme_page($themename." Options", "当前主题设置", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}
function mytheme_add_init() {
$file_dir=get_bloginfo('template_directory');
wp_enqueue_style("functions", $file_dir."/includes/options/options.css", false, "1.0", "all");
wp_enqueue_script("rm_script", $file_dir."/includes/options/rm_script.js", false, "1.0");
}
function mytheme_admin() {
global $themename, $shortname, $options;
$i=0;
if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题设置已保存</strong></p></div>';
if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' 主题已重新设置</strong></p></div>';
?>

<div class="wrap rm_wrap">
<h2><?php echo $themename; ?> 设置</h2>
	<div class="version_tips">
		欢迎使用<?php echo $themename; ?>主题！	<a href="http://zhuweisheng.com.cn/" class="downloand_add">点击这里</a> 查看主题更新。
	</div>
		<div class="clear"></div>
<div class="rm_opts">
<div class="rm_opts">
<form method="post"> 
<?php foreach ($options as $value) {
switch ( $value['type'] ) {
case "open":
?>
<?php break;
case "close":
?>
</div>
</div>
<br />
<?php break;
case "title":
?>
<?php break;
case 'text':
?>
<div class="rm_input rm_text">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'textarea':
?>
<div class="rm_input rm_textarea">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
 	<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
 <small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php
break;
case 'select':
?>
<div class="rm_input rm_select">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
	<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
<?php foreach ($value['options'] as $option) { ?>
		<option value="<?php echo $option;?>" <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>>
		<?php
		if ((empty($option) || $option == '' ) && isset($value['default_option_value'])) {
			echo $value['default_option_value'];
		} else {
			echo $option; 
		}?>
		
		</option><?php } ?>
</select>
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
</div>
<?php
break;
case "checkbox":
?>
<div class="rm_input rm_checkbox">
	<label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
	<small><?php echo $value['desc']; ?></small><div class="clearfix"></div>
 </div>
<?php break; 
case "section":
$i++;
?>
<div class="rm_section">
<div class="rm_title">
	<h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt=""> <?php echo $i; ?>. <?php echo $value['name']; ?></h3>
	<div class="clearfix"></div>
</div>
<div class="rm_options">
	<span class="submit"><input name="save<?php echo $i; ?>" type="submit" value="保存设置" /></span>
<?php break;
}
}
?>
<input type="hidden" name="action" value="save" />
</form>
<form method="post">
	<div class="rm_section">
		<div class="rm_title">
			<h3><img src="<?php bloginfo('template_directory')?>/includes/options/clear.png" class="inactive" alt=""><font color="#ff0000">恢复默认设置（谨慎操作）</font></h3>
			<div class="clearfix"></div>
		</div>

		<div class="rm_options" style="display: none;">
			<div class="rm_input">
				<p class="submit">
				<input name="reset" type="submit" value="恢复默认" /> <font color="#ff0000">提示：此按钮将恢复主题初始状态，您的所有设置将消失！</font>
				<input type="hidden" name="action" value="reset" />
				</p>
			</div>
		</div>
		
	</div>
</form>
 </div> 
 <div class="kg"></div>
 </div>
<?php
}
add_action('admin_init', 'mytheme_add_init');
add_action('admin_menu', 'mytheme_add_admin');
?>