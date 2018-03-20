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
$(document).ready(function () {
    $(".goback").click(function () {
        location.replace("main");
    });
});
