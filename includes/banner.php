<?php
$action = isset($this->_params['action']) ? $this->_params['action'] : 'home';
$controller = isset($this->_params['controller']) ? $this->_params['controller'] : 'dashboard';
if($action=='home'){
?>

<div class="banner">
     <div id="demo" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ul class="carousel-indicators">
           <li data-target="#" data-slide-to="0" class="active"></li>
           <li data-target="#" data-slide-to="1"></li>
           <li data-target="#" data-slide-to="2"></li>
        </ul>
       
        <!-- The slideshow -->
        <div class="carousel-inner">
           <div class="carousel-item active">
             <img src="<?=URL_PUBLIC?>images/banner-1.jpg" alt="Xoài Úc Cam Lâm" width="100%" height="auto">
           </div>
           <!-- <div class="carousel-item">
             <img src="images/banner-2.jpg" alt="Xoài Úc Cam Lâm" width="100%" height="auto">
           </div>
           <div class="carousel-item">
             <img src="images/banner-3.jpg" alt="Xoài Úc Cam Lâm" width="100%" height="auto">
           </div> -->
        </div>
       
        <!-- Left and right controls -->
        <a class="carousel-control-prev" href="#" data-slide="prev">
           <span class="carousel-control-prev-icon"></span>
        </a>
        <a class="carousel-control-next" href="#" data-slide="next">
           <span class="carousel-control-next-icon"></span>
        </a>
     </div>
  </div>
  <?php }else{
      if($action=='about')   $nameTitle= "Giới thiệu";
      if($action=='product') $nameTitle= "Sản phẩm";
      if($action=='news' || $action=='newsdetail')    $nameTitle= "Tin Tức";
      if($action=='contact') $nameTitle= "Liên hệ";
      if($action=='cart') $nameTitle= "Giỏ hàng";
      ?>
  <div class="banner-small">
         <div class="banner-header">
            <div class="w-auto m-0 m-auto display-table">
               <div class="title">
                  <h2><?=$nameTitle ?></h2>
               </div>
               <nav aria-label="breadcrumb" class="w-auto m-auto m-0 display-table">
                 <ol class="breadcrumb">
                   <li class="breadcrumb-item"><a href="<?=$this->route('home')?>">Trang chủ</a></li>
                   <li class="breadcrumb-item active" aria-current="page"><?=$nameTitle ?></li>
                 </ol>
               </nav>
            </div>
         </div>
      </div>
  <?php }?>