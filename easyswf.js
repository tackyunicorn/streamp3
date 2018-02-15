/****************************************
EasySWF v2.3
www.gieson.com
Released under the MIT License (e.g. Free to use, include, modify, redistribute, do anything accept sell)
<http://www.opensource.org/licenses/mit-license.php> 


EXAMPLE USAGE:

---------------------------------------------
1. Link to easywsf in the HEAD of your page:
---------------------------------------------

<script src="easyswf.js" type="text/javascript">easyswf.js</script>


---------------------------------------------
2. Call the easyswf() function.
---------------------------------------------

NOTE: If using a "targetDiv", you can call easyswf anywhere on the page.
NOTE: If NOT using a "targetDiv", the SWF will be rendered into the page where the easyswf call is placed on the page.

-------------------
Simple Example
-------------------
<script language="javascript">
easyswf( { swf: "path_to.swf",	width: 500, height: 300 } );
</script>

-------------------
Extended Example
-------------------
<script language="javascript">

easyswf( 
		{	// Bracket "opens" the JSON Object
			swf:			"path_to.swf",		// String
			width:			500,				// Number | String
			height:			300,				// Number | String
			
			// --- OPTIONAL --------------------------------------------------------------------------------
			// NOTE: Un-comment as needed:
			
			// bgcolor:		"#000000",			// String - HEX value
			// swfversion:	"10,0,0,0",			// String
			// targetDiv:	"div_to_replace",	// String - Replaces DIV id with flash content
			// scale:		"default",			// String "default", "noscale", "noborder", "exactfit"
			// salign:		"tl",				// String "l", "t", "r", "tl", "tr"
			// align:		"l",				// String "l", "r", "t"
			// allowScriptAccess:	true,		// Boolean | String "never"
			// allowFullScreen:		true,		// Boolean
			// menu:		true,				// Boolean
			// wmode:		"transparent",		// String: "window", "direct", "opaque", "transparent", "gpu"
			// swfid:		"unique_swf_id",	// String - Will be automatically generated if absent.
			// flashvars:	{	foo:	"foo",	// Object - Containing key:"value" pairs.
			// 					bar:	"bar"
			// 				}
			// noFlashImage: 		"path/to/flash_icon.jpg", // String - url to image based on HTML page location
			// noFlashFont: 		"Arial",	// String
			// noFlashFontSize: 	16,			// Number | String
			// noFlashFontWeight: 	"bold",		// String
			// noFlashFontColor: 	"#FFFFFF"	// String - HEX value
			
		}	// Bracket "closes" the JSON Object
);	// Close function

</script>

*************************************/

function easyswf (confObj) {
	
	// DEFAULT VERSION
	var swfVersionStr = "9.0.0";
	if(confObj.swfversion){
		swfVersionStr = confObj.swfversion;
	}
	// Convert comma,version,notation to dot.version.notation
	swfVersionStr = swfVersionStr.split(",").join(".");
	
	
	var mynewline = "\n";
	
	var noFlashTextFont 	= confObj.noFlashFont 		|| "Verdana, Geneva, sans-serif";
	var noFlashTextSize 	= confObj.noFlashFontSize 	|| "10";
	var noFlashTextWieght 	= confObj.noFlashFontWeight || "normal";
	var noFlashTextColor 	= confObj.noFlashFontColor 	|| "#000000";
	var noFlashImage 		= confObj.noFlashImage 		|| "http://www.adobe.com/images/shared/download_buttons/get_adobe_flash_player.png";
	
	var noFlashTableBkgdColor = confObj.bgcolor || "#000000";
	
	
	var noFlashHTML = '<table width="' + confObj.width + '" height="' + confObj.height + '" border="0" cellpadding="0" cellspacing="0" style="background-color:' + noFlashTableBkgdColor + ';">' + mynewline;
	noFlashHTML += '		<tr>' + mynewline;
	noFlashHTML += '			<td align="center" valign="middle">' + mynewline;
	noFlashHTML += '				<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">' + mynewline;
	noFlashHTML += '					<tr>' + mynewline;
	noFlashHTML += '						<td align="center" valign="middle">' + mynewline;
	noFlashHTML += '							<a href="http://get.adobe.com/flashplayer/"><img src="' + noFlashImage + '" border="0" /></a>' + mynewline;
	noFlashHTML += '							<span style="font-family:' + noFlashTextFont + ';font-size:' + noFlashTextSize + 'px;font-weight:' + noFlashTextWieght + ';color:' + noFlashTextColor + ';">' + mynewline;
	noFlashHTML += '							<br/>Required Version ' + swfVersionStr + mynewline;
	noFlashHTML += '							<br/>Installed Version: __USERVERSION__' + mynewline;
	noFlashHTML += '							<br/>' + mynewline;
	noFlashHTML += '							</span>' + mynewline;
	noFlashHTML += '							</td>' + mynewline;
	noFlashHTML += '					</tr>' + mynewline;
	noFlashHTML += '				</table>' + mynewline;
	noFlashHTML += '				<p>&nbsp;</p>' + mynewline;
	noFlashHTML += '				<p>&nbsp;</p>' + mynewline;
	noFlashHTML += '			</td>' + mynewline;
	noFlashHTML += '		</tr>' + mynewline;
	noFlashHTML += '	</table>' + mynewline;
	
	
	var usingTempTargetDiv = false;
	if(!confObj.targetDiv){
		
		var uniqueID_div = confObj.swfid || "flashTempDIV" + (new Date().getTime()).toString();
		
		// Create a temporary DIV.
		var tempDIV = document.createElement("DIV");
		tempDIV.id = uniqueID_div;
		
		tempDIV.innerHTML = ' ';
		document.body.appendChild(tempDIV);

		var theHTML = tempDIV.outerHTML;
		document.body.removeChild(tempDIV);
		document.write(theHTML);
		
		confObj.targetDiv = uniqueID_div;
		
		usingTempTargetDiv = true;
		
	}
	

	// Prepare a unique ID for the SWF object 
	// (NOTE: May or may not be used based on the how 
	// the programmer configured the "configuration object").
	var uniqueID = "flashObject" + ( new Date().getTime()).toString();

	// ATTRIBUTES

	var att = new Object();
	att.data 	= confObj.swf;
	att.width 	= confObj.width;
	att.height 	= confObj.height;
	att.id 		= confObj.swfid || uniqueID;
	att.name 	= confObj.swfid || uniqueID;

	

	// PARAMS

	var par = new Object();
	par.bgcolor	= confObj.bgcolor || "#000000";

	if(confObj.scale){
		par.scale = confObj.scale;
	}

	if(confObj.salign){
		par.salign = confObj.salign;
	}

	if(confObj.allowScriptAccess){
		if(confObj.allowScriptAccess == "always" || confObj.allowScriptAccess == "true" || confObj.allowScriptAccess === true){
			par.allowScriptAccess = "always";
		} else {
			par.allowScriptAccess = confObj.allowScriptAccess;
		}
	}

	if(confObj.allowFullScreen){
		if(confObj.allowFullScreen == "true" || confObj.allowFullScreen === true){
			par.allowFullScreen = "true";
		}
	}

	if(confObj.menu){
		if(confObj.menu == "true" || confObj.menu === true){
			par.menu = "true";
		}
	}

	if(confObj.wmode){
		par.wmode = confObj.wmode;
	}

	// FLASH VARS
	/*
	if(confObj.flashvars){
		var Afv = new Array();
		for(var prop in confObj.flashvars){
			Afv.push(prop + "=" + confObj.flashvars[prop]);
		}
		par.flashvars = Afv.join("&");
	}
	*/
	
	var checkSuccess = function(theObj) {
		
		if(theObj.success == false){
			var OuserVersion = swfobject.getFlashPlayerVersion();
			var userVersion = OuserVersion.major + "." + OuserVersion.minor + "." + OuserVersion.release;
			if(OuserVersion.major < 4){
				userVersion = "NONE";
			}
			var targ = document.getElementById(confObj.targetDiv);
			targ.innerHTML = noFlashHTML.split("__USERVERSION__").join(userVersion);
		}
	}

	var fn = function() {
		// Generate the configurations needed.
		//var conf = getConf(confObj);
		// Use swfobject to create the HTML for the browser.
		//swfobject.createSWF(att, par, confObj.targetDiv);
		swfobject.embedSWF(confObj.swf, confObj.targetDiv, att.width, att.height, swfVersionStr, null, confObj.flashvars, par, att, checkSuccess)
	};

	// Use swfobject to creatd HTML code once the page is ready.
	swfobject.addDomLoadEvent(fn);
	
}



/*	SWFObject v2.2 <http://code.google.com/p/swfobject/> 
	is released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/
var swfobject=function(){var D="undefined",r="object",S="Shockwave Flash",W="ShockwaveFlash.ShockwaveFlash",q="application/x-shockwave-flash",R="SWFObjectExprInst",x="onreadystatechange",O=window,j=document,t=navigator,T=false,U=[h],o=[],N=[],I=[],l,Q,E,B,J=false,a=false,n,G,m=true,M=function(){var aa=typeof j.getElementById!=D&&typeof j.getElementsByTagName!=D&&typeof j.createElement!=D,ah=t.userAgent.toLowerCase(),Y=t.platform.toLowerCase(),ae=Y?/win/.test(Y):/win/.test(ah),ac=Y?/mac/.test(Y):/mac/.test(ah),af=/webkit/.test(ah)?parseFloat(ah.replace(/^.*webkit\/(\d+(\.\d+)?).*$/,"$1")):false,X=!+"\v1",ag=[0,0,0],ab=null;if(typeof t.plugins!=D&&typeof t.plugins[S]==r){ab=t.plugins[S].description;if(ab&&!(typeof t.mimeTypes!=D&&t.mimeTypes[q]&&!t.mimeTypes[q].enabledPlugin)){T=true;X=false;ab=ab.replace(/^.*\s+(\S+\s+\S+$)/,"$1");ag[0]=parseInt(ab.replace(/^(.*)\..*$/,"$1"),10);ag[1]=parseInt(ab.replace(/^.*\.(.*)\s.*$/,"$1"),10);ag[2]=/[a-zA-Z]/.test(ab)?parseInt(ab.replace(/^.*[a-zA-Z]+(.*)$/,"$1"),10):0}}else{if(typeof O.ActiveXObject!=D){try{var ad=new ActiveXObject(W);if(ad){ab=ad.GetVariable("$version");if(ab){X=true;ab=ab.split(" ")[1].split(",");ag=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}}catch(Z){}}}return{w3:aa,pv:ag,wk:af,ie:X,win:ae,mac:ac}}(),k=function(){if(!M.w3){return}if((typeof j.readyState!=D&&j.readyState=="complete")||(typeof j.readyState==D&&(j.getElementsByTagName("body")[0]||j.body))){f()}if(!J){if(typeof j.addEventListener!=D){j.addEventListener("DOMContentLoaded",f,false)}if(M.ie&&M.win){j.attachEvent(x,function(){if(j.readyState=="complete"){j.detachEvent(x,arguments.callee);f()}});if(O==top){(function(){if(J){return}try{j.documentElement.doScroll("left")}catch(X){setTimeout(arguments.callee,0);return}f()})()}}if(M.wk){(function(){if(J){return}if(!/loaded|complete/.test(j.readyState)){setTimeout(arguments.callee,0);return}f()})()}s(f)}}();function f(){if(J){return}try{var Z=j.getElementsByTagName("body")[0].appendChild(C("span"));Z.parentNode.removeChild(Z)}catch(aa){return}J=true;var X=U.length;for(var Y=0;Y<X;Y++){U[Y]()}}function K(X){if(J){X()}else{U[U.length]=X}}function s(Y){if(typeof O.addEventListener!=D){O.addEventListener("load",Y,false)}else{if(typeof j.addEventListener!=D){j.addEventListener("load",Y,false)}else{if(typeof O.attachEvent!=D){i(O,"onload",Y)}else{if(typeof O.onload=="function"){var X=O.onload;O.onload=function(){X();Y()}}else{O.onload=Y}}}}}function h(){if(T){V()}else{H()}}function V(){var X=j.getElementsByTagName("body")[0];var aa=C(r);aa.setAttribute("type",q);var Z=X.appendChild(aa);if(Z){var Y=0;(function(){if(typeof Z.GetVariable!=D){var ab=Z.GetVariable("$version");if(ab){ab=ab.split(" ")[1].split(",");M.pv=[parseInt(ab[0],10),parseInt(ab[1],10),parseInt(ab[2],10)]}}else{if(Y<10){Y++;setTimeout(arguments.callee,10);return}}X.removeChild(aa);Z=null;H()})()}else{H()}}function H(){var ag=o.length;if(ag>0){for(var af=0;af<ag;af++){var Y=o[af].id;var ab=o[af].callbackFn;var aa={success:false,id:Y};if(M.pv[0]>0){var ae=c(Y);if(ae){if(F(o[af].swfVersion)&&!(M.wk&&M.wk<312)){w(Y,true);if(ab){aa.success=true;aa.ref=z(Y);ab(aa)}}else{if(o[af].expressInstall&&A()){var ai={};ai.data=o[af].expressInstall;ai.width=ae.getAttribute("width")||"0";ai.height=ae.getAttribute("height")||"0";if(ae.getAttribute("class")){ai.styleclass=ae.getAttribute("class")}if(ae.getAttribute("align")){ai.align=ae.getAttribute("align")}var ah={};var X=ae.getElementsByTagName("param");var ac=X.length;for(var ad=0;ad<ac;ad++){if(X[ad].getAttribute("name").toLowerCase()!="movie"){ah[X[ad].getAttribute("name")]=X[ad].getAttribute("value")}}P(ai,ah,Y,ab)}else{p(ae);if(ab){ab(aa)}}}}}else{w(Y,true);if(ab){var Z=z(Y);if(Z&&typeof Z.SetVariable!=D){aa.success=true;aa.ref=Z}ab(aa)}}}}}function z(aa){var X=null;var Y=c(aa);if(Y&&Y.nodeName=="OBJECT"){if(typeof Y.SetVariable!=D){X=Y}else{var Z=Y.getElementsByTagName(r)[0];if(Z){X=Z}}}return X}function A(){return !a&&F("6.0.65")&&(M.win||M.mac)&&!(M.wk&&M.wk<312)}function P(aa,ab,X,Z){a=true;E=Z||null;B={success:false,id:X};var ae=c(X);if(ae){if(ae.nodeName=="OBJECT"){l=g(ae);Q=null}else{l=ae;Q=X}aa.id=R;if(typeof aa.width==D||(!/%$/.test(aa.width)&&parseInt(aa.width,10)<310)){aa.width="310"}if(typeof aa.height==D||(!/%$/.test(aa.height)&&parseInt(aa.height,10)<137)){aa.height="137"}j.title=j.title.slice(0,47)+" - Flash Player Installation";var ad=M.ie&&M.win?"ActiveX":"PlugIn",ac="MMredirectURL="+O.location.toString().replace(/&/g,"%26")+"&MMplayerType="+ad+"&MMdoctitle="+j.title;if(typeof ab.flashvars!=D){ab.flashvars+="&"+ac}else{ab.flashvars=ac}if(M.ie&&M.win&&ae.readyState!=4){var Y=C("div");X+="SWFObjectNew";Y.setAttribute("id",X);ae.parentNode.insertBefore(Y,ae);ae.style.display="none";(function(){if(ae.readyState==4){ae.parentNode.removeChild(ae)}else{setTimeout(arguments.callee,10)}})()}u(aa,ab,X)}}function p(Y){if(M.ie&&M.win&&Y.readyState!=4){var X=C("div");Y.parentNode.insertBefore(X,Y);X.parentNode.replaceChild(g(Y),X);Y.style.display="none";(function(){if(Y.readyState==4){Y.parentNode.removeChild(Y)}else{setTimeout(arguments.callee,10)}})()}else{Y.parentNode.replaceChild(g(Y),Y)}}function g(ab){var aa=C("div");if(M.win&&M.ie){aa.innerHTML=ab.innerHTML}else{var Y=ab.getElementsByTagName(r)[0];if(Y){var ad=Y.childNodes;if(ad){var X=ad.length;for(var Z=0;Z<X;Z++){if(!(ad[Z].nodeType==1&&ad[Z].nodeName=="PARAM")&&!(ad[Z].nodeType==8)){aa.appendChild(ad[Z].cloneNode(true))}}}}}return aa}function u(ai,ag,Y){var X,aa=c(Y);if(M.wk&&M.wk<312){return X}if(aa){if(typeof ai.id==D){ai.id=Y}if(M.ie&&M.win){var ah="";for(var ae in ai){if(ai[ae]!=Object.prototype[ae]){if(ae.toLowerCase()=="data"){ag.movie=ai[ae]}else{if(ae.toLowerCase()=="styleclass"){ah+=' class="'+ai[ae]+'"'}else{if(ae.toLowerCase()!="classid"){ah+=" "+ae+'="'+ai[ae]+'"'}}}}}var af="";for(var ad in ag){if(ag[ad]!=Object.prototype[ad]){af+='<param name="'+ad+'" value="'+ag[ad]+'" />'}}aa.outerHTML='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"'+ah+">"+af+"</object>";N[N.length]=ai.id;X=c(ai.id)}else{var Z=C(r);Z.setAttribute("type",q);for(var ac in ai){if(ai[ac]!=Object.prototype[ac]){if(ac.toLowerCase()=="styleclass"){Z.setAttribute("class",ai[ac])}else{if(ac.toLowerCase()!="classid"){Z.setAttribute(ac,ai[ac])}}}}for(var ab in ag){if(ag[ab]!=Object.prototype[ab]&&ab.toLowerCase()!="movie"){e(Z,ab,ag[ab])}}aa.parentNode.replaceChild(Z,aa);X=Z}}return X}function e(Z,X,Y){var aa=C("param");aa.setAttribute("name",X);aa.setAttribute("value",Y);Z.appendChild(aa)}function y(Y){var X=c(Y);if(X&&X.nodeName=="OBJECT"){if(M.ie&&M.win){X.style.display="none";(function(){if(X.readyState==4){b(Y)}else{setTimeout(arguments.callee,10)}})()}else{X.parentNode.removeChild(X)}}}function b(Z){var Y=c(Z);if(Y){for(var X in Y){if(typeof Y[X]=="function"){Y[X]=null}}Y.parentNode.removeChild(Y)}}function c(Z){var X=null;try{X=j.getElementById(Z)}catch(Y){}return X}function C(X){return j.createElement(X)}function i(Z,X,Y){Z.attachEvent(X,Y);I[I.length]=[Z,X,Y]}function F(Z){var Y=M.pv,X=Z.split(".");X[0]=parseInt(X[0],10);X[1]=parseInt(X[1],10)||0;X[2]=parseInt(X[2],10)||0;return(Y[0]>X[0]||(Y[0]==X[0]&&Y[1]>X[1])||(Y[0]==X[0]&&Y[1]==X[1]&&Y[2]>=X[2]))?true:false}function v(ac,Y,ad,ab){if(M.ie&&M.mac){return}var aa=j.getElementsByTagName("head")[0];if(!aa){return}var X=(ad&&typeof ad=="string")?ad:"screen";if(ab){n=null;G=null}if(!n||G!=X){var Z=C("style");Z.setAttribute("type","text/css");Z.setAttribute("media",X);n=aa.appendChild(Z);if(M.ie&&M.win&&typeof j.styleSheets!=D&&j.styleSheets.length>0){n=j.styleSheets[j.styleSheets.length-1]}G=X}if(M.ie&&M.win){if(n&&typeof n.addRule==r){n.addRule(ac,Y)}}else{if(n&&typeof j.createTextNode!=D){n.appendChild(j.createTextNode(ac+" {"+Y+"}"))}}}function w(Z,X){if(!m){return}var Y=X?"visible":"hidden";if(J&&c(Z)){c(Z).style.visibility=Y}else{v("#"+Z,"visibility:"+Y)}}function L(Y){var Z=/[\\\"<>\.;]/;var X=Z.exec(Y)!=null;return X&&typeof encodeURIComponent!=D?encodeURIComponent(Y):Y}var d=function(){if(M.ie&&M.win){window.attachEvent("onunload",function(){var ac=I.length;for(var ab=0;ab<ac;ab++){I[ab][0].detachEvent(I[ab][1],I[ab][2])}var Z=N.length;for(var aa=0;aa<Z;aa++){y(N[aa])}for(var Y in M){M[Y]=null}M=null;for(var X in swfobject){swfobject[X]=null}swfobject=null})}}();return{registerObject:function(ab,X,aa,Z){if(M.w3&&ab&&X){var Y={};Y.id=ab;Y.swfVersion=X;Y.expressInstall=aa;Y.callbackFn=Z;o[o.length]=Y;w(ab,false)}else{if(Z){Z({success:false,id:ab})}}},getObjectById:function(X){if(M.w3){return z(X)}},embedSWF:function(ab,ah,ae,ag,Y,aa,Z,ad,af,ac){var X={success:false,id:ah};if(M.w3&&!(M.wk&&M.wk<312)&&ab&&ah&&ae&&ag&&Y){w(ah,false);K(function(){ae+="";ag+="";var aj={};if(af&&typeof af===r){for(var al in af){aj[al]=af[al]}}aj.data=ab;aj.width=ae;aj.height=ag;var am={};if(ad&&typeof ad===r){for(var ak in ad){am[ak]=ad[ak]}}if(Z&&typeof Z===r){for(var ai in Z){if(typeof am.flashvars!=D){am.flashvars+="&"+ai+"="+Z[ai]}else{am.flashvars=ai+"="+Z[ai]}}}if(F(Y)){var an=u(aj,am,ah);if(aj.id==ah){w(ah,true)}X.success=true;X.ref=an}else{if(aa&&A()){aj.data=aa;P(aj,am,ah,ac);return}else{w(ah,true)}}if(ac){ac(X)}})}else{if(ac){ac(X)}}},switchOffAutoHideShow:function(){m=false},ua:M,getFlashPlayerVersion:function(){return{major:M.pv[0],minor:M.pv[1],release:M.pv[2]}},hasFlashPlayerVersion:F,createSWF:function(Z,Y,X){if(M.w3){return u(Z,Y,X)}else{return undefined}},showExpressInstall:function(Z,aa,X,Y){if(M.w3&&A()){P(Z,aa,X,Y)}},removeSWF:function(X){if(M.w3){y(X)}},createCSS:function(aa,Z,Y,X){if(M.w3){v(aa,Z,Y,X)}},addDomLoadEvent:K,addLoadEvent:s,getQueryParamValue:function(aa){var Z=j.location.search||j.location.hash;if(Z){if(/\?/.test(Z)){Z=Z.split("?")[1]}if(aa==null){return L(Z)}var Y=Z.split("&");for(var X=0;X<Y.length;X++){if(Y[X].substring(0,Y[X].indexOf("="))==aa){return L(Y[X].substring((Y[X].indexOf("=")+1)))}}}return""},expressInstallCallback:function(){if(a){var X=c(R);if(X&&l){X.parentNode.replaceChild(l,X);if(Q){w(Q,true);if(M.ie&&M.win){l.style.display="block"}}if(E){E(B)}}a=false}}}}();



