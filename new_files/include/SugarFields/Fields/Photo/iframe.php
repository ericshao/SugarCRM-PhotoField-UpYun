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
$sugarFieldName = $_GET['sugarFieldphp'];
?>

<script type="text/javascript" language="javascript">

/* standard small functions */
function $m(quem){
    return document.getElementById(quem)
}
function remove(quem){
    quem.parentNode.removeChild(quem);
}
function addEvent(obj, evType, fn){
    // elcio.com.br/crossbrowser
    if (obj.addEventListener)
        obj.addEventListener(evType, fn, true)
    if (obj.attachEvent)
        obj.attachEvent("on"+evType, fn)
}
function removeEvent( obj, type, fn ) {
    if ( obj.detachEvent ) {
        obj.detachEvent( 'on'+type, fn );
    } else {
        obj.removeEventListener( type, fn, false ); 
    }
} 
/* THE UPLOAD FUNCTION */
var sugarField = window.parent.<?php echo $sugarFieldName; ?>_sugarField();

function micoxUpload(form,url_action,id_element,html_show_loading,html_error_http,thisFileId){

    var fileAndPath = thisFileId.value;
    var lastPathDelimiter = fileAndPath.lastIndexOf('\\');
    var fileNameOnly = fileAndPath.substring(lastPathDelimiter+1);
    
    var record = window.parent.document.getElementsByName('record')[0].value;
    var module = window.parent.document.getElementsByName('module')[1].value;
    var field = sugarField;
    


    var fileExtension = fileAndPath.substring(fileAndPath.lastIndexOf('.')).toLowerCase();
    
    
    //window.parent.document.getElementById(sugarField).value = fileNameOnly;
    window.parent.document.getElementById(sugarField).value = module + '_' + field + '_' + record + fileExtension;
    window.parent.document.getElementById(field + '_iframe').setAttribute("style","height: 120px; width: 300px;");

    if(record && record != '') url_action = url_action + '&id=' + record
    if(module && module != '') url_action = url_action + '&module=' + module
    if(field && field != '') url_action = url_action + '&field=' + field
    /******
    * micoxUpload - Submit a form to hidden iframe. Can be used to upload
    * Use but dont remove my name. Creative Commons.
    * Versão: 1.0 - 03/03/2007 - Tested no FF2.0 IE6.0 e OP9.1
    * Author: Micox - Náiron JCG - elmicoxcodes.blogspot.com - micoxjcg@yahoo.com.br
    * Parametros:
    * form - the form to submit or the ID
    * url_action - url to submit the form. like action parameter of forms.
    * id_element - element that will receive return of upload.
    * html_show_loading - Text (or image) that will be show while loading
    * html_error_http - Text (or image) that will be show if HTTP error.
    *******/

     //creating the iframe
     var iframe = document.createElement("iframe");
     iframe.setAttribute("id","micox-temp");
     iframe.setAttribute("name","micox-temp");
     iframe.setAttribute("width","0");
     iframe.setAttribute("height","0");
     iframe.setAttribute("border","0");
     iframe.setAttribute("style","width: 0; height: 0; border: none;");
 
     //add to document
     form.parentNode.appendChild(iframe);
     window.frames['micox-temp'].name="micox-temp"; //ie sucks
 
    //add event
    var carregou = function() { 
        removeEvent( $m('micox-temp'),"load", carregou);
        var cross = "javascript: ";
        cross += "window.parent.$m('" + id_element + "').innerHTML = document.body.innerHTML; void(0); ";
       
        $m(id_element).innerHTML = html_error_http;
        $m('micox-temp').src = cross;
       
        //del the iframe
        setTimeout(function(){ remove($m('micox-temp'))}, 250);
    }
    addEvent( $m('micox-temp'),"load", carregou)
 
    //properties of form
    form.setAttribute("target","micox-temp");
    form.setAttribute("action",url_action);
    form.setAttribute("method","post");
    form.setAttribute("enctype","multipart/form-data");
    form.setAttribute("encoding","multipart/form-data");
 
    //submit
    form.submit();
 
    //while loading
    if(html_show_loading.length > 0){
        $m(id_element).innerHTML = '<img src="' + html_show_loading + '" />';
    }
    
    //thisFileId.style.display = 'none';
}
</script>

<form>
    <input type="file" id="file" value="" name="file" onchange="micoxUpload(this.form,'index.php?entryPoint=upload','upload_2','include/SugarFields/Fields/Photo/indicator.gif','Error in upload',this);" />
    <input type="button" value="Clear" onclick="clean_picture()" class="button" accesskey="C" title="Vider [Alt+C]" name="btn_clr_team_name"/>
</form>
<div id="upload_2">&nbsp;</div>
<script type="text/javascript" language="javascript">
if (        window.parent.document
        &&  window.parent.document.getElementById
        &&  window.parent.document.getElementById(sugarField)
        &&  window.parent.document.getElementById(sugarField).value != ''
){
    var old_field = window.parent.document.getElementById(sugarField).value;
    $m('upload_2').innerHTML = '<img src="http://sugar.b0.upaiyun.com/' + sugarField + '/' + old_field + '!editView">'; 
    
    window.parent.document.getElementById(sugarField + '_iframe').setAttribute("style","height: 200px; width: 300px;");   
}
function clean_picture(){
    if (    window.parent.document
        &&  window.parent.document.getElementById
        &&  window.parent.document.getElementById(sugarField)
    ){
        window.parent.document.getElementById(sugarField).value = '';
        window.parent.document.getElementById(sugarField + '_iframe').setAttribute("style","height: 50px; width: 300px;"); 
        $m('upload_2').innerHTML = '';
    }
}
</script>

