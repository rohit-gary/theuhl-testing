<?php
require_once('../api/common_api_header.php');
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
require_once("../include/db-connection.php");
require_once '../../vendor/autoload.php'; // Assuming you have Dompdf installed using Composer
/*use Dompdf\Dompdf;
use Dompdf\Options;*/
// $html = file_get_contents('generate-service-report.php');
/*$data_raw = file_get_contents('php://input');
$data = json_decode($data_raw,true);
$ID = $data['ID'];*/

// Start MPDF
$mpdf = new \Mpdf\Mpdf();


$ID = 1;
$logs = new Logs();
$logs->SetCurrentAPILogFile();
//$logs->WriteLog($data_raw,__FILE__,__LINE__);
$core = new Core();

$Servicereport = new Servicereport($conn,$logs);
$data = array();
$data['ID'] = $ID;
$report_detail = $Servicereport->GetServiceReportByID($data);
$CompanySiteID = $report_detail['CompanySiteID'];
extract($report_detail);   
$company = new Company($conn);
$data['CompanySiteID'] = $CompanySiteID;
$company_details = $company->GetCompanySiteDetails($data);
extract($company_details); 

if($SiteName == ""){
  $SiteName = 'N/A';
}

if($SitePOCName == ""){
    $SitePOCName = 'N/A';
}

if($SiteAddress == ""){
  $SiteAddress = 'N/A';
}

if($SitePOCEmail == ""){
  $SitePOCEmail = 'N/A';
}
if($SitePOCContact == ""){
  $SitePOCContact = 'N/A';
}

if($HelpdeskComplaintNumber == ""){
  $HelpdeskComplaintNumber = 'N/A';
}
if($ReportedBy == ""){
  $ReportedBy = 'N/A';
}
if($AttendedDate == ""){
  $AttendedDate = 'N/A';
}
if($CreatedDate == ""){
  $CreatedDate = 'N/A';
}
if($NatureOfCall == ""){
  $NatureOfCall = 'N/A';
}

if($ProblemReportedByClient == ""){
  $ProblemReportedByClient = 'N/A';
}
if($JLLObservation == ""){
  $JLLObservation = 'N/A';
}
if($ActionTaken == ""){
  $ActionTaken = 'N/A';
}



$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            font-family: Inter;
            font-size:12pt;
        }  
        table {
            width: 100%;
        }
        .top_header{
           background:#08475e;
           border:1px solid #000;
        }
        .top_header tr td{
            width:50%;
         }
         .top_header_inside tr td {
            text-align:center;
            color:#fff;
            font-weight:bold;
            font-family: sans-serif;
            font-size:15px;
         }
         .top_right_border{
            border-right:1px solid #fff;
         } 

         
         .customer_details{
            border:1px solid #000;
         }
         .customer_details tr td{
            width:50%;
         }
         .customer_details_inside tr td{
             font-size:11px;
             font-family: sans-serif;
         }
         .customer_details_inside tr td{
            padding:3px 0px;
         }
         .costumer_detail_bold{
            font-weight:bold;
            width:100px;
            font-size:12px;
         }
         .custumer_right_border{
            border-right:1px solid #000;
         }
         .report_details_inside tr td{
            font-size:11px;
            font-family: sans-serif;
        }
        .report_details_inside tr td{
           padding:3px 0px;
        }
        
        .customer_details tr {
            display: inline-flex !important;
        }
        .other_feedback{
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
            padding-bottom:80px;
        }
        .other_feedback tr .width_30{
            font-weight:bold;
            font-size:12px;
            font-family: sans-serif;
        }
        .other_feedback_inside td{
            font-size:11px;
            font-family: sans-serif;
            margin-top:10px;
        }


        .attacment{
            background:#08475e;
            padding:6px 0px 6px 6px;
            color:#fff;
            font-size:14px;
            font-weight:bold;
            font-family: sans-serif;
        }
        .product_attachment_box{
            border: 1px solid #000;
            padding:30px;
        }
        .product_attachment{
            border: 1px solid #000;
            width:100%;
        }

        .product_attachment img{
            width:100%;
        }

        .bottom_signature_table{
            border:1px solid #000;
            border-collapse: collapse;
        }

        .bottom_table_bold{
            font-weight:bold;
            font-size:13px;
            padding-left:10px !important;
        }

        .bottom_signature_table tbody tr td{
            font-family: sans-serif;
            border:1px solid #000;
            font-size:12px;
            padding-top:15px;
            padding-bottom:15px;
            width:33%;
        }


        .natural_of_call_div{
            border-left: 1px solid #000;
            border-right: 1px solid #000;
            font-weight:bold;
            font-size:12px;
            padding:4px 7px;
            font-family: sans-serif;
        }
        .natural_table_bold{
            font-weight:bold;
            font-size:11px;
            padding-left:10px !important;
        }
        .natural_call_table{
            border:1px solid #000;
            border-collapse: collapse;
        }
        .natural_call_table tbody tr td{
            font-family: sans-serif;
            border:1px solid #000;
            padding:10px 5px;
        }
        .pdf_header{
            width:100%;
        }
        .pdf_header img {
            width:100%;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="pdf_header">
           <img src="./report_header4.png">
        </div>
        <div style="display:flex;">
            <table class="top_header">
                <tr>
                    <td class="top_right_border">
                        <table class="top_header_inside">
                            <tr>
                            <td>Customer Details</td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="top_header_inside">
                            <tr>
                            <td>Service Ticket Details</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <table  class="customer_details">
                <tr>
                    <td class="custumer_right_border">
                        <table class="customer_details_inside">
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Name</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">NX One</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Address</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;"> Sector 4, Greater
                                Noida West</td>
                            </tr>
                           
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Mobile No.</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">8826789578</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                             <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"></td>
                                <td style="width:10%;"></td>
                                <td style="width:40%;"></td>
                            </tr>
                        </table>
                    </td>
                    <td>
                        <table class="report_details_inside">
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Ticket/Complaint No</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">JLL_01</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Service Type</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">Breakdown</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Obligation</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">WTY</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Ticket Status</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">Open</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"> Complaint Registered</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">2222we</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Reported by</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">Prateek</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Attended Date</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">2024-04-10</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Completed Date</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">N/A</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"> Channel Partner Name</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">Anshutech Airconditioning Pvt.
                                Ltd.</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div>
          <div class="natural_of_call_div">
             Nature of Call 
          </div>
        </div>
        <div>
            <table class="natural_call_table" style="border-bottom:none;">
                <tbody>
                    <tr>
                        <td style="width:23.3%" class="natural_table_bold">Comprehensive AMC </td>
                        <td style="width:10%"></td>
                        <td style="width:23.3%" class="natural_table_bold">Warranty</td>
                        <td style="width:10%"></td>
                        <td style="text-align:center;" class="natural_table_bold" rowspan="2">other</td>
                        <td style="width:23.3%"  class="natural_table_bold">Emergency</td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td style="width:23.3%"  class="natural_table_bold">Non-Comprehensive AMC</td>
                        <td style="width:10%"></td>
                        <td style="width:23.3%"  class="natural_table_bold">Chargeable</td>
                        <td style="width:10%"></td>
                        <td style="width:23.3%"  class="natural_table_bold">Complaint</td>
                        <td style="width:10%"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30"> Problem Reported by Client: </td>
                    
                </tr>
                <tr class="other_feedback_inside">
                  <td> Problem Reported by Client: </td>
                </tr>
            </table>
        </div>
        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30"> JLL Observation: </td>
                    <tr class="other_feedback_inside">
                      <td> Problem Reported by Client: </td>
                    </tr>
                </tr>
            </table>
        </div>
        <div >
            <table class="other_feedback" style="padding-bottom:170px;">
                <tr>
                    <td class="width_30"> Action Taken: </td>
                </tr>
                <tr class="other_feedback_inside">
                  <td> Problem Reported by Client: </td>
                </tr>
            </table>
        </div>

        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30"> Remark: </td>
                </tr>
                <tr class="other_feedback_inside">
                  <td> Problem Reported by Client: </td>
                </tr>
            </table>
        </div>
        <div class="attacment">
            Attachments
        </div>
        <div class="product_attachment_box">
            <div class="product_attachment">
                <!-- Product Attachment 1 -->
                <img class="mt-3"
                    src="./media/ac.png" alt="">
            </div>
        </div>
        <table class="bottom_signature_table" style="border-bottom:none;">
            <tbody>
                <tr>
                    <td class="bottom_table_bold" colspan="2">JLL MES Technician (Job Done By)</td>
                    <td class="bottom_table_bold">Signature</td>
                </tr>
                <tr>
                    <td class="bottom_table_bold">1</td>
                    <td class="bottom_table_bold">Name:</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bottom_table_bold">2</td>
                    <td class="bottom_table_bold">Address:</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="bottom_signature_table" style="border-top:none;">
            <tbody>
                <tr>
                    <td class="bottom_table_bold" colspan="2">Onsite Client Representative Name (Verified By)</td>
                    <td class="bottom_table_bold" >Signature</td>
                </tr>
                <tr>
                    <td class="bottom_table_bold">1</td>
                    <td class="bottom_table_bold">Name:</td>
                    <td></td>
                </tr>
                <tr>
                    <td class="bottom_table_bold">2</td>
                    <td class="bottom_table_bold">Address:</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';
$mpdf->WriteHTML("");
$mpdf->WriteHTML($html);
$mpdf->Output();

echo $html;

// $this->fontdata = array(
//     "newFont" => array(
//     'R' => "newFont-Regular.ttf",
//     'B' => "newFont-Bold.ttf",
//     'I' => "newFont-Italic.ttf",
//     'BI' => "newFont-BoldItalic.ttf",
// ),
// End MPDF
/*$options = new Options();
$options->set('chroot', realpath(''));
$options->set('defaultFont', 'system ui');
$dompdf = new Dompdf($options);
$dompdf->getOptions()->getChroot();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait'); // Set paper size and orientation

$dompdf->render();
// $dompdf->stream('field_service_report.pdf'); // Output as 'field_service_report.pdf'
$pdf = $dompdf->output();*/
$pdf_name = "$ID-service-report.pdf";
file_put_contents('service-roport-pdf/'.$pdf_name.'',$pdf);

$ReportID = $report_detail['ReportID'];
// send curlrequest 
$mail_data['action'] = "Test";
$mail_data['SiteName'] = $SiteName;
$mail_data['POCEmail'] = $SitePOCEmail;
$mail_data['POCName'] = $SitePOCName;
$mail_data['ReportID'] = $ReportID;
$mail_data['FilePath'] = $pdf_name;

$url = "https://jll.digitalworkdesk.com/jll-management/api/send-email-api.php";
//$core->sendMailRequest($mail_data,$url);

// update database 

$update_sql = " ReportPath = '$pdf_name' where ID = $ReportID";
$response = $core->_UpdateTableRecords($conn,'service_reports',$update_sql);
//echo '<iframe src="data:application/pdf;base64,'.base64_encode($pdf).'" width="100%" height="600px"></iframe>';
?>
