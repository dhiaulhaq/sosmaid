$( document ).ready(function() {
    $("#btnlike").click(function(e){
        e.preventDefault();
        var pid = $("#post_id").val();
        var uid = $("#user_id").val();
        var base_url = window.location.origin;

        $.ajax({
            type: 'POST',
            url: base_url + '/pages/updatelike.php',
            dataType: 'json',
            data: {post_id:pid, uid:uid},
            beforeSend: function(){
                $(".loader").css("visibility", "visible");
            },
            success: function(response){
                $("#btnlike").empty();
                $("#btnlike").append(response.hearticon);
                $(".totallike").empty();
                $(".totallike").append(response.total);
            },
            error: function(response){
                console.log(response);
            },
            complete: function(data){
                $(".loader").css("visibility", "hidden");
            }
        });
    });

    /* COMMENT */
    $("#sendcomment").click(function(e){
        e.preventDefault();
        var pid = $("#post_id").val();
        var uid = $("#user_id").val();
        var comment = $("#yourcomment").val();
        var base_url = window.location.origin;

        $.ajax({
            type: 'POST',
            url: base_url + '/pages/updatecomment.php',
            dataType: 'json',
            data: {post_id:pid, uid:uid, comment:comment},
            beforeSend: function(){
                $(".loader").css("visibility", "visible");
            },
            success: function(response){
                console.log("Success");
            },
            error: function(response){
                console.log(response);
            },
            complete: function(data){
                $(".loader").css("visibility", "hidden");
            }
        });
    });
});