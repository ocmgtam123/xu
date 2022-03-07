<?php
$err = $this->getData('err');
$pos = $this->getData('pos');
$link = $this->getData('link');
$status = $this->getData('status');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $this->language("l_banner") ?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div class="table-responsive">
                <form name="nf" method="POST" action="<?= $this->route('adminbanneradd') ?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;"><?= $this->language("l_add_banner") ?></h3>
                    <div class="mess_error_category"><?=$err?></div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype"><?= $this->language("l_img_1940_426") ?> <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="file" name="image" />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype"><?= $this->language("l_status") ?> <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="radio" id="hien" <?php if($status==1){?> checked="checked"<?php }?> name="status" value="1">
                            <label style="font-weight: normal;" for="hien"><?= $this->language("l_show") ?></label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" id="an" <?php if($status==0){?> checked="checked"<?php }?> name="status" value="0">
                            <label style="font-weight: normal;" for="an"><?= $this->language("l_hide") ?></label>
                        </div>                        
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype"><?= $this->language("l_link") ?> <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="link" value="<?=$link?>" placeholder="<?= $this->language("l_link") ?>..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype"><?= $this->language("l_position") ?> <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="pos" value="<?=$pos?>" placeholder="<?= $this->language("l_position") ?>..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12" style="padding: 10px 0px;">
                        <div class="col-xs-6 textalignright">
                            <input type="reset" class="btn btn-grey btnborderclose" value="<?= $this->language("l_enter_again") ?>" />
                        </div>
                        <div class="col-xs-6 paddingleftright">
                            <input type="submit" class="btn btn-danger" name="btnSumit" value="<?= $this->language("l_add") ?>" />
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
