<?php include("connection_BDD.php") ?>

<?php
if(isset($_POST['like'])){
    $q = "SELECT * FROM likes WHERE `username` = '".$_SESSION['recieveruser']."'";
    $r = mysqli_query($con, $q);
    $count  = mysqli_num_rows($r);
    if ($count == "0") {
        $q1 = "INSERT INTO likes (`username`, `likecount`)VALUES('".$_SESSION['recieveruser']."', '1')";
        $result1 = mysqli_query($con, $q1);
    } else {
        while($row = mysqli_fetch_array($r)) {
            $liked = $row['likecount'];
        }
        $likeus = ++$liked;
        $q2    = "UPDATE likes SET likecount='".$likeus."' WHERE username = '".$_SESSION['recieveruser']."'";
        $result2 = mysqli_query($con, $q2);
    }
}
?>

