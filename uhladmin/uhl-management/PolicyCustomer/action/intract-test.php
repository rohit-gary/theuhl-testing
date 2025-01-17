if($response['error']==false){
                    $cus_details= $PolicyCustomer->getPolicyCustomerDetailsByPolicyNumber($PolicyNumber);
                    $username='Testing';
                    $paymentlink = "https://unitedhealthlumina.com/pay-booking-amount-new?policyNumber=" . $encodedPolicyNumber;
                    $wdata['phonenumber'] = '8948975967';
                    $body_values = '["' . $username . '","' . $paymentlink . '"]';
                    $wdata['body_values'] = $body_values;
                    $wdata['template'] = "browse_catalog_on_whatsapp";
                    _interakt_sendWhatsAppMessage_common($wdata);
                    
                }