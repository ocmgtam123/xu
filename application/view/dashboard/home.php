<?php if(isset($_SESSION['ordercomplete'])){?>
<script>
    $(document).ready(function () {
        $("#mess").html('<?=$_SESSION['ordercomplete']?>');
        $('#messModal').modal('show');
        setTimeout(function () {
            $('#messModal').modal('hide');
        }, 2000);       
    });
</script>
    <?php unset($_SESSION['ordercomplete']);?>
<?php }?>
<?php
$producthome = $this->getData('producthome');
?>
<div class="content-center color-row-wt pt-4 pb-60">
    <div class="container">
        <div class="origin">
            <div class="origin-left">
                <div class="origin-right">
                    <h2 class="s-24 font-weight-bold text-center w-auto color-b1">Xoài Úc xuất xứ Cam Lâm, Khánh Hòa</h2>
                    <p class="s-24 text-center w-auto color-b2 pt15">Với trang trại hơn 20ha</p>
                </div>
            </div>
            <div class="list-sale">
                <div class="row">
                    <div class="col-md-4">
                        <div class="list-sale-item">
                            <div class="w-40 text-center"><img src="<?= URL_PUBLIC ?>images/icon-xk.jpg"></div>
                            <div class="w-60 text-left pt-3">
                                <h4 class="color-b1 mb-0">Xuất Khẩu</h4>
                                <span class="color-b2">Xuất khẩu ra các nước</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl1 pr1">
                        <div class="list-sale-item">
                            <div class="w-40 text-center"><img src="<?= URL_PUBLIC ?>images/icon-sl.jpg"></div>
                            <div class="w-60 text-left pt-3">
                                <h4 class="color-b1 mb-0">Bán sỉ - lẻ</h4>
                                <span class="color-b2">Bán theo giá sỉ, lẻ</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="list-sale-item">
                            <div class="w-40 text-center"><img src="<?= URL_PUBLIC ?>images/icon-gh.jpg"></div>
                            <div class="w-60 text-left pt-3">
                                <h4 class="color-b1 mb-0">Giao hàng</h4>
                                <span class="color-b2">Giao hàng miễn phí</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-center color-row pbb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-5 pb-4"><h2 class="color-b1 s-30 font-weight-bold">Sản Phẩm</h2></div>
            
            
            <?php foreach ($producthome as $ph){?>
            <div class="col-md-3 mtt-2">
                <div class="box-product">
                    <div class="product-item-1">
                    	<img alt="" src="<?=URL_BASE?>/upload/product/pro-1.jpg" style="width: 100%;height: 230px;object-fit: cover;">
                    </div>
                </div>
                <div class="box-product mt-2">
                    <div class="product-item-2">
                    	<img alt="" src="<?=URL_BASE?>/upload/product/pro-2.jpg" style="width: 100%;height: 230px;object-fit: cover;">
                    </div>
                </div>
            </div>
            <div class="col-md-6 pl-1 pr-1 mtt-2 pl1 pr1">
                <div class="box-product">
                    
                    <div class="product-item-3 position-relative">
                    	<img alt="" src="<?=URL_BASE?><?=$ph['image']?>" style="width: 100%;height: 375px;object-fit: cover;">
                        <div class="title-product">
                            <h3 class="mb-0"><a href="#"><?=$ph["name"]?></a></h3>
                        </div>
                    </div>
                    <div class="product-info">
                        <div class="price_product s-24 mt-2">
                            <div class="float-right">
                                <span class="color-b1 lh30 hidden-sm">Giá:</span>
                                <?php if($ph["price"]!=$ph["pricesale"]){?>
                                <span style="font-size: 14px; text-decoration: line-through;">
                                    <?= Func::formatPrice($ph["price"])?>
                                </span> 
                                <?php }?>
                                <span class="color-or lh30"> 
                                    <?= Func::formatPrice($ph["pricesale"])?>
                                </span> đ 
                            </div>                                 
                        </div>
                        <input type="hidden" id="hiddenprice<?=$ph["id"]?>" value="<?=$ph["price"]?>" />
                        <div class="quantity_product">                           
                            <div class="mr-2">
                                <select onchange="onchangeQuantity(this.value,<?=$ph["id"]?>)" name="quantity" id="quantity<?=$ph["id"]?>" class="form-control">
                                    <?php for ($i = 5; $i < 100; $i+=5) { ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?php } ?>                                    
                                </select>
                            </div>
                            <div class="lh30 white-space-nowrap">
                                <span class="s-18 font-weight-bold" id="total<?=$ph["id"]?>"> 
                                    <?= Func::formatPrice($ph["price"]*5)?>
                                </span> đ
                            </div>                  
                        </div>
                        <div class="w-30 mt-2 text-center">
                            <button type="button" class=" btn-warning btn btn-cart" onclick="addCart(<?=$ph["id"]?>)">
                                <span class="hidden-sm">Mua hàng</span>
                                <i style="color: #fff!important; font-size: 16px;" class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="line-b jus-center color-b1 pt-1">
                                <div class="w-auto m-0 m-auto row">
                                    <span class="col-md-12 md6w100 text-center">Số lượng từ <span class="color-or">100kg</span> Quý Khách vui lòng liên hệ <strong>hotline: <?=HOTLINE?></strong> <br>hoặc <strong>email: <?=EMAIL?></strong> để được tư vấn và hỗ trợ tốt nhất</span>
                                </div>                                 
                            </div>                                 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mtt-2">
                <div class="box-product">
                    <div class="product-item-4">
                    	<img alt="" src="<?=URL_BASE?>/upload/product/pro-4.jpg" style="width: 100%;height: 230px;object-fit: cover;">
                    </div>
                </div>
                <div class="box-product mt-2">
                    <div class="product-item-5">
                    	<img alt="" src="<?=URL_BASE?>/upload/product/pro-5.jpg" style="width: 100%;height: 230px;object-fit: cover;">
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<div class="content-center color-row-wt pbb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center ptt-5 pb-4 mb-4">
                <h2 class="color-b1 s-30 font-weight-bold">Đôi nét về Xoài Úc Cam Lâm</h2>
                <p class="color-b2">Vùng trồng: Huyện Cam Lâm, tỉnh Khánh Hoà</p>
            </div>
            <div class="col">                     
                <div class="w-100 mh200">
                    <div class="title-green pb-2"><span>Đặc trưng khác biệt</span></div>
                    <div class="blog-item color-b2 pb-2">
                        <p class="text-justify lh18">Hạt nhỏ. Độ Ngọt (Brix 12-14%) vừa phải không gắt, ít sơ. Hương thơm đặc trưng và Màu sắc lúc chín bắt mắt hấp dẫn.</p> 
                        <p>Ưu điểm của giống này là mẫu mã và hương thơm.</p>
                    </div>
                </div>  
                <div class="w-100 mh200">
                    <div class="title-green pb-2"><span>Thời gian bảo quản</span></div>
                    <div class="blog-item color-b2 pb-2">
                        <p class="text-justify lh18">17- 20 ngày.10 ngày từ lúc hái đến khi chín hoàn toàn.7 ngày bảo quản lạnh vẫn đảm bảo chất lượng.</p>
                        <p>Xoài ăn ngon nhất khi chín tới</p>
                    </div>
                </div>                   
            </div>
            <div class="col-md-5">
                <p class="text-center"><img class="responsive" alt="Xoài Úc Cam Lâm" src="<?= URL_PUBLIC ?>images/blog-img-1.jpg"></p>
            </div>
            <div class="col">
                <div class="w-100 mh230">
                    <div class="title-green pb-2"><span>Mùa xoài</span></div>
                    <div class="blog-item color-b2 pb-2">
                        <p class="text-justify lh18">
                            - Tháng 3 đến hết tháng 7 dương lịch. <br>
                            - Từ tháng 11 đến tháng 2 năm sau.
                        </p>
                    </div>
                </div>  
                <div class="w-100 mh200">
                    <div class="title-green pb-2"><span>Thời gian thu và trọng lượng</span></div>
                    <div class="blog-item color-b2 pb-2">
                        <p class="text-justify lh18">Đây là giống đa phôi, thuộc nhóm chín trung bình, thời gian từ ra hoa đến thu hoạch 4,5 tháng.</p>
                        <p>Trái to, thịt dày, chắc, hạt lép; trọng lượng trung bình 800g – 1.000g/trái.</p>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
<div class="content-center color-row">
    <div class="container">
        <div class="row">
            <div class="col-md-12 pt-3 pb-3">
                <?=$info["maphome"]?>
            </div>
        </div>
    </div>
</div>