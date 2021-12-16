<?php session_start(); ?>
<?php include "config.php" ?>
<?php include "includes/header.php" ?>
<?php include "includes/navbar.php" ?>

<!-- 1 index -->
<?php
if (isset($_GET['action'])) {
    $do = $_GET['action'];
} else {
    $do = "index";
}
?>
<!-- index -->
<?php if ($do == "index") : ?>
    <h1 class="text-center">All products</h1>
    <?php
    $stmt = $con->prepare("SELECT * FROM `products`");
    $stmt->execute();
    $products = $stmt->fetchAll();
    ?>
    <div class="container">


        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">product name</th>
                    <th scope="col">price</th>
                    <th scope="col">item description</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <th scope="row">1</th>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['price'] ?></td>
                        <td>@mdo</td>

                    </tr>
                <?php endforeach ?>

            </tbody>
        </table>
        <a class="btn btn-primary" href="?action=create"> add product</a>
    </div>

    <!-- create -->
<?php elseif ($do == "create") : ?>
    <h1 class="text-center">add product</h1>
    <div class="container">

        <form method="POST" action="products.php?action=store">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Product Name</label>
                <input type="text" name="product" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Item Description</label>
                <input type="text" name="item_description" class="form-control">
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Price</label>
                <input type="text" name="price" class="form-control">
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>


    <!-- store -->
<?php elseif ($do == "store") : ?>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST") {

        $product = $_POST['product'];
        //    problem in item description why data doesn't appear?
        $item_description = $_POST['item description'];
        $price = $_POST['price'];
        $stmt = $con->prepare(
            "INSERT INTO `products`( `name`, `item description`, `price`) 
         VALUES (?,?,?)"
        );
        $stmt->execute(array($product, $item_description, $price));
        header("location:products.php");
    }

    ?>

    <!-- edit -->
<?php elseif ($do == "edit") : ?>
    <h1>Hello edit page</h1>

    <!-- update -->
<?php elseif ($do == "update") : ?>
    <h1>Hello upadate page</h1>

    <!-- ---------------------------------- -->
<?php else : ?>
    <h1> 404 page </h1>
<?php endif ?>

<?php include "includes/footer.php" ?>