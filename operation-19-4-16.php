<?php 
include("header.php");
include_once("utils.php");
?>

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
                  <td>ID:</td>
                  <td><?php echo $row['App_Credits_DebtorId']." / ".$row['App_Clients_FullName']; ?></td>
                  <td></td>
                </tr>
				<?php
			   $sql="select * from App_Credits ac INNER JOIN App_Phones ap ON ac.App_Credits_DebtorId = ap.App_Phones_DebtorID WHERE ap.App_Phones_PhoneStatus = 1 and ac.App_Credits_AssignedTo ='".$_SESSION["logged_in_user"]["App_Users_ID"]."' limit 3";
				$result=mysql_query($sql);
				?>
				<tr>
                  <td>Phone:</td>
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
                  <td>Address:</td>
                  <td><?php echo $row['App_Addresses_MainStreet']; ?></td>
                  <td><a href="#Cli_Address" data-toggle="modal" data-target="#Cli_Address">More</a></td>
               
                </tr>
				<?php
			   $sql="select * from App_Aux aa INNER JOIN App_Clients ac ON aa.App_Aux_value = ac.App_Clients_Plaza INNER JOIN App_Credits ac1 ON ac1.App_Credits_DebtorId = ac.App_Clients_DebtorIdNumber WHERE aa.App_Aux_field = 'City' and ac1.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
				<tr>
                  <td>Zone:</td>
                  <td><?php echo $row['App_Aux_text']; ?></td>
                  <td></td>
                 
                </tr>
				<?php
				$sql="select * from App_Aux aa INNER JOIN App_Clients ac ON aa.App_Aux_value = ac.App_Clients_BankAgency INNER JOIN App_Credits ac1 ON ac1.App_Credits_DebtorId = ac.App_Clients_DebtorIdNumber WHERE aa.App_Aux_field = 'Route' and ac1.App_Credits_AssignedTo =".$_SESSION["logged_in_user"]["App_Users_ID"];
				$result=mysql_query($sql);
				$row=mysql_fetch_array($result);
			   ?>
				<tr>
                  <td>Route</td>
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
              <h1 class="reg_contact_no">3</h1>
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
                  <th>Operation</th>
                  <th>Capital</th>
                  <th>+ Intersts</th>
                  <th>- Payment</th>
                  <th>= debt</th>
                  <th>Product</th>
                  <th>Due Date</th>
                  <th>Status</th>
                  <th>More</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>985652321</td>
                  <td>$1200</td>
                  <td>$150</td>
                  <td>$850</td>
                  <td>$500</td>
                  <td>Amortization</td>
                  <td>31/08/2015</td>
                  <td>On Agreement</td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td>1232654</td>
                  <td>$1800</td>
                  <td>$600</td>
                  <td>$1200</td>
                  <td>$1200</td>
                  <td>Amortization</td>
                  <td>15/12/2015</td>
                  <td>pending</td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td>46478252</td>
                  <td>$1500</td>
                  <td>$900</td>
                  <td>$600</td>
                  <td>$1800</td>
                  <td>Amortization</td>
                  <td>03/03/2016</td>
                  <td>On Agreement</td>
                  <td><a href="#">Details</a></td>
                </tr>
                </tbody>
                <tfoot>
                        <tr>
                  <th></th>
                  <th>$4500</th>
                  <th>$1650</th>
                  <th>$2650</th>
                  <th>$3500</th>
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
		<section class="col-lg-6">
		   <div class="box box-primary"> 
			   <div class="box-header">
			   <h3><u>Operation Details</u></h3>
			   </div>
            <div class="box-body no-padding">
               <table class="tbl_product">
                <tbody>
                <tr>
                  <td class="tbl_row">Product:</td>
                  <td class="tbl_row">Amortization</td>
                  <td><a href="#Oper_Amrotization" data-toggle="modal" data-target="#Oper_Amrotization" >Show table</a></td>
                </tr>
				<tr>
                  <td class="tbl_row">Due Date</td>
                  <td class="tbl_row">31/08/2015</td>          
                </tr>
				<tr>
                  <td class="tbl_row">Status</td>
                  <td class="tbl_row">En Convenio</td>          
                </tr>
			   </tbody>
			   </table>
			   <hr style="width: 365px;" />
			    <table class="tbl_product">
                <tbody>
				<tr>
                  <td class="tbl_row">Capital</td>
                  <td class="tbl_row">$1200</td>          
                </tr>
			     <tr>
                  <td class="tbl_row">Intersts</td>
				 <td class="tbl_row">$150(+)<hr /></td>          
                </tr>
				
			 </tbody> 
		     </table>
			  <table class="tbl_product">
                <tbody>
				 <tr>
                  <td class="tbl_row">Intial Debt</td>
                  <td class="tbl_row">$1350</td>          
                </tr>
				 <tr>
                  <td class="tbl_row">Previous Payment</td>
                  <td class="tbl_row">$850(-) <hr /></td>          
                </tr>
				
				</tbody>
	            </table>
				 <table class="tbl_product">
                <tbody>
				 <tr>
                  <td class="tbl_row">Debt</td>
                  <td class="tbl_row">$500</td>          
                </tr>
				 <tr>
                  <td class="tbl_row">Collection Fees</td>
                  <td class="tbl_row">$300(+)</td>          
                </tr>
				 <tr>
                  <td class="tbl_row">This Month Payments</td>
                  <td class="tbl_row">$0.00 <hr /></td>          
                </tr>
				
		      </tbody>      
              </table>
			   <table class="tbl_product">
                <tbody>
				 <tr style="color: red;">
                  <td class="tbl_row">Current Debt</td>
                  <td class="tbl_row">$800.00</td>          
                </tr>
                </tbody>
               
              </table>
            
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
                  <th>Date</th>
                  <th>Time</th>
                  <th>Type</th>
                  <th>Obervations</th>
                  <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td><input type="checkbox" /></td>
                  <td>Vgeruva</td>
                  <td>04/03/2015</td>
                  <td>00:00</td>
                  <td>Phone Call</td>
                  <td>testing </td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td><input type="checkbox" /></td>
                  <td>Vgeruva</td>
                  <td>04/03/2015</td>
                  <td>00:00</td>
                  <td>Phone Call</td>
                  <td>testing </td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td><input type="checkbox" /></td>
                  <td>Vgeruva</td>
                  <td>04/03/2015</td>
                  <td>00:00</td>
                  <td>Phone Call</td>
                  <td>testing </td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td><input type="checkbox" /></td>
                  <td>Vgeruva</td>
                  <td>04/03/2015</td>
                  <td>00:00</td>
                  <td>Phone Call</td>
                  <td>testing </td>
                  <td><a href="#">Details</a></td>
                </tr>
				 <tr>
                  <td><input type="checkbox" /></td>
                  <td>Vgeruva</td>
                  <td>04/03/2015</td>
                  <td>00:00</td>
                  <td>Phone Call</td>
                  <td>testing </td>
                  <td><a href="#">Details</a></td>
                </tr>
		   </tbody>
                <tfoot>
                <tr>
                  <th>Done</th>
                  <th>User</th>
                  <th>Date</th>
                  <th>Time</th>
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
          <h4 class="modal-title">Debtor General Information</h4>
        </div>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>	
			 </tbody> 
		     </table> 
			 </div>
			  <div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                 <th>Phone Number</th>
                 <th>Ext</th>
                 <th>Type</th>
                 <th>Confrom?</th>
                 <th>Registered date</th>
                 <th>Status</th>
                 <th>Operator</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>015658855</td>
                  <td></td>
                  <td>CLARD</td>
                  <td>Titluer Confirmado</td>
                  <td>20/07/2015</td>
                  <td>Active</td>
                  <td>Vguevara</td>
               
                </tr>
				 <tr>
                  <td>015658855</td>
                  <td></td>
                  <td>CLARD</td>
                  <td>Titluer Confirmado</td>
                  <td>20/07/2015</td>
                  <td>Active</td>
                  <td>Vguevara</td>
               
                </tr>
				  </tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> Add New Number</button>
            <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
      
  
     <div class="modal fade" id="Cli_Address" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Debtor General Information</h4>
        </div>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>	
			 </tbody> 
		     </table> 
			 </div>
			  <div class="box-body table-responsive no-padding">
          <table id="example2" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                  <th>Address</th>
                  <th>Name</th>
                  <th>Type</th>
                  <th>Zone</th>
                  <th>Confrom?</th>
                  
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Calba Sacio viviendra Mz 14k Solar 18</td>
                  <td>Self</td>
                  <td>Home</td>
                  <td>Guayaqui</td>
                  <td><input type="checkbox" /></td>
               
                </tr>
				  </tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> Add New Address</button>
            <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  <div class="modal fade" id="Oper_Amrotization" role="dialog">
		<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tabla De Amortization-Banco Guayaqui</h4>
        </div>
        <div class="modal-body">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Number:</td>
                  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">Cedula/RUC:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Operation:</td>
				  <td class="deb_info_row1">98645636</td>          
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
                <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  <tr>
                  <td>15</td>
                  <td>$53.00</td>
                  <td>$0.00</td>
                  <td class="red">$53.00</td>
                  <td>$9.59</td>
                  <td>$10.66</td>
                  <td>$10.72</td>
                  <td class="red">$83.97</td>
                  <td>30/09/2014</td>
                </tr>
				  </tbody>
               
              </table>
             
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info">Volver</button>
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
        <div class="modal-body">
            <div class="box-body table-responsive no-padding">
            <div>
			    <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Relation:</td>
                  <td class="deb_info_row1">Wife</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				 <tr>
                  <td class="deb_info_row">Phones:</td>
				  <td class="deb_info_row1">(04) 1234564 -(09)65412396</td> 
				  <td><a href="">more..</a></td>
                </tr>
				 <tr>
                  <td class="deb_info_row">Address:</td>
				  <td class="deb_info_row1">Calba Sacio viviendra Mz 14k Solar 18</td>   
				  <td><a href="">more..</a></td>
                </tr>
				
			 </tbody> 
		     </table>
			 <hr />
			 <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Relation:</td>
                  <td class="deb_info_row1">Father</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>  
                </tr>
				 <tr>
                  <td class="deb_info_row">Phones:</td>
				  <td class="deb_info_row1">(04) 1234564 -(09)65412396</td>  
				  <td><a href="">more..</a></td>
                </tr>
				 <tr>
                  <td class="deb_info_row">Address:</td>
				  <td class="deb_info_row1">Calba Sacio viviendra Mz 14k Solar 18</td> 
				  <td><a href="">more..</a></td>
                </tr>
				
			 </tbody> 
		     </table>
			 <hr />
			 <table class="deb_info_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Relation:</td>
                  <td class="deb_info_row1">Hermano</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				 <tr>
                  <td class="deb_info_row">Phones:</td>
				  <td class="deb_info_row1">(04) 1234564 -(09)65412396</td>  
				  <td><a href="">more..</a></td>
                </tr>
				 <tr>
                  <td class="deb_info_row">Address:</td>
				  <td class="deb_info_row1">Calba Sacio viviendra Mz 14k Solar 18</td>  
				   <td><a href="">more..</a></td>
                </tr>
				
			 </tbody> 
		     </table>
			 
			 
			 
			 </div>
             
            </div>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i> Add New Contacts</button>
              <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Go Back</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
    <div class="modal fade" id="Oper_Transactions" role="dialog">
	 <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Transaction</h4>
        </div>
        <div class="modal-body">   
		 <div class="box-body  no-padding md_box">
		   <div class="col-lg-7 actv">  
			    <table class="activity_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Operation:</td>
                  <td class="deb_info_row1">23654599</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
			 <div class="col-lg-4">
			 <div class="activity_head1">
			 <h4>Vgeruva</h4>
			 <h4>04/04/2016</h4>
			 <h4>14:30</h4>
			 
			 </div>
			 </div>
          </div>
		<div class="box-body">
		  <div class="col-lg-6">
		     <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Type</label>
                  <div class="col-sm-8">
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                  </select>
                </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Collection Date</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                   <input type="date" class="form-control" style="width: 120px;" >
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                </div>
                  </div>
                </div>
                <div class="form-group">
                 <label for="inputPassword3" class="col-sm-4 control-label">Amount</label>
				 <div class="col-sm-8">
				 <input type="number" class="form-control"> 
                </div>
                </div>
            </form>
		  </div>
		
		  <div class="col-lg-6">
              <form class="form-horizontal">
			    <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label ">Status</label>
                  <div class="col-sm-8">
                  <select class="form-control">
                    <option>Paid</option>
                    <option>UnPaid</option>
                    <option>Pending</option>
                  </select>
                </div>
                </div>
				 <div class="form-group">
				 	
                  <label for="inputPassword3" class="col-sm-6 control-label">Deposit Date</label>
                  <div class="col-sm-6">
                   <input type="date" class="form-control" style="width: 120px;">
                  </div>
                </div>
				 <div class="form-group">
				 
                  <label for="inputPassword3" class="col-sm-7 control-label ">Dep.Transaction #</label>
                  <div class="col-sm-5">
                  <input type="text" class="form-control">
                  </div>
                </div>
			  
			<div class="form-group">
			  <label for="inputPassword3" class="col-sm-7 control-label ">Conciliation</label>
			  <div class="col-sm-5">
			   <div class="checkbox">
                    <label>
                      <input type="checkbox">
                       Done
                    </label>
                  </div>
              </div>
              </div>
			  </form>
		   
		  </div>  
		  </div>  
      <div class="box-body">
	  <h4>Notes</h4>
	    <form role="form">
			    <div class="form-group">
                 
                  <textarea class="form-control" rows="5"></textarea>
                </div>
	     </form>
         </div>
         </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i>Save</button>
              <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Go Back</button>
        </div>
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
        <div class="modal-body">   
		 <div class="box-body  no-padding md_box">
		   <div class="col-lg-7 actv">  
			    <table class="activity_tbl">
                <tbody>
				<tr>
                  <td class="deb_info_row">Operation:</td>
                  <td class="deb_info_row1">23654599</td>          
                </tr>
				<tr>
                  <td class="deb_info_row">ID:</td>
                  <td class="deb_info_row1">09123654599</td>          
                </tr>
			     <tr>
                  <td class="deb_info_row">Name:</td>
				  <td class="deb_info_row1">Trancaso Ferrin Marcus Eusebio</td>          
                </tr>
				
			 </tbody> 
		     </table>
			 </div>
			 <div class="col-lg-4">
			 <div class="activity_head1">
			 <h4>Vgeruva</h4>
			 <h4>04/04/2016</h4>
			 <h4>14:30</h4>
			 
			 </div>
			 </div>
          </div>
		<div class="box-body">
		  <div class="col-lg-6">
		     <form class="form-horizontal">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-4 control-label">Type</label>
                  <div class="col-sm-8">
                  <select class="form-control">
                    <option>option 1</option>
                    <option>option 2</option>
                    <option>option 3</option>
                  </select>
                </div>
                </div>
				<div class="form-group">
                  <label for="inputPassword3" class="col-sm-4 control-label">Date</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                    <input type="date" id="datepicker" class="form-control" style="width: 120px;">
				   <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
					</div>
                  </div>
                </div>
                 <div class="form-group">
                 <label for="inputPassword3" class="col-sm-4 control-label">Time</label>
				 <div class="col-sm-8">
				
				 <div class="col-sm-6">
				 <input type="time" class="form-control"> 
                 </div >	
				 <div class="col-sm-6">
				 <input type="time" class="form-control">
                 </div>
                 </div>
                </div>
                 <div class="form-group">
			  <label for="inputPassword3" class="col-sm-4 control-label">Status</label>
			  <div class="col-sm-8">
			   <div class="checkbox">
                    <label>
                      <input type="checkbox">
                       Done
                    </label>
                  </div>
              </div>
              </div>
            </form>
		  </div>
		
		  <div class="col-lg-6">    
			   <h4>Task</h4>
              <form class="form-horizontal">
			    <div class="form-group">
                  <textarea class="form-control" rows="5"></textarea>
                </div>
			  </form>	   
		  </div>
		   
		  </div>  
		  
     
         </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info pull-left"><i class="fa fa-plus"></i>Save</button>
              <button type="button" class="btn btn-info"><i class="fa fa-reply"></i> Go Back</button>
        </div>
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

</body>
</html>
