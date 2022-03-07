<?php
$err = $this->getData('err');
$banner = $this->getData('banner');
?>
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
        <div class="panel-body paddingleftright">
            <div class="table-responsive">
                <form name="nf" method="POST" action="<?=URL_BASE?>/admindashboard-edit.html/<?=$banner['id']?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;">Cập nhật banner</h3>
                    <div class="mess_error_category"><?=$err?></div>
                    <p style="text-align: center">
                        <img style="width: 485px;" src="<?=URL_BASE?>/<?=$banner['image']?>" />
                    </p>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Images<i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">                            
                            <input type="file" name="image" />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Status <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="radio" id="hien" <?php if($banner['status']==1){?> checked="checked" <?php }?> name="status" value="1">
                            <label style="font-weight: normal;" for="hien"><?= $this->language("l_show") ?></label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" id="an" <?php if($banner['status']==0){?> checked="checked" <?php }?> name="status" value="0">
                            <label style="font-weight: normal;" for="an"><?= $this->language("l_hide") ?></label>
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Link <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="link" value="<?=$banner['link']?>" placeholder="Link..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Position <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="pos" value="<?=$banner['pos']?>" placeholder="Position..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12" style="padding: 10px 0px;">
                        <div class="col-xs-6 textalignright">
                            <input type="reset" class="btn btn-grey btnborderclose" value="Nhập lại" />
                        </div>
                        <div class="col-xs-6 paddingleftright">
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