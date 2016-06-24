<?php
	include_once("web-config.php");
	
	echo "<pre>";
	print_r($_GET);
	die();
	$condition = "";
	if(isset($_GET['fingreso']) && $_GET['fingreso'] != "")
	{
		$condition = ."AND l.App_Logs_DateTime='".$_GET['fingreso']."'";
	}
	elseif(isset($_GET['respuesta']) && $_GET['respuesta'] != "")
	{
		$condition = ."AND a.App_Aux_text='".$_GET['respuesta']."'";
	}
	elseif(isset($_GET['contacto']) && $_GET['contacto'] != "")
	{
		$condition = ."AND aa.App_Aux_text='".$_GET['contacto']."'";
	}
	elseif(isset($_GET['telefono']) && $_GET['telefono'] != "")
	{
		$condition = ."AND aaa.App_Aux_text='".$_GET['telefono']."'";
	}
	elseif(isset($_GET['valro']) && $_GET['valro'] != "")
	{
		$condition = ."AND l.App_Logs_TransAmmount='".$_GET['valro']."'";
	}
	elseif(isset($_GET['fComp']) && $_GET['fComp'] != "")
	{
		$condition = ."AND l.App_Logs_TransDateTime='".$_GET['fComp']."'";
	}
	elseif(isset($_GET['comentarios']) && $_GET['comentarios'] != "")
	{
		$condition = ."AND l.App_Logs_Notes='".$_GET['comentarios']."'";
	}
	
	echo $condition; die();
	/*
	$sql="select l.App_Logs_Id,l.App_Logs_DateTime,l.App_Logs_Answer,l.App_Logs_Contact,l.App_Logs_Type,l.App_Logs_TransAmmount,l.App_Logs_TransDateTime,l.App_Logs_Notes,a.App_Aux_text as respuesta,aa.App_Aux_text as contactto,aaa.App_Aux_text as telefono
							from App_Logs l 
							inner join App_Aux a ON l.App_Logs_Answer = a.App_Aux_value 
							inner join App_Aux aa ON l.App_Logs_Contact = aa.App_Aux_value
							inner join App_Aux aaa ON l.App_Logs_Type = aaa.App_Aux_value							
							//where App_Logs_OperationID = '".$_GET['operno']."' and a.App_Aux_field = 'Answer' and aa.App_Aux_field='Relation' and aaa.App_Aux_field='Tipo_Gestion' order by App_Logs_Id DESC  LIMIT 0,$resultsPerPage";																																							
							where 							
					
					$result=mysql_query($sql);
					
					while($row=mysql_fetch_array($result)){ 
					*/

					l.App_Logs_DateTime
					a.App_Aux_text
					aa.App_Aux_text
					aaa.App_Aux_text
					l.App_Logs_TransAmmount
					l.App_Logs_TransDateTime
					l.App_Logs_Notes
					
					
					ac.App_Credits_BankOperNumber like '%".$searchText."%'
													OR ac.App_Credits_DebtorId like '%".$searchText."%'
													OR acl.App_Clients_FullName like '%".$searchText."%'
													OR ac.App_Credits_BankDueDate like '%".$searchText."%'
													OR vos.App_Aux_text like '%".$searchText."%'
													
													OR acp.App_Phones_PhoneNumber like '%".$searchText."%'
?>
