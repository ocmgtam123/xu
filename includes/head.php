<?php 
$action = isset($this->_params['action']) ? $this->_params['action'] : 'home';
$nameTitle = "Trang chủ";
if($action=='about')   $nameTitle= "Giới thiệu";
if($action=='product') $nameTitle= "Sản phẩm";
if($action=='news' || $action=='newsdetail')    $nameTitle= "Tin Tức";
if($action=='contact') $nameTitle= "Liên hệ";
if($action=='cart') $nameTitle= "Giỏ hàng";
?>

<title>Xoài Úc Cam Lâm | <?=$nameTitle?></title>
<meta charset="utf-8">
<!-- Place your kit's code here -->
<script src="https://kit.fontawesome.com/8aee9abc8a.js" crossorigin="anonymous"></script>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="<?=URL_PUBLIC?>bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?=URL_PUBLIC?>bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=URL_PUBLIC?>css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300&family=Roboto:wght@300;400&display=swap" rel="stylesheet">

<script type="text/javascript" src="<?=URL_PUBLIC?>js/jquery-3.5.1.min.js"></script>
<script><?php echo 'jsData='.json_encode($this->getData('jsData'));?></script>
<script src="<?=URL_PUBLIC?>js/jquery.main.min.js"></script>

<script type="text/javascript" src="<?= URL_PUBLIC ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?= URL_PUBLIC ?>js/script.js"></script>   
<script type="text/javascript" src="<?= URL_PUBLIC ?>js/accounting.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript" src="<?=URL_PUBLIC?>bootstrap/js/bootstrap.js"></script>
<script src="<?= URL_PUBLIC ?>bootstrap/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 

<script>
    var $baseUrl = "<?= URL_BASE; ?>";
</script>

<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "279988829015003");
  chatbox.setAttribute("attribution", "biz_inbox");
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v10.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>

<script>
    function onchangeQuantity(quantity,pos){
        var price=$("#hiddenprice"+pos).val();
        var total=parseInt(price)*parseInt(quantity);
        $("#total"+pos).html(accounting.formatNumber(Math.round(total), 0, ",", "."));
    }
    function addCart(id){
        var quantity=$("#quantity"+id).val();
        $.fn_ajax('addCart', {'id':id,'quantity':quantity} , function (results) {
            if (results.flag == true) {
                window.location.href = $baseUrl + "/cart.html";
            }else{
                alert("Error add Cart");
            }
        }, true);
    }
</script>