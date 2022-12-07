<?php 
session_start();
      include "connect.php"; 
 
            $action = '';

            if (isset($_GET['action'])) 
            {
              $action = $_GET['action'];
            }

  // insert to database

  if(isset($_REQUEST["submit"]))
  {
   // $product_id  = $_REQUEST["product_id"];
    $category_id = $_REQUEST["category_id"];
    $name        = $_REQUEST["name"];
    $description = $_REQUEST["description"];
    $price       = $_REQUEST["price"];
//  $image       = $_REQUEST["file"];
    $status      = $_REQUEST["status"];

      $file     = $_FILES["file"]["name"];
      $tempname = $_FILES["file"]["tmp_name"];
      $folder   = "./image/" . time().$file;
        
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname,$folder)) 
        {
             $_SESSION['msg'] = "<h3>  Image uploaded successfully!</h3>";
             header("location:product.php"); 
        } 
        else 
        {
            echo "<h3>  Failed to upload image!</h3>";
        }

        $query ="INSERT INTO `product_master` VALUES ('', '$category_id', '$name', '$description', '$price', '$folder', '$status')"; 
       
        $result=mysqli_query($conn, $query);  
           
           if($result)
           {
             $_SESSION['msg'] = "<h3> Data inserted into Database successfully </h3>";
            header("location:product.php");
           }
           else
           {
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
                        <th colspan="2"><h2>Add Product </h2></th>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><input type="text" name="name"></td>
                    </tr>

                    <?php
                      $sql = "SELECT * FROM `product_master` WHERE category_id = 0 ";
                      $result = mysqli_query($conn,$sql);
                    ?>
                    <tr>
                        <th>Category_id</th>           
                        <td><select name="category_id">
                            <option value="0">--select--</option>
                            <?php
                                 if ($result->num_rows > 0) 
                                 {
                                    while ($row = $result->fetch_assoc()) 
                                     {
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
                        <th>Description</th>
                        <td><input type="text" name="description"></td>
                    </tr>

                     <tr>
                        <th>Price</th>
                        <td><input type="price" name="price"></td>
                    </tr>

                     <tr>
                        <th>Image</th>
                        <td><input type="file" name="file"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                         <td><input type="radio" name="status" value="Active">Active
                        <input type="radio" name="status" value="Deactive">Deactive</td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" name="submit">
                        <input type="reset" name="clear" value="clear"></td>
                    </tr>
                </table>
            </form>
<?php
    }   
    else
    {
        if (isset($_SESSION['msg'])) 
          {
            ?>
            <div class="alert alert-success" role="alert"><?php echo $_SESSION['msg']; ?></div>
            <?php
            unset($_SESSION['msg']);
          }
?>
         <form method="POST" enctype="multipart/form-data">
        <head>
          <title>View Page</title>

          <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        
        </head>

        <body>
          <div class="container">
            <h2>All product</h2>

              <div class="" align="right">
                <a href="product.php?action=Add" class="btn btn-outline-success">Add+</a>
              </div>

            <table class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>category_id</th>
                  <th>name</th>
                  <th>description</th>
                  <th>price</th>
                  <th>image</th>
                  <th>status</th>
                  <th>action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                
                $result = mysqli_query($conn,"SELECT * FROM `product_master`");

                if ($result->num_rows > 0) 
                {
                  while ($row = $result->fetch_assoc()) 
                  {
                ?>
                    <tr>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['category_id']; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td><?php echo $row['description']; ?></td>
                      <td><?php echo $row['price']; ?></td>
                      <td><img src="./image/<?php echo $row['image']; ?>" ></td>
                      <td><?php echo $row['status']; ?></td>

                      <td><a class="btn btn-info" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                        <a class="btn btn-danger" href="delete.php?id=<?php echo  $row['id']; ?>">Delete</a>
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

