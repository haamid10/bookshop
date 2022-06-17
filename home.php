<script src="https://cdn.tailwindcss.com"></script>

<!-- Header-->
<div>


  <header class=" bg-[url('./admin/images/h3.jpg')] bg-cover py-6 flex flex-row " >
     <h1></h1>
     <div class="mb-72">
     <!-- <img class="absolute h-screen w-auto ml-72 backdrop-blur-lg " src="./admin/images/h2.jpg" alt=""> -->
     </div>
     <div class="ml-96 mt-32 bg-orange-600 w-96 relative h-screen">
     <h1>.</h1>
     </div>
    <div class=" absolute ml-64 rounded-lg py-12 px-12 inline-block  mt-4 ml-76 w-96  h-screen bg-gray-600 backdrop-blur-xl" >
        <div class="text-left   ">
            <h1 class="font-sans font-bold text-4xl p-2 text-white capitalize">
                Motivating Ways to improve your skills</h1>
            <p class="ont-sans font-light text-md p-2 text-white  ">If you want to make intelligent, get books pretium, magna felis placerat libero, quis tincidunt felis diam nec nisi. Sed scelerisque ullamcorper cursus. Suspendisse posuere, velit nec rhoncus cursus, urna sapien consectetur est, et lacinia odio leo nec massa. Nam vitae nunc vitae tortor vestibulum consequat ac quis risus. Sed finibus pharetra orci, id vehicula tellus eleifend sit amet.

from here.</p>
            <button class=" bg-white text-lg font-semibold  p-2 rounded-sm" ><a class="" href="#about"> Read More </a> </button>
        </div>
    </div>
</header>
<!-- Section-->
 <style class="mt-12  ">
    .book-cover{
        object-fit:contain !important;
        height:auto !important;
    }
</style>
<section class=" bg-gray-300">

.


<div  id="standout" class=" grid grid-cols-2 mt-12">
<div class="ml-96 mt-12 bg-orange-600 w-auto relative h-screen">
        <h1>.</h1>
       
    </div>
    <div  class="order-first absolute">
      <img class="w-auto h-screen rounded-lg" src="./admin/images/n2.jpg " alt="transform image">
    </div>
   
    <div class="text-left py-32 px-8  text-center  ">
      <h1 class="text-left text-6xl capitalize text-orange-600 font-sans font-bold mb-8">Leadership tips to improve skills</h1>
      <p class="text-left text-lg font-sans text-black  tracking-wide mb-10 ">my name is aadil i'm living here last five years ,i have been learning acounting in last five years hustling the nights planing the days you can't imagine what i'm doing alone </p>
      <h3 class=" text-2xl  md:text-xl font-sans font-bold uppercase  border-b-4 border-yellow-300 inline ">learn more</h3>
    </div>
 </div>

</section>
<section class="py-5 bg-gray-200">
    <div class="flex flex-col justify-center m-12">
        <div class=" w-76 p-12  h-auto flex flex-row ">
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
            <div class=" col mb-5 flex flex-col  gap-12 w-36">
                <div class="bg-white  w-72 p-2 rounded-md ">
                    <!-- Product image-->
                    <div class="relative">
                    <img class="w-fit h-80 p-12 " src="<?php echo validate_image($img) ?>" alt="..." />
                    </div>
                    <!-- Product details-->
                    <div class=" font-sans text-center">
                        <div class="">
                            <!-- Product name-->
                            <h5 class="font-bold py-2"><?php echo $row['title'] ?></h5>
                        </div>
                        <div class="absolute top-2 p-2 ">
                            <!-- Product price-->
                            <?php foreach($inv as $k=> $v): ?>
                                <span class=" bg-orange-500 p-2 rounded-lg text-white p-1 "><b>$</b><?php echo $v ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="font-sans text-md"><small class="font-sans  font-bold">© <?php echo $row['author'] ?></small></p>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent mt-12">
                        <div class="text-center">
                            <a class="bg-orange-500  text-white  px-6 py-2 rounded-lg "   href=".?p=view_product&id=<?php echo md5($row['id']) ?>">View</a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>
