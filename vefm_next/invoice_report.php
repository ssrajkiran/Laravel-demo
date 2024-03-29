<?php
//error_reporting(0);

//include_once("../../../../php/includes/dbconnection.php");
include_once("dbconnection.php");

//SESSION START
session_start();

//MYSQL CONNECTION
$dbcon = GetDbcon();

if (isset($_POST['action']) AND ! empty($_POST['action']) AND ($_POST['action'] == 'invoice_report')) {

    $fromdate = date('Y-m-d', strtotime($_POST['fromdate']));
    $todate = date('Y-m-d', strtotime($_POST['todate']));
    ?>
    <style>
        .search-table {
            overflow-x: scroll; 
        }
    </style>
    <div class="search-table">
        <table id="example1" name="collection_tbl" class="table table-striped table-bordered" width="100%">
            <thead>
                <tr>
                    <th>SI</th>								
                    <th>Division</th>
                    <th>Unit</th>
                    <th>Country</th>
					<th>Currency</th>
					<th>Conversion Rate</th>
					 <th>Client Name</th>
                   
                    <th>Job No</th>
					<th>Invoice No</th>
                    <th>Invoice Date</th>
                   
					 
                    <th>Invoice Type</th>
					 <th>Invoice Amt</th>
                    
                    <th>Total Service charge</th>
                    <th>VAT</th>
                    <th>GST</th>           
                    <th>Retention</th>
                     <th>Advance</th>
                      <th>Discount</th>					
                    
                </tr>
            </thead>
            <colgroup>
                <col style="width: 3%;">
                <col style="width: 5%;">
                <col style="width: 7%;">
                <col style="width: 10%;">
              
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 30%;">
                <col style="width: 25%;">
                <col style="width: 30%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
				<col style="width: 10%;">
				<col style="width: 10%;">
              
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                <col style="width: 10%;">
                
            </colgroup>
            <?php
			$where_cust = '';
			if(isset($_POST['clientname_new']) && !empty($_POST['clientname_new'])){
				$where_cust = " and D.company ='" . $_POST['clientname_new'] . "'";
			}
            $i = 1;
            if ($_POST['reg']) {
                $sql_res = mysqli_query($dbcon,"SELECT D.invoice_type,D.invoice_number,D.invoice_date, D.invoice_amount,F.division_name,D.service_charge,D.vat_amount,D.retention_amount,D.advance_amount,D.discount_amount,D.currency,D.conversion_rate,D.gst_amount,D.job_number,B.company_name,G.unit_name,H.country FROM customer_master AS B JOIN invoice AS D JOIN division AS F JOIN unit AS G JOIN country AS H
				ON (D.company = B.id) 
				AND (D.division = F.id) AND (D.unit = G.id) AND (D.country = H.id) AND (D.invoice_date BETWEEN '" . $fromdate . "' AND '" . $todate . "') and D.country ='" . $_POST['reg'] . "' $where_cust ORDER BY D.invoice_date");
           
		   } else if ($_POST['unit']) {
               $sql_res = mysqli_query($dbcon,"SELECT D.invoice_type,D.invoice_number,D.invoice_date, D.invoice_amount,F.division_name,D.service_charge,D.vat_amount,D.retention_amount,D.advance_amount,D.discount_amount,D.currency,D.conversion_rate,D.gst_amount,D.job_number,B.company_name,G.unit_name,H.country FROM customer_master AS B JOIN invoice AS D JOIN division AS F JOIN unit AS G JOIN country AS H
				ON (D.company = B.id) 
				AND (D.division = F.id) AND (D.unit = G.id) AND (D.country = H.id) AND (D.invoice_date BETWEEN '" . $fromdate . "' AND '" . $todate . "') and D.country ='" . $_POST['unit'] . "' $where_cust ORDER BY D.invoice_date");
           
			} else if ($_POST['division'] == "AD") {
              
		   $sql_res = mysqli_query($dbcon,"SELECT D.invoice_type,D.invoice_number,D.invoice_date, D.invoice_amount,F.division_name,D.service_charge,D.vat_amount,D.retention_amount,D.advance_amount,D.discount_amount,D.currency,D.conversion_rate,D.gst_amount,D.job_number,B.company_name,G.unit_name,H.country FROM customer_master AS B JOIN invoice AS D JOIN division AS F JOIN unit AS G JOIN country AS H
				ON (D.company = B.id) 
				AND (D.division = F.id) AND (D.unit = G.id) AND (D.country = H.id) AND (D.invoice_date BETWEEN '" . $fromdate . "' AND '" . $todate . "') $where_cust ORDER BY D.invoice_date");
           
			} else if ($_POST['division']) {
				
				
					 $sql_res = mysqli_query($dbcon,"SELECT D.invoice_type,D.invoice_number,D.invoice_date, D.invoice_amount,F.division_name,D.service_charge,D.vat_amount,D.retention_amount,D.advance_amount,D.discount_amount,D.currency,D.conversion_rate,D.gst_amount,D.job_number,B.company_name,G.unit_name,H.country FROM customer_master AS B JOIN invoice AS D JOIN division AS F JOIN unit AS G JOIN country AS H
				ON (D.company = B.id) 
				AND (D.division = F.id) AND (D.unit = G.id) AND (D.country = H.id) AND (D.invoice_date BETWEEN '" . $fromdate . "' AND '" . $todate . "') and D.country ='" . $_POST['division'] . "' $where_cust ORDER BY D.invoice_date");
           
				
			}
            if (!$sql_res) {
                echo mysqli_error();
            }

            if ($_POST['division'] == "AD") {
                echo "<h6> Invoice Register Report For ALL-Division from " . $_POST['fromdate'] . " to " . $_POST['todate'] . "</h6>";
            } else {
                $divqry = mysqli_query($dbcon,"select * from division where id='" . $_POST['division'] . "'");
                $divrow = mysqli_fetch_array($divqry);
                echo "<h6> Invoice Register Report For " . $divrow['division_name'] . " from " . $_POST['fromdate'] . " to " . $_POST['todate'] . "</h6>";
            }

           
           
            while ($row = mysqli_fetch_array($sql_res)) {
				
                if ($row['invoice_date'] != '0000-00-00') {
                    $invdate = date('d-m-Y', strtotime($row['invoice_date']));
                } else {
                    $invdate = '';
                }

               echo '<tr>';
                echo '<td>' . $i . '</td>';
                echo '<td>' . $row['division_name'] . '</td>';
                echo '<td>' . $row['unit_name'] . '</td>';
                echo '<td>' . $row['country'] . '</td>';
              
                echo '<td>' . $row['currency'] . '</td>';
                echo '<td>' . $row['conversion_rate'] . '</td>';
				#echo $row['invoice_no'].'count: '.count($check_invoice[$row['invoice_no']]);
				 echo '<td>' . $row['company_name'] . '</td>';
				  echo '<td>' . $row['job_number'] . '</td>';
				   echo '<td>' . $row['invoice_number'] . '</td>';
				    echo '<td>' . $invdate . '</td>';
					 echo '<td>' . $row['invoice_type'] . '</td>';
				
				if($row['invoice_amount']){
					$invoice_total_repeat	=	$row['invoice_amount'];
					echo '<td style="text-align:right">' . number_format($row['invoice_amount'], 2, '.', '') . '</td>';
				}else{
					$invoice_total_repeat = 0;
					
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				
				
				if($row['service_charge']){
					$sc = $row['service_charge'];
					echo '<td style="text-align:right">' . number_format($row['service_charge'], 2, '.', '') . '</td>';
				}else{
					$sc = 0;
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				
				
				if($row['vat_amount']){
					$vat = $row['vat_amount'];
					
					echo '<td style="text-align:right">' . number_format($row['vat_amount'], 2, '.', '') . '</td>';
				}else{
					$vat = 0;
					
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				
				
				if($row['gst_amount']){
					$gst = $row['gst_amount'];
					
					echo '<td style="text-align:right">' . number_format($row['gst_amount'], 2, '.', '') . '</td>';
				}else{
					$gst = 0;
					
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				
				
				if($row['retention_amount']){
					$retension = $row['retention_amount'];
					echo '<td style="text-align:right">' . number_format($row['retention_amount'], 2, '.', '') . '</td>';
				}else{
					$retension = 0;
					
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
              
			  if($row['advance_amount']){
				  $advance = $row['advance_amount'];
					
					echo '<td style="text-align:right">' . number_format($row['advance_amount'], 2, '.', '') . '</td>';
				}else{
					 $advance = 0;
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				if($row['discount_amount']){
					$discount = $row['discount_amount'];
					
					echo '<td style="text-align:right">' . number_format($row['discount_amount'], 2, '.', '') . '</td>';
				}else{
					$discount=0;
					echo '<td style="text-align:right">' . number_format(0, 2, '.', '') . '</td>';
				}
				
				
								
             
                
				
				$grantinvoice_total_repeat	+=	$invoice_total_repeat;
				
                $grantretion += $retention; 
				$grantadvance += $advance; 
				$grantdiscount += $discount; 
				$grantsc += $sc;
				$grantvat += $vat; 
				$grantgst += $gst; 
              

			
				echo '</tr>';
                $i++;				
           
			}
            echo '<tr>';
            echo '<td colspan="11" style="text-align:right">Total</td>';
            #echo '<td style="text-align:right">' . number_format($invtotal, 2, '.', '') . '</td>';
            echo '<td style="text-align:right">' . number_format($grantinvoice_total_repeat, 2, '.', '') . '</td>';
           
            echo '<td style="text-align:right">' . number_format($grantsc, 2, '.', '') . '</td>';
            
           ### echo '<td style="text-align:right">' . number_format($chequeamt, 2, '.', '') . '</td>';
            echo '<td style="text-align:right">' . number_format($grantvat, 2, '.', '') . '</td>';
			
            echo '<td style="text-align:right">' . number_format($grantgst, 2, '.', '') . '</td>';
            echo '<td style="text-align:right">' . number_format($grantretion, 2, '.', '') . '</td>';
			echo '<td style="text-align:right">' . number_format($grantadvance, 2, '.', '') . '</td>';
			echo '<td style="text-align:right">' . number_format($grantdiscount, 2, '.', '') . '</td>';
           
            echo '</tr>';
        }
		
		
        ?>
