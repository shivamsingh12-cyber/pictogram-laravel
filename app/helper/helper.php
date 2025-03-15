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

function getlikecount($postid) {
    $db=mysqli_connect('localhost','root',"","pictogram");
    $query="SELECT * FROM likeposts where post_id='$postid'";
    if ($query) {
        $result= mysqli_query($db,$query);
         return mysqli_fetch_all($result,true);
     }
}

// for getting comments count
function getallcomments($postid) {
    $db=mysqli_connect('localhost','root',"","pictogram");
    $query="SELECT * FROM comments where post_id='$postid'";
    if ($query) {
        $result= mysqli_query($db,$query);
         return mysqli_fetch_all($result,true);
     }
}

function getallUser($postid) {
    $db=mysqli_connect('localhost','root',"","pictogram");
    $currentuser=$postid;
    $query="SELECT * FROM users where id=$currentuser";
    if ($query) {
        $result= mysqli_query($db,$query);
         return mysqli_fetch_assoc($result);
     }
}

function getTimeAgo($timestamp)
{
    $time = strtotime($timestamp);
    $diff = time() - $time;

    if ($diff < 60) { // Seconds ago
        return $diff . " second" . ($diff > 1 ? "s" : "") . " ago";
    } elseif ($diff < 3600) { // Minutes ago
        $minutes = floor($diff / 60);
        return $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
    } elseif ($diff < 86400) { // Hours ago
        $hours = floor($diff / 3600);
        return $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
    } elseif ($diff < 2592000) { // Days ago
        $days = floor($diff / 86400);
        return $days . " day" . ($days > 1 ? "s" : "") . " ago";
    } elseif ($diff < 31536000) { // Months ago
        $months = floor($diff / 2592000);
        return $months . " month" . ($months > 1 ? "s" : "") . " ago";
    } else { // Years ago
        $years = floor($diff / 31536000);
        return $years . " year" . ($years > 1 ? "s" : "") . " ago";
    }
}

?>