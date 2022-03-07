<?php
$err = $this->getData('err');
$listcategory = $this->getData('listcategory');
$product = $this->getData('product');
$product_images = $this->getData('product_images');
?>
<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sản phẩm</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div class="table-responsive">
                <form name="nf" method="POST" action="<?=URL_BASE?>/adminproductedit.html/<?=$product['id']?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;">Cập nhật sản phẩm</h3>
                    <div class="mess_error_category"><?=$err?></div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Tên sản phẩm <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" id="name" name="name" value="<?=$product['name']?>" placeholder="T<?= $this->language("l_name_product_vn") ?>..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Hình <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <img style="width: 80px; margin-right: 10px; float: left;" src="<?=URL_BASE?>/<?=$product['image']?>" />
                            <input type="file" name="image" />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Giá bán  <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault money_format v-numericprice" id="price" name="price" value="<?= Func::formatPrice($product['price'])?>" placeholder="Giá bán..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Giá sale  <i class="ired">&nbsp;</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault money_format v-numericprice" id="pricesale" name="pricesale" value="<?= Func::formatPrice($product['pricesale'])?>" placeholder="Giá sale..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Nội dung</p>
                        </div>
                        <div class="col-xs-10">
                            <textarea name="content" class="inputdefault">
                                <?=$product['content']?>
                            </textarea>
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Slug <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" id="slug" name="slug" value="<?=$product['slug']?>" placeholder="<?= $this->language("l_slug") ?>..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Trạng thái <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="radio" id="hien" <?php if($product['status']==1){?> checked="checked" <?php }?> name="status" value="1">
                            <label style="font-weight: normal;" for="hien">Hiện</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" id="an" <?php if($product['status']==0){?> checked="checked" <?php }?> name="status" value="0">
                            <label style="font-weight: normal;" for="an">Ẩn</label>
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
    CKEDITOR.replace('content',{
        height:350,
        filebrowserBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl : $baseUrl+'/ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl : $baseUrl+'/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>