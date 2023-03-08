<?php
include_once 'header.php';

$row ;
if(isset($_GET["bid"])){
    $bid = $_GET["bid"];

    $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blogs WHERE blog_id = $bid"));
}
else{
    header('Location:all_blog.php');
}
echo '<h2>'.$row["blog_title"].'</h2>
        <h5>Author: '.$row["blog_author_name"].'</h5>
        <h5>Date: '.$row["blog_publish_date"].'</h5>
        <br>
        <p>'.$row["blog_content"].'</p>
        <img width="500px" src="'.$row["blog_image"].'"/>
        





';



?>





<?php
include_once 'footer.php';
?>