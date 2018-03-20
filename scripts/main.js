$("#container").hide();
$("#viewpost").hide();
$(document).ready(function () {
    $("#logout").click(function () {
        var logout = confirm("Are you sure you want to log out?");
        if (logout == true)
        {
            return true;
        }
        else
        {
            return false;
        }
    });
});
$(document).ready(function(){
    $("#left").mouseover(function(){
        $("#left").css("background-color", "rgba(116,88,135,0.64)");
        $("#left").css("opacity", "1");
    });
    $("#left").mouseout(function(){
        $("#left").css("background-color", "rgba(56,82,255,0.34)");
    });
    $("#right").mouseover(function(){
        $("#right").css("background-color", "rgba(40,260,160,0.60)");
    });
    $("#right").mouseout(function(){
        $("#right").css("background-color", "rgba(36,238,137,0.55)");
    });
});
$(document).ready(function(){
    $("#left").click(function(){
        $("#left").hide();
        $("#right").hide();
        // $("body").css("background-color", "lightgrey");
        $("body").css("background", "url(images/bg.jpg");
        // $("body").css("background-color", "black");
        $("body").css("opacity", "0.93");
        $("body").css("height", "100vh");
        $("body").css("background-position", "center");
        $("body").css("background-repeat", "no-repeat");
        $("body").css("background-size", "cover");
        $("body").css("background-attachment", "fixed");
        $("#container").show();
    });
});
function validateForm() {
    var fname = document.forms["formid"]["fname"].value;
    var lname = document.forms["formid"]["lname"].value;
    var state = document.forms["formid"]["state"].value;
    var scaleinfo = document.forms["formid"]["scaleinfo"].value;
    var info = document.forms["formid"]["info"].value;

    if (fname == "")
    {
        $("#fnamee").html("Please enter a first name");
        return false;
    }
    if (lname == "")
    {
        $("#lnamee").html("Please enter last name");
        return false;
    }
    if (state == "")
    {
        $("#statee").html("Please select a state");
        return false;
    }
    if ((scaleinfo != "open" ) && (scaleinfo != "notopen"))
    {
        $("#scaleinfoe").html("Please Indicate scale info");
        return false;
    }
    if (info.length < 20)
    {
        $("#infoe").html("ENTER VALID INFO");
        // alert("Please enter valid information. i.e Atleast 20 characters");
        return false;
    }
    else
    {
        alert("Thankyou for your post");
    }
}
$(document).ready(function(){
    $("#right").click(function(){
        $("#left").hide();
        $("#right").hide();
        // $("body").css("background-color", "lightgrey");
        $("body").css("background", "url(images/bg.jpg");
        // $("body").css("background-color", "black");
        $("body").css("opacity", "0.9");
        $("body").css("height", "100vh");
        $("body").css("background-position", "center");
        $("body").css("background-repeat", "no-repeat");
        $("body").css("background-size", "cover");
        $("body").css("background-attachment", "fixed");
        $("#viewpost").show();
    });
});