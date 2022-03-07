<?php
// OfficeExcel chỉ dùng được cho PHP 7.2 trở xuống
class OfficeExcel{      
   
    // Biến lưu ngông ngữ
    static $_language;
    
    static function setLanguage($language){
        self::$_language = $language;
    }
    
    /* Phương thức tạo một tập tin Excel (filename.xlsx)
     * $columns: là mảng gồm có key và title array([key=>'', title=''], []...)
     * $data: dữ liệu ứng với columns
     * $filename: tên của tập tin
     * $params: giá trị mảng
     * - titleName: tiêu đề của tập tin excel
     * - description: thông tin miêu tả
     * - formatDate: định dạng ngày tháng năng [key1, key2,...]
     * - formatNumber: định dạng số [key1, key2,...]
     * - insertValue: thêm vào trường giá trị [key1=>[k1=>v1,k2=>v2,...],...]
     */
    public function write( $filename, $data, $columns, $params = array() ){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheetActive = $objPHPExcel->getActiveSheet();        
        $row = 1; // 3
        $flag = true;
        $colAZ = range('A', 'Z');
        $columnsNew = [];
        // format
      
        $styleArray = [
            'alignment'=>[
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'font'=> ['name'=>'Arial', 'size'=>13, 'bold'=>true],
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'CCCCCC']
            ],
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        ];
        $styleArray0 = array(
            'font' => array(
                'name'=>'Arial',
                'size' => 13
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        foreach ($data as $key => $value){
            if($flag == true){
                $value['stt'] = ($key + 1);
                // header
                if( $key === 0 ){
                    $i = 0;
                    foreach ($columns as $colkey => $colvalue){
                        //&& (isset($value[$colvalue['key']]))
                        if((strpos($colvalue['type'], 'export') !== false) ){
                            // Tiêu đề
//                             if(array_key_exists('titleName', $params)){
//                                 $sheetActive->setCellValue('A1',$params['titleName']);
//                                 $sheetActive->getStyle('A1')->applyFromArray( ['font'=>array_merge($font, ['size'=>24, 'bold'=>true]), 'alignment'=>$alignment] );
//                             }
                            // Mô tả
//                             if(array_key_exists('description', $params)){
//                                 $sheetActive->setCellValue('A2', $params['description']);
//                                 $sheetActive->getStyle('A2')->applyFromArray( ['font'=>array_merge($font, ['size'=>12]),'alignment'=>$alignment] );
//                                 $row = 4;
//                             }
                            $merge = false;
                            $mergeCell = array('colStart'=>$colAZ[$i],'colEnd'=>$colAZ[$i], 'rowStart'=>$row, 'rowEnd'=>$row );
                            $sheetActive->setCellValue($colAZ[$i] . $row, $colvalue['title']);                            
                            if(isset($colvalue['cols'])){                               
                                if(isset($colvalue['value'])){                                   
                                    foreach ($colvalue['value'] as $subkey => $subcol){
                                        $columnsNew[] = $subcol;
                                        $sheetActive->setCellValue($colAZ[$i] . ($row + 1), $subcol['title']);
                                        $sheetActive->getColumnDimension($colAZ[$i])->setAutoSize(true);
                                        $i++;
                                    }
                                    $i--;
                                }                                
                                $merge = true;
                                $mergeCell['colEnd'] = $colAZ[$i];
                            }else{
                                $columnsNew[] = $colvalue;
                            }
                            if(array_key_exists('rows', $colvalue)){
                                $row = $row + $colvalue['rows'];
                                $merge = true;
                                $mergeCell['rowEnd'] = $row - 1;
                            }
                            if($merge == true){
                                $row++;
                                $sheetActive->mergeCells($mergeCell['colStart'] . $mergeCell['rowStart'] .':'. $mergeCell['colEnd'] . $mergeCell['rowEnd']);
                            }
                            
                            $sheetActive->getStyle($mergeCell['colStart'] . $mergeCell['rowStart'])->applyFromArray( $styleArray ); 
                            $i++;
                        }
                    }
//                     $sheetActive->mergeCells('A1:'.$colAZ[count($columnsNew)-1].'1');
//                     $sheetActive->mergeCells('A2:'.$colAZ[count($columnsNew)-1].'2');
                }                
                // Nội dung file
                $row++;                
                foreach ($columnsNew as $j => $col){
                    if(array_key_exists($col['key'], $value)){
                        $cellValue = $value[$col['key']];

                        if($cellValue){
                        	// format date
                        	if(isset($params['format']['date'])){
                        		if(in_array($col['key'], $params['format']['date']) && $cellValue){
                        			$cellValue = Func::formatDay($cellValue);
                        		}
                        	}
                        	// format number
                        	if(isset($params['format']['numeric'])){
                        		if(in_array($col['key'], $params['format']['numeric']) && $cellValue){
                        		    $cellValue = Func::formatPrice($cellValue);
                        		}
                        	}
                            // insert value                        
                            if(isset($params['insert']) && $params['insert']){
                                foreach ($params['insert'] as $k => $v){
                                    if($col['key'] == $k){
                                        if(gettype($v) == 'array' && isset($v[$cellValue])){
                                    		$cellValue = $v[$cellValue];
                                    	}else{
                                            $cellValue = $v;
                                        }                                    
                                    }
                                }
                            }   
                        }                     
                        $sheetActive->setCellValue($colAZ[$j] . $row, $cellValue);  
                        $sheetActive->getStyle($colAZ[$j] . $row)->getNumberFormat()->setFormatCode($col['formatCode']);
                        if($col['styleArray']==0)
                        $sheetActive->getStyle($colAZ[$j] . $row)->applyFromArray( $styleArray0);
                        
                        $sheetActive->getColumnDimension($colAZ[$j])->setAutoSize(true);
                        
                    }else{
                        $flag = false;
                    }                   
                }
            }
        }       
        if($flag == false){
            return false;
        }else{
            require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
            $filename .= '-' . date('d-m-Y',time()) . '-' . time() .'.xlsx';            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$filename);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');           
            $objWriter->save('php://output');
        }
    }

    public function writeProductType($fileName, $items, $matchTypes1, $channelTypes1, $matchTypes2, $channelTypes2, $matchTypes3, $channelTypes3){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $sheetType = 0;
        $objWorkSheet = $objPHPExcel->createSheet($sheetType); //Setting index when creating
        $sheetActive = $objPHPExcel->setActiveSheetIndex($sheetType);
        $row = 1; // 3
        $flag = true;

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('H')->setWidth(15);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('J')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('K')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('M')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('N')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('O')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('P')->setWidth(10);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('S')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('U')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('V')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('W')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('X')->setWidth(10);




        $styleArray = [
            'alignment'=>[
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'font'=> ['name'=>'Arial', 'size'=>13],
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN

                )
            )
        ];
        $styleArray1 = [

            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'DDDDDD')
                )
            )
        ];
        $styleArray2 = [
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),

            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array('rgb' => 'DDDDDD')
                )
            )
        ];

        $styleArray0 = array(
            'font' => array(
                'name'=>'Arial',
                'size' => 10
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        // Thiết lập tên các cột dữ liệu type channel 1
        $i = 3;

        $objPHPExcel->setActiveSheetIndex($sheetType)
            ->setCellValue('A2' , "TYPE T-BRIDGE")
            ->setCellValue('A' . $i, "1depth")
            ->setCellValue('B' . $i, "Code 1depth")
            ->setCellValue('C' . $i, "2depth")
            ->setCellValue('D' . $i, "Code 2depth")
            ->setCellValue('E' . $i, "3depth")
            ->setCellValue('F' . $i, "Code 3depth")
            ->setCellValue('G' . $i, "4depth")
            ->setCellValue('H' . $i, "Code 4depth")

            ->setCellValue('J2' , "MATCHED TYPE TMON")
            ->setCellValue('J' . $i, "1depth")
            ->setCellValue('K' . $i, "2depth")
            ->setCellValue('L' . $i, "3depth")
            ->setCellValue('M' . $i, "4depth")
            ->setCellValue('N' . $i, "Link form")
            ->setCellValue('O' . $i, "Value api")
            ->setCellValue('P' . $i, "Type rate")

            ->setCellValue('R2' , "LIST TYPE WMP")
            ->setCellValue('R' . $i, "1depth")
            ->setCellValue('S' . $i, "2depth")
            ->setCellValue('T' . $i, "3depth")
            ->setCellValue('U' . $i, "4depth")
            ->setCellValue('V' . $i, "Link form")
            ->setCellValue('W' . $i, "Value api")
            ->setCellValue('X' . $i, "Type rate");

        $sheetActive->mergeCells('A2:H2');
        $sheetActive->getStyle('A2:H2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('A3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('B3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('C3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('D3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('E3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('F3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('G3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('H3')->applyFromArray( $styleArray);

        $sheetActive->mergeCells('J2:P2');
        $sheetActive->getStyle('J2:P2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('J3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('K3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('L3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('M3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('N3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('O3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('P3')->applyFromArray( $styleArray);

        $sheetActive->mergeCells('R2:X2');
        $sheetActive->getStyle('R2:X2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('R3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('S3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('T3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('U3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('V3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('W3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('X3')->applyFromArray( $styleArray);



        $i = 4;
        $colAH = range('A', 'H');
        foreach ($items as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('A' . $i, $value['v1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('B' . $i, $value['c1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('C' . $i, $value['v2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('D' . $i, $value['c2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('E' . $i, $value['v3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('F' . $i, $value['c3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('G' . $i, $value['v4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('H' . $i, $value['c4']);

            for ($j=0; $j <=7 ; $j++) {
                $sheetActive->getStyle($colAH[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        $i = 4;
        $colJP = range('J', 'P');
        foreach ($matchTypes1 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('J' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('K' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('L' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('M' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('N' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('O' . $i, $value['type_apivalue2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('P' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=6 ; $j++) {
                $sheetActive->getStyle($colJP[$j] . $i)->applyFromArray( $styleArray0);
            }


            $i ++;
        }

        $i = 4;
        $colRX = range('R', 'X');
        foreach ($channelTypes1 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('R' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('S' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('T' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('U' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('V' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('W' . $i, $value['type_apivalue2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('X' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=6 ; $j++) {
                $sheetActive->getStyle($colRX[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        // Rename sheet
        $objWorkSheet->setTitle("Type Coupang");

        // Thiết lập tên các cột dữ liệu type channel 3 TMON
        $sheetType = 1;
        $objWorkSheet = $objPHPExcel->createSheet($sheetType); //Setting index when creating
        $sheetActive = $objPHPExcel->setActiveSheetIndex($sheetType);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('H')->setWidth(15);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('N')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('O')->setWidth(10);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('Q')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('U')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('V')->setWidth(10);

        $i = 3;
        $objPHPExcel->setActiveSheetIndex($sheetType)
            ->setCellValue('A2' , "TYPE T-BRIDGE")
            ->setCellValue('A' . $i, "1depth")
            ->setCellValue('B' . $i, "Code 1depth")
            ->setCellValue('C' . $i, "2depth")
            ->setCellValue('D' . $i, "Code 2depth")
            ->setCellValue('E' . $i, "3depth")
            ->setCellValue('F' . $i, "Code 3depth")
            ->setCellValue('G' . $i, "4depth")
            ->setCellValue('H' . $i, "Code 4depth")

            ->setCellValue('J2' , "MATCHED TYPE TMON")
            ->setCellValue('J' . $i, "1depth")
            ->setCellValue('K' . $i, "2depth")
            ->setCellValue('L' . $i, "3depth")
            ->setCellValue('M' . $i, "4depth")
            ->setCellValue('N' . $i, "Link form")
            ->setCellValue('O' . $i, "Type rate")

            ->setCellValue('Q2' , "LIST TYPE WMP")
            ->setCellValue('Q' . $i, "1depth")
            ->setCellValue('R' . $i, "2depth")
            ->setCellValue('S' . $i, "3depth")
            ->setCellValue('T' . $i, "4depth")
            ->setCellValue('U' . $i, "Link form")
            ->setCellValue('V' . $i, "Type rate");

        $sheetActive->mergeCells('A2:H2');
        $sheetActive->getStyle('A2:H2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('A3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('B3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('C3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('D3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('E3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('F3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('G3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('H3')->applyFromArray( $styleArray);

        $sheetActive->mergeCells('J2:O2');
        $sheetActive->getStyle('J2:O2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('J3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('K3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('L3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('M3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('N3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('O3')->applyFromArray( $styleArray);


        $sheetActive->mergeCells('Q2:V2');
        $sheetActive->getStyle('Q2:V2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('Q3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('R3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('S3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('T3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('U3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('V3')->applyFromArray( $styleArray);

        $i = 4;
        $colAH = range('A', 'H');
        foreach ($items as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('A' . $i, $value['v1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('B' . $i, $value['c1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('C' . $i, $value['v2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('D' . $i, $value['c2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('E' . $i, $value['v3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('F' . $i, $value['c3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('G' . $i, $value['v4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('H' . $i, $value['c4']);

            for ($j=0; $j <=7 ; $j++) {
                $sheetActive->getStyle($colAH[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        $i = 4;
        $colJO = range('J', 'O');

        foreach ($matchTypes3 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('J' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('K' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('L' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('M' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('N' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('O' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=5 ; $j++) {
                $sheetActive->getStyle($colJO[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        $i = 4;
        $colQV = range('Q', 'V');

        foreach ($channelTypes3 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('Q' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('R' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('S' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('T' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('U' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('V' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=5 ; $j++) {
                $sheetActive->getStyle($colQV[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        // Rename sheet
        $objWorkSheet->setTitle("Type Tmon");

        // Thiết lập tên các cột dữ liệu type channel 2 WMP
        $sheetType = 2;
        $objWorkSheet = $objPHPExcel->createSheet($sheetType); //Setting index when creating
        $sheetActive = $objPHPExcel->setActiveSheetIndex($sheetType);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('A')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('B')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('C')->setWidth(13);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('D')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('E')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('F')->setWidth(15);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('G')->setWidth(25);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('H')->setWidth(15);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('J')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('K')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('L')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('M')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('N')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('O')->setWidth(10);

        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('R')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('S')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('T')->setWidth(20);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('U')->setWidth(10);
        $objPHPExcel->getActiveSheet($sheetType)->getColumnDimension('V')->setWidth(10);
        $i = 3;
        $objPHPExcel->setActiveSheetIndex($sheetType)
            ->setCellValue('A2' , "TYPE T-BRIDGE")
            ->setCellValue('A' . $i, "1depth")
            ->setCellValue('B' . $i, "Code 1depth")
            ->setCellValue('C' . $i, "2depth")
            ->setCellValue('D' . $i, "Code 2depth")
            ->setCellValue('E' . $i, "3depth")
            ->setCellValue('F' . $i, "Code 3depth")
            ->setCellValue('G' . $i, "4depth")
            ->setCellValue('H' . $i, "Code 4depth")

            ->setCellValue('J2' , "MATCHED TYPE TMON")
            ->setCellValue('J' . $i, "1depth")
            ->setCellValue('K' . $i, "2depth")
            ->setCellValue('L' . $i, "3depth")
            ->setCellValue('M' . $i, "Link form")
            ->setCellValue('N' . $i, "Value api")
            ->setCellValue('O' . $i, "Type rate")

            ->setCellValue('Q2' , "LIST TYPE WMP")
            ->setCellValue('Q' . $i, "1depth")
            ->setCellValue('R' . $i, "2depth")
            ->setCellValue('S' . $i, "3depth")
            ->setCellValue('T' . $i, "Link form")
            ->setCellValue('U' . $i, "Value api")
            ->setCellValue('V' . $i, "Type rate");
        $sheetActive->mergeCells('A2:H2');
        $sheetActive->getStyle('A2:H2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('A3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('B3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('C3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('D3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('E3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('F3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('G3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('H3')->applyFromArray( $styleArray);

        $sheetActive->mergeCells('J2:O2');
        $sheetActive->getStyle('J2:O2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('J3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('K3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('L3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('M3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('N3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('O3')->applyFromArray( $styleArray);

        $sheetActive->mergeCells('Q2:V2');
        $sheetActive->getStyle('Q2:V2')->applyFromArray( $styleArray);
        $sheetActive->getStyle('Q3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('R3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('S3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('T3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('U3')->applyFromArray( $styleArray);
        $sheetActive->getStyle('V3')->applyFromArray( $styleArray);

        $i = 4;
        $colAH = range('A', 'H');

        foreach ($items as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('A' . $i, $value['v1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('B' . $i, $value['c1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('C' . $i, $value['v2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('D' . $i, $value['c2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('E' . $i, $value['v3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('F' . $i, $value['c3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('G' . $i, $value['v4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('H' . $i, $value['c4']);

            for ($j=0; $j <=7 ; $j++) {
                $sheetActive->getStyle($colAH[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        $colJO = range('J', 'O');
        $i = 4;
        foreach ($matchTypes2 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('J' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('K' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('L' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('M' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('N' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('O' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=5 ; $j++) {
                $sheetActive->getStyle($colJO[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        $colQV = range('Q', 'V');
        $i = 4;
        foreach ($channelTypes2 as $key => $value) {
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('Q' . $i, $value['type_depth1']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('R' . $i, $value['type_depth2']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('S' . $i, $value['type_depth3']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('T' . $i, $value['type_depth4']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('U' . $i, $value['type_linkform']);
            $objPHPExcel->setActiveSheetIndex($sheetType) ->setCellValue('V' . $i, (int)$value['type_rate'] > 0 ? $value['type_rate'] . '%' : '');

            for ($j=0; $j <=5 ; $j++) {
                $sheetActive->getStyle($colQV[$j] . $i)->applyFromArray( $styleArray0);
            }

            $i ++;
        }

        // Rename sheet
        $objWorkSheet->setTitle("Type WMP");

        //delete worksheet
        $objPHPExcel->removeSheetByIndex(3);

        $fileName .= '-' . date('d-m-Y',time()) . '-' . time() .'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$fileName);
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
    }

    public function writeSellertment( $filename, $data, $data1, $data2){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheetActive = $objPHPExcel->getActiveSheet();        
        $row = 1; // 3
        $flag = true;
        $colAZ = range('A', 'Z');
        $columnsNew = [];
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        
        // format

        $styleArray = [
            'alignment'=>[
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ],
            'font'=> ['name'=>'Arial', 'size'=>13],
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'borders' => array(
                'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
                
                )
            )
        ];
        $styleArray1 = [
            
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'borders' => array(
                'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => 'DDDDDD')
                )
            )
        ];
        $styleArray2 = [
            'fill'=>[
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['rgb' => 'f1f1f1']
            ],
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            
            'borders' => array(
                'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN,
                'color' => array('rgb' => 'DDDDDD')
                )
            )
        ];

        $styleArray0 = array(
            'font' => array(
                'name'=>'Arial',
                'size' => 13
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'wrap' => true
            ),
            'borders' => array(
                'top' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                ),
                'right' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
    

// Thiết lập tên các cột dữ liệu

       $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', "총판사/시설사") //userId
        ->setCellValue('A2', "정산기간") //createdstart - createdend
        ->setCellValue('A3', "판매가/수수료")
        ->setCellValue('D1', "정산서 상태") 
        ->setCellValue('D2', "지급예정일") //settlementday
        ->setCellValue('D3', "정산금액");
    $sheetActive->getStyle('A1')->applyFromArray( $styleArray);
    $sheetActive->getStyle('A2')->applyFromArray( $styleArray);
    $sheetActive->getStyle('A3')->applyFromArray( $styleArray);
    $sheetActive->getStyle('D1')->applyFromArray( $styleArray);
    $sheetActive->getStyle('D2')->applyFromArray( $styleArray);
    $sheetActive->getStyle('D3')->applyFromArray( $styleArray);
    //$sheetActive->getStyle('A1:D3')->applyFromArray( $styleArray);
        $sheetActive->mergeCells('B1:C1');
        $sheetActive->mergeCells('B2:C2');
        $sheetActive->mergeCells('B3:C3');
        $sheetActive->mergeCells('E1:H1');
        $sheetActive->mergeCells('E2:H2');
        $sheetActive->mergeCells('E3:H3');
     $sheetActive->getStyle('A1:H3')->applyFromArray( $styleArray);  
    
    
    $i=1;
      foreach ($data as $key=> $val) {
        $objPHPExcel->setActiveSheetIndex(0)
        //if($val['status']==2) echo $duyet="Giám đốc từ chối duyệt";
        ->setCellValue("B1", $val['userId'].'/'.$val['userId'])
        ->setCellValue("B2", $val['createdstart'].' ~ '.$val['createdend'])
        ->setCellValue("B3", $val['pricetotal'].'('.$val['feetotal'] .')');
        if($val['status']==1){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1",  ' Chờ GĐ duyệt');
        }elseif($val['status']==2){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1",  'GĐ từ chối duyệt');
        }elseif ($val['status']==3) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1",  'GĐ duyệt xong');
        }else{
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E1",  'Quyết toán xong');
        }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E2",  $val['settlementday'])
            ->setCellValue("E3",  $val['settlementtotal']);
            $i++; 
     }
     //BẢNG 2  
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A7', "합계")
        ->setCellValue('A6', "구분")
        ->setCellValue('B6', "채널")
        ->setCellValue('C6', "상품명")
        ->setCellValue('D6', "단가")
        ->setCellValue('E6', "수량")
        ->setCellValue('F6', "판매가")
        ->setCellValue('G6', "공급가")
        ->setCellValue('H6', "수수료");
        $row=6;
        for ($j=0; $j <=7 ; $j++) { 
             $sheetActive->getStyle($colAZ[$j] . $row)->applyFromArray( $styleArray);
        }

    $objPHPExcel->getActiveSheet()
    ->getStyle('A7:B7')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $sheetActive->mergeCells('A7:D7');
    $i=8;
    foreach ($data1 as $key => $value) {
        $objPHPExcel->setActiveSheetIndex(0)
             ->setCellValue("A$i", 'Mới')
            ->setCellValue("B$i", $value['channelname'])
            ->setCellValue("C$i", $value['productname'])
            ->setCellValue("D$i", $value['price'])
            ->setCellValue("E$i",  $value['amount'])
            ->setCellValue("F$i",  $value['pricetotal'])
            ->setCellValue("G$i",  "=(F".$i."-H".$i.")")
            ->setCellValue("H$i",  $value['feetotal']);
         $i++;
    }
     $objPHPExcel->setActiveSheetIndex(0)->getStyle('A7:H7')->applyFromArray( $styleArray1);
    $i=$i-1;
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue("E7","=SUM(E8:E".$i.")")
        ->setCellValue("F7","=SUM(F8:F".$i.")")
        ->setCellValue("G7","=SUM(G8:G".$i.")")
        ->setCellValue("H7","=SUM(H8:H".$i.")");
// BẢNG 3
        $amount=$pricetotal=$pricesupply=$feetotal=0;
        foreach ($data1 as $key => $value) {
           $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C17", $amount+=$value['amount']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D17",  $pricetotal+=($value['price']*$value['amount']));
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F17", $feetotal+=$value['feetotal']);
        }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E17",$pricesupply=$pricetotal-$feetotal);
        $co=0;
        foreach ($data2 as $key => $giatri) {
            if($giatri['pos']==1){
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('B18', "사용 후 취소/환불금액");
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('C18', $giatri['amount']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('D18', $giatri['price']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('E18', $giatri['supplyprice']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('F18', $giatri['fee']);
            }elseif ($giatri['pos']==2) {
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('B19', "선정산 금액");
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('C19', $giatri['amount']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('D19', $giatri['price']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('E19', $giatri['supplyprice']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('F19', $giatri['fee']);
            }elseif ($giatri['pos']==3) {
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('B20', "취소위약금");
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('C20', $giatri['amount']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('D20', $giatri['price']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('E20', $giatri['supplyprice']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('F20', $giatri['fee']);
            }elseif ($giatri['pos']==4) {
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('B21', "수수료 변경에 따른 판매가/공급가 조정항목");
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('C21', $giatri['amount']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('D21', $giatri['price']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('E21', $giatri['supplyprice']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('F21', $giatri['fee']);
            }else {
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('B22', "기타 조정금액");
                $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('C22', $giatri['amount']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('D22', $giatri['price']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('E22', $giatri['supplyprice']);
                 $objPHPExcel->setActiveSheetIndex(0) ->setCellValue('F22', $giatri['fee']);
            }
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("C23",   $amount-=$giatri['amount']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("D23",   $pricetotal-=$giatri['price']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("E23",   $pricesupply-=$giatri['supplyprice']);
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue("F23",   $feetotal-=$giatri['fee']);
            $co++;
        }
            
    $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A16', "구분")
    ->setCellValue('A17', "총 판매금액")
    ->setCellValue('A18', "조정금액") 
    ->setCellValue('A23', "총 정산금액(총 판매금액-조정금)")
      ->setCellValue('C16', "수량")
      ->setCellValue('D16', "판매가")
      ->setCellValue('E16', "공급가")
      ->setCellValue('F16', "수수료");
        $sheetActive->mergeCells('A16:B16');
        $sheetActive->mergeCells('A17:B17');
        $sheetActive->mergeCells('A23:B23');
        $sheetActive->mergeCells('A18:A22');
    $objPHPExcel->getActiveSheet()
    ->getStyle('A18:A22')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
    ->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()
    ->getStyle('A23:B23')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()
    ->getStyle('A17:B17')
    ->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $sheetActive->getStyle('A16:F23')->applyFromArray( $styleArray);
    $objPHPExcel->setActiveSheetIndex(0)->getStyle('B21')->applyFromArray( $styleArray2); 
        
          //bảng 4
         $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A28', "지급비율(%)")
    ->setCellValue('B28', "지급예정일")
    ->setCellValue('C28', "수량")
    ->setCellValue('D28', "판매가")
    ->setCellValue('E28', "공급가")
    ->setCellValue('F28', "수수료(세금계산서 발행 예정 금액)") ;
     $sheetActive->mergeCells('F28:H28');
      $sheetActive->mergeCells('F29:H29');
      $sheetActive->getStyle('A28:H29')->applyFromArray( $styleArray);
    foreach($data as $ket=>$val){
        $objPHPExcel->setActiveSheetIndex(0)
    ->setCellValue('A29', '100%')
    ->setCellValue('B29', $val['settlementday'])
    ->setCellValue('C29',  $amount)
    ->setCellValue("D29",  $pricetotal)
    ->setCellValue("E29",  $pricesupply)
    ->setCellValue("F29",  $feetotal);
    }
    
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
        $filename .= '-' . date('d-m-Y',time()) . '-' . time() .'.xlsx';            
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$filename);
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');           
        $objWriter->save('php://output');
        
     }
    /* Phương thức tạo một tập tin Excel (filename.xlsx)
     * $columns: là mảng gồm có key và title array([key=>'', title=''], []...)
     * $data: dữ liệu ứng với columns
     * $filename: tên của tập tin
     * $params: giá trị mảng
     * - titleName: tiêu đề của tập tin excel
     * - description: thông tin miêu tả
     * - formatDate: định dạng ngày tháng năng [key1, key2,...]
     * - formatNumber: định dạng số [key1, key2,...]
     * - insertValue: thêm vào trường giá trị [key1=>[k1=>v1,k2=>v2,...],...]
     */
    public function writeChannel( $filename, $data, $columns, $params = array() ){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheetActive = $objPHPExcel->getActiveSheet();
        $row = 1; // 3
        $flag = true;
        $colAZ = range('A', 'Z');
        $columnsNew = [];
        // format
        $font =  ['name'=>'Arial', 'size'=>13];
        $alignment = [
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
        ];
        $fill = [
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => ['rgb' => 'CCCCCC']
        ];
        foreach ($data as $key => $value){           
            if($flag == true){
                $value['stt'] = ($key + 1);
                // header
                if( $key === 0 ){
                    $i = 0;
                    foreach ($columns as $colkey => $colvalue){
                        if((strpos($colvalue['type'], 'export') !== false)){                         
                            // Tiêu đề
//                             if(array_key_exists('titleName', $params)){
//                                 $sheetActive->setCellValue('A1',$params['titleName']);
//                                 $sheetActive->getStyle('A1')->applyFromArray( ['font'=>array_merge($font, ['size'=>24, 'bold'=>true]), 'alignment'=>$alignment] );
//                             }
                            // Mô tả
//                             if(array_key_exists('description', $params)){
//                                 $sheetActive->setCellValue('A2', $params['description']);
//                                 $sheetActive->getStyle('A2')->applyFromArray( ['font'=>array_merge($font, ['size'=>12]),'alignment'=>$alignment] );
//                                 $row = 4;
//                             }
                            $merge = false;
                            $mergeCell = array('colStart'=>$colAZ[$i],'colEnd'=>$colAZ[$i], 'rowStart'=>$row, 'rowEnd'=>$row );
                            $sheetActive->setCellValue($colAZ[$i] . $row, $colvalue['title']);
                            if(isset($colvalue['cols'])){
                                if(isset($colvalue['value'])){
                                    foreach ($colvalue['value'] as $subkey => $subcol){
                                        $columnsNew[] = $subcol;
                                        $sheetActive->setCellValue($colAZ[$i] . ($row + 1), $subcol['title']);
                                        $sheetActive->getStyle($colAZ[$i] . ($row + 1))->applyFromArray(['alignment'=>$alignment]);
                                        $i++;
                                    }
                                    $i--;
                                }
                                $merge = true;
                                $mergeCell['colEnd'] = $colAZ[$i];
                            }else{
                                $columnsNew[] = $colvalue;
                            }
                            if(array_key_exists('rows', $colvalue)){
                                $row = $row + $colvalue['rows'];
                                $merge = true;
                                $mergeCell['rowEnd'] = $row - 1;
                            }
                            if($merge == true){
                                $row++;
                                $sheetActive->mergeCells($mergeCell['colStart'] . $mergeCell['rowStart'] .':'. $mergeCell['colEnd'] . $mergeCell['rowEnd']);
                            }
                            $styleArray = [
                                'alignment'=>$alignment,
                                'font'=>array_merge($font, ['bold'=>true]),
                                'fill'=>$fill
                            ];
                            $sheetActive->getStyle($mergeCell['colStart'] . $mergeCell['rowStart'])->applyFromArray( $styleArray );
                            $i++;
                        }
                    }
//                     $sheetActive->mergeCells('A1:'.$colAZ[count($columnsNew)-1].'1');
//                     $sheetActive->mergeCells('A2:'.$colAZ[count($columnsNew)-1].'2');
                }
                // Nội dung file
                $row++;
                foreach ($columnsNew as $j => $col){
                    if(array_key_exists($col['key'], $value)){                        
                        $cellValue = $value[$col['key']];
                        // format date
                        if(isset($params['format']['date'])){
                            if(in_array($col['key'], $params['format']['date']) && $cellValue){
                                $cellValue = Func::formatDay($cellValue);
                            }
                        }
                        // format number
                        if(isset($params['format']['numeric'])){
                            if(in_array($col['key'], $params['format']['numeric']) && $cellValue){
                                $cellValue = Func::formatPrice($cellValue);
                            }
                        }                       
                        // insert value
                        if(isset($params['insert']) && $params['insert']){
                            foreach ($params['insert'] as $k => $v){
                                if($col['key'] == $k){
                                    if(gettype($v) == 'array' && isset($v[$cellValue])){
                                        $cellValue = $v[$cellValue];
                                    }else{
                                        $cellValue = $v;
                                    }
                                }
                            }
                        }                        
                        $sheetActive->setCellValue($colAZ[$j] . $row, $cellValue);                        
                        unset($alignment['horizontal']);                        
                        $sheetActive->getStyle($colAZ[$j] . $row)->applyFromArray( ['font'=>$font, 'alignment'=>$alignment] );
                        if($col['key'] == 'type_rate'){
                            $sheetActive->setCellValue($colAZ[$j] . $row, ($cellValue/100));
                            $sheetActive->getStyle($colAZ[$j] . $row)->getNumberFormat()->setFormatCode('0%');
                        }                        
                        $sheetActive->getColumnDimension($colAZ[$j])->setAutoSize(true);
                    }else{
                        $flag = false;
                    }
                }
            }
        }
        if($flag == false){
            return false;
        }else{
            require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
            $filename .= '-' . date('d-m-Y',time()) . '-' . time() .'.xlsx';
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename='.$filename);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $objWriter->save('php://output');
        }
    }    
    /* Phương thức đọc một tập tin Excel (filename.xlsx)
     * $pathFile: đường dẫn tập tin 
     * $columns: là mảng gồm có key và title array([key=>'', title=''], []...)
     * $sheet: vị trí sheet trong tập tin    
     */    
    public function read( $pathFile, $columns, $sheet = 0 ){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify( $pathFile );
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load( $pathFile );
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($pathFile, PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        // Lấy worksheet đã cần làm việc
        $sheetActive = $objPHPExcel->getSheet($sheet);
        // Lấy ra số cột có dữ liệu
        $columnExcel = range('A', $sheetActive->getHighestColumn());      
        // Biến lưu giá trị
        $data = $columnValue = array();
        $success = true;
        $row = 1;
        while ( $sheetActive->getCell('A'. $row)->getValue() != '' ){
            if($success == true){
                if($row == 1){
                    foreach ($columnExcel as $col){
                        $value = Func::convertUnicode(addslashes($sheetActive->getCell($col . $row)->getValue()));
                        if( !empty($value) ){
                            foreach ($columns as $k => $v){
                                //if(strpos($v['type'], 'import') !== false){
                                    if($value == Func::convertUnicode($v['title'])){
                                        $columnValue[$col] = $v['key'];
                                        break;
                                    }
                                //}                                
                            }
                        }
                    }
                    // Kiểm tra tiêu đề của file cần đọc
                    if(count($columns) != count($columnValue)){
//                         $success = false;
//                         break;
                    }
                }else{
                    $rowValue = array();
                    foreach ($columnExcel as $col){
                        if(isset($columnValue[$col])){
                            $value = $sheetActive->getCell($col . $row)->getValue();
//                             if(gettype($value) == 'double'){
//                                 $value = number_format($value, 0, '', '');
//                             }else{
//                                 $value = addslashes($value);
//                             }
                            $rowValue[$columnValue[$col]] = ($value);
                        }
                    }
                    $data[] = $rowValue;
                    // Kiểm tra nội dung của file cần đọc
//                     if($row == 2 && (count($columns) != count($rowValue)) ){
//                         $success = false;
//                         break;
//                     }
                }
                $row++;
                continue;
            }
            break;
        }
        return array('success'=>$success, 'data'=>$data);
    }
    // Đọc nội dung file Excel nhà cung cấp từ dòng 2 trở đi
    public function readNCC( $pathFile, $columns, $sheet = 0 ){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify( $pathFile );
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load( $pathFile );
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($pathFile, PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        // Lấy worksheet đã cần làm việc
        $sheetActive = $objPHPExcel->getSheet($sheet);
        // Lấy ra số cột có dữ liệu
        $columnExcel = range('A', $sheetActive->getHighestColumn());      
        // Biến lưu giá trị
        $data = $columnValue = array();
        $success = true;
        $row = 1;
        while ( $sheetActive->getCell('A'. $row)->getValue() != '' ){
        // Lay cot tieu de
            if($success == true){
                if($row == 1){
                    foreach ($columnExcel as $col){
                        $value = Func::convertUnicode(addslashes($sheetActive->getCell($col . $row)->getValue()));
                        if(!empty($value) ){
                            foreach ($columns as $k => $v){
                                //if(strpos($v['type'], 'import') !== false){
                                    if($value == Func::convertUnicode($v['title'])){
                                        $columnValue[$col] = $v['key'];
                                        break;
                                    }
                               // }                                
                            }
                        }
                    }
                }
               if($row >= 3){
                    $rowValue = array();
                    foreach ($columnExcel as $col){
                        if(isset($columnValue[$col])){
                            $value = $sheetActive->getCell($col . $row)->getValue();
//                             if(gettype($value) == 'double'){
//                                 $value = number_format($value, 0, '', '');
//                             }else{
//                                 $value = addslashes($value);
//                             }
                            $rowValue[$columnValue[$col]] = ($value);
                        }
                    }
                    $data[] = $rowValue;
                }
                $row++;
            }
        }
        return array('success'=>$success, 'data'=>$data);
    }
// ===  Đọc file upload điều chỉnh Chi tiết quyết toán ===
    public function readUpld_Settlement($pathFile, $columns, $sheet = 0){
        require_once PATH_PLUGINS.'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify( $pathFile );
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load( $pathFile );
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($pathFile, PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        // Lấy worksheet đã cần làm việc
        $sheetActive = $objPHPExcel->getSheet($sheet);
        // Lấy ra số cột có dữ liệu
        $columnExcel = range('A', $sheetActive->getHighestColumn());      
        // Biến lưu giá trị
        $data = $columnValue = array();
        $success = true;
        $row = 2;
        while ( $sheetActive->getCell('A'. $row)->getValue() != '' ){
        // Lay cot tieu de
            if($success == true){
                if($row == 2){
                    foreach ($columnExcel as $col){
                        $value = Func::convertUnicode(addslashes($sheetActive->getCell($col . $row)->getValue()));
                        if(!empty($value) ){
                            foreach ($columns as $k => $v){
                                //if(strpos($v['type'], 'import') !== false){
                                    if($value == Func::convertUnicode($v['title'])){
                                        $columnValue[$col] = $v['key'];
                                        break;
                                    }
                               // }                                
                            }
                        }
                    }
                }
                if($row >3 AND $row <9){
                    $rowValue = array();
                    foreach ($columnExcel as $col){
                        if(isset($columnValue[$col])){
                            $value = $sheetActive->getCell($col . $row)->getValue();
//                             if(gettype($value) == 'double'){
//                                 $value = number_format($value, 0, '', '');
//                             }else{
//                                 $value = addslashes($value);
//                             }
                            $rowValue[$columnValue[$col]] = $value;
                        }

                    }
                    $data[] = $rowValue; 
                }
                $row++;
            }
        }
        return array('success'=>$success, 'data'=>$data);
    } //End of function

    public function writeQuestion($filename, $data, $columns, $params = array(),$titleName) {
        require_once PATH_PLUGINS . 'PHPExcel/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $sheetActive = $objPHPExcel->getActiveSheet();
        $row = 1; // 3
        $flag = true;
        $colAZ = range('A', 'Z');
        $columnsNew = [];
//Khởi tạo đối tượng
        $excel = new PHPExcel();
//Chọn trang cần ghi (là số từ 0->n)
        $excel->setActiveSheetIndex(0);
//Tạo tiêu đề cho trang. (có thể không cần)
        $excel->getActiveSheet()->setTitle($titleName);

//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
        /*$excel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);*/
        
//Xét in đậm cho khoảng cột
        $excel->getActiveSheet()->getStyle('A1:M1')->getFont()->setBold(true);
//Tạo tiêu đề cho từng cột
//Vị trí có dạng như sau:
        /**
         * |A1|B1|C1|..|n1|
         * |A2|B2|C2|..|n1|
         * |..|..|..|..|..|
         * |An|Bn|Cn|..|nn|
         */
        $excel->getActiveSheet()->setCellValue('A1', '주문');//thutu self::$_language['l_question99']
        $excel->getActiveSheet()->setCellValue('B1', '상태');//trangthai self::$_language['l_status']
        $excel->getActiveSheet()->setCellValue('C1', '채널사명');//kenh self::$_language['l_Channel7']
        $excel->getActiveSheet()->setCellValue('D1', '채널문의번호');//id cau hoi self::$_language['l_question7']
        $excel->getActiveSheet()->setCellValue('E1', '문의내용');//noidungcauhoi self::$_language['l_question5']
        $excel->getActiveSheet()->setCellValue('F1', '상품명');//tên sp self::$_language['l_nameproduct']
        $excel->getActiveSheet()->setCellValue('G1', '옵션명');//tên option  self::$_language['l_nameoption']
        $excel->getActiveSheet()->setCellValue('H1', '주문여부');//dathang self::$_language['l_question8']
        $excel->getActiveSheet()->setCellValue('I1', '문의자명');//tennguoihoi //self::$_language['l_question6']
        $excel->getActiveSheet()->setCellValue('J1', '문의일');//ngayhoi  self::$_language['l_question3']
        $excel->getActiveSheet()->setCellValue('K1', '응답자의 이름');//tennguoitraloi self::$_language['l_question100']
        $excel->getActiveSheet()->setCellValue('L1', '회신 날짜');//ngaytraloi self::$_language['l_question101']
        $excel->getActiveSheet()->setCellValue('M1', '회신 내용');//noidungtraloi self::$_language['l_question102']
        /*$excel->getActiveSheet()->setCellValue('N1', 'dealName');
        $excel->getActiveSheet()->setCellValue('O1', 'optionId');
        $excel->getActiveSheet()->setCellValue('P1', 'optionName');
        $excel->getActiveSheet()->setCellValue('Q1', 'channel_name');*/
        // thực hiện thêm dữ liệu vào từng ô bằng vòng lặp        
        // dòng bắt đầu = 2
        
        $i=2;
        foreach ($data as $key => $value) {
            if($value['question_status']==1){
                $question_status='답변대기';//self::$_language['l_anwserbefore'];
            }elseif($value['question_status']==2){
                $question_status='답변완료';//self::$_language['l_anwserdone'];
            }else{
                $question_status="";
            }
            $excel->setActiveSheetIndex(0)
                    ->setCellValue("A$i", $i-1)
                    ->setCellValue("B$i", $question_status)
                    ->setCellValue("C$i", $value['channel_name'])
                    ->setCellValue("D$i", $value['question_id'])
                    ->setCellValue("E$i", $value['question_content'])
                    ->setCellValue("F$i", $value['dealId'])
                    ->setCellValue("G$i", $value['optionName'])
                    ->setCellValue("H$i", $value['question_purchase'])
                    ->setCellValue("I$i", $value['question_name'])
                    ->setCellValue("J$i", $value['question_created'])
                    ->setCellValue("K$i", $value['reply_name'])
                    ->setCellValue("L$i", $value['reply_created'])
                    ->setCellValue("M$i", $value['reply_content'])
                    /*->setCellValue("N$i", $value['dealName'])
                    ->setCellValue("O$i", $value['optionId'])
                    ->setCellValue("P$i", $value['optionName'])
                    ->setCellValue("Q$i", $value['channel_name'])*/;
            $i++;
        }
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename .= '-' . date('d-m-Y', time()) . '-' . time() . '.xlsx';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $objWriter->save('php://output');
    }
    // Đọc nội dung file Excel Product Coupang
    public function readProductCounpang($pathFile, $columns, $sheet = 0) {
        require_once PATH_PLUGINS . 'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($pathFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($pathFile);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($pathFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $sheetActive = $objPHPExcel->getSheet($sheet);
        $sheetActive_img = $objPHPExcel->getSheet($sheet);
        // Biến lưu giá trị
        $success = true;
        $row = 6;
        $i = 0;
        
        $sheetActive_img = $objPHPExcel->getSheet(0);        
        foreach ($sheetActive_img->getDrawingCollection() as $img) {
            list($startColumn, $startRow) = PHPExcel_Cell::coordinateFromString($img->getCoordinates()); //Get the row and column of the picture
            $imageFileName = $img->getCoordinates() . mt_rand(1000000000, 9999999999);
            switch($img->getExtension()) {
                case 'jpg':
                case 'jpeg':
                    $imageFileName .= '.jpeg';
                    $source = imagecreatefromjpeg($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
                case 'gif':
                    $imageFileName .= '.gif';
                    $source = imagecreatefromgif($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
                case 'png':
                    $imageFileName .= '.png';
                    $source = imagecreatefrompng($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
            }
            $dataimg[$img->getCoordinates()][]=$imageFileName;//$startColumn = $this->ABC2decimal($startColumn);
        }
        
        while ($sheetActive->getCell('C' . $row)->getValue() != '') {
            $data[$i][] = $sheetActive->getCell("C" . $row)->getValue(); //NO
            $data[$i][] = $sheetActive->getCell("D" . $row)->getValue(); //Tên sản phẩm
            $data[$i][] = $sheetActive->getCell("E" . $row)->getValue(); //Loại hình sản phẩm
            $data[$i][] = $sheetActive->getCell("F" . $row)->getValue(); //Loại hình bán sản phẩm
            $data[$i][] = $sheetActive->getCell("G" . $row)->getValue(); //Tên option (bắt buộc)
            $data[$i][] = $sheetActive->getCell("H" . $row)->getValue(); //Option 1
            $data[$i][] = $sheetActive->getCell("I" . $row)->getValue(); //Option 2
            $data[$i][] = $sheetActive->getCell("J" . $row)->getValue(); //Loại người tham dự
            $data[$i][] = $sheetActive->getCell("K" . $row)->getValue(); //Ngày bắt đầu bán
            $data[$i][] = $sheetActive->getCell("L" . $row)->getValue(); //Ngày kết thúc bán
            $data[$i][] = $sheetActive->getCell("M" . $row)->getValue(); //Ngày bắt đầu sử dụng
            $data[$i][] = $sheetActive->getCell("N" . $row)->getValue(); //Ngày kết thúc sử dụng
            $data[$i][] = $sheetActive->getCell("O" . $row)->getValue(); //Loại hình giá bình thường
            $data[$i][] = $sheetActive->getCell("P" . $row)->getValue(); //Giá bình thường
            $data[$i][] = $sheetActive->getCell("Q" . $row)->getValue(); //Loại thuế
            $data[$i][] = $sheetActive->getCell("R" . $row)->getValue(); //Giới thiệu sản phẩm
            $data[$i][] = $sheetActive->getCell("S" . $row)->getValue(); //Thông báo
            $data[$i][] = $sheetActive->getCell("T" . $row)->getValue(); //Ưu đãi, thưởng
            $data[$i][] = $sheetActive->getCell("U" . $row)->getValue(); //Địa chỉ
            $data[$i][] = $sheetActive->getCell("V" . $row)->getValue(); //Website
            $data[$i][] = $sheetActive->getCell("W" . $row)->getValue(); //Số điện thoại đại diện
            $data[$i][] = $sheetActive->getCell("X" . $row)->getValue(); //Điện thoại tư vấn mua hàng
            $data[$i][] = $sheetActive->getCell("Y" . $row)->getValue(); //Điện thoại tư vấn hủy
            $data[$i][] = $sheetActive->getCell("Z" . $row)->getValue(); //Thời gian tư vấn của trung tâm khách hàng
            $data[$i][] = $sheetActive->getCell("AA" . $row)->getValue(); //Type khu vực
            $data[$i][] = $sheetActive->getCell("AB" . $row)->getValue(); //Có sử dụng ngay k0
            $data[$i][] = $sheetActive->getCell("AC" . $row)->getValue(); //Dưới 19 tuổi k0 đc mua
            $data[$i][] = $sheetActive->getCell("AD" . $row)->getValue(); //Phương thức cung cấp vé
            $data[$i][] = $sheetActive->getCell("AE" . $row)->getValue(); //Vé k0 sử dụng có hoàn tiền 100% k0
            $data[$i][] = $sheetActive->getCell("AF" . $row)->getValue(); //Setting hủy
            $data[$i][] = $sheetActive->getCell("AG" . $row)->getValue(); //Có tiếp nhận hủy theo ngày làm việc k0
            $data[$i][] = $sheetActive->getCell("AH" . $row)->getValue(); //Hướng dẫn đặt vé
            $data[$i][] = $sheetActive->getCell("AI" . $row)->getValue(); //Nội dung chi tiết sản phẩm
            $data[$i][] = $sheetActive->getCell("AJ" . $row)->getValue(); //Keyword khu vực
            $data[$i][] = $sheetActive->getCell("AK" . $row)->getValue(); //Tag tìm kiếm
            $img_hinh='';
            if(count($dataimg['AL'.$row])>0){
                foreach ($dataimg['AL'.$row] as $key=>$value){
                    $img_hinh.=$value.",";
                }
                $img_hinh=substr($img_hinh, 0, -1);
            }
            $data[$i][] = $img_hinh;//$sheetActive->getCell("AL" . $row)->getValue(); //Hình
            $data[$i][] = $sheetActive->getCell("AM" . $row)->getValue(); //Quyết toán
            $data[$i][] = $sheetActive->getCell("AN" . $row)->getValue(); //Email
            $data[$i][] = $sheetActive->getCell("AO" . $row)->getValue(); //Fax
            $data[$i][] = $sheetActive->getCell("AP" . $row)->getValue(); //SL mua tối đa 1 lần
            $data[$i][] = $sheetActive->getCell("AQ" . $row)->getValue(); //SL mua tối đa 1 người
            $row++;
            $i++;
        }
        return array('success' => $success, 'data' => $data);
    }

    // Đọc nội dung file Excel Product WMP
    public function readProductWMP($pathFile, $columns, $sheet = 1) {
        require_once PATH_PLUGINS . 'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($pathFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($pathFile);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($pathFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $sheetActive = $objPHPExcel->getSheet($sheet);
        $sheetActive_img = $objPHPExcel->getSheet($sheet);
        // Biến lưu giá trị
        $success = true;
        $row = 6;
        $i = 0;            
        foreach ($sheetActive_img->getDrawingCollection() as $img) {
            list($startColumn, $startRow) = PHPExcel_Cell::coordinateFromString($img->getCoordinates()); //Get the row and column of the picture
            $imageFileName = $img->getCoordinates() . mt_rand(1000000000, 9999999999);
            switch($img->getExtension()) {
                case 'jpg':
                case 'jpeg':
                    $imageFileName .= '.jpeg';
                    $source = imagecreatefromjpeg($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
                case 'gif':
                    $imageFileName .= '.gif';
                    $source = imagecreatefromgif($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
                case 'png':
                    $imageFileName .= '.png';
                    $source = imagecreatefrompng($img->getPath());
                    imagejpeg($source, PATH_ROOT."/attach/klkim-project.appspot.com/upload/".$imageFileName);
                    break;
            }
            $dataimg[$img->getCoordinates()][]=$imageFileName;
        }                
        while ($sheetActive->getCell('B' . $row)->getValue() != '') {
            $data[$i][] = $sheetActive->getCell("B" . $row)->getValue(); //NO
            $data[$i][] = $sheetActive->getCell("C" . $row)->getValue(); //Tên đối tác
            $data[$i][] = $sheetActive->getCell("D" . $row)->getValue(); //MD phụ trách
            $data[$i][] = $sheetActive->getCell("E" . $row)->getValue(); //Setting phí
            $data[$i][] = $sheetActive->getCell("F" . $row)->getValue(); //Tên NCC
            $data[$i][] = $sheetActive->getCell("G" . $row)->getValue(); //Địa chỉ
            $data[$i][] = $sheetActive->getCell("H" . $row)->getValue(); //Số điện thoại
            $data[$i][] = $sheetActive->getCell("I" . $row)->getValue(); //Website
            $data[$i][] = $sheetActive->getCell("J" . $row)->getValue(); //Type sản phẩm
            $data[$i][] = $sheetActive->getCell("K" . $row)->getValue(); //Type khu vực
            $data[$i][] = $sheetActive->getCell("L" . $row)->getValue(); //Tên sản phẩm
            $data[$i][] = $sheetActive->getCell("M" . $row)->getValue(); //Chi tiết sản phẩm
            $data[$i][] = $sheetActive->getCell("N" . $row)->getValue(); //Thời gian bán
            $img_hinh='';
            if(count($dataimg['O'.$row])>0){
                foreach ($dataimg['O'.$row] as $key=>$value){
                    $img_hinh.=$value.",";
                }
                $img_hinh=substr($img_hinh, 0, -1);
            }
            $data[$i][] = $img_hinh;//$sheetActive->getCell("O" . $row)->getValue(); //Hình sản phẩm
            $img_hinh_listing='';
            if(count($dataimg['P'.$row])>0){
                foreach ($dataimg['P'.$row] as $key=>$value){
                    $img_hinh_listing.=$value.",";
                }
                $img_hinh_listing=substr($img_hinh_listing, 0, -1);
            }
            $data[$i][] = $img_hinh_listing;//$sheetActive->getCell("P" . $row)->getValue(); //Hình listing
            $data[$i][] = $sheetActive->getCell("Q" . $row)->getValue(); //Giá bình thường
            $data[$i][] = $sheetActive->getCell("R" . $row)->getValue(); //Giá bán
            $data[$i][] = $sheetActive->getCell("S" . $row)->getValue(); //Tồn kho của từng option
            $data[$i][] = $sheetActive->getCell("T" . $row)->getValue(); //Hiển thị hay k0
            $data[$i][] = $sheetActive->getCell("U" . $row)->getValue(); //Thông tin giá chuẩn
            $data[$i][] = $sheetActive->getCell("V" . $row)->getValue(); //Người phát hành
            $data[$i][] = $sheetActive->getCell("W" . $row)->getValue(); //Thời gian hiệu lực
            $data[$i][] = $sheetActive->getCell("X" . $row)->getValue(); //Điều kiện sử dụng
            $data[$i][] = $sheetActive->getCell("Y" . $row)->getValue(); //Nơi có thể sử dụng
            $data[$i][] = $sheetActive->getCell("Z" . $row)->getValue(); //hoàn tiền 100%
            $data[$i][] = $sheetActive->getCell("AA" . $row)->getValue(); //Nội dung hủy/hoàn tiền
            $data[$i][] = $sheetActive->getCell("AB" . $row)->getValue(); //Số điện thoại tư vấn khách hàng
            $data[$i][] = $sheetActive->getCell("AC" . $row)->getValue(); //Số điện thoại hủy/hoàn tiền
            $data[$i][] = $sheetActive->getCell("AD" . $row)->getValue(); //Loại hình bán sản phẩm
            $data[$i][] = $sheetActive->getCell("AE" . $row)->getValue(); //Email
            $data[$i][] = $sheetActive->getCell("AF" . $row)->getValue(); //Fax
            $data[$i][] = $sheetActive->getCell("AG" . $row)->getValue(); //Tên option
            $row++;
            $i++;
        }
        return array('success' => $success, 'data' => $data);
    }

    // Đọc nội dung file Excel Product GMK
    public function readProductGMK($pathFile, $columns, $sheet = 2) {
        require_once PATH_PLUGINS . 'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($pathFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($pathFile);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($pathFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $sheetActive = $objPHPExcel->getSheet($sheet);
        // Biến lưu giá trị
        $data = $columnValue = array();
        $success = true;
        $row = 6;
        $i = 0;
        while ($sheetActive->getCell('B' . $row)->getValue() != '') {
            $data[$i][] = $sheetActive->getCell("B" . $row)->getValue(); //NO
            $data[$i][] = $sheetActive->getCell("C" . $row)->getValue(); //Tên sản phẩm
            $data[$i][] = $sheetActive->getCell("D" . $row)->getValue(); //Type
            $data[$i][] = $sheetActive->getCell("E" . $row)->getValue(); //Thời gian bán
            $data[$i][] = $sheetActive->getCell("F" . $row)->getValue(); //Giá bán
            $data[$i][] = $sheetActive->getCell("G" . $row)->getValue(); //Option đặt vé
            $data[$i][] = $sheetActive->getCell("H" . $row)->getValue(); //Thành phần thêm
            $data[$i][] = $sheetActive->getCell("I" . $row)->getValue(); //Số lượng tồn kho
            $data[$i][] = $sheetActive->getCell("J" . $row)->getValue(); //Hình sản phẩm
            $data[$i][] = $sheetActive->getCell("K" . $row)->getValue(); //Trường nhập thông tin sản phẩm
            $data[$i][] = $sheetActive->getCell("L" . $row)->getValue(); //Trường nhập thông tin sản phẩm thành phần thêm
            $data[$i][] = $sheetActive->getCell("M" . $row)->getValue(); //Trường nhập thông tin quảng cáo/quảng bá
            $data[$i][] = $sheetActive->getCell("N" . $row)->getValue(); //Chính sách giao vé
            $data[$i][] = $sheetActive->getCell("O" . $row)->getValue(); //Phương thức gửi
            $data[$i][] = $sheetActive->getCell("P" . $row)->getValue(); //Setting phí gửi
            $data[$i][] = $sheetActive->getCell("Q" . $row)->getValue(); //Setting thông tin trả vé
            $data[$i][] = $sheetActive->getCell("R" . $row)->getValue(); //Thông báo
            $row++;
            $i++;
        }
        return array('success' => $success, 'data' => $data); //);
    }

    // Đọc nội dung file Excel Product Naver
    public function readProductNaver($pathFile, $columns, $sheet = 3) {
        require_once PATH_PLUGINS . 'PHPExcel/PHPExcel/IOFactory.php';
        try {
            $inputFileType = PHPExcel_IOFactory::identify($pathFile);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($pathFile);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($pathFile, PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }
        $sheetActive = $objPHPExcel->getSheet($sheet);
        // Biến lưu giá trị
        $data = $columnValue = array();
        $success = true;
        $row = 6;
        $i = 0;
        while ($sheetActive->getCell('B' . $row)->getValue() != '') {
            $data[$i][] = $sheetActive->getCell("B" . $row)->getValue(); //NO
            $data[$i][] = $sheetActive->getCell("C" . $row)->getValue(); //Tên sản phẩm
            $data[$i][] = $sheetActive->getCell("D" . $row)->getValue(); //Giới thiệu sản phẩm
            $data[$i][] = $sheetActive->getCell("E" . $row)->getValue(); //Hình đại diện
            $data[$i][] = $sheetActive->getCell("F" . $row)->getValue(); //Hình sản phẩm
            $data[$i][] = $sheetActive->getCell("G" . $row)->getValue(); //Giới thiệu chi tiết
            $data[$i][] = $sheetActive->getCell("H" . $row)->getValue(); //Độ tuổi có thể sử dụng
            $data[$i][] = $sheetActive->getCell("I" . $row)->getValue(); //Thời gian có thể sử dụng
            $data[$i][] = $sheetActive->getCell("J" . $row)->getValue(); //Hạn chế số lượng 1 ID có thể mua
            $data[$i][] = $sheetActive->getCell("K" . $row)->getValue(); //Số lượng đặt
            $data[$i][] = $sheetActive->getCell("L" . $row)->getValue(); //Số lượng đặt tối đa
            $data[$i][] = $sheetActive->getCell("M" . $row)->getValue(); //Địa chỉ
            $data[$i][] = $sheetActive->getCell("N" . $row)->getValue(); //Vị trí chi tiết
            $data[$i][] = $sheetActive->getCell("O" . $row)->getValue(); //Số điện thoại
            $data[$i][] = $sheetActive->getCell("P" . $row)->getValue(); //Giá cơ bản
            $data[$i][] = $sheetActive->getCell("Q" . $row)->getValue(); //Số lượng tồn kho
            $row++;
            $i++;
        }
        return array('success' => $success, 'data' => $data); //);
    }
} ?>