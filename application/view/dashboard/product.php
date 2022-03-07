<?php
$producthome = $this->getData('producthome');
?>
<div class="content-center color-row pbb-5">
    <div class="container p0">
        <div class="row">
       		<?php foreach ($producthome as $ph){?>
            <div class="col-md-12 text-center pt-5 pb-4"><h2 class="color-b1 s-30 font-weight-bold">Sản Phẩm</h2></div>
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
            <div class="col-md-6 pl-1 pr-1 mtt-2">
                <div class="box-product">
                    
                    <div class="product-item-3 position-relative">
                    	<img alt="" src="<?=URL_BASE?><?=$ph['image']?>" style="width: 100%;height: 375px;object-fit: cover;">
                        <div class="title-product">
                            <h3 class="mb-0"><a href="#"><?=$ph["name"]?></a></h3>
                        </div>
                    </div>
                    <input type="hidden" id="hiddenprice<?=$ph["id"]?>" value="<?=$ph["price"]?>" />
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
            
            
        </div>
        <div class="row">
            <div class="col-md-12 text-center mt-5 mb-3">
                <h4 class="color-b1 s-18 text-uppercase">Thông tin sản phẩm</h4>
            </div>
            <div class="col-md-12">
                <div class="box-product color-b1 p-4">
                    <?=$ph["content"]?>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>

<script> 
    function onchangeQuantity(quantity,pos){
        var price=$("#hiddenprice"+pos).val();
        var total=parseInt(price)*parseInt(quantity);
        $("#total"+pos).html(accounting.formatNumber(Math.round(total), 0, ",", "."));
    }
</script>