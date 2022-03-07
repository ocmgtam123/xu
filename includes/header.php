<?php
$action = isset($this->_params['action']) ? $this->_params['action'] : 'home';
$controller = isset($this->_params['controller']) ? $this->_params['controller'] : 'dashboard';

$info = $this->getData('info');

?>
<div class="header-top">
            <div class="container p0">
               <div class="row">
                  <div class="col-md-5 hidden-sm hd">
                     <span class="lh34"><?=$info["title"]?></span>
                  </div>
                  <div class="col-md-7 md7w100" style="justify-content: center;">
                     <div class="w-auto">
                        <span class="lh34">
                           <i style="color: #356a02!important; font-size: 14px" class="fa fa-phone" aria-hidden="true"></i> <span class="hidden-sm">Hotline:</span> <?=$info["hotline"]?>
                        </span>
                        <span class="lh34 ml-3">
                           <i style="color: #356a02!important; font-size: 14px" class="fa fa-envelope" aria-hidden="true"></i> <span class="hidden-sm">Email:</span> <?=$info["email"]?>
                        </span>
                        <span class="ml-3 float-right lh34 hidden-ssm pr2">
                            <?php foreach ($follow as $fl){?>
                            <a style="text-decoration: none;" class="p-1" href="<?=$fl["link"]?>" target="_blank">
                               <i style="color: #356a02!important; font-size: 14px" class="fa <?=$fl["icon"]?>" aria-hidden="true"></i>
                            </a>
                            <?php }?>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="header-bottom">
            <div class="container p0">
               <nav class="navbar navbar-expand-md navbar-dark">
                  <a class="navbar-brand" href="<?=URL_BASE?>">
                      <img style="width: 159px; height: 96px; object-fit: cover;" src="<?=URL_BASE.$info["logo"]?>">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                     <i style="color: #333!important" class="fa fa-bars" aria-hidden="true"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="collapsibleNavbar">
                     <ul class="navbar-nav">
                        <li class="nav-item <?php if($action == 'home') echo "active";?>">
                          <a class="nav-link" href="<?=$this->route('home')?>">Trang chủ</a>
                        </li>
                        <li class="nav-item <?php if($action == 'about') echo "active";?>">
                          <a class="nav-link" href="<?=$this->route('about')?>">Giới thiệu</a>
                        </li>
                        <li class="nav-item <?php if($action == 'product') echo "active";?>">
                          <a class="nav-link" href="<?=$this->route('product')?>">Sản phẩm</a>
                        </li>  
                        <li class="nav-item <?php if($action == 'news' || $action == 'newsdetail') echo "active";?>">
                          <a class="nav-link" href="<?=$this->route('news')?>">Tin tức</a>
                        </li>
                        <li class="nav-item <?php if($action == 'contact') echo "active";?>">
                          <a class="nav-link" href="<?=$this->route('contact')?>">Liên hệ</a>
                        </li>    
                     </ul>
                 </div>  
                 <div class="cart">
                     <a href="<?=$this->route('cart')?>">
                        <div class="ic-cart mr-2">
                          <i style="color: #ff9c00!important; font-size: 16px;" class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>
                        <span>Giỏ hàng</span> 
                        <?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) { $countsp=count($_SESSION["cart"]);}else{$countsp=0;}?>
                        <span id="amountCart">(<?=$countsp?>)</span>
                     </a>
                  </div>
               </nav>       
            </div>
         </div>