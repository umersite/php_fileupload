<?php
    require 'connect.inc.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('location:login.php');
    }
    if(isset($_REQUEST['btnLogout'])){
      session_destroy();
      header('location:login.php');
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
          <style>
            .card {
              box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
              max-width: 300px;
              margin: auto;
              text-align: center;
              font-family: arial;
            }

            .price {
              color: grey;
              font-size: 22px;
            }

            .card button {
              border: none;
              outline: 0;
              padding: 12px;
              color: white;
              background-color: #000;
              text-align: center;
              cursor: pointer;
              width: 100%;
              font-size: 18px;
            }

            .card button:hover {
              opacity: 0.7;
            }
      </style>
 
  </head>
  <body>
      <div class="container">
        <div class="jumbotron">
            <h3>Product List</h3>
           <p>
             <form action="">
                <button name="btnLogout" class="btn btn-danger">Logout</button>
             </form>
           </p>
           <p>
              <span style="font-weight:bold"> Welcome:</span> <?php echo $_SESSION['user']; ?>
           </p>
        </div>
        <div class="row">
          <?php 
            $qry = "select * from product order by productId desc";
            $rslt = $db->query($qry);

            foreach($rslt as $row)
            {
          ?>
          <div class="col-md-4">
          <div class="card">
              <img src="<?php echo 'image/'.$row['productPic']; ?>" alt="<?php echo $row['productName'] ?>" style="width:auto; height:200px;">
              <h1 style="text-transform:uppercase;"><?php echo $row['productName'] ?></h1>
              <p class="price">$<?php echo $row['productRate'] ?></p>             
              <p><button>Add to Cart</button></p>
            </div>
          </div>
          <?php 
            }
          ?>
        </div>
      </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>