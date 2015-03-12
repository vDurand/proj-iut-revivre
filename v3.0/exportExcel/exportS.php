<?php
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="exportSalaries.xlsx"');
header('Cache-Control: max-age=0');
readfile("export_salaries.xlsx" ); 

?>