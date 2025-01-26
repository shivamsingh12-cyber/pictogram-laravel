<?php

function checkfollowstatus($currentuser,$userid){
    $db=mysqli_connect('localhost','root',"","pictogram");
    // global $db;

$query="SELECT *  FROM followers WHERE follower_id='$currentuser' && user_id='$userid'";

    $result=mysqli_query($db,$query);
    return mysqli_fetch_assoc($result);

}

function checklikestatus($postid) {
    $db=mysqli_connect('localhost','root',"","pictogram");
    $currentuser=Auth()->id();
    $query="SELECT * FROM likeposts where  post_id='$postid' && user_id='$currentuser'";
    if ($query) {
       $result= mysqli_query($db,$query);
        return mysqli_fetch_all($result);
    }
    
}
?>