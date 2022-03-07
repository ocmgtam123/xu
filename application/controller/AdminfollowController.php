<?php
class AdminfollowController extends Controller {
    
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
        $this->isLoginAdmin();
    }
    // Phương thức index
    public function indexAction() {
        $follow = $this->_model->getList();
        $this->_view->setData('follow', $follow);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }
    public function editAction()
    {
        $id = (int)$this->_params['id'];
        $err="";
        $follow = $this->_model->loadRecord('follow', ['id' => $id]);
        if($follow){
            if (isset($this->_params['btnSumit'])) {
                $name = $this->_params['name'];
                $link = $this->_params['link'];
                $icon = $this->_params['icon'];
                $status = $this->_params['status'];
                $data=array();
                $data = [
                    'name' => $name,
                    'link' => $link,
                    'icon' => $icon,
                    'status' => $status
                ];
                if($name==""){$err.=$this->_view->language("l_error_name")."<br/>";}
                if($err==""){
                    $result=$this->_model->updateRecord('follow', $data, ['id' => $id]);
                    $_SESSION['err']=$this->_view->language("l_update_success");
                    Url::header($this->route('adminfollow'));
                }else{
                    $this->_view->setData('err', $err);
                    $this->_view->setData('follow', $follow);
                    $this->_view->setFileTemplate('web', 'temple_admin');
                    $this->_view->render('edit');
                }
            }
            $this->_view->setData('follow', $follow);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo $this->_view->language("l_error_find");
            exit();
        }
    }
}

?>