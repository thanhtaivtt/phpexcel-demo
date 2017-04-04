<?php
//Nhúng file PHPExcel
require_once 'Classes/PHPExcel.php';
 
//Đường dẫn file
$file = 'data.xlsx';
$objFile = PHPExcel_IOFactory::identify($file);
$objData = PHPExcel_IOFactory::createReader($objFile);
//Chỉ đọc dữ liệu
$objData->setReadDataOnly(true);
 
/**  Load $inputFileName to a PHPExcel Object  **/
$objPHPExcel = $objData->load("$file");
 
$total_sheets=$objPHPExcel->getSheetCount();
 
$allSheetName=$objPHPExcel->getSheetNames();
$objWorksheet  = $objPHPExcel->setActiveSheetIndex(0);
$highestRow    = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();
$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
$arraydata = array();
for ($row = 2; $row <= $highestRow;++$row)
{
    for ($col = 0; $col <$highestColumnIndex;++$col)
    {
        $value=$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
        $arraydata[$row-2][$col]=$value;
    }
}
 
echo '<pre>';
print_r($arraydata);
echo '</pre>';