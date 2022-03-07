<?php
class Controller {
    
    // BiÃ¡ÂºÂ¿n lÃ†Â°u giÃƒÂ¡ trÃ¡Â»â€¹ $_POS And $_GET
    protected $_params;
    
    // BiÃ¡ÂºÂ¿n lÃ†Â°u giÃƒÂ¡ trÃ¡Â»â€¹ input text or texteara
    protected $_inputs;
    
    // BiÃ¡ÂºÂ¿n Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng Model
    protected $_model;
    
    // BiÃ¡ÂºÂ¿n Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng View
    protected $_view;
    
    // BiÃ¡ÂºÂ¿n Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng json
    protected  $_json;
    
    // BiÃ¡ÂºÂ¿n lÃ†Â°u giÃƒÂ¡ trÃ¡Â»â€¹ lÃ¡Â»â€”i
    protected $_error;
    
    // PhÃ†Â°Ã†Â¡ng thÃ†Â°Ã¡Â»â€ºc khÃ¡Â»Å¸i tÃ¡ÂºÂ¡o
    public function __construct($params) {
        $this->setParams ( $params );
        $this->setJson();
        $this->setModel();
        $this->setView();
        $this->setJsData();
        $this->initData();
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thiÃ¡ÂºÂ¿t lÃ¡ÂºÂ­p tham sÃ¡Â»â€˜
    public function setParams($params) {
        $this->_params = $params;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thiÃ¡ÂºÂ¿t lÃ¡ÂºÂ­p data js
    public function setJsData(){
        if( isset($this->_params['route'])){
            $this->_view->setData('jsData', [
                'urlAjax' => $this->route('ajax', ['controller'=> $this->_params['controller'] . '/']),
                'control'=>$this->_params['controller'],
                'action'=>$this->_params['action']
            ]);
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c khÃ¡Â»Å¸i tÃ¡ÂºÂ¡o Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng Model tÃ†Â°Ã†Â¡ng Ã¡Â»Â©ng vÃ¡Â»â€ºi Controller
     * $modelName lÃƒÂ  tÃƒÂªn model Ã„â€˜Ã†Â°Ã¡Â»Â£c truyÃ¡Â»ï¿½n vÃƒÂ o
     */
    public function setModel() {
        if(isset($this->_params ['controller'])){
            $modelName = ucfirst($this->_params ['controller']) . 'Model';
            $fileName = PATH_APPLICATION . DS . 'model' . DS . $modelName . '.php';
            if (file_exists ( $fileName )) {
                require_once $fileName;
                $this->_model = new $modelName ();
            }
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c khÃ¡Â»Å¸i tÃ¡ÂºÂ¡o Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng View */
    public function setView() {
        $this->_view = new View ( $this->_params );
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c khÃ¡Â»Å¸i tÃ¡ÂºÂ¡o Ã„â€˜Ã¡Â»â€˜i tÃ†Â°Ã¡Â»Â£ng Json */
    public function setJson() {
        $this->_json = new Json();
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thiÃ¡ÂºÂ¿t lÃ¡ÂºÂ­p ngÃƒÂ´n ngÃ¡Â»Â¯ */
    public function setLanguageAjax() {
        if($this->_params['controller']){
            $filename = PATH_LANG;
            if(isset($this->_params['lang'])){
                Session::set('lang', $this->_params['lang']);
            }
            if(Session::get('lang')){
                $filename .= Session::get('lang');
                // if(Session::get('accountshopping') !== false && Session::get('accountshopping')['area'] != Session::get('lang')){
                //     $_SESSION['accountshopping']['area'] = Session::get('lang');
                //     $this->_model->updateRecord('user', ['lang'=>Session::get('lang')], ['ID'=>Session::get('accountshopping')['ID']]);
                // }
            }else{
                $filename .= DEFAULT_LANG;
                Session::set('lang', DEFAULT_LANG);
            }
            $language = require $filename . '.php';
            Helper::setLanguage($language);
            OfficeExcel::setLanguage($language);
            $this->_view->setData('language', $language);
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c kiÃ¡Â»Æ’m tra ngÃ†Â°Ã¡Â»ï¿½i dÃƒÂ¹ng Ã„â€˜Ã„Æ’ng nhÃ¡ÂºÂ­p
     * $flag: true khÃƒÂ´ng Ã„â€˜Ã„Æ’ng nhÃ¡ÂºÂ­p khÃƒÂ´ng chuyÃ¡Â»Æ’n trang, Ã„â€˜ÃƒÂ£ Ã„â€˜Ã„Æ’ng nhÃ¡ÂºÂ­p chuyÃ¡Â»Æ’n trang
     * $flag: false khÃƒÂ´ng Ã„â€˜Ã„Æ’ng nhÃ¡ÂºÂ­p Ã„â€˜Ã†Â°Ã¡Â»Â£c chuyÃ¡Â»Æ’n trang, Ã„â€˜ÃƒÂ£ Ã„â€˜Ã„Æ’ng nhÃ¡ÂºÂ­p khÃƒÂ´ng chuyÃ¡Â»Æ’n trang
     */
    public function isLoginAdmin($flag = false) {
        // Check Cookie
        if (Session::get ( 'hollywoodadmin' ) == false && isset($_COOKIE['hollywoodadmin']['ID'])){
            Session::set ( 'hollywoodadmin', $_COOKIE['hollywoodadmin']);
        }
        if (Session::get ( 'hollywoodadmin' ) == false) {
            if($flag === false){
                Url::header($this->route('adminlogin'));
            }
        } else {
            
            if ($flag === true) {
                // Kiểm tra đường dẫn để chuyển hướng
                Url::header($this->route('adminorder'));
            }
            
        }
    }
    
    public function isLogin($flag = false) {
        // Check Cookie
        if (Session::get ( 'accountshopping' ) == false && isset($_COOKIE['accountshopping']['ID'])){
            Session::set ( 'accountshopping', $_COOKIE['accountshopping']);
        }
        if (Session::get ( 'accountshopping' ) == false) {
            if($flag === false){
                Url::header($this->route('login'));
            }
        } else {
            if ($flag === true) {
                // Kiểm tra đường dẫn để chuyển hướng
                Url::header($this->route('home'));
            }
            
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c lÃ¡ÂºÂ¥y giÃƒÂ¡ trÃ¡Â»â€¹ tÃ¡Â»Â« form input hoÃ„Æ’c texteara vÃƒÂ  trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ giÃƒÂ¡ trÃ¡Â»â€¹ cÃ¡Â»Â§a mÃ¡ÂºÂ£ng
     * $Option lÃƒÂ  mÃ¡ÂºÂ£ng truyÃ¡Â»ï¿½n vÃƒÂ o vÃ¡Â»â€ºi tÃƒÂªn cÃ¡Â»Â§a input
     * $prefix lÃƒÂ  tiÃ¡Â»ï¿½n tÃ¡Â»â€˜ cÃ¡Â»Â§a bÃ¡ÂºÂ£ng trong sql
     */
    public function setInputs($option = array(), $prefix = NULL) {
        if ($option) {
            $prefix = ($prefix !== NULL) ? $prefix .= '_' : '';
            foreach ( $option as $name ) {
                if (! empty ( $_POST )) {
                    $this->_inputs [$prefix . $name] = ((isset ( $_POST [$name] )) ? trim ( $_POST [$name] ) : '');
                    continue;
                }
                if (isset ( $_FILES [$name] )) {
                    if ($_FILES [$name] ['error'] == 0) {
                        $this->_inputs [$prefix . $name] = $_FILES [$name] ['name'];
                    }
                }
            }
            return $this->_inputs;
        }
        return false;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c thÃƒÂªm 1 phÃ¡ÂºÂ§n tÃ¡Â»Â­ vÃƒÂ o mÃ¡ÂºÂ£ng input hoÃ„Æ’c texteara*/
    public function appendInput($key, $value) {
        $this->_inputs[$key] = $value;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ mÃ¡ÂºÂ£ng tÃ¡Â»Â« form input hoÃ„Æ’c texteara */
    public function getInputs($key = NULL){
        if($key == NULL){
            return $this->_inputs;
        }else{
            if(isset($this->_inputs[$key])){
                return $this->_inputs[$key];
            }else{
                $this->setError($this->_view->getItem('language', 'l_inputisset'));
            }
            return '';
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c kiÃ¡Â»Æ’m tra giÃƒÂ¡ trÃ¡Â»â€¹ rÃ¡Â»â€”ng cÃ¡Â»Â§a phÃ¡ÂºÂ§n tÃ¡Â»Â­ mÃ¡ÂºÂ£ng input hoÃ¡ÂºÂ·c texteara */
    public function isInputs($option = array()) {
        if ($option) {
            foreach ( $option as $name ) {
                if(empty($this->getInputs($name))){
                    $this->setError($this->_view->getItem('language', 'l_inputempty'));
                    break;
                }
            }
            return ($this->isError()) ? false : true;
        }
        return false;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ†Â°ÃŒï¿½c gÃ†Â°ÃŒâ€°i dÃ†Â°ÃŒÆ’ liÃƒÂªÃŒÂ£u Ã„â€˜ÃƒÂªÃŒï¿½n mÃƒÂ´ÃŒÂ£t trang */
    public function postCurl($url, $data){
        if($url && $data){
            $curl = curl_init($url);
            $content = json_encode($data);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c gÃƒÂ¡n giÃƒÂ¡ trÃ¡Â»â€¹ lÃ¡Â»â€”i */
    public function setError($error){
        $this->_error = $error;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c kiÃ¡Â»Æ’m tra lÃ¡Â»â€”i
     * True: cÃƒÂ³ lÃ¡Â»â€”i
     * False: khÃƒÂ´ng cÃƒÂ³ lÃ¡Â»â€”i
     */
    public function isError(){
        if(empty($this->_error)){
            return false;
        }
        return true;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ giÃƒÂ¡ trÃ¡Â»â€¹ lÃ¡Â»â€”i */
    public function getError(){
        return $this->_error;
    }
    
    /* PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c chuyÃ¡Â»Æ’n vÃ¡Â»ï¿½ trang lÃ¡Â»â€”i */
    public function pageError(){
        $this->_view->setFileTemplate('error');
        require_once $this->_view->_fileTemplate;
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c lÃ¡ÂºÂ¥y ra Ã„â€˜Ã†Â°Ã¡Â»ï¿½ng dÃ¡ÂºÂ«n route
    public function route($name, $options = []){
        if($this->_params['route']){
            return $this->_params['route']->getUrl($name, $options);
        }
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c chuyÃ¡Â»Æ’n Ã„â€˜Ã¡Â»â€¢i ngÃƒÂ´n ngÃ¡Â»Â¯ lÃ¡Â»â€”i cho class upload
    public function convertErrUpload($error){
        if($error=='errExtension'){
            return $this->_view->getItem('language', 'l_errExtension') . ' ( '.FILE_EXTENSION.' )';
        }
        if($error=='errSize'){
            return $this->_view->getItem('language', 'l_errSize') . ' '.FILE_SIZE;
        }
        if($error=='errFolder'){
            return $this->_view->getItem('language', 'l_errFolder');
        }
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c kiÃ¡Â»Æ’m tra ID
    public function checkIDAjax()
    {
        $result = ['flag'=>false];
        if ($this->_params['aid']) {
            if ($this->_model->loadRecord('user', [
                'ID' => $this->_params['aid']
            ]) == false) {
                $result['flag'] = true;
            }
        }
        echo json_encode($result);
    }
    public function addCartAjax()
    {
        $result = ['flag'=>false];
        if (isset($this->_params['id'])&&isset($this->_params['quantity'])) {
            $idproduct=$this->_params['id'];
            $quantity=$this->_params['quantity'];
            $product=$this->_model->loadRecord('product', ['id' => $idproduct]);
            if($product){
                if(!isset($_SESSION["cart"][$idproduct])){
                    $_SESSION["cart"][$idproduct]=array(
                        "name"=>$product['name'],
                        "image"=>$product['image'],
                        "price"=>$product['price'],
                        "pricesale"=>$product['pricesale'],
                        "quantity"=>$quantity
                    );
                }else{
                    $_SESSION["cart"][$idproduct]["quantity"]+=$quantity;
                }
                $result['flag'] = true;
            }            
        }
        echo json_encode($result);
    }
    public function removeCartAjax()
    {
        $result = ['flag'=>false];
        if (isset($this->_params['id'])) {
            $idproduct=$this->_params['id'];    
            if(Session::get ( 'cart' ) && isset(Session::get ('cart')[$idproduct])){
                $cartinfo = Session::get ('cart');
                unset($cartinfo[$idproduct]);
                Session::set ('cart', $cartinfo);
                $result['flag'] = true;
            }                                   
        }
        echo json_encode($result);
    }
    
    // PhÃ†Â°Ã†Â¡ng thÃ¡Â»Â©c trÃ¡ÂºÂ£ vÃ¡Â»ï¿½ tham sÃ¡Â»â€˜ pagination
    public function paginationParams($count, $link, $ditance = 5){
        $length = ($this->_params['length']?$this->_params['length']:DEFAULT_LENGTH);
        $pageCurrent = ($this->_params['page']?$this->_params['page']:1);
        $begin = ($pageCurrent - 1) * $length;
        $pageTotal = ceil($count / $length);
        $pagination = '';
        if($pageTotal > 1){
            $start = 1;
            $end = $pageTotal;
            if($pageTotal > $ditance){
                $ditance1 = floor($ditance / 2);
                $start = $pageCurrent - $ditance1;
                $end = $pageCurrent + $ditance1;
                if($start<1){
                    $start = 1;
                    $end = $ditance;
                }
                if($end>$pageTotal){
                    $start = $pageTotal- $ditance;
                    $end = $pageTotal;
                }
            }
            $pagination= Helper::createPagination($pageTotal, $pageCurrent, $start, $end, $length, $link);
        }
        return [
            'count'=>$count,
            'length'=>$length,
            'begin'=>$begin,
            'pagination'=>$pagination
        ];
    }
    public function paginationParamsmobi($count, $link, $ditance = 5){
        $length = ($this->_params['length']?$this->_params['length']:100);
        $pageCurrent = ($this->_params['page']?$this->_params['page']:1);
        $begin = ($pageCurrent - 1) * $length;
        $pageTotal = ceil($count / $length);
        $pagination = '';
        if($pageTotal > 1){
            $start = 1;
            $end = $pageTotal;
            if($pageTotal > $ditance){
                $ditance1 = floor($ditance / 2);
                $start = $pageCurrent - $ditance1;
                $end = $pageCurrent + $ditance1;
                if($start<1){
                    $start = 1;
                    $end = $ditance;
                }
                if($end>$pageTotal){
                    $start = $pageTotal- $ditance;
                    $end = $pageTotal;
                }
            }
            $pagination= Helper::createPagination($pageTotal, $pageCurrent, $start, $end, $length, $link);
        }
        return [
            'count'=>$count,
            'length'=>$length,
            'begin'=>$begin,
            'pagination'=>$pagination
        ];
    }
    public function createPagination($page , $count, $link1,$link2, $ditance = 5){
        
        $total_records = $count;
        $page=$page;
        $total_records_per_page = DEFAULT_LENGTH_PAGING;
        $offset = ($page-1) * $total_records_per_page;
        $previous_page = $page - 1;
        $next_page = $page + 1;
        $adjacents = "2";
        $total_no_of_pages = ceil($total_records / $total_records_per_page);
        $second_last = $total_no_of_pages - 1; // total page minus 1
        $str="";
        $str.='<ul class="pagination" style="    margin: 5px -10px 0px 0px;">';
        //if($page > 1){ $str.="<li><a href='".$link1.$previous_page.$link2."'>First Page</a></li>"; }
        
        
        $str.='<li '.(($page <= 1)?"class='disabled'":"").'>';
        $str.='  <a '.(($page > 1)?"href='".$link1.$previous_page.$link2."'":"").' class=" fa fa-angle-left "></a>';
        $str.='</li>';
        
        
        if ($total_no_of_pages <= 5){
            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                if ($counter == $page) {
                    $str.= "<li class='active'><a>$counter</a></li>";
                }else{
                    $str.= "<li><a href='".$link1.$counter.$link2."'>$counter</a></li>";
                }
            }
        }
        elseif($total_no_of_pages > 5){
            
            if($page <= 3) {
                for ($counter = 1; $counter < 6; $counter++){
                    if ($counter == $page) {
                        $str.= "<li class='active'><a>$counter</a></li>";
                    }else{
                        $str.= "<li><a href='".$link1.$counter.$link2."'>$counter</a></li>";
                    }
                }
                //                     $str.= "<li><a>...</a></li>";
                //                     $str.= "<li><a href='".$link1.$second_last.$link2."'>$second_last</a></li>";
                //                     $str.= "<li><a href='".$link1.$total_no_of_pages.$link2."'>$total_no_of_pages</a></li>";
            }
            
            elseif($page > 3 && $page <= $total_no_of_pages - 3) {
                //         	    $str.= "<li><a href='".$link1.'1'.$link2."'>1</a></li>";
                //         	    $str.= "<li><a href='".$link1.'2'.$link2."'>2</a></li>";
                //         		$str.= "<li><a>...</a></li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page) {
                        $str.= "<li class='active'><a>$counter</a></li>";
                    }else{
                        $str.= "<li><a href='".$link1.$counter.$link2."'>$counter</a></li>";
                    }
                }
                //                $str.= "<li><a>...</a></li>";
                //                $str.= "<li><a href='".$link1.$second_last.$link2."'>$second_last</a></li>";
                //                $str.= "<li><a href='".$link1.$total_no_of_pages.$link2."'>$total_no_of_pages</a></li>";
            }else {
                //     		    $str.= "<li><a href='".$link1.'1'.$link2."'>1</a></li>";
                //     		    $str.= "<li><a href='".$link1.'2'.$link2."'>2</a></li>";
                //     		    $str.= "<li><a>...</a></li>";
                
                for ($counter = $total_no_of_pages - 4; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page) {
                        $str.= "<li class='active'><a>$counter</a></li>";
                    }else{
                        $str.= "<li><a href='".$link1.$counter.$link2."'>$counter</a></li>";
                    }
                }
            }
        }
        
        $str.='<li '.(($page >= $total_no_of_pages)?"class='disabled'":"" ).'> ';
        $str.='	<a '.(($page < $total_no_of_pages)?"href='".$link1.$next_page.$link2."'":"" ). ' class=" fa fa-angle-right"></a> ';
        $str.='	</li> ';
        if($page < $total_no_of_pages){
            //$str.="<li><a href='".$link1.$total_no_of_pages.$link2."'>Last &rsaquo;&rsaquo;</a></li>";
        }
        $str.='</ul>';
        
        return $str;
    }
    
    public function initData() {        
        $info = $this->_model->getInfo();
        $this->_view->setData('info', $info);
        $follow = $this->_model->getListfollow();
        $this->_view->setData('follow', $follow);
    }
}
?>