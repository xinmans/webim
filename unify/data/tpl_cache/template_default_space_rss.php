<?php if(!defined('IN_UCHOME')) exit('Access Denied');?><?php subtplcheck('template/default/space_rss', '1268675480', 'template/default/space_rss');?><?=$tag?>xml version="1.0" encoding="<?=$_SC['charset']?>"?>
<rss version="2.0">
<channel>
<?php if($space['uid']) { ?>
<title><?=$_SN[$space['uid']]?></title>
<link><?=$space['space_url']?></link>
<description><?=$_SN[$space['uid']]?></description>
<?php } else { ?>
<title><?=$_SCONFIG['sitename']?></title>
<link><?=$siteurl?></link>
<description><?=$_SCONFIG['sitename']?></description>
<?php } ?>
<copyright><?=$_SCONFIG['sitename']?></copyright>
<generator>UCenter Home <?=X_VER?></generator>
<lastBuildDate><?=$space['lastupdate']?></lastBuildDate>

<?php if(is_array($list)) { foreach($list as $value) { ?>
<item>
<title><?=$value['subject']?></title>
<link><?=$siteurl?>space.php?uid=<?=$value['uid']?>&amp;do=blog&amp;id=<?=$value['blogid']?></link>
<description><![CDATA[<?=$value['message']?>]]></description>
<author><?=$_SN[$value['uid']]?></author>
<pubDate><?=$value['dateline']?></pubDate>
</item>
<?php } } ?>

</channel>
</rss><?php ob_out();?>