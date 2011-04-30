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

var chataction = "online";
var dotCounter = 0;
var myUser = "";
var xcbutton = true;
var lastId = new Array();
var sNumber = 0;
var aUsers = new Array();

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
        $(".sidebar").height(winSize-72);
        if ($("nav ul a").length > 3){
            $("nav ul a").height((winSize-180) / $("nav ul a").length);
        }
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
    $("<chat_tittle>").html(" Mensajeria ").appendTo("chat");
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
    (function myTimer() {
        setTimeout(function() {
            if (dotCounter++ < 600) {
                updateSection();
                myTimer();
            }
        }, 1000);
    })();
}

function setOnline(){
    action = "online";
    $.ajax({
        url: "core/bin/chat_xml.php?action="+action+"&username=admin"
    });
}

function getUser(){
    action = "getuser";
    $.ajax({
        url: "core/bin/chat_xml.php?action="+action,
        dataType: "xml",
        success: function(xml){
            $("chat_text").empty();
            var totalRow = $(xml).find("total").text();
            if (totalRow > 0){
                $(xml).find("result").each(function(){
                    var user = $(this).find("username").text();
                    if (user != myUser){
                        $("<div>").attr("id", "item-"+user).addClass("itemlist").html(user).appendTo("chat_text");
                        $("#item-"+user).click(function(){
                            openSection(user);
                        });
                    }                               
                });
            }
        }
    });
}

function openSection(user){
    sNumber++;
    lastId[user] = 0;
    $("<chat_section>").attr("id","section"+user).css("right", 160 * sNumber).appendTo("body");
    $("<chat_section_tittle>").attr("id", "section_tittle"+user).html(user +":").appendTo("#section"+user);
    $("<chat_section_text>").attr("id", "section_text"+user).appendTo("#section"+user);
    $("<ftext>").appendTo("#section_text"+user);
    $("#section_tittle"+user).click(function(){
        closeSection(user);
    });
    $("#item-"+user).unbind("click");
    sectionChat(user);
    inputChat(user);
}

function closeSection(user){
    sNumber--;
    lastId[user] = 0;
    var rr =  $("#section"+user).css("right").replace("px","")
    $("#section"+user).hide(function(){
        $("chat_section").each(function(){
            if ($(this).css("right") > rr){
                $(this).animate({
                    left: '+=160'
                }, 500);
            }
        });
        $(this).remove();
    });
    $("#item-"+user).click(function(){
        openSection(user);
    });
}

function sectionChat(user){
    action = "getsection";
    $.ajax({
        url: "core/bin/chat_xml.php?action="+action+"&username="+myUser+"&recive="+user+"&lastId="+lastId[user],
        dataType: "xml",
        success: function(xml){
            var totalRow = $(xml).find("total").text();
            if (totalRow > 0){
                $(xml).find("result").each(function(){
                    var id = $(this).find("id").text();
                    var from = $(this).find("from").text();
                    var to = $(this).find("to").text();
                    var message = $(this).find("message").text();
                    var sent = $(this).find("sent").text();
                    var recd = $(this).find("recd").text();
                    if (id > lastId[user]){
                        lastId[user] = id;
                        $("<div>").attr("id", "msg_chat"+id).html("<b>"+ from + "</b>: " + message).appendTo("#section_text"+user+" ftext");
                        if (from == myUser){
                            $("#msg_chat"+id).addClass("msg_chat_my");
                            $("<view>").html("*").attr("id", "view"+id).css("display", "none").insertBefore("#msg_chat"+id+" b");
                        }else{
                            $("#msg_chat"+id).addClass("msg_chat");
                        }
                    }
                    if (recd == 1){
                        $("#view"+id).show();
                    }
                });
            }
        }
    });
}

function inputChat(user){
    $("<input>").attr("id", "input"+user).attr("type","text").addClass("input_chat").appendTo("#section"+user);
    $("<input>").attr("id", "button"+user).attr("type","button").attr("value","Ok").addClass("button_chat").appendTo("#section"+user);
    $("#input"+user).keypress(function(key){
        if(key.keyCode == 13){
            sendMessage(user, $("#input"+user).val());
            $("#input"+user).val("");
        }
    });
    $("#button"+user).click(function(){
        sendMessage(user, $("#input"+user).val());
        $("#input"+user).val("");
    });
}

function sendMessage(user, msg){
    if (msg){
        action = "sendmessage";
        $.ajax({
            url: "core/bin/chat_xml.php?action="+action+"&username="+myUser+"&recive="+user+"&msg="+msg,
            success: function(){
                dotCounter = 0;
            }
        });
    }
}

function updateSection(){
    $("chat_section").each(function(){
        var user = $(this).attr("id").replace("section", "");
        sectionChat(user);
    });
    action = "updateusers";
    $.ajax({
        url: "core/bin/chat_xml.php?action="+action+"&username="+myUser,
        dataType: "xml",
        success: function(xml){
            var totalRow = $(xml).find("total").text();
            if (totalRow > 0){
                $(xml).find("result").each(function(){
                    var from = $(this).find("from").text();
                    var recd = $(this).find("recd").text();
                    if (recd == 0){
                        $("#item-"+from).css("font-weight", "bold");
                    }else{
                        $("#item-"+from).css("font-weight", "normal");
                    }
                });
            }
        }
    });
}


