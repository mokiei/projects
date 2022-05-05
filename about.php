<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My website</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
   
    
</head>
<body>
    <h1>Product List</h1>
   
    <a class= "btn btn-primary" href="form.php">ADD</a>
    <form action="about.php" method="POST">
    <button type="submit" class="btn btn-danger" name="delete-button" id="delete-product-button">MASS DELETE</button>
    

    <div class="row">
<?php
$con = mysqli_connect("localhost", "root", "", "phptutorials");

$query = "SELECT * FROM products";
$query_run = mysqli_query($con, $query);


if (mysqli_num_rows($query_run) > 0)
{ 
  foreach ($query_run as $row)
  {
  
    
?>
     
       <style>
                     #delete-product-button {
                      margin-left: 1200px;
                      margin-top: -8rem;
                    }
                    .btn{
                      margin-left: 1100px;
                      margin-top: -5rem;
                    }
                     
                     .card__details {
                      float: left;
	                    background: #ffffff;
	                    margin: 30px 30px 0px 0px;
	                    border: #E0E0E0 1px solid;
                     }
                    footer{
                      text-align:center;
                    }
                   </style>
                     
        
                
                   
                   <div class="col-md-2" style="margin-left: 20px;">
                   
                  
                   <div class="card__details" style="width: 12rem; height: 12rem;">
                  
                   <input type="checkbox" class="delete-checkbox" name="delete_id[]" value="<?php echo $row['id']; ?>" style="margin-left: 5px;">
                   <h5 class="text-center"><?php echo $row['sku']; ?></h5>
                   <h5 class="text-center"><?php echo $row['name']; ?></h5>
                   <h5 class="text-center"><?php echo $row['price']; ?></h5>
                   <h5 class="text-center"><?php echo $row['attribute']; ?></h5>
        
              </div>
              </div>
              
              <!--Mass delete button -->
                   
              
               
                 <?php

$con = mysqli_connect("localhost", "root", "", "phptutorials");



           if(isset($_POST['delete-button'])){
               $all_id = $_POST['delete_id'];

               $extract_id = implode(',' , $all_id);
               $query = "DELETE FROM products WHERE id IN($extract_id) ";
               $query_run = mysqli_query($con, $query);

               if($query_run)
               {
                   $_SESSION['status'] = "Data deleted successfully";
                   
               }
               else {
                $_SESSION['status'] = "Data not deleted";
               }
  }                   
}  
}
?>    

</div> 
</form>
<br>
<br>    
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    

<footer>
        <hr>
        <p>Scandiweb Test Assignment</p>
</footer>
</form> 
</body>
</html>