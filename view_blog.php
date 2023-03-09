<?php
include_once 'header.php';


echo '<a href="all_blogs.php"> <- back</a>';
$row ;
if(isset($_GET["bid"])){
    $bid = $_GET["bid"];

    $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blogs inner join blog_category WHERE blog_id = $bid"));
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
        <h5>Meta Titles</h5>
        <p>'.$row["blog_meta_titles"].'</p>
        <h5>Category : '.$row["cat_name"].'</h5>




';



?>





<?php
include_once 'footer.php';
?>