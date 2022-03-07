<?php
    $news=$this->getData('news');
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
        $(".button_ok_news_delete").click(function () {
            var id = document.getElementById("id_news_delete_hidden").value;            
            $.fn_ajax('deletenews', {'id': id}, function (result) {
                if (result.flag == true) {
                    $('#deleteNewsform').modal('hide');
                    $("#mess").html(result.mess);
                    $('#messModal').modal('show');
                    setTimeout(function () {
                        $('#messModal').modal('hide');
                    }, 2000);
                    $("#rowsnews"+result.id).remove();                            
                } else {
                    alert("<?= $this->language("l_error_update") ?>");
                }
            }, true);
        });        
    });
    function deletenews(id) {
        $("#id_news_delete_hidden").val(id);
        $('#deleteNewsform').modal('show');
    }
</script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tin tức</h1>
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
                    <a style="position: absolute; top: -1px; right:15px;z-index: 500;" href="<?= $this->route('adminnewsadd') ?>">
                        <button type="button" class="btn btn-danger">Thêm mới</button>
                    </a>
                    <thead>
                        <tr style="font-weight: bold;background: #CCC;color: #000;font-size: 12px;line-height: 15px;">
                            <th>ID</th>                            
                            <th>Hình</th>
                            <th>Tiêu đề</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>                                                     
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($news as $n){?>
                        <tr id="rowsnews<?=$n['id']?>">
                            <td><?=$n['id']?></td>
                            <td>
                                <?php if($n['image']!=""){?>
                                <img style="width: 80px; height: 55px;" src="<?=URL_BASE?>/<?=$n['image']?>" />
                                <?php }?>
                            </td>
                            <td><?=$n['title']?></td>
                            <td><?=$n['create_at']?></td>
                            <td>
                                <?php if($n['status']==1){?>
                                <i class="fa fa-check" title=""></i>
                                <?php }else{?>
                                <i class="fa fa-close" title=""></i>
                                <?php }?>
                            </td>
                            <td>
                                <a href="<?=URL_BASE?>/adminnewsedit.html/<?=$n['id']?>"><i class="fa fa-edit fa-fw" title="<?= $this->language("l_update") ?>"></i></a>
                                <i class="fa fa-trash fa-fw" onclick="deletenews(<?=$n['id']?>)" title="<?= $this->language("l_delete") ?>"></i>
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
<div class="modal fade" id="deleteNewsform" tabindex="-1" role="dialog" aria-labelledby="deleteNewsform" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width: 585px;margin-top: 10%;">
        <div class="modal-content">            
            <div class="modal-body">
                <input type="hidden" id="id_news_delete_hidden" value="" />
                <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                    <p class="form_item_error">Bạn thật sự muốn xóa?</p>
                    <div class="cl"></div>
                </div>
                <div class="col-xs-12" style="padding: 10px 0px;">
                    <div class="col-xs-6 textalignright">
                        <button type="button" class="btn btn-grey btnborderclose" data-dismiss="modal">Đóng</button>
                    </div>
                    <div class="col-xs-6 paddingleftright">
                        <button type="button" class="btn btn-danger button_ok_news_delete">Xóa</button>
                    </div><div class="cl"></div>
                </div>
                <div class="cl"></div>
            </div><div class="cl"></div>
        </div><div class="cl"></div>
    </div><div class="cl"></div>
</div>
<!-- end modal delete category -->