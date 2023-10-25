  <?php 
include("../../db.php");
 
  ?>

  <div class="row" style="padding-top: 10vh;">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">people</i>
                  </div>
                  <p class="card-category">Total de Usuarios</p>
                  <h3 class="card-title">
                      <?php  $query = "SELECT user_id FROM user_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?>
                  </h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Total de Categorías</p>
                  <h3 class="card-title"> <?php  $query = "SELECT cat_id FROM categories"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                    { 
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($result); 
                          
                        printf(" " . $row); 
                    
                        // close the result. 
                    } ?></h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                      <i class="material-icons">insert_emoticon</i>
                  </div>
                  <p class="card-category">Total de Compradores</p>
                  <h3 class="card-title"><?php  $query = "SELECT user_id FROM user_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                    { 
                        // it return number of rows in the table. 
                        $row = mysqli_num_rows($result); 
                          
                        printf(" " . $row); 
                    
                        // close the result. 
                    } ?></h3>
              </div>

          </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                  <i class="material-icons">list_alt</i>
                  </div>
                  <p class="card-category">Total de Órdenes</p>
                  <h3 class="card-title"><?php  $query = "SELECT order_id FROM orders_info"; 
                                      $result = mysqli_query($con, $query); 
                                       if ($result) 
                        { 
                            // it return number of rows in the table. 
                            $row = mysqli_num_rows($result); 
                              
                            printf(" " . $row); 
                        
                            // close the result. 
                        }  ?></h3>
              </div>

          </div>
      </div>
  </div>