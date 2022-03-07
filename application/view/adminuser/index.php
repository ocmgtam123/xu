<?php
    $user=$this->getData('user');
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
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách tài khoản</h1>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright" style="padding-top: 0px;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTables-example" style="position: relative;">                    
                    <thead>
                        <tr style="font-weight: bold;background: #CCC;color: #000;font-size: 12px;line-height: 15px;">
                            <th>STT</th>
                            <th>Username</th>
                            <th>Lang</th>
                            <th>Status</th>
                            <th>Area</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i=1;
                        foreach ($user as $f){
                        ?>
                        <tr class="rowsaccount<?=$f['idx']?>">
                            <td><?=$i?></td>
                            <td><?=$f['ID']?></td>
                            <td><?=$f['lang']?></td>
                            <td><?=$f['area']?></td>
                            <td>
                                <?php if($f['status']==1){?>
                                <i class="fa fa-check" title=""></i>
                                <?php }else{?>
                                <i class="fa fa-close" title=""></i>
                                <?php }?>
                            </td>
                            <td>
                                <a href="<?=URL_BASE?>/adminuseredit.html/<?=$f['idx']?>">
                                    <i class="fa fa-edit fa-fw" title="Cập nhật">
                                    </i>
                                </a>                                
                            </td>
                        </tr>
                        <?php $i++;}?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->            
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.col-lg-12 -->
</div>

<style>.dataTables_filter{text-align: right !important}</style>