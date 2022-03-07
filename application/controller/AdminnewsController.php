<?php
class AdminnewsController extends Controller {
    
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);
        $this->isLoginAdmin();
    }
    // Phương thức index
    public function indexAction() {
        $news = $this->_model->getList();
        $this->_view->setData('news', $news);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }
    public function addAction() {
        $err='';
        if (isset($this->_params['btnSumit'])) {
            $title = $this->_params['title'];
            $longtitle = $this->_params['longtitle'];
            $status = $this->_params['status'];            
            $create_at = date("Y-m-d H:i:s");
            $content = $this->_params['content'];
            $slug = $this->_params['slug'];            
            if($slug==""){
                $slug= Func::Link2(Func::stripUnicode($title));
            }
            $data = [
                'title' => $title,
                'longtitle' => $longtitle,
                'status' => $status,
                'create_at' => $create_at,
                'content' => $content,
                'slug' => $slug
            ];
            if($title==""){
                $err.="Bạn chưa nhập tiêu đề <br/>";
            }else{
                $check=$this->_model->checkexitName($title);
                if($check){
                    $err.="Tiêu đề này đã tồn tại <br/>";
                }
            }
            $check=$this->_model->checkexitSlug($slug);
            if($check){
                $err.="Slug này đã tồn tại <br/>";
            }
            
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
                                move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/news/' . $newfilename);
                                $data['image']="/upload/news/".$newfilename;
                            }else{
                                $err.=$this->_view->language("l_eror_size_img");
                            }
                        }else{
                            $err.=$this->_view->language("l_error_type_file");
                        }
                    }
            }
            if($err==""){
                $result=$this->_model->insertRecord('news', $data);
                $_SESSION['err']="Thêm thành công";
                Url::header($this->route('adminnews'));
            }else{
                $this->_view->setData('err', $err);
                $this->_view->setData('title', $title);
                $this->_view->setData('longtitle', $longtitle);
                $this->_view->setData('status', $status);
                $this->_view->setData('content', $content);
                $this->_view->setData('slug', $slug);
                $this->_view->setFileTemplate('web', 'temple_admin');
                $this->_view->render('add');
            }
        }
        $this->_view->setData('err', $err);        
        $this->_view->setData('title', "");
        $this->_view->setData('longtitle', "");
        $this->_view->setData('status', 1);
        $this->_view->setData('content', $content);
        $this->_view->setData('slug', "");
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('add');
    }
    public function editAction(){
        $id = (int)$this->_params['id'];
        $err="";
        $news = $this->_model->loadRecord('news', ['id' => $id]);
        if($news){
            if (isset($this->_params['btnSumit'])) {
                $title = $this->_params['title'];
                $longtitle = $this->_params['longtitle'];
                $status = $this->_params['status'];
                $create_at = date("Y-m-d H:i:s");
                $content = $this->_params['content'];
                $slug = $this->_params['slug'];
                if($slug==""){
                    $slug= Func::Link2(Func::stripUnicode($title));
                }
                $data=array();
                $data = [
                    'title' => $title,
                    'longtitle' => $longtitle,
                    'status' => $status,
                    'create_at' => $create_at,
                    'content' => $content,
                    'slug' => $slug
                ];
                if($title==""){
                    $err.="Bạn chưa nhập tiêu đề <br/>";
                }else{
                    $check1=$this->_model->checkexitNameid($id,$title);
                    if($check1){
                        $err.="Tiêu đề này đã tồn tại <br/>";
                    }
                }
                $check=$this->_model->checkexitSlugid($id,$slug);
                if($check){
                    $err.="Slug này đã tồn tại <br/>";
                }
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
                                    move_uploaded_file($_FILES['image']['tmp_name'], PATH_ROOT.'/upload/news/' . $newfilename);
                                    $data['image']="/upload/news/".$newfilename;
                                }else{
                                    $err.=$this->_view->language("l_eror_size_img") . "<br/>";
                                }
                            }else{
                                $err.=$this->_view->language("l_error_type_file") . "<br/>";
                            }
                        }
                }
                if($err==""){
                    $result=$this->_model->updateRecord('news', $data, ['id' => $id]);
                    $_SESSION['err']="Cập nhật thành công";
                    Url::header($this->route('adminnews'));
                }else{
                    $this->_view->setData('err', $err);
                    $this->_view->setData('news', $news);
                    $this->_view->setFileTemplate('web', 'temple_admin');
                    $this->_view->render('edit');
                }
            }
            $this->_view->setData('news', $news);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo $this->_view->language("l_error_find");
            exit();
        }
    }
    public function deletenewsAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];
            $where['id'] = $id;
            $item = $this->_model->deleteRecord('news',$where);
            $result['flag'] = true;
            $result['id'] = $id;
            $result['mess'] = "Xóa thành công";
        }
        echo json_encode($result);
    }
}

?>