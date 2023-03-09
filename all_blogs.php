<?php
include_once 'header.php';

if (isset($_GET["acc"])) {
    $id = $_GET["acc"];
    mysqli_query($conn, "UPDATE blogs SET blog_status = 1 WHERE blog_id = $id");
    
}
if (isset($_GET["dec"])) {
    $id = $_GET["dec"];
    mysqli_query($conn, "UPDATE blogs SET blog_status = 0 WHERE blog_id = $id");
    
}

if(isset($_POST["del_btn"])){
    $did = $_POST["del_id"];
   // echo $did;
    $row= mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM blogs WHERE blog_id = $did"));
    
    if(file_exists($row["blog_image"])){
        unlink($row["blog_image"]);
    }
   
    $res =  mysqli_query($conn,"DELETE FROM blogs WHERE blog_id = $did");
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Blog Deleted</strong>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close" style="margin-left:50rem ; font-size:25px">X</button>
      </div>';
       // header('Location:category.php?mess=Category Deleted');
    }
}

echo '    <div class="modal fade" id="deleteblog" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Are You Sure You Want To Delete This Blog.</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
             <form method="post">
               <input type="hidden" id="feed_id" name="del_id" value="" />
            <button type="submit" name="del_btn" class="btn btn-danger">Delete</button>
            </form> 
            </div>
    </div>
</div>
</div>';


$res = mysqli_query($conn, "SELECT b.blog_id,b.blog_name,b.blog_title,c.cat_name , b.blog_status FROM blogs b inner join blog_category c on b.blog_category = c.cat_id")


?>
<h3>All Blogs</h3>

<div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All BLogs</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Blog Name</th>
                            <th>Blog Title</th>
                            <th>Blog Category</th>
                            <th>Blog Status</th>
                            <th>Actions</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo '<tr>
                                                <td>' . $row["blog_name"] . '</td>
                                                <td>' . $row["blog_title"] . '</td>
                                                <td>' . $row["cat_name"] . '</td>
                                                <td>';

                            if ($row["blog_status"] == 1) {
                                echo '<lable class="progress-bar bg-success">Active</label>';
                            } else {
                                echo '<lable class="progress-bar bg-danger">Not Active</label>';
                            }





                            echo '</td>

                                                <td>
                                                    <a class="btn btn-primary" href="view_blog.php?bid='.$row["blog_id"].'">View</a>
                                                    <a class="btn btn-secondary ml-2" href="blog_tags.php?bid='.$row["blog_id"].'">Tags</a>
                                                    <a class="btn btn-secondary ml-2">Update</a>

                                                    <a class="btn btn-secondary" id="delete" href="#" data-id="' . $row["blog_id"] . '" data-toggle="modal" data-target="#deleteblog">
                                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                    Delete
                                                    </a>';

                            if (!$row["blog_status"] == 1) {
                                echo '<a class="btn btn-success ml-2" href="all_blogs.php?acc=' . $row["blog_id"] . '">Activate</a>';
                            } else {
                                echo '<a class="btn btn-danger ml-2" href="all_blogs.php?dec=' . $row["blog_id"] . '">Deactivate</a>';
                            }


                            echo '
                                                </td>
                                                </tr>';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
    $('body').on('click', '#delete',function(){
        document.getElementById("feed_id").value = $(this).attr('data-id');
            console.log($(this).attr('data-id'));
        });
    });

 </script>

<?php
include_once 'footer.php';
?>