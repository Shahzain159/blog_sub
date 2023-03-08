<?php
include_once 'header.php';

$res = mysqli_query($conn,"SELECT * FROM blog_category");


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $blog_name =  $_POST["blog_name"];
    $blog_title =  $_POST["blog_title"];
    $blog_author =  $_POST["blog_author"];
    $blog_content =  $_POST["blog_content"];
    $blog_cat =  $_POST["blog_cat"];
    $blog_meta =  $_POST["blog_meta"];
    $name =  $_POST["blog_name"];

    $query = "INSERT INTO blog_category VALUES(NULL,'$name')";
    $res = mysqli_query($conn,$query);
}


?>
<center>
 <h3>Add Blogs</h3>

 <div class="w-75 m-3">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="blog_name" id="" placeholder="Blog Name" class="form-control mt-3">
        <input type="text" name="blog_title" id="" placeholder="Blog Title" class="form-control mt-3">
        <input type="text" name="blog_author" id="" placeholder="Blog Author Name" class="form-control mt-3">
        <textarea name="blog_content"  rows="5" placeholder="Blog Content" class="form-control mt-3"></textarea>
        <input type="file" name="blog_image" id="" class="form-control mt-3">
        <input type="text" name="blog_video" id="" placeholder="Blog Video Link" class="form-control mt-3">
        
        <!-- <input type="date" name="blog_author" id="" class="form-control mt-3"> -->
        <label class="mt-3">Blog Category</label>
        <select class="form-control" name="blog_cat">
            <?php
                while($row = mysqli_fetch_assoc($res)){
                    echo '<option>'.$row["cat_name"].'</option>';
                }

            ?>
        </select>
       
        <textarea name="blog_meta"  rows="5" placeholder="Meta Titles" class="form-control mt-3"></textarea>
    
        <input type="submit" value="Add Blog" class="btn btn-primary mt-3 w-50">
    </form>
 </div>



 </center>
<?php
include_once 'footer.php';
?>