<?php
session_start();
include("../../db.php");
error_reporting(0);
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
  $product_id = $_GET['product_id'];
  ///////picture delete/////////
  $result = mysqli_query($con, "select product_image from products where product_id='$product_id'")
    or die("query is incorrect...");

  list($picture) = mysqli_fetch_array($result);
  $path = "../product_images/$picture";

  if (file_exists($path) == true) {
    unlink($path);
  } else {
  }
  /*this is delet query*/
  mysqli_query($con, "delete from products where product_id='$product_id'") or die("query is incorrect...");


}

// Add update


if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'update') {
  $product_id = $_GET['product_id'];

}

// End update

///pagination

$page = $_GET['page'];

if ($page == "" || $page == "1") {
  $page1 = 0;
} else {
  $page1 = ($page * 10) - 10;
}
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">


<?php
// Check if the "success" parameter is set to 1 in the URL
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo '<div class="col-md-12 col-xs-12" id="product_msg">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <b>Producto agregado</b>
            </div>
          </div>';
}



if (isset($_GET['de_success']) && $_GET['del_success'] == 1) {
    echo '<div class="col-md-12 col-xs-12" id="product_msg">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <b>Producto Eliminado Correctamente</b>
            </div>
          </div>';
}
?>

    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title"> Lista de Productos </h4>

        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter " id="page1">
              <thead class=" text-primary">
                <tr>
                  <th>Imagen</th>
                  <th>Nombre</th>
                  <th>Precio</th>
                  <th>
                    <a class=" btn btn-primary" href="add_products.php">Agregar Nuevo</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php

                $result = mysqli_query($con, "select product_id,product_image, product_title,product_price from products order by product_id desc Limit $page1,12") or die("query 1 incorrect.....");

                while (list($product_id, $image, $product_name, $price) = mysqli_fetch_array($result)) {
                  echo "<tr><td><img src='../../product_images/$image' style='width:50px; height:50px; border:groove #000'></td><td>$product_name</td>
                        <td>$price</td>
                        <td>
                        <a class=' btn btn-success' href='products_list.php?product_id=$product_id&action=delete'>Eliminar</a>
                        <a class=' btn btn-warning' href='update_products.php?product_id=$product_id&action=update'>Actualizar</a>
                        </td></tr>";
                }

                ?>
              </tbody>
            </table>
            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
            </div>
            <div class="ps__rail-y" style="top: 0px; right: 0px;">
              <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
            </div>
          </div>
        </div>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
              <span class="sr-only">Anterior</span>
            </a>
          </li>
          <?php
          //counting paging
          
          $paging = mysqli_query($con, "select product_id,product_image, product_title,product_price from products order by product_id desc");
          $count = mysqli_num_rows($paging);

          $a = $count / 10;
          $a = ceil($a);

          for ($b = 1; $b <= $a; $b++) {
            ?>
            <li class="page-item"><a class="page-link" href="products_list.php?page=<?php echo $b; ?>">
                <?php echo $b . " "; ?>
              </a></li>
          <?php
          }
          ?>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>



    </div>


  </div>
</div>
<?php
include "footer.php";
?>