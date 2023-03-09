<?php
include_once 'header.php';


if(isset($_GET["did"])){
    $did = $_GET["did"];
    mysqli_query($conn,"DELETE FROM blog_tags WHERE tag_id = $did");
    
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $n = $_POST["tag_name"];
    $bid = $_GET["bid"];
    mysqli_query($conn,"INSERT INTO blog_tags VALUES (NULL,'$n',$bid)");
}
$bid = 0;
if(isset($_GET["bid"])){
    $bid = $_GET["bid"];

    $res = mysqli_query($conn,"SELECT * FROM blog_tags WHERE tag_blog_id = $bid");

}
else{
    header('Location:all_blogs.php');
}


?>
<a href="all_blogs.php"> <- back</a>
<div class="w-50 mb-3">
    <form action="" method="post">
        <input type="text" name="tag_name" class="form-control mt-3" id="">
        <input type="submit" value="Add Tag" class="btn btn-primary mt-3">
    </form>
</div>
 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tag</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                  
                                    <tbody>
                                        <?php
                                            while($row = mysqli_fetch_assoc($res)){
                                                echo ' <tr>
                                                <td>'.$row["tag_name"].'</td>
                                                <td><a class="btn btn-danger" href="blog_tags.php?bid='.$bid.'&did='.$row["tag_id"].'">Delete</a></td>
                                            </tr>';
                                            }
                                        ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>


<?php
include_once 'footer.php';
?>