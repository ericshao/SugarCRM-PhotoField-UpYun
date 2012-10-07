{*
 **********************************************************************************
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
 *}
{if !empty({{sugarvar key='value' string=true}})}
    <img src='custom/SynoFieldPhoto/phpThumb/phpThumb.php?src=images/{{sugarvar key='value'}}&h={{if !empty($displayParams.max_height)}}{{$displayParams.max_height}}{{/if}}&w={{if !empty($displayParams.max_width)}}{{$displayParams.max_width}}{{/if}}' {{if isset($displayParams.border)}}border='{{$displayParams.border}}'{{/if}} {{if isset($displayParams.class)}}class='{{$displayParams.class}}'{{/if}} {{if !empty($displayParams.style)}}style='{{$displayParams.style}}'{{/if}} />
{else}
    {{if !empty($displayParams.default_picture) }}
        <img src='custom/SynoFieldPhoto/phpThumb/phpThumb.php?src=images/{{$displayParams.default_picture}}&t={{$displayParams.t}}&h={{if !empty($displayParams.max_height)}}{{$displayParams.max_height}}{{/if}}&w={{if !empty($displayParams.max_width)}}{{$displayParams.max_width}}{{/if}}' {{if isset($displayParams.border)}}border='{{$displayParams.border}}'{{/if}} {{if isset($displayParams.class)}}class='{{$displayParams.class}}'{{/if}} {{if !empty($displayParams.style)}}style='{{$displayParams.style}}'{{/if}} />
    {{else}}
        {$APP.NO_PICTURE_AVAILABLE}
    {{/if}}
{/if}
