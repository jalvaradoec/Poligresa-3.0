<?php
	include_once("web-config.php");
	
	echo "<pre>";
	print_r($_GET);
	die();
	
	/*
	$sql="select l.App_Logs_Id,l.App_Logs_DateTime,l.App_Logs_Answer,l.App_Logs_Contact,l.App_Logs_Type,l.App_Logs_TransAmmount,l.App_Logs_TransDateTime,l.App_Logs_Notes,a.App_Aux_text as respuesta,aa.App_Aux_text as contactto,aaa.App_Aux_text as telefono
							from App_Logs l 
							inner join App_Aux a ON l.App_Logs_Answer = a.App_Aux_value 
							inner join App_Aux aa ON l.App_Logs_Contact = aa.App_Aux_value
							inner join App_Aux aaa ON l.App_Logs_Type = aaa.App_Aux_value							
							where App_Logs_OperationID = '".$_GET['operno']."' and a.App_Aux_field = 'Answer' and aa.App_Aux_field='Relation' and aaa.App_Aux_field='Tipo_Gestion' order by App_Logs_Id DESC  LIMIT 0,$resultsPerPage";																																							
					$result=mysql_query($sql);
					
					while($row=mysql_fetch_array($result)){ 
					*/
?>
