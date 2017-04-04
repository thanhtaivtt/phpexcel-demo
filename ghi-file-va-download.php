<?php
require "Classes/PHPExcel.php";
$data = [
['Nguyễn Khánh Linh', 'Nữ', '500k'], 
['Ngọc Trinh', 'Nữ', '700k'], 
['Tùng Sơn', 'Không xác định', 'Miễn phí'], 
['Kenny Sang', 'Không xác định', 'Miễn phí']
];
	//Khởi tạo đối tượng
$excel = new PHPExcel();
	//Chọn trang cần ghi (là số từ 0->n)
$excel->setActiveSheetIndex(0);
	//Tạo tiêu đề cho trang. (có thể không cần)
$excel->getActiveSheet()->setTitle('demo ghi dữ liệu');

	//Xét chiều rộng cho từng, nếu muốn set height thì dùng setRowHeight()
$excel->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('C')->setWidth(30);

	//Xét in đậm cho khoảng cột
$excel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
	//Tạo tiêu đề cho từng cột
	//Vị trí có dạng như sau:
	/**
	 * |A1|B1|C1|..|n1|
	 * |A2|B2|C2|..|n1|
	 * |..|..|..|..|..|
	 * |An|Bn|Cn|..|nn|
	 */
	$excel->getActiveSheet()->setCellValue('A1', 'Tên');
	$excel->getActiveSheet()->setCellValue('B1', 'Giới Tính');
	$excel->getActiveSheet()->setCellValue('C1', 'Đơn giá(/shoot)');
	// thực hiện thêm dữ liệu vào từng ô bằng vòng lặp
	// dòng bắt đầu = 2
	$numRow = 2;
	foreach($data as $row){
		$excel->getActiveSheet()->setCellValue('A'.$numRow, $row[0]);
		$excel->getActiveSheet()->setCellValue('B'.$numRow, $row[1]);
		$excel->getActiveSheet()->setCellValue('C'.$numRow, $row[2]);
		$numRow++;
	}
	// Khởi tạo đối tượng PHPExcel_IOFactory để thực hiện ghi file
	// ở đây mình lưu file dưới dạng excel2007 và cho người dùng download luôn
	header('Content-type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename="data.xls"');
	PHPExcel_IOFactory::createWriter($excel, 'Excel2007')->save('php://output');