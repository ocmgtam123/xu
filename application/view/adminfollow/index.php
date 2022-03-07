<?php
    $follow=$this->getData('follow');
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
        <h1 class="page-header">Mạng xã hội</h1>
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
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Link liên kết</th>
                            <th>Icon</th>
                            <th>Trạng thái</th>                                                        
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($follow as $f){?>
                        <tr>
                            <td><?=$f['id']?></td>
                            <td><?=$f['name']?></td>
                            <td><?=$f['link']?></td>
                            <td><?=$f['icon']?></td>
                            <td><?php if($f['status']==1){?><i class="fa fa-check" title=""></i><?php }else{?><i class="fa fa-close" title=""></i><?php }?></td>
                            <td>
                                <a href="<?=URL_BASE?>/adminfollowedit.html/<?=$f['id']?>"><i class="fa fa-edit fa-fw" title="<?= $this->language("l_update") ?>"></i></a>                                
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

<style>.dataTables_paginate,.dataTables_info,.dataTables_length,.dataTables_filter{display: none;}</style>