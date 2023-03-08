<?php
include_once 'header.php';


if(isset($_GET["did"])){
    $d = $_GET["did"];
    $res =  mysqli_query($conn,"DELETE FROM blog_category WHERE cat_id = $d");
    if($res){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Category Deleted</strong>
        <button type="button" class="btn" data-bs-dismiss="alert" aria-label="Close" style="margin-left:50rem ; font-size:25px">X</button>
      </div>';
       // header('Location:category.php?mess=Category Deleted');
    }
}

if(isset($_GET["mess"])){
   
}



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name =  clean($_POST["cat_name"]);

    $query = "INSERT INTO blog_category VALUES(NULL,'$name')";
    $res = mysqli_query($conn,$query);
}
$data = mysqli_query($conn,"SELECT * FROM blog_category");
?>
 <h3 class="m-3">Categories</h3>

 <div class="w-50 m-3">
    <form action="" method="post">
        <input type="text" name="cat_name" id="" class="form-control mt-3">
        <input type="submit" value="Add Category" class="btn btn-primary mt-3">
    </form>
 </div>

 <div>
 <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Cateogies</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>
                                    
                                        <?php
                                            while($row = mysqli_fetch_assoc($data)){
                                                echo '<tr>
                                                <td>'.$row["cat_name"].'</td>
                                                <td><a class="btn btn-secondary" href="categories.php?did='.$row["cat_id"].'">Delete</a></td>
                                                </tr>';
                                            }
                                        ?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
 </div>

<?php
include_once 'footer.php';
?>