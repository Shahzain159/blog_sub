<?php
include_once 'header.php';

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
                                                <td>' . $row["blog_status"] . '</td>

                                                <td>
                                                    <a class="btn btn-primary">View</a>
                                                    <a class="btn btn-secondary ml-2">Tags</a>
                                                    <a class="btn btn-warning ml-2">Update</a>
                                                    <a class="btn btn-danger ml-2">Delete</a>
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