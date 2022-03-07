<?php
$order = $this->getData('order');
$countall = $this->getData('countall');
$count0 = $this->getData('count0');
$count1 = $this->getData('count1');
$count2 = $this->getData('count2');
$count3 = $this->getData('count3');
$count4 = $this->getData('count4');
$countcancel = $this->getData('countcancel');
$st = $this->getData('st');
$title="";
if($st==0){
    $title="Khởi tạo đơn hàng";
}
if($st==1){
    $title="Xác nhận đơn hàng";
}
if($st==2){
    $title="Đang vận chuyển đơn hàng";
}
if($st==3){
    $title="Đã giao hàng";
}
if($st==4){
    $title="Hoàn tất";
}
if($st==-1){
    $title="Đơn hàng hủy";
}
$total=0;
?>
<?php if (isset($_SESSION['err'])) { ?>
    <script>
        $(document).ready(function () {
            $("#mess").html('<?= $_SESSION['err'] ?>');
            $('#messModal').modal('show');
            setTimeout(function () {
                $('#messModal').modal('hide');
            }, 2000);
        });
    </script>
    <?php unset($_SESSION['err']); ?>
<?php } ?>
<script>
    function confirmorder(id) {
        var count0=parseInt($("#count0").html());
        var count1=parseInt($("#count1").html());        
        $.fn_ajax('confirmorder', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder);                
                $("#count0").html(count0-1);
                $("#count1").html(count1+1);
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
    function tranferorder(id) {
        var count1=parseInt($("#count1").html());
        var count2=parseInt($("#count2").html());
        $.fn_ajax('tranferorder', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder);
                $("#count1").html(count1-1);
                $("#count2").html(count2+1);
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
    function tranferordercomplete(id) {
        var count2=parseInt($("#count2").html());
        var count3=parseInt($("#count3").html());
        $.fn_ajax('tranferordercomplete', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder);
                $("#count2").html(count2-1);
                $("#count3").html(count3+1);
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
    
    function completeorder(id) {
        var count3=parseInt($("#count3").html());
        var count4=parseInt($("#count4").html());
        $.fn_ajax('completeorder', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder);
                $("#count3").html(count3-1);
                $("#count4").html(count4+1);
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
    function cancelorder(id) {
        var countcancel=parseInt($("#countcancel").html());
        $.fn_ajax('cancelorder', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder);                
                var countold=parseInt($("#count"+result.status_old).html());
                $("#count"+result.status_old).html(countold-1);
                $("#countcancel").html(countcancel+1);                
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
    function resetorder(id) {
        var countcancel=parseInt($("#countcancel").html());
        var count0=parseInt($("#count0").html());
        $.fn_ajax('resetorder', {'id': id}, function (result) {
            if (result.flag == true) {
                $("#statusorder"+result.id).html(result.statusorder);
                $("#actionorder"+result.id).html(result.actionorder); 
                $("#countcancel").html(countcancel-1); 
                $("#count0").html(count0+1); 
            } else {
                alert("<?= $this->language("l_error_load_data") ?>");
            }
        }, true);
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Danh sách đơn hàng
            <span> -> <?=$title?></span>
        </h1>
    </div>
</div>
<!-- /.row -->
<div class="panel-body paddingleftright ad_menuorder" style="position: relative;">
    <a href="<?= $this->route('adminorder') ?>">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==100){echo "activesstatus";}?>">Tất cả (<span id="countall"><?=$countall?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-start.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==0){echo "activesstatus";}?>">Khởi tạo đơn hàng (<span id="count0"><?=$count0?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-confirm.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==1){echo "activesstatus";}?>">Xác nhận đơn hàng (<span id="count1"><?=$count1?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-tranfer.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==2){echo "activesstatus";}?>">Đang vận chuyển đơn hàng (<span id="count2"><?=$count2?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-tranfercomplete.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==3){echo "activesstatus";}?>">Đã giao hàng (<span id="count3"><?=$count3?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-complete.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==4){echo "activesstatus";}?>">Hoàn tất (<span id="count4"><?=$count4?></span>)</button>
    </a>
    <a href="<?=URL_BASE?>/adminorder-cancel.html">
        <button type="button" class="btn btn-outline btn-primary <?php if($st==-1){echo "activesstatus";}?>">Đơn hàng hủy (<span id="countcancel"><?=$countcancel?></span>)</button>
    </a>
    <a style="position: absolute; top: 15px; right: 0px;" href="<?=$this->route('adminorderadd')?>">
        <button type="button" class="btn btn-success">Thêm mới</button>
    </a>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright" style="padding-top: 0px;">
            <div class="table-responsive" style="position: relative;">
                <table class="table table-bordered" id="dataTables-example" style="position: relative;">                    
                    <thead>
                        <tr style="font-weight: bold;background: #CCC;color: #000;font-size: 12px;line-height: 15px;">
                            <th>ID</th>
                            <th>Cập nhật đơn hàng</th>
                            <th>Code</th>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Phí vận chuyển</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th style="width: 100px;">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($order) { ?>
                            <?php 
                            foreach ($order as $f) { 
                                $total+=$f['total']+$f['fee_delivery'];
                                ?>
                                <tr class="rowsorder<?= $f['id'] ?>">
                                    <td><?=$f['id']?></td>
                                    <td>
                                        <a href="<?=URL_BASE?>/adminorderedit.html/<?=$f['id']?>">
                                            <i class="fa fa-edit fa-fw" title="Cập nhật đơn hàng"></i>
                                        </a>
                                    </td>
                                    <td><?= $f['code'] ?></td>
                                    <td><?= $f['name'] ?></td>
                                    <td><?= $f['phone'] ?></td>
                                    <td><?= $f['address'] ?></td>
                                    <td><?= Func::formatPrice($f['fee_delivery']) ?></td>
                                    <td><?= Func::formatPrice($f['total']+$f['fee_delivery']) ?></td>
                                    <td id="statusorder<?= $f['id'] ?>">
                                        <?php
                                        if($f['status']==0){echo "Khởi tạo";}
                                        if($f['status']==1){echo "Xác nhận";}
                                        if($f['status']==2){echo "Vận chuyển";}
                                        if($f['status']==3){echo "Đã giao hàng";}
                                        if($f['status']==4){echo "Hoàn tất";}
                                        if($f['status']==-1){echo "Hủy";}
                                        ?>
                                        
                                    </td>
                                    <td id="actionorder<?= $f['id'] ?>">
                                        <?php if($f['status']==0){?>
                                        <button type="button" onclick="confirmorder(<?= $f['id'] ?>);" class="btn btn-primary btn-xs confirmorder">Xác nhận</button>
                                        <button type="button" onclick="cancelorder(<?= $f['id'] ?>);" class="btn btn-danger btn-xs">Hủy đơn hàng</button>
                                        <?php }?>
                                        <?php if($f['status']==1){?>
                                        <button type="button" onclick="tranferorder(<?= $f['id'] ?>);" class="btn btn-primary btn-xs confirmorder">Vận chuyển</button>
                                        <button type="button" onclick="cancelorder(<?= $f['id'] ?>);" class="btn btn-danger btn-xs">Hủy đơn hàng</button>
                                        <?php }?>
                                        <?php if($f['status']==2){?>
                                        <button type="button" onclick="tranferordercomplete(<?= $f['id'] ?>);" class="btn btn-primary btn-xs confirmorder">Đã giao hàng</button>
                                        <button type="button" onclick="cancelorder(<?= $f['id'] ?>);" class="btn btn-danger btn-xs">Hủy đơn hàng</button>
                                        <?php }?>
                                        <?php if($f['status']==3){?>
                                        <button type="button" onclick="completeorder(<?= $f['id'] ?>);" class="btn btn-primary btn-xs confirmorder">Hoàn tất</button>
                                        <?php }?>
                                        <?php if($f['status']==-1){?>
                                        <button type="button" onclick="resetorder(<?= $f['id'] ?>);" class="btn btn-primary btn-xs confirmorder">Khôi phục</button>
                                        <?php }?>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
                <div style="position: absolute; bottom:15px; left: 0px;">
                    <b>Tổng:</b> <?= Func::formatPrice($total)?>
                </div>
            </div>
            <!-- /.table-responsive -->            
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<style>
    .dataTables_filter{text-align: right !important;}    
    .activesstatus{background: #337ab7; color: #fff !important;}
    .ad_menuorder a{text-decoration: none;}
    .ad_menuorder a:hover{text-decoration: none;}
    .confirmorder,.tranferorder,.completeorder{margin-bottom: 10px;}
    #dataTables-example_info{display: none;}
</style>