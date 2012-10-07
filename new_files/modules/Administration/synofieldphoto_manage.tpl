<form action="index.php" method="POST" name="synofieldphoto_manage" id="synofieldphoto_manage">
<input type="hidden" name="module" value="Administration">
<input type="hidden" name="action" value="synofieldphoto_manage">
<input type="hidden" name="process" value="true">
{if $ERRORS neq ''}
<p class="error">
    {$ERRORS}
    <br />&nbsp;
</p>
{/if}
<table width="100%" border="0">
    <tr>
        <td colspan="2">
            <h4>{$MOD.LBL_SYNOGEOLOC_INFOS}</h4>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0">
                <tr>
                    <td class="dataLabel" valign="top" width="15%">
                        {$MOD.LBL_MAX_SIZE_PICTURE}: 
                    </td>
                    <td  class="dataField">
                        <input id="max_size_picture" type="text" size="40" maxlength="200" name="max_size_picture" value="{$CONFIG.max_size_picture}" tabindex='1'>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <input title="{$APP.LBL_SAVE_BUTTON_TITLE}" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button" type="submit" name="save" onclick="return verify_data('synofieldphoto_manage');" value="  {$APP.LBL_SAVE_BUTTON_LABEL}  " >
            <input title="{$MOD.LBL_CANCEL_BUTTON_TITLE}"  onclick="document.location.href='index.php?module=Administration&action=index'" class="button"  type="button" name="cancel" value="  {$APP.LBL_CANCEL_BUTTON_LABEL}  " >
        </td>
    </tr>
</table>
</form>
