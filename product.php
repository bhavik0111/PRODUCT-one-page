<?php
ob_start();
session_start();
include "CONNECT.php";

$action = '';

if (isset($_GET['action'])) {
  $action = $_GET['action'];
}



// insert into database..........

if (isset($_REQUEST["submit"])) 
{
  $name        = $_REQUEST["name"];
  $category_id = $_REQUEST["category_id"];
  $description = $_REQUEST["description"];
  $price       = $_REQUEST["price"];
  //  $image       = $_REQUEST["file"];
  $status      = $_REQUEST["status"];

  // for image 
  $file     = $_FILES["file"]["name"];
  $tempname = $_FILES["file"]["tmp_name"];
  $folder   = "./image/" . time() . $file;

  // Now let's move the uploaded image into the folder: image
  if (move_uploaded_file($tempname, $folder)) {
    $_SESSION['msg'] = "<h3>  Image uploaded successfully!</h3>";
    header("location:product.php");
  } else {
    echo "<h3>  Failed to upload image!</h3>";
  }

  $query = "INSERT INTO `product_master` VALUES ('', '$category_id', '$name', '$description', '$price', '$folder', '$status')";

  $result = mysqli_query($conn, $query);

  if ($result) {
    $_SESSION['msg'] = "<h3> Data inserted into Database successfully </h3>";
    header("location:product.php");
  } else {
    echo "<h4> failed in database </h4>";
    //echo "Error:". $query . "<br>". $conn->error;
  }
}



// Add form

if ($action == 'Add') 
{
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
            <tr>
              <th>name</th>
              <td><input type="text" name="name"></td>
            </tr>

            <?php
            $sql = "SELECT * FROM `product_master` WHERE category_id = 0 ";
            $result = mysqli_query($conn, $sql);
            ?>
            <tr>
              <th>category_id</th>
              <td><select name="category_id">
                  <option value="0">--select--</option>
                  <?php
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                  <?php
                    }
                  }
                  ?>
                </select>
              </td>
            </tr>

            <tr>
              <th>description</th>
              <td><input type="text" name="description"></td>
            </tr>

            <tr>
              <th>price</th>
              <td><input type="price" name="price"></td>
            </tr>

            <tr>
              <th>image</th>
              <td><input type="file" name="file"></td>
            </tr>

            <tr>
              <th>status</th>
              <td><input type="radio" name="status" value="Active">Active
                <input type="radio" name="status" value="Deactive">Deactive
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
      }

  // update-edit..............

      else if (isset($_GET['id']) && $action == 'Edit') 
        {
            $id = $_GET['id'];

            $sql1 = "SELECT * FROM  `product_master`  WHERE `id`='$id'";
            // $result=mysqli_query($conn, $sql1);
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
              while ($row = $result1->fetch_assoc()) {
                $name        = $row["name"];
                $category_id = $row["category_id"];
                $description = $row["description"];
                $price       = $row["price"];
                $status      = $row["status"];
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
                  $sql = "SELECT * FROM `product_master` WHERE category_id = 0 ";
                  $result = mysqli_query($conn, $sql);
                  ?>
                  <tr>
                    <th>category_id</th>
                    <td><select name="category_id">
                        <option value="0">--select--</option>
                        <?php
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row['id']; ?>" <?php if ($category_id == $row['id']) {
                                                                        echo "selected";
                                                                      }
                                                                      ?>><?php echo $row['name']; ?></option>
                        <?php
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
                    <th>file</th>
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

              else if (isset($_GET['id']) && $action == 'Delete') 
              {
                $id = $_GET['id'];
                $sql     = "DELETE FROM `product_master` WHERE `id`='$id'";
                $result  = $conn->query($sql);

                if ($result == TRUE) {
                  $_SESSION['msg'] = "Record deleted successfully.";
                  header("location:product.php");
                } else {
                  echo "Error:" . $sql . "<br>" . $conn->error;
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
            <title>View Page</title>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
                                                                                                    } ?>">
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


                      //parent_id 0,0,0,0 convert to name mobile,laptop,car.......etc 
                    $sql = "SELECT product_master.id, product_master.category_id, product_master.name, product_master.description, product_master.price,product_master.image,product_master.status, b.name as category_id FROM product_master LEFT JOIN product_master b ON (product_master.category_id = b.id)";
                 

                      if (isset($_GET['search'])) 
                      {
                        $search_var = $_GET['search'];


                        $sql = "SELECT product_master.id, product_master.category_id, product_master.name, product_master.description, product_master.price,product_master.image,product_master.status, b.name as category_id FROM product_master LEFT JOIN product_master b ON (product_master.category_id = b.id) WHERE (product_master.name like '%" . $search_var . "%')";
                      }

                ?>

                <thead>
                  <tr>
                    <th>ID</th>
                    <th>category_id</th>
                    <th><a href="product.php?column=name&order=<?php echo $asc_or_desc; ?>">name</th>
                    <th><a href="product.php?column=description&order=<?php echo $asc_or_desc; ?>">description</th>
                    <th><a href="product.php?column=price&order=<?php echo $asc_or_desc; ?>">price</th>
                    <th>image</th>
                    <th><a href="product.php?column=status&order=<?php echo $asc_or_desc; ?>">status</th>
                    <th>action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                   


                    if (isset($_GET['order'])) 
                    {
                      $sql = $sql . 'ORDER BY ' .$column. ' '. $sort_order;
                    }




                  $result = mysqli_query($conn, $sql);
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                  ?>
                      <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['category_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                       <td><img src="./image/<?php echo $row['image']; ?>" height="50" width="50"></td>
                        <td><?php echo $row['status']; ?></td>

                        <td><a class="btn btn-info" href="product.php?action=Edit&id=<?php echo $row['id']; ?>">Edit</a>&nbsp;

                          <a class="btn btn-danger" href="product.php?action=Delete&id=<?php echo  $row['id']; ?>">Delete</a>
                        </td>
                      </tr>
                <?php
                    }
                  }
                }
                ?>
                </tbody>
              </table>
            </div>
        </form>
      </body>

      </html>


  <!-- // update query  -->
  <?php
  if (isset($_POST['update'])) 
  {
    $id          = $_GET['id'];
    $name        = $_POST["name"];
    $category_id = $_POST["category_id"];
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

      $sql = "UPDATE `product_master` SET name='$name',category_id='$category_id',description='$description',price='$price',status='$status',image='$filename' WHERE id='$user_id'";
    } else {
      $sql = "UPDATE `product_master` SET name='$name',category_id='$category_id',description='$description',price='$price',status='$status' WHERE id='$id'";
    }


    $result = mysqli_query($conn, $sql);

    if ($result == TRUE) {
      $_SESSION['msg'] = "Record updated successfully.";

      header("location:product.php");
    } else {
      echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }
  ?>
