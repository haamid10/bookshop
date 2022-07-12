<!-- flex flex-row items-center gap-12 py-6 -->
<!-- flex flex-col bg-gray-100 drop-shadow-xl h-20 items-center justify-start -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- navbar navbar-expand-lg navbar-light bg-light -->



 <nav class="border-b md:flex md:items-center md:justify-between p-4 pb-0 shadow-lg md:pb-4 h-24 bg-blue-50">

         

          

               
              
                <!-- logo -->
                <div class="flex items-center justify-between mb-4 md:mb-0 mr-12"> 
                <a class="no-underline text-grey-darkest hover:text-black" href="./">
                <img class="w-12 h-auto" src="<?php echo validate_image($_settings->info('logo')) ?>"  alt="" loading="lazy">
                  <?php echo $_settings->info('short_name') ?>
                 </a>
                 </div>

                 <!-- search button -->

                 <form class="mb-4 w-full md:mb-0 md:w-1/4" id="search-form">
   
    
                  <input class="bg-grey-lightest border-2 focus:border-orange p-2 rounded-lg shadow-inner w-full" type="search" placeholder="Search" aria-label="Search" name="search"  value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>"  aria-describedby="button-addon2">
  
                     <button class="hidden">Submit</button>
                    </form>
                <div class="flex  items-center justify-between" id="navbarSupportedContent">
                    <ul class="list-reset md:flex items-center justify-between">
                    <li class="md:mr-4">
                     <a class="block font-bold no-underline  py-2 text-grey-darkest   md:border-none md:p-0 hover:text-blue-500" aria-current="page" href="./">
                         Home
                      </li>
                        <?php 
                        $cat_qry = $conn->query("SELECT * FROM categories where status = 1  limit 3");
                        $count_cats =$conn->query("SELECT * FROM categories where status = 1 ")->num_rows;
                        while($crow = $cat_qry->fetch_assoc()):
                          $sub_qry = $conn->query("SELECT * FROM sub_categories where status = 1 and parent_id = '{$crow['id']}'");
                          if($sub_qry->num_rows <= 0):
                        ?>
                        <li class="flex items-center md:ml-4">
                     <a class="block no-underline hover:underline py-2 text-grey-darkest gap-12 hover:text-black md:border-none md:p-0" aria-current="page" 
                      href="./?p=products&c=<?php echo md5($crow['id']) ?>"><?php echo $crow['category'] ?></a></li>
                        
                        <?php else: ?>
                     
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php if($count_cats > 3): ?>
                        <li class="flex items-center md:ml-4"><a class="block no-underline font-bold hover:underline py-2 text-grey-darkest gap-12 hover:text-blue md:border-none md:p-0" href="./?p=view_categories">Categories</a></li>
                        <?php endif; ?>
                        <li id="about" class="font-sans capitalize font-bold text-black p-2 m-2 gap-12 "><a class="" href="./?p=about">About</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                      <?php if(!isset($_SESSION['userdata']['id'])): ?>
                        <button class="btn btn-outline-dark ml-2" id="login-btn" type="button">Login</button>
                        <?php else: ?>
                        <a class="text-dark mr-2 nav-link" href="./?p=cart">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill" id="cart-count">
                              <?php 
                              if(isset($_SESSION['userdata']['id'])):
                                $count = $conn->query("SELECT SUM(quantity) as items from `cart` where client_id =".$_settings->userdata('id'))->fetch_assoc()['items'];
                                echo ($count > 0 ? $count : 0);
                              else:
                                echo "0";
                              endif;
                              ?>
                            </span>
                        </a>
                        
                            <a href="./?p=my_account" class="text-dark  nav-link"><b> Hi, <?php echo $_settings->userdata('firstname')?>!</b></a>
                            <a href="logout.php" class="text-dark  nav-link"><i class="fa fa-sign-out-alt"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            </div>
        </nav> 

<script>
  $(function(){
    $('#login-btn').click(function(){
      uni_modal("","login.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function () {
        if($('body').offset.top == 0)
          $('#mainNav').removeClass('navbar-shrink')
    })
  })

  $('#search-form').submit(function(e){
    e.preventDefault()
     var sTxt = $('[name="search"]').val()
     if(sTxt != '')
      location.href = './?p=products&search='+sTxt;
  })
</script>