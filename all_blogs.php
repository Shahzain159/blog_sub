<?php
include_once 'header.php';

if(isset($_GET["acc"])){
    $id = $_GET["acc"];
    mysqli_query($conn,"UPDATE blogs SET blog_status = 1 WHERE blog_id = $id");
}
if(isset($_GET["dec"])){
    $id = $_GET["dec"];
    mysqli_query($conn,"UPDATE blogs SET blog_status = 0 WHERE blog_id = $id");
}


$res = mysqli_query($conn,"SELECT b.blog_id,b.blog_name,b.blog_title,c.cat_name , b.blog_status FROM blogs b inner join blog_category c on b.blog_category = c.cat_id")


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
                                                
                                                if($row["blog_status"] == 1){
                                                    echo '<lable class="progress-bar bg-success">Active</label>';
                                                }
                                                else{
                                                    echo '<lable class="progress-bar bg-danger">Not Active</label>';

                                                }
                                                
                                                
                                               
                                                
                                                
                                                echo'</td>

                                                <td>
                                                    <a class="btn btn-primary">View</a>
                                                    <a class="btn btn-secondary ml-2">Tags</a>
                                                    <a class="btn btn-warning ml-2">Update</a>
                                                    <a class="btn btn-danger ml-2">Delete</a>';

                                                    if(!$row["blog_status"] == 1){
                                                        echo'<a class="btn btn-success ml-2" href="all_blogs.php?acc='.$row["blog_id"].'">Activate</a>';
                                                    }
                                                    else{
                                                        echo'<a class="btn btn-danger ml-2" href="all_blogs.php?dec='.$row["blog_id"].'">Deactivate</a>';
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
    <?php
    include_once 'footer.php';
    ?>