<?php
$action = isset($this->_params['action']) ? $this->_params['action'] : 'index';
$controller = isset($this->_params['controller']) ? $this->_params['controller'] : 'admindashboard';
?>
<li class="sidebar-search">
    <div class="custom-search-form" style="text-align: center;">
        <img style="max-width: 100%" src="<?=URL_BASE?>/public/images/logo.png"/>
    </div>
    <!-- /input-group -->
</li>
<!--<li>
    <a href="<?= $this->route('admindashboard') ?>" <?php if($controller=="admindashboard"){ ?> class="active"<?php }?>>
        <i class="fa fa-television"></i> Banner
    </a>
</li>-->
<li>
    <a href="<?= $this->route('adminproduct') ?>" <?php if($controller=="adminproduct"){ ?> class="active"<?php }?>>
        <i class="fa fa-table fa-fw"></i> Sản phẩm
    </a>
</li>
<li>
    <a href="<?= $this->route('adminorder') ?>" <?php if($controller=="adminorder"){ ?> class="active"<?php }?>>
        <i class="fa fa-shopping-cart"></i>&nbsp; Đơn hàng
    </a>
</li>
<li>
    <a href="<?= $this->route('adminfollow') ?>" <?php if($controller=="adminfollow"){ ?> class="active"<?php }?>>
        <i class="fa fa-eye"></i> Mạng xã hội
    </a>
</li>
<li>
    <a href="<?= $this->route('adminnews') ?>" <?php if($controller=="adminnews"){ ?> class="active"<?php }?>>
        <i class="fa fa-newspaper-o"></i> Tin tức
    </a>
</li>
<li>
    <a href="<?= $this->route('admininformation') ?>" <?php if($controller=="admininformation"){ ?> class="active"<?php }?>>
        <i class="fa fa-info-circle"></i> 
        Thông tin
    </a>
</li>
<li>
    <a href="<?= $this->route('adminuser') ?>" <?php if($controller=="adminuser"){ ?> class="active"<?php }?>>
        <i class="fa fa-users"></i> Tài khoản
    </a>
</li>

