<?php
include 'protect.php';

require 'connect.php';
//$con = mysqli_connect("localhost","root","root","complete") or die(mysqli_connect_error());
$sql = "SELECT * FROM products";
$result = mysqli_query($con, $sql) or die( mysqli_error($con) );// executing the query
$rows = mysqli_fetch_all($result, 1);//assoc array
mysqli_close($con);//close the connection

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cart</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body>
<?php include 'nav.php' ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12">

        <?php
        if (isset($_SESSION["products"]))
        $no_of_items =count( array_unique($_SESSION["products"]) );
        ?>

            <p class="text-info mb-0">You have <?=$no_of_items??0 ?> items in your cart</p>

            <a href="checkout.php" class="btn btn-outline-info btn-sm mb-1">Check Out</a>

            <table id="example" class="table table-striped table-bordered">

                <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Description</th>
                    <th>Poster</th>
                    <th>Add</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($rows as $product): ?>
                    <tr>
                        <td> <?= $product["title"] ?> </td>
                        <td> <?= $product["genre"] ?> </td>
                        <td> <?= $product["description"] ?> </td>
                        <td><img src="<?=$product['poster']?>" width="60" height="60"  alt=""></td>
                        <td> <a class="btn btn-info btn-sm" href="add-to-cart.php?id=<?=$product["id"]?>">Add to cart </a>  </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

</body>
</html>
