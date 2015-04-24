<?php  if (isset($_GET['jstypee'])) { $JSoutp=true;     header("Content-type: application/x-javascript"); } else {$JSoutp=false;} ?>


<?php if (!$JSoutp) { ?> <script type="text/javascript"> <?php } ?>


// ######################## simple POPUP  ############################# https://github.com/tazotodua/useful-javascript/ ###############
function show_my_popup(TEXTorID){   
		//=========if  ID(#SOMETHING)  or   CLASSNAME(.SOMETHING) 
		TEXTorID=TEXTorID.trim(); var FirstChar= TEXTorID.charAt(0); var eName = TEXTorID.substr(1); if ('#'==FirstChar || '.'==FirstChar){	if('#'==FirstChar){var x=document.getElementById(eName);} else{var x=document.getElementsByClassName(eName)[0];}} else { var x=document.createElement('div');x.innerHTML=TEXTorID;} var randm_id=Math.floor((Math.random()*100000000));
	var DivAA = document.createElement('div'); DivAA.id = "blkBackgr_"+randm_id; DivAA.className = "MyJsBackg";   DivAA.setAttribute("style", 'background:black; height:5000px; left:0px; opacity:0.9; position:fixed; top:0px; width:100%; z-index:9503;'); document.body.insertBefore(DivAA, document.body.childNodes[0]);
	var DivBB = document.createElement('div'); DivBB.id = 'popupp_'+randm_id; DivBB.className = "MyJsPopup"; DivBB.setAttribute("style",'background-color:white; border:6px solid white; border-radius:10px; display:block; min-height:100px; min-width:350px; overflow:auto; max-height:80%; max-width:92%; padding:15px; position:fixed; text-align:center; top:25%; left:50%; transform:translate(-50%, 0); z-index:9504;'); 	DivBB.innerHTML = '<div style="background-color:#C0BCBF; border-radius:55px; padding:5px; font-family:arial; float:right; font-weight:700; margin:-15px -10px 0px 0px;"><a href="javascript:pop_hide('+randm_id+');" style="display:block;margin:-5px 0 0 0;font-size:1.6em;">x</a></div>'; document.body.insertBefore(DivBB, document.body.childNodes[0]);z=x.cloneNode(true);DivBB.appendChild(z); if(z.style.display=="none"){z.style.display="block";}
}
function pop_hide(RandomIDD)  { var x=document.getElementById("blkBackgr_"+RandomIDD); x.parentNode.removeChild(x);      var x=document.getElementById('popupp_'+RandomIDD); x.parentNode.removeChild(x); }
//==============================================    #END#   simple POPUP     ==============================================	


















//Separate functions, BLACKen background (NOTE: on your overshown element, use at least: z-index:9600 )
function SHOW_blackGROUND(){ var AAADIV = document.createElement('div'); AAADIV.id = "my_black_bck_123";  var stl='background:black; height:5000px; left:0px; opacity:0.9; position:fixed; top:0px; width:100%; z-index:9503;';  AAADIV.setAttribute("style", stl ); 
	if (mybodyyy = document.body)	{mybodyyy.insertBefore(AAADIV, mybodyyy.childNodes[0]);} 
	else 							{document.write('<div style="'+stl+'"></div>');}
}
function REMOVE_blackGROUND(){ var AAADIV = document.getElementById('my_black_bck_123'); AAADIV.parentNode.removeChild(AAADIV); }


















//##################### AJAX EXAMPLES  ############## https://github.com/tazotodua/useful-javascript/ ####################
function myyAjaxRequest(parameters, url, method, passedFunction){
	method = method.toLowerCase() || "get"; if (method  == "get") {url=url+'?'+parameters+'&MakeRandomValuedLinkToAvoidCache=' + Math.random();}
	if(typeof SHOW_waiting === 'function') {SHOW_waiting();}	try{try{var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");} catch( e ){var xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}}catch(e){var xmlhttp = new XMLHttpRequest();}
	xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4){ HIDE_waiting();
		responseee ="STATE:"+ xmlhttp.readyState + ";\nSTATUS:" + xmlhttp.status +";\nRESPONSED:" +xmlhttp.responseText; 
		eval(passedFunction); //execute any codes
		}
	}
	xmlhttp.open(method,url, true); 
	if (method  == "post"){xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");xmlhttp.send(parameters);}
	else if (method  == "get"){xmlhttp.send(null);}
}















// ############################### https://github.com/tazotodua/useful-javascript/ ################
function SHOW_waiting(){  var DIIV = document.createElement('div'); DIIV.id = 'my_waiting_box';  DIIV.innerHTML=  '<div style="background-color:black; color:white; height:4000px; left:0px; opacity:0.9; position:fixed; top:0px; width:100%; z-index:1007;" id="ppshadow">' + '<div style="position:absolute; top:200px;left:49%; z-index: 1008;" id="ppload"> ' + '<span style="color:white;font-size:24px;"> LOADING...</span><br/>'+'</div>'+'</div>'; 	var b=document.body;   b.insertBefore(DIIV, b.childNodes[0]);  }
function HIDE_waiting(id){  var DIIV = document.getElementById('my_waiting_box'); DIIV.parentNode.removeChild(DIIV);  }
















// #####################  Form-serialize ###########################  http://github.com/tazotodua/useful-javascript/   #################
function serialize (form) {
    'use strict';
    var i, j, len, jLen, formElement, q = [];
    function urlencode (str) {
        // http://kevin.vanzonneveld.net
        // Tilde should be allowed unescaped in future versions of PHP (as reflected below), but if you want to reflect current
        // PHP behavior, you would need to add ".replace(/~/g, '%7E');" to the following.
        return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').
            replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
    }
    function addNameValue(name, value) {
        q.push(urlencode(name) + '=' + urlencode(value));
    }
    if (!form || !form.nodeName || form.nodeName.toLowerCase() !== 'form') {
        throw 'You must supply a form element';
    }
    for (i = 0, len = form.elements.length; i < len; i++) {
        formElement = form.elements[i];
        if (formElement.name === '' || formElement.disabled) {
            continue;
        }
        switch (formElement.nodeName.toLowerCase()) {
        case 'input':
            switch (formElement.type) {
            case 'text':
            case 'hidden':
            case 'password':
            case 'button': // Not submitted when submitting form manually, though jQuery does serialize this and it can be an HTML4 successful control
            case 'submit':
                addNameValue(formElement.name, formElement.value);
                break;
            case 'checkbox':
            case 'radio':
                if (formElement.checked) {
                    addNameValue(formElement.name, formElement.value);
                }
                break;
            case 'file':
                // addNameValue(formElement.name, formElement.value); // Will work and part of HTML4 "successful controls", but not used in jQuery
                break;
            case 'reset':
                break;
            }
            break;
        case 'textarea':
            addNameValue(formElement.name, formElement.value);
            break;
        case 'select':
            switch (formElement.type) {
            case 'select-one':
                addNameValue(formElement.name, formElement.value);
                break;
            case 'select-multiple':
                for (j = 0, jLen = formElement.options.length; j < jLen; j++) {
                    if (formElement.options[j].selected) {
                        addNameValue(formElement.name, formElement.options[j].value);
                    }
                }
                break;
            }
            break;
        case 'button': // jQuery does not submit these, though it is an HTML4 successful control
            switch (formElement.type) {
            case 'reset':
            case 'submit':
            case 'button':
                addNameValue(formElement.name, formElement.value);
                break;
            }
            break;
        }
    }
    return q.join('&');
}












// ################  get STYLESHEET style of element ################ http://goo.gl/2o6mem ##########
function GETproperty(classOrId,property){ 
	var FirstChar = classOrId.charAt(0);  var Remaining= classOrId.substring(1);
	var elem = (FirstChar =='#') ?  document.getElementById(Remaining) : document.getElementsByClassName(Remaining)[0];
	return window.getComputedStyle(elem,null).getPropertyValue(property);
}










<?php if (!$JSoutp) { ?> </script> <?php } ?>