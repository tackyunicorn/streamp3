<?php

// Example Query:
// http://localhost/wimpysql_ed/myWimpy.php?queryWhere=artist&queryValue=jack%20johnson

$myWhere = @$_REQUEST['queryWhere'];
$myValue = @$_REQUEST['queryValue'];


?>
<html>
<head>
<title>MP3 Player</title>

<meta charset="UTF-8">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">

<!-- START EASYSWF CODE -->
<script src="easyswf.js" type="text/javascript"></script>
<!-- END EASYSWF CODE -->

</head>

<body bgcolor="000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
	<div class="container">
		<div class="row" align="center">
<!-- START WIMPY PLAYER CODE -->
<script language="javascript">
easyswf({	swf:		"wimpy.swf",
			bgcolor: 	"#000000",
			width:		435,
			height:		271,
			swfversion:	"8,0,0,0",
			scale:		"noscale",
			salign:		"tl",
			allowScriptAccess:	true,
			flashvars: {
				wimpyApp: 		"wimpy.sql.ed.php",
				wimpySkin: 		"skin_wimpysql_ed.xml",
				startPlayingOnload: "yes",
				useMysql: 		"yes",
				defaultImage: 	"coverart_fallback.jpg",
				queryValue: 	"<?php print ($myValue); ?>",
				queryWhere: 	"<?php print ($myWhere); ?>"
			}
});
</script>
<!-- END WIMPY PLAYER CODE -->
	<br>
	<br>
	<div class="input-group input-group-icon">
  		<a href="index.php"><input type="button" value="Logout" autofocus></input></a>
  	</div>
		</div>

</table>
</div>
</body>
</html>
