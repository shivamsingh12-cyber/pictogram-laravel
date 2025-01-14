<?php
function checkfollowstatus($currentuser,$userid){
    // echo $currentuser."<br>";
    // echo $userid;
    $db=mysqli_connect('localhost','root',"","pictogram");
    // global $db;
$query="SELECT *  FROM followers WHERE follower_id='$currentuser' && user_id='$userid'";
$result=mysqli_query($db,$query);
return mysqli_fetch_assoc($result);
}
?>