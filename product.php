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
            
        }
        if(!isset($error)){
            //$stmt = "insert into product (productName, productRate, productPic) values ('$itemname',$itemrate,'$patch')";
              $query = "insert into product (productName, productRate, productPic) values (:name,:rate,:pic)";
              $stmt = $db->prepare($query);

              $stmt->bindParam(':name',$itemname);
              $stmt->bindParam(':rate',$itemrate);
              $stmt->bindParam(':pic',$image);

              if($stmt->execute()){
                $succmsg = "file is uploaded and saved";
              }


        }

        

    } 
    if(isset($_REQUEST['btnLogout'])){
      session_destroy();
      header('location:login.php');
    }
    
?>


<!doctype html>
<html lang="en">
  <head>
    <title>Product Admin</title>
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
             <form action="" method="post">
             <button class="btn btn-danger" name="btnLogout" id="btnLogout">Logout</button>
             </form>
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
                  <?php
                    $qry = "select * from product order by productid desc";
                    $sno = 1;
                  ?>
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Rate</th>
                        <th>Picture</th>
                        <th>Action</th>
                      </tr>
                      <thead>
                      <tbody>  
                          <?php 
                            $rslt = $db->query($qry);
                            foreach($rslt as $row)
                              {
                                echo "<tr>";
                          ?>
                              <td><?php echo $sno; ?></td>
                              <td><?php echo $row['productName']; ?></td>
                              <td><?php echo $row['productRate']; ?></td>
                              <td><img src="<?php echo 'image/'.$row['productPic']; ?>" width="100" height="auto" alt="<?php echo $row['productName']; ?>"></td>
                              <td></td>
                          <?php 
                                echo "</tr>";
                                $sno=$sno+1;
                              }
                          ?>
                    </tbody>
                  </table>

              
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
               <?php
                    if(isset($succmsg)){
                ?>
                  <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Info!</strong> <?php echo $succmsg; ?>
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