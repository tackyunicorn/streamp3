<%@ Language=VBScript EnableSessionState=False %>
<%
Option Explicit
Response.buffer = True
dim v60,filename,useMysql,v127,v22,v18,v69,v44,v138,v105,v115,v70,v112,v122,v149,v148,v48,v50,v73,v63,v154,v24,v72,defaultVisualBaseName,bkgdColor,scrollInfoDisplay,tptBkgd,forceXMLplaylist,randomOnLoad,shuffleOnLoad,defaultImage,voteScript,trackPlays,wimpyApp,wimpySwf,v39,useConfigFile,v109,randomButtonState,startOnTrack,autoAdvance,bufferAudio,v124,v123,v133,v131,v94,wimpySkin,useSysCodePage,serveMP3
dim v120,ecomWindow,strAbv116,v132,v104,v5,hide_files,v150,j,v145,items,v54,v108,v117,v1,v53,v98,v118,totalv7,v155,v7,v119,tf,fso,v83,v78,v25,QueryString,playerH,playerW,playerSize_value,v140,destination,v141,v2,v3,v137,v66,v134,v136,v67,v135,v116,v4,v57,v151,v152,defaultVisualExt,defaultVisualName,ecommerce,forceDownload,hide_folders,defaultPlaylistFilename,myDataSetup,pwd,user,table,db,v64
dim v147,v113,theVolume,popUpHelp,startPlayingOnload,defaultPlayRandom,infoDisplayTime,displayDownloadButton,background_color,wimpyHTMLpageTitle,playlisterOutputDirName,getMyid3info,action,theFile,v59,queryValue,queryWhere,v92,dir,v41,v107,v106,retval,MP3,v130,v65,v100,v58,v40,v96,v19,v0,v6,v74,v46,v23,v143,v139,x,v101,v103,v102,v37,v15,v79,v55,v56,v49,v80,v128,v84,i,try,k
dim v146,v82,v16,v71,v86,v47,v17,v81,bob,v9,v11,v12,v14,v99,b,v51,v68,v43,v8,v126,v76,v77,v89,v85,v90,v93,v87,v111,v110,v45,v142,v52,v35,v27,v26,v36,v33,v29,v28,v31,v34,v30,v32,v121,v21,fs,v62,value,v75,v13,v10,v42,theWidth,theHeight,v114,v61
dim v153,v91,httpOption,startDir,loopPlaylist,wimpyVersion,wimpyConfigFile,myWimpySWFfilename,wimpy_auth,media_types,mediaExtMp3,myCodePage,useCustomCharset,myCharSet,fileSortOrder,v95,v125,v38
Response.Clear
'//<//////////////////////////////////////////////////////////////
'//                                                             //
'//                                                             //
'//                                                             //
'//                                                             //
'//                      Wimpy MP3 Player                       //
'//                                                             //
'//          available at http://www.wimpyplayer.net            //
'//                     ©2002-2011 plaino                       //
'//                                                             //
'//                                                             //
'//                                                             //
'/////////////////////////////////////////////////////////////////
'//                                                             //
'//                      INSTALLATION:                          //
'//                                                             //
'/////////////////////////////////////////////////////////////////
'//
'// Upload wimpy.php and wimpy.swf to the folder that
'// contains your mp3's.
'//
'// USE AT YOUR OWN RISK.
'//
wimpyVersion = "v6.0.33"
wimpyConfigFile = "wimpyConfigs.xml"
myWimpySWFfilename = "wimpy.swf"
media_types = "xml,mp3"
mediaExtMp3 = "mp3"
' httpOption = "https"
httpOption = "http"
'//
'// Character Mapping
'// If you are experiencing problems displaying glyphs and other
'// double-byte (multibyte) characters, set myCharSet
'// for your language's characters set here.
'//
'// For more information on "codepage" see:
'// http://msdn.microsoft.com/library/default.asp?url=/library/en-us/iissdk/html/268f1db1-9a36-4591-956b-d7269aeadcb0.asp
'//
'// For more information on "CharSet" see:
'// http://msdn.microsoft.com/library/default.asp?url=/workshop/author/dhtml/reference/charsets/charset4.asp
'//
'// In order to use a custom character mapping, you must "useCustomCharset" to "yes"
'//
'// Example:
'// useCustomCharset = "yes"
'//
useCustomCharset = "no"
myCodePage = 65001
myCharSet = "uft-8"
'//
'// fileSortOrder
'// Controls the sort order of how the files should be listed.
'// Can be set to:
'//"asc" - sort the files in alphabetically acending order (A-Z)
'//"des" - sort the files in alphabetically descenting order (Z-A)
'//
fileSortOrder = "des"
'fileSortOrder = "asc"
'/////////////////////////////////////////////////////////////////
'//                                                             //
'//         Do not edit anything below here unless              //
'//          you really know what you are doing!                //
'//                                                             //
'/////////////////////////////////////////////////////////////////
'/////////////////////////////////////////////////////////////////
'/////////////////////////////////////////////////////////////////
'/////////////////////////////////////////////////////////////////
'/////////////////////////////////////////////////////////////////
'//>
myDataSetup = "filename|artist|album|title|track|comments|genre|seconds|filesize|bitrate|visual"
set v58 = CreateObject("Scripting.FileSystemObject")
set v40 = CreateObject("Scripting.Dictionary")
v40.add "physical", v58.getparentfoldername(request.servervariables("PATH_TRANSLATED"))
v91 = v40("physical")
v40.add "www", httpOption & "://" & request.servervariables("SERVER_NAME") & v58.getparentfoldername(request.servervariables("PATH_INFO"))
v18 = split(request.servervariables("PATH_INFO"), "/")
v96 = v18(Ubound(v18))
set v39 = CreateObject("Scripting.Dictionary")
set v44 = CreateObject("Scripting.FileSystemObject")
useConfigFile = false
If v44.FileExists((v40("physical") & "\" & wimpyConfigFile)) Then
Set v109 = Server.CreateObject("Microsoft.XMLDOM")
v109.async = False
v109.Load (v40("physical") & "\" & wimpyConfigFile)
If v109.parseError.errorCode <> 0 Then
useConfigFile = false
else
useConfigFile = true
end if
if useConfigFile = true then
Set v115 = v109.documentElement
Set v105 = v115.getElementsByTagName("*")
if v105.length > 4 then
For i = 0 to (v105.length-1)
v39.add v105.item(i).nodeName, v105.item(i).text
Next
end if
end if
end if
set v44 = nothing
If v39.Exists("wimpySwf") = false Then
v39.add "wimpySwf", v40("www") & "/" &  myWimpySWFfilename
end if
If v39.Exists("wimpyApp") = false Then
v39.add "wimpyApp", v40("www") & "/" &  v96
end if
If v39.Exists("wimpySkin") = false Then
v39.add "wimpySkin", ""
end if
If v39.Exists("tptBkgd") = false Then
v39.add "tptBkgd", ""
end if
If v39.Exists("defaultVisualExt") = false Then
v39.add "defaultVisualExt", "jpg"
end If
If v39.Exists("defaultVisualBaseName") = false Then
v39.add "defaultVisualBaseName", "coverart"
end if
If v39.Exists("bkgdColor") = false Then
v39.add "bkgdColor", "000000"
end if
If v39.Exists("startDir") = false Then
v39.add "startDir", ""
end if
If v39.Exists("hide_folders") = false Then
v39.add "hide_folders", "goodies,playlister_output,skins,getid3,_private,_private,_vti_bin,_vti_cnf,_vti_pvt,_vti_txt,cgi-bin"
end if
If v39.Exists("hide_files") = false Then
v39.add "hide_files", "skin.xml,wimpyConfigs.xml,wimpyAVConfigs.xml,wimpy.swf,wimpyAV.swf,wasp.swf,wimpy_button.swf"
end if
If v39.Exists("wimpyHTMLpageTitle") = false Then
v39.add "wimpyHTMLpageTitle", "Wimpy Player"
end if
If v39.Exists("getMyid3info") = false Then
v39.add "getMyid3info", ""
end if
If v39.Exists("ecommerce") = false Then
v39.add "ecommerce", ""
end If
If v39.Exists("v50") = false Then
v39.add "v50", 0
end If
If v39.Exists("v48") = false Then
v39.add "v48", 0
end If
wimpySwf = v39("wimpySwf")
wimpyApp = v39("wimpyApp")
tptBkgd = v39("tptBkgd")
bkgdColor = v39("bkgdColor")
startDir = v39("startDir")
hide_folders = v39("hide_folders")
hide_files = v39("hide_files")
wimpyHTMLpageTitle = v39("wimpyHTMLpageTitle")
getMyid3info = v39("getMyid3info")
ecommerce = v39("ecommerce")
wimpySkin = v39("wimpySkin")
defaultVisualExt = v39("defaultVisualExt")
defaultVisualBaseName = v39("defaultVisualBaseName")
if ecommerce = "yes" then
forceDownload = "no"
displayDownloadButton = "yes"
getMyid3info = "yes"
end if
v148 = true
if IsEmpty(Request.QueryString("action")) then
if len(wimpySkin)>4 then
Set v109 = Server.CreateObject("MSXML2.DOMDocument")
v109.setProperty "ServerHTTPRequest", true
v109.async = False
v109.Load (wimpySkin)
If NOT v109.parseError.errorCode <> 0 Then
Set v115 = v109.getElementsByTagName("bkgd_main")
v50 = v115.item(0).getAttribute("width")
v48 = v115.item(0).getAttribute("height")
v148 = true
end if
set v115 = nothing
set v109 = nothing
else
v148 = false
end if
if v50 < 1 or v48 < 1 then
v148 = false
v50 = 480
v48 = 140
end if
end If
if NOT startDir = "" Then
v40("physical") = startDir
end if
v5 = Split(hide_files, ",")
v6 = Split(hide_folders, ",")
v41 = Split("Blues,Classic Rock,Country,Dance,Disco,Funk,Grunge,Hip-Hop,Jazz,Metal,New Age,Oldies,Other,Pop,R&B,Rap,Reggae,Rock,Techno,Industrial,Alternative,Ska,Death Metal,Pranks,Soundtrack,Euro-Techno,Ambient,Trip-Hop,Vocal,Jazz+Funk,Fusion,Trance,Classical,Instrumental,Acid,House,Game,Sound Clip,Gospel,Noise,Altern Rock,Bass,Soul,Punk,Space,Meditative,Instrumental Pop,Instrumental Rock,Ethnic,Gothic,Darkwave,Techno-Industrial,Electronic,Pop-Folk,Eurodance,Dream,Southern Rock,Comedy,Cult,Gangsta,Top 40,Christian Rap,Pop/Funk,Jungle,Native American,Cabaret,New Wave,Psychadelic,Rave,Showtunes,Trailer,Lo-Fi,Tribal,Acid Punk,Acid Jazz,Polka,Retro,Musical,Rock & Roll,Hard Rock,Folk,Folk/Rock,National Folk,Swing,Bebob,Latin,Revival,Celtic,Bluegrass,Avantgarde,Gothic Rock,Progressive Rock,Psychedelic Rock,Symphonic Rock,Slow Rock,Big Band,Chorus,Easy Listening,Acoustic,Humour,Speech,Chanson,Opera,Chamber Music,Sonata,Symphony,Booty Bass,Primus,Porn Groove,Satire,Slow Jam,Club,Tango,Samba,Folklore", ",")
v0 = split(myDataSetup, "|")
function f5(theURL)
v139 = v40("www") & "/"
f5 = v40("physical") & "\" & Replace(Replace(theURL, v139, ""), "/", "\")
end function
function f4(theFilePath)
v139 = v40("physical") & "\"
f4 = Replace(theFilePath, v139, "")
end function
function f6(theURL)
v139 = v40("www") & "/"
f6 = Replace(theURL, v139, "")
end function
function f2(theString_in)
v99 = ""
b = 0
for i=0 to len(theString_in)-1
b = b + 1
v51 = false
v68 = mid(theString_in, b, 1)
v43 = Asc(v68)
if v43 < 46 then
bob = "%" & Hex(v43)
elseif v43 > 58 AND v43 < 65 then
bob = "%" & Hex(v43)
elseif v43 > 90 AND v43 < 97 then
bob = "%" & Hex(v43)
else
bob = v68
end if
v99 = v99 & bob
next
f2 = v99
end function
function f3(theStringIn)
f3 = Server.URLEncode(theStringIn)
end function
function f0(thebytes)
For x = 1 to LenB(thebytes)
If AscB(MidB(thebytes, x, 1)) <> 0 Then
f0 = f0 & Chr(AscB(MidB(thebytes, x, 1)))
End If
Next
End Function
Function sortArray(array_in, order)
dim v20()
ReDim v20(UBound(array_in))
Set v38 = Server.CreateObject ("ADODB.RecordSet")
v38.Fields.Append "S", 200, 255
v38.Open
For i = 0 To UBound(array_in)
v38.AddNew
v38.Fields(0) = array_in(i)
v38.Update
Next
If order = "des" Then
v38.Sort = "S DESC"
End If
If order = "asc" Then
v38.Sort = "S ASC"
End If
For i=1 to v38.RecordCount
v20(i-1) = v38(0)
v38.MoveNext
Next
Set v38 = Nothing
sortArray = v20
end function
function f1(sPath)
redim AmyFiles(0)
redim v82(Ubound(v0))
Set v101 = CreateObject("Scripting.FileSystemObject")
Set v107 = v101.GetFolder(sPath)
Set v106 = Server.CreateObject("ADODB.Stream")
v106.Type = 1
v46 = 0
v24 = ""
Set v37 = CreateObject("Scripting.FileSystemObject")
Set v15 = v107.SubFolders
redim v16(v15.Count)
v128 = 0
For Each v80 in v15
v16(v128) = v80.Name
v128 = v128 + 1
next
For Each v79 in v16
v49 = true
if Len(join(Filter(v6, v79), "")) > 0 then
v49 = false
end if
if InStr(LCase(v79), "skin") > 0 then
v49 = false
end if
if v49 = true then
v82(0) = v74 & "/" & v79'v55("filename")
v82(1) = v79 'v55("artist")
v82(2) = "" 'v55("album")
v82(3) = v79 'v55("title")
v82(4) = "" 'v55("track")
v82(5) = "" 'v55("comments")
v82(6) = "" 'v55("genre")
v82(7) = "" 'v55("seconds")
v82(8) = "" 'v55("filesize")
v82(9) = "" 'v55("bitrate")
v82(10) = "" 'v55("visual")
for k=0 to Ubound(v82)
v82(k) = f3(v82(k))
Next
v24 = v24 & "&item" & v46 & "=" & join(v82, "|")
v46 = v46 + 1
end if
Next
v8 = split(media_types, ",")
v125 = "yes"
If fileSortOrder = "asc" Then
v125 = "no"
End If
If fileSortOrder = "des" Then
v125 = "no"
End if
If v125 = "no" Then
v95 = sortArray(AmyFiles, fileSortOrder)
Else
v95 = AmyFiles
End If
For Each MP3 in v107.Files
if Not LCase(MP3.name) = LCase(join(Filter(v5, MP3.name, true), "")) Then
if LCase(v37.GetExtensionName(MP3)) = LCase(join(Filter(v8, LCase(v37.GetExtensionName(MP3)), true), "")) then
set v55 = CreateObject("Scripting.Dictionary")
v56 = MP3.name
v126 = false
v55.add "filename",  v74 & "/" & v56
if LCase(v37.GetExtensionName(MP3)) = LCase(mediaExtMp3) then
If getMyid3info= "yes"Then
v55.add "filesize", Round((MP3.Size * .000001), 2)
v106.Open
v106.LoadFromFile MP3.Path
v106.Position = v106.Size - 128
If UCase(f0(v106.Read(3))) = "TAG" Then
v55.add "title", f0(v106.Read(30))
v55.add "artist", f0(v106.Read(30))
v55.add "album", f0(v106.Read(30))
v55.add "track", f0(v106.Read(4))
v130 = v106.Read(30)
If AscB(MidB(v130, 29, 1)) = 0 AND AscB(MidB(v130, 30, 1)) > 0 AND AscB(MidB(v130, 30, 1)) < 256 Then
v55.add "comments",  f0(LeftB(v130, 28))
Else
v55.add "comments",  f0(v130)
End If
v55.add "genre", ""
Else
v55.add "artist", ""
v55.add "album", ""
v55.add "title", ""
v55.add "track", ""
v55.add "comments", ""
v55.add "genre", ""
End If
v106.Close
v55.add "bitrate", ""
v55.add "seconds", ""
else
v55.add "filesize", ""
v55.add "artist", ""
v55.add "album", ""
v55.add "title", ""
v55.add "track", ""
v55.add "comments", ""
v55.add "genre", ""
v55.add "bitrate", ""
v55.add "seconds", ""
End If
Else
if InStr(LCase(MP3.name), "skin") > 0 then
v126 = true
end if
if InStr(LCase(MP3.name), "config") > 0 then
v126 = true
end if
if v126 = false then
v55.add "filesize", ""
v55.add "artist", ""
v55.add "album", ""
v55.add "title", ""
v55.add "track", ""
v55.add "comments", ""
v55.add "genre", ""
v55.add "bitrate", ""
v55.add "seconds", ""
end if
set v115 = nothing
set v109 = nothing
End If
if v126 = false then
v4 = left(v56,InStrRev(v56, ".")-1)
v57 = v4 & "." & defaultVisualExt
v151 = v74 & "/" & v57
v152 = f5(v151)
If v37.FileExists(v152) Then
if not startDir = "" then
v151 = v40("www") & "/" & v96 & "?action=getCoverart&theFile=" & v151
end if
v55.add "visual", v151
else
v55.add "visual", ""
End If
for k=0 to Ubound(v0)
v82(k) = f3(v55(v0(k)))
next
redim Preserve AmyFiles(v46)
AmyFiles(v46) = "&item" & v46 & "=" & join(v82, "|")
v46 = v46 + 1
end if
set v55 = nothing
end if
end if
Next
v151 = v74 & "/" & defaultVisualBaseName & "." & defaultVisualExt
v152 = f5(v151)
If v37.FileExists(v152) Then
if not startDir = "" then
v151 = f3(v40("www") & "/" & v96 & "?action=getCoverart&theFile=" & v151)
end if
v150 = "&visualURL=" & v151
else
v150 =  ""
End If
Set v106 = Nothing
Set v107 = Nothing
Set v101 = Nothing
v24 = v24 & join(AmyFiles, "")
f1 = v24 & "&datasetup=" & myDataSetup & v150 & "&totalitems=" & v46
end Function
if IsEmpty(Request.QueryString("getMyid3info")) then
getMyid3info = getMyid3info
else
getMyid3info = Request.QueryString("getMyid3info")
end if
if IsEmpty(Request.QueryString("action")) then
action = ""
else
action = Request.QueryString("action")
end if
if IsEmpty(Request.QueryString("theFile")) then
theFile = ""
else
theFile = Request.QueryString("theFile")
end if
if IsEmpty(Request.QueryString("filename")) then
filename = ""
else
filename = Request.QueryString("filename")
end if
if IsEmpty(Request.QueryString("dir")) then
dir = ""
else
dir = Request.QueryString("dir")
end if
if IsEmpty(Request.QueryString("useMysql")) then
useMysql = ""
else
useMysql = Request.QueryString("useMysql")
end if
if IsEmpty(Request.QueryString("destination")) then
destination = ""
else
destination = Request.QueryString("destination")
end if
if IsEmpty(Request.QueryString("items")) then
items = ""
else
items = Request.QueryString("items")
end if
if IsEmpty(Request.QueryString("queryValue")) then
queryValue = ""
else
queryValue = Request.QueryString("queryValue")
end if
if IsEmpty(Request.QueryString("queryWhere")) then
queryWhere = ""
else
queryWhere = Request.QueryString("queryWhere")
end if
if not isEmpty(Request.QueryString("defaultVisualExt")) then
defaultVisualExt = Request.QueryString("defaultVisualExt")
end If
if not isEmpty(Request.QueryString("defaultVisualBaseName")) then
defaultVisualBaseName = Request.QueryString("defaultVisualBaseName")
end if
Function URLDecode(byVal v54)
v134  = v54 : v136 = _
"" : v67 = Instr(v134, "+")
Do While v67
v135 = "" : v137 = ""
If v67 > 1 then _
v135 = Left(v134, v67 - 1)
If v67 < len(v134) then _
v137 = Mid(v134, v67 + 1)
v134 = v135 & " " & v137
v67 = InStr(v134, "+")
v66 = v66 + 1
Loop
v67 = InStr(v134, "%")
Do while v67
If v67 > 1 then _
v136 = v136 & _
Left(v134, v67 - 1)
v136 = v136 & _
Chr(CInt("&H" & _
mid(v134, v67 + 1, 2)))
If v67 > (len(v134) - 3) then
v134 = ""
Else
v134 = Mid(v134, v67 + 3)
End If
v67 = InStr(v134, "%")
Loop
URLDecode = v136 & v134
End Function
Function formatDate(myDate, offset)
dim v88,v97
myDate = CDate(myDate)
v76 = WeekdayName(Weekday(myDate),true)
v77 = Day(myDate)
v88 = MonthName(Month(myDate), true)
v97 = Year(myDate)
v85 = zeroPad(Hour(myDate), 2)
v87 = zeroPad(Minute(myDate), 2)
v93 = zeroPad(Second(myDate), 2)
formatDate = v76&", "& _
v77&" "& _
v88&" "& _
v97&" "& _
v85&":"& _
v87&":"& _
v93&" "& _
offset
End Function
Function zeroPad(m, t)
zeroPad = String(t-Len(m),"0")&m
End Function
v72 = false
function f7(theString)
v138 = theString
v138 = Replace(v138, Chr(10), "x")
v138 = Replace(v138, Chr(13), "x")
v138 = Replace(v138, Chr(9), "x")
v138 = Replace(v138, "\", "x")
v138 = Replace(v138, "./", "x")
v138 = Replace(v138, "..", "x")
f7 = v138
end function
If action="getVersion" Then
Response.Write wimpyVersion
elseif action="dir" Then
If useCustomCharset="yes" then
Response.codepage = myCodePage
Response.CharSet = myCharSet
End if
v74 = dir
retval = f1(f5(f7(v74)))
Response.Write retval
ElseIf action="getCoverart" Then
v1 = split(theFile, "/")
v53 = v1(Ubound(v1))
v116 = v40("physical") & "\" & Replace(theFile, v40("www") & "/", "")
strAbv116 = v116
Set v101 = Server.CreateObject("Scripting.FileSystemObject")
If v101.FileExists(strAbv116) Then
Set v104 = v101.GetFile(strAbv116)
Response.AddHeader "Pragma", "public"
Response.AddHeader "Expires", "Thu, 19 Nov 1981 08:52:00 GMT"
Response.AddHeader "Cache-Control", "must-revalidate, post-check=0, pre-check=0"
Response.AddHeader "Cache-Control", "no-store, no-cache, must-revalidate"
Response.AddHeader "Cache-Control", "private"
Response.AddHeader "Content-Length", v104.Size
Response.ContentType = "image/jpeg"
Set v108 = Server.CreateObject("ADODB.Stream")
v108.Open
v108.Type = 1
If useCustomCharset="yes" then
Response.codepage = myCodePage
Response.CharSet = myCharSet
End if
v108.LoadFromFile(strAbv116)
Response.BinaryWrite(v108.Read)
v108.Close
Set v108 = Nothing
Set v104 = Nothing
End If
Set v101 = Nothing
ElseIf action="serveMP3" OR action="downloadfile" Then
if not startDir = "" then
v1 = split(theFile, "/")
v53 = v1(Ubound(v1))
v116 = v40("physical") & "\" & Replace(theFile, v40("www") & "/", "")
strAbv116 = v116
else
v116 = f5(f7(theFile))
v1 = split(theFile, "/")
v53 = v1(Ubound(v1))
v116 = Replace(theFile, v40("www") & "/", "")
strAbv116 = Server.MapPath(v116)
end if
Set v101 = Server.CreateObject("Scripting.FileSystemObject")
If v101.FileExists(strAbv116) Then
Set v104 = v101.GetFile(strAbv116)
Response.AddHeader "Pragma", "public"
Response.AddHeader "Expires", "Thu, 19 Nov 1981 08:52:00 GMT"
Response.AddHeader "Cache-Control", "must-revalidate, post-check=0, pre-check=0"
Response.AddHeader "Cache-Control", "no-store, no-cache, must-revalidate"
Response.AddHeader "Cache-Control", "private"
if action="downloadfile" Then
Response.AddHeader "Content-Disposition", ("attachment; filename=""" & v104.Name & """")
end if
Response.AddHeader "Content-Length", v104.Size
Response.ContentType = "audio/x-mpeg, audio/x-mpeg-3, audio/mpeg3"
Set v108 = Server.CreateObject("ADODB.Stream")
v108.Open
v108.Type = 1
If useCustomCharset="yes" then
Response.codepage = myCodePage
Response.CharSet = myCharSet
End if
v108.LoadFromFile(strAbv116)
Response.BinaryWrite(v108.Read)
v108.Close
Set v108 = Nothing
Set v104 = Nothing
End If
Set v101 = Nothing
ElseIf action="getstartupdirlist" Then
If useCustomCharset="yes" then
Response.codepage = myCodePage
Response.CharSet = myCharSet
End if
v74 = v40("www")
retval = f1(v40("physical"))
Response.Write retval
Else
queryString = ""
queryString = queryString & wimpySwf
if useConfigFile = true then
queryString = queryString & "?wimpyConfigs=" & v40("www") & "/" & wimpyConfigFile
else
queryString = queryString & "?wimpyApp=" & wimpyApp
end if
v120 = VBNewLine
if bkgdColor = "" then
bkgdColor = "000000"
end if
if tptBkgd = "yes" then
v149 = true
else
v149 = false
end if
if v149 then
v146 = "wmode=""transparent"
v147 = "<param name=""wmode"" value=""transparent"" />" & v120
else
v146 = ""
v147 = ""
end if
v60 = "<HTML>" & v120
v60 = v60 & "<HEAD>" & v120
v60 = v60 & "<TITLE>" & wimpyHTMLpageTitle & "</TITLE>" & v120
v60 = v60 & "</HEAD>" & v120
v60 = v60 & "<BODY bgcolor=""#" & bkgdColor & """ leftmargin=""0"" topmargin=""0"" marginwidth=""0"" marginheight=""0"">" & v120
v60 = v60 & "<table width=""100%"" height=""100%""  border=""0"" cellpadding=""0"" cellspacing=""0"">" & v120
v60 = v60 & "  <tr>" & v120
v60 = v60 & "<td align=""center"" valign=""middle"">" & v120
v60 = v60 & "<object classid=""clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"" codebase=""http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,47,0"" width=""" & v50 & """ height=""" & v48 & """ id=""wimpy"">" & v120
v60 = v60 & "<param name=""movie"" value=""" & queryString & """ />" & v120
v60 = v60 & "<param name=""loop"" value=""false"" />" & v120
v60 = v60 & "<param name=""menu"" value=""false"" />" & v120
v60 = v60 & "<param name=""quality"" value=""high"" />" & v120
v60 = v60 & "<param name=""scale"" value=""noscale"" />" & v120
v60 = v60 & "<param name=""salign"" value=""lt"" />" & v120
v60 = v60 & "<param name=""bgcolor"" value=""#" & bkgdColor & """ />" & v120
v60 = v60 & v147
v60 = v60 & "<embed src=""" & queryString & """ width=""" & v50 & """ height=""" & v48 & """ bgcolor=""#" & bkgdColor & """ loop=""false"" menu=""false"" quality=""high"" scale=""noscale"" salign=""lt"" id=""wimpy"" align=""middle"" allowScriptAccess=""sameDomain"" type=""application/x-shockwave-flash"" pluginspage=""http://www.macromedia.com/go/getflashplayer"" " & v146 & "/></object>" & v120
v60 = v60 & "</td>" & v120
v60 = v60 & "</tr>" & v120
v60 = v60 & "</table>" & v120
v60 = v60 & "</BODY>" & v120
v60 = v60 & "</HTML>" & v120
Response.Write v60
End If
set v58 = nothing
set v40 = nothing
set v39 = Nothing
Response.Flush
%>