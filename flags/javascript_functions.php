<!--  https://github.com/tazotodua/useful-javascript/blob/master/AJAX-examples  -->
<script type="text/javascript">
function myRequest_1(parameters, url, method, passedFunction){
	method = method.toLowerCase() || "get"; if (method  == "get") {url=url+'?'+parameters+'&MakeRandomValuedLinkToAvoidCache=' + Math.random();}
	SHOW_waiting();	try{try{var xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");} catch( e ){var xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");}}catch(e){var xmlhttp = new XMLHttpRequest();}
	xmlhttp.onreadystatechange=function(){if (xmlhttp.readyState==4){ HIDE_waiting();
		responseee =xmlhttp.responseText; 
		//let's execute our desired function
		eval(passedFunction); 
		}
	}
	xmlhttp.open(method,url, true); 
	if (method  == "post"){xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");xmlhttp.send(parameters);}
	else if (method  == "get"){xmlhttp.send(null);}
}
</script>






<!-- https://github.com/tazotodua/useful-javascript/blob/master/during-request-show-%22WAIT%22  -->
<script type="text/javascript">
	function SHOW_waiting(){
	var innerDiv = document.createElement('div'); innerDiv.id = 'my_waiting_box';
	innerDiv.innerHTML=
	'<div style="background-color:black; color:white; height:1000px; left:0px; opacity:0.9; position:fixed; top:0px; width:100%; z-index:1007;" id="ppshadow">' +
	'<div style="position:absolute; top:200px;left:49%; z-index: 1008;" id="ppload"> ' +
	'<span style="color:white;font-size:24px;"> LOADING...</span><br/>'+
	'</div>'+
	'</div>';
	var BODYYY = document.getElementsByTagName('body')[0];
	BODYYY.insertBefore(innerDiv, BODYYY.childNodes[0]);
	}
	function HIDE_waiting(id){
	var DIIV = document.getElementById('my_waiting_box');DIIV.parentNode.removeChild(DIIV);
	}
</script>









<!-- https://github.com/tazotodua/useful-javascript/blob/master/form%20serialize%20%28without%20jQuery%2C%20plain%20Javascript%29.js  -->
<script type="text/javascript">
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
</script>


<!-- http://stackoverflow.com/questions/324486/how-do-you-read-css-rule-values-with-javascript/29130215 -->
<script type="text/javascript">
function GETproperty(classOrId,property){ 
	var FirstChar = classOrId.charAt(0);  var Remaining= classOrId.substring(1);
	var elem = (FirstChar =='#') ?  document.getElementById(Remaining) : document.getElementsByClassName(Remaining)[0];
	return window.getComputedStyle(elem,null).getPropertyValue(property);
}
</script>