// ----------------------------------------------------------------------
// Javascript form validation routines.
// Author: Stephen Poley
//
// Simple routines to quickly pick up obvious typos.
// All validation routines return true if executed by an older browser:
// in this case validation must be left to the server.
//
// Update Jun 2005: discovered that reason IE wasn't setting focus was
// due to an IE timing bug. Added 0.1 sec delay to fix.
//
// Update Oct 2005: minor tidy-up: unused parameter removed
//
// Update Jun 2006: minor improvements to variable names and layout
// ----------------------------------------------------------------------

var nbsp = 160;		// non-breaking space char
var node_text = 3;	// DOM text node-type
var emptyString = /^\s*$/ ;
var global_valfield;	// retain valfield for timer thread

// --------------------------------------------
//                  trim
// Trim leading/trailing whitespace off string
// --------------------------------------------

function trim(str)
{
  return str.replace(/^\s+|\s+$/g, '');
}


// --------------------------------------------
//                  setfocus
// Delayed focus setting to get around IE bug
// --------------------------------------------

function setFocusDelayed()
{
  global_valfield.focus();
}

function setfocus(valfield)
{
  // save valfield in global variable so value retained when routine exits
  global_valfield = valfield;
  setTimeout( 'setFocusDelayed()', 100 );
}


// --------------------------------------------
//                  msg
// Display warn/error message in HTML element.
// commonCheck routine must have previously been called
// --------------------------------------------

function msg(fld,     // id of element to display message in
             msgtype, // class to give element ("warn" or "error")
             message) // string to display
{
  // setting an empty string can give problems if later set to a 
  // non-empty string, so ensure a space present. (For Mozilla and Opera one could 
  // simply use a space, but IE demands something more, like a non-breaking space.)
  var dispmessage;
  if (emptyString.test(message)) 
    dispmessage = String.fromCharCode(nbsp);    
  else  
    dispmessage = message;

  var elem = document.getElementById(fld);
  elem.firstChild.nodeValue = dispmessage;  
  
  elem.className = msgtype;   // set the CSS class to adjust appearance of message
}

// --------------------------------------------
//            commonCheck
// Common code for all validation routines to:
// (a) check for older / less-equipped browsers
// (b) check if empty fields are required
// Returns true (validation passed), 
//         false (validation failed) or 
//         proceed (don't know yet)
// --------------------------------------------

var proceed = 2;  

function commonCheck    (valfield,   // element to be validated
                         infofield,  // id of element to receive info/error msg
                         required)   // true if required
{
  if (!document.getElementById) 
    return true;  // not available on this browser - leave validation to the server
  var elem = document.getElementById(infofield);
  if (!elem.firstChild) return true;  // not available on this browser 
  if (elem.firstChild.nodeType != node_text) return true;  // infofield is wrong type of node  

  if (emptyString.test(valfield.value)) {
    if (required) {
      msg (infofield, "error", "ERROR: required");  
      setfocus(valfield);
      return false;
    }
    else {
      msg (infofield, "warn", "");   // OK
      return true;  
    }
  }
  return proceed;
}

// --------------------------------------------
//            validateName
// Validate if something has been entered
// Returns "" if so 
// --------------------------------------------

function validateName(fld)   // element to be validated
{
  var error = "";
 
  if (fld.value == "") {
      fld.style.background = 'Yellow'; 
      error = "You didn't enter a name.\n";
  /*} else if (illegalChars.test(fld.value)) {
      fld.style.background = 'Yellow'; 
      error = "The username contains illegal characters.\n";*/
  } else {
      fld.style.background = 'White';
  }
  return error;
}

//            validateEmail
// Validate if email that has been entered is correct email format
// Returns "" if so 
// --------------------------------------------

function trim(s)
{
  return s.replace(/^\s+|\s+$/, '');
}

function validateEmail(fld) {
    var error="";
    var tfld = trim(fld.value);                // value of field with whitespace trimmed off
    var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
    var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
   
    if (fld.value == "") {
		fld.style.background = 'White';
    } else if (!emailFilter.test(tfld)) {      //test email for illegal characters
        fld.style.background = 'Yellow';
        error = "Please enter a valid email address.\n";
    } else if (fld.value.match(illegalChars)) {
        fld.style.background = 'Yellow';
        error = "The email address contains illegal characters.\n";
    } else {
        fld.style.background = 'White';
    }
    return error;
}

// --------------------------------------------
//            validateMessage
// Validate if something has been entered
// Returns "" if so 
// --------------------------------------------

function validateMessage(fld)   // element to be validated
{
  var error = "";
 
  if (fld.value == "") {
      fld.style.background = 'Yellow'; 
      error = "You didn't enter a message.\n";
  } else {
      fld.style.background = 'White';
  }
  return error;
}

// --------------------------------------------
//            validateCode
// Validate if the code was entered correctly
// Returns "" if so 
// --------------------------------------------

function validateCode(fld)   // element to be validated
{
  var error = "";
 
  if (fld.value == "") {
	  fld.style.background = 'Yellow';
	  error = "You didn't enter the code.\n";
  } else if (fld.value != "b2md7") {
      fld.style.background = 'Yellow'; 
      error = "You didn't enter the correct code.\n";
  } else {
      fld.style.background = 'White';
  }
  return error;
}