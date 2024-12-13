<?php
require_once('../api/common_api_header.php');
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
require_once("../include/db-connection.php");
require_once '../../vendor/autoload.php'; // Assuming you have Dompdf installed using Composer
/*use Dompdf\Dompdf;
use Dompdf\Options;*/
// $html = file_get_contents('generate-service-report.php');
$data_raw = file_get_contents('php://input');
$data = json_decode($data_raw,true);
$ID = $data['ID'];

// Start MPDF
$mpdf = new \Mpdf\Mpdf();

// $ID = $data['ReportID'];
// $ID = 1;
$logs = new Logs();
$logs->SetCurrentMailLogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$core = new Core();

$Servicereport = new Servicereport($conn,$logs);
$data = array();
$data['ID'] = $ID;
$report_detail = $Servicereport->GetServiceReportByID($data);
extract($report_detail);
// print_r($report_detail);
// die();  
$company = new Company($conn);
$data['CompanySiteID'] = $CompanySiteID;
$company_details = $company->GetCompanySiteDetails($data);
extract($company_details); 
$ZoneEmail = "";
if($ZoneID != -1)
{
    $zone_obj = new Zone($conn);
    $data_zone['ZoneID'] = $ZoneID;
    $zone_details = $zone_obj->GetZoneDetails($data_zone);
    $ZoneEmail = $zone_details['ZoneEmail'];
}

if($SiteName == ""){
  $SiteName = '';
}

if($SitePOCName == ""){
    $SitePOCName = '';
}

if($SiteAddress == ""){
  $SiteAddress = '';
}

if($SitePOCEmail == ""){
  $SitePOCEmail = '';
}
if($SitePOCContact == ""){
  $SitePOCContact = '';
}

if($HelpdeskComplaintNumber == ""){
  $HelpdeskComplaintNumber = '';
}
if($ReportedBy == ""){
  $ReportedBy = '';
}
if($AttendedDate == ""){
  $AttendedDate = '';
}
if($CreatedDate == ""){
  $CreatedDate = '';
}
if($NatureOfCall == ""){
  $NatureOfCall = '';
}

if($ProblemReportedByClient == ""){
  $ProblemReportedByClient = '';
}
else
{
    $ProblemReportedByClient = nl2br($ProblemReportedByClient);
}
if($JLLObservation == ""){
  $JLLObservation = '';
}
else
{
    $JLLObservation = nl2br($JLLObservation);
}
if($ActionTaken == ""){
  $ActionTaken = '';
}
else
{
    $ActionTaken = nl2br($ActionTaken);
}

if($ChannelPartner == ""){
  $ChannelPartner = '';
}

if($Remarks == ""){
  $Remarks = '';
}
else
{
    $Remarks = nl2br($Remarks);
}
if($ClientRepresentative == ""){
    $ClientRepresentative = '';
}

if($ClientRepresentativeDesignation == ""){
  $ClientRepresentativeDesignation = '';
}
if($ClientRepresentativeContact == ""){
    $ClientRepresentativeContact = '';
  }

if($TechnicianName == ""){
    $TechnicianName = '';
}

if($TechnicianPhoneNumber == ""){
    $TechnicianPhoneNumber = '';
}

if($ClientSignature == ""){
    $ClientSignature = '';
}else{
    $ClientSignature = '<div style="width:100px; height:200px;" class="client_signature">
    <img style="width:100px;" src="./media/signature/'.$ClientSignature.'">
   </div>';
}

if($Status == ""){
    $Status = '';
}

if($NatureOfCall == ""){
    $NatureOfCall = '';
}

$image_td = array();

foreach ($report_images as $report_image) 
{
    $image_td[] = '<td style="width:25%; padding:20px">
                    <div style="width:200px; height:200px;" class="product_attachment">
                        <img style="width:200px;"  class="mt-3"
                            src="./media/service_image/'.$report_image.'" alt="">
                    </div>
                </td>';
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
            padding-bottom:50px;
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
            padding:20px;
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

        .client_signature{
            width:100px;

        }
        .client_signature img{
            width:100%;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="pdf_header">
           <img src="./media/pdf-assets/report_header4.png">
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
                                <td style="width:40%;">'.$SiteName.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Address</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$SiteAddress.'</td>
                            </tr>
                           
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Mobile No.</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$SitePOCContact.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Reported by</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$ReportCreatedByName.'</td>
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
                                <td style="width:40%;">'.$HelpdeskComplaintNumber.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Service Type</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">General Service Report</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Ticket Status</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$Status.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"> Complaint Registered</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">N/A</td>
                            </tr>
                            
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Attended Date</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$AttendedDate.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold">Completed Date</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$CompletedDate.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"> Channel Partner Name</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$ChannelPartner.'</td>
                            </tr>
                            <tr>
                                <td style="width:50%;" class="costumer_detail_bold"> Nature Of Call</td>
                                <td style="width:10%;">:</td>
                                <td style="width:40%;">'.$NatureOfCall.'</td>
                            </tr>
                            
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30"> Problem Statement: </td>
                    
                </tr>
                <tr class="other_feedback_inside">
                  <td> '.$ProblemReportedByClient.' </td>
                </tr>
            </table>
        </div>
        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30">  Observation: </td>
                    <tr class="other_feedback_inside">
                      <td> '.$JLLObservation.'</td>
                    </tr>
                </tr>
            </table>
        </div>
        <div >
            <table class="other_feedback" style="padding-bottom:130px;">
                <tr>
                    <td class="width_30"> Action Taken: </td>
                </tr>
                <tr class="other_feedback_inside">
                  <td> '.$ActionTaken.'</td>
                </tr>
            </table>
        </div>

        <div >
            <table class="other_feedback">
                <tr>
                    <td class="width_30"> Remark: </td>
                </tr>
                <tr class="other_feedback_inside">
                  <td> '.$Remarks.' </td>
                </tr>
            </table>
        </div>
        <div class="attacment">
            Attachments
        </div>
        <div class="product_attachment_box">
            <table>
              <tr>
                '.implode("", $image_td).'
              </tr>

            </table>
        </div>
        <table class="bottom_signature_table" style="border-bottom:none;">
            <tbody>
                <tr>
                    <td class="bottom_table_bold" colspan="2">JLL MES Technician</td>
                </tr>
                <tr>
                    <td class="tech_bottom_table_bold"><span class="tech_value">Name:</span> <span>'.$TechnicianName.'</span></td>
                    <td class="tech_bottom_table_bold"><span class="tech_value">Phone Number:</span> <span>'.$TechnicianPhoneNumber.'</span></td>
                </tr>
            </tbody>
        </table>
        <table class="bottom_signature_table" style="border-top:none;">
            <tbody>
                <tr>
                    <td class="bottom_table_bold" colspan="3">Onsite Client Representative Name (Verified By)</td>
                </tr>
                <tr>
                    <td class="bottom_table_bold">Name:</td>
                    <td class="bottom_table_bold">Designation:</td>
                    <td class="bottom_table_bold">Signature:</td>
                    
                </tr>
                <tr>
                    <td style="padding:20px; 10px">'.$ClientRepresentative.'<br>'.$ClientRepresentativeContact.'</td>
                    <td style="padding:20px; 10px">'.$ClientRepresentativeDesignation.'</td>
                    <td style="padding:20px; 10px">'.$ClientSignature.'</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';
$mpdf->WriteHTML("");
$mpdf->WriteHTML($html);
$pdf_name = "$ReportID-service-report.pdf";
$pdfFilePath = 'service-report-pdf/'.$pdf_name.'';
$mpdf->Output($pdfFilePath, 'F');

// $mpdf->Output();
// echo $html;
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
// $pdf_name = "$ID-service-report.pdf";
// file_put_contents('service-roport-pdf/'.$pdf_name.'',$pdf);


// send curlrequest 
$mail_data['action'] = "General Service Report";
$mail_data['SiteName'] = $SiteName;
$mail_data['POCEmail'] = $SitePOCEmail;
$mail_data['ClientRepresentativeEmails'] = $ClientRepresentativeEmails;
$mail_data['ZoneEmail'] = $ZoneEmail;
$mail_data['POCName'] = $SitePOCName;
$mail_data['ReportID'] = $ReportID;
$mail_data['FilePath'] = $pdf_name;
$mail_data['Helpdesk_ComplaintNumber'] = $HelpdeskComplaintNumber;

$url = "https://jll.digitalworkdesk.com/jll-management/api/send-email-api.php";
$core->sendMailRequest($mail_data,$url);

// update database 

$update_sql = " ReportPath = '$pdf_name' where ID = $ReportID";
$response = $core->_UpdateTableRecords($conn,'service_reports',$update_sql);
//echo '<iframe src="data:application/pdf;base64,'.base64_encode($pdf).'" width="100%" height="600px"></iframe>';
?>