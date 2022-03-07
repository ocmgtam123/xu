<?php
class AdminorderController extends Controller {
        
    // Phương thức khởi tạo
    public function __construct($params) {
        parent::__construct($params);        
        //$this->isLogin();        
    }    
    // Phương thức index
    public function indexAction() {
        $sql = 'SELECT * FROM `order`';
        $this->_model->setQuery($sql);
        $order = $this->_model->readAll();
        $count0=$this->_model->getCountorderstatus(0);
        $count1=$this->_model->getCountorderstatus(1);
        $count2=$this->_model->getCountorderstatus(2);
        $count3=$this->_model->getCountorderstatus(3);
        $count4=$this->_model->getCountorderstatus(4);
        $countcancel=$this->_model->getCountorderstatus(-1);
        $this->_view->setData('order', $order);
        $this->_view->setData('countall', count($order));
        $this->_view->setData('count0', $count0);
        $this->_view->setData('count1', $count1);
        $this->_view->setData('count2', $count2);
        $this->_view->setData('count3', $count3);
        $this->_view->setData('count4', $count4);
        $this->_view->setData('countcancel', $countcancel);
        
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('index');
    }    
    public function statusAction(){
        $status = $this->_params['status'];
        $st=100;
        if($status=="start"){
            $st=0;
        }
        if($status=="confirm"){
            $st=1;
        }
        if($status=="tranfer"){
            $st=2;
        }
        if($status=="tranfercomplete"){
            $st=3;
        }
        if($status=="complete"){
            $st=4;
        }
        if($status=="cancel"){
            $st=-1;
        }
        if($st==100){
            echo "Error";            
            exit();
        }else{
            $sql = 'SELECT * FROM `order` WHERE status='.$st;
            $this->_model->setQuery($sql);
            $order = $this->_model->readAll();
            $this->_view->setData('order', $order);
            $this->_view->setData('st', $st);
            
            $count0=$this->_model->getCountorderstatus(0);
            $count1=$this->_model->getCountorderstatus(1);
            $count2=$this->_model->getCountorderstatus(2);
            $count3=$this->_model->getCountorderstatus(3);
            $count4=$this->_model->getCountorderstatus(4);
            $countcancel=$this->_model->getCountorderstatus(-1);
            $countall=$this->_model->getCountorder();
            $this->_view->setData('countall', $countall);
            $this->_view->setData('count0', $count0);
            $this->_view->setData('count1', $count1);
            $this->_view->setData('count2', $count2);
            $this->_view->setData('count3', $count3);
            $this->_view->setData('count4', $count4);
            $this->_view->setData('countcancel', $countcancel);
            
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('status');
        }
    }
    public function editAction(){
        $id_order = (int)$this->_params['id'];
        $err="";
        $sql = 'SELECT * FROM `order` ord WHERE ord.id='.$id_order;
        $this->_model->setQuery($sql);
        $order = $this->_model->read();
        if($order){
            $sql = 'SELECT od.*,p.name FROM order_detail od LEFT JOIN product p ON p.id=od.id_product WHERE od.id_order='.$id_order;
            $this->_model->setQuery($sql);
            $order_detail = $this->_model->readAll();            
            if (isset($this->_params['btnSumit'])) {
                $id = $this->_params['idproduct'];
                $price = $this->_params['price'];
                $quantity = $this->_params['quantity'];            
                $name = $this->_params['name'];
                $phone = $this->_params['phone'];
                $address = $this->_params['address'];
                $email = $this->_params['email'];
                $note = $this->_params['note'];
                $fee_delivery = $this->_params['fee_delivery'];
                $fee_delivery = str_replace(',', '', $fee_delivery);
                if($fee_delivery==""){$fee_delivery=0;}
                $total=0;
                for ($i = 0; $i < count($id); $i++) {
                    $total+=$price[$i]*$quantity[$i];
                }
                $data = [
                    'name' => $name,
                    'phone' => $phone,
                    'address' => $address,
                    'email' => $email,
                    'note' => $note,
                    'total' => $total,
                    'fee_delivery' => $fee_delivery
                ];                
                if($err==""){
                    $result=$this->_model->updateRecord('order', $data, ['id' => $id_order]);
                    
                    for ($i = 0; $i < count($id); $i++) {
                        $id_product=$id[$i];
                        $order_detail_update = [
                            'price' => $price[$i],
                            'quatity' => $quantity[$i]
                        ];
                        $this->_model->updateRecord('order_detail', $order_detail_update, ['id_order' => $id_order,'id_product' => $id_product]); 
                    }                    
                    $_SESSION['err']="Cập nhật thành công";
                    Url::header($this->route('adminorder'));
                }else{
                    $this->_view->setData('err', $err);
                    $this->_view->setData('order', $order);
                    $this->_view->setData('order_detail', $order_detail);
                    $this->_view->setFileTemplate('web', 'temple_admin');
                    $this->_view->render('edit');
                }
            }
            $this->_view->setData('order', $order);
            $this->_view->setData('order_detail', $order_detail);
            $this->_view->setFileTemplate('web', 'temple_admin');
            $this->_view->render('edit');
        }else{
            echo "Not find order";
            exit();
        }
    }
    public function addAction(){
        $err="";
        $list=$this->_model->getListproduct();
        if (isset($this->_params['btnSumit'])) {
            $id = $this->_params['id'];
            $price = $this->_params['price'];
            $quantity = $this->_params['quantity'];
            $name = $this->_params['name'];
            $phone = $this->_params['phone'];
            $address = $this->_params['address'];
            $email = $this->_params['email'];
            $promotion = $this->_params['promotion'];
            $note = $this->_params['note'];
            $fee_delivery = $this->_params['fee_delivery'];
            $fee_delivery = str_replace(',', '', $fee_delivery);
            if($fee_delivery==""){$fee_delivery=0;}
            $code = "ADMIN_" . time();
            $total = 0;
            for ($i = 0; $i < count($id); $i++) {
                if($quantity[$i]==""){
                    $err.="Bạn chưa nhập số lượng <br/>";
                }
                $total += $price[$i] * $quantity[$i];
            }
            $order = [
                'code' => $code,
                'email' => $email,
                'name' => $name,
                'phone' => $phone,
                'address' => $address,
                'promotion' => $promotion,
                'id_delivery' => 1,
                'fee_delivery' => $fee_delivery,
                'total' => $total,
                'id_payment' => 1,
                'note' => $note,
                'status' => 0,
                'created' => date("Y-m-d H:i:s"),
                'sendmail' => 0
            ];
            if($name==""){
                $err.="Bạn chưa nhập tên khách hàng <br/>";
            }
            if($err==""){
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
                $_SESSION['err']="Tạo đơn hàng thành công";
                Url::header($this->route('adminorder'));
            }else{
                $this->_view->setData('err', $err);
                $this->_view->setData('list', $list);
                $this->_view->setFileTemplate('web', 'temple_admin');
                $this->_view->render('add');
            }
        }
        $this->_view->setData('list', $list);
        $this->_view->setFileTemplate('web', 'temple_admin');
        $this->_view->render('add');
    }
    public function confirmorderAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order['status']==0){
                $this->_model->updateRecord('order', ['status' => 1], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Xác nhận";
                $actionorder='<button type="button" onclick="tranferorder('."'".$id."'".');" class="btn btn-primary btn-xs tranferorder">Vận chuyển</button><button type="button" onclick="cancelorder('."'".$id."'".');" class="btn btn-danger btn-xs">Hủy đơn hàng</button>';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['id'] = $id;
            }else{
                $result['mess'] = $this->_view->language("l_error_status_order");
            }
        }
        echo json_encode($result);
    }
    public function tranferorderAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order['status']==1){
                $this->_model->updateRecord('order', ['status' => 2], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Vận chuyển";
                $actionorder='<button type="button" onclick="tranferordercomplete('."'".$id."'".');" class="btn btn-primary btn-xs completeorder">Đã giao hàng</button><button type="button" onclick="cancelorder('."'".$id."'".');" class="btn btn-danger btn-xs">Hủy đơn hàng</button>';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['id'] = $id;
            }else{
                $result['mess'] = "Lỗi trạng thái đơn hàng";
            }
        }
        echo json_encode($result);
    }
    public function tranferordercompleteAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order['status']==2){
                $this->_model->updateRecord('order', ['status' => 3], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Đã giao hàng";
                $actionorder='<button type="button" onclick="completeorder('."'".$id."'".');" class="btn btn-primary btn-xs completeorder">Hoàn tất</button><button type="button" onclick="cancelorder('."'".$id."'".');" class="btn btn-danger btn-xs">Hủy đơn hàng</button>';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['id'] = $id;
            }else{
                $result['mess'] = "Lỗi trạng thái đơn hàng";
            }
        }
        echo json_encode($result);
    }
    public function completeorderAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order['status']==3){
                $this->_model->updateRecord('order', ['status' => 4], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Hoàn tất";
                $actionorder='';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['id'] = $id;
            }else{
                $result['mess'] = "Lỗi trạng thái đơn hàng";
            }
        }
        echo json_encode($result);
    }
    public function cancelorderAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order){
                $status_old=$order["status"];
                $this->_model->updateRecord('order', ['status' => -1], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Hủy";
                $actionorder='';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['status_old'] = $status_old;
                $result['id'] = $id;
            }else{
                $result['mess'] = "Lỗi trạng thái đơn hàng";
            }
        }
        echo json_encode($result);
    }
    public function resetorderAjax() {
        $result = ['flag' => false];
        if (isset($this->_params['id'])) {
            $id = (int)$this->_params['id'];            
            $sql = 'SELECT * FROM `order` WHERE id='.$id;
            $this->_model->setQuery($sql);
            $order = $this->_model->read();
            if($order){
                $this->_model->updateRecord('order', ['status' => 0], ['id' => $id]);
                $result['flag'] = true;
                $statusorder="Khởi tạo";
                $actionorder='<button type="button" onclick="confirmorder('.$id.');" class="btn btn-primary btn-xs confirmorder">Xác nhận</button><button type="button" onclick="cancelorder('.$id.');" class="btn btn-danger btn-xs">Hủy đơn hàng</button>';
                $result['actionorder'] = $actionorder;
                $result['statusorder'] = $statusorder;
                $result['id'] = $id;
            }else{
                $result['mess'] = "Lỗi trạng thái đơn hàng";
            }
        }
        echo json_encode($result);
    }
}

?>