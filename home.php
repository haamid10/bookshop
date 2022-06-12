<script src="https://cdn.tailwindcss.com"></script>

<!-- Header-->
<div>


  <header class=" bg-[url('./admin/images/h3.jpg')] bg-cover py-6 flex flex-row " >
     <h1></h1>
     <div class="mb-72">
     <!-- <img class="absolute h-screen w-auto ml-72 backdrop-blur-lg " src="./admin/images/h2.jpg" alt=""> -->
     </div>
    <div class="  relative rounded-lg px-12 inline-block  mt-4 ml-76 w-96  h-auto  backdrop-blur-xl" >
        <div class="text-left   ">
            <h1 class="font-sans font-bold text-4xl p-2 text-white capitalize">
                Motivating Ways to improve your skills</h1>
            <p class="ont-sans font-light text-md p-2 text-white  ">If you want to make intelligent, get books pretium, magna felis placerat libero, quis tincidunt felis diam nec nisi. Sed scelerisque ullamcorper cursus. Suspendisse posuere, velit nec rhoncus cursus, urna sapien consectetur est, et lacinia odio leo nec massa. Nam vitae nunc vitae tortor vestibulum consequat ac quis risus. Sed finibus pharetra orci, id vehicula tellus eleifend sit amet.

from here.</p>
            <button class=" bg-white text-orange-500 p-2 rounded-sm" ><a class="" href="#about"> Read More </a> </button>
        </div>
    </div>
</header>
<!-- Section-->
 <style class="mt-32">
    .book-cover{
        object-fit:contain !important;
        height:auto !important;
    }
</style>




<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php 
                $products = $conn->query("SELECT * FROM `products` where status = 1 order by rand() limit 8 ");
                while($row = $products->fetch_assoc()):
                    $upload_path = base_app.'/uploads/product_'.$row['id'];
                    $img = "";
                    if(is_dir($upload_path)){
                        $fileO = scandir($upload_path);
                        if(isset($fileO[2]))
                            $img = "uploads/product_".$row['id']."/".$fileO[2];
                        // var_dump($fileO);
                    }
                    foreach($row as $k=> $v){
                        $row[$k] = trim(stripslashes($v));
                    }
                    $inventory = $conn->query("SELECT * FROM inventory where product_id = ".$row['id']);
                    $inv = array();
                    while($ir = $inventory->fetch_assoc()){
                        $inv[] = number_format($ir['price']);
                    }
            ?>
            <div class="col mb-5">
                <div class="card product-item">
                    <!-- Product image-->
                    <img class="card-img-top w-100 book-cover" src="<?php echo validate_image($img) ?>" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="fw-bolder"><?php echo $row['title'] ?></h5>
                            <!-- Product price-->
                            <?php foreach($inv as $k=> $v): ?>
                                <span><b>Price: </b><?php echo $v ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="m-0"><small>By: <?php echo $row['author'] ?></small></p>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center">
                            <a class="btn btn-flat btn-primary "   href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
