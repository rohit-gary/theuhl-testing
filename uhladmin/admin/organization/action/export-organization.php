<?php
@session_start();
require_once('../../include/autoloader.inc.php');
$dbh = new Dbh();
$conn = $dbh->_connectodb();
$core = new Core();
$authentication = new Authentication($conn);
$authenticated = $authentication->SessionCheck();

$output ="";
$where = " where 1";
$books_details = $core->_getTableRecords($conn,'books', $where);
if ($books_details > 0) {
    $output .= '
   <table class="table" border="1">  
                    <tr>  
                         <th>Book Name</th> 
                         <th>Price</th> 
                         <th>Book PDF</th>                            
                         <th>Created By</th> 
                         <th>Status</th> 
                    </tr>
  ';
    foreach ($books_details as $BooksData) {
        $status = "Deactivate";
        if($BooksData['IsActive'] == 1){
            $status = "Activate";
        }
        $output .= '<tr>  
                        <td>' . $BooksData["BookName"] . '</td> 
                        <td>' . $BooksData["Price"] . '</td>
                        <td>' . $BooksData["BookPDF"] . '</td>
                        <td>' . $BooksData["CreatedBy"] . '</td>
                        <td>' . $status . '</td>
                    </tr>
   ';
    }

} else {
    $output = "<table><tr><td>No Data Available</td></tr></table>";
}
echo $output;
$myfile = fopen("../report.xls", "w");
fwrite($myfile, $output);
fclose($myfile);
?>