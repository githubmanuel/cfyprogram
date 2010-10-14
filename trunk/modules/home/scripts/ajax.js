//
//
// CFY program - CFY Business Management Suite
//
// Integrated enterprise applications to execute and optimize business and IT strategies.
// Enable you to perform essential, industry-specific, and business-support processes with modular solutions.
//
// Version: 0.0.0.1a
// Author: Ernesto La Fontaine
// Mail: mail@pajarraco.com
// License: New BSD License (see docs/license.txt)
// Redistributions of files must retain the copyright notice.
//
// File:
// Commnents:
//
// some modification on the original files
//
// -- Original --
/*
* Generic function to make Ajax requests, inspired by 
* Stoyan Stefanov (http://www.sitepoint.com/article/take-command-ajax)
* 
* @param url 							the url to request
* @param callback_function				the function to invoke with the javascript results
* @param return_xml						true or false. If true then we expect xml back, otherwise plain text
*/
function makeHttpRequest(url, callback_function, return_xml)
{
    var http_request = false;

    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request = new XMLHttpRequest();
        if (http_request.overrideMimeType) {
            http_request.overrideMimeType('text/xml');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }

    if (!http_request) {
        alert('Your browser doesn\'t support this feature.');
        return false;
    }
    http_request.onreadystatechange = function() {
        /* The request can go through a number of states but we only care about 4
   		 	0 (uninitialized)
			1 (loading)
			2 (loaded)
			3 (interactive)
			4 (complete)
   		*/
        if (http_request.readyState == 4) {
            if (http_request.status == 200) { //200 is sucess. The page brought results back
                if (return_xml) {
                    eval(callback_function + '(http_request.responseXML)');
                } else {
                    eval(callback_function + '(http_request.responseText)');
                }
            } else if (http_request.status != 0){ //some versions of IE can return 0
                //Stephan added this line above, BUT all it does is possibly prevent the alert.
                //it doesn't call eval as if the status was 200, so perhaps this needs more research
                alert('There was a problem with the request.(Code: ' + http_request.status + ')');
            }
        }
    }
    http_request.open('GET', url, true); //true means asynchronous request (i.e. person can continue using browser). False freezes browser until request is finished
    http_request.send(null); //if we were sending a "POST" instead of a "GET" we could pass in the post variables in the form of a query string (i.e. searchResults.php?sinput=cars), instead of null
}