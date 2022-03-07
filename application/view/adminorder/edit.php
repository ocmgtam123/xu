<?php
$err = $this->getData('err');
$order = $this->getData('order');
$order_detail = $this->getData('order_detail');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Đơn hàng</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div id="nf" class="table-responsive">
                <form name="nf" method="POST" action="<?= URL_BASE ?>/adminorderedit.html/<?= $order['id'] ?>" enctype="multipart/form-data">
                    <div class="col-xs-12">                    
                        <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;"><?= $this->language("l_update_order") ?></h3>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">ID: </p>
                            </div>
                            <div class="col-xs-3">
                                <p class="info_order_account" id="id_account"><?= $order['id'] ?></p>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Code: </p>
                            </div>
                            <div class="col-xs-3">
                                <p class="info_order_account" id="code"><?= $order['code'] ?></p>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Tên khách hàng:  </p>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="inputdefault" name="name" id="name" value="<?= $order['name'] ?>"/>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Số điện thoại:  </p>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="inputdefault" name="phone" value="<?= $order['phone'] ?>"/>                            
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Địa chỉ:  </p>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="inputdefault" name="address" value="<?= $order['address'] ?>"/>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Email:  </p>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="inputdefault" name="email" value="<?= $order['email'] ?>"/>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Khung giờ giao hàng:  </p>
                            </div>
                            <div class="col-xs-9">
                                <p class="info_order_account" id="id_delivery">
                                    <?php if ($order['promotion'] == 0) { ?>
                                        Chỉ giao trong giờ hành chính. Giao hàng từ 8h00 - 18h00, thứ 2 đến thứ 6
                                    <?php } else { ?>
                                        Giao cả tuần (trừ CN & ngày lễ). Giao hàng từ 8h00 - 18h00
                                    <?php } ?>
                                </p>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Trạng thái:  </p>
                            </div>
                            <div class="col-xs-3">
                                <p class="info_order_account" id="status">
                                    <?php if ($order['status'] == 0) {
                                        echo "Khởi tạo";
                                    } ?>
                                    <?php if ($order['status'] == 1) {
                                        echo "Xác nhận";
                                    } ?>
                                    <?php if ($order['status'] == 2) {
                                        echo "Đang vận chuyển";
                                    } ?>
                                    <?php if ($order['status'] == 3) {
                                        echo "Đã giao hàng";
                                    } ?>
                                    <?php if ($order['status'] == 4) {
                                        echo "Hoàn tất";
                                    } ?>
                                    <?php if ($order['status'] == -1) {
                                        echo "Đơn hàng Hủy";
                                    } ?>
                                </p>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Phương thức thanh toán:  </p>
                            </div>
                            <div class="col-xs-9">
                                <p class="info_order_account" id="id_payment">
                                    Thanh toán khi giao hàng
                                </p>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Ghi chú:  </p>
                            </div>
                            <div class="col-xs-6">
                                <textarea name="note" class="inputdefault"><?= $order['note'] ?></textarea>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8">
                                <h5 class="h5tabledetailorder">Sản phẩm đã mua</h5>
                                <table class="tabledetailorder">
                                    <tr>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Tên sản phẩm</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Giá bán</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Số lượng</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;" class="tdright">Thành tiền</th>
                                    </tr>
                                    <?php 
                                    $total=0;
                                    foreach ($order_detail as $od){
                                        $total+=$od["price"]*$od["quatity"];
                                    ?>
                                    <input type="hidden" name="idproduct[]" value="<?=$od["id_product"]?>" />
                                    <input type="hidden" name="price[]" id="hiddenprice<?=$od["id_product"]?>" value="<?=$od["price"]?>" />
                                    <input type="hidden" name="total" id="total<?=$od["id_product"]?>" value="<?=$total?>" />
                                    <tr>
                                        <td><?=$od["name"]?></td>
                                        <td><input class="inputdefault money_format v-numericprice"
                                                    onkeyup="onchangePriceadmin(this.value,<?=$od["id_product"]?>)" 
                                                    onchange="onchangePriceadmin(this.value,<?=$od["id_product"]?>)"
                                                    type="text" name="pricesale[]" id="price<?=$od["id_product"]?>" value="<?= Func::formatPrice($od["price"])?>" />
                                        </td>
                                        <td><input class="inputdefault" onkeyup="onchangeQuantityadmin(this.value,<?=$od["id_product"]?>)" 
                                                   onchange="onchangeQuantityadmin(this.value,<?=$od["id_product"]?>)" 
                                                   style="width: 80px;" type="number" 
                                                   name="quantity[]" id="quantity<?=$od["id_product"]?>" value="<?=$od["quatity"]?>" min="1" 
                                                   oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" /></td>
                                        <td class="tdright total<?=$od["id_product"]?>"><?= Func::formatPrice($od["price"]*$od["quatity"])?></td>
                                    </tr>
                                    <?php } ?>                                    
                                    <tr>
                                        <td colspan="3" class="textalignright">Phí vận chuyển</td>
                                        <td class="tdright">
                                            <input type="text" id="ship" class="inputdefault money_format v-numericprice" maxlength="10" name="fee_delivery" value="<?= Func::formatPrice($order['fee_delivery']); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="textalignright">Tổng tiền</td>
                                        <td class="tdright tong"><?= Func::formatPrice($order['total']+$order['fee_delivery']); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cl"></div>
                        </div>
                        <input type="hidden" id="tonghidden" value="<?=$order['total']?>" />
                        <div class="col-xs-12" style="padding: 10px 0px;">
                            <div class="col-xs-5 textalignright">
                                <a href="<?= $this->route("adminorder") ?>">
                                    <button type="button" class="btn btn-grey btnborderclose">
                                        Danh sách
                                    </button>
                                </a>
                            </div>
                            <div class="col-xs-7 paddingleftright">
                                <input type="submit" class="btn btn-danger" name="btnSumit" value="Cập nhật" />
                            </div><div class="cl"></div>
                        </div>
                        <div class="cl"></div>
                    </div>
                </form>
                <div class="cl"></div>
            </div>
            <!-- /.table-responsive -->            
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<script>
    $(document).ready(function () {
        $("#ship").on('change keydown keyup paste input', function(){
            var totaltotal = 0;
            $("input[name='total']").each(function () {
                totaltotal += parseInt(this.value);
            });
            var ship = this.value;
            ship=ship.replaceAll(",", "");
            if(ship==""){ship=0;}
            var totaltotal_ship = parseInt(totaltotal) + parseInt(ship);
            $(".tong").html(accounting.formatNumber(Math.round(totaltotal_ship), 0, ",", "."));        
        });
        $('#nf form').submit(function(){
            
            var name=$("#name").val();
            if(name==''){
                alert("Bạn chưa nhập tên khách hàng");
                return false;
            }
            var flag=0;
            $("input[name='quantity[]']").each(function () {
                if(this.value==""){
                    flag=1;
                }
            });
            if(flag==1){
                alert("Bạn chưa nhập số lượng");
                return false;
            }
            return true;
        });
    });    
    function onchangeQuantityadmin(quantity,pos){
        var price=$("#price"+pos).val();
        price=price.replaceAll(",", "");
        var total=parseInt(price)*parseInt(quantity);
        $(".total"+pos).html(accounting.formatNumber(Math.round(total), 0, ",", "."));
        $("#total"+pos).val(total);
        
        var totaltotal = 0;
        $("input[name='total']").each(function () {
            totaltotal += parseInt(this.value);
        });
        var ship = $("#ship").val();
        ship=ship.replaceAll(",", "");
        var totaltotal_ship = parseInt(totaltotal) + parseInt(ship);
        $(".tong").html(accounting.formatNumber(Math.round(totaltotal_ship), 0, ",", "."));
    }
    function onchangePriceadmin(price,pos){
        var price=price.replaceAll(",", "");
        if(price==""){price=0;}
        var quantity=$("#quantity"+pos).val();
        var total=parseInt(price)*parseInt(quantity);        
        $(".total"+pos).html(accounting.formatNumber(Math.round(total), 0, ",", "."));
        $("#total"+pos).val(total);
        var totaltotal = 0;
        $("input[name='total']").each(function () {
            totaltotal += parseInt(this.value);
        });
        var ship = $("#ship").val();
        ship=ship.replaceAll(",", "");
        var totaltotal_ship = parseInt(totaltotal) + parseInt(ship);
        $(".tong").html(accounting.formatNumber(Math.round(totaltotal_ship), 0, ",", "."));
        
        $("#hiddenprice"+pos).val(price);
    }
</script>