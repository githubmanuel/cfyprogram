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

var chatAcction = "online";
var dotCounter = 0;
var myUser = "";
var xcbutton = true;

$(window).load(function(){
    fixSize();
    $("user").css("display", "none");
    myUser = $("user b").text();
    if (myUser){
        $("user").show();
        loadChat();
        getUser();
    }


/*(function myTimer() {
        setTimeout(function() {
            if (dotCounter++ < 600) {
                setOnline();
                myTimer();
            }
        }, 1000);
    })();
    */
});

$(document).scroll(function(){
    $("chat").css("bottom", "-"+$(this).scrollTop()+"px");
    $("chat_section").css("bottom", "-"+$(this).scrollTop()+"px");
});

$(window).resize(function(){
    fixSize();
});

function fixSize(){
    var winSize = $(window).height();
    if (winSize >= 600){
        $(".sidebar").height(winSize-103);
        $("nav ul a").height((winSize-200) / $("nav ul a").length);
    }
}

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

// chat functions

function loadChat(){

    $("<chat>").appendTo("body");
    $("<chat_tittle>").html(myUser).appendTo("chat");
    $("<chat_text>").css("display", "none").appendTo("chat");
    $("chat_tittle").click(function(){
        if (xcbutton){
            $("chat_text").show();
            xcbutton = false;
        }else{
            $("chat_text").hide();
            xcbutton = true;
        }
    });
}

function setOnline(){
    acction = "online";
    $.ajax({
        url: "core/bin/chat_xml.php?acction="+acction+"&username=admin"
    });
}

function getUser(){
    acction = "getuser";
    $.ajax({
        url: "core/bin/chat_xml.php?acction="+acction,
        dataType: "xml",
        success: function(xml){
            $("chat_text").empty();
            var totalRow = $(xml).find("total").text();
            if (totalRow > 0){
                $(xml).find("result").each(function(){
                    var user = $(this).find("username").text();
                    if (user != myUser){
                        $("<div>").attr("id", "item-"+user).addClass("itemlist").html(user).appendTo("chat_text");
                        $("#item-"+user).bind("click", function(){
                            openSection(user);
                        });
                    }
                });
            }
        }
    });
}
function openSection(user){

    $("<chat_section>").attr("id","section"+user).appendTo("body");
    $("<chat_section_tittle>").attr("id", "section_tittle"+user).html(user +":").appendTo("chat_section");
    $("<chat_section_text>").attr("id", "section_text"+user).html("hola").appendTo("chat_section");
    $("#section_tittle"+user).bind("click", function(){
        closeSection(user);
    });
    $("#item-"+user).unbind("click");
    seccionChat(user);

}

function closeSection(user){
    $("#section"+user).hide(function(){
        $(this).remove();
    });
    $("#item-"+user).bind("click", function(){
        openSection(user);
    });
}

function seccionChat(user){

    acction = "getsection";
    $.ajax({
        url: "core/bin/chat_xml.php?acction="+acction+"&username="+myUser+"&recive="+user,
        dataType: "xml",
        success: function(xml){
            $("#section_text"+user).empty();
            var totalRow = $(xml).find("total").text();
            if (totalRow > 0){
                $(xml).find("result").each(function(){
                    var id = $(this).find("id").text();
                    var from = $(this).find("from").text();
                    var to = $(this).find("to").text();
                    var message = $(this).find("message").text();
                    var sent = $(this).find("sent").text();
                    var recd = $(this).find("recd").text();
                    $("<div>").attr("id", "msg_chat"+id).html(from + ": " + message).appendTo("#section_text"+user);
                    if (from == myUser){
                        $("#msg_chat"+id).addClass("msg_chat_my");
                    }else{
                        $("#msg_chat"+id).addClass("msg_chat");
                    }

                });
            }
        }
    });


}