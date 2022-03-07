<?php

class AdmininformationController extends Controller {

    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
        $this->isLoginAdmin();
    }

    // Phương thức index
    public function indexAction() {
        $information = $this->_model->getList();
        $this->_view->setData('information', $information);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }

    public function editAction() {
        $id = (int) $this->_params['id'];
        $information = $this->_model->loadRecord('information', ['id' => $id]);
        if ($information) {
            if (isset($this->_params['btnSumit'])) {
                if ($_FILES['image']['name'] != "") {
                    if ($_FILES['image']['error'] > 0)
                        $dataimage = $information["image"];
                    else {
                        $temp = explode(".", $_FILES["image"]["name"]);
                        $allowedExts = array("gif", "jpeg", "jpg", "png");
                        $extension = end($temp);
                        if ((($_FILES["image"]["type"] == "image/gif") || ($_FILES["image"]["type"] == "image/jpeg") || ($_FILES["image"]["type"] == "image/jpg") || ($_FILES["image"]["type"] == "image/pjpeg") || ($_FILES["image"]["type"] == "image/x-png") || ($_FILES["image"]["type"] == "image/png")) && ($_FILES["image"]["size"] < 5120000) && in_array($extension, $allowedExts)) {
                            $newfilename = round(microtime(true)) . '.' . end($temp);
                            move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT . '/upload/' . $newfilename);
                            $dataimage = "/upload/" . $newfilename;
                        } else {
                            $dataimage = $information["image"];
                        }
                    }
                } else {
                    $dataimage = $information["image"];
                }
                $content = $this->_params['content'];
                $des = $this->_params['des'];
                $data = [
                    'des' => $des,
                    'content' => $content,
                    'image' => $dataimage
                ];
                $result = $this->_model->updateRecord('information', $data, ['id' => $id]);
                $_SESSION['err'] = "Cập nhật thành công";
                Url::header($this->route('admininformation'));
            }
            $this->_view->setData('information', $information);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        } else {
            echo $this->_view->language("l_error_find");
            exit();
        }
    }

}

?>