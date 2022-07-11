<!-- flex flex-row items-center gap-12 py-6 -->
<!-- flex flex-col bg-gray-100 drop-shadow-xl h-20 items-center justify-start -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- navbar navbar-expand-lg navbar-light bg-light -->



<nav class=" navbar navbar-expand-lg navbar-light  ">

         
<div class=" flex flex-row items-center justify-between gap-12 py-6 h-32 bg-blue-200   shadow-lg shadow-gray-900 m-3 rounded-xl">
                <!-- <button class="" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->

                <div class="ml-0 mb-2 mt-4 p-3 ">
              

                <a class="  " href="./">
                <img class="h-28 w-auto p-2 m-4" src="<?php echo validate_image($_settings->info('logo')) ?>"  alt="" loading="lazy">
               
                </a>
                </div>

                <form class="  rounded-lg" id="search-form">
                  <div class="flex ">
                    <input class="form-control form-control-sm form border-2 border-gray-900" type="search" placeholder="Search" aria-label="Search" name="search"  value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>"  aria-describedby="button-addon2">
                    <div class="">
                      <button class="w-8 h-8 outline-none border-2 border-gray-900 rounded-r-lg bg-gray" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
                <div class="flex flex-row items-center justify-between m-72" id="navbarSupportedContent">
                    <ul class="flex flex-row   ">
                        <li class="font-sans capitalize font-bold text-black"><a class="nav-link" aria-current="page" href="./">Home</a></li>
                        <?php 
                        $cat_qry = $conn->query("SELECT * FROM categories where status = 1  limit 3");
                        $count_cats =$conn->query("SELECT * FROM categories where status = 1 ")->num_rows;
                        while($crow = $cat_qry->fetch_assoc()):
                          $sub_qry = $conn->query("SELECT * FROM sub_categories where status = 1 and parent_id = '{$crow['id']}'");
                          if($sub_qry->num_rows <= 0):
                        ?>
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="./?p=products&c=<?php echo md5($crow['id']) ?>"><?php echo $crow['category'] ?></a></li>
                        
                        <?php else: ?>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" id="navbarDropdown<?php echo $crow['id'] ?>" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><?php echo $crow['category'] ?></a></a>
                            <ul class="dropdown-menu  p-0" aria-labelledby="navbarDropdown<?php echo $crow['id'] ?>">
                              <?php while($srow = $sub_qry->fetch_assoc()): ?>
                                <li><a class="dropdown-item border-bottom" href="./?p=products&c=<?php echo md5($crow['id']) ?>&s=<?php echo md5($srow['id']) ?>"><?php echo $srow['sub_category'] ?></a></li>
                            <?php endwhile; ?>
                            </ul>
                        </li>
                        <?php endif; ?>
                        <?php endwhile; ?>
                        <?php if($count_cats > 3): ?>
                        <li class="nav-item"><a class="nav-link" href="./?p=view_categories">All Categories</a></li>
                        <?php endif; ?>
                        <li id="about" class="nav-item"><a class="nav-link" href="./?p=about">About</a></li>
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