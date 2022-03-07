<?php
$err = $this->getData('err');
$name = $this->getData('name');
$price = $this->getData('price');
$pricesale = $this->getData('pricesale');
$content = $this->getData('content');
$slug = $this->getData('slug');
$status = $this->getData('status');
$nameimages = $this->getData('nameimages');
?>
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
                <form name="nf" method="POST" action="<?= $this->route('adminproductadd') ?>" enctype="multipart/form-data">
                    <div class="col-xs-12">                    
                        <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;">Thêm sản phẩm</h3>
                        <div class="mess_error_category"><?= $err ?></div>

                        <div>

                            <style>
                                .uploader11{display: none;}
                                #messuploadimages{margin-bottom: 0px;}
                            </style>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>

                            
                            <!-- Modal Drop images -->
                            <div class="modal fade" id="myModal_avatar_player" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">            
                                        <!-- modal-body -->     
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-xs-12 text-center">
                                                    <div id="upload-demo" style="height:440px;"></div>
                                                </div>
                                                <div class="col-xs-12">
                                                    <strong>Select image to crop:</strong>
                                                    <input style="margin-bottom: 10px;" type="file" id="image">
                                                    <input type="button" value="Lưu" class="luuavatar" style="background: #d62c2d; color: #fff; padding: 3px 15px; border: 0px; border-radius:2px;">
                                                    <input data-dismiss="modal" type="button" value="Hủy bỏ" class="" style="background: #d62c2d; color: #fff; padding: 3px 15px; border: 0px; border-radius:2px;">

                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><!-- end modal-body --> 
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div><div class="clearfix"></div>
                            <!-- end Modal Drop images -->
                            <script type="text/javascript">
                                var resize = $('#upload-demo').croppie({
                                    enableExif: true,
                                    enableOrientation: true,
                                    viewport: {// Default { width: 100, height: 100, type: 'square' } 
                                        width: 257,
                                        height: 355,
                                        type: 'square' //square//circle
                                    },
                                    boundary: {
                                        width: 400,
                                        height: 400
                                    }
                                });
                                $('#image').on('change', function () {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        resize.croppie('bind', {
                                            url: e.target.result
                                        }).then(function () {
                                            //console.log('jQuery bind complete');
                                        });
                                    }
                                    reader.readAsDataURL(this.files[0]);
                                });


                                $('.luuavatar').on('click', function (ev) {
                                    resize.croppie('result', {
                                        type: 'canvas',
                                        size: 'viewport'
                                    }).then(function (img) {
                                        $.ajax({
                                            url: '<?php echo URL_BASE . "/uploadimages.html" ?>',
                                            type: "POST",
                                            data: {"image": img},
                                            success: function (data) {
                                                var imagesresult=data.replaceAll('"', '');
                                                $("#idimages").html('<img style="width: 75px; height:104px;" src="<?=URL_BASE?>/upload/'+imagesresult+'">');
                                                $("#nameimages").val(imagesresult);
                                                $('#myModal_avatar_player').modal('hide');
                                            }
                                        });
                                    });
                                });
                            </script>
                            <input type="hidden" id="nameimages" name="nameimages" value="<?=$nameimages?>" />
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Hình <i class="ired">*</i></p>
                            </div>
                            <div class="col-xs-4">
                                <span id="idimages" data-toggle="modal" data-target="#myModal_avatar_player">
                                    <?php if($nameimages!=""){?>
                                    <img style="width: 75px; height:104px;" src="<?=URL_BASE?>/upload/<?=$nameimages?>">
                                    <?php }else{?>
                                    <img style="width: 75px; height:104px;" src="<?=URL_BASE?>/no.png">
                                    <?php }?>
                                </span>
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Tên sản phẩm <i class="ired">*</i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" autocomplete="off" class="inputdefault" id="name" name="name" value="<?= $name ?>" placeholder="<?= $this->language("l_name_product_vn") ?>..." />
                            </div><div class="cl"></div>
                        </div>
                        <!--<div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype" style="padding-top: 2px;">Hình <i class="ired">&nbsp;</i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="file" name="image" />
                            </div>                     
                            <div class="cl"></div>
                        </div>-->
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Giá bán  <i class="ired">*</i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" autocomplete="off" class="inputdefault money_format v-numericprice" id="price" name="price" value="<?= $price ?>" placeholder="Price..." />
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Giá sale  <i class="ired">&nbsp;</i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" autocomplete="off" class="inputdefault money_format v-numericprice" id="pricesale" name="pricesale" value="<?= $pricesale ?>" placeholder="Price sale..." />
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Nội dung</p>
                            </div>
                            <div class="col-xs-10">
                                <textarea name="content"><?= $content ?></textarea>
                            </div>
                            <div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype">Slug <i class="ired"> </i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="text" autocomplete="off" class="inputdefault" id="slug" name="slug" value="<?= $slug ?>" placeholder="<?= $this->language("l_slug") ?>..." />
                            </div><div class="cl"></div>
                        </div>
                        <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                            <div class="col-xs-2 textalignright paddingleftright">
                                <p class="p_nametype" style="padding-top: 2px;">Trạng thái <i class="ired"> </i></p>
                            </div>
                            <div class="col-xs-4">
                                <input type="radio" id="hien" <?php if ($status == 1) { ?> checked="checked"<?php } ?> name="status" value="1">
                                <label style="font-weight: normal;" for="hien">Hiện</label> &nbsp; &nbsp; &nbsp;
                                <input type="radio" id="an" <?php if ($status == 0) { ?> checked="checked"<?php } ?> name="status" value="0">
                                <label style="font-weight: normal;" for="an">Ẩn</label>
                            </div>                        
                            <div class="cl"></div>
                        </div>
                        <div class="col-xs-12" style="padding: 10px 0px;">
                            <div class="col-xs-5 textalignright">
                                <input type="reset" class="btn btn-grey btnborderclose" value="Nhập lại" />
                            </div>
                            <div class="col-xs-7 paddingleftright">
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
    CKEDITOR.replace('content', {
        height: 350,
        filebrowserBrowseUrl: $baseUrl + '/ckeditor/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: $baseUrl + '/ckeditor/ckfinder/ckfinder.html?type=Images',
        filebrowserFlashBrowseUrl: $baseUrl + '/ckeditor/ckfinder/ckfinder.html?type=Flash',
        filebrowserUploadUrl: $baseUrl + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: $baseUrl + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
        filebrowserFlashUploadUrl: $baseUrl + '/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
    });
</script>