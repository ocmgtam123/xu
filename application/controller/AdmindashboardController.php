<?php
class AdmindashboardController extends Controller {
    
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
        $this->isLoginAdmin();
    }
    // Phương thức index
    public function indexAction() {
        $banner = $this->_model->getList();
        $this->_view->setData('banner', $banner);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }
    public function addAction() {
        $err='';
        $pos='';
        $link='';
        $status=1;
        if (isset($this->_params['btnSumit'])) {
            $pos = $this->_params['pos'];
            $link = $this->_params['link'];
            $status = $this->_params['status'];
            $data=array();
            $data = [
                'pos' => $pos,
                'link' => $link,
                'status' => $status
            ];
            
            if ( $_FILES['image']['name']!="") {
                if ($_FILES['image']['error'] > 0)
                    $err.=$this->_view->language("l_upload_file") . "<br/>";
                    else {
                        $temp = explode(".", $_FILES["image"]["name"]);
                        $allowedExts = array("gif", "jpeg", "jpg", "png");
                        $extension = end($temp);
                        if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                            if(($_FILES["image"]["size"] < 5120000)){
                                $newfilename = round(microtime(true)) . '.' . end($temp);
                                move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/banner/' . $newfilename);
                                $data['image']="/upload/banner/".$newfilename;
                            }else{
                                $err.=  $this->_view->language("l_error_size_img");
                            }
                        }else{
                            $err.= $this->_view->language("l_error_type_file") . "<br/>";
                        }
                    }
            }else{
                $err.=$this->_view->language("l_null_img")."<br/>";
            }
            if($err==""){
                $result=$this->_model->insertRecord('banner', $data);
                $id = $this->_model->getLastId();
                $_SESSION['err']=$this->_view->language("l_add_success");
                Url::header($this->route('admindashboard'));
            }else{
                $this->_view->setData('err', $err);
                $this->_view->setData('pos', $pos);
                $this->_view->setData('link', $link);
                $this->_view->setData('status', $status);
                $this->_view->setFileTemplate('web', 'temple_admin');
                $this->_view->render('add');
            }
        }
        $this->_view->setData('err', $err);
        $this->_view->setData('pos', $pos);
        $this->_view->setData('link', $link);
        $this->_view->setData('status', $status);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('add');
    }
    public function editAction(){
        $id = (int)$this->_params['id'];
        $err="";
        $banner = $this->_model->loadRecord('banner', ['id' => $id]);
        if($banner){
            if (isset($this->_params['btnSumit'])) {
                $pos = $this->_params['pos'];
                $link = $this->_params['link'];
                $status = $this->_params['status'];
                $data=array();
                $data = [
                    'pos' => $pos,
                    'link' => $link,
                    'status' => $status
                ];
                if ( $_FILES['image']['name']!="") {
                    if ($_FILES['image']['error'] > 0)
                        $err.=$this->_view->language("l_upload_file") . "<br/>";
                        else {
                            $temp = explode(".", $_FILES["image"]["name"]);
                            $allowedExts = array("gif", "jpeg", "jpg", "png");
                            $extension = end($temp);
                            if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && in_array($extension, $allowedExts)) {
                                if(($_FILES["image"]["size"] < 5120000)){
                                    $newfilename = round(microtime(true)) . '.' . end($temp);
                                    move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/banner/' . $newfilename);
                                    $data['image']="/upload/banner/".$newfilename;
                                }else{
                                    $err.=$this->_view->language("l_error_size_img");
                                }
                            }else{
                                $err.=$this->_view->language("l_error_type_file") . "<br/>";
                            }
                        }
                }
                if($err==""){
                    $result=$this->_model->updateRecord('banner', $data, ['id' => $id]);
                    $_SESSION['err']=$this->_view->language("l_update_success");
                    Url::header($this->route('admindashboard'));
                }else{
                    $this->_view->setData('err', $err);
                    $this->_view->setData('banner', $banner);
                    $this->_view->setFileTemplate('web', 'temple_admin');
                    $this->_view->render('edit');
                }
            }
            $this->_view->setData('banner', $banner);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo $this->_view->language("l_error_find");
            exit();
        }
    }
    public function deletebannerAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];
            $where['id'] = $id;
            $item = $this->_model->deleteRecord('banner',$where);
            $result['flag'] = true;
            $result['id'] = $id;
            $result['mess'] = "Xóa banner thành công";
        }
        echo json_encode($result);
    }
}

?>