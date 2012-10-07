<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

global $current_user, $beanList, $sugar_config, $current_language, $mod_strings, $beanList;
if (!is_admin($current_user)) sugar_die("Unauthorized access to administration.");

require_once('include/Sugar_Smarty.php');
$sugar_smarty   = new Sugar_Smarty();

require_once('modules/Configurator/Configurator.php');
$cfg            = new Configurator();

echo get_module_title('', $mod_strings['LBL_SYNOFIELDPHOTO_TITLE'], false);

if(isset($_REQUEST['process']) && $_REQUEST['process'] == 'true') {
    $cfg->allow_undefined[] = 'max_size_picture';
    
    $cfg->populateFromPost();
    $cfg->handleOverride();
}

$tpl = 'modules/Administration/synofieldphoto_manage.tpl';
$sugar_smarty->assign('MOD', $mod_strings);
$sugar_smarty->assign('APP', $app_strings);
$sugar_smarty->assign('APP_LIST', $app_list_strings);
$sugar_smarty->assign('CONFIG', $sugar_config);
$sugar_smarty->display($tpl);
?>