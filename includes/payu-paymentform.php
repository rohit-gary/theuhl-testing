  <!-- ------------pay u form ------ -->
    <form action="" id="payment_form" method="post" style="display: none;">
            
            <!-- Contains information of integration type. Consult to PayU for more details.//-->
            <input type="hidden" id="udf5" name="udf5" value="PayUBiz_PHP7_Kit" />
             <input type="hidden" id="udf1" name="udf1" value="<?php echo $policyNumber; ?>" /> 
              <input type="hidden" id="udf2" name="udf2" value=" " />                   
    
            <div class="dv">
                <span class="text"><label>Transaction/Order ID:</label></span>
                <span>
                <!-- Required - Unique transaction id or order id to identify and match 
                payment with local invoicing. Datatype is Varchar with a limit of 25 char. //-->
                <input type="text" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
            </div>
        
            <div class="dv">
                <span class="text"><label>Amount:</label></span>
                <span>
                
                <input type="text" id="amount" name="amount" placeholder="Amount" value="<?php echo $total_amount ?>" /></span>    
            </div>
    
            <div class="dv">   
                <span>
                <input type="hidden" id="productinfo" name="productinfo" placeholder="Product Info" value="P01,P02" /></span>
            </div>
    
            <div class="dv">
                <span class="text"><label>First Name:</label></span>
                <span>
                <input type="text" id="firstname" name="firstname" placeholder="First Name" value="<?php echo $UserName; ?>" /></span>
            </div>
        
            <div class="dv"> 
            <span>
                <input type="hidden" id="Lastname" name="Lastname" placeholder="Last Name" value="" /></span>
            </div>
    
            <div class="dv">
                <span>
                
                <input type="hidden" id="Zipcode" name="Zipcode" placeholder="Zip Code" value="" /></span>
            </div>
    
            <div class="dv">
                <span class="text"><label>Email ID:</label></span>
                <span>
                <!-- Required - An email id in valid email format has to be posted. Datatype is Varchar with 50 char limit. //-->
                <input type="text" id="email" name="email" placeholder="Email ID" value="<?php echo $Email; ?>" /></span>
            </div>
    
            <div class="dv">
                <span class="text"><label>Mobile/Cell Number:</label></span>
                <span>
                <!-- Required - Datatype is Varchar with 50 char limit and must contain chars 0 to 9 only. 
                This parameter may be used for land line or mobile number as per requirement of the application. //-->
                <input type="text" id="phone" name="phone" placeholder="Mobile/Cell Number" value="<?php echo $MobileNumber; ?>" /></span>
            </div>
    
            <div class="dv">
                
                <span>                  
                <input type="hidden" id="address1" name="address1" placeholder="Address1" value="" /></span>
            </div>
    
            <div class="dv">
               
                <span>                      
                <input type="hidden" id="address2" name="address2" placeholder="Address2" value="" /></span>
            </div>
    
            <div class="dv">
               
                <span>                      
                <input type="hidden" id="city" name="city" placeholder="City" value="" /></span>
            </div>
    
            <div class="dv">
        
                <span><input type="hidden" id="state" name="state" placeholder="State" value="" /></span>
            </div>
    
            <div class="dv">
                
                <span><input type="hidden" id="country" name="country" placeholder="Country" value="" /></span>
            </div>
    
            <div class="dv">
               
                <span>
                <!-- Not mandatory but fixed code can be passed to Payment Gateway to show default payment 
                option tab. e.g. NB, CC, DC, CASH, EMI. Refer PDF for more details. //-->
                <input type="hidden" id="Pg" name="Pg" placeholder="PG" value=" " /></span>
            </div>
    
            <div><input type="hidden" id="btnsubmit" name="btnsubmit" value="Pay" onclick="frmsubmit(); return true;" /></div>
            </form>

            <?php if($html) echo $html; //submit request to PayUBiz  ?>