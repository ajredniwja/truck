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
$('#showright').hide();
$(document).ready(function(){
    $("#complete").click(function(){
        $("#truck").animate({height : '300px',width : '300px',opacity : '0.4'});
        $("#truck").animate({height : '256px',width : '256px'});
        $("#showright").animate({height : 'toggle'}, "slow");
        $("#complete").hide();
    });
});
function validateForm() {
    var fname = document.forms["formid"]["fname"].value;
    var email = document.forms["formid"]["email"].value;
    var lname = document.forms["formid"]["lname"].value;
    var state = document.forms["formid"]["state"].value;
    var phone = document.forms["formid"]["phone"].value;


    if (fname == "")
    {
        alert("First Name cannot be empty");
        return false;
    }
    if (lname == "")
    {
        alert("Last name cannot be empty");
        return false;
    }
    if (state == "")
    {
        alert("Please Select a State");
        return false;
    }
    if (phone.length != 10)
    {
        alert("Please enter a valid phone number");
        return false;
    }
    if (email == "")
    {
        alert("Email cannot be empty");
        return false;
    }
}
