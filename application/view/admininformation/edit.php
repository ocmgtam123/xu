<?php
$err = $this->getData('err');
$information = $this->getData('information');
$id = $information["id"];
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thông tin</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div class="table-responsive">
                <form name="nf" method="POST" action="<?= URL_BASE ?>/admininformationedit.html/<?= $information['id'] ?>" enctype="multipart/form-data">
                    <div class="col-xs-12"> 
                        <div class="col-xs-12 paddingleftright" style="padding: 0px 0px 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Title<i class="ired"> </i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" autocomplete="off" class="inputdefault" name="code" disabled="disabled" value="<?= $information['code'] ?>" placeholder="<?= $this->language("l_code") ?>..." />
                            </div><div class="cl"></div>
                        </div>    
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype" style="padding-top: 2px;">Hình <i class="ired">&nbsp;</i></p>
                            </div>
                            <div class="col-xs-4">
                                <?php if ($information['image'] != "") { ?>
                                    <img style="width: 80px; margin-right: 10px; float: left;" src="<?= URL_BASE ?>/<?= $information['image'] ?>" />
                                <?php } ?>
                                <input type="file" name="image" />
                            </div>                     
                            <div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Mô tả ngắn <i class="ired"> </i></p>
                            </div>
                            <div class="col-xs-10">
                                <textarea class="inputdefault" name="des"><?= $information['des'] ?></textarea>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Nội dung <i class="ired"> </i></p>
                            </div>
                            <div class="col-xs-10">
                                <textarea class="inputdefault" name="content"><?= $information['content'] ?></textarea>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12" style="padding: 10px 0px;">
                            <div class="col-xs-5 textalignright">
                                <input type="reset" class="btn btn-grey btnborderclose" value="Nhập lại" />
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
    CKEDITOR.replace('content', {
        height: 350,
        filebrowserBrowseUrl: 'ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: 'ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: 'ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>

