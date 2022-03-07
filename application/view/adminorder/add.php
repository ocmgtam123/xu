<?php
$err = $this->getData('err');
$list = $this->getData('list');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Đơn hàng
            <span> -> Tạo đơn hàng</span>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright" style="padding-top: 0px;">
            <div id="nf" class="table-responsive">
                <form name="nf" method="POST" action="<?= URL_BASE ?>/adminorderadd.html" enctype="multipart/form-data">
                    <div class="col-xs-12">
                        <div class="col-xs-12 paddingleftright" style="padding: 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">&nbsp;</p>
                            </div>
                            <div class="col-xs-9 form_item_error">
                                <?= $err ?>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Tên khách hàng:  </p>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="inputdefault" name="name" id="name" value="" placeholder="Tên khách hàng" />
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Số điện thoại:  </p>
                            </div>
                            <div class="col-xs-3">
                                <input type="text" class="inputdefault" name="phone" value="" placeholder="Số điện thoại"/>                            
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Địa chỉ:  </p>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="inputdefault" name="address" value="" placeholder="Địa chỉ"/>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Email:  </p>
                            </div>
                            <div class="col-xs-6">
                                <input type="text" class="inputdefault" name="email" value="" placeholder="Email"/>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Khung giờ giao hàng:  </p>
                            </div>
                            <div class="col-xs-9">
                                <input style="display: block;width: 20px;margin-top: 3px;margin-right: 5px;float: left;" type="radio" name="promotion" checked="checked" id="tranfer1" value="0">
                                <label style="font-weight: normal;" for="tranfer1">
                                    Chỉ giao trong giờ hành chính<br/>
                                    <i style="font-size: 13px;">Giao hàng từ 8h00 - 18h00, thứ 2 đến thứ 6</i>
                                </label><br>
                                <input style="display: block;width: 20px;margin-top: 3px;margin-right: 5px;float: left;" type="radio" name="promotion" id="tranfer2" value="1">
                                <label style="font-weight: normal;" for="tranfer2">
                                    Giao cả tuần (trừ CN & ngày lễ)<br/>
                                    <i style="font-size: 13px;">Giao hàng từ 8h00 - 18h00</i>
                                </label>
                            </div><div class="cl"></div>
                        </div>                        
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-3 textalignright paddingleftright">
                                <p class="p_nametype">Ghi chú:  </p>
                            </div>
                            <div class="col-xs-6">
                                <textarea name="note" class="inputdefault" placeholder="Ghi chú ..."></textarea>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 5px 0px;">
                            <div class="col-xs-2"></div>
                            <div class="col-xs-8">
                                <h5 class="h5tabledetailorder">Sản phẩm</h5>
                                <table class="tabledetailorder">
                                    <tr>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Tên sản phẩm</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Giá bán</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;">Số lượng</th>
                                        <th style="border-bottom: 1px solid #ccc;border-left: 1px solid #ccc; padding: 5px;" class="tdright">Thành tiền</th>
                                    </tr>
                                    <?php 
                                    $total=0;
                                    foreach ($list as $li){
                                        $total+=$li["price"]*5;
                                    ?>
                                    <input type="hidden" name="id[]" value="<?=$li["id"]?>" />
                                    <input type="hidden" name="price[]" id="hiddenprice<?=$li["id"]?>" value="<?=$li["pricesale"]?>" />
                                    <input type="hidden" name="total" id="total<?=$li["id"]?>" value="<?=$li["pricesale"]*5?>" />
                                    <tr>
                                        <td><?=$li["name"]?></td>
                                        <td>
                                            <input class="inputdefault money_format v-numericprice"
                                                    onkeyup="onchangePriceadmin(this.value,<?=$li["id"]?>)" 
                                                    onchange="onchangePriceadmin(this.value,<?=$li["id"]?>)"
                                                    type="text" name="pricesale[]" id="price<?=$li["id"]?>" value="<?= Func::formatPrice($li["pricesale"])?>" /> 
                                        </td>
                                        <td>
                                            <input class="inputdefault" onkeyup="onchangeQuantityadmin(this.value,<?=$li["id"]?>)" 
                                                   onchange="onchangeQuantityadmin(this.value,<?=$li["id"]?>)" 
                                                   style="width: 80px;" type="number" 
                                                   name="quantity[]" id="quantity<?=$li["id"]?>" value="5" min="1" 
                                                   oninput="this.value = !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" />                                            
                                        </td>
                                        <td class="tdright total<?=$li["id"]?>"><?= Func::formatPrice($li["pricesale"]*5)?></td>
                                    </tr>
                                    <?php } ?>                                    
                                    <tr>
                                        <td colspan="3" class="textalignright">Phí vận chuyển</td>
                                        <td class="tdright">
                                            <input type="text" id="ship" autocomplete="off" class="inputdefault money_format v-numericprice" maxlength="10" name="fee_delivery" value="0"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="textalignright">Tổng tiền</td>
                                        <td class="tdright tong"><?= Func::formatPrice($total)?></td>
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
                                <input type="submit" class="btn btn-danger" name="btnSumit" value="Tạo đơn hàng" />
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