<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title><?=$this->language("l_title_admin")?></title>
<link href="<?=URL_PUBLIC_ADMIN?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/metisMenu.min.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/timeline.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/startmin.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/morris.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?=URL_PUBLIC_ADMIN?>css/style.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?=URL_PUBLIC_ADMIN?>css/dataTables/dataTables.responsive.css" rel="stylesheet">

<script type="text/javascript" src="<?= URL_PUBLIC ?>js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?= URL_PUBLIC ?>js/jquery.main.min.js"></script>
<script type="text/javascript">
    <?php echo 'jsData=' . json_encode($this->getData('jsData')); ?>            
    var $baseUrl = "<?= URL_BASE; ?>";
</script>

<script src="<?= URL_BASE; ?>/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=URL_PUBLIC_ADMIN?>js/accounting.js"></script>
<script>
    $(document).ready(function () {
        $(".money_format").keyup(function (event) {
            if (event.which >= 37 && event.which <= 40) {
                event.preventDefault();
            }
            var $this = $(this);
            var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
            var num2 = RemoveRougeChar(num.replace(/(.{3})/g, "$1,").split("").reverse().join(""));
            $this.val(num2);
        });
    });
    function RemoveRougeChar(convertString) {
        if (convertString.substring(0, 1) == ",") {
            return convertString.substring(1, convertString.length)
        }
        return convertString;
    }
</script>