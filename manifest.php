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
global $manifest;
global $installdefs;

$manifest = array (
    'acceptable_sugar_versions' => array (
          '5.5.*'
    ),
    'published_date' => '2010-03-26 13:00:00',
    'version' => '20100326',
    
    'author' => 'Scheinarts & SYNOLIA',
    'description' => 'Photo Field by SYNOLIA',
    'is_uninstallable' => true,
    'name' => 'SYNOLIA - Photo Field',
    'type' => 'module',
    'remove_tables' => 'prompt',
);
$installdefs = array (

    'id' => 'SynoFieldPhoto',

    'pre_execute'=>array(
        0 => '<basepath>/actions/pre_install_actions.php',
    ),
    'post_execute'=>array(
        0 => '<basepath>/actions/post_install_actions.php',
    ),
    'pre_uninstall'=>array(
        0 => '<basepath>/actions/pre_uninstall_actions.php',
    ),
    'post_uninstall'=>array(
        0 => '<basepath>/actions/post_uninstall_actions.php',
    ),
    'language'=> array(
        array(
			'from'=> '<basepath>/language/application.fr_FR.php',
			'to_module'=> 'application',
			'language'=>'fr_FR'
		),
		array(
			'from'=> '<basepath>/language/application.en_us.php',
			'to_module'=> 'application',
			'language'=>'en_us'
		),
		array(
			'from'=> '<basepath>/language/application.es_es.php',
			'to_module'=> 'application',
			'language'=>'es_es'
		),
		array(
			'from'=> '<basepath>/language/editcustomfields.fr_FR.php',
			'to_module'=> 'EditCustomFields',
			'language'=>'fr_FR'
		),
		array(
			'from'=> '<basepath>/language/editcustomfields.en_us.php',
			'to_module'=> 'EditCustomFields',
			'language'=>'en_us'
		),
		array(
			'from'=> '<basepath>/language/editcustomfields.es_es.php',
			'to_module'=> 'EditCustomFields',
			'language'=>'es_es'
		),
		array(
			'from'=> '<basepath>/language/modulebuilder.fr_FR.php',
			'to_module'=> 'ModuleBuilder',
			'language'=>'fr_FR'
		),
		array(
			'from'=> '<basepath>/language/modulebuilder.en_us.php',
			'to_module'=> 'ModuleBuilder',
			'language'=>'en_us'
		),
		array(
			'from'=> '<basepath>/language/modulebuilder.en_us.php',
			'to_module'=> 'ModuleBuilder',
			'language'=>'en_us'
		),
		array(
          'from'=> '<basepath>/language/administration.fr_FR.php',
          'to_module'=> 'Administration',
          'language'=>'fr_FR'
        ),
        array(
          'from'=> '<basepath>/language/administration.es_es.php',
          'to_module'=> 'Administration',
          'language'=>'es_es'
        ),
        
        array(
          'from'=> '<basepath>/language/administration.en_us.php',
          'to_module'=> 'Administration',
          'language'=>'en_us'
        ),
    ),
    'copy' => array(
        array('from'=> '<basepath>/new_files/icons/synolia.gif',
              'to'=> 'themes/default/images/synolia.gif',
        ),
        array('from'=> '<basepath>/new_files/custom/SynoFieldPhoto/SynoFieldPhoto.php',
              'to'=> 'custom/SynoFieldPhoto/SynoFieldPhoto.php',
        ),
        array('from'=> '<basepath>/new_files/custom/SynoFieldPhoto/phpThumb/',
              'to'=> 'custom/SynoFieldPhoto/phpThumb/',
        ),
        array('from'=> '<basepath>/new_files/include/SugarFields/Fields/Photo/',
              'to'=> 'include/SugarFields/Fields/Photo/',
        ),
        array('from'=> '<basepath>/new_files/modules/DynamicFields/templates/Fields/Templatephoto.php',
              'to'=> 'modules/DynamicFields/templates/Fields/Templatephoto.php',
        ),
        array('from'=> '<basepath>/new_files/modules/DynamicFields/templates/Fields/Forms/photo.php',
              'to'=> 'modules/DynamicFields/templates/Fields/Forms/photo.php',
        ),
        array('from'=> '<basepath>/new_files/modules/DynamicFields/templates/Fields/Forms/photo.tpl',
              'to'=> 'modules/DynamicFields/templates/Fields/Forms/photo.tpl',
        ),
        array('from'=> '<basepath>/new_files/custom/include/MVC/View/views/view.list.php',
              'to'=> 'custom/include/MVC/View/views/view.list.php',
        ),
        array('from'=> '<basepath>/new_files/custom/SynoFieldPhoto/include/ListView/ListViewGeneric.tpl',
              'to'=> 'custom/SynoFieldPhoto/include/ListView/ListViewGeneric.tpl',
        ),
        array('from'=> '<basepath>/new_files/include/generic/SugarWidgets/SugarWidgetSubPanelDetailViewSynoFieldPhoto.php',
              'to'=> 'include/generic/SugarWidgets/SugarWidgetSubPanelDetailViewSynoFieldPhoto.php',
        ),
        array (
            'from' => '<basepath>/new_files/modules/Administration/synofieldphoto_manage.php',
            'to' => 'modules/Administration/synofieldphoto_manage.php',
        ),
        array (
            'from' => '<basepath>/new_files/modules/Administration/synofieldphoto_manage.tpl',
            'to' => 'modules/Administration/synofieldphoto_manage.tpl',
        ),
        
    ),
    
    'administration'=> array(
        array(
            'from'=>'<basepath>/administration/synofieldphoto_options.php',
        ),
    ),
);
?>