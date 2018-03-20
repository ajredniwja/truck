$(".thisdiv").hide();
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
$(".delete").click(function(){
    var Delete = this.id;
    // $("#"+Delete).html
    console.log(Delete);
    var postdelete = confirm("Are you sure you want to delete this post?");
    //Make Ajax call
    if (postdelete == true)
    {
        $.post("http://asingh.greenriverdev.com/truck/model/delete.php",{element:Delete}, function(result){
            alert(result);
        });
        location.reload();
    }
    else
    {
        return false;
    }
});

$(".update").click(function(){
    var updatediv = this.id;
    // alert(updatediv);
    $("#div"+updatediv).show();
    $("#c"+updatediv).hide();
});
$(".submit").click(function(){
    var bid = this.id;

    var change = $("#"+bid).val();
    //alert(change);

    var update = confirm("Are you sure you want to make these changes?");

    if (update == true)
    {
        $.post("http://asingh.greenriverdev.com/truck/model/update.php",{update:bid,changed:change}, function(result){
            alert(result);
        });
        location.reload();
    }
    else
    {
        location.reload();
        return false;
    }

    // console.log("a");
});

$(".cancel").click(function(){
    location.reload();

});
$(document).ready(function () {
    $(".goback").click(function () {
        location.replace("/truck");
    });
});