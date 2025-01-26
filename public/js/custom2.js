$(".followbtn").click(function (){
    let user_id_v = $(this).data('userId');
    let btn = this;
    $(btn).attr('disabled', true);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/follow/{user_id}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            user_id: user_id_v
        }),
        success: function (response) {
            if (response.response) {
                $(btn).data('userId', 0);
                $(btn).html('<i class="bi bi-check-circle-fill"></i> &nbsp; Followed');
            }
            else
            {
                $(btn).attr('disabled', false);
                alert('Something is wrong, try after some time!')
            }
        }
    });
});

$(".unfollowbtn").click(function (){
    let user_id_v = $(this).data('userId');
    let btn = this;
    $(btn).attr('disabled', true);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/unfollow/{user_id}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            user_id: user_id_v
        }),
        success: function (response) {
            if (response.response) {
                $(btn).data('userId', 0);
                $(btn).html('<i class="bi bi-check-circle-fill"></i> &nbsp; Unfollowed');
            }
            else
            {
                $(btn).attr('disabled', false);
                alert('Something is wrong, try after some time!')
            }
        }
    });
});

$(".like_btn").click(function (){
   
    // let user_id_v = $(btn).data('userId');
    let post_id_v =  $(this).data('postId');
    let btn = this;
    $(btn).attr('disabled', true);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/post/{post_name}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            post_id: post_id_v
        }),
        success: function (response) {
            console.log(response)

            if (response.response) {
                $(btn).attr('disabled', false);
                $(btn).hide()
                $(btn).siblings('.unlike_btn').show();
                return;
            }
            else
            {
                $(btn).attr('disabled', false);
                alert('Something is wrong, try after some time!')
            }
        }
    });
});

$(".unlike_btn").click(function (){
   
    // let user_id_v = $(btn).data('userId');
    var post_id_v =  $(this).data('postId');
    var btn = this;
    $(btn).attr('disabled', true);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/unpost/{post_name}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            // user_id: user_id_v,
            post_id: post_id_v
        }),
        success: function (response) {
            console.log(response)
            if (response.response) {
                $(btn).attr('disabled', false);
                $(btn).hide()
                $(btn).siblings('.like_btn').show();
                return;
            }
            else
            {
                $(btn).attr('disabled', false);
                alert('Something is wrong, try after some time!')
            }
        }
    });
});