//
//
// CFY program = CFY Business Management Suite
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

function showmsg(msg){
    $("<msg_bg>").animate({
        opacity:0.50
    }, 0).appendTo("body").show();
    $("<msg_dialog>").appendTo("body").html(msg).show();
}
function hidemsg(){
    $("msg_bg").animate({
        opacity:0
    }, 1000, function(){
        $(this).remove();
    })
    $("msg_dialog").animate({
        opacity:0
    }, 500, function(){
        $(this).remove();
    })

}