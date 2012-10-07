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
/**********************************************************************************
 * Modified for supporting UpYun
 *      https://github.com/ericshao/SugarCRM-PhotoField-UpYun
 *                          
 * Contributor(s):      eric.shao@qeemo.me
 *                      
 **********************************************************************************/
require_once('include/SugarFields/Fields/Base/SugarFieldBase.php');

class SugarFieldPhoto extends SugarFieldBase {
   
    var $style;
    
	function getDetailViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
	    /*
	    global $app_strings;
	    	
	    //Max Width
		if(empty($displayParams['max_width'])) {
		    $displayParams['max_width'] = $vardef['max_width'];
		}
		
		//Max Height 
		if(empty($displayParams['max_height'])) {
		    $displayParams['max_height'] = $vardef['max_height'];
		}
		
		//Style
		if(empty($displayParams['style'])) {
		    $displayParams['style'] = $vardef['style'];
		}
		
		$displayParams['t'] = time();

			
    	if(empty($displayParams['default_picture'])) {
		    if ( file_exists('custom/SynoFieldPhoto/phpThumb/images/defaults/' . $vardef['id'].'.jpg') ){
		        $displayParams['default_picture'] = 'defaults/' . $vardef['id'].'.jpg';
		    }
		}
		*/
		$this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
		
        return $this->fetch('include/SugarFields/Fields/Photo/DetailView.tpl');
    }
    
    function getEditViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
    	
    	$this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);        
        return $this->fetch('include/SugarFields/Fields/Photo/EditView.tpl');
    }
    
	function getSearchViewSmarty($parentFieldArray, $vardef, $displayParams, $tabindex) {
		$this->setup($parentFieldArray, $vardef, $displayParams, $tabindex);
		return $this->fetch('include/SugarFields/Fields/Photo/SearchView.tpl');
	}
}
?>
