<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$mpdf = new \Mpdf\Mpdf();
$logs = new Logs();
$logs->SetCurrentMailLogFile();
$logs->WriteLog($data_raw,__FILE__,__LINE__);
$core = new Core();
$mpdf->SetWatermarkImage('../project-assets/images/singlelogo.png',  0.1, 0.3);
$mpdf->showWatermarkImage = true;
$encrypt = new Encryption();
$customerId = $data['policyNumber'];
if(isset($customerId)){
    $PolicyCustomer = new PolicyCustomer($conn);
    $Plan=new Plans($conn);

      $PolicyCustomer_detailss=$PolicyCustomer->getPolicyCustomerDetailsByPolicyNumber($customerId);
      
      $PolicyCustomer_details=$PolicyCustomer_detailss;

        // print_r($PolicyCustomer_details);
    

      // $PolicyCustomer_Member_detailss=$PolicyCustomer->getPolicyCustomerMemberDetailsByPolicyID($customerId);
      $PolicyCustomer_Member_detailss=$PolicyCustomer->getPolicyCustomerMemberDetailsByPolicyNumber($customerId);
       // print_r($PolicyCustomer_Member_detailss);
     

         $AllPlan=$PolicyCustomer->getAllPolicyIDByPolicyNumber($customerId);
         // print_r($AllPlan);
        // die();
         // $PolicyPlanID= $PolicyCustomer_details['PlanID'];
      // $CustomerPlanDetailss=$Plan->GetPlanDetailsbyID($PolicyPlanID);
        
      // $CustomerPlanDetails=$CustomerPlanDetailss[0];
      $planDurationMonths = '12';//$CustomerPlanDetails['PlanDuration']

      // print_r($CustomerPlanDetails);
      // die();


       $createdDate = $PolicyCustomer_details['CreatedDate'];

    // Create a DateTime object from the 'yyyy-mm-dd' format
      $dateObj = DateTime::createFromFormat('Y-m-d', $createdDate);

    // Format the date to 'dd-mmm-yyyy' (e.g., 02 March 2024)
      $formattedDate = $dateObj->format('d F Y');
    // Add the Plan Duration (in months) to the Created Date to calculate the expiry date
    $expiryDateObj = clone $dateObj;  // Clone the original DateTime object to preserve it
    $expiryDateObj->add(new DateInterval('P' . $planDurationMonths . 'M'));  // Add PlanDurationMonths
     $expiryFormattedDate = $expiryDateObj->format('d F Y');

       $state_obj = new State($conn);
       $StateDetailss = $state_obj->GetStateNameByID($PolicyCustomer_details["State"]);
       $StateDetails = $StateDetailss[0];

} 



$familyRows = '';
$totalMembers = count($PolicyCustomer_Member_detailss);

$logo = '../project-assets/images/uhlnewlogo.png';
$signature = '../project-assets/images/uhldocsignwhite.png';


$formattedAddress = wordwrap($PolicyCustomer_details['Address'], 30, "<br>\n");


$footer_div='<div style="background-color:transparent; color:#000" ><p style="item-align:justify">
Web - www.unitedhealthlumina.com Email - support@unitedhealthlumina.com Contact support - +911206053551 , You can also visit our website for policy and claim related information and services.</p></div>';



$mpdf->SetFooter($footer_div);
// Start the HTML content
$html = '
<style>
    body {
        font-family: Arial, sans-serif;

    }
    
    .recipient-details, .content, .footer {
        margin-top: 20px;
    }
    .recipient-details p {
        margin: 0px 0;
        font-size: 9px;
        font-weight: bold;
    }
    .content p {
        font-size: 10px;
    }
    .date {
        text-align: right;
        font-size: 12px;
    }
    .footer {
        margin-top: 40px;
    }
    .footer p {
        font-size: 12px;
    }
    .footer img{
        width:10px;
    }

    .table-container {
        margin: 20px;
    }
     table {
        width: 100%;
        border-collapse: collapse;
        font-size: 8px;
    }
  .table-container  th, td {
        
        padding: 4px;
        text-align: left;
    }
  .table-container  th {
        background-color: #f0f0f0;
    }
    .center {
        text-align: center;
    }
    .right {
        text-align: right;
    }
    .colspan {
        colspan: 2;
    }
.footer-content table, .footer-content th, .footer-content td {
    border: none !important;
}

   .company-info {
        text-align: right;
        font-size: 10px;
        line-height: 1;
    }
    .company-info h1 {
        font-size: 11px;
        margin: 0;
        color: #000;
    }
    .company-info p {
        margin: 3px 0;
        color: #000;
    }
    .company-info a {
        color: #0066cc;
        text-decoration: none;
    }
    .company-info a:hover {
        text-decoration: underline;
    }

    ul {
    list-style-type: disc; /* Removes default bullet points */
    padding-left: 10; /* Removes left padding */
    margin: 0; /* Removes margin */
    font-size: 10px; /* Set font size to 10px */
    line-height: 1; /* Adds some spacing between list items */
}

ul li {
    margin-bottom: 5px; /* Adds spacing between items */
    font-family: Arial, sans-serif; /* Set a clean, professional font */
}
.feature{
list-style-type: none; /* Removes default bullet points */
    padding-left: 0; /* Removes left padding */
    margin: 0; /* Removes margin */
    font-size: 10px; /* Set font size to 10px */
    line-height: 1; /* Adds some spacing between list items */
}
    .no-break {
        page-break-inside: avoid;
        break-inside: avoid;
    };
</style>

<div class="header">
 <img src="' . $logo . '" alt="United Health Lumina" style="width: auto; height: 50px; margin-top: -20px;">

 <div class="company-info">
        <h1>United Health Lumina Private Limited</h1>
        <p>B403 FLOOR 4, NA TOWER NX ONE COMMERCIAL<br>
        SECTOR 1, GAUTAM BUDH NAGAR,  Utter Pradesh, INDIA ,201306</p>
        <p>CIN: U63999UP2024PTC210915</p>
        <p><a href="https://www.unitedhealthlumina.com" target="_blank">www.unitedhealthlumina.com</a></p>
        <p><a href="mailto:support@unitedhealthlumina.com">support@unitedhealthlumina.com</a></p>

    </div>
    
</div>

<div class="recipient-details">
    <p>Mr.'.$PolicyCustomer_details['UserName'].'</p>
    <p id="address">'.$formattedAddress.'</p>
    
     <p>'.$StateDetails["StateName"].'  &nbsp;  '.$PolicyCustomer_details['PinCode'].'</p>
    <p>Mobile. '.$PolicyCustomer_details['MobileNumber'].'</p>
    <p>Email. '.$PolicyCustomer_details['Email'].'</p>
</div>

<div class="content no-break">
   
    <p>Dear Sir/Madam,</p>
    <p>
       We Welcome you to the United Health Lumina family.<br>
    
       Thank you for placing your valuable trust on us. We are committed to providing all UHL services needs for you and your family.<br>
    
    This is to certify that <b>'.$PolicyCustomer_details['UserName'].'</b> paid RS '.$PolicyCustomer_details['TotalAmount'].'.00 towards <b>'.$PolicyCustomer_details['PlanNames'].'</b> on ' .$formattedDate.' Valid till '. $expiryFormattedDate.'.</p>';
   
         foreach ($AllPlan as $Policy) {
    $PolicyPlanID = $Policy['PlanID']; // Get the PlanID from the policy
    // Get the customer plan details by PlanID
    $CustomerPlanDetailss = $Plan->GetPlanDetailsbyID($PolicyPlanID);

    // Check if $CustomerPlanDetailss is not empty
    if (!empty($CustomerPlanDetailss)) {
        foreach ($CustomerPlanDetailss as $CustomerPlan) {
            // Check if the current plan has PlanHighlights
            if (!empty($CustomerPlan['PlanHighlights'])) {
                // Preprocess PlanHighlights to extract individual highlights
                $highlightsString = strip_tags($CustomerPlan['PlanHighlights']); // Remove HTML tags

                // Use regex to extract quoted highlights
                preg_match_all('/"(.*?)"/', $highlightsString, $matches);

                // If matches are found, process them
                $highlights = !empty($matches[1]) ? array_map('trim', $matches[1]) : [];
            } else {
                // If no PlanHighlights found, set an empty highlights array
                $highlights = [];
            }

            // Generate HTML content for the highlights
            if (!empty($highlights)) {
                $html .= '<p>Following are some salient (Reimbursement UHL COIN) features of your ' . htmlspecialchars($CustomerPlan['PlanName']) . ' subscription plan:</p><ul>';
                foreach ($highlights as $highlight) {
                    $html .= '<li>' . htmlspecialchars($highlight) . '</li>'; // Display each highlight
                }
                $html .= '</ul>';
            } else {
                $html .= '<p>No plan highlights are available at the moment.</p>';
            }
        }
    } else {
        $html .= '<p>No plan details found.</p>';
    }
}

$html .= '
<ul class="feature">
<li><b>Vitamin B12 Cyanocobalamin </b> (Weakness & Brain Health)</li>
    <li><b>Vitamin D3 Total 25-Hydroxy </b> (Bone Health, Immunity & Tiredness)</li>
    <li><b>Iron Profile – Anaemia </b>(Hair, Skin & Anxiety)</li>
    <li><b>HbA1c (Glycated hemoglobin)</b> (Higher HbA1c, Greater diabetes complications)</li>
    <li><b>Thyroid Profile - T3 T4 TSH </b>(Weight Gain/Loss, Mood Swings)</li>
    <li><b>Lipid/Cholesterol Profile <b>(Heart health, Arteries Clogging/Hardening)</li>
    <li><b>LFT - Liver Function Tests with GGT</b> (Jaundice, Weight Loss, Abdominal Pain, Nausea)</li>
    <li><b>KFT - Kidney Function Tests – RFT</b> (Kidney Diseases, Frequent Urination)</li>
    <li><b>CBC - Complete Haemogram </b>(Blood Cancer, Infection, Hb & Anaemia)</li>
    <li><b>Electrolytes Profile </b>(Muscle Cramps, Electrolytes Imbalance)</li>
    <li><b>Calcium, Phosphorus & ALP </b>(Healthy Bones & Teeth Profile)</li>
    <li><b>ESR, Uric Acid and Protein </b>(Inflammation, Joint Pain or Swelling)</li>
    <li><b>FBS - Blood Glucose, Urine Glucose </b>(Diabetic Screen)</li>
    <li><b>Urine R/M (Urine R/E) </b>(Detects UTI, Pus Cells, and Bacteria)</li>
</ul>
</p>

  <p>
    This Subscription Kit contains all the details about your health plan benefits, its OPD coverage, terms and conditions, information required for claims, health services etc. We request you to please check the Subscription Kit including name, address, date of birth, contact details chosen area, health plan benefits etc., to ensure completeness and accuracy. In case of any discrepancy or free-look cancellation, we request you to please call our number <a href="tel:+1206053551">1206053551</a> or email us at <a href="mailto:support@unitedhealthlumina.com">support@unitedhealthlumina.com</a>. The Free-Look Request is available on our numbers <a href="https://www.unitedhealthlumina.com" target="_blank">www.unitedhealthlumina.com</a>. You can also visit our website for policy and claim related information and services.
    If you do not report any discrepancy to us within 15 days of receiving this document, we will assume that the Subscription Kit issued is correct and as per your offer. You will also find the UHL QR code of our Mobile App in this Subscription Kit.
</p>
<p>
    You are requested to download this app which will help you access various health plan services on the go. Welcome once again to United Health Lumina and thank you for choosing us as your health support partner.
</p>

<p>Best Regards,</p>
<p>For United Health Lumina Private Limited</p>



<!-- Signature shown here just before the authorized signatory text -->
<div class="no-break">
<img src="' . $signature . '" alt="Signature" style="width:100px; height:30px"></div>
<p style="font-size:10px">Authorized Signatory for</p>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addressElement = document.getElementById("address");
        
        // Split the text by spaces and add line breaks every 5 words
        const words = addressElement.innerHTML.split(" ");
        let formattedText = "";
        
        words.forEach((word, index) => {
            // Add the word to the formatted text
            formattedText += word + " ";
            
            // Every 5th word, add a line break
            if ((index + 1) % 5 === 0) {
                formattedText += "<br>";
            }
        });
        
        addressElement.innerHTML = formattedText.trim(); // Update the HTML with line breaks
    });
</script>
';





$html4 = '
<table style="width: 100%;  border-collapse: collapse; font-size: 10px; margin-bottom: 20px;">
    <tr>
        <th style=" padding: 8px; background-color: transparent; text-align: left; width: 30%;">Subscriber Detail</th>
        <th style=" padding: 8px; background-color: transparent; text-align: left; width: 70%;"></th>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Purchased By</td>
        <td style=" padding: 8px;">'.$PolicyCustomer_details['UserName'].'</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Plan Name</td>
        <td style=" padding: 8px;">'.$PolicyCustomer_details['PlanNames'].'</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Policy Number</td>
        <td style=" padding: 8px;">'.$PolicyCustomer_details['PolicyNumber'].'</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Date of Purchase</td>
        <td style=" padding: 8px;">'.$formattedDate.'</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Expiry Date</td>
        <td style=" padding: 8px;">'.$expiryFormattedDate.'</td>
    </tr>
</table>

<table style="width: 100%;  border-collapse: collapse; font-size: 10px; margin-bottom: 20px;">
    <tr>
        <th style=" padding: 8px; background-color: transparent; text-align: left; width: 30%;">Member Detail</th>
        <th style=" padding: 8px; background-color: transparent; text-align: left; width: 70%;"></th>
    </tr>';

// Loop through PolicyCustomer_Member_detailss array and populate the member details

     foreach ($AllPlan as $Policy) {
    $PolicyPlanID = $Policy['PlanID'];
    $CustomerPlanDetailss = $Plan->GetPlanDetailsbyID($PolicyPlanID);
    
    // print_r($CustomerPlanDetailss);
    // Check if $CustomerPlanDetailss is not empty
    if (!empty($CustomerPlanDetailss)) {
    $PolicyCustomer_Member_detailss=$PolicyCustomer->getPolicyCustomerMemberDetails($customerId, $PolicyPlanID);
    $html4 .= '<h3>Members of ' . htmlspecialchars($CustomerPlanDetailss[0]['PlanName']) . '</h3>';
     foreach ($PolicyCustomer_Member_detailss as $index => $member) {
    $dateOfBirth = DateTime::createFromFormat('Y-m-d', $member['DateOfBirth'])->format('d-m-Y');
    $html4 .= '
    <tr>
        <th colspan="2" style=" padding: 8px; background-color: transparent; text-align: left;">Member ' . ($index + 1) . ' '.$CustomerPlanDetailss[0]['PlanName'].'</th>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Member Name</td>
        <td style=" padding: 8px;">' . $member['Name'] . '</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Date of Birth</td>
        <td style=" padding: 8px;">' . $dateOfBirth . '</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Gender</td>
        <td style=" padding: 8px;">' . ucfirst($member['Gender']) . '</td>
    </tr>
    <tr>
        <td style=" padding: 8px; background-color: transparent;">Relationship</td>
        <td style=" padding: 8px;">' . $member['Relationship'] . '</td>
    </tr>';

    // Check if Email field exists
    if (isset($member['Email'])) {
        $html4 .= '
        <tr>
            <td style=" padding: 8px; background-color: #f9f9f9;">Email Id</td>
            <td style=" padding: 8px;">' . $member['Email'] . '</td>
        </tr>';
    }
}
}
}

$html4 .= '</table>';
if (isset($PolicyCustomer_details['TotalAmount']) && is_numeric($PolicyCustomer_details['TotalAmount'])) {
    // Assume $CustomerPlanDetails['PlanCost'] is the gross premium
    $grossPremium = $PolicyCustomer_details['TotalAmount'];

    // Calculate the base premium (amount without tax)
    $basePremium = $grossPremium / 1.18;

    // Calculate CGST and SGST (each is 9% of the base premium)
    $cgst = $basePremium * 0.09;
    $sgst = $basePremium * 0.09;

    // Format amounts to two decimal places
    $basePremiumFormatted = number_format($basePremium, 2);
    $cgstFormatted = number_format($cgst, 2);
    $sgstFormatted = number_format($sgst, 2);
    $grossPremiumFormatted = number_format($grossPremium, 2);

    // Generate the HTML table
    $html4 .= '
    <table style="width: 100%; border-collapse: collapse; font-size: 10px; margin-bottom: 20px;">
        <tr>
            <th style="padding: 8px; background-color: transparent; text-align: left; width: 70%;">Purchase Summary</th>
            <th style="padding: 8px; background-color: transparent; text-align: right; width: 30%;">Amount (INR)</th>
        </tr>
        <tr>
            <td style="padding: 8px; background-color: transparent;">Premium</td>
            <td style="padding: 8px; text-align: right; background-color: transparent;">' . $basePremiumFormatted . '</td>
        </tr>
        <tr>
            <td style="padding: 8px; background-color: transparent;">CGST @ 9%</td>
            <td style="padding: 8px; text-align: right; background-color: transparent;">' . $cgstFormatted . '</td>
        </tr>
        <tr>
            <td style="padding: 8px; background-color: transparent;">SGST/UTGST @ 9%</td>
            <td style="padding: 8px; text-align: right; background-color: transparent;">' . $sgstFormatted . '</td>
        </tr>
        <tr>
            <td style="padding: 8px; background-color: transparent; font-weight: bold;">Gross Premium</td>
            <td style="padding: 8px; text-align: right; background-color: transparent; font-weight: bold;">' . $grossPremiumFormatted . '</td>
        </tr>
    </table>';
} else {
    echo "Error: Invalid PlanCost.";
}

$mpdf->watermarkImageAlpha = 0.1; // Adjust opacity (0 to 1)
$mpdf->watermarkImgBehind = true; // Place the watermark behind the text
$mpdf->WriteHTML($html);
$mpdf->AddPage();
$mpdf->watermarkImageAlpha = 0.1; // Adjust opacity (0 to 1)
$mpdf->watermarkImgBehind = true;
$mpdf->WriteHTML($html4);




$pdf_name = $PolicyCustomer_details['PolicyNumber'] . '.pdf';

$pdfFilePath = 'service-report-pdf/'.$pdf_name.'';

$mpdf->Output($pdfFilePath, 'F');
$data['FilePath'] = $pdf_name;
$data['PlanNames']=$PolicyCustomer_details['PlanNames'];

 $policy = new PolicyCustomer($conn);
 $policy->sendEmail($data,$mpdf);
          
  $PaymentData= $policy->checkPaymentStatusByPolicyNumber($PolicyCustomer_details['PolicyNumber']);
  $paymentStatus = $PaymentData[0]['status'];
//  if($paymentStatus && $paymentStatus == 'Success') {

//         $plans = new Plans($conn);
//         $planDetails = $plans->GetPlanDetailsbyID($data['PlanID']); 
//         $planName = $planDetails[0]['PlanName'];
//         $message = 'Hello [Name], 👋

// Welcome to United Health Lumina! 🌟
// We are excited to have you onboard and to provide you with exceptional health care services.

// Here are your login details:
// 🔹 ID: Your registered email address: [Email]
// 🔹 Password: Your Date of Birth in the format: yyyy-mm-dd

// Plan Details:
// 📄 Plan Name: [Plan Name]
// 🔢 Policy Number: [Policy Number]
// 💰 Payment Amount: ₹ [Amount]

// ✨ Your selected plan, [Plan Name], comes with exclusive benefits designed to prioritize your health and well-being.

// If you have any questions or need assistance, please feel free to reach out to us via this WhatsApp number or our support team.

// We’re here to support you every step of the way.

// Warm Regards,
// Team United Health Lumina 🌐
// 🌟 "Your health, our priority."';

// // Replace placeholders with actual data
// $message = str_replace(
//     ['[Name]', '[Email]', '[Plan Name]', '[Policy Number]', '[Amount]'],
//     [
//         $data['name'],
//         $data['email'],
//         $planName,
//         $data['policyNumber'],
//         $data['amount']
//     ],
//     $message
// );

// // Output or send the message
//   // echo $message;

//  // $policy->sendWhatsAppMessage($data['phonenumber'],$message);
//  }

?>