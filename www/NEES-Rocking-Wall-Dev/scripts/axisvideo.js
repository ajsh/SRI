function showAxisVideo(cameraHostName, showAudio)
{
	var cameraURL = "http://" + cameraHostName;

	if ((navigator.appName == "Microsoft Internet Explorer")&&(navigator.platform != "MacPPC")&&(navigator.platform != "Mac68k")) {
		document.write("<span class=\"axisvideo\">");
		document.write("<OBJECT ID=\"AxisCamControl\" CLASSID=\"CLSID:917623D1-D8E5-11D2-BE8B-00104B06BDE3\" WIDTH=\"352\" HEIGHT=\"240\" CODEBASE=\"http://video3.nees.buffalo.edu/activex/AxisCamControl.cab#Version=1,0,2,15\">");
		document.write("<PARAM NAME=URL VALUE=\"" + cameraURL + "/axis-cgi/mjpg/video.cgi?camera=1&resolution=352x240\">");
		document.write("<PARAM NAME=\"image_pan_tilt\" VALUE=\"" + cameraURL + "/axis-cgi/com/ptz.cgi?camera=1&imagewidth=352&imageheight=240&camera=1&compression=25&center=?\">");
		if (showAudio) {
			document.write("<PARAM NAME=DisplaySoundPanel VALUE=1>");
			document.write("<PARAM NAME=SoundUrl VALUE=\"" + cameraURL + "/axis-cgi/audio/receive.cgi\">");
			document.write("<PARAM NAME=RecordSoundURL VALUE=\"" + cameraURL + "/axis-cgi/audio/transmit.cgi\">");
			document.write("<PARAM NAME=AudioParameterURL VALUE=\"" + cameraURL + "/axis-cgi/audio/getparam.cgi\">");	
		} else {
			document.write("<PARAM NAME=DisplaySoundPanel VALUE=0>");
		}    
		document.write("</OBJECT>");
		document.write("</span>");
	} else {
		theDate = new Date();
		var output = "<A HREF=\"" + cameraURL + "/axis-cgi/com/ptz.cgi?camera=1&imagewidth=352&imageheight=240&center=\" TARGET=\"Trash\">";
		output += "<img class=\"axisvideo\" SRC=\"" + cameraURL + "/axis-cgi/mjpg/video.cgi?camera=1&resolution=352x240&";
		output += theDate.getTime()
		output += "\" ALT=\"Press Reload if no image is displayed\" BORDER=\"0\" ISMAP></A>";
		document.write(output);
	}
}

function showFlexTPSVideo(flexTPSHostName, feedName, streamName, fps)
{
	var cameraURL = "http://" + flexTPSHostName + "/feeds/" + feedName + "/" + streamName + "/mjpeg/" + fps + "?status_frame=true";
	
	var agent=navigator.userAgent.toLowerCase();
	var version = navigator.appVersion.toLowerCase();
	
	var is_opera = (agent.indexOf("opera") != -1);
	var is_safari = ((agent.indexOf('safari') != -1) && (agent.indexOf('mac') != -1))?true:false;
	var is_gecko = (navigator.product && (navigator.product.toLowerCase()=="gecko"))?true:false;
	var is_ie = (version.indexOf('msie') != -1)?true:false;
	
	var hasMJPEG = is_gecko || is_safari || is_opera;
	
	if (hasMJPEG) {
		document.write('<img class="axisvideo" src="' + cameraURL + '" alt="Press Reload if no image is displayed" border="0">');
	} else {
		document.write('<span class="axisvideo">');
		if (is_ie) {
			document.write('<object classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" codebase="http://java.sun.com/update/1.5.0/jinstall-1_5-windows-i586.cab#Version=1,4,0,0" width="352" height="240">');
			document.write('<param name="archive" value="http://' + flexTPSHostName + '/java/flexTPSVideoApplet.jar">');
			document.write('<param name="code" value="org.nees.buffalo.flexTPS.VideoApplet.class">');
			document.write('<param name="videoLocation" value="' + cameraURL + '">');
			document.write('</object>');
		} else {
			document.write('<applet archive="http://' + flexTPSHostName + '/java/flexTPSVideoApplet.jar" code="org.nees.buffalo.flexTPS.VideoApplet.class" WIDTH="352" HEIGHT="240">');
			document.write('<param name="videoLocation" value="' + cameraURL + '">');
			document.write('</applet>');		
		}
		document.write('</span>');
	}	
}

function showAxisAudio(cameraHostName)
{
	var cameraURL = "http://" + cameraHostName;

	if ((navigator.appName == "Microsoft Internet Explorer")&&(navigator.platform != "MacPPC")&&(navigator.platform != "Mac68k")) {
		document.write("<OBJECT ID=\"AxisCamControl-" + cameraHostName + "\" CLASSID=\"CLSID:917623D1-D8E5-11D2-BE8B-00104B06BDE3\" WIDTH=\"352\" HEIGHT=\"240\" CODEBASE=\"http://video3.nees.buffalo.edu/activex/AxisCamControl.cab#Version=1,0,2,15\">");
		document.write("<PARAM NAME=DisplaySoundPanel VALUE=1>");
		document.write("<PARAM NAME=SoundUrl VALUE=\"" + cameraURL + "/axis-cgi/audio/receive.cgi\">");
		document.write("<PARAM NAME=RecordSoundURL VALUE=\"" + cameraURL + "/axis-cgi/audio/transmit.cgi\">");
		document.write("<PARAM NAME=AudioParameterURL VALUE=\"" + cameraURL + "/axis-cgi/audio/getparam.cgi\">");	
		document.write("</OBJECT>");
	}	
}