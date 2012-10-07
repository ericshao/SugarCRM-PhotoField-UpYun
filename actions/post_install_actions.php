<?php
/*********************************************************************************
 * The contents of this file are subject to the SugarCRM Public License Version
 * 1.1.3 ("License"); You may not use this file except in compliance with the
 * License. You may obtain a copy of the License at http://www.sugarcrm.com/SPL
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied.  See the License
 * for the specific language governing rights and limitations under the
 * License.
 * All copies of the Covered Code must include on each user interface screen:
 *    (i) the "Powered by SugarCRM" logo and
 *    (ii) the SugarCRM copyright notice
 * in the same form as they appear in the distribution.  See full license for
 * requirements.
 *
 * Your Warranty, Limitations of liability and Indemnity are expressly stated
 * in the License.  Please refer to the License for the specific language
 * governing these rights and limitations under the License.  Portions created
 * by SugarCRM are Copyright (C) 2004-2010 SugarCRM, Inc.; All Rights Reserved.
 *
 * Portions created by SYNOLIA are Copyright (C) 2004-2010 SYNOLIA. You do not
 * have the right to remove SYNOLIA copyrights from the source code or user
 * interface.
 *
 * All Rights Reserved. For more information and to sublicense, resell,rent,
 * lease, redistribute, assign or otherwise transfer Your rights to the Software
 * contact SYNOLIA at contact@synolia.com
***********************************************************************************/
/**********************************************************************************
 * The Original Code is:    SYNOFIELDPHOTO by SYNOLIA
 *                          www.synolia.com - sugar@synolia.com
 * Contributor(s):          ______________________________________.
 * Description :            ______________________________________.
 **********************************************************************************/
 
//Remove any previous version
echo '<br />---> Clean entry_point_registry.php from any previous installation<br />';
$filename = 'custom/include/MVC/Controller/entry_point_registry.php';
echo 'Handle '.$filename.'<br />';
if(!is_file($filename) ){
    echo 'File '.$filename.' doesn\'t exist.<br />';
}
else if(!is_readable($filename) ){
    echo 'Failed: file '.$filename.' is not readable.<br />';
}
else if(!is_writable($filename) ){
    echo 'Failed: file '.$filename.' is not writable.<br />';
}
else{
    $handle = fopen ($filename, "r");
    if(filesize ($filename)>0){
        $contents = fread ($handle, filesize ($filename));
        $pattern = '/^(.*)<\?php(.*)\/\/BOF SYNOFIELDPHOTO SYNOLIA(.*)\/\/EOF SYNOFIELDPHOTO SYNOLIA(.*)\?>(.*)$/si';
        $replacement = '$1$5';
        $new_content = preg_replace($pattern, $replacement, $contents);
        fclose ($handle);
    
        $handle = fopen ($filename, "w+");
        if( fwrite($handle, $new_content) ){
            echo 'Success: '.$filename.' modified.<br />';
        }
        else{
            echo 'Failed: error during '.$filename.' modification.<br />';
        }
    }
    fclose ($handle);
}

echo '<br />---> Modify the custom entry_point_registry.php file<br />';

$filepath = 'custom/include/MVC/Controller';
$filename = $filepath.'/entry_point_registry.php';
if(!function_exists('mkdir_recursive')) {
    require_once('include/dir_inc.php');
}
if(!is_dir($filepath)){
    mkdir_recursive($filepath);
}

echo 'Handle '.$filename.'<br />';
$modification_error = false;
if(is_file($filename)){
    require_once $filename;
    if(!is_readable($filename) ){
        echo '---> Failed: file '.$filename.' is not readable.<br />';
        $modification_error = true;
    }
    else if(!is_writable($filename) ){
        echo '---> Failed: file '.$filename.' is not writable.<br />';
        $modification_error = true;
    }
}

if(!$modification_error){
    $new_line = '<?php
//BOF SYNOFIELDPHOTO SYNOLIA
    $entry_point_registry[\'iframe\'] = array(
        \'file\' => \'include/SugarFields/Fields/Photo/iframe.php\', 
        \'auth\' => true,
    );
    $entry_point_registry[\'phpthumb\'] = array(
        \'file\' => \'include/SugarFields/Fields/Photo/SynoFieldPhoto/phpThumb/phpThumb.php\', 
        \'auth\' => true,
    );
    $entry_point_registry[\'upload\'] = array(
        \'file\' => \'include/SugarFields/Fields/Photo/upload.php\', 
        \'auth\' => true,
    );
//EOF SYNOFIELDPHOTO SYNOLIA
?>';

    if( $fh = @fopen( $filename, 'a' ) ){
        fputs( $fh, $new_line, strlen($new_line) );
        fclose( $fh );
        echo '---> '.$filename.' updated<br />';
    }
    else {
        echo '---> '.$filename.' NOT updated. Please check file '.$filename.'<br />';
    }
}
echo '<br />';

//Logick Hooks Installation 
require_once('modules/ModuleBuilder/Module/StudioBrowser.php');
$sb = new StudioBrowser();
$sb->loadModules();
foreach ($sb->modules as $key => $fieldDef) {
    echo '---> Add SynoFieldPhoto logichooks for '.$key.'<br>';
    check_logic_hook_file($key, 'after_retrieve', array(1, 'clean_pictures',  'custom/SynoFieldPhoto/SynoFieldPhoto.php', 'SynoFieldPhotoClass', 'clean_pictures'));
    check_logic_hook_file($key, 'before_save', array(1, 'clean_pictures',  'custom/SynoFieldPhoto/SynoFieldPhoto.php', 'SynoFieldPhotoClass', 'clean_pictures'));
    check_logic_hook_file($key, 'before_delete', array(1, 'clean_pictures',  'custom/SynoFieldPhoto/SynoFieldPhoto.php', 'SynoFieldPhotoClass', 'clean_pictures'));
}
?>