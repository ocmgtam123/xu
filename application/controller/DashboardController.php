<?php

class DashboardController extends Controller {

    public function __construct($params) {
        parent::__construct($params);
    }

    public function homeAction() {
        $producthome = $this->_model->getListhome();
        $this->_view->setData('producthome', $producthome);
        $this->_view->render('home');
    }

    public function aboutAction() {
        $this->_view->render('about');
    }

    public function productAction() {
        $producthome = $this->_model->getListhome();
        $this->_view->setData('producthome', $producthome);
        $this->_view->render('product');
    }

    public function newsAction() {
        $page = 1;
        $length = DEFAULT_LENGTH_PAGING;
        if (isset($this->_params['page']) && $this->_params['page'] != "")
            $page = $this->_params['page'];
        $news['page'] = $page;
        $begin = ($page - 1) * $length;
        $option = [
            'sort' => [
                'column' => "create_at",
                'order' => "DESC"
            ],
            'limit' => ['position' => $begin, 'length' => $length]
        ];
        $news['data'] = $this->_model->loadRecords("news", ['status' => 1], true, $option);

        $count = $this->_model->countRowTabel("news", ['status' => 1])['record'];
        $news['paging'] = $this->createPagination($page, $count, URL_BASE . "/news", ".html");

        $this->_view->setData('news', $news);
        $this->_view->render('news');
    }

    public function newsdetailAction() {
        $slug = $this->_params['slug'];
        $news = $this->_model->loadRecord("news", ['slug' => $slug]);
        $option = [
            'sort' => [
                'column' => "create_at",
                'order' => "DESC"
            ],
            'limit' => [
                'position' => 0,
                'length' => 4
            ],
        ];
        $othernews = $this->_model->loadRecords("news", ['where' => " slug!='$slug' "], $option);

        $this->_view->setData('news', $news);
        $this->_view->setData('othernews', $othernews);

        $this->_view->render('newsdetail');
    }

    public function contactAction() {
        $this->_view->render('contact');
    }

    public function cartAction() {
        if (isset($this->_params['btnSumit'])) {
            $id = $this->_params['id'];
            $price = $this->_params['price'];
            $quantity = $this->_params['quantity'];
            $ship = $this->_params['ship'];
            $email = $this->_params['email'];
            $name = $this->_params['name'];
            $phone = $this->_params['phone'];
            $address = $this->_params['address'];
            $tranfer = $this->_params['tranfer'];
            $note = $this->_params['note'];
            $code = "WEB_" . time();
            $total = 0;
            for ($i = 0; $i < count($id); $i++) {
                $total += $price[$i] * $quantity[$i];
            }
            $order = [
                'code' => $code,
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'promotion' => $tranfer,
                'id_delivery' => 1,
                'fee_delivery' => $ship,
                'total' => $total,
                'id_payment' => 1,
                'note' => $note,
                'status' => 0,
                'created' => date("Y-m-d H:i:s"),
                'sendmail' => 0
            ];
            $id_order = $this->_model->insertRecord('order', $order);
            for ($i = 0; $i < count($id); $i++) {
                $order_detail = [
                    'id_order' => $id_order,
                    'id_product' => $id[$i],
                    'price' => $price[$i],
                    'quatity' => $quantity[$i],
                    'status' => 1
                ];
                $this->_model->insertRecord('order_detail', $order_detail);
            }
            unset($_SESSION['cart']);
            $_SESSION['ordercomplete'] = "Đặt hàng thành công. Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất";
            Url::header($this->route('home'));
        }
        $this->_view->render('cart');
    }

    public function uploadimagesAction() {
        $result="";
        if (isset($this->_params['image'])) {
            $data = $this->_params['image'];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName =  time() . '.png';
            file_put_contents($imageDirectory = PATH_ROOT.'/upload/' .$imageName, $data);            
            $result = $imageName;
        }
        echo json_encode($result);
    }
}

?>