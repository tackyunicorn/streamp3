<?php
if(!@session_id()){
@session_start();
}
//<//////////////////////////////////////////////////////////////
//                                                             //
//                                                             //
//                                                             //
//                                                             //
//                      Wimpy MP3 Player                       //
//                                                             //
//          Available at http://www.wimpyplayer.net            //
//                     ©2002-2014 plaino                       //
//                                                             //
//                                                             //
//                                                             //
/////////////////////////////////////////////////////////////////
//                                                             //
//                       INSTALLATION:                         //
//                                                             //
/////////////////////////////////////////////////////////////////
//
// Upload wimpy.php and wimpy.swf to the folder that
// contains your mp3's.
//
// USE AT YOUR OWN RISK.
//
$wimpyVersion = "v6.0.36";
$wimpyConfigFile = "wimpyConfigs.xml";
$myWimpySWFfilename = "wimpy.swf";
$wimpy_auth = "wimpy_auth.php";
$media_types = "xml,mp3,m3u,pls";
//
//
//
// If you are using multibyte characters (i.e. Chinese, Korean
// or non-alpha-numeric characters set $useSysCodePage to yes.
// $useSysCodePage = "yes";
$useSysCodePage = "no";
//
// httpOption
// Allows you to run wimpy in "https" mode;
//$httpOption = "https";
$httpOption = "http";
//
// blockPHPinfo
// Setting this value to 'Yes' will prevent anyone
// to view your phpinfo() page by adding the correct ?request to the URL.
// viewing the PHP info is only used for troubleshooting first installs.
$blockPHPinfo = "no";
//
// fileSortOrder
// Controls the sort order of how the files should be listed.
// Can be set to:
//"asc" - sort the files in alphabetically acending order (A-Z)
//"des" - sort the files in alphabetically descenting order (Z-A)
//
//$fileSortOrder = "des";
$fileSortOrder = "asc";
//
/////////////////////////////////////////////////////////////////
//                                                             //
//         Do not edit anything below here unless              //
//          you really know what you are doing!                //
//                                                             //
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//
//>
$myDataSetup = "filename|artist|album|title|track|comments|genre|seconds|filesize|bitrate|visual";
$v110 = false;
$v91 = "/";
if(!@getcwd ()){
$v32['path']['physical'] = str_replace("\\", "/", dirname(__FILE__));
} else {
$v32['path']['physical'] = str_replace("\\", "/", getcwd ());
}
function f1(&$array, $id, $var){
$v96 = array($var => $id);
$array = array_merge ($array, $v96);
}
if($_SERVER['PHP_SELF']){
$v64 = FALSE;
$v115 = strtolower (@$_SERVER["HTTP_USER_AGENT"]);
} else {
$v64 = TRUE;
if($v110){
$_REQUEST = array();
$v90 = get_defined_vars();
$v0 = explode("&", $v90['argv'][0]);
for($i=0;$i<sizeof($v0);$i++){
$v1 = explode("=", $v0[$i]);
f1($_REQUEST, $v1[1], $v1[0]);
}
} else {
$v90 = get_defined_vars();
$_REQUEST = $v90;
}
$v115 = strtolower (@$_REQUEST["HTTP_USER_AGENT"]);
}
if($v64){
$v79 = $HTTP_SERVER_VARS['PHP_SELF'];
} else {
$v79 = $_SERVER['PHP_SELF'];
}
$v71 = $_SERVER['HTTP_HOST'];
$v25 = explode("/", $v79);
$myWimpyPHPfilename = array_pop($v25);
$v78 = implode("/", $v25);
if($v64){
$v32['path']['www'] = $httpOption."://".$HTTP_SERVER_VARS['HTTP_HOST'].$v78;
} else {
$v32['path']['www'] = $httpOption."://".$_SERVER['HTTP_HOST'].$v78;
}
if($v42 = f6($wimpyConfigFile)){
$v121 = @xml_parser_create('');
@xml_parser_set_option ($v121, XML_OPTION_CASE_FOLDING, false );
@xml_parse_into_struct($v121, $v42, $v116, $v61);
@xml_parser_free($v121);
foreach ($v116 as $k=>$v){
if($v['type'] == "complete"){
$$v['tag'] = trim(@$v['value']);
}
}
$v112 = true;
} else {
$v112 = false;
}
$v120 = $v32['path']['www']."/".$myWimpyPHPfilename;
if(!isset($wimpySwf)){
$wimpySwf = $v32['path']['www']."/".$myWimpySWFfilename;
}
if(!isset($wimpyApp)){
$wimpyApp = $v32['path']['www']."/".$myWimpyPHPfilename;
}
if(!isset($tptBkgd)){
$tptBkgd = "yes";
}
if(!isset($bkgdColor)){
$bkgdColor = "000000";
}
if(!isset($startDir)){
$startDir = "";
}
if(!isset($hide_folders)){
$hide_folders = "_notes,goodies,playlister_output,skins,getid3,_private,_private,_vti_bin,_vti_cnf,_vti_pvt,_vti_txt,cgi-bin";
}
if(!isset($hide_files)){
$hide_files = "skin.xml,wimpyConfigs.xml,wimpyAVConfigs.xml,wimpy.swf,wimpyAV.swf,wasp.swf,wimpy_button.swf";
}
if(!isset($wimpyHTMLpageTitle)){
$wimpyHTMLpageTitle = "Wimpy Player";
}
if(!isset($getMyid3info)){
$getMyid3info = "no";
}
if(!isset($ecommerce)){
$ecommerce = "no";
}
if(!isset($v45)){
$v45 = 0;
}
if(!isset($v44)){
$v44 = 0;
}
if(!isset($wimpySkin)){
$wimpySkin = "";
}
if(!isset($defaultVisualExt)){
$defaultVisualExt = "jpg";
}
if(!isset($defaultVisualBaseName)){
$defaultVisualBaseName = "coverart";
}
if(!isset($v65)){
$v65 = "no";
}
if(!isset($v66)){
$v66 = "0";
}
if($ecommerce == "yes"){
$forceDownload = "no";
$displayDownloadButton = "yes";
$getMyid3info = "yes";
}
if(@$_REQUEST['action'] == "writeJS"){
$v113 = true;
if(strlen(@$wimpySkin)>4){
if($v42 = f6($wimpySkin)){
$v122 = @xml_parser_create('');
@xml_parse_into_struct($v122, $v42, $v116, $v61);
@xml_parser_free($v122);
$v45 = @$v116[@$v61['BKGD_MAIN'][0]]['attributes']['WIDTH'];
$v44 = @$v116[@$v61['BKGD_MAIN'][0]]['attributes']['HEIGHT'];
} else {
$v113 = false;
}
} else {
$v113 = false;
}
}
if($v45<1 || $v44<1){
$v113 = false;
$v45 = "480";
$v44 = "140";
}
if($startDir != ""){
$v32['path']['physical'] = $startDir;
$serveMP3 = "yes";
}
$v32['path']['physical'] = str_replace("\\", "/", $v32['path']['physical']);
$v32['path']['physical'] = str_replace("//", "/", $v32['path']['physical']);
$v89 = "";
function f6($v48){
$v48 = @file("$v48");
return !$v48 ? false : implode('', $v48);
}
$v23 = array();
$v22 = array();
function f16($v104){
global $startDir,$v91;
return (str_replace($startDir.$v91, "", $v104));
}
function f0($v85, $v94="no", $v60="no"){
global $v50,$wimpyApp,$startDir,$v23,$v22,$hide_files,$getMyid3info,$defaultVisualBaseName,$defaultVisualExt,$v32,$v89,$v91,$v78,$hide_folders,$media_types,$v69,$myDataSetup;
if($v85 == $v32['path']['physical'] || $v94=="yes"){
$v86 = true;
} else {
$v86 = false;
}
$v58=@opendir($v85);
$v6 = array ();
$v12 = array ();
$v16 = array ();
$v15 = array();
$v14 = explode(",",$hide_files);
$v15 = explode(",",$hide_folders);
$v21 = explode(",",$media_types);
$v43 = 0;
$v37 = $v32['path']['www'];
while (false !== ($v48 = @readdir($v58))){
$v52 =($v48);
$ext = explode('.',$v48);
$v72 = strtolower($ext[sizeof($ext)-1]);
if(!in_array($v48,$v14)){
if($v48 != '.' && $v48 != '..' && @sizeof($ext)>1 && in_array(strtolower($v72),$v21)){
if($v72 == "xml"){
if(stristr(strtolower($v48), "skin") || stristr(strtolower($v48), "config")){
$v46 = "";
} else {
$v12[count($v12)]=($v48);
}
} else if($v72 == "pls" || $v72 == "m3u"){
$v12[count($v12)]=($v48);
} else {
$v12[count($v12)] = ($v48);
}
} else {
if($v48 != '.' && $v48 != '..'){
if(!in_array($v48,$v15)){
if (false !== ($v39 = @opendir($v85.$v91.$v48))){
$v6[count($v6)] =($v48);
}
@closedir($v85.$v91.$v48);
}
}
}
}
}
@closedir($v58);
natcasesort($v6);
natcasesort($v12);
$v7 = array_values($v6);
if($v50 == "des"){
$v13 = array_values(array_reverse($v12));
} else {
$v13 = array_values($v12);
}
for($i=0;$i<sizeof($v7);$i++){
$v97 = $v7[$i];
$v7[$i]=f4(f7($v85.$v91.$v97))."||||";
$v43++;
}
for($i=0;$i<sizeof($v13);$i++){
$v97 = $v13[$i];
$ext = explode('.',$v97);
$v72 = strtolower($ext[sizeof($ext)-1]);
if($v72 == "pls" || $v72 == "m3u"){
$v13[$i]=f4($wimpyApp."?action=feedPlaylist&theFile=".f7($v85.$v91.$v97))."||||";
} else {
$v13[$i]=f4(f7($v85.$v91.$v97))."|".(f13 ($v85.$v91.$v97, "full"));
}
}
if($v69 == "mysql"){
if(sizeof($v13)){
for($i=0;$i<sizeof($v13); $i++){
array_push ($v16,($v13[$i]));
}
}
return $v16;
} else {
if(sizeof($v7)){
for($i=0;$i<sizeof($v7); $i++){
array_push ($v16, ($v7[$i]));
}
}
if(sizeof($v13)){
for($i=0;$i<sizeof($v13); $i++){
array_push ($v16, ($v13[$i]));
}
}
for($i=0;$i<sizeof($v16);$i++){
$v89 .= "&item".$i."=".($v16[$i]);
}
$v107 = sizeof ($v16);
if($startDir == ""){
$v119 = $v85.$v91.$defaultVisualBaseName.".".$defaultVisualExt;
if (is_file($v119)){
$v118 = "&visualURL=".f4(f7($v119));
} else {
$v118 = "";
}
} else {
$v119 = $v85.$v91.$defaultVisualBaseName.".".$defaultVisualExt;
if(is_file($v119)){
$v84 = str_replace ( $v32['path']['physical'], "", $v119);
$v84 = str_replace ( $v91, "/", $v84);
$v118 = "&visualURL=".f4($wimpyApp."?action=getCoverart&theFile=".$v84);
} else {
$v118 = "";
}
}
$v89 .= "&totalitems=$v107".$v118;
$v89 .= "&datasetup=$myDataSetup";
return $v89;
@clearstatcache();
}
}
function asc2hex ($v105) {
$v95 = $v105;
$v42 = "";
for ($i=0; $i<strlen($v95); $i++){
$char = substr($v95,$i,1);
if(!ereg('[A-Za-z0-9|/:.^]', $char)){
$v42 .= rawurlencode(f24(ord($char)));
}else{
$v42.=$char;
}
}
return $v42;
}
function f24($dec) {
if ($dec < 128) {
$utf = chr($dec);
} else if ($dec < 2048) {
$utf = chr(192 + (($dec - ($dec % 64)) / 64));
$utf .= chr(128 + ($dec % 64));
} else {
$utf = chr(224 + (($dec - ($dec % 4096)) / 4096));
$utf .= chr(128 + ((($dec % 4096) - ($dec % 64)) / 64));
$utf .= chr(128 + ($dec % 64));
}
return $utf;
}
function f4($v105){
global $v77;
if($v77 == "win"){
$v84 = asc2hex ($v105);
} else {
$v84 = rawurlencode($v105);
}
return $v84;
}
function f13($v100, $v111=""){
global $v32,$v91,$v34,$getMyid3info,$v70;
@set_time_limit(30);
@flush();
$v72 = explode(".", $v100);
if ($getMyid3info=="yes" && strtolower($v72[sizeof($v72)-1]) != "xml"){
$v84 = f8($v100);
} else {
$v84 = array();
$v84[0]="";
$v84[1]="";
$v84[2]="";
$v84[3]="";
$v84[4]="";
$v84[5]="";
$v84[6]="";
$v84[7]="";
$v84[8]="";
}
$v29 = explode($v91,$v100);
$v98 = $v29[sizeof($v29)-1];
$v31=explode('.',$v98);
$v99 = $v31[sizeof($v31)-2];
if($v84[0]=="" || $v84[0]==null){
$v84[0] =  ($v99);
}
if($v84[2]=="" || $v84[2]==null){
$v84[2] =  ($v99);
}
$v84[9] =  f12($v100);
for($i=0;$i<sizeof($v84);$i++){
$v84[$i] = f4($v84[$i]);
}
return ((implode ("|", $v84)));
}
function f8($v100){
global $startDir,$getMyid3info,$v32, $v91, $v56, $action;
$v41 = urldecode($v100);
if($getMyid3info == "yes"){
$v62 = $v56->analyze($v41);
getid3_lib::CopyTagsToComments($v62);
} else {
$v62 = array();
}
$v84 = array();
if(sizeof($v62)>0){
$v84[0]=@ ($v62['comments']['artist'][0]);
$v84[1]=@($v62['comments']['album'][0]);
$v84[2]=@ ($v62['comments']['title'][0]);
$v84[3]=@($v62['comments']['track'][0]);
$v84[4]="/";
$v55 = 0;
if($action == "podcast"){
$v55 = 1;
}
if(@strlen(@$v62['comments']['comment'][0])>@strlen(@$v62['comments']['comments'][0])){
if(@substr($v62['comments']['comment'][0],0,4)=="http" || $v55 == 1){
$v84[4]=(@$v62['comments']['comment'][0]);
}
} else {
if(@substr($v62['comments']['comments'][0],0,4)=="http" || $v55 == 1){
$v84[4]=(@$v62['comments']['comments'][0]);
}
}
if($v84[4] == "" || $v84[4] == "null"){
$v84[4] = "/";
}
$v84[5]=(@$v62['comments']['genre'][0]);
$v84[6]=(@$v62['playtime_seconds']);
$v84[7]=(round(@$v62['filesize']/1000000, 2));
$v84[8]=(round(@$v62['audio']['bitrate']/1000));
} else {
return 0;
break;
}
return $v84;
}
function f12($theFile){
global $wimpyApp,$startDir,$defaultVisualBaseName, $defaultVisualExt, $v32, $v91;
$v30 = explode(".", str_replace("/", $v91, urldecode($theFile)));
array_pop($v30);
if($startDir == ""){
$v30 = explode(".", $theFile);
array_pop($v30);
$v103 = urldecode((implode(".", $v30).".".$defaultVisualExt));
if(is_file($v103)){
return (f7($v103));
} else {
return false;
}
} else {
$v103 = (implode(".", $v30).".".$defaultVisualExt);
if(strpos ($v103, $v32['path']['physical']) === false){
$v103 = $v32['path']['physical'].$v91.$v103;
}
if(is_file($v103)){
$v84 = str_replace ( $v32['path']['physical'], "", $v103);
$v84 = str_replace ( $v91, "/", $v84);
return ($wimpyApp."?action=getCoverart&theFile=".$v84);
}
}
}
function f25($v106){
global $v32, $v91, $v71,$httpOption;
$v81 = str_replace($v32['path']['www'], "", $v106);
$v102 = $v32['path']['physical'].$v81;
$v102 = str_replace("//", "/", $v102);
return $v102;
}
function f7($v102){
global $startDir,$v32, $v91;
$v81 = str_replace($v32['path']['physical'], "", $v102);
$v102 = $v32['path']['www'].$v81;
$v102 = str_replace("://", "__:__", $v102);
$v102 = str_replace("//", "/", $v102);
$v102 = str_replace("__:__", "://", $v102);
return $v102;
}
function f2($v49){
return ereg_replace("[^a-z0-9._]", "",str_replace(" ", "_",str_replace("%20", "_", strtolower($v49))));
}
function f3($v49){
return utf8_encode($v49);
}
function f21($v49, $v47){
$ext = explode('.',$v49);
$v72 = strtolower($ext[sizeof($ext)-1]);
if(strtolower($v72) != strtolower($v47)){
return false;
} else {
return true;
}
if ((!ereg('\.\.', $v49)) && (file_exists($v49))) {
return true;
} else {
return false;
}
}
function f23($v93){
$v84 = $v93;
$v84 = strip_tags(stripslashes($v84));
$v84 = strip_tags($v84);
$v84 = str_replace("sscanf", "x", $v84);
$v84 = str_replace("base64_decode", "x", $v84);
$v84 = str_replace("rawurldecode", "x", $v84);
$v84 = str_replace("urldecode", "x", $v84);
$v84 = str_replace("0;", "x", $v84);
$v84 = str_replace("%5C", "x", $v84);
$v84 = str_replace("\n", "x", $v84);
$v84 = str_replace("\r", "x", $v84);
$v84 = str_replace("\t", "x", $v84);
$v84 = str_replace("\\", "x", $v84);
$v84 = ereg_replace("\.+/", "x", $v84);
$v84 = ereg_replace("\.\.","x",$v84);
$v84 = ereg_replace("^[\/]+", "x", $v84);
return $v84;
}
function f20($v35){
if(@is_array($v35)){
foreach ($v35 as $key => $v117){
$v28[f23(urldecode($key))] = f23($v117);
}
} else {
$v28 = $v35;
}
return $v35;
}
if ( @get_magic_quotes_gpc () ){
function traverse ( &$arr ){
if ( !is_array ( $arr ) ){
return;
}
foreach ( $arr as $key => $val ){
is_array ( $arr[$key] ) ? traverse ( $arr[$key] ) : ( $arr[$key] = stripslashes ( $arr[$key] ) );
}
}
$gpc = array ( &$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
traverse ( $gpc );
}
$_REQUEST = f20($_REQUEST);
$_GET = f20($_GET);
$_POST = f20($_POST);
$_COOKIE = f20($_COOKIE);
$v3 = array(
"action",
"theFile",
"filename",
"dir",
"getMyid3info",
"useMysql",
"queryValue",
"queryWhere",
"forceDownload",
"defaultVisualExt",
"defaultVisualBaseName",
"theArtist",
"theTitle",
"s"
);
for($i=0;$i<sizeof($v3);$i++){
$var = $v3[$i];
if(!isset($_REQUEST[$var])){
if(!isset($$var)){
$$var = "";
}
} else {
$$var = $_REQUEST[$var];
}
}
if($useMysql=="yes"){
$action = "getmysql";
}
if(is_file($wimpy_auth)){
$useAuth = TRUE;
require ($wimpy_auth);
}
function f14($v51){
$v40 = 1*(1024*1024);
$v38 = '';
$cnt =0;
$v58 = fopen($v51, 'rb');
if ($v58 === false) {
return false;
}
while (!feof($v58)) {
$v38 = fread($v58, $v40);
echo $v38;
}
$v92 = fclose($v58);
return $v92;
}
function f11($v51){
$v40 = 1*(1024*1024);
$v38 = '';
$cnt = 0;
$v58 = fopen($v51, 'r');
if ($v58 === false) {
return false;
}
while (!feof($v58)) {
$v38 = fread($v58, $v40);
}
$v92 = fclose($v58);
$v4 = explode("\n", $v38);
$v5 = array();
foreach($v4 as $v67){
$v68 = trim($v67);
if($v68 !== ""){
array_push($v5, $v68);
}
}
return $v5;
}
function f5($v10){
$v26 = array();
array_push($v26, '<'.urldecode("%3F").'xml version="1.0"'.urldecode("%3F").'>');
array_push($v26, '<playlist>');
for ($i=0; $i<sizeof($v10); $i++) {
array_push($v26, '<item>');
foreach ($v10[$i] as $key => $v117) {
$v42 = f4($v117);
array_push($v26, '<'.$key.'>'.($v42).'</'.$key.'>');
}
array_push($v26, '</item>');
}
array_push($v26, '</playlist>');
header("Pragma: public", false);
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT", false);
header("Cache-Control: must-revalidate, post-check=0, pre-check=0", false);
header("Cache-Control: no-store, no-cache, must-revalidate", false);
header("Content-Type: text/xml");
print (implode("", $v26));
exit;
}
function f19($v8){
$v10 = array();
for($i=0;$i<sizeof($v8);$i++){
$v33 = array();
$v33['filename'] = $v8[$i];
$v33['artist'] = "";
$v33['album'] = "";
$v33['title'] = "";
$v33['track'] = "";
$v33['comments'] = "";
$v33['genre'] = "";
$v33['seconds'] = "";
$v33['filesize'] = "";
$v33['bitrate'] = "";
$v33['visual'] = "";
$v10[$i] = $v33;
}
f5($v10);
}
function f17($v8){
$v10 = array();
for($i=0;$i<sizeof($v8);$i++){
$v75 = $v8[$i];
if(stristr($v75, '#EXTINF:')){
$v17 = explode(":", $v75);
$v18 = explode(",", $v17[1]);
$v33 = array();
$v33['filename'] = $v8[$i+1];
$v33['artist'] = "";
$v33['album'] = "";
$v33['title'] = $v18[1];;
$v33['track'] = "";
$v33['comments'] = "";
$v33['genre'] = "";
$v33['seconds'] = $v18[0];
$v33['filesize'] = "";
$v33['bitrate'] = "";
$v33['visual'] = "";
$v10[sizeof($v10)] = $v33;
$i++;
}
}
f5($v10);
}
function f18($v8){
$v10 = array();
for($i=0;$i<sizeof($v8);$i++){
$v75 = $v8[$i];
if(strtolower(substr($v75, 0, 4)) == "file"){
$v17 = explode("=", $v75);
$v18 = explode("=", $v8[$i+1]);
$v19 = explode("=", $v8[$i+2]);
$v33 = array();
$v33['filename'] = $v17[1];
$v33['artist'] = "";
$v33['album'] = "";
$v33['title'] = $v18[1];;
$v33['track'] = "";
$v33['comments'] = "";
$v33['genre'] = "";
$v33['seconds'] = $v19[1];
$v33['filesize'] = "";
$v33['bitrate'] = "";
$v33['visual'] = "";
$i++;
$i++;
$v10[sizeof($v10)] = $v33;
}
}
f5($v10);
}
function f9($v101){
$v11 = explode("/", urldecode($v101));
$v27 = array();
$v36 = array_pop($v11);
$v27['basename'] = $v36;
$v2 = explode(".", $v36);
$v27['extension'] = array_pop($v2);
return $v27;
}
function f10($v101){
$v24 = explode("?", urldecode($v101));
$v11 = explode("/",$v24[0]);
$v27 = array();
$v36 = array_pop($v11);
$v27['basename'] = $v36;
$v2 = explode(".", $v36);
$v27['extension'] = array_pop($v2);
return $v27;
}
function f22($v106, $v54 = false){
global $media_types,$hide_files,$v32,$v91,$startDir;
$theFile = f23(urldecode($v106));
$v9 = f10($theFile);
$v21 = explode(",", $media_types);
if(!in_array($v9['extension'], $v21)){
exit;
}
$v14 = explode(",", $hide_files);
if(in_array($v9['basename'], $v14)){
exit;
}
$v102 = f25($theFile);
$v73 = @filesize($v102);
$v74 = f3($v9['basename']);
header("Pragma: public");
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: private");
header("Content-Type: audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
if($v54 == true){
header( "Content-Disposition: attachment; filename=".$v9['basename'].";" );
}
header("Content-Transfer-Encoding: binary");
if($v73){
header("Content-Length: ".$v73, false);
} else {
header("Content-Length: 60000000", false);
}
f14($v102);
exit;
}
$v88 = "\r\n";
$v82 = "";
$v82 .= $wimpySwf;
if($v112 == true){
$v80 = $v32['path']['www']."/".$wimpyConfigFile;
$v82 .= "?wimpyConfigs=".$v80;
} else {
$v80 = "";
$v82 .= "?wimpyApp=".$wimpyApp;
}
if($bkgdColor == ""){
$bkgdColor = "000000";
}
if($tptBkgd == "yes"){
$v114 = true;
} else {
$v114 = false;
}
if($v114){
$v108 = 'wmode="transparent" ';
$v109 = '<param name="wmode" value="transparent" />';
} else {
$v108 = "";
$v109 = "";
}
function f26(){
global $v82,$v88,$bkgdColor,$v108,$v109,$v45,$v44;
$v53 = '<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="'.$v45.'" height="'.$v44.'" id="wimpy">'.$v88;
$v53 .= '<param name="movie" value="'.$v82.'" />'.$v88;
$v53 .= '<param name="loop" value="false" />'.$v88;
$v53 .= '<param name="menu" value="false" />'.$v88;
$v53 .= '<param name="quality" value="high" />'.$v88;
$v53 .= '<param name="scale" value="noscale" />'.$v88;
$v53 .= '<param name="salign" value="lt" />'.$v88;
$v53 .= '<param name="bgcolor" value="#'.$bkgdColor.'" />'.$v109.$v88;
$v53 .= '<embed src="'.$v82.'" width="'.$v45.'" height="'.$v44.'" bgcolor="#'.$bkgdColor.'" loop="false" menu="false" quality="high" scale="noscale" salign="lt" id="wimpy" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" '.$v108.'/></object>'.$v88;
return ($v53);
}
if($action=="getVersion"){
print "$wimpyVersion";
exit;
} else if($action == "feedPlaylist"){
$v20 = f11(f25($theFile));
if(f21($theFile, "pls") === true || f21($theFile, "m3u") === true){
if(strtolower ($v20[0]) == "[playlist]"){
f18($v20);
} else if(strtoupper ($v20[0]) == "#EXTM3U"){
f17($v20);
} else {
f19($v20);
}
} else {
echo "";
exit;
}
} else if ($action=="phpinfo"){
if($blockPHPinfo != "yes"){
$v84 = phpinfo();
echo "$v84";
exit;
}
} else if($action=="getCoverart"){
$theFile = urldecode($_REQUEST['theFile']);
$v102 = $startDir.str_replace("/", $v91, urldecode($theFile));
$ext = explode('.',$v102);
$v72 = strtolower($ext[sizeof($ext)-1]);
if(f21($v102, "jpg") === true || f21($v102, "swf") === true){
header("Expires: Thu, 19 Nov 1981 08:52:00 GMT", false);
header("Content-Type: image/jpeg", false);
header("Content-Length: ".@f23(@urldecode(@filesize($v102))), false);
f14($v102);
exit;
} else {
echo "";
exit;
}
} else if($action=="getstartupdirlist"){
header("Content-Type: text/html", false);
if($getMyid3info == "yes"){
if(is_file('getid3.php')){
require ('getid3.php');
$v56 = new getID3;
} else if (is_file('getid3'.$v91.'getid3.php')){
require ('getid3'.$v91.'getid3.php');
$v56 = new getID3;
} else if (is_file(@$v57)){
require (@$v57);
$v56 = new getID3;
} else {
$getMyid3info = "no";
}
}
$v89 = f0($v32['path']['physical']);
echo (($v89));
} else if ($action=="dir"){
if($getMyid3info == "yes"){
if(is_file('getid3.php')){
require ('getid3.php');
$v56 = new getID3;
} else if (is_file('getid3'.$v91.'getid3.php')){
require ('getid3'.$v91.'getid3.php');
$v56 = new getID3;
} else if (is_file(@$v57)){
require (@$v57);
$v56 = new getID3;
} else {
$getMyid3info = "no";
}
}
$v76 = ($v32['path']['physical'].$v91.str_replace("/", $v91, str_replace($v32['path']['www']."/", "", f23($dir))));
$v89 = f0($v76);
echo ( ($v89));
exit;
} else if($action=="getmysql"){
require ("wimpy.sql.php");
} else if ($action=="serveMP3"){
f22($_REQUEST['theFile'], false);
} else if ($action=="downloadfile"){
f22($_REQUEST['theFile'], true);
} else if ($action=="podcast"){
$v69 = "mysql";
$getMyid3info = "yes";
if(is_file('getid3.php')){
require ('getid3.php');
$v56 = new getID3;
} else if (is_file('getid3'.$v91.'getid3.php')){
require ('getid3'.$v91.'getid3.php');
$v56 = new getID3;
} else {
print 'You have elected to use ID3 information in the playlist.<br>';
print 'In order to present ID3 information you must upload the getID3<br>';
print 'library to your wimpy folder. The files can be found in the <br>';
print '"goodies" folder or downloaded from the following location:<br>';
print 'http://www.wimpyplayer.net/downloads<br>';
print 'Please upload all of the getID3 files to the same location as wimpy.php<br>';
exit;
}
$podBack = f0($v32['path']['physical'], "yes");
} else if($action=="writeJS"){
$v88 = "\n";
$v63 = "function f27(wimpyConfigsURL){";
$v63 .= "var myContent = '".implode("", explode($v88,f26()))."';";
$v63 .= "document.write(myContent);";
$v63 .= "}";
print ($v63);
exit;
} else {
$v53 = '<HTML>'.$v88;
$v53 .= '<HEAD>'.$v88;
$v53 .= '<TITLE>'.$wimpyHTMLpageTitle.'</TITLE>'.$v88;
$v53 .= '</HEAD>'.$v88;
$v53 .= '<BODY bgcolor="#'.$bkgdColor.'" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">'.$v88;
$v53 .= '<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">'.$v88;
$v53 .= '  <tr>'.$v88;
$v53 .= '<td align="center" valign="middle">'.$v88;
$v53 .= '<!-- START WIMPY CODE -->'.$v88;
$v53 .= '<script src="'.$v120.'?action=writeJS" type="text/javascript"></script>'.$v88;
$v53 .= '<script language="JavaScript">f27();</script>'.$v88;
$v53 .= '<!-- END WIMPY CODE -->'.$v88;
$v53 .= '</td>'.$v88;
$v53 .= '</tr>'.$v88;
$v53 .= '</table>'.$v88;
$v53 .= '</BODY>'.$v88;
$v53 .= '</HTML>'.$v88;
print ($v53);
exit;
}
?>