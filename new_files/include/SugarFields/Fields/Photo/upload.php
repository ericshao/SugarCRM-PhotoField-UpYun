<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
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
 * The Initial Developer of the Original Code is scheinarts
 *      https://www.sugarcrm.com/forums/member.php?u=49631
 *      https://www.sugarcrm.com/forums/showthread.php?t=26723
 *                          
 * Contributor(s):      SYNOLIA - SYNOFIELDPHOTO
 *                      www.synolia.com - sugar@synolia.com
 **********************************************************************************/
/**********************************************************************************
 * Modified for supporting UpYun
 *      https://github.com/ericshao/SugarCRM-PhotoField-UpYun
 *                          
 * Contributor(s):      eric.shao@qeemo.me
 *                      
 **********************************************************************************/ 

 
global $current_user;
if( empty($_GET['id']) ){
    echo 'id required';
}
elseif( empty($_GET['module']) ){
    echo 'module required';
}
elseif( empty($_GET['field']) ){
    echo 'field required';
}
else{

	require_once('upyun.class.php');
	require_once('upyun.config.php');

    $module_name = $_GET['module'];
    $field_name = $_GET['field'];
    
    global $beanList, $beanFiles, $sugar_config;
    $class_name = $beanList[$module_name];
	require_once($beanFiles[$class_name]);
	$seed = new $class_name();
        
    $seed->retrieve($_GET['id']);
    
    $max_size_picture = $sugar_config['max_size_picture'];
    if(empty($max_size_picture)){
        $max_size_picture = 1000000;
    }
    
    if($seed->ACLAccess('edit')){

		//确定图片文件扩展名
		if ($_FILES["file"]["type"] == "image/gif") {
			$file_ext = ".gif";
		} 
		elseif (($_FILES["file"]["type"] == "image/jpeg") 
                ||  ($_FILES["file"]["type"] == "image/jpg") 
                ||  ($_FILES["file"]["type"] == "image/pjpeg")){
            $file_ext = ".jpg";
        } 
        elseif ($_FILES["file"]["type"] == "image/png") {
        	$file_ext = ".png";
        }	
        
        //设置图片上传后的文件名
        $file_name = $module_name.'_'.$field_name.'_'.$seed->id.$file_ext;

        if (    
            (
                    ($_FILES["file"]["type"] == "image/gif") 
                ||  ($_FILES["file"]["type"] == "image/jpeg") 
                ||  ($_FILES["file"]["type"] == "image/jpg") 
                ||  ($_FILES["file"]["type"] == "image/pjpeg") 
                ||  ($_FILES["file"]["type"] == "image/png") 
            )
            &&  
            (
                $_FILES["file"]["size"] < $max_size_picture
            )
        ){
            if ($_FILES["file"]["error"] > 0){
                echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
            }
            else{
				//将图片上传至又拍云存储
				$fh = fopen($_FILES["file"]["tmp_name"],'r'); 
    	 		$upyun->writeFile("/".$field_name."/" . $file_name, $fh, true);
     		    fclose($fh);
    		    
    		    //返回上传后成功的地址
    		    //echo $file_name;
    		    echo '<img src="' . $upyunHost . $field_name . "/" . $file_name . '">';
    		    

            }
        }
        elseif($_FILES["file"]["size"] >= $max_size_picture){
            echo "Error: File too big " . formatSize($_FILES["file"]["size"]) . ": ". formatSize($max_size_picture) ." Max <br />";
        }
        else{
            echo "Error: " . $_FILES["file"]["type"] . " not allowded <br />";
        }
        
    }
    else{
        echo 'Not allowed to Edit this '.$class_name;
    }
}

function formatSize($size){
    switch (true){
    case ($size > 1099511627776):
        $size /= 1099511627776;
        $suffix = 'To';
    break;
    case ($size > 1073741824):
        $size /= 1073741824;
        $suffix = 'Go';
    break;
    case ($size > 1048576):
        $size /= 1048576;
        $suffix = 'Mo';   
    break;
    case ($size > 1024):
        $size /= 1024;
        $suffix = 'Ko';
        break;
    default:
        $suffix = 'o';
    }
    return round($size, 0).$suffix;
}

?>
