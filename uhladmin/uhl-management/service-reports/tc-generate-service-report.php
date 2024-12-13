<?php
require_once '../../vendor/autoload.php'; // Adjust the path as necessary

require_once('../api/common_api_header.php');
require_once('../include/autoloader.inc.php');
// this file will give client connection object $conn $_SESSION['OrgID'] must be set
require_once("../include/db-connection.php");

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
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 2px solid #000 !important;
            padding: 7px 15px;
        }

        table th {
            text-align: left;
            font-weight: bold;
        }

        table>tbody>tr>th {
            font-weight: 600;
            -webkit-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .container {
            margin-bottom: 5rem;
        }

        .header_box {
            display: flex;
            padding: 0px 14px 25px 14px;
            align-items: flex-end;
        }

        .logo {
            width: 164px;
        }

        .heading {
            text-align: center;
            font-size: 24px;
            width: 81%;
        }

        .heading h3 {
            margin: 0px;
        }

        table {
            border: 1px solid #000;
        }

        .company_details {
            padding: 14px 0;
            width: 50%;
        }

        .company_info {
            display: flex;
            align-items: center;
            padding: 4px 15px;
        }

        .problem_reported {
            display: flex;
            padding: 6px 10px 42px 10px;
            border: 2px solid #000;
        }

        .attacment {
            background: #e30613;
            border-right: 2px solid #000;
            border-left: 2px solid #000;
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 4px 10px;
        }

        .product_attachment_box {
            padding: 10px;
            border: 2px solid #000;
            // border-bottom:none;
        }
        .float-container {
            float: left;
            box-sizing: border-box; /* Include padding and border in width */
            margin: 0px;
        }
        .clear {
            clear: both; /* Clear floats */
            margin: 0px;
        }
        p{
          margin-top:0px;
          font-family: system-ui;
          font-size:0.9rem;
        } 
        body{
            font-family: system-ui;
        }
    </style>
</head>
<body>
    <div class="container mb-5">
        <div class="header_box">
            <div class="logo float-container">
                <img style="width: 100%;" src="./jll-mobile-logo.png" alt="">
            </div>
            <div class="heading float-container">
                <h3>Mobile Engineering Services</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div >
            <table class="table mb-0 float-container" style="background-color: #e30613; width:50%;">
                <tbody>
                    <tr>
                        <th>Customer Details</th>
                    </tr>
                </tbody>
            </table>
            <table class="table mb-0 float-container" style="background-color: #e30613; width:50%;">
                <tbody>
                    <tr>
                        <th>Service Ticket Details</th>
                    </tr>
                </tbody>
            </table>
            <div class="clear"></div>
        </div>
        <div style="border: 2px solid #000;  border-top: none;">
            <div class="company_details w-50 border-top-0 float-container" style="width:50%;">
                <table style="border:none !important; width:100%;" >
                    <tr style="border:none !important;">
                        <td style="padding-top:0px; padding-bottom:5px; border:none !important;"><p style="margin-bottom: 4px;font-size:1rem; font-weight:700">Name &nbsp; :</p></td>
                        <td style="padding-top:0px; padding-bottom:5px; border:none !important;"><p style="margin-bottom: 0px;">'.$SiteName.'</p></td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="padding-top:0px; padding-bottom:5px;border:none !important;"><p style="margin-bottom: 4px; font-size:1rem; font-weight:700">Address &nbsp; :</p></td>
                        <td style="padding-top:0px; padding-bottom:5px; border:none !important;"><p style="margin-bottom: 0px; text-wrap: balance;">'.$SiteAddress.'</p></td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style=" width:100px; padding-top:0px; padding-bottom:5px;border:none !important;"><p style="margin-bottom: 4px; font-size:1rem; font-weight:700">Email Id &nbsp; :</p></td>
                        <td style="padding-top:0px; padding-bottom:5px; border:none !important;"><p style="margin-bottom: 0px; text-wrap: balance;">'.$SitePOCEmail.'</p> </td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="padding-top:0px; padding-bottom:5px; width:70% !important; border:none !important;"><p style="margin-bottom: 4px; font-size:1rem; font-weight:700">Mobile No. &nbsp; :</p></td>
                        <td style="padding-top:0px; padding-bottom:5px; border:none !important;"><p style="margin-bottom: 0px;">'.$SitePOCContact.'</p></td>
                    </tr>
                </table>
                
            </div>
            <div class="company_details w-50 border-top-0 float-container" style="border-left: 2px solid #000;">
                <table style="border:none !important;">
                    <tr style="border:none !important;">
                        <td style="width:70%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Ticket/Complaint No  &nbsp; :</p></td>
                        <td style="width:30%; border:none !important;"> '.$HelpdeskComplaintNumber.'</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Ticket Status &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> Open</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Complaint Registered &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> N/A</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Reported By &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> '.$ReportedBy.'</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Attended Date &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> '.$AttendedDate.'</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Completed Date &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> '.$CreatedDate.'</td>
                    </tr>

                    <tr style="border:none !important;">
                        <td style="width:50%; border:none !important;"><p style="margin-bottom: 4px; width:100%; font-size:1rem; font-weight:700">Nature Of Call &nbsp; :</p></td>
                        <td style="width:50%; border:none !important;"> '.$NatureOfCall.'</td>
                    </tr>
                </table>

            </div>
            <div class="clear"></div>
        </div>
        <div >
                <div class="problem_reported border-top-0"
                    style="display: flex;  padding: 6px 10px 42px 10px;  border: 2px solid #000;     border-top: none;">
                    <span class="float-container"
                        style="display: block;   width: 31%;  font-size: 1rem;font-weight: 700; font-family: system-ui;  text-decoration: underline;">Problem
                        Reported by Client:</span>
                    <p class="float-container">'.$ProblemReportedByClient.'
                    </p>
                    <div class="clear"></div>
                </div>
        </div>
        <div >
            <div class="problem_reported border-top-0"
                style="display: flex;  padding: 6px 10px 42px 10px;  border: 2px solid #000;     border-top: none;">
                <span class="float-container"
                    style="display: block;   width: 31%;  font-size: 1rem;font-weight: 700; font-family: system-ui;  text-decoration: underline;">JLL
                    Observation:</span>
                <p class="float-container">'.$JLLObservation.'
                </p>
                <div class="clear"></div>
            </div>
        </div>
        <div >
                <div class="problem_reported border-top-0"
                    style="display: flex;  padding: 6px 10px 42px 10px;  border: 2px solid #000;     border-top: none;">
                    <span class="float-container"
                        style="display: block;   width: 31%;  font-size: 1rem;font-weight: 700; font-family: system-ui;  text-decoration: underline;">Action
                        Taken:</span>
                    <p class="float-container">'.$ActionTaken.'
                    </p>
                    <div class="clear"></div>
                </div>
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
        <table class="table mb-0" style="border-bottom: none;">
            <tbody>
                <tr>
                    <th colspan="2">JLL MES Technician (Job Done By)</th>
                    <th>Signature</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Name</th>
                    <td></td>
                </tr>
                <tr>
                    <th>2</th>
                    <th>Address</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <table class="table mb-0">
            <tbody>
                <tr>
                    <th colspan="2">Onsite Client Representative Name (Verified By)</th>
                    <th>Signature</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>Name</th>
                    <td></td>
                </tr>
                <tr>
                    <th>2</th>
                    <th>Address</th>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>';

// Create new PDF instance
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Set document information
$pdf->SetCreator('TCPDF');
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('HTML to PDF Conversion');
$pdf->SetSubject('Converting HTML to PDF');
$pdf->SetKeywords('HTML, PDF, TCPDF');

// Add a page
$pdf->AddPage();


// Convert HTML to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output PDF to browser
$pdf->Output('output.pdf', 'I'); // 'I' parameter sends the PDF to the browser. 'D' to download, 'F' to save to file.

exit;
?>