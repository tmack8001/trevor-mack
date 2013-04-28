function showImage(imgnm) {
 ipath = imgnm;
 document.write("<table border='0' cellspacing='0' cellpadding='0'>");
 document.write("<tr>");
 document.write("<td>");
 document.write("<img src='"+ipath+"' class='shadowedimg'>");
 document.write("</td>");
 document.write("<td class='imgSideShadow'><img src='images/shadows/imageTop.gif' width='6' height='7'></td>");
 document.write("</tr>");
 document.write("<tr>");
 document.write("<td class='imgBottomShadow'><img src='images/shadows/imageLeft.gif' width='6' height='7'></td>");
 document.write("<td class='imgCornerShadow'></td>");
 document.write("</tr>");
 document.write("</table>");
}

function goImgWin(myImage,myWidth,myHeight,origLeft,origTop,capt) {
 var mh = myHeight + 44;
 var mw = myWidth + 24;
 TheImgWin = window.open('','image','height=' + mh + ',width=' + mw + ',toolbar=no,directories=no, status=no,' + 'menubar=no,scrollbars=no,resizable=no');
 TheImgWin.resizeTo(mw+2,mh+30);
 TheImgWin.document.write('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml 1-transitional.dtd"><html xmlns="http:\/\/www.w3.org \/1999\/xhtml">');
 TheImgWin.document.write('<head><title>Popup<\/title><\/head>');
 TheImgWin.document.write('<body style="overflow:hidden" bgcolor="#ffffff" onclick="self.close()">');
 TheImgWin.document.write('<img src="'+myImage+'" width="'+myWidth+'" height="'+myHeight+'" ');
 TheImgWin.document.write('border="0" alt="'+capt+'"\/><p align="center">'+capt+'<\/p>');
 TheImgWin.document.write('<\/p><\/body><\/html>');
 TheImgWin.moveTo(origLeft,origTop);
 TheImgWin.focus();
}