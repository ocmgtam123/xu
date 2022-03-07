<script type="text/javascript">
    $(document).ready(function () {
        $('#loginUser').submit(function () {
            var deskid = $('#deskid').val();
            var aid = $('#aid').val();
            var caid = $('#aid').attr('data-check');
            var apw = $('#apw').val();
            var capw = $('#apw').attr('data-check');
            
            if (aid == '') {
                $.fn_alert(true, true, "<?= $this->language('l_inputid') ?>");
                return false;
            }
            if (apw == "") {
                $.fn_alert(true, true, "<?= $this->language('l_inputpw') ?>");
                return false;
            }
            if (caid == 'false' || capw == 'false') {
                return false;
            }
            return true;
        });
    });
</script>
<?php
$ID = "";
$PW ="";
if (isset($_COOKIE['accountremember']['ID'])){
    $ID = $_COOKIE['accountremember']['ID'];
    $PW = $_COOKIE['accountremember']['PW'];
}
?>
<div class="panel-body">
    <form action="" id="loginUser" method="POST" role="form">
        <fieldset>
            <p class="form_item_error"><?= $this->getData('error'); ?></p>
            <div class="form-group">
                <input name="aid" id="aid" class="form-control" placeholder="ID" type="text" autofocus>
            </div>
            <div class="form-group">
                <input name="apw" id="apw" class="form-control" placeholder="Password" type="password" value="">
            </div>
            <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox" value="Remember Me">Lưu đăng nhập
                </label>
            </div>
            <!-- Change this to a button or input when using this as a form -->
            <input type="submit" class="btn btn-lg btn-success btn-block" name="" value="Đăng nhập">            
        </fieldset>
    </form>
</div>