<div class="modal" id="thietlapdiachi" data-backdrop="static">
    <div class="modal-dialog" role="document" style="margin-top: 10%; max-width: 390px;">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title color-b1 s-18"><span>Thêm địa chỉ mới</span></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Họ & Tên" id="f_hoten">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Số điện thoại" id="f_phone">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Email" id="f_email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tỉnh/Thành phố" id="f_tinhthanh">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Quận/Huyện" id="f_quanhuyen">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Phường/Xã" id="f_xa">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tòa nhà/Tên đường" id="f_duong">
                </div>
                <div class="w-100 justify-content-center text-center">
                    <button type="button" onclick="btnclose();" class="btn btn-or">Cancel</button>
                    <button type="button" onclick="btnok();" class="btn btn-or">Hoàn thành</button>
                </div>    
            </div>  
        </div>
    </div>
</div>
<?php if (isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) { ?>
<div id="nf">
    <form name="nf" method="POST" action="<?= $this->route('cart') ?>" enctype="multipart/form-data">
        <div class="content-center color-row pbb-5 ptt-5">
            <div class="container"> 
                <div class="dataTables_wrapper no-footer">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table display data-table text-nowrap dataTable no-footer">
                                <thead class="hidden-sm">
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc ">
                                            <div class="display-flex row">
                                                <div style="width: 5%" class="text-center font-weight-bold">STT</div>
                                                <div style="width: 45%" class="text-left font-weight-bold">Sản phẩm</div>
                                                <div style="width: 15%" class="text-center font-weight-bold">Giá</div>
                                                <div style="width: 10%" class="text-center font-weight-bold">Số lượng</div>
                                                <div style="width: 20%" class="text-center font-weight-bold">Số tiền</div>
                                                <div style="width: 5%" class="text-center font-weight-bold"></div>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <input type="hidden" name="ship" value="30000" />
                                <input type="hidden" name="email" id="email" value="" />
                                <input type="hidden" name="name" id="name" value="" />
                                <input type="hidden" name="phone" id="phone" value="" />
                                <input type="hidden" name="address" id="address" value="" />
                                <tbody>    
                                    <?php
                                    $total = 0;
                                    $k = 1;
                                    $ship = 30000;
                                    foreach ($_SESSION["cart"] as $key => $ca) {
                                        $total += $ca["pricesale"] * $ca["quantity"];
                                        ?>
                                    <input type="hidden" name="id[]" id="" value="<?= $key ?>" />
                                    <input type="hidden" name="price[]" id="hiddenprice<?= $key ?>" value="<?= $ca["pricesale"] ?>" />
                                    <input type="hidden" name="total" id="totalhidden<?= $key ?>" value="<?= $ca["pricesale"] * $ca["quantity"] ?>" />
                                    <tr id="rowcartproduct<?= $key ?>" class="color-row-wt">
                                        <td>
                                            <div class="display-flex row flex-wrap-no display-flex">
                                                <div class="text-center title_prcart w1 pl-2">
                                                    <p class="title_prcart-name">
                                                        <?= $k ?>
                                                    </p>
                                                </div>
                                                <div class="text-center w2">
                                                    <div class="pro-cart">
                                                        <div class="imgcart">
                                                            <img src="<?= URL_BASE . $ca["image"] ?>" width="100%" alt="<?= $ca["name"] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-left display-flex-no w3">
                                                    <div class="pro-cart col-pro">
                                                        <div class="title_prcart pl-2 pr-2">
                                                            <p class="title_prcart-name"><?= $ca["name"] ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="text-center title_prcart col-pri">
                                                        <p class="title_prcart-name text-center">
                                                            <?php if($ca["price"]!=$ca["pricesale"]){?>
                                                            <span style="font-size: 14px; text-decoration: line-through;">
                                                                <?= Func::formatPrice($ca["price"])?>
                                                            </span>
                                                            <?php }?> &nbsp;
                                                            <?= Func::formatPrice($ca["pricesale"]) ?> đ                                                            
                                                        </p>
                                                    </div>
                                                    <div class="text-center title_prcart col-quant">
                                                        <div class="title_prcart-name">
                                                            <select name="quantity[]" onchange="onchangeQuantitycart(this.value,<?= $key ?>)" class="form-control">
                                                                <?php for ($i = 5; $i < 100; $i += 5) { ?>
                                                                    <option value="<?= $i ?>" <?php if ($ca["quantity"] == $i) { ?> selected="selected" <?php } ?>><?= $i ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="text-center title_prcart col-amou">
                                                        <p class="title_prcart-name pl-4">
                                                            <span id="total<?= $key ?>">
                                                                <?= Func::formatPrice($ca["pricesale"] * $ca["quantity"]) ?>
                                                            </span> đ
                                                        </p>                                                        
                                                    </div>
                                                    <div class="text-center title_prcart col-act">
                                                        <p class="title_prcart-name pl-2">
                                                            <i onclick="removeCart(<?= $key ?>)" style="color: #807b7b; cursor: pointer;" class="fas fa-trash s-14" aria-hidden="true"></i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $k++;
                                }
                                ?>                            
                                </tbody>
                            </table>
                            <table class="table display data-table text-nowrap dataTable no-footer mt-3 mb-3">
                                <thead>
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc font-weight-bold" rowspan="1" colspan="2">
                                            <i class="fas fa-clipboard-check color-green s-13" aria-hidden="true"></i> Thông tin đặt hàng
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="color-row-wt">
                                        <td class="w15 text-left vertical-mid pl-4">
                                            <p>Tạm thời (<?= count($_SESSION["cart"]); ?> sản phẩm)</p>
                                            <p>Phí vận chuyển (Tạm tính)</p>
                                            <p class="font-weight-bold">Tổng</p>
                                        </td>
                                        <td class="text-right vertical-mid pr-4">
                                            <p><span id="totaltotal"><?= Func::formatPrice($total) ?></span> đ</p>
                                            <p><span id="ship">30.000</span> đ</p>
                                            <p class="font-weight-bold color-or" id="totaltotal_ship"><?= Func::formatPrice($total + $ship) ?> đ</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">

                            <table class="table display data-table text-nowrap dataTable no-footer mb-3">
                                <thead>
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc font-weight-bold"><i class="fas fa-map-marker-alt color-green s-13" aria-hidden="true"></i> Địa chỉ giao hàng</th>
                                        <th class="sorting_asc text-right">
                                            <button type="button" class="s-12 btn-ad" data-toggle="modal" data-target="#thietlapdiachi">Thiết lập địa chỉ</button>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="color-row-wt">
                                        <td class="text-left p-4" colspan="2">
                                            <p class="white-space-normal"><b id="nameshow"></b> <span id="phoneshow"></span></p>
                                            <p class="white-space-normal mb-0" id="addressshow"></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table display data-table text-nowrap dataTable no-footer mb-3">
                                <thead>
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc font-weight-bold"><i class="fas fa-shipping-fast color-green s-13" aria-hidden="true"></i> Phương thức vận chuyển</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="color-row-wt">
                                        <td class="text-left white-space-normal p-4">
                                            <input style="display: block;width: 20px;margin-top: 3px;margin-right: 5px;float: left;" type="radio" name="tranfer" checked="checked" id="tranfer1" value="0">
                                            <label style="font-weight: normal;" for="tranfer1">
                                                Chỉ giao trong giờ hành chính<br/>
                                                <i style="font-size: 13px;">Giao hàng từ 8h00 - 18h00, thứ 2 đến thứ 6</i>
                                            </label><br>
                                            <input style="display: block;width: 20px;margin-top: 3px;margin-right: 5px;float: left;" type="radio" name="tranfer" id="tranfer2" value="1">
                                            <label style="font-weight: normal;" for="tranfer2">
                                                Giao cả tuần (trừ CN & ngày lễ)<br/>
                                                <i style="font-size: 13px;">Giao hàng từ 8h00 - 18h00</i>
                                            </label>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table display data-table text-nowrap dataTable no-footer mb-3">
                                <thead>
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc font-weight-bold"><i class="fas fa-money-check-alt color-green s-13" aria-hidden="true"></i> Phương thức thanh toán</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="color-row-wt">
                                        <td class="text-left white-space-normal p-4">
                                            <div class="w-100 display-flex">
                                                <div>
                                                    <span class="w-100 display-table">
                                                        <i class="fas fa-hand-point-right s-13" aria-hidden="true"></i> 
                                                        Thanh toán khi giao hàng
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table display data-table text-nowrap dataTable no-footer">
                                <thead>
                                    <tr role="row" class="pop_header">
                                        <th class="sorting_asc font-weight-bold"><i class="fas fa-pencil-alt color-green s-13" aria-hidden="true"></i> Ghi chú</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="color-row-wt">
                                        <td class="p-4">
                                            <textarea class="form-control" name="note" id="" rows="6"></textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="w-100 pt-3 pb-3 text-right">
                                <button type="submit" name="btnSumit" class=" btn-warning btn btn-or">Xác nhận giỏ hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
    <script>
        $(document).ready(function () {
            $('#nf form').submit(function () {
                var address = $('#address').val();
                if (address == '') {
                    alert("Bạn chưa thiết lập địa chỉ giao hàng");
                    return false;
                }
                var name = $('#name').val();
                if (name == '') {
                    alert("Bạn chưa nhập tên khách hàng");
                    return false;
                }
                var phone = $('#phone').val();
                if (phone == '') {
                    alert("Bạn chưa nhập số điện thoại");
                    return false;
                }
                return true;
            });

        });
        function onchangeQuantitycart(quantity, pos) {
            var price = $("#hiddenprice" + pos).val();
            var total = parseInt(price) * parseInt(quantity);
            $("#total" + pos).html(accounting.formatNumber(Math.round(total), 0, ",", "."));
            $("#totalhidden" + pos).val(total);
            var totaltotal = 0;
            $("input[name='total']").each(function () {
                totaltotal += parseInt(this.value);
            });
            $("#totaltotal").html(accounting.formatNumber(Math.round(totaltotal), 0, ",", "."));
            var ship = "<?= $ship ?>";
            var totaltotal_ship = parseInt(totaltotal) + parseInt(ship);
            $("#totaltotal_ship").html(accounting.formatNumber(Math.round(totaltotal_ship), 0, ",", "."));
        }
        function removeCart(id) {
            $.fn_ajax('removeCart', {'id': id}, function (results) {
                if (results.flag == true) {
                    window.location.href = $baseUrl + "/cart.html";
                } else {
                    alert("Error add Cart");
                }
            }, true);
        }
        function btnclose() {
            $('#thietlapdiachi').modal('hide');
        }
        function btnok() {
            var hoten = $('#f_hoten').val();
            if (hoten == '') {
                alert("Bạn chưa nhập họ tên");
                return false;
            }
            var phone = $('#f_phone').val();
            if (phone == '') {
                alert("Bạn chưa nhập số điện thoại");
                return false;
            }
            var tinhthanh = $('#f_tinhthanh').val();
            if (tinhthanh == '') {
                alert("Bạn chưa nhập Tỉnh/Thành Phố");
                return false;
            }
            var quanhuyen = $('#f_quanhuyen').val();
            if (quanhuyen == '') {
                alert("Bạn chưa nhập Quận/Huyện");
                return false;
            }
            var xa = $('#f_xa').val();
            if (xa == '') {
                alert("Bạn chưa nhập Phường/Xã");
                return false;
            }
            var duong = $('#f_duong').val();
            if (duong == '') {
                alert("Bạn chưa nhập số nhà/Tên đường");
                return false;
            }
            var email = $('#f_email').val();
            $("#name").val(hoten);
            $("#phone").val(phone);
            $("#email").val(email);
            $("#address").val(duong+", "+xa+", "+quanhuyen+", "+tinhthanh);
            
            $("#nameshow").html(hoten);
            $("#phoneshow").html(phone);
            $("#addressshow").html(duong+", "+xa+", "+quanhuyen+", "+tinhthanh);
            $('#thietlapdiachi').modal('hide');
        }
    </script>

<?php } else { ?>
    <div class="content-center color-row pbb-5 ptt-5">
        <div class="container"> 
            <div class="dataTables_wrapper no-footer">
                <div class="row">
                    <div class="col">
                        <table class="table display data-table text-nowrap dataTable no-footer">
                            <thead class="hidden-sm">
                                <tr role="row" class="pop_header">
                                    <th class="sorting_asc ">
                                        <div class="display-flex row">
                                            <div style="width: 5%" class="text-center font-weight-bold"><input type="checkbox" value="" id="defaultCheck1"></div>
                                            <div style="width: 45%" class="text-left font-weight-bold">Sản phẩm</div>
                                            <div style="width: 15%" class="text-center font-weight-bold">Giá</div>
                                            <div style="width: 10%" class="text-center font-weight-bold">Số lượng</div>
                                            <div style="width: 20%" class="text-center font-weight-bold">Số tiền</div>
                                            <div style="width: 5%" class="text-center font-weight-bold"><a href="#"><i style="color: #807b7b" class="fas fa-trash s-14" aria-hidden="true"></i></a></div>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>    
                                <tr class="color-row-wt">
                                    <td>
                                        <p style="text-align: center">
                                            Cart current empty
                                        </p>
                                        <p style="text-align: center">
                                            <a href="<?= URL_BASE ?>">
                                                <button type="button" class=" btn-warning btn btn-or">Tiếp tục mua sản phẩm</button>
                                            </a>
                                        </p>
                                    </td>
                                </tr>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>                  
    <?php
}?>