<?php
$err = $this->getData('err');
$user = $this->getData('user');
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tài khoản</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright">
            <div id="nf" class="table-responsive">
                <form name="nf" method="POST" action="<?=URL_BASE?>/adminuseredit.html/<?=$user['idx']?>" enctype="multipart/form-data">
                <div class="col-xs-12">                    
                    
                    <div class="mess_error_category"><?=$err?></div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">&nbsp; <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <h3 style="margin: 0px;padding-bottom: 10px;">Cập nhật tài khoản</h3>
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">ID <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="text" class="inputdefault" disabled="disabled" value="<?=$user['ID']?>" placeholder="..." />
                        </div><div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Mật khẩu mới <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="password" name="pass" id="pass" class="inputdefault" value="" placeholder="Mật khẩu mới..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    <div class="col-xs-12 paddingleftright" style="padding: 10px 0px;">
                        <div class="col-xs-2 textalignright paddingleftright">
                            <p class="p_nametype">Nhập lại mật khẩu mới <i class="ired"> </i></p>
                        </div>
                        <div class="col-xs-4">
                            <input type="password" name="resetpass" id="resetpass" class="inputdefault" value="" placeholder="Nhập lại mật khẩu mới..." />
                        </div>
                        <div class="cl"></div>
                    </div>
                    
                    <div class="col-xs-12" style="padding: 10px 0px;">
                        <div class="col-xs-3 textalignright">
                            <input type="reset" class="btn btn-grey btnborderclose" value="Nhập lại" />
                        </div>
                        <div class="col-xs-9 paddingleftright">
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#nf form').submit(function(){
            var pass = $('#pass').val();
            if(pass == ''){
                alert("Bạn chưa nhập mật khẩu mới");
                $("#pass").focus();
                return false;
            }
            if(pass.length<4){
                alert("Mật khẩu mới ít nhất 4 ký tự");
                $("#pass").focus();
                return false;
            }
            var resetpass = $('#resetpass').val();
            if(resetpass == ''){
                alert("Bạn chưa nhập lại mật khẩu mới");
                $("#resetpass").focus();
                return false;
            }
            if(pass != resetpass){
                alert("Mật khẩu mới và nhập lại mật khẩu mới không giống nhau");
                return false;
            }
            return true;
        });
    });
</script>