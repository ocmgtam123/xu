<?php
class AdminproductController extends Controller {
    
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
        $this->isLoginAdmin();
    }
    // Phương thức index
    public function indexAction() {
        $sql = 'SELECT p.* FROM product p WHERE p.isDelete=0 ORDER BY p.id DESC';
        $this->_model->setQuery($sql);
        $product = $this->_model->readAll();
        $this->_view->setData('product', $product);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }
    public function addAction() {        
        $err='';
        if (isset($this->_params['btnSumit'])) {
            $name = $this->_params['name'];
            $price = $this->_params['price'];
            $price = str_replace(',', '', $price);
            $pricesale = $this->_params['pricesale'];
            $pricesale = str_replace(',', '', $pricesale);
            if($pricesale==""){
                $pricesale=$price;
            }
            $status = $this->_params['status'];
            $content = $this->_params['content'];
            $nameimages = $this->_params['nameimages'];
            $slug = $this->_params['slug'];
            if($slug==""){
                $slug= Func::Link2(Func::stripUnicode($name));
            }
            $data = [
                'name' => $name,
                'price' => $price,
                'pricesale' => $pricesale,
                'status' => $status,
                'content' => $content,
                'slug' => $slug
            ];
            if($name==""){
                $err.="Bạn chưa nhập tên sản phẩm <br/>";
            }else{
                $check=$this->_model->checkexitName($name);
                if($check){
                    $err.="Tên sản phẩm này đã tồn tại <br/>";
                }
            }
            if($price==""){
                $err.="Bạn chưa nhập giá sản phẩm <br/>";
            }
            if($nameimages==""){
                $err.="Bạn chưa upload hình đại diện <br/>";
            }
            $check=$this->_model->checkexitSlug($slug);
            if($check){
                $err.="Slug này đã tồn tại <br/>";
            }
            /*if ( $_FILES['image']['name']!="") {
                if ($_FILES['image']['error'] > 0)
                    $err.=$this->_view->language("l_upload_file") . "<br/>";
                    else {
                        $temp = explode(".", $_FILES["image"]["name"]);
                        $allowedExts = array("gif", "jpeg", "jpg", "png");
                        $extension = end($temp);
                        if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && ($_FILES["image"]["size"] < 5120000) && in_array($extension, $allowedExts)) {
                            $newfilename = round(microtime(true)) . '.' . end($temp);
                            move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/' . $newfilename);
                            $data['image']="/upload/".$newfilename;
                        }else{
                            $err.=$this->_view->language("l_error_type_file") . "<br/>";
                        }
                    }
            }else{
                $err.="l_null_avatar <br/>";
            }*/
            if($err==""){
                $result=$this->_model->insertRecord('product', $data);
                $_SESSION['err']="Thêm sản phẩm thành công"; 
                Url::header($this->route('adminproduct'));
            }else{
                $this->_view->setData('err', $err);                              
                $this->_view->setData('name', $name);
                $this->_view->setData('price', $price);
                $this->_view->setData('content', $content);
                $this->_view->setData('status', $status);
                $this->_view->setData('slug', $slug);
                $this->_view->setData('nameimages', $nameimages);
                $this->_view->setFileTemplate('web', 'temple_admin');
                $this->_view->render('add');
            }
        }
        $this->_view->setData('err', $err);        
        $this->_view->setData('name', "");
        $this->_view->setData('price', 0);
        $this->_view->setData('pricesale', "");
        $this->_view->setData('content', "");
        $this->_view->setData('slug', "");
        $this->_view->setData('status', 1);
        $this->_view->setData('nameimages', "");
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('add');
    }
    public function editAction(){
        $id = (int)$this->_params['id'];
        $product = $this->_model->loadRecord('product', ['id' => $id]);
        if($product){
            $err='';
            if (isset($this->_params['btnSumit'])) {
                $name = $this->_params['name'];
                $price = $this->_params['price'];
                $price = str_replace(',', '', $price);
                $pricesale = $this->_params['pricesale'];
                $pricesale = str_replace(',', '', $pricesale);
                $content = $this->_params['content'];
                $slug = $this->_params['slug'];
                if($slug==""){
                    $slug= Func::Link2(Func::stripUnicode($name));
                }
                $status = $this->_params['status'];
                $data = [
                    'name' => $name,
                    'price' => $price,
                    'pricesale' => $pricesale,
                    'content' => $content,
                    'slug' => $slug,
                    'status' => $status
                ];
                if($name==""){
                    $err.="Bạn chưa nhập tên sản phẩmbr/>";
                }else{
                    $check=$this->_model->checkexitNameVNid($id,$name);
                    if($check){
                        $err.="Tên sản phẩm này đã tồn tại <br/>";
                    }
                }
                $check=$this->_model->checkexitSlugid($id,$slug);
                if($check){
                    $err.="Slug này đã tồn tại <br/>";
                }
                if($price==""){
                    $err.="Bạn chưa nhập giá bán <br/>";
                }
                if ($_FILES['image']['name']!=""){
                    if ($_FILES['image']['error'] > 0)
                        $err.=$this->_view->language("l_upload_file") . "<br/>";
                        else {
                            $temp = explode(".", $_FILES["image"]["name"]);
                            $allowedExts = array("gif", "jpeg", "jpg", "png");
                            $extension = end($temp);
                            if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && ($_FILES["image"]["size"] < 5120000) && in_array($extension, $allowedExts)) {
                                $newfilename = round(microtime(true)) . '.' . end($temp);
                                move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/' . $newfilename);
                                $data['image']="/upload/".$newfilename;
                            }else{
                                $err.=$this->_view->language("l_error_type_file")."br/>";
                            }
                        }
                }
                if($err==""){
                    $result=$this->_model->updateRecord('product', $data, ['id' => $id]);
                    $_SESSION['err']=$this->_view->language("l_update_success");
                    Url::header($this->route('adminproduct'));
                }else{
                    $this->_view->setData('err', $err);
                    $this->_view->setData('product', $product);
                    $this->_view->setFileTemplate('web', 'temple_admin');
                    $this->_view->render('edit');
                }
            }
            $this->_view->setData('product', $product);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo $this->_view->language("l_error_find");
            exit();
        }
    }
    public function deleteproductAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];
            $data = [
                'isDelete' => 1,
                'status' => 0
            ];
            $this->_model->updateRecord('product', $data, ['id' => $id]);
            $result['flag'] = true;
            $result['id'] = $id;
            $result['mess'] = "Xóa thành công";
        }
        echo json_encode($result);
    }    
}

?>