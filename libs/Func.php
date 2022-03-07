<?php

class Func
{
    // Hàm lấy giá trị cấu hình
    static function config($name)
    {
        $filename = PATH_CONFIGS . $name . '.php';
        if (file_exists($filename)) {
            return require $filename;
        }
    }

    /* Hàm trả về một phần tử của mảng
     * $data: mảng dữ liệu
     * $key: từ khóa
     * $value: giá trị
     */
    static function getRowArray($data, $key, $value)
    {
        if ($data) {
            $result = [];
            foreach ($data as $rowValue) {
                if (isset($rowValue[$key]) && $rowValue[$key] == $value) {
                    $result = $rowValue;
                    break;
                }
            }
            return $result;
        }
        return false;
    }

    /* Hàm trả về nhiều phần tử của mảng
     * $data: mảng dữ liệu
     * $key: từ khóa
     * $value: giá trị
     */
    static function getRowsArray($data, $key, $value)
    {
        if ($data) {
            $result = [];
            foreach ($data as $rowValue) {
                if (isset($rowValue[$key]) && $rowValue[$key] == $value) {
                    $result[] = $rowValue;
                }
            }
            return $result;
        }
        return false;
    }

    /* Hàm thêm 1 phần tử mảng vào phía trước của mảng
     * $data: mảng dữ liệu
     * $insertArray: giá trị cần thêm vào [ chuỗi hoặc mảng con]
     */
    static function insertRowArray($data, $insertArray)
    {
        if ($data) {
            array_unshift($data, $insertArray);
        }
        return $data;
    }

    /* Hàm thêm 1 phần tử mảng vào phía sau của mảng
     * $data: mảng dữ liệu
     * $appendArray: giá trị cần thêm vào [ chuỗi hoặc mảng con]
     */
    static function appendRowArray($data, $appendArray)
    {
        if ($data) {
            array_push($data, $appendArray);
        }
        return $data;
    }

    /* Hàm trả về một mảng sau khi đã chỉnh sửa
     * $data: mảng dữ liệu
     * $where: mảng điều kiện key = 1, key = 2,...
     * $newValue: Giá trị mới thay đổi giá trị cũ
     */
    static function updateRowArray($data, $where, $newValue)
    {
        if ($data && $newValue) {
            foreach ($data as $rowKey => $rowValue) {
                foreach ($where as $k => $v) {
                    if (isset($rowValue[$k]) && $rowValue[$k] == $v) {
                        $data[$rowKey] = $newValue;
                        $newValue = [];
                        break;
                    }
                }
            }
            return $data;
        }
        return false;
    }

    /* Hàm xóa 1 mảng con của 1 mảng cha
     * $data: mảng dữ liệu
     * $key: từ khóa
     * $value: giá trị
     */
    static function deleteRowArray($data, $key, $value)
    {
        if ($data) {
            foreach ($data as $rowKey => $rowValue) {
                if (isset($rowValue[$key]) && $rowValue[$key] == $value) {
                    unset($data[$rowKey]);
                    break;
                }
            }
            return $data;
        }
    }

    /* Hàm sắp xếp 1 mảng theo từ khóa
     * $data: mảng dữ liệu
     * $subkey: từ khóa trong mảng con
     * $sortType: kiểu tăng dần SORT_ASC, giảm dần SORT_DESC
     */
    static function sortArrayBySubkey(&$array, $subkey, $sortType = SORT_ASC)
    {
        foreach ($array as $subarray) {
            $keys[] = $subarray[$subkey];
        }
        array_multisort($keys, $sortType, $array);
    }

    /* Hàm chuyển đổi kiểu chữ có dấu sang dạng chữ không dấu */
    static function convertUnicode($str, $type = '')
    {
        if ($str) {
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
                'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
                'D' => 'Đ',
                'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
                'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
                'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
                'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
                'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                '-' => '&'
            );
            foreach ($unicode as $nonUnicode => $uni) {
                $str = preg_replace("/($uni)/u", $nonUnicode, $str);
            }
            if (!empty($type)) {
                $str = preg_replace('/\s+/', $type, $str);
            }
            return strtolower($str);
        }
        return '';
    }

    /*  Hàm đệ quy menu
     *  $source: mảng dữ liệu
     *  $parent: liên kết giữ các phần tử cha, con
     *  $htmlMenu: chuỗi html menu được tạo
     */
    static function recursiveMenuLeft($source, $parent, &$htmlMenu)
    {
        if (count($source) > 0) {
            $htmlMenu .= '<ul>';
            foreach ($source as $key => $value) {
                if ($value['category_parentid'] == $parent) {
                    $class = '';
                    if ($value['category_parentid'] == 0) {
                        $class = ' class="' . (($value['category_controller'] == 'invoice') ? $value['category_action'] : $value['category_controller']) . '"';
                    }
                    $href = ($value['category_link']) ? (' href="' . $value['category_link'] . '"') : '';
                    $title = ' title="' . $value['category_name'] . '"';
                    $cateID = Session::get('menuLeftChevronUp');
                    $firstIcon = ($value['category_firsticon']) ? ('<i class="' . $value['category_firsticon'] . '"></i>') : '';
                    $lastIcon = ($value['category_lasticon']) ? ('<i class="' . $value['category_lasticon'] . '"></i>') : '';
                    $htmlMenu .= '<li><a' . $class . $href . $title . ' data-id="' . $value['category_id'] . '">' . $firstIcon . $value['category_name'] . $lastIcon . '</a></li>';
                    $newParent = $value['category_id'];
                    unset($source[$key]);
                    self::recursiveMenuLeft($source, $newParent, $htmlMenu);
                }
            }
            $htmlMenu .= '</ul>';
        }
    }

    /*  Hàm tạo mã html cho menu right
     *  $source: mảng dữ liệu
     */
    static function createMenuRight($source)
    {
        if ($source && count($source) > 0) {
            self::sortArrayBySubkey($source, 'category_ordering');
            $htmlMenu = '<ul>';
            foreach ($source as $key => $value) {
                $attribute = ($value['category_attribute']) ? (' ' . $value['category_attribute']) : '';
                $tagSpan = ($value['category_lasticon']) ? ('<span>' . $value['category_lasticon'] . '</span>') : '';
                $href = ($value['category_link']) ? $value['category_link'] : '#';
                $tagA = '<a' . $attribute . ' href="' . $href . '" title="' . $value['category_name'] . '">' . $value['category_name'] . $tagSpan . '</a>';
                $htmlMenu .= ($value['category_firsticon']) ? ('<li class="' . $value['category_firsticon'] . '">' . $tagA . '</li>') : ('<li>' . $tagA . '</li>');
            }
            $htmlMenu .= '</ul>';
            return $htmlMenu;
        }
        return '';
    }

    /* Hàm tạo mã html thiết lập quyền cho người dùng */
    static function recursivePermission($data, $permission, $parent = 0, &$strHtml)
    {
        if (count($data) > 0) {
            $options = [
                'supportindexleft',
                'billindexleft',
                'invoicecollectionleft',
                'invoicepayleft',
                'reportcustomerright',
                'reportbillright',
                'reportcollectionright',
                'reportpayright',
                'reportinventoryright',
                'reportincomeright',
                'inventoryindexleft',
                'userindexleft',
            ];
            $strHtml .= '<ul>';
            foreach ($data as $key => $value) {
                if ($value['category_parentid'] == $parent) {
                    $attrID = self::strRandom(5);
                    $attrChecked = $classHiden = '';
                    if (in_array($value['category_controller'] . $value['category_action'] . $value['category_menu'],
                        $options)) {
                        $attrChecked = ' checked disabled';
                        $classHiden = ' hiden';
                    } else {
                        if (count($permission) > 0 && ($permission[0] == 'All')) {
                            $attrChecked = ' checked';
                        } else {
                            if (in_array($value['category_id'], $permission)) {
                                $attrChecked = ' checked';
                            }
                        }
                    }
                    if ($parent == 0) {
                        $strHtml .= '<li' . ($classHiden ? ' class="hiden"' : '') . '><a><input type="checkbox" value="' . $value['category_id'] . '" id="' . $attrID . '"' . $attrChecked . '><label for="' . $attrID . '">' . $value['category_name'] . '</label></a></li>';
                    } else {
                        $strHtml .= '<div class="form-group col-xs-6 col-sm-4 col-md-3 col-lg-2' . $classHiden . '"><input type="checkbox" value="' . $value['category_id'] . '" id="' . $attrID . '"' . $attrChecked . '><label for="' . $attrID . '">' . $value['category_name'] . '</label></div>';
                    }
                    unset($data[$key]);
                    self::recursivePermission($data, $permission, $value['category_id'], $strHtml);
                }
            }
            $strHtml .= '</ul>';
        }
    }

    /* Hàm đệ quy
     * $data: mảng giá trị
     * $parent: Giá trị cần lấy
     * $level: cấp bậc menu
     * $newArray: mảng mới được hình thành
     */
    static function recursive($data, $parent, $level, &$newArray)
    {
        if (count($data) > 0) {
            foreach ($data as $key => $value) {
                if ($value['category_parentid'] == $parent) {
                    $value['level'] = $level;
                    $newArray[] = $value;
                    unset($data[$key]);
                    $newParent = $value['category_id'];
                    self::recursive($data, $newParent, $level + 1, $newArray);
                }
            }
        }
    }

    // Hàm kiểm tra tên đăng nhập
    static function isUsername($str)
    {
        return preg_match('#^[A-z0-9]{5,32}$#', $str);
    }

    // Hàm kiểm tra tên 
    static function isName($str)
    {
        return preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $str);
    }

    // Hàm kiểm tra mật khẩu
    static function isPassword($str)
    {
        return preg_match('#^(?=.*\d)(?=.*[A-Z])(?=.*\W).{8,}$#', $str);
    }

    // hàm kiểm tra Email
    static function isEmail($email)
    {
        return preg_match('#^[a-z][a-z0-9_\.]{4,31}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$#', $email);
    }

    /* Hàm trả về một chuỗi ký tự
     * $type = string trả về 1 chuỗi ký tự không bao gồm số
     * $type = numeric trả về 1 chuỗi ký tự số từ 0-9
     */
    static function getValue($type = 'string', $value)
    {
        if ($type == 'string') {
            return preg_replace('#\d#m', '', $value);
        }
        if ($type == 'numeric') {
            return preg_replace('#\D#m', '', $value);
        }
    }

    // Hàm trả về số điện thoại từ một chuỗi ký tự
    static function getPhoneNumeric($string)
    {
        $phoneNumeric = false;
        preg_match_all('#(1|2|3|5|7|8|9)((\s|\-|\.)*\d+){7,}#', $string, $matches);
        foreach (array_reverse($matches[0]) as $key => $value) {
            $value = self::getValue('numeric', $value);
            $length = strlen($value);
            if ($length == 9 || (($length == 10) && (substr($value, 0, 1) == '2'))) {
                $phoneNumeric = '0' . $value;
                break;
            }
        }
        return $phoneNumeric;
    }

    // Hàm kiểm tra số điện thoại và chuyển đổi số điện thoại từ 11 số thành 10 số
    static function isPhoneNumric($phoneNumeric)
    {
        $flag = false;
        if ($phoneNumeric) {
            $length = strlen($phoneNumeric);
            $letter = substr($phoneNumeric, 0, 2);
            if ($length == 10 && $letter !== '01' && $letter !== '02') {
                $flag = true;
            }
            if ($length == 11 && $letter == '02') {
                $flag = true;
            }
        }
        return $flag;
    }

    // Hàm chuyển đổi số điện thoại thành 10 số
    static function convertPhoneNumeric($phoneNumeric)
    {
        $result = false;
        $phoneNumeric = self::getValue('numeric', $phoneNumeric);
        $length = strlen($phoneNumeric);
        if ($length > 9 && $length < 12) {
            $prefixPhone = array(
                '086' => '086',
                '096' => '096',
                '097' => '097',
                '098' => '098',
                '0162' => '032',
                '0163' => '033',
                '0164' => '034',
                '0165' => '035',
                '0166' => '036',
                '0167' => '037',
                '0168' => '038',
                '0169' => '039',
                '089' => '089',
                '090' => '090',
                '093' => '093',
                '0120' => '070',
                '0121' => '079',
                '0122' => '077',
                '0126' => '076',
                '0128' => '078',
                '088' => '088',
                '087' => '087',
                '091' => '091',
                '094' => '094',
                '0123' => '083',
                '0124' => '084',
                '0125' => '085',
                '0127' => '081',
                '0129' => '082',
                '092' => '092',
                '052' => '052',
                '056' => '056',
                '058' => '058',
                '099' => '099',
                '0199' => '059'
            );
            $letter = ($length == 10) ? substr($phoneNumeric, 0, 3) : substr($phoneNumeric, 0, 4);
            if (($length == 11) && (substr($phoneNumeric, 0, 2) == '02')) {
                return $phoneNumeric;
            } else {
                foreach ($prefixPhone as $key => $value) {
                    if ($key == $letter) {
                        $result = $value . substr($phoneNumeric, strlen($letter));
                        break;
                    }
                }
            }
        }
        return $result;
    }

    // Hàm tạo 1 chuỗi có độ dài cho trước
    static function strRandom($lenth = 15)
    {
        $arrCharacter = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));
        $strCharacter = implode($arrCharacter, '');
        $strCharacter = str_shuffle($strCharacter);
        $result = substr($strCharacter, 0, $lenth);
        return $result;
    }

    // Hàm loại bỏ khoảng trắng dư thừa
    static function trimSpace($str)
    {
        return trim(preg_replace('/\s+/m', ' ', $str));
    }

    // Hàm định dạng số tiền
    static function formatPrice($price)
    {
        if (is_numeric($price)) {
            return number_format($price, 0, '.', ',');
        }
        return 0;
    }

    // Hàm định dạng ngày tháng năm
    static function formatDay($date)
    {
        if (is_numeric($date) && $date > 0) {
            return date('d/m/Y', $date);
        }
        return '';
    }

    // Hàm mã hóa code
    static function strEncode($str)
    {
        if ($str) {
            $str = strrev($str);
            $strAZ = implode('', (range('a', 'z')));
            $code = '';
            while ($str) {
                $ran = random_int(1, 3);
                $code .= substr($str, 0, 1) . substr(str_shuffle($strAZ), 0, $ran);
                $str = substr($str, 1);
            }
            return md5($code) . $code;
        }
        return false;
    }

    // Hàm giải mã strEncode
    static function strDecode($str)
    {
        if (strlen($str) > 32) {
            return '0' . strrev(self::getValue('numeric', substr($str, 32)));
        }
        return false;
    }

    // Hàm chuyển đổi số tiền thành chữ
    static function VietnameseNumberToWords($number)
    {
        $f = new NumberFormatter('vi', NumberFormatter::SPELLOUT);
        return ucfirst($f->format($number)) . ' đồng';
    }

    // Hàm tạo đường dẫn cho tập tin trong thư mục tạm
    static function createFileTemp($filename, $extension = 'json')
    {
        if (Session::get('accountshopping')) {
            return PATH_CACHE . Session::get('accountshopping')['filetmp'] . $filename . '.' . $extension;
        }
        return false;
    }

    // Hàm tạo chuyên mục cho menu left
    static function setCategories($data)
    {
        if ($data) {
            if (isset($_GET['controller']) && isset($_GET['action'])) {
                $categories = [];
                foreach ($data as $key => $value) {
                    if ($value['category_controller'] == $_GET['controller'] && $value['category_action'] == $_GET['action']) {
                        $categories[] = $value;
                    }
                }
                return $categories;
            }
        }
        return false;
    }

    // Hàm xóa file cache json or file in folder images
    static function deleteFileCache($pathfolder, $day)
    {
        $handle = opendir($pathfolder);
        while (($filename = readdir($handle)) != false) {
            if (strlen($filename) > 2) {
                $pathfile = $pathfolder . $filename;
                if (file_exists($pathfile)) {
                    $file = new Files();
                    if ($file->get($pathfile)) {
                        $filetime = @filemtime($pathfile);
                        if ($filetime) {
                            if ((time() - $filetime) / 86400 > $day) {
                                $file->delete($pathfile);
                            }
                        }
                    }
                }
            }
        }
    }

    // Hàm chuyển đổi tất cả các ký tự có thể áp dụng thành các thực thể HTML
    static function convertHtmlentities($data, &$newData)
    {
        if (gettype($data) == 'array' && $data) {
            foreach ($data as $key => $value) {
                if (gettype($value) == 'array') {
                    self::convertHtmlentities($value, $newData[$key]);
                } else {
                    $newData[$key] = htmlentities($value);
                }
            }
        }
    }

    // Kiểm tra đường dẫn hình ảnh đại diện url: return false không tồn tại, return url là có tồn tại
    static function profilePicture($url)
    {
        if ($url) {
            preg_match('#(?<=&ext=)\d+(?=&hash)#', $url, $matchs);
            if ($matchs) {
                if ($matchs[0] > time()) {
                    return $url;
                }
            } else {
                return true;
            }
        }
        return false;
    }

    // Hàm chuyển đổi mili giây cho created_time facebook
    static function convertMilisecondFB($time)
    {
        return strtotime(substr($time, 0, -5));
    }

    // Phương thức lấy địa chỉ ip của máy khách
    static function getClientIp()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else {
            if (getenv('HTTP_X_FORWARDED_FOR')) {
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            } else {
                if (getenv('HTTP_X_FORWARDED')) {
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                } else {
                    if (getenv('HTTP_FORWARDED_FOR')) {
                        $ipaddress = getenv('HTTP_FORWARDED_FOR');
                    } else {
                        if (getenv('HTTP_FORWARDED')) {
                            $ipaddress = getenv('HTTP_FORWARDED');
                        } else {
                            if (getenv('REMOTE_ADDR')) {
                                $ipaddress = getenv('REMOTE_ADDR');
                            } else {
                                $ipaddress = 'UNKNOWN';
                            }
                        }
                    }
                }
            }
        }
        return $ipaddress;
    }

    static function getPathImage($image_uri, $size)
    {
        $my_bucket = "klkim-project.appspot.com";
        //$image_url = "https://".$my_bucket.".storage.googleapis.com/upload/".$image_uri;
        $image_url = "../attach/" . $my_bucket . "/upload/" . $image_uri;//localhost

        return $image_url;
    }
    static function stripUnicode($str) {
        if (!$str)
            return false;
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach ($unicode as $nonUnicode => $uni)
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        return $str;
    }
    static function Link2($chip) {
        $chipfm = str_replace(' ', '-',$chip);        
        $chipfm = str_replace('---', '-', $chipfm);
        $chipfm = str_replace('~', '-', $chipfm);
        $chipfm = str_replace('`', '-', $chipfm);
        $chipfm = str_replace('!', '-', $chipfm);
        $chipfm = str_replace('@', '-', $chipfm);
        $chipfm = str_replace('#', '-', $chipfm);
        $chipfm = str_replace('$', '-', $chipfm);
        $chipfm = str_replace('%', '-', $chipfm);
        $chipfm = str_replace('^', '-', $chipfm);
        $chipfm = str_replace('&', '-', $chipfm);
        $chipfm = str_replace('*', '-', $chipfm);
        $chipfm = str_replace('(', '-', $chipfm);
        $chipfm = str_replace(')', '-', $chipfm);
        $chipfm = str_replace('?', '-', $chipfm);
        $chipfm = str_replace(';', '-', $chipfm);
        $chipfm = str_replace('|', '-', $chipfm);
        $chipfm = str_replace('/', '-', $chipfm);
        $chipfm = str_replace('"', '-', $chipfm);
        $chipfm = str_replace('.', '-', $chipfm);
        $chipfm = str_replace(',', '-', $chipfm);
        $chipfm = str_replace('<', '-', $chipfm);
        $chipfm = str_replace('>', '-', $chipfm);
        $chipfm = str_replace('+', '-', $chipfm);
        $chipfm = str_replace(':', '-', $chipfm);
        $chipfm = str_replace('}', '-', $chipfm);
        $chipfm = str_replace('{', '-', $chipfm);
        $chipfm = str_replace(']', '-', $chipfm);
        $chipfm = str_replace('[', '-', $chipfm);
        $chipfm = str_replace('--', '-', $chipfm);
        $chipfm = str_replace('_', '-', $chipfm);
        return $chipfm;
    }
    
}

?>