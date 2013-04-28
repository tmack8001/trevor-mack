/** Common useful functions */

function alertSize() {
  var myWidth = 0, myHeight = 0;
  if( typeof( window.innerWidth ) == 'number' ) {
    //Non-IE
    myWidth = window.innerWidth;
    myHeight = window.innerHeight;
  } else if( document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
    //IE 6+ in 'standards compliant mode'
    myWidth = document.documentElement.clientWidth;
    myHeight = document.documentElement.clientHeight;
  } else if( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
    //IE 4 compatible
    myWidth = document.body.clientWidth;
    myHeight = document.body.clientHeight;
  }
  window.alert( 'Width = ' + myWidth );
  window.alert( 'Height = ' + myHeight );
}

/* convert the url query string into an array  
     This function can take both # and ? as separators of file url and parameters*/
function read_querystring() {
   var a_out = new Object();
   var separator;
   if (location.href.indexOf("?") > 0) {
     separator = "?";
   } else if (location.href.indexOf("#") > 0) {
     separator = "#";
   } else {
     return a_out;
   }
   var s_loc = String(location.href);
   if(s_loc.indexOf(separator)>0) {
      var p;
      var s_query = s_loc.substr(s_loc.indexOf(separator)+1);
      var a_query = s_query ? s_query.split('&') : new Array();
      for(var i=0; i<a_query.length; i++) {
         p = a_query[i].split('=');
         a_out[p[0]] = p[1].replace(/\+/g, ' ');
      }
   } 
   return a_out;
}

/* This function makes sure that even if the ? is passed as parameter it is converted to #   */
function read_querystring_Ajax() {
   var separator = "#";
   if (location.href.indexOf("?") > 0) {
     window.location.href = location.href.replace("?", "#");
   } 
   return read_querystring();
}


// --------------- Ajax xml common ------------------------

/* 
 * Cross-browser function for getting the XMLHttpRequest object or equivalent
  * When using google maps application this is equivalent to GXml.parse
*/
function getXMLHttpRequest() {
  var req;
  if(window.XMLHttpRequest) {
    try {
      req = new XMLHttpRequest();
    } catch(e) {
    }
  } else if(window.ActiveXObject) {
    try {
      req = new ActiveXObject("Msxml2.XMLHTTP");
    } catch(e) {
      try {
        req = new ActiveXObject("Microsoft.XMLHTTP");
      } catch(e) {
      }
    }
  }  
  return req;
}

/**
 * Cross-browser function for parsing an xml string to an xml document
 * @param xmlString the xml that can be from a file or a request
 * @return the xml document object
 * When using google maps applicationthis is equivalent to GXml.parse
 */
function getXMLDocumentFromString(xmlString) {
  var xmlDoc;
  if (window.ActiveXObject) {
    xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
    xmlDoc.async="false";
    xmlDoc.loadXML(xmlString);
  } else {// code for Mozilla, Firefox, Opera, etc.
    var parser=new DOMParser();
    xmlDoc = (new DOMParser()).parseFromString(xmlString, "text/xml");
  }
  return xmlDoc;
}

