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
 * The Original Code is:    SYNOFIELDPHOTO by SYNOLIA
 *                          www.synolia.com - sugar@synolia.com
 * Contributor(s):          ______________________________________.
 * Description :            ______________________________________.
 **********************************************************************************/
 *}
{include file="modules/DynamicFields/templates/Fields/Forms/coreTop.tpl"}
<tr>
	<td class='mbLBL'>{$MOD.WIDTH}:</td><td>
	    <input type='text' name='ext2' value='{$DEFAULT_MAX_WIDTH}'>
	</td>
</tr>

<tr>
	<td class='mbLBL'>{$MOD.HEIGHT}:</td><td>
	    <input type='text' name='ext3' value='{$DEFAULT_MAX_HEIGHT}'>
	</td>
</tr>

<tr>
	<td class='mbLBL'>{$MOD.STYLE}:</td><td>
	    <input type='text' name='ext4'' value='{$DEFAULT_STYLE}'>
	</td>
</tr>

<tr >
    <td class='mbLBL'>{$MOD.COLUMN_TITLE_REQUIRED_OPTION}:</td>
    <td>
        <input type="checkbox" name="required" value="1" {if !empty($vardef.required)}CHECKED{/if} {if $hideLevel > 5}disabled{/if}/>{if $hideLevel > 5}<input type="hidden" name="required" value="{$vardef.required}">{/if}
    </td>
</tr>

<tr>
	<td class='mbLBL'>{$MOD.COLUMN_TITLE_DEFAULT_VALUE}:</td><td>
	    {$MOD.PHOTO_IS_BY_DEFAULT}
	</td>
</tr>

{if !$hideReportable}
<tr>
    <td class='mbLBL'>{$MOD.COLUMN_TITLE_REPORTABLE}:</td>
    <td>
    	{$MOD.PHOTO_IS_NOT_REPORTABLE}
    	<input type="hidden" name="reportable" value="0">
    </td>
</tr>
{/if}

<tr>
    <td class='mbLBL'>{$MOD.COLUMN_TITLE_AUDIT}:</td>
    <td>
        <input type="checkbox" name="audited" value="1" {if !empty($vardef.audited) }CHECKED{/if} {if $hideLevel > 5}disabled{/if}/>{if $hideLevel > 5}<input type="hidden" name="audited" value="{$vardef.audited}">{/if}
    </td>
</tr>

<tr>
    <td class='mbLBL'>{$MOD.COLUMN_TITLE_IMPORTABLE}:</td>
    <td>
        {$MOD.PHOTO_IS_NOT_IMPORTABLE}
    </td>
</tr>

<tr>
    <td class='mbLBL'>{$MOD.COLUMN_TITLE_DUPLICATE_MERGE}:</td>
    <td>
        {$MOD.PHOTO_IS_NOT_MERGEABLE}
    </td>
</tr>
</table>