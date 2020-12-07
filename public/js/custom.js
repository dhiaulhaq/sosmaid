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
                $(".totalcomment").empty();
                $(".totalcomment").append(response.total);
                $(".commentList").empty();
                $(".commentList").append(response.allcomment);
            },
            error: function(response){
                console.log(response);
            },
            complete: function(data){
                $(".loader").css("visibility", "hidden");
            }
        });
    });

    /* CHANGE PASSWORD */
    $("#savepassword").click(function(e){
        e.preventDefault();
        var np = $("#newpassword").val();
        var cp = $("#confirmpassword").val();
        if(cp!=np){
            alert("Pastikan password sama!");
        }
        var base_url = window.location.origin;

        $.ajax({
            type: 'POST',
            url: base_url + '/pages/updatepassword.php',
            dataType: 'json',
            data: {newpass:np},
            beforeSend: function(){
                $(".loader").css("visibility", "visible");
            },
            success: function(response){
                $("#pesan").empty();
                $("#pesan").append(response.pesan);
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