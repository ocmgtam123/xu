<?php
    $information=$this->getData('information');
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
        <h1 class="page-header">Thông tin</h1>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-lg-12">        
        <!-- /.panel-heading -->
        <div class="panel-body paddingleftright" style="padding-top: 0px;">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTables-example info" style="position: relative;">                    
                    <thead>
                        <tr style="font-weight: bold;background: #CCC;color: #000;font-size: 12px;line-height: 15px;">
                            <th>ID</th>
                            <th>Code</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($information as $f){?>
                        <tr>
                            <td><?=$f['id']?></td>
                            <td><?=$f['code']?></td>
                            <td>
                                <a href="<?=URL_BASE?>/admininformationedit.html/<?=$f['id']?>">
                                    <i class="fa fa-edit fa-fw" title="<?= $this->language("l_update") ?>"></i>
                                </a>                                
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
<script>
    $(document).ready(function() {
        $('#info').DataTable( {
            "lengthMenu": [[-1], ["All"]]
        });
    });
</script>