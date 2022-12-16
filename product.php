<?php
ob_start();
session_start();
ob_start();
require "CONNECT.PHP";

$action = '';
$page_no = 0;
$total_no_of_pages = 0;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}




// insert into database..........

// $error='';  msg...

 $name = "";
 $category = "";
 $description = "";
 $price = "";
 $file = "";
 $status = "";

if (isset($_POST["submit"])) {

    $name = $_POST["name"];                  //............

    if (empty($_POST['name'])) {
        $_SESSION['error']['name_error'] = "Please enter name";
    }



          $category = $_POST["category"];    //............

    if (empty($_POST['category']) || $_POST['category'] <= 0) {
        $_SESSION['error']['category_error'] = "Please Select category";
    }



    $description = $_POST["description"];    //............

    if (empty($_POST['description'])) {
        $_SESSION['error']['description_error'] = "Please enter description";
    }



          $price = $_POST["price"];              //............

    if (empty($_POST['price'])) {
        $_SESSION['error']['price_error'] = "Please enter price";
    }



    if (!(isset($_FILES['file'])) || !($_FILES['file']['name'])) {
        $_SESSION['error']['file_error'] = "Please choosed file";
    }



          $status = isset($_POST["status"]) ? $_POST["status"] : '';          //............

    if (!isset($_POST["status"])) {
        $_SESSION['error']['status_error'] = "Please choosed status";
    }


    // for image 
    $file     = $_FILES["file"]["name"];
    $tempname = $_FILES["file"]["tmp_name"];
    $folder   = "./image/" . time() . $file;



    if (!isset($_SESSION['error'])) {

        if (isset($_FILES["file"])) {
            if (move_uploaded_file($tempname, $folder)) {
                // $_SESSION['msg'] = "<h3>  Image uploaded successfully!</h3>";
                // header("location:product.php");
            } else {
                echo "<h3>  Failed to upload image!</h3>";
            }


            // Now let's move the uploaded image into the folder: image

            $query = "INSERT INTO `product_master` VALUES ('', '$category', '$name', '$description', '$price', '$folder', '$status')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['msg'] = "<h3> Data inserted into Database successfully </h3>";
                header("location:product.php");
            } else {
                echo "<h4> failed in database </h4>";
            }
        }
    }
}



// Add form

if ($action == 'Add') {
    
    ?>
<!DOCTYPE html>
<html>

<head>
    <title>&#128526; Product form </title>

</head>

<div class="" align="right">
    <a href="product.php" class="btn btn-outline-info">Back</a>
</div>

<body>
    <form method="POST" action="product.php?action=Add" enctype="multipart/form-data">
        <table border="1" align="center" cellpadding="15" cellspacing="0">

            <tr>
                <th colspan="2">
                    <h2>Add Product </h2>
                </th>
            </tr>


            </tr>

            <tr>
                <th>name</th>
                <td><input type="text" name="name" value="<?php echo $name; ?>">

                    <span style="color:red"><?php if (isset($_SESSION['error']['name_error'])) {
                                                            echo '<br>' . $_SESSION['error']['name_error'];
                                                            unset($_SESSION['error']['name_error']);
                        } ?></span>
                </td>
            </tr>

            <?php
                                    $sql = "SELECT * FROM `category` WHERE parent_id=0 AND status='Active'";
                                    $result = mysqli_query($conn, $sql);    
                                    ?>
            <tr>
                <th>category</th>
                <td><select name="category">
                        <option value="0">--select--</option>

                        <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) 
                                                    {
                                                        ?>
                        <option value="<?php echo $row['id']; ?>" <?php if ($category == $row['id']) {
                                                                                    echo "selected";
                        }
                                                                ?>><?php echo $row['title']; ?></option>

                        <?php
                                        
                                                        //subcategory for dropdown list..............................    
                                                
                                                        $sql_subcat = "SELECT * FROM `category` where parent_id=" . $row['id'] ." AND status='Active'";

                                                        $result_subcat = mysqli_query($conn, $sql_subcat);
                        
                            
                                                        if ($result_subcat->num_rows > 0) {
                                                            while ($row_subcat = $result_subcat->fetch_assoc()) 
                                                                {
                                                                ?>
                        <option value="<?php echo $row_subcat['id']; ?>"><?php echo '-->' . $row_subcat['title']; ?>
                        </option>
                        <?php
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                    </select>
                    <span style="color:red"><?php if (isset($_SESSION['error']['category_error'])) {
                                                            echo '<br>' . $_SESSION['error']['category_error'];
                                                            unset($_SESSION['error']['category_error']);
                        } ?></span>
                </td>
            </tr>


            <tr>
                <th>description</th>
                <td><input type="text" name="description" value="<?php echo "$description"; ?>">

                    <span style="color:red"><?php if (isset($_SESSION['error']['description_error'])) {
                                                            echo '<br>' . $_SESSION['error']['description_error'];
                                                            unset($_SESSION['error']['description_error']);
                        } ?></span>
                </td>
            </tr>



            <tr>
                <th>price</th>
                <td><input type="price" name="price" value="<?php echo "$price"; ?>">

                    <span style="color:red"><?php if (isset($_SESSION['error']['price_error'])) {
                                                            echo '<br>' . $_SESSION['error']['price_error'];
                                                            unset($_SESSION['error']['price_error']);
                        } ?></span>
                </td>
            </tr>


            <tr>
                <th>image</th>
                <td><input type="file" name="file" value="<?php echo $file; ?>">

                    <span style="color:red"><?php if (isset($_SESSION['error']['file_error'])) {
                                                            echo '<br>' . $_SESSION['error']['file_error'];
                                                            unset($_SESSION['error']['file_error']);
                        } ?></span>
                </td>
            </tr>


            <tr>
                <th>status</th>
                <td><input type="radio" name="status" value="Active" <?php if ($status == 'Active') {
                                                                                        echo "checked";
                        } ?>>Active

                    <input type="radio" name="status" value="Deactive" <?php if ($status == 'Deactive') {
                                                                                        echo "checked";
                        } ?>>Deactive

                    <span style="color:red"><?php if (isset($_SESSION['error']['status_error'])) {
                                                            echo '<br>' . $_SESSION['error']['status_error'];
                                                            unset($_SESSION['error']['status_error']);
                        } ?></span>

                </td>
            </tr>


            <tr>
                <td colspan="2" align="center"><input type="submit" name="submit">
                    <input type="reset" name="clear" value="clear">
                </td>
            </tr>
        </table>
    </form>

    <?php
                unset($_SESSION['error']);
}




// update-edit..............

else if (isset($_GET['id']) && $action == 'Edit') {
    $id = $_GET['id'];

    $sql1 = "SELECT * FROM  `product_master`  WHERE `id`='$id'";
    // $result=mysqli_query($conn, $sql1);
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc()) 
          {
            $name        = $row["name"];
            $category    = $row["category"];
            $description = $row["description"];
            $price       = $row["price"];
            $status      = $row["status"];
            $image       = $row["image"];
        }
        ?>
    <form method="POST" action="product.php?action=Edit&id=<?php echo $_GET['id'] ?>" enctype="multipart/form-data">

        <table border="1" align="center" cellpadding="15" cellspacing="0">
            <div class="" align="right">
                <a href="product.php" class="btn btn-outline-info">Back</a>
            </div>
            <tr>
                <th colspan="2">
                    <h2>Update Product </h2>
                </th>
            </tr>
            <tr>
                <th>name</th>
                <td><input type="text" name="name" value="<?php echo "$name"; ?>"></td>
            </tr>

            <?php
            $sql = "SELECT * FROM `category` WHERE parent_id = 0 AND status='Active'";
            $result = mysqli_query($conn, $sql);
            ?>
            <tr>
                <th>category</th>
                <td><select name="category">
                        <option value="0">--select--</option>
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                        <option value="<?php echo $row['id']; ?>" <?php if ($category == $row['id']) {
                                                              echo "selected";
        }
                                        ?>><?php echo $row['title']; ?></option>

                        <?php

                                //subcategory for dropdown list..............................    
                           
                                $sql_subcat = "SELECT * FROM `category` where parent_id=" . $row['id'] ." AND status='Active'";

                                $result_subcat = mysqli_query($conn, $sql_subcat);
 
   
                                if ($result_subcat->num_rows > 0) {
                                    while ($row_subcat = $result_subcat->fetch_assoc()) 
                                      {
                                        ?>
                        <option value="<?php echo $row_subcat['id']; ?>"><?php echo '-->' . $row_subcat['title']; ?>
                        </option>
                        <?php
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>

            <tr>
                <th>description</th>
                <td><input type="text" name="description" value="<?php echo "$description"; ?>"></td>
            </tr>

            <tr>
                <th>price</th>
                <td><input type="price" name="price" value="<?php echo "$price"; ?>"></td>
            </tr>

            <tr>
                <th>image</th>
                <td><input type="file" name="file" value="<?php echo "$file"; ?>"></td>
            </tr>

            <tr>
                <th>status</th>
                <td><input type="radio" name="status" value="Active" <?php if ($status == 'Active') {
                                                                    echo "checked";
    } ?>>Active
                    <input type="radio" name="status" value="Deactive" <?php if ($status == 'Deactive') {
                                                                    echo "checked";
    } ?>>Deactive
                </td>
            </tr>

            <tr>
                <td colspan="2" align="center"><input type="submit" name="update" value="update">
                    <input type="reset" name="clear" value="clear">
                </td>
            </tr>
        </table>
    </form>
    <?php
    }
}

      //delete.................   

else if (isset($_GET['id']) && $action == 'Delete') {
    $id = $_GET['id'];

    //DELETE image IN folder.........
    $sql2 = "SELECT * FROM  `product_master`  WHERE `id`='$id'";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) 
              {
            $image = $row["image"];
        }


        if (file_exists($image)) {
            unlink($image);        
        } else {
            echo "File does not exists";
        }
                     
                     
              $sql_delete = "DELETE FROM `product_master` WHERE `id`='$id'";
              $result  = $conn->query($sql_delete);
              
        if ($result == true) {
            $_SESSION['msg'] = "Record deleted successfully.";
            header("location:product.php");
        } else {
            echo "Error:" . $sql . "<br>" . $conn->error;
        }
    }
} 
           
           
  
else 
{

    if (isset($_SESSION['msg'])) {
        ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION['msg']; ?></div>
    <?php
        unset($_SESSION['msg']);
    }
    ?>
    <form method="get" enctype="multipart/form-data">

        <head>
            <title>product page</title>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
                crossorigin="anonymous">
        </head>

        <body>
            <div class="container">
                <h2>All products</h2>

                <div class="" align="right">
                    <a href="product.php?action=Add" class="btn btn-outline-success">Add+</a>
                </div>

                <div class="col-lg-8">
                    <input type="text" class="form-control" placeholder="Search.." name="search" value="<?php if (isset($_GET['search'])) {
                                                                                          echo $_GET['search'];
            }       ?>">
                </div>
                <div class="col-lg-3">
                    <button type="submit" id="search_btn" class="btn btn-outline-warning">Search</button>
                </div>

                <table class="table">

                    <?php

                            $column = isset($_GET['column']) && $_GET['column'] ? $_GET['column'] : 'title';

                            // Get the sort order for the column, ascending or descending, default is ascending.

                            $sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';
                            $asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';


                            //pagination.......................
                            if (isset($_GET['page_no']) && $_GET['page_no']!="") {
                                $page_no = $_GET['page_no'];
                            } 
                            else 
                            {
                                $page_no = 1;
                            }
                            $total_records_per_page = 2;
                            $offset = ($page_no-1) * $total_records_per_page;
                            $previous_page = $page_no - 1;
                            $next_page = $page_no + 1;
                            $adjacents = "2";
                            $result_count = mysqli_query($conn, "SELECT COUNT(*) As total_records FROM `product_master`");
                            $total_records = mysqli_fetch_array($result_count);
                            $total_records = $total_records['total_records'];
                            $total_no_of_pages = ceil($total_records / $total_records_per_page);
                            $second_last = $total_no_of_pages - 1;

                            //parent_id 0,0,0,0 convert to name mobile,laptop,car.......etc 
                            $sql = "SELECT product_master.id, product_master.category, product_master.name, product_master.description, product_master.price,product_master.image,product_master.status, category.title as category FROM product_master LEFT JOIN category ON (product_master.category = category.id)";


                            if (isset($_GET['search'])) {
                                $search_var = $_GET['search'];


                                $sql = "SELECT product_master.id, product_master.category, product_master.name, product_master.description, product_master.price,product_master.image,product_master.status, category.title as category FROM product_master LEFT JOIN category ON (product_master.category = category.id) WHERE (product_master.name like '%" . $search_var . "%')";
                            }

                            ?>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><a href="product.php?<?php if (isset($_GET['search'])) {
                                            echo 'search=' . $_GET['search'] . '&';
        } ?>column=name&order=<?php echo $asc_or_desc; ?>">category</th>
                            <th><a href="product.php?<?php if (isset($_GET['search'])) {
                                                    echo 'search=' . $_GET['search'] . '&';
        } ?>column=name&order=<?php echo $asc_or_desc; ?>">name</th>
                            <th><a href="product.php?<?php if (isset($_GET['search'])) {
                                                    echo 'search=' . $_GET['search'] . '&';
        } ?>column=description&order=<?php echo $asc_or_desc; ?>">description</th>
                            <th><a href="product.php?<?php if (isset($_GET['search'])) {
                                                    echo 'search=' . $_GET['search'] . '&';
        } ?>column=price&order=<?php echo $asc_or_desc; ?>">price</th>
                            <th>image</th>
                            <th><a href="product.php?<?php if (isset($_GET['search'])) {
                                                    echo 'search=' . $_GET['search'] . '&';
        } ?>column=status&order=<?php echo $asc_or_desc; ?>">status</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        if (isset($_GET['order'])) {
                            $sql = $sql . ' ORDER BY ' . $column . ' ' . $sort_order;
                        }

                        $sql = $sql . ' LIMIT '.$offset.','.$total_records_per_page;

                        $result = mysqli_query($conn, $sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['category']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><img src="<?php echo $row['image']; ?>" height="50" width="50"></td>
                            <td><?php echo $row['status']; ?></td>

                            <td><a class="btn btn-info"
                                    href="product.php?action=Edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;

                                <a class="btn btn-danger"
                                    href="product.php?action=Delete&id=<?php echo  $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                            }
                        }
                    
                ?>
                    </tbody>
                </table>

                <!-- pagination....................... -->

                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                        <?php if($page_no > 1) {
                            // echo "<li> <a href='?page_no=1'>First Page</a></li>";
                        } ?>

                        <li class="page-item" <?php if($page_no <= 1) { echo "class='disabled'"; } ?>>
                            <a class="page-link" <?php if($page_no > 1) {
                                echo "href='?page_no=$previous_page'";} ?>>Previous</a>
                        </li>

                        <?php
                        if ($total_no_of_pages <= 10) {     
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++)
                            {
                                if ($counter == $page_no) {
                                                 echo "<li class='page-item active'><a class='page-link'>$counter</a></li>"; 
                                }
                                else
                                {
                                           echo "<li class='page-item'><a class='page-link' href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                        }
                        ?>
                        <li class="page-item" <?php if($page_no >= $total_no_of_pages) {
                            echo "class='disabled'";
                        } ?>>
                                            <a class="page-link" <?php if($page_no < $total_no_of_pages) {echo "href='?page_no=$next_page'";
                        } ?>>Next</a>
                        </li>

                        <?php /* if($page_no < $total_no_of_pages){
                        //  echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
                        }*/ ?>
                    </ul>
                </nav>
            </div>
    </form>
</body>

</html>
<?php 
 }
 ?>


<!-- // update query -->

<?php
if (isset($_POST['update'])) {
    $id          = $_GET['id'];
    $name        = $_POST["name"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $price       = $_POST["price"];
    $status      = $_POST["status"];


    if ($_FILES['file']['name']) {
         $filename = $_FILES["file"]["name"];
         $tempname = $_FILES["file"]["tmp_name"];
         $folder = "./image/" . $filename;

         // Now let's move the uploaded image into the folder: image

        if (move_uploaded_file($tempname, $folder)) {

            echo "<h3>  Image uploaded successfully</h3>";
        } else {
            echo "<h3>  Failed to upload image!</h3>";
        }


        //UPDATE image AND OLD REMOVE in folder.........


        if (file_exists($image)) {
            unlink($image);
            echo "File Successfully Delete.";
        } 
        else 
          {
            echo "File does not exists";
        }



        $sql = "UPDATE `product_master` SET name='$name',category='$category',description='$description',price='$price',status='$status',image='$folder' WHERE id='$id'";
    } else {
        $sql = "UPDATE `product_master` SET name='$name',category='$category',description='$description',price='$price',status='$status' WHERE id='$id'";
    }


       $result = mysqli_query($conn, $sql);

    if ($result == true) {
        $_SESSION['msg'] = "Record updated successfully.";

        header("location:product.php");
    } else {
        echo "Error:" . $sql . "<br>" . $conn->error;
    }
}
?>
