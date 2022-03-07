<?php
$err = $this->getData('err');
$follow = $this->getData('follow');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mạng xã hội</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div class="table-responsive">
                <form name="nf" method="POST" action="<?=URL_BASE?>/adminfollowedit.html/<?=$follow['id']?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    <h3 style="margin: 0px;text-align: center; padding-bottom: 10px;">Cập nhật mạng xã hội</h3>
                    <div class="mess_error_category"><?=$err?></div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Tên <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="name" value="<?=$follow['name']?>" placeholder="<?= $this->language("l_name") ?>..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Icon <i class="ired">*</i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="icon" value="<?=$follow['icon']?>" placeholder="<?= $this->language("l_icon") ?>..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Link liên kết <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" autocomplete="off" class="inputdefault" name="link" value="<?=$follow['link']?>" placeholder="<?= $this->language("l_link") ?>..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-5 textalignright paddingleftright">
                            <p class="p_nametype">Trạng thái <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="radio" id="hien" <?php if($follow['status']==1){?> checked="checked" <?php }?> name="status" value="1">
                            <label style="font-weight: normal;" for="hien">Hiện</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="radio" id="an" <?php if($follow['status']==0){?> checked="checked" <?php }?> name="status" value="0">
                            <label style="font-weight: normal;" for="an">Ẩn</label>
                        </div>
                        <div class="cl"></div>
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