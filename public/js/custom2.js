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