<?php
include_once("../config.php");
$url = "http://update.nextim.cn/webim/update/version";
$latest_version = explode("\n",file_get_contents($url));
$latest_version = $latest_version[0];
$cur_version = $_IMC['version'];
$data = array("version"=>$latest_version);

$platform = which_platform();
 
switch($platform){
    case 'uchome':
        include_once($_IMC["install_path"] .'webim/lib/uchome.php');
        $db_obj = $_SGLOBAL['db'];
        break;
    case 'discuz':
        include_once($_IMC["install_path"] .'webim/lib/discuz.php');
        $db_obj = $db;
        break;
}

$admins = explode(",",$_IMC['admin_ids']);

if ($latest_version == $cur_version){
    //do nothing
}
else{
    foreach($admins as $admin)
    {
        $time = microtime(true)*1000;
        $body = from_utf8("WebIM有新的更新！请访问".$_IMC['install_url']."update/index.php了解详情!");
        $columns = "`uid`,`send`,`to`,`from`,`style`,`body`,`timestamp`,`type`";
        $values_from = "'1','0','$admin','webim','','$body','$time','unicast'";
        $db_obj->query("INSERT INTO ".im_tname('histories')." ($columns) VALUES ($values_from)");
    }
}

function which_platform(){
	/*
	 *  check the platform 
	 *  Uchome ? Discuz ?  PhpWind?
	 *
	 */
    global $_IMC;
	if(file_exists($_IMC["install_path"].'data')){
		return "uchome";
	}
	if(file_exists($_IMC["install_path"].'forumdata')){
		return "discuz";
	}
}

?>
