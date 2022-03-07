<?php
    $banner=$this->getData('banner');
?>
<?php if(isset($_SESSION['err'])){?>
<script>
    $(document).ready(function () {
        $("#mess").html('<?=$_SESSION['err']?>');
        $('#messModal').modal('show');
        setTimeout(function () {
            $('#messModal').modal('hide');
        }, 2000);       
    });
</script>
    <?php unset($_SESSION['err']);?>
<?php }?>
<script>
    $(document).ready(function () {
        $(".button_ok_banner_delete").click(function () {
            var id = document.getElementById("id_banner_delete_hidden").value;            
            $.fn_ajax('deletebanner', {'id': id}, function (result) {
                if (result.flag == true) {
                    $('#deletebannerform').modal('hide');
                    $("#mess").html(result.mess);
                    $('#messModal').modal('show');
                    setTimeout(function () {
                        $('#messModal').modal('hide');
                    }, 2000);
                    $("#rowsbanner"+result.id).remove();                            
                } else {
                    alert("<?= $this->language("l_delete_failed") ?>");
                }
            }, true);
        });        
    });
    function deletebanner(id) {
        $("#id_banner_delete_hidden").val(id);
        $('#deletebannerform').modal('show');
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Banner</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright" style="padding-top: 0px;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTables-example" style="position: relative;">
                    <a style="position: absolute; top: -1px; right:15px;z-index: 500;" href="<?= $this->route('adminbanneradd') ?>">
                        <button type="button" class="btn btn-danger">Thêm mới</button>
                    </a>
                    <thead>
                        <tr style="font-weight: bold;background: #CCC;color: #000;font-size: 12px;line-height: 15px;">
                            <th>ID</th>                            
                            <th>Images</th>
                            <th>Link</th>
                            <th>Position</th>
                            <th>Status</th>                                                        
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($banner as $b){?>
                        <tr id="rowsbanner<?=$b['id']?>">
                            <td><?=$b['id']?></td>
                            <td>
                                <?php if($b['image']!=""){?>
                                <img style="width: 215px; height: 47px;" src="<?=URL_BASE?>/<?=$b['image']?>" />
                                <?php }?>
                            </td>
                            <td><?=$b['link']?></td>
                            <td><?=$b['pos']?></td>
                            <td><?php if($b['status']==1){?><i class="fa fa-check" title=""></i><?php }else{?><i class="fa fa-close" title=""></i><?php }?></td>
                            <td>
                                <a href="<?=URL_BASE?>/admindashboard-edit.html/<?=$b['id']?>"><i class="fa fa-edit fa-fw" title="<?= $this->language("l_update") ?>"></i></a>
                                <i class="fa fa-trash fa-fw" onclick="deletebanner(<?=$b['id']?>)" title="<?= $this->language("l_delete") ?>"></i>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->            
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<!-- Modal delete category -->
<div class="modal fade" id="deletebannerform" tabindex="-1" role="dialog" aria-labelledby="deletebannerform" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 585px;margin-top: 10%;">
        <div class="modal-content">            
            <div class="modal-body">
                <input type="hidden" id="id_banner_delete_hidden" value="" />
                <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                    <p class="form_item_error">Bạn thật sự muốn xóa Banner ?</p>
                    <div class="cl"></div>
                </div>
                <div class="col-xs-12" style="padding: 10px 0px;">
                    <div class="col-xs-6 textalignright">
                        <button type="button" class="btn btn-grey btnborderclose" data-dismiss="modal">Đóng</button>
                    </div>
                    <div class="col-xs-6 paddingleftright">
                        <button type="button" class="btn btn-danger button_ok_banner_delete">Xóa</button>
                    </div><div class="cl"></div>
                </div>
                <div class="cl"></div>
            </div><div class="cl"></div>
        </div><div class="cl"></div>
    </div><div class="cl"></div>
</div>
<!-- end modal delete category -->