<?php
include_once 'header.php';




if($_SERVER["REQUEST_METHOD"]=="POST"){
    $id = $_POST["hid"];
    $blog_name =  $_POST["blog_name"];
    $blog_title =  $_POST["blog_title"];
    $blog_author =  $_POST["blog_author"];
    $blog_content =  $_POST["blog_content"];
    $blog_cat =  $_POST["blog_cat"];
    $blog_meta =  $_POST["blog_meta"];
    $blog_video =  $_POST["blog_video"];

    $path = "";
    //print_r($_FILES);
    if($_FILES["blog_image"]["size"] > 0){
        $fname = $_FILES["blog_image"]["name"];
        $tmp_data = $_FILES["blog_image"]["tmp_name"];
        $ext = pathinfo($fname, PATHINFO_EXTENSION);
        $ext_arr = array("jpeg","JPEG","PNG","png","jfif","JFIF");

        if(in_array($ext,$ext_arr)){
            $path = 'img/blog_images/'.time().$fname;
            move_uploaded_file($tmp_data,$path);
        }

    }
    if(empty($path)){
        $query = "UPDATE `blogs` SET 
            `blog_name`='$blog_name',
            `blog_title`='$blog_title',
            `blog_author_name`='$blog_author',
            `blog_video`='$blog_meta',
            `blog_content`='$blog_content',
            `blog_category`=$blog_cat,
            `blog_meta_titles`=' $blog_meta'
             WHERE blog_id = $id";

             mysqli_query($conn,$query);
    }
    else{

        $row4= mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blogs WHERE blog_id = $id"));
    
        if(file_exists($row4["blog_image"])){
            unlink($row4["blog_image"]);
        }

        $query = "UPDATE `blogs` SET 
        `blog_name`='$blog_name',
        `blog_title`='$blog_title',
        `blog_author_name`='$blog_author',
        `blog_video`='$blog_meta',
        `blog_image`='$path',
        `blog_content`='$blog_content',
        `blog_category`=$blog_cat,
        `blog_meta_titles`=' $blog_meta'
         WHERE blog_id = $id";

         mysqli_query($conn,$query);
    }

    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    Blog Updateed
    <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close" style="margin-left:50rem ; font-size:25px">X</button>
  </div>';

}


if(isset($_GET["bid"])){
    $bid = $_GET["bid"];
    $row = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blogs WHERE blog_id = $bid"));
}

$res2 = mysqli_query($conn,"SELECT * FROM blog_category");
?>

<a href="all_blogs.php"> <- back</a>


<div class="w-75 m-3">
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="hid" value="<?php echo $bid ?>" >
        <input type="text" name="blog_name" id="" value="<?php echo $row["blog_name"] ?>" placeholder="Blog Name" class="form-control mt-3">
        <input type="text" name="blog_title" id="" value="<?php echo $row["blog_title"] ?>" placeholder="Blog Title" class="form-control mt-3">
        <input type="text" name="blog_author" id="" value="<?php echo $row["blog_author_name"] ?>" placeholder="Blog Author Name" class="form-control mt-3">
        <textarea name="blog_content"  rows="5" placeholder="Blog Content"  class="form-control mt-3"><?php echo $row["blog_content"] ?></textarea>
        <input type="file" name="blog_image" id=""  class="form-control mt-3">
        <input type="text" name="blog_video" id="" value="<?php echo $row["blog_video"] ?>" placeholder="Blog Video Link" class="form-control mt-3">
        
        <!-- <input type="date" name="blog_author" id="" class="form-control mt-3"> -->
        <label class="mt-3">Blog Category</label>
        <select class="form-control" name="blog_cat">
            <?php
                while($row2 = mysqli_fetch_assoc($res2)){
                    echo '<option value="'.$row2["cat_id"].'">'.$row2["cat_name"].'</option>';
                }

            ?>
        </select>
       
        <textarea name="blog_meta"  rows="5"  placeholder="Meta Titles" class="form-control mt-3"><?php echo $row["blog_meta_titles"] ?></textarea>
    
        <input type="submit" value="Update" class="btn btn-primary mt-3 w-50">
    </form>
 </div>




<?php
include_once 'footer.php';
?>