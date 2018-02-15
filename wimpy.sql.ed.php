<?php
/////////////////////////////////////////////////////////////////
//                                                             //
//  Wimpy SQL ED                                               //
//  v3.0                                                       //
//  7/12/2012                                                  //
//  By Mike Gieson                                             //
//  ©2012 Plaino                                               //
//  www.wimpyplayer.net                                        //
//                                                             //
//  USE AT YOUR OWN RISK                                       //
//                                                             //
/////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
//                                                             //
//                     DATABASE SETUP:                         //
//                                                             //
/////////////////////////////////////////////////////////////////

// MySQL database setup
$host        = "localhost";
$db          = "music";

// $table_files needs to be set to the table (in the database 
// listed above) that contains the information about each track.
$table_files = "mp3s";

// Username and password, which has enough previledges to 
// retrieve information from the database.
// NOTE: This user only needs "SELECT" priveledges.
$publicUser  = "admin";
$publicPwd   = "bob";



/////////////////////////////////////////////////////////////////
//                                                             //
//                     RELATIONSHIPS:                          //
//                                                             //
/////////////////////////////////////////////////////////////////

// Here we are providing a reference to which fields within 
// the table (as defined in "$table_files" above) relate to
// specific kinds of information that Wimpy needs.
$myField_ID		= 'id';
$myField_File	= 'filename';
$myField_Artist	= 'artist';
$myField_Title	= 'title';
$myField_Image	= 'visual';
$myField_Link	= 'comments';



/////////////////////////////////////////////////////////////////
//                                                             //
//                         OTHER:                              //
//                                                             //
/////////////////////////////////////////////////////////////////

// Use a trailing slash/
$appendPath = 'http://localhost/mp3s/music/';
$appendField = '';
$forceTrailingSlash = FALSE;



/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
//                                                             //
//                 DON'T EDIT BELOW HERE                       //
//          (Unless you know what you're doing! :)             //
//                                                             //
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////

// @clearstatcache();
// @ob_flush();

// connect to DB
$link = @mysqli_connect($host, $publicUser, $publicPwd) 
	 or die("Check configurations in wimpy.sql.ed.php and try again.");
mysqli_select_db($link, $db) 
	 or die(mysqli_error($link));

/////////////////////////////////////////////////////////////////
//                                                             //
//                     COMMON FUNCTIONS:                       //
//                                                             //
/////////////////////////////////////////////////////////////////

function myStringPrep($value){
	global $link;
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	if (!is_numeric($value)) {
		$value = mysqli_real_escape_string($link, $value);
	}
	return $value;
}

/*
function myStringPrep($value){
	if (get_magic_quotes_gpc()) {
		$value = stripslashes($value);
	}
	if(@version_compare(phpversion(),"4.3.0")=="-1") {
		$string = mysql_escape_string($value);
	} else {
		$string = mysql_real_escape_string($value);
	}
	$value = $string;
	return $value;
}
*/



function striphack($string){
	$retval = $string;
	$retval = strip_tags(stripslashes($retval));
	$retval = strip_tags($retval);
	$retval = str_replace("\n", "x", $retval);
	$retval = str_replace("\r", "x", $retval);
	$retval = str_replace("\t", "x", $retval);
	$retval = str_replace("\\", "x", $retval);
	$retval = preg_replace("#\.+/#", "x", $retval); 
	$retval = preg_replace("#\.\.#","x",$retval); 
	return $retval;
}


function secureArray($array_in){	
	if(@is_array($array_in)){
		foreach ($array_in as $key => $value){
			$Atemp[striphack(urldecode($key))] = striphack($value);
		}
	} else {
		$Atemp = $array_in;
	}
	return $array_in;
}


function forceTrailingSlash($thePath){
	if($thePath == ''){
		return $thePath;
	} else {
		$lastChar = substr($thePath, strlen($thePath)-1, 1);
		if($lastChar == "/"){
			return $thePath;
		} else {
			if(strrpos($thePath, "\\")){
				return $thePath."\\";
			} else {
				return $thePath."/";
			}
		}
	}
}


if ( get_magic_quotes_gpc () ){
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


$AcheckRequests = array(
						"queryWhere",
						"queryWhereCol",
						"queryWhereVal",
						"querySelect",
						"queryTable",
						"queryValue", 
						"action"
						);


$_REQUEST = secureArray($_REQUEST);
$_GET = secureArray($_GET);
$_POST = secureArray($_POST);


for($i=0;$i<sizeof($AcheckRequests);$i++){
	$var = $AcheckRequests[$i];
	if(!isset($_REQUEST[$var])){
		if(!isset($$var)){
			$$var = "";
		}
	} else {
		$$var = $_REQUEST[$var];
	}
}

function pushfile($filename, $kind){
	header("Pragma: public");
	header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Content-Type: audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3");
	if($kind == "downloadfile"){
		header("Cache-Control: private");
		header('Content-Disposition: attachment; filename="'.$Afile_info['basename'].'"' );
	}
	header("Content-Transfer-Encoding: binary");
	header("Content-Length: ".filesize($filename));
	$chunksize = 1*(1024*1024);
	$buffer = '';
	$cnt =0;
	$handle = fopen($filename, 'rb');
	if ($handle === false) {
		return false;
	}
	while (!feof($handle)) {
		$buffer = fread($handle, $chunksize);
		echo $buffer;
	}
	$status = fclose($handle);
	return $status;
}


$myFieldName['uniqueID'] = @$myField_ID;
$myFieldName['filename'] = @$myField_File;
$myFieldName['artist']   = @$myField_Artist;
$myFieldName['title']    = @$myField_Title;
$myFieldName['visual']   = @$myField_Image;
$myFieldName['link']     = @$myField_Link;


//////////////////////////////////////////////////
//                                              //
//             REQUEST HANDLING                 //
//                                              //
//////////////////////////////////////////////////

if($action=="serveMP3" || $action=="downloadfile"){

	
	$sql = "SELECT * FROM ".$table_files." WHERE ".$myFieldName['uniqueID']."='".myStringPrep($_REQUEST['theID'])."';";

	// HINT: Place a single / in front of /* to uncomment this section:
	/*
	print ($sql);
	exit;
	//*/


	// Both "theFile" and "theID" are returned from Wimpy. 
	// "theID" is prefered since this minimizes issues with 
	// weirdo characters such as: '&?"!@$#%$ and so on.
	//
	// If you are having difficulties, try uncommenting the line 
	// below, which uses the filename field to serve the file.

	//$sql = "SELECT * FROM ".$table_files." WHERE ".$myFieldName['filename']."='".myStringPrep($_REQUEST['theFile'])."';";

	$result = mysqli_query($link, $sql);
	//print $sql;
	if($result){
		$line = mysqli_fetch_assoc($result);
		$myFile = $line[$myFieldName['filename']];
		if(file_exists($myFile)){
			pushfile($myFile, $action);
		} else {
			echo ("&retval=error 1 : file doesn't exist"."  ".$_REQUEST['theID']);
		}
	} else {
		echo "&retval=error 2 : No results from query!";
	}
	exit;


} else {

	
	$count=0;
	$sendback = "";
	$AmyDataSetup = array();
	$AqueryValues = explode("|", $queryValue);
	for($i=0;$i<sizeof($AqueryValues);$i++){
		$query = "SELECT * FROM ".$table_files." WHERE ".myStringPrep($queryWhere)."='".myStringPrep($AqueryValues[$i])."';";
		$result = mysqli_query($link, $query);
		if($result){
			while ($line = mysqli_fetch_assoc($result)) {
				$lineClean = array();
				foreach($line as $key=>$value){
					if($count==0){
						array_push($AmyDataSetup, $key);
					}
					if($key == $myFieldName['filename']){
						if($forceTrailingSlash){
							$myFile = forceTrailingSlash($appendPath).$value;
						} else {
							$myFile = @$appendPath.$value;
						}
						if(@$appendField != ''){
							if($forceTrailingSlash){
								$myFile = forceTrailingSlash(@$line[@$appendField]).$value;
							} else {
								$myFile = @$line[@$appendField].$value;
							}
							
						}
						$lineClean[] = rawurlencode($myFile);
					} else {
						$lineClean[] = rawurlencode($value);
					}
				}
				$sendback .= "&item$count=".implode("|", $lineClean);
				$count++;
			}
		}
	}
	$myDataSetup = implode("|", $AmyDataSetup);
	@mysqli_free_result($result);
	mysqli_close($link);
	$sendback .= "&totalitems=$count";
	$sendback .= "&datasetup=$myDataSetup";
	$sendback .= "&my_filename=".$myFieldName['filename'];
	$sendback .= "&my_artist=".$myFieldName['artist'];
	$sendback .= "&my_title=".$myFieldName['title'];
	$sendback .= "&my_visual=".$myFieldName['visual'];
	$sendback .= "&my_link=".$myFieldName['link'];
	$sendback .= "&my_id=".$myFieldName['uniqueID'];
	print ("$sendback");
}


?>