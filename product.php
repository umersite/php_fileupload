<?php
    require 'connect.inc.php';
    session_start();
    if(!isset($_SESSION['type'])){
        header('location:login.php');
    }
    if (isset($_REQUEST['btnUpload'])) {
      $itemname = $_POST['txtName'];
       $itemrate = $_POST['txtRate'];

       $image = $_FILES['txtPic']["name"];//it will give the name of file
       $type = $_FILES['txtPic']['type'];//it will give type of file
       $size = $_FILES['txtPic']['size'];
       $temp = $_FILES['txtPic']['tmp_name'];
       $msg_upload = "requst obj name is {$image} of type {$type} of size {$size} with name {$temp}";
       $path = "image/".$image;
    
       if (!empty($temp)) {
            
        //echo $error_msg;
        if ($type=="image/jpg" || $type=="image/jpeg") {
            if (!file_exists($path)) {
                
               
                
                move_uploaded_file($temp,$path);

            }
            else{
                $error = "file already exists.....rename file";
               
            }
        }
        else{
          $error = "Wrong type selected";
        }
    }else{
        $error = "please select another image";
        $error_msg;
    }


    } 
    
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      <div class="container">
        <div class="jumbotron">
            <h3>Product List</h3>
           <p>
            <button class="btn btn-danger">Logout</button>
           </p>
        </div>
        <div>
            <div class="row">
              <div class="col-sm-6">
              <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="txtProductId">
                    <div class="form-group">
                        <label for="txtName">Item Name</label>
                        <input type="text" class="form-control" name="txtName" placeholder="Item Name" required>
                    </div>
                    <div class="form-group">
                        <label for="txtrate">Item Rate</label>
                        <input type="number" class="form-control" name="txtRate" placeholder="Item Rate" required>
                    </div>
                    <div class="form-group">
                        <label for="txtPic">Select Picture</label>
                        <input type="file" class="form-control" accept="image/*" name="txtPic" placeholder="Item Pic">
                    </div>
                    <button name="btnUpload" class="btn btn-primary" type="submit">Submit</button>
                </form>
              </div>
              <div class="col-sm-6">
                product table will go here
              </div>
            </div>
            <div>
                <br>
                <?php
                    if(isset($error)){
                ?>
                  <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?php echo $error; ?>
                  </div>
                <?php      
                    }
                ?>
                 <?php
                    if(isset($msg_upload)){
                ?>
                  <div class="alert alert-info alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Info!</strong> <?php echo $msg_upload; ?>
                  </div>
                <?php      
                    }
                ?>
            </div>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>