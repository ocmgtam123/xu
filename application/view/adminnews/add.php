<?php
$err = $this->getData('err');
$title = $this->getData('title');
$longtitle = $this->getData('longtitle');
$status = $this->getData('status');
$content = $this->getData('content');
$slug = $this->getData('slug');
?>
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
                <form name="nf" method="POST" action="<?= $this->route('adminnewsadd') ?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    <div class="col-xs-12 paddingleftright" style="padding: 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">&nbsp;</p>
                        </div>
                        <div class="col-xs-4">
                            <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;">Thêm tin tức</h3>
                        </div><div class="cl"></div>
                    </div>
                    <div class="mess_error_category"><?=$err?></div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Tiêu đề <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="title" value="<?=$title?>" placeholder="Tiêu đề..." />
                        </div><div class="cl"></div>
                    </div>
                    
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Hình <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="file" name="image" />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Mô tả ngắn</p>
                        </div>
                        <div class="col-xs-10">
                            <textarea class="inputdefault" name="longtitle"><?=$longtitle?></textarea>
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Nội dung chi tiết</p>
                        </div>
                        <div class="col-xs-10">
                            <textarea name="content"><?=$content?></textarea>
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype" style="padding-top: 2px;">Trạng thái <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="radio" id="hien" <?php if($status==1){?> checked="checked"<?php }?> name="status" value="1">
                            <label style="font-weight: normal;" for="hien">Hiện</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" id="an" <?php if($status==0){?> checked="checked"<?php }?> name="status" value="0">
                            <label style="font-weight: normal;" for="an">Ẩn</label>
                        </div>                        
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Slug <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="slug" value="<?=$slug?>" placeholder="Slug..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12" style="padding: 10px 0px;">
                        <div class="col-xs-4 textalignright">
                            <input type="reset" class="btn btn-grey btnborderclose" value="Nhập lại" />
                        </div>
                        <div class="col-xs-8 paddingleftright">
                            <input type="submit" class="btn btn-danger" name="btnSumit" value="Thêm" />
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
    CKEDITOR.replace( 'content',{
        height:350,
        filebrowserBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>