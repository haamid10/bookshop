<!-- Favicons -->
<link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
 

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <main id="main" class="main">




        

<div class="pagetitle">
  <h1 class="m-4">Dashboard</h1>
  <h1 class="text-xl">Welcome to <?php echo $_settings->info('name') ?></h1>
  
</div><!-- End Page Title -->

  <section class="section dashboard">

      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

               
                <div class="card-body">
                  <h5 class="card-title">total books </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>
                      <?php 
                    $inv = $conn->query("SELECT sum(quantity) as total FROM inventory ")->fetch_assoc()['total'];
                    $sales = $conn->query("SELECT sum(quantity) as total FROM order_list where order_id in (SELECT order_id FROM sales) ")->fetch_assoc()['total'];
                    echo number_format($inv - $sales);
                  ?></h6>
                     

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

               
                <div class="card-body">
                  <h5 class="card-title">Pending orders</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php 
                    $pending = $conn->query("SELECT sum(id) as total FROM `orders` where status = '0' ")->fetch_assoc()['total'];
                    echo number_format($pending);
                  ?></h6>
                     

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

             

                <div class="card-body">
                  <h5 class="card-title">total sales </h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6> <?php 
                    $sales = $conn->query("SELECT sum(amount) as total FROM `orders` where status = '0' ")->fetch_assoc()['total'];
                    echo number_format($sales);
                  ?></h6>
                      
                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

           
                <div class="card-body">

                <h4 class="card-title"><?php echo $_settings->info('name') ?> Sales Report <?php echo $date_start ?>-   and <?php echo $date_end ?></h4>
                <p class=""> </p>






    <?php 
$date_start = isset($_GET['date_start']) ? $_GET['date_start'] :  date("Y-m-d",strtotime(date("Y-m-d")." -7 days")) ;
$date_end = isset($_GET['date_end']) ? $_GET['date_end'] :  date("Y-m-d") ;
?>
                
                
                  

                  <!-- Line Chart -->
          

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

               

                <div class="card-body">
            
                
            
                  

                  <table class="table table-borderless datatable">
                    <thead>
                    <tr>
                        <th class="col">#</th>
                        <th class="col">Date Time</th>
                        <th class="col">Book</th>
                        <th class="col">Client</th>
                        <th class="col">QTY</th>
                        <th class="col">Amount</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tbody>
                    <?php 
                    $i = 1;
                        $qry = $conn->query("SELECT * FROM `sales` where date(date_created) between '{$date_start}' and '{$date_end}' order by unix_timestamp(date_created) desc ");
                        while($row = $qry->fetch_assoc()):
                            $olist = $conn->query("SELECT ol.*,p.title,p.author,concat(c.firstname,' ',c.lastname) as name,c.email,o.date_created FROM order_list ol inner join orders o on o.id = ol.order_id inner join `products` p on p.id = ol.product_id inner join clients c on c.id = o.client_id  where ol.order_id = '{$row['order_id']}' ");
                            while($roww = $olist->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-primary"><?php echo $i++ ?></td>
                        <td><?php echo $row['date_created'] ?></td>
                        <td>
                            <p class="m-0"><?php echo $roww['title'] ?></p>
                            <p class="m-0"><small>By: <?php echo $roww['author'] ?></small></p>
                        </td>
                        <td>
                            <p class="text-primary" "><?php echo $roww['name'] ?></p>
                            <p cl class="text-primary"><small>Email: <?php echo $roww['email'] ?></small></p>
                        </td>
                        <td class="mr-12  "><?php echo $roww['quantity'] ?></td>
                        <td class="badge bg-danger ml-12"><?php echo number_format($roww['quantity'] * $roww['price']) ?></td>
                    </tr>
                    <?php endwhile; ?>
                    <?php endwhile; ?>
                    <?php if($qry->num_rows <= 0): ?>
                    <tr>
                        <td class="text-primary" colspan="6">No Data...</td>
                    </tr>
                    <?php endif; ?>
              
                    </tbody>
                    </tbody>
                  </table>

                </div>

              </div>
            </div>

          </div>
        </div><!-- End Left side columns -->

      
</section>

        </main>