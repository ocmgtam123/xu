<?php

class AdminuserController extends Controller {
    
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
    }
    public function indexAction() {
        $user = $this->_model->getList();
        $this->_view->setData('user', $user);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }
    public function editAction(){
        $id = (int)$this->_params['id'];
        $err="";
        $user = $this->_model->loadRecord('user', ['idx' => $id]);        
        if($user){   
            if (isset($this->_params['btnSumit'])) {
                $pass = $this->_params['pass'];
                $pass = $this->md5Password($pass);
                $data = [
                    'password' => $pass
                ];
                $result=$this->_model->updateRecord('user', $data, ['idx' => $id]);
                $_SESSION['err']="Cập nhật thành công";
                Url::header($this->route('adminuser'));
            }
            $this->_view->setData('user', $user);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo $this->_view->language("l_error_find");
            exit();
        }
    }
    public function md5Password($password) {
        return md5($password);
    }
    public function loginAction() {
        $this->isLoginAdmin(true);
        if (isset($this->_params['aid'])) {
            if ($this->_params['aid'] && $this->_params['apw']) {
                $login = $this->_model->loadRecord('user', [
                    'ID' => $this->_params['aid'],
                    'password' => $this->md5Password($this->_params['apw'])
                ]);
                if ($login) {
                    $timeout = strtotime("+30 days");
                    setcookie("accountremember[ID]", $this->_params['aid'], $timeout);
                    setcookie("accountremember[PW]", $this->_params['apw'], $timeout);
                    if ($login['status'] == 0) {
                        $this->setError($this->_view->getItem('language', 'l_accountunactive'));
                    } else {
                        Session::set('lang', $login['lang']);
                        Session::set('hollywoodadmin', [
                            'ID' => $login['ID'],
                            'area' => $login['area'],
                        ]);
                        if (isset($this->_params['achecked']) && $this->_params['achecked'] == 'on') {
                            $timeout = strtotime("+30 days");
                            setcookie("hollywoodadmin[ID]", $login['ID'], $timeout);
                            setcookie("hollywoodadmin[area]", $login['area'], $timeout);
                        } else {
                            $timeout = time() - 3600;
                            setcookie("hollywoodadmin[ID]", "", $timeout);
                        }
                        $this->isLoginAdmin(true);
                    }
                } else {
                    $this->setError($this->_view->getItem('language', 'l_notidpw'));
                }
            }
        }
        $this->_view->setData('error', $this->getError());
        $this->_view->setFileTemplate('login', 'temple_admin');
        $this->_view->render('login');
    }    
    public function loginAjax() {
        $club=$this->_params['club'];
        $desk=$this->_params['desk'];
        Session::set('hollywoodadmin', [
            'ID' => $club,
            'area' => $desk ]);
        $timeout = strtotime("+30 days");
        setcookie("hollywoodadmin[ID]",$club, $timeout);
        setcookie("hollywoodadmin[area]", $desk, $timeout);
        $result['flag']=true;
        echo json_encode($result);
    }
    public function logoutAction() {
        $timeout = time() - 3600;
        if (Session::get('hollywoodadmin')) {
            Session::delete('hollywoodadmin');
            setcookie("hollywoodadmin[ID]", '', $timeout);
            setcookie("hollywoodadmin[area]", '', $timeout);
            Url::header($this->route('adminlogin'));
        }
        $this->isLogin();
    }
    
}

?>