<?php
include'connect.php';
if(isset($_POST['product_id']))
{
    $sql = "SELECT * FROM `product_master` WHERE id = ".$_POST['product_id']." AND status='Active'";
    $result = mysqli_query($conn, $sql);
    $response = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) 
        {
            echo(json_encode($row));
        }
        // echo(json_encode($response));
        // echo json_encode($row);
    }else{
        echo false;
    }

}
