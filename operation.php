<?php 
include("header.php");
include_once("utils.php");

?>
<style>
.textalign{
	text-align:right;
}
</style>
<script>
$(document).ready(function(){
	//var phone_id = getParameterByName('phoneid'); 
	//alert(phone_id);
	 var pathname = window.location.search;
	if (pathname == "") {
        } else if (pathname.substr(1, 7) == "phoneid") {
				$('#Cli_EditPhones').modal('show');	
        }
		else if (pathname.substr(1, 9) == "addressid") {
				$('#Cli_EditAddress').modal('show');	
        }
		else if (pathname.substr(1, 7) == "task_id") {
				$('#Oper_EditACtivities').modal('show');	
        }
		else if (pathname.substr(1, 9) == "contactid") {
				$('#Cli_Phones').modal('show');	
        }
		else if (pathname.substr(1, 10) == "contact_id") {
				$('#Cli_Address').modal('show');	
        }
});
</script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      &nbsp;
        <!-- Dashboard
        <small>Control panel</small> -->
      </h1>
      <ol class="breadcrumb">
        <li><a href="/oper_dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

	    <section class="col-lg-7">
              <div class="box box-primary"> 
			   <div class="box-header">
			   <h3>Debtor General Information</h3>
			   </div>
			   <?php
			   $sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
            <div class="box-body no-padding">
               <table  class="table  table-hover">
                <tbody>
                <tr>
                  <td><b>ID and Name:</b></td>
                  <td><?php echo $row['App_Credits_DebtorId']." / ".$row['App_Clients_FullName']; ?></td>
                  <td></td>
                </tr>
				<?php
			   $sql="select * from App_Phones WHERE App_Phones_DebtorID ='".$row["App_Credits_DebtorId"]."' limit 3";
				$result=mysql_query($sql);
				?>
				<tr>
                  <td><b>Phone:</b></td>
                  <td><?php
				  $i=1; 	
				  while($row=mysql_fetch_array($result)){ 
				  if($i>1){ $comma=","; }else { $comma=""; }
				  echo $comma.$row['App_Phones_PhoneNumber'];
				  $i++;
				  } ?></td>
                  <td><a href="#Cli_Phones" data-toggle="modal" data-target="#Cli_Phones">More</a></td>
                </tr>
				<?php
			   $sql="select * from App_Credits ac INNER JOIN App_Addresses aa ON ac.App_Credits_DebtorId = aa.App_Addresses_DebtorID WHERE aa.App_Addresses_Status = 1 and ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
				<tr>
                  <td><b>Address:</b></td>
                  <td><?php echo $row['App_Addresses_MainStreet']; ?></td>
                  <td><a href="#Cli_Address" data-toggle="modal" data-target="#Cli_Address">More</a></td>
               
                </tr>
				<?php
			   $sql="select * from App_Aux aa INNER JOIN App_Clients ac ON aa.App_Aux_value = ac.App_Clients_Plaza INNER JOIN App_Credits ac1 ON ac1.App_Credits_DebtorId = ac.App_Clients_DebtorIdNumber WHERE aa.App_Aux_field = 'City' and ac1.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
				<tr>
                  <td><b>City:</b></td>
                  <td><?php echo $row['App_Aux_text']; ?></td>
                  <td></td>
                 
                </tr>
				<?php
				$sql="select * from App_Aux aa INNER JOIN App_Clients ac ON aa.App_Aux_value = ac.App_Clients_BankAgency INNER JOIN App_Credits ac1 ON ac1.App_Credits_DebtorId = ac.App_Clients_DebtorIdNumber WHERE aa.App_Aux_field = 'Route' and ac1.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
				<tr>
                  <td><b>Route:</b></td>
                  <td><?php echo $row['App_Aux_text']; ?></td>
                  <td></td>
                 
                </tr>
				
                </tbody>
               
              </table>
            
            </div>
            <!-- /.box-body -->
          </div>
        </section>
	  
	  
        <section class="col-lg-5">
             <div class="box box-primary">
			  <div class="box-header">
			   <h3 class="reg_contact">Register Contacts</h3>
			   </div>
            <div class="box-body no-padding">
			 
			 <div class="small-box">
			
            <div class="inner">
              <h1 class="reg_contact_no">
			  <?php
		$sql="select * from App_Contacts WHERE App_Contacts_CreatedBy =".$_SESSION["logged_in_user"]["App_Users_ID"];
		$result=mysql_query($sql);
		$num_row=mysql_num_rows($result);
		echo $num_row;
			?>
			</h1>
            </div>
             <a href="#Cli_Contacts" data-toggle="modal" data-target="#Cli_Contacts" class="small-box-footer">Show Register Contacts <i class="fa fa-arrow-circle-right"></i></a>
            </div>
            
            </div>
            <!-- /.box-body -->
          </div>


        </section>
		<section class="col-lg-12">
		<div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Operations</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
			<div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <thead>
                <tr>
                  <th style="text-align: center;">Operation</th>
                  <th style="text-align: center;">Capital</th>
                  <th style="text-align: center;">+ Intersts</th>
                  <th style="text-align: center;">- Payment</th>
                  <th style="text-align: center;">= debt</th>
                  <th style="text-align: center;">Product</th>
                  <th style="text-align: center;">Due Date</th>
                  <th style="text-align: center;">Status</th>
                  
                </tr>
                </thead>
                <tbody>
				<?php
			   $sql="select * from App_Credits WHERE App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){ 
				$interst=number_format($row['App_Credits_BankTotalCredit'], 2, '.', '')*0.18;
				$debt=number_format($row['App_Credits_BankTotalCredit'], 2, '.', '')+number_format($interst, 2, '.', '')-500;
				$totalcapital+=number_format($row['App_Credits_BankTotalCredit'], 2, '.', '');
				$totalinterst+=number_format($interst, 2, '.', '');
				$totalpayment+=500;
				$totaldebt+=number_format($debt, 2, '.', '');
				$sql1="select * from App_Aux WHERE App_Aux_value = '".$row['App_Credits_BankCreditType']."' and App_Aux_field = 'BankProduct'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql2="select * from App_Aux WHERE App_Aux_value = '".$row['App_Credits_Status']."' and App_Aux_field = 'OperationStatus'";
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_array($result2);
			   ?>
                <tr>
                  <td style="text-align: center;"><a href="?operno=<?php echo $row['App_Credits_BankOperNumber'] ?>"><?php echo $row['App_Credits_BankOperNumber'] ?></a></td>
                  <td style="text-align: right;">$ <?php echo number_format($row['App_Credits_BankTotalCredit'], 2, '.', '') ?></td>
                  <td style="text-align: right;">$ <?php echo number_format($interst, 2, '.', '') ?></td>
                  <td style="text-align: right;">$ 500.00</td>
                  <td style="text-align: right;">$ <?php echo number_format($debt, 2, '.', '') ?></td>
                  <td style="text-align: center;"><?php echo $row1['App_Aux_text'] ?></td>
                  <td style="text-align: center;"><?php echo date(DEFAULT_DATE_FORMAT,strtotime($row['App_Credits_BankDueDate'])) ?></td>
				  <td style="text-align: center;"><?php echo $row2['App_Aux_text'] ?></td>
                  
                </tr>
				<?php } ?>
				 </tbody>
                <tfoot>
                        <tr>
                  <th></th>
                  <th style="text-align: right;">$ <?php echo number_format($totalcapital, 2, '.', ''); ?></th>
                  <th style="text-align: right;">$ <?php echo number_format($totalinterst, 2, '.', ''); ?></th>
                  <th style="text-align: right;">$ <?php echo number_format($totalpayment, 2, '.', ''); ?></th>
                  <th style="text-align: right;">$ <?php echo number_format($totaldebt, 2, '.', ''); ?></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          </div>
          </div>
		</section>
		<?php
		if(isset($_GET['operno'])){
				$sql="select * from App_Credits WHERE App_Credits_BankOperNumber =".$_GET['operno'];
		}
		else
		{
			$sql="select * from App_Credits WHERE App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
		}
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				$interst=$row['App_Credits_BankTotalCredit']*0.18;
				$initialdebt=$row['App_Credits_BankTotalCredit']+$interst;
				$debt=$row['App_Credits_BankTotalCredit']+$interst-500;
				$collectionfee=$initialdebt*0.2;
				$currdebt=$debt+$collectionfee-150;
				$sql1="select * from App_Aux WHERE App_Aux_value = '".$row['App_Credits_BankCreditType']."' and App_Aux_field = 'BankProduct'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql2="select * from App_Aux WHERE App_Aux_value = '".$row['App_Credits_Status']."' and App_Aux_field = 'OperationStatus'";
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_array($result2);
			   ?>
		<section class="col-lg-6" id="operno<?php echo $row['App_Credits_BankOperNumber'] ?>">
		   <div class="box box-primary"> 
			   <div class="box-header">
			   <h3><u>Operation Details</u></h3>
			   </div>
			   
            <div class="box-body no-padding">
               <table class="tbl_product">
                <tbody>
                <tr>
                  <td class="tbl_row">Product:</td>
                  <td class="tbl_row textalign"><a href="#Oper_Amrotization" data-toggle="modal" id="popupbyid" data-id="1" data-target="#Oper_Amrotization" ><?php echo $row1['App_Aux_text'] ?></a></td>
                </tr>
				<tr>
                  <td class="tbl_row">Due Date</td>
                  <td class="tbl_row textalign"><?php echo date(DEFAULT_DATE_FORMAT,strtotime($row['App_Credits_BankDueDate'])) ?></td>          
                </tr>
				<tr>
                  <td class="tbl_row">Status</td>
                  <td class="tbl_row textalign"><?php echo $row2['App_Aux_text'] ?></td>          
                </tr>
			   </tbody>
			   </table>
			   <hr style="width: 365px;" />
			    <table class="tbl_product">
                <tbody>
				<tr>
                  <td class="tbl_row">Capital</td>
                  <td class="tbl_row textalign">$<?php echo number_format($row['App_Credits_BankTotalCredit'], 2, '.', '') ?></td>          
                </tr>
			     <tr>
                  <td class="tbl_row">+ Intersts</td>
				 <td class="tbl_row textalign">$<?php echo number_format($interst, 2, '.', '') ?></td>          
                </tr>
				
			 </tbody> 
		     </table>
			 <hr style="width: 365px;" />
			  <table class="tbl_product">
                <tbody>
				 <tr>
                  <td class="tbl_row">Intial Debt</td>
                  <td class="tbl_row textalign">$<?php echo number_format($initialdebt, 2, '.', '') ?></td>          
                </tr>
				 <tr>
                  <td class="tbl_row">- Previous Payment</td>
                  <td class="tbl_row textalign">$650.00 </td>          
                </tr>
				
				</tbody>
	            </table>
				<hr style="width: 365px;" />
				 <table class="tbl_product">
                <tbody>
				 <tr>
                  <td class="tbl_row">Debt</td>
                  <td class="tbl_row textalign">$<?php echo number_format($debt, 2, '.', '') ?></td>          
                </tr>
				 <tr>
                  <td class="tbl_row">+ Collection Fees</td>
                  <td class="tbl_row textalign">$<?php echo number_format($collectionfee, 2, '.', '') ?></td>          
                </tr>
				 <tr>
                  <td class="tbl_row">This Month Payments</td>
                  <td class="tbl_row textalign">$150.00 </td>          
                </tr>
				
		      </tbody>      
              </table>
			  <hr style="width: 365px;" />
			   <table class="tbl_product">
                <tbody>
				 <tr style="color: red;">
                  <td class="tbl_row">Current Debt</td>
                  <td class="tbl_row textalign">$<?php echo number_format($currdebt, 2, '.', '') ?></td>          
                </tr>
                </tbody>
               
              </table>
            <hr style="width: 365px;" />
            </div>
            <!-- /.box-body -->
		   </div>
		</section>
		<section class="col-lg-6">
		 <div class="box box-primary"> 
			   <div class="box-header">
			   <h3><u>Agreement Details</u></h3>
			   </div>
            <div class="box-body no-padding">
			<div class="col-lg-8">
               <table class="tbl_product1">
                <tbody style="display:black;">
                <tr>
                  <td class="tbl_row">Agreement:</td>
                  <td class="tbl_row">$2400.00</td>
                </tr>
				<tr>
                  <td class="tbl_row">Down Payment</td>
                  <td class="tbl_row">$250.00(-)</td>          
                </tr>
				<tr>
                  <td class="tbl_row">Previous Payment</td>
                  <td class="tbl_row">$200.00(-)</td>          
                </tr>
				<tr>
                  <td class="tbl_row" style="display:flex;">This Month Payments</td>
                  <td class="tbl_row">$0.00(-)<hr /></td>          
                </tr>
				<tr style="color: red;">
                  <td class="tbl_row">Pending</td>
                  <td class="tbl_row">$1950.00</td>          
                </tr>
			   </tbody>
			   </table>
			   </div>
			   <div class="col-lg-4">
			     <div class="box-body no-padding">
				 <div>
				 <a>
				 <i class="fa fa-credit-card fa-5x fa_pay"></i>
				 <a href="#Oper_Transactions" data-toggle="modal" data-target="#Oper_Transactions"><h5 class="reg_pay">Register Payment</h5> </a>
				 </div>
				 </div>
			   </div>
			   <div class="col-lg-12 op_agree_details">
			  <div class="box-body table-responsive no-padding">
              <table class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Type</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>More</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Down Payment</td>
                  <td>16/08/2015</td>
                  <td>$250</td>
                  <td style="color:red">Missed</td>
                  <td><a href="#" >Details</a></td>
                </tr>
				  <tr>
                  <td>Down Payment</td>
                  <td>30/12/2015</td>
                  <td>$250</td>
                  <td style="color:#3C8DBC">Paid</td>
                  <td><a href="#">Details</a></td>
                </tr>
				  <tr>
                  <td>Agreement</td>
                  <td>16/08/2015</td>
                  <td>$100</td>
                  <td style="color:#3C8DBC">Paid</td>
                  <td><a href="#">Details</a></td>
                </tr>
				  <tr>
                  <td>Agreement</td>
                  <td>30/08/2015</td>
                  <td>$250</td>
                  <td style="color:#00A65A">Current</td>
                  <td><a href="#">Details</a></td>
                </tr>
				  <tr>
                  <td>Down Payment</td>
                  <td>16/08/2016</td>
                  <td>$100</td>
                  <td style="color:#605CA8">Planned</td>
                  <td><a href="#">Details</a></td>
                </tr>
				
                </tbody>
                <tfoot>
                <tr>
                   <th>Type</th>
                  <th>Due Date</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>More</th>
                </tr>
                </tfoot>
              </table>
          
            </div>
            </div>
            </div>
            </div>

			 
		</section>
		<section class="col-lg-12">
		<div class="box">
            <div class="box-header">
            <h3 class="box-title bx_title">Activity</h3>
			<h2 class="fa_cal"><a href="#Oper_ACtivities" data-toggle="modal" data-target="#Oper_ACtivities"><i class="fa fa-calendar-plus-o"></i></a></h2>
            </div>
            <!-- /.box-header -->
          
			  <div class="box-body table-responsive no-padding">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Done</th>
                  <th>User</th>
                  <th>Date/Time</th>
                  <th>Type</th>
                  <th>Obervations</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
				<?php
			   $sql="select * from App_Tasks WHERE App_Tasks_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"]." order by App_Task_ID desc limit 30";
				$result=mysql_query($sql);
				//$row=mysql_fetch_array($result);
				while($row=mysql_fetch_array($result)){ 
				$checked = ($row['App_Task_Status'] == 1) ? 'checked="checked' : '';
				$sql1="select * from App_Users WHERE App_Users_ID =".$row["App_Tasks_AssignedTo"];
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql2="select * from App_Aux WHERE App_Aux_value = '".$row['App_Task_TaskType']."' and App_Aux_field = 'TaskType'";
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_array($result2);
				
				?>
                <tr>
				  <td><input type="checkbox" <?php echo $checked; ?> value="1" class="chk_active" id="<?php echo $row['App_Task_ID']; ?>" /></td>
                  <td><?php echo $row1['App_Users_fullname'] ?></td>
                  <td><?php echo $row['App_Task_DueDateTime'] ?></td>
                  <td><?php echo $row2['App_Aux_text'] ?></td>
                  <td><?php echo $row['App_Task_Description'] ?> </td>
                  <td><a href="" data-toggle="modal" data-id="<?php echo $row['App_Task_ID'] ?>" class="editactivity">Edit</a></td>
                </tr>
				<?php } ?>
		   </tbody>
                <tfoot>
                <tr>
                  <th>Done</th>
                  <th>User</th>
                  <th>Date/Time</th>
                  <th>Type</th>
                  <th>Obervations</th>
                  <th></th>
                </tr>
                </tfoot>
              </table>
            </div>
         
            <!-- /.box-body -->
          </div>
		</section>
		
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  
   <div class="modal fade" id="Cli_Phones" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Phone numbers</h4>
        </div>
		<?php
		if(isset($_GET['contactid'])){
				$sql1="select * from App_Contacts where App_Contacts_Id='".$_GET['contactid']."'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql="select * from App_Contacts WHERE App_Contacts_RefId =".$row1['App_Contacts_RefId'];
		}else{
			   $sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Phones ap ON ac.App_Credits_DebtorId = ap.App_Phones_DebtorID WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
		}
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				
		?>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Phones_DebtorID'] ?><?php echo $row['App_Contacts_RefId'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1"><?php echo $row['App_Clients_FullName'] ?><?php echo $row['App_Contacts_FullName'] ?></td>          
                </tr>	
			 </tbody> 
		     </table> 
			 </div>
			  <div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                 <th>Number</th>
                 <th>Ext.</th>
                 <th>Type</th>
                 <th>Confirmed</th>
                 <th>Status</th>
				 <th>Reg. By</th>
				 <th>Date</th>
                </tr>
                </thead>
                <tbody>
				<?php
				if(isset($_GET['contactid'])){
				$sql="select * from App_Contacts WHERE App_Contacts_RefId =".$row1['App_Contacts_RefId'];
				}
				else{
				$sql="select * from App_Phones WHERE App_Phones_DebtorID=".$row['App_Phones_DebtorID'];
				}
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
					$checked = ($row['App_Phones_Confirmed'] == 1) ? 'checked="checked' : '';
					
				$sql1="select * from App_Aux aa INNER JOIN App_Phones ac ON aa.App_Aux_value = ac.App_Phones_PhoneType WHERE aa.App_Aux_field = 'PhoneType' and ac.App_Phones_PhoneType =".$row['App_Phones_PhoneType'];
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				if(isset($_GET['contactid'])){
					$sql2="select * from App_Users WHERE App_Users_ID =".$row["App_Contacts_CreatedBy"];
				}
				else{
				$sql2="select * from App_Users WHERE App_Users_ID =".$row["App_Phones_CreatedBy"];
				}
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_array($result2);
					?>
                <tr>
                  <td><a href="" class="editphone" data-id="<?php echo $row['App_Phones_ID'] ?><?php echo $row['App_Contacts_Id'] ?>" data-toggle="modal"><?php echo $row['App_Phones_PhoneNumber'] ?><?php echo $row['App_Contacts_PhoneNumber'] ?></a></td>
                  <td><?php echo $row['App_Phones_Ext'] ?></td>
                  <td><?php echo $row1['App_Aux_text'] ?></td>
                  <td><input type="checkbox" <?php echo $checked; ?> value="1" id="<?php echo $row['App_Phones_ID']; ?>" /></td>
				  <td><?php if($row['App_Phones_PhoneStatus'] == 1){ echo "Active";}else{ echo "Inactive";} ?></td>
                  <td><?php echo $row2['App_Users_fullname'] ?></td>
                  <td><?php echo $row['App_Phones_CreatedOn'] ?><?php echo $row['App_Contacts_CreatedOn'] ?></td>
               
                </tr>
				<?php } ?>
				</tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
           <a href="#Cli_AddPhones" class="btn btn-info pull-left" data-toggle="modal" data-target="#Cli_AddPhones"><i class="fa fa-plus"></i> Add New Number</a>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
      </div>
      
    </div>
  </div>
   <div class="modal fade" id="Cli_AddPhones" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Number</h4>
        </div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<?php
				$sql="select * from App_Credits where App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				?>
				<input type="hidden" name="regby" value="<?php echo $_SESSION["logged_in_user"]["App_Users_ID"] ?>"/>
				<input type="hidden" name="debtorid" value="<?php echo $row['App_Credits_DebtorId'] ?>"/>
				<tr>
                  <td class="deb_info_row">Number:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="no" required /></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Ext.:</td>
				  <td class="deb_info_row1"><input type="text" name="ext" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Type:</td>
				  <td class="deb_info_row1">
				  <select class="form-control" name="type">
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'PhoneType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
						echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Confirmed:</td>
				  <td class="deb_info_row1"><input type="checkbox" value="1" name="confirmed" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Status:</td>
				  <td class="deb_info_row1"><input type="checkbox" checked value="1" name="status" /></td>          
                </tr>	
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
		   <button type="submit" class="btn btn-info pull-left" name="insert"><i class="fa fa-plus"></i> Insert</button>
		   <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>   
  <div class="modal fade" id="Cli_EditPhones" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Number</h4>
        </div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<?php
				$sql1="select * from App_Phones where App_Phones_ID='".$_GET['phoneid']."'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$checked = ($row1['App_Phones_Confirmed'] == 1) ? 'checked="checked' : '';
				$checked1 = ($row1['App_Phones_PhoneStatus'] == 1) ? 'checked="checked' : '';
				?>
				<tr>
                  <td class="deb_info_row">Number:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="no" value="<?php echo $row1['App_Phones_PhoneNumber'] ?>" required /></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Ext.:</td>
				  <td class="deb_info_row1"><input type="text" name="ext" value="<?php echo $row1['App_Phones_Ext'] ?>" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Type:</td>
				  <td class="deb_info_row1">
				  <select class="form-control" name="type">
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'PhoneType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
						if($row1['App_Phones_PhoneType']==$r['App_Aux_value']){
							$selected1= 'selected="selected"';
						}
						else
						{
							$selected1='';
						}
                           echo "<option $selected1 value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Confirmed:</td>
				  <td class="deb_info_row1"><input type="checkbox" <?php echo $checked; ?> value="1" name="confirmed" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Status:</td>
				  <td class="deb_info_row1"><input type="checkbox" <?php echo $checked1; ?> value="1" name="status" /></td>          
                </tr>	
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
		   <button type="submit" class="btn btn-info pull-left" name="update"><i class="fa fa-plus"></i> Update</button>
		    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>   
     <div class="modal fade" id="Cli_Address" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Addresses</h4>
        </div>
		<?php
			   $sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Addresses ap ON ac.App_Credits_DebtorId = ap.App_Addresses_DebtorID WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				
		?>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Addresses_DebtorID'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1"><?php echo $row['App_Clients_FullName'] ?></td>          
                </tr>	
			 </tbody> 
		     </table> 
			 </div>
			  <div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                  <th>Address</th>
                  <th>Type</th>
                  <th>Confirmed</th>
                  <th>Status</th>
                  <th>Reg. By</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
				<?php 
				$sql="SELECT * FROM App_Addresses WHERE App_Addresses_DebtorID=".$row['App_Addresses_DebtorID'];
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
					$checked = ($row['App_Addresses_Confirmed'] == 1) ? 'checked="checked' : '';
					
				$sql1="select * from App_Aux aa INNER JOIN App_Addresses ac ON aa.App_Aux_value = ac.App_Addresses_AddressType WHERE aa.App_Aux_field = 'AddressType' and ac.App_Addresses_AddressType =".$row['App_Addresses_AddressType'];
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql2="select * from App_Users WHERE App_Users_ID =".$row["App_Addresses_CreatedBy"];
				$result2=mysql_query($sql2);
				$row2=mysql_fetch_array($result2);
				?>
                <tr>
                  <td><a href="" class="editaddress" data-id="<?php echo $row['App_Addresses_Id'] ?>" data-toggle="modal"><?php echo $row['App_Addresses_MainStreet'] ?></a></td>
                  <td><?php echo $row1['App_Aux_text'] ?></td>
                  <td><input type="checkbox" <?php echo $checked; ?> value="1" id="<?php echo $row['App_Addresses_Id']; ?>" /></td>
                  <td><?php if($row['App_Addresses_Status'] == 1){ echo "Active";}else{ echo "Inactive";} ?></td>
                  <td><?php echo $row2['App_Users_fullname'] ?></td>
				  <td><?php echo $row['App_Addresses_CreatedOn'] ?></td>
                  
                </tr>
				<?php } ?>
				  </tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
		<a href="#Cli_AddAddress" class="btn btn-info pull-left" data-toggle="modal" data-target="#Cli_AddAddress"><i class="fa fa-plus"></i> Add New Address</a>
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="modal fade" id="Cli_AddAddress" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Address</h4>
        </div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<?php
				$sql="select * from App_Credits where App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				?>
				<input type="hidden" name="regby" value="<?php echo $_SESSION["logged_in_user"]["App_Users_ID"] ?>"/>
				<input type="hidden" name="debtorid" value="<?php echo $row['App_Credits_DebtorId'] ?>"/>
				<tr>
                  <td class="deb_info_row">Address:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="address" size="50" required/></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Type:</td>
				  <td class="deb_info_row1">
				  <select class="form-control" name="type">
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'AddressType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Confirmed:</td>
				  <td class="deb_info_row1"><input type="checkbox" value="1" name="confirmed" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Status:</td>
				  <td class="deb_info_row1"><input type="checkbox" checked value="1" name="status" /></td>          
                </tr>	
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
           <button type="submit" class="btn btn-info pull-left" name="insert1"><i class="fa fa-plus"></i> Insert</button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>   
  
  <div class="modal fade" id="Cli_EditAddress" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Address</h4>
        </div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<?php
				$sql1="select * from App_Addresses where App_Addresses_Id='".$_GET['addressid']."'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$checked = ($row1['App_Addresses_Confirmed'] == 1) ? 'checked="checked' : '';
				$checked1 = ($row1['App_Addresses_Status'] == 1) ? 'checked="checked' : '';
				?>
				<tr>
                  <td class="deb_info_row">Address:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="address" size="50" value="<?php echo $row1['App_Addresses_MainStreet'] ?>" required /></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Type:</td>
				  <td class="deb_info_row1">
				  <select class="form-control" name="type">
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'AddressType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           if($row1['App_Addresses_AddressType']==$r['App_Aux_value']){
							$selected1= 'selected="selected"';
						}
						else
						{
							$selected1='';
						}
                           echo "<option $selected1 value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Confirmed:</td>
				  <td class="deb_info_row1"><input type="checkbox" <?php echo $checked; ?> value="1" name="confirmed" /></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Status:</td>
				  <td class="deb_info_row1"><input type="checkbox" <?php echo $checked1; ?> value="1" name="status" /></td>          
                </tr>	
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
           <button type="submit" class="btn btn-info pull-left" name="update1"><i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>   
  
  <div class="modal fade" id="Oper_Amrotization" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tabla de amortizacion</h4>
        </div>
		<?php
		if(isset($_GET['operno'])){
			$sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Amortization ap ON ac.App_Credits_BankOperNumber = ap.App_Amortization_BankOperation WHERE  ap.App_Amortization_BankOperation =".$_GET["operno"];
		}
		else
		{
			$sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Amortization ap ON ac.App_Credits_BankOperNumber = ap.App_Amortization_BankOperation WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
		}

				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
		?>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Number:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Clients_FullName'] ?></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Cedula/RUC:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Credits_DebtorId'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Operation:</td>

				  <td class="deb_info_row1"><?php echo $row['App_Amortization_BankOperation'] ?></td>   
				  
                </tr>
				
			 </tbody> 
		     </table>
			 </div>			 
		<div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
				<tr>
                  <th>Cuata</th>
                  <th>Capital</th>
                  <th>Interest</th>
                  <th>Cuata</th>
                  <th>I Fine</th>
                  <th>Mara</th>
                  <th>Gastas</th>
                  <th>Total</th>
                  <th>F.vata</th> 
                </tr>
				</thead>
                <tbody>
				<?php
			   $sql="select * from App_Amortization WHERE App_Amortization_BankOperation =".$row['App_Amortization_BankOperation'];
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
				?>
                
                <tr>
                  <td><?php echo $row['App_Amortization_Share'] ?></td>
				  <td>$<?php echo number_format($row['App_Amortization_Capital'], 2, '.', '') ?></td>
                  <td>$<?php echo number_format($row['App_Amortization_Interest'], 2, '.', '') ?></td>
                  <td class="red">$<?php echo number_format($row['App_Amortization_Fee'], 2, '.', '') ?></td>
                  <td>$<?php echo number_format($row['App_Amortization_FinInterest'], 2, '.', '') ?></td>
                  <td>$<?php echo number_format($row['App_Amortization_DefaultFee'], 2, '.', '') ?></td>
                  <td>$<?php echo number_format($row['App_Amortization_CollectExpenses'], 2, '.', '') ?></td>
                  <td class="red">$<?php echo number_format($row['App_Amortization_ShareTotal'], 2, '.', '') ?></td>
                  <td><?php echo $row['App_Amortization_DueDate'] ?></td>
                </tr>
				<?php } ?>
                </tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
  
  <div class="modal fade" id="Cli_Contacts" role="dialog">
	 <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Registered Contacts</h4>
        </div>
		<?php
		$sql="select * from App_Contacts WHERE App_Contacts_CreatedBy =".$_SESSION["logged_in_user"]["App_Users_ID"];
		$result=mysql_query($sql);
		?>
        <div class="modal-body">
            <div class="box-body table-responsive no-padding">
            <div>
			<?php
			$i=1; 	
			while($row=mysql_fetch_array($result)){ 
			if($i>1){ $hr="<hr />"; }else { $hr=""; }
			echo $hr;
			$sql2="select * from App_Aux WHERE App_Aux_value = '".$row['App_Contacts_Relation']."' and App_Aux_field = 'RefferenceType'";
			$result2=mysql_query($sql2);
			$row2=mysql_fetch_array($result2);
			?>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Relation:</td>
                  <td class="deb_info_row1"><?php echo $row2['App_Aux_text'] ?></td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Contacts_RefId'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1"><?php echo $row['App_Contacts_FullName'] ?></td>          
                </tr>
				 <tr>
                  <td class="deb_info_row">Phones:</td>
				  <td class="deb_info_row1">
				  <?php
				  $sql3="select * from App_Contacts WHERE App_Contacts_RefId ='".$row['App_Contacts_RefId']."' limit 2";
				  $result3=mysql_query($sql3);
				  $i1=1;
				  while($row3=mysql_fetch_array($result3)){ 
				  if($i1>1){ $dash=" -"; }else { $dash=""; }
				  echo $dash.$row3['App_Contacts_PhoneNumber'];
				  $i1++;
				  }
				  ?>
				  </td> 
				  <td><a href="" data-id="<?php echo $row['App_Contacts_Id'] ?>" data-toggle="modal" class="small-box-footer addphone">more..</a></td>
                </tr>
				 <tr>
                  <td class="deb_info_row">Address:</td>
				  <td class="deb_info_row1"><?php echo $row['App_Contacts_Address'] ?></td>   
				  <td><a href="" data-id="<?php echo $row['App_Contacts_Id'] ?>" data-toggle="modal" class="small-box-footer addaddress">more..</a></td>
                </tr>
				
			 </tbody> 
		     </table>
			 
			<?php 
			$i++; } ?>
			</div>
             
            </div>

        </div>
        <div class="modal-footer">
		<a href="#Cli_AddContact" class="btn btn-info pull-left" data-toggle="modal" data-target="#Cli_AddContact"><i class="fa fa-plus"></i> Add New Contacts</a>
        <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
  <div class="modal fade" id="Cli_AddContact" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Contact</h4>
        </div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<?php
				$sql="select * from App_Credits where App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				?>
				<input type="hidden" name="regby" value="<?php echo $_SESSION["logged_in_user"]["App_Users_ID"] ?>"/>
				<input type="hidden" name="debtorid" value="<?php echo $row['App_Credits_DebtorId'] ?>"/>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><input type="text" name="refid"/></td>          
                </tr>
			    <tr>
                  <td class="deb_info_row">Full Name:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="fname" required /></td>          
                </tr>
			    <tr>
                  <td class="deb_info_row">Relation:</td>
				  <td class="deb_info_row1">
				  <select class="form-control" name="type" style="width:43%">
                    <option value="">Select Relation</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'RefferenceType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Number:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="no" required/></td>          
                </tr>
			    <tr>
                  <td class="deb_info_row">Address:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="address" size="50" required/></td>          
                </tr>
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
           <button type="submit" class="btn btn-info pull-left" name="insert2"><i class="fa fa-plus"></i> Insert</button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>  
  <div class="modal fade" id="Cli_MoreNumber" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add More Number</h4>
        </div>
		<?php
				$sql1="select * from App_Contacts where App_Contacts_Id='".$_GET['contactid']."'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
		?>
		<div class="modal-body" style="width:25%">
		<div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                 <th>Number</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$sql="select * from App_Contacts WHERE App_Contacts_RefId =".$row1['App_Contacts_RefId'];
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
					if($row['App_Contacts_PhoneNumber']==""){}else{
				?>
                <tr>
                  <td><?php echo $row['App_Contacts_PhoneNumber'] ?></td>
                </tr>
				<?php } } ?>
				</tbody>
               
              </table>
             
            </div>
			</div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<input type="hidden" name="hidrefid" value="<?php echo $row1['App_Contacts_RefId'] ?>"/>
				<tr>
                  <td class="deb_info_row">Number:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="no" required/></td>          
                </tr>
			    
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
           <button type="submit" class="btn btn-info pull-left" name="insert3"><i class="fa fa-plus"></i> Insert</button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>  
  <div class="modal fade" id="Cli_MoreAddress" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add More Address</h4>
        </div>
		<?php
				$sql1="select * from App_Contacts where App_Contacts_Id='".$_GET['contact_id']."'";
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
		?>
		<div class="modal-body" style="width:25%">
		<div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                 <th>Address</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$sql="select * from App_Contacts WHERE App_Contacts_RefId =".$row1['App_Contacts_RefId'];
				$result=mysql_query($sql);
				while($row=mysql_fetch_array($result)){
					if($row['App_Contacts_Address']==""){}else{
				?>
                <tr>
                  <td><?php echo $row['App_Contacts_Address'] ?></td>
                </tr>
				<?php } } ?>
				</tbody>
               
              </table>
             
            </div>
			</div>
		   <form role="form" action="" method="post">
		<div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<input type="hidden" name="hidrefid1" value="<?php echo $row1['App_Contacts_RefId'] ?>" />
				<tr>
                  <td class="deb_info_row">Address:<span style="color:red">*</span></td>
                  <td class="deb_info_row1"><input type="text" name="address" size="50" required/></td>          
                </tr>
				
			 </tbody> 
		     </table> 
			 </div>
			  
        </div>
		
        <div class="modal-footer">
           <button type="submit" class="btn btn-info pull-left" name="insert4"><i class="fa fa-plus"></i> Insert</button>
            <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
		</div>
		</form>
      </div>
      
    </div>
  </div>  
    <div class="modal fade" id="Oper_Transactions" role="dialog">
	 <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" style="width: 150%;margin-left: -24%;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">New Agreement</h4>
        </div>
		<?php 
		if(isset($_GET['operno'])){
			$sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Amortization ap ON ac.App_Credits_BankOperNumber = ap.App_Amortization_BankOperation WHERE  ap.App_Amortization_BankOperation =".$_GET["operno"];
		}
		else
		{
			$sql="select * from App_Credits ac INNER JOIN App_Clients ac1 ON ac.App_Credits_DebtorId = ac1.App_Clients_DebtorIdNumber INNER JOIN App_Amortization ap ON ac.App_Credits_BankOperNumber = ap.App_Amortization_BankOperation WHERE  ac.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
		}
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		$interst=$row['App_Credits_BankTotalCredit']*0.18;
				$initialdebt=$row['App_Credits_BankTotalCredit']+$interst;
				$debt=$row['App_Credits_BankTotalCredit']+$interst-500;
				$collectionfee=$initialdebt*0.2;
				$currdebt=$debt+$collectionfee-150;
		$sql2="select * from App_Agreement WHERE App_Agreement_DebtorID =".$row['App_Credits_DebtorId'];
				$result2=mysql_query($sql2);
				$row1=mysql_fetch_array($result2);
				$checked = ($row['App_Task_Status'] == 1) ? 'checked="checked' : '';
				$sql1="select * from App_Users WHERE App_Users_ID =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result1=mysql_query($sql1);
				$row2=mysql_fetch_array($result1);
				$CreatedOn=explode(" ",$row1['App_Agreement_CreatedOn']);
		?>
		<form class="form-horizontal" method="post" action="">
		<input type="hidden" name="hiddebt" class="hiddebt" value="<?php echo $debt ?>" />
		<input type="hidden" name="operationid" value="<?php echo $row['App_Amortization_BankOperation'];?>" />
		<input type="hidden" name="debtid" value="<?php echo $row['App_Credits_DebtorId'] ?>" />
		<div class="modal-body">   
		 <div class="box-body  no-padding md_box">
		   <div class="col-lg-7 actv" style="width:82%">  
		   <span style="font-size: 18px;font-style: normal;font-weight: 600;text-decoration: underline;">New Agreement Setup</span>
			    <table class="activity_tbl" style="margin-top:0px">
				<tbody>
				<tr>
                  <td class="deb_info_row">Cedula/RUC:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Credits_DebtorId'] ?></td>          
				  <td class="deb_info_row"></td>
				  <td class="deb_info_row">Agreement</td>&nbsp;
				  <td class="deb_info_row">Status</td>
                </tr>
			     <tr>
                  <td class="deb_info_row">Number:</td>
				  <td class="deb_info_row1"><?php echo $row['App_Clients_FullName'] ?></td>          
				  <td class="deb_info_row"></td>
				  <td class="deb_info_row">
				  <select class="form-control" name="status" style="width:228%">
                    <option value="">Select Agreement Status</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'AgreementStatus'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
				</td>
                </tr>
				<tr>
                  <td class="deb_info_row">Operation:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Amortization_BankOperation'];?></td>          
                </tr>
			</tbody> 
		     </table>
			 </div>
			 <div class="col-lg-4" style="float: right;width: 18%;">
			 <div class="activity_head1" style="margin-left:0px">
			 <h4><?php echo $row2['App_Users_fullname'] ?></h4>
			 <h4><?php echo $CreatedOn[0] ?></h4>
			 <h4><?php echo $CreatedOn[1] ?></h4>
			 </div>
			 </div>
          </div>
		<div class="box-body">
		  <div class="col-lg-4">
		     
                <div class="form-group">
                 <label for="inputPassword3" class="col-sm-4 control-label">Cur. Debt:</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control curdebt" value="<?php echo number_format($currdebt, 2, '.', ''); ?>" name="curdebt" readonly >
                </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Down Payment:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control dpayment" name="dpayment" >
                  </div>
                </div>
                
           
		  </div>
			<div class="col-lg-4">
		   
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Discount:</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control discount" name="discount" value="<?php echo number_format($collectionfee, 2, '.', ''); ?>" >
                </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Balance:</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control balance2" name="balance2" readonly="">
				   </div>
                </div>
                
           
		  </div>
		  <div class="col-lg-4">
             
			    <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label ">Balance:</label>
                  <div class="col-sm-8">
                  <input type="text" class="form-control balance1" name="balance1" readonly >
                </div>
                </div>
				 <div class="form-group">
				 	
                  <label for="inputPassword3" class="col-sm-4 control-label">Interest:</label>
                  <div class="col-sm-8">
                   <input type="text" class="form-control interest" name="interest" readonly="">
                  </div>
                </div>
				 
			  
		   
		  </div>  
		  </div>  
      <div class="box-body">
	  <div class="col-lg-10" style="border:1px solid;margin-left: 70px;background-color: lightyellow;">
		     
                <div class="form-group" style="margin-top: 16px;">
                 <label for="inputPassword3" class="col-sm-5 control-label">The agreement is a downpayment of</label>
                  <div class="col-sm-4">
                  <input type="text" class="form-control shares" value="" name="shares">
                </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label" style="margin-left: -17px;">then</label>
                  <div class="col-sm-2" style="margin-left: -21px;"><input type="text" class="form-control monthpayment1" name="monthpayment1">
                  </div>
				  <label for="inputPassword3" class="col-sm-3 control-label" style="margin-left: -34px;">monthly payments of</label>
				  <div class="col-sm-4">
                    <input type="text" class="form-control monthpayment2" name="monthpayment2" readonly="">
                  </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label" style="margin-left: -24px;">and a last payments of</label>
                  <div class="col-sm-2" style="margin-left: -19px;">
                    <input type="text" class="form-control lastpayment" name="lastpayment" readonly="">
                  </div>
				  <label for="inputPassword3" class="col-sm-5 control-label" style="margin-left: -217px;">starting on</label>
				  <div class="col-sm-4">
				  <div class="input-group">
                    <input type="date" name="startdate" class="form-control">
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  </div>
                  </div>
                </div>
		  </div>
         </div>
         </div>
		 
        <div class="modal-footer">
			<button type="submit" class="btn btn-info pull-left" name="create"><i class="fa fa-plus"></i>Create Agreement</button>
			<button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
        </div>
     </form>
	 </div>
      
    </div>
  </div>
  
      <div class="modal fade" id="Oper_ACtivities" role="dialog">
	 <div class="modal-dialog">
		 
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Activity</h4>
        </div>
		<?php
			    $sql="select * from App_Tasks WHERE App_Tasks_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				$checked = ($row['App_Task_Status'] == 1) ? 'checked="checked' : '';
				$sql1="select * from App_Users WHERE App_Users_ID =".$row["App_Tasks_AssignedTo"];
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				
				$sql3="select * from App_Tasks ac INNER JOIN App_Clients ac1 ON ac.App_Task_DebtorID = ac1.App_Clients_DebtorIdNumber WHERE  ac.App_Tasks_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result3=mysql_query($sql3);
				$row3=mysql_fetch_array($result3);
				  
		?>
		<form class="form-horizontal" method="post" action="">
		<input type="hidden" name="regby" value="<?php echo $_SESSION["logged_in_user"]["App_Users_ID"] ?>"/>
		<input type="hidden" name="debtorid" value="<?php echo $row['App_Task_DebtorID'] ?>"/>
		<div class="modal-body">   
		 <div class="box-body  no-padding md_box">
		   <div class="col-lg-7 actv" style="width:65%">  
			    <table class="activity_tbl" style="margin-top:0px">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Task_DebtorID'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1"><?php echo $row3['App_Clients_FullName'] ?></td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
			 <div class="col-lg-4">
			 <div class="activity_head1" style="margin-left:0px;color:gray">
			 <h5><?php echo $row1['App_Users_fullname'] ?></h5>
			 <h5><?php echo $row['App_Task_CreatedOn'] ?></h5>
			 
			 </div>
			 </div>
          </div>
		  
		<div class="box-body">
		  <div class="col-lg-6" style="margin-left:-41px">
		     
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Type</label>
                  <div class="col-sm-8">
				  <select class="form-control" name="type" style="width:122%" required>
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'TaskType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           echo "<option value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
                </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Date</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                    <input type="date" id="dateselector" name="date" class="form-control" style="width: 150px;" required>
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
					</div>
                  </div>
                </div>
                 <div class="form-group">
                 <label for="inputPassword3" class="col-sm-4 control-label">Time</label>
				 <div class="col-sm-8">
				
				 <input type="time" class="form-control" id="timeselector" name="time" required>
                 </div>
                </div>
                 <div class="form-group">
			  <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
			  <div class="col-sm-8">
			   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="status" value="1">
                       Done
                    </label>
                  </div>
              </div>
              </div>
            
		  </div>
		
		  <div class="col-lg-6" style="margin-left:41px">    
			   <h4>Task</h4>
       
			    <div class="form-group">
                  <textarea class="form-control" rows="5" name="task" required ></textarea>
                </div>
		
		  </div>
		   <div class="col-lg-12">    
			   <h4>Outcome</h4>
       
			    <div class="form-group">
                  <textarea class="form-control" rows="3" name="outcome" ></textarea>
                </div>
		
		  </div>
		  </div>  
		  
     
         </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-info pull-left" name="save"><i class="fa fa-plus"></i>Save</button>
              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </form>
	  </div>
      
    </div>
  </div>
   <div class="modal fade" id="Oper_EditACtivities" role="dialog">
	 <div class="modal-dialog">
		 
     <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Activity</h4>
        </div>
		<?php
				//$sql="select * from App_Tasks WHERE App_Tasks_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
			    $sql="select * from App_Tasks WHERE App_Task_ID =".$_GET['task_id'];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
				$datetime=explode(" ",$row['App_Task_DueDateTime']);
				$checked = ($row['App_Task_Status'] == 1) ? 'checked="checked' : '';
				$sql1="select * from App_Users WHERE App_Users_ID =".$row["App_Tasks_AssignedTo"];
				$result1=mysql_query($sql1);
				$row1=mysql_fetch_array($result1);
				$sql3="select * from App_Tasks ac INNER JOIN App_Clients ac1 ON ac.App_Task_DebtorID = ac1.App_Clients_DebtorIdNumber WHERE  ac.App_Tasks_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result3=mysql_query($sql3);
				$row3=mysql_fetch_array($result3);
		?>
		<form class="form-horizontal" method="post" action="">
		<div class="modal-body">   
		 <div class="box-body  no-padding md_box">
		   <div class="col-lg-7 actv" style="width:65%">  
			    <table class="activity_tbl" style="margin-top:0px">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1"><?php echo $row['App_Task_DebtorID'] ?></td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1"><?php echo $row3['App_Clients_FullName'] ?></td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
			 <div class="col-lg-4">
			 <div class="activity_head1" style="margin-left:0px;color:gray">
			 <h5><?php echo $row1['App_Users_fullname'] ?></h5>
			 <h5><?php echo $row['App_Task_CreatedOn'] ?></h5>
			 
			 </div>
			 </div>
          </div>
		  
		<div class="box-body">
		  <div class="col-lg-6" style="margin-left:-41px">
		     
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Type</label>
                  <div class="col-sm-8">
				  <select class="form-control" name="type" style="width:122%" required>
                    <option value=""> -----------Select Type-----------</option>
                    <?php
					$ddl_secl = mysql_query("select * from App_Aux WHERE App_Aux_field = 'TaskType'");
                    while ($r = mysql_fetch_assoc($ddl_secl)) {
                           if($row['App_Task_TaskType']==$r['App_Aux_value']){
							$selected1= 'selected="selected"';
						}
						else
						{
							$selected1='';
						}
                           echo "<option $selected1 value='$r[App_Aux_value]'> $r[App_Aux_text] </option>";
                    }
                    ?>
                </select>
                </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Date</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                    <input type="date" id="dateselector" name="date" class="form-control" style="width: 150px;" value="<?php echo $datetime[0] ?>" required>
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
					</div>
                  </div>
                </div>
                 <div class="form-group">
                 <label for="inputPassword3" class="col-sm-4 control-label">Time</label>
				 <div class="col-sm-8">
				
				 <input type="time" class="form-control" id="timeselector" name="time" value="<?php echo $datetime[1] ?>" required>
                 </div>
                </div>
                 <div class="form-group">
			  <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
			  <div class="col-sm-8">
			   <div class="checkbox">
                    <label>
                      <input type="checkbox" name="status" <?php echo $checked; ?> value="1">
                       Done
                    </label>
                  </div>
              </div>
              </div>
            
		  </div>
		
		  <div class="col-lg-6" style="margin-left:41px">    
			   <h4>Task</h4>
       
			    <div class="form-group">
                  <textarea class="form-control" rows="5" name="task" required ><?php echo $row['App_Task_Description'] ?></textarea>
                </div>
		
		  </div>
		   <div class="col-lg-12">    
			   <h4>Outcome</h4>
       
			    <div class="form-group">
                  <textarea class="form-control" rows="3" name="outcome" ><?php echo $row['App_Task_Outcome'] ?></textarea>
                </div>
		
		  </div>
		  </div>  
		  
     
         </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-info pull-left" name="updateactivity"><i class="fa fa-plus"></i>Update</button>
              <button type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </form>
	  </div>
      
    </div>
  </div>
  
  
  
<!-- /.content-wrapper -->
 <?php include("footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript::;">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>




<!-- jQuery 2.2.0 -->
<script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<script>
$(document).on('change', '.chk_active', function () {
	
        var value = ($(this).is(":checked")) ? 1 : 0;
        var taskId = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "ajax.php",
            dataType: "json",
            async: true,
            data: {
                action: 'updateTaskStatus', // as you are getting in php $_POST['action1']
                taskId: taskId, // as you are getting in php $_POST['action1']
                status: value // as you are getting in php $_POST['action1']
            },
            success: function (msg) {
                alert(msg.message);
            }
        });
    });
	$(document).on("click", ".editphone", function () {
     var PhoneId = $(this).data('id');
     //ChangeUrl('Poligresa3.0', 'operation.php?phoneid='+PhoneId);
	 window.location.href='operation.php?phoneid='+PhoneId;
	 
});
$(document).on("click", ".editaddress", function () {
     var AddressId = $(this).data('id');
     window.location.href='operation.php?addressid='+AddressId;
	 
});
$(document).on("click", ".editactivity", function () {
     var TaskId = $(this).data('id');
     window.location.href='operation.php?task_id='+TaskId;
	 
});
$(document).on("click", ".addphone", function () {
     var ContactId = $(this).data('id');
     window.location.href='operation.php?contactid='+ContactId;
	 
});
$(document).on("click", ".addaddress", function () {
     var ContactId1 = $(this).data('id');
     window.location.href='operation.php?contact_id='+ContactId1;
	 
});
//$( ".dateselector" ).datepicker( "setDate", new Date());
var d = new Date(); 
var date2=d.getDate();
var month2=d.getMonth()+1;
var month3=(month2<10?'0':'') + month2;
var year=d.getFullYear();
var date1= year + '-' + month3 + '-' + date2;
$('#dateselector').val(date1);
var d1=d.getHours();
var d2=(d.getMinutes()<10?'0':'') + d.getMinutes();
var d3=d1+ ':' +d2;
document.getElementById("timeselector").defaultValue = d3;
function ChangeUrl(title, url) {
    if (typeof (history.pushState) != "undefined") {
        var obj = { Title: title, Url: url };
        history.pushState(obj, obj.Title, obj.Url);
    } else {
        alert("Browser does not support HTML5.");
    }
}

var Alerter = {
		Wait : 1, 
		Timer : null,
		Init : function(){
			this.Timer = setTimeout("Alerter.Alert()", this.Wait * 100);
		},
		Alert : function(){
			//alert("hello");
			var curdebt=$('.curdebt').val();
			var discount=$('.discount').val();
			var balance1=curdebt-discount;
			$('.balance1').val(balance1.toFixed(2));
			//var hiddebt=$('.hiddebt').val();
			var dpayment=$('.dpayment').val();
			var balance2=$('.balance1').val()-$('.dpayment').val();
			$('.balance2').val(balance2.toFixed(2));
			var interest=((($('.balance2').val() * 0.18) / 360) *30) * $('.monthpayment1').val();
			$('.interest').val(interest.toFixed(2));
			//var monthpayment1=(balance2 + interest) / $('.shares').val();
			//if($('.shares').val()==''){
			//$('.monthpayment1').val('');	
			//}
			//else
			//{
			//$('.monthpayment1').val(monthpayment1.toFixed(2));
			//}
			var total=balance2 + interest;
			var monthpayment2=5* ((total)/($('.monthpayment1').val()-1));
			$('.monthpayment2').val(monthpayment2.toFixed(2));
			var lastpayment=total-($('.monthpayment2').val()*($('.monthpayment1').val()-1));
			$('.lastpayment').val(lastpayment.toFixed(2));
			this.Timer = setTimeout("Alerter.Alert()", this.Wait * 100);
		}
	};
	
	Alerter.Init();
</script>
</body>
</html>
<?php
if (isset($_POST['insert'])) {
        $sql = "insert into App_Phones(App_Phones_DebtorID,App_Phones_PhoneNumber,App_Phones_Ext,App_Phones_PhoneType,App_Phones_Confirmed,App_Phones_PhoneStatus,App_Phones_CreatedBy,App_Phones_CreatedOn) values('" . $_POST['debtorid'] . "','" . $_POST['no'] . "','" . $_POST['ext'] . "','" . $_POST['type'] . "','" . $_POST['confirmed'] . "','" . $_POST['status'] . "','" . $_POST['regby'] . "','" . date('Y-m-d H:i:s') . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['update'])) {
        $sql = "update App_Phones set App_Phones_PhoneNumber='" . $_POST['no'] . "',App_Phones_Ext='" . $_POST['ext'] . "',App_Phones_PhoneType='" . $_POST['type'] . "',App_Phones_Confirmed='" . $_POST['confirmed'] . "',App_Phones_PhoneStatus='" . $_POST['status'] . "' where App_Phones_ID='" . $_GET['phoneid'] . "'";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['insert1'])) {
        $sql = "insert into App_Addresses(App_Addresses_DebtorID,App_Addresses_MainStreet,App_Addresses_AddressType,App_Addresses_Confirmed,App_Addresses_Status,App_Addresses_CreatedBy,App_Addresses_CreatedOn) values('" . $_POST['debtorid'] . "','" . $_POST['address'] . "','" . $_POST['type'] . "','" . $_POST['confirmed'] . "','" . $_POST['status'] . "','" . $_POST['regby'] . "','" . date('Y-m-d H:i:s') . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['update1'])) {
        $sql = "update App_Addresses set App_Addresses_MainStreet='" . $_POST['address'] . "',App_Addresses_AddressType='" . $_POST['type'] . "',App_Addresses_Confirmed='" . $_POST['confirmed'] . "',App_Addresses_Status='" . $_POST['status'] . "' where App_Addresses_Id='" . $_GET['addressid'] . "'";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['save'])) {
        $sql = "insert into App_Tasks(App_Task_CreatedBy,App_Task_CreatedOn,App_Task_DebtorID,App_Tasks_AssignedTo,App_Task_TaskType,App_Task_DueDateTime,App_Task_Description,App_Task_Status,App_Task_Outcome) values('" . $_POST['regby'] . "','" . date('Y-m-d H:i:s') . "','" . $_POST['debtorid'] . "','" . $_SESSION["logged_in_user"]["App_Users_ID"] . "','" . $_POST['type'] . "','" . $_POST['date']." ".$_POST['time'] . "','" . $_POST['task'] . "','" . $_POST['status'] . "','" . $_POST['outcome'] . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['updateactivity'])) {
        $sql = "update App_Tasks set App_Task_TaskType='" . $_POST['type'] . "',App_Task_DueDateTime='" . $_POST['date']." ".$_POST['time'] . "',App_Task_Description='" . $_POST['task'] . "',App_Task_Status='" . $_POST['status'] . "',App_Task_Outcome='" . $_POST['outcome'] . "' where App_Task_ID='" . $_GET['task_id'] . "'";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['create'])) {
		$dpayment=$_POST['dpayment'];
		$balance2=$_POST['balance2'];
		$interest=$_POST['interest'];
		$agreementtotal=$dpayment+$balance2+$interest;
        $sql = "insert into App_Agreement(App_Agreement_DebtorID,App_Agreement_OpearationID,App_Agreement_InitialDebt,App_Agreement_Discounts,App_Agreement_DownPayment,App_Agreement_Balance,App_Agreement_Interest,App_Agreement_Total,App_Agreement_Shares,App_Agreement_ShareAmount,App_Agreement_LastShareAmmount,App_Agreement_StartingOn,App_Agreement_Status,App_Agreement_CreatedBy,App_Agreement_CreatedOn) values('" . $_POST['debtid'] . "','" . $_POST['operationid'] . "','" . $_POST['curdebt'] . "','" . $_POST['discount'] . "','" . $_POST['dpayment'] . "','" . $_POST['balance2']."','".$_POST['interest'] . "','" . $agreementtotal . "','" . $_POST['shares'] . "','" . $_POST['monthpayment2'] . "','" . $_POST['lastpayment'] . "','" . $_POST['startdate'] . "','" . $_POST['status'] . "','" . $_SESSION["logged_in_user"]["App_Users_ID"] . "','" . date('Y-m-d H:i:s') . "')";
		mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['insert2'])) {
        $sql = "insert into App_Contacts(App_Contacts_DebtorId,App_Contacts_RefId,App_Contacts_FullName,App_Contacts_Relation,App_Contacts_PhoneNumber,App_Contacts_Address,App_Contacts_CreatedBy,App_Contacts_CreatedOn) values('" . $_POST['debtorid'] . "','" . $_POST['refid'] . "','" . $_POST['fname'] . "','" . $_POST['type'] . "','" . $_POST['no'] . "','" . $_POST['address'] . "','" . $_POST['regby'] . "','" . date('Y-m-d H:i:s') . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['insert3'])) {
        $sql = "insert into App_Contacts(App_Contacts_RefId,App_Contacts_PhoneNumber) values('" . $_POST['hidrefid'] . "','" . $_POST['no'] . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
if (isset($_POST['insert4'])) {
        $sql = "insert into App_Contacts(App_Contacts_RefId,App_Contacts_Address) values('" . $_POST['hidrefid1'] . "','" . $_POST['address'] . "')";
        mysql_query($sql);
        echo "<script>window.location.href='operation.php';</script>";
}
?>
