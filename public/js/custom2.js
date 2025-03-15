// const { functions } = require("lodash");

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
    let getuser = $(this).data('userId');
    let btn = this;
    $(btn).attr('disabled', true);
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/post/{post_name}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            post_id: post_id_v,
            get_user:getuser
        }),
        success: function (response) {
            console.log(response)

            if (response.response) {
                $(btn).attr('disabled', false);
                $(btn).hide()
                $(btn).siblings('.unlike_btn').show();
                location.reload();
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
                location.reload();
            }
            else
            {
                $(btn).attr('disabled', false);
                alert('Something is wrong, try after some time!')
            }
        }
    });
});

//for inserting comments
$(".add-comment").click(function (){
    var post_id_v =  $(this).data('postId');
    let getuser = $(this).data('userId');
    var btn = this;
    $(btn).attr('disabled', true);
    $(btn).siblings('.comment-input').attr('disabled',true);
    var comment_v =  $(btn).siblings('.comment-input').val()
    var cs = $(this).data('cs');
    var page = $(this).data('page');
    // $('#'+cs).append('');
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/addcomment/{comment}/pid/{pid}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
            post_id: post_id_v,
            comment: comment_v,
            get_user:getuser
        }),
        success: function (response) {
            console.log(response)
            if (response.response) {
                $(btn).attr('disabled', false);
    $(btn).siblings('.comment-input').attr('disabled',false);
    $(btn).siblings('.comment-input').val('');
    $('#'+cs).append(response.comments);
    $('.nce').hide();
    if (page='wall') {
        location.reload();
    }
            }
            else
            {
                $(btn).attr('disabled', false);
    $(btn).siblings('.comment-input').attr('disabled',false);

                alert('Something is wrong, try after some time!')
            }
        }
    });
});

function load_unseen_notification(view='') {
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/addcomment/{comment}/pid/{pid}",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
         view:view
        }),
        success: function (response) {

        }
    })
}







$(document).ready(function(){
 
    shownotification();
    setInterval(shownotification,20000);
    $("#sidebar").mouseleave(function(){
        $.post("/closenotify", function(response) {
            console.log(response);
            // $("#showdata").html(response);
        });
      });
    
})

//show notification of like and comment
function shownotification(){
// $(document).ready(function(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/notify",
        type:"POST",
        dataType:'json',
        data: JSON.stringify({
                status:1
        }),
        success: function (response) {
            // console.log(response);
            $('#sidebar').empty();
            let count = response.total;
            let data = response.data;
            let curentuser= response.current_user;
            $('#sidebar').append( "<h1 class='mx-3 text-white after'>Notifications</h1>")
            if (response.total > 0) {
                $("#notificationDot").removeClass("d-none"); // Show dot
            } else {
                $("#notificationDot").addClass("d-none"); // Hide dot
            }
        
            for (let key in data) {
                if(data[key].type=="like"){
                      if(data[key].u_postid==curentuser){
                       $('#sidebar').append(
                        "<div class='container mt-4 bg-white'>"+
       "<div class='alert alert-light border shadow-sm d-flex align-items-center p-2' role='alert'>"+
           " <div>"+
               " <strong>@"+data[key].username +"</strong> liked your post."+
          "</div>"+
           " <img src='/storage/"+data[key].post_img+"' alt='Like' class='ms-auto' width='24' height='24'>"+
       " </div>"+
   " </div>"
        )               }}
        if(data[key].type=="comment"){
                      if(data[key].u_postid==curentuser){
                       $('#sidebar').append(
                        "<div class='container mt-4 bg-white'>"+
       "<div class='alert alert-light border shadow-sm d-flex align-items-center p-2' role='alert'>"+
           " <div>"+
               " <strong>"+data[key].username +"</strong> commented on your post."+
          "</div>"+
           " <img src='/storage/"+data[key].post_img+"' alt='Like' class='ms-auto' width='24' height='24'>"+
       " </div>"+
   " </div>"
        )               }}
                
              }              
        }
    });
}

function syncMsg(){
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url:"/checkmessage",
        type:"POST",
        dataType:'json',
        // data: JSON.stringify({
        //         status:1
        // }),
        success: function (response) {
            console.log(response);
            $('#chatlist').html(response);
        }
    })
}
syncMsg();

setInterval(()=>{
    syncMsg();
},1000)




   