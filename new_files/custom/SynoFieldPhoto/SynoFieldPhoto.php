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
 * The Original Code is:    SYNOFIELDPHOTO by SYNOLIA
 *                          www.synolia.com - sugar@synolia.com
 * Contributor(s):          ______________________________________.
 * Description :            ______________________________________.
 **********************************************************************************/

class SynoFieldPhotoClass {

    function clean_pictures(&$focus, $event, $arguments){
        $GLOBALS['log']->debug('BEGIN '. __FUNCTION__); 
        
        if(     
                $event == 'after_retrieve' 
            &&  !empty($_POST) 
            &&  !empty($_POST['action']) 
            &&  $_POST['action']=='DetailView' 
        ){
            //Remove New Pictures if the Cancel button has be pressed
            foreach ($focus->field_name_map as $key => $fieldDef) {
                if (
                        !empty($focus->field_name_map[$key]['type'])
                    &&  $focus->field_name_map[$key]['type'] == 'photo'
                    &&  !empty($focus->field_name_map[$key]['name'])
                ){
                    $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Cancel button pressed'); 
                    $picture_path = 'custom/SynoFieldPhoto/phpThumb/images/new_'.$focus->module_dir.'_'.$focus->field_name_map[$key]['name'].'_'.$focus->id.'.jpg';
                    if(is_file( $picture_path )){
                        $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Remove '.$picture_path); 
                        @unlink($picture_path);
                    }
    			}
    		}
        }
        elseif(
                $event == 'before_delete' 
        ){
            //Remove Pictures after Delete
            foreach ($focus->field_name_map as $key => $fieldDef) {
                if (
                        !empty($focus->field_name_map[$key]['type'])
                    &&  $focus->field_name_map[$key]['type'] == 'photo'
                    &&  !empty($focus->field_name_map[$key]['name'])
                ){
                    $GLOBALS['log']->debug(__FUNCTION__.' '.$event); 
                    $picture_path = 'custom/SynoFieldPhoto/phpThumb/images/'.$focus->module_dir.'_'.$focus->field_name_map[$key]['name'].'_'.$focus->id.'.jpg';
                    if(is_file( $picture_path )){
                        $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Remove '.$picture_path); 
                        @unlink($picture_path);
                    }
    			}
    		}
        }
        elseif(
                $event == 'before_save'
        ){
            //New Picture Uploaded: new Picture is copied to old picture and new Picture is removed
            foreach ($focus->field_name_map as $key => $fieldDef) {
                if (
                        !empty($focus->field_name_map[$key]['type'])
                    &&  $focus->field_name_map[$key]['type'] == 'photo'
                    &&  !empty($focus->field_name_map[$key]['name'])
                ){
                    $GLOBALS['log']->debug(__FUNCTION__.' '.$event);   
                    $picture_field_name = $focus->field_name_map[$key]['name'];
                    if(!empty($focus->$picture_field_name)){
                        $GLOBALS['log']->debug(__FUNCTION__.' '.$focus->picture_field_name.' not empty:'.$focus->$picture_field_name);
                        
                        $old_picture_path = 'custom/SynoFieldPhoto/phpThumb/images/'.$focus->module_dir.'_'.$focus->field_name_map[$key]['name'].'_'.$focus->id.'.jpg';
                        $new_picture_path = 'custom/SynoFieldPhoto/phpThumb/images/new_'.$focus->module_dir.'_'.$focus->field_name_map[$key]['name'].'_'.$focus->id.'.jpg';
                        if(is_file( $new_picture_path )){
                            
                            //The field already has already a Picture
                            if(is_file( $old_picture_path )){
                                $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Move '.$new_picture_path.' to '.$old_picture_path); 
                                @copy($new_picture_path,$old_picture_path);
                                
                                $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Remove '.$new_picture_path); 
                                @unlink($new_picture_path);
                            }
                            else{
                                $GLOBALS['log']->debug(__FUNCTION__.' '.$event.' Rename '.$new_picture_path.' to '.$old_picture_path); 
                                @rename($new_picture_path,$old_picture_path);
                            }
                        }
                    }
                    else{
                        $GLOBALS['log']->fatal(__FUNCTION__.' '.$picture_field_name.' empty'.$old_picture_path);
                        
                        $old_picture_path = 'custom/SynoFieldPhoto/phpThumb/images/'.$focus->module_dir.'_'.$focus->field_name_map[$key]['name'].'_'.$focus->id.'.jpg';
                        if(is_file( $old_picture_path )){
                            $GLOBALS['log']->fatal(__FUNCTION__.' '.$event.' Remove '.$old_picture_path); 
                            @unlink($old_picture_path);
                        }
                    }
    			}
    		}
    	}
        
        $GLOBALS['log']->debug('END '. __FUNCTION__);        
    }
}
?>
