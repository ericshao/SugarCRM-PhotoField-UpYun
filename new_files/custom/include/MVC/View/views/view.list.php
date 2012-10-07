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

require_once('include/MVC/View/views/view.list.php');

class CustomViewList extends ViewList{
	
 	function CustomViewList(){
 		parent::ViewList();
 	}

 	function listViewProcess(){
		$this->processSearchForm();
		$this->lv->searchColumns = $this->searchForm->searchColumns;
		if(!$this->headers)
			return;
		if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
			$this->lv->setup($this->seed, 'custom/SynoFieldPhoto/include/ListView/ListViewGeneric.tpl', $this->where, $this->params);
			$savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
			echo get_form_header($GLOBALS['mod_strings']['LBL_LIST_FORM_TITLE'] . $savedSearchName, '', false);
			echo $this->lv->display();
		}
 	}
 	
 	function processSearchForm(){
 	    if(isset($_REQUEST['query']))
        {
            // we have a query
            if(!empty($_SERVER['HTTP_REFERER']) && preg_match('/action=EditView/', $_SERVER['HTTP_REFERER'])) { // from EditView cancel
                $this->searchForm->populateFromArray($this->storeQuery->query);
            }
            else {
                $this->searchForm->populateFromRequest();
            }   
            //BOF SYNOFIELDPHOTO
            $photos_fields =array();
            foreach($this->searchForm->fieldDefs as $key => $arr_val){
                foreach($arr_val as $key_vale => $value_val){
                    if($key_vale == 'type' && $value_val == 'photo'){
                        if(!empty($this->searchForm->fieldDefs[$key]['value'])) {
                            $photos_fields[] = $key;
                        }
                    }
                }
            }
            foreach($photos_fields as $photo_field){                
                
                if(substr($photo_field, -6) == '_basic') $photo_field_name = substr($photo_field, 0, -6);
                else $photo_field_name = $photo_field;
                
                if(     is_array($this->searchForm->searchFields) 
                    &&  array_key_exists($photo_field_name, $this->searchForm->searchFields)
                ){
                    if(!empty($this->searchForm->searchFields[$photo_field_name]['value'])){
                        $this->searchForm->searchFields[$photo_field_name]['operator'] = 'in';
                        //$this->searchForm->searchFields[$photo_field_name]['query_type'] = 'format';
                        //$this->searchForm->searchFields[$photo_field_name]['subquery'] = "NULL,''";
                    }
                }
            }
            //EOF SYNOFIELDPHOTO
            $where_clauses = $this->searchForm->generateSearchWhere(true, $this->seed->module_dir);
            //BOF SYNOFIELDPHOTO
            foreach($where_clauses as $k => $w){
                $where_clauses[$k] = preg_replace('/(.*) in \(PHOTOEMPTY\)$/',"($1 IS NULL OR $1='')",$where_clauses[$k]);
                $where_clauses[$k] = preg_replace('/(.*) in \(PHOTONOTEMPTY\)$/',"($1 IS NOT NULL OR $1!='')",$where_clauses[$k]);
                
                
                $where_clauses[$k] = preg_replace('/(.*) like \'PHOTOEMPTY%\'$/',"($1 IS NULL OR $1='')",$where_clauses[$k]);
                $where_clauses[$k] = preg_replace('/(.*) like \'PHOTONOTEMPTY%\'$/',"($1 IS NOT NULL OR $1!='')",$where_clauses[$k]);
            }
            //EOF SYNOFIELDPHOTO
            if (count($where_clauses) > 0 )$this->where = '('. implode(' ) AND ( ', $where_clauses) . ')';
            $GLOBALS['log']->info("List View Where Clause: $this->where");
        }
        if($this->use_old_search){
            switch($view) {
                case 'basic_search':
                    $this->searchForm->setup();
                    $this->searchForm->displayBasic($this->headers);
                    break;
                 case 'advanced_search':
                    $this->searchForm->setup();
                    $this->searchForm->displayAdvanced($this->headers);
                    break;
                 case 'saved_views':
                    echo $this->searchForm->displaySavedViews($this->listViewDefs, $this->lv, $this->headers);
                   break;
            }
        }else{
            echo $this->searchForm->display($this->headers);
        }
 	}
}
?>
