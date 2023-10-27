<?php
session_start();
include("../../db.php");

$p_id = $_REQUEST['product_id'];

// Check if the form was submitted
if (isset($_POST['btn_update'])) {
    $product_name = $_POST['product_name'];
    $details = $_POST['details'];
    $price = $_POST['price'];
    $product_type = $_POST['product_type'];
    $brand = $_POST['brand'];
    $tags = $_POST['tags'];

    // Handle image update if a new image is provided
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    if (!empty($picture_name) && ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif")) {
        // Handle image update
        move_uploaded_file($picture_tmp_name, "your_upload_directory/" . $picture_name);
        // Update the product with the new image
        mysqli_query($con, "UPDATE products SET product_cat='$product_type', product_brand='$brand', product_title='$product_name', product_price='$price', product_desc='$details', product_image='$picture_name', product_keywords='$tags' WHERE product_id='$p_id'") or die("Query is incorrect");
    } else {
        // No new image provided, update without changing the image
        mysqli_query($con, "UPDATE products SET product_cat='$product_type', product_brand='$brand', product_title='$product_name', product_price='$price', product_desc='$details', product_keywords='$tags' WHERE product_id='$p_id'") or die("Query is incorrect");
    }

    header("location: products_list.php?success=1");
    mysqli_close($con);
}

include "sidenav.php";
include "topheader.php";

// Fetch the product data for editing
$result = mysqli_query($con, "SELECT * FROM products WHERE product_id = $p_id") or die("Query is incorrect");
if ($row = mysqli_fetch_assoc($result)) {
    $product_name = $row['product_title'];
    $details = $row['product_desc'];
    $price = $row['product_price'];
    $product_type = $row['product_cat'];
    $brand = $row['product_brand'];
    $tags = $row['product_keywords'];
    $existing_image = $row['product_image'];
}
?>

<!-- HTML form for editing the product -->
<!DOCTYPE html>
<html>
<head>
    <!-- Add your HTML head content here -->
</head>
<body>
    <div class="content">
        <div class="container-fluid">
            <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class="title">Actualizar Producto</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Nombre del Producto</label>
                                            <input type="text" id="product_name" required name="product_name" class="form-control" value="<?php echo $product_name; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <label for="">Agregar Imagen</label>
                                            <input type="file" name="picture" class="btn btn-fill btn-success" id="picture">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <textarea rows="4" cols="80" id="details" required name="details" class="form-control"><?php echo $details; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Precio</label>
                                            <input type="text" id="price" name="price" required class="form-control" value="<?php echo $price; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <h5 class a="title">Categorías</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Categoría del Producto</label>
                                            <input type="number" id="product_type" name="product_type" required="[1-6]" class="form-control" value="<?php echo $product_type; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Marca del Producto</label>
                                            <input type="number" id="brand" name="brand" required class="form-control" value="<?php echo $brand; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Palabras clave del Producto</label>
                                            <input type="text" id="tags" name="tags" required class="form-control" value="<?php echo $tags; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_update" name="btn_update" class="btn btn-fill btn-primary">Actualizar Producto</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
include "footer.php";
?>
