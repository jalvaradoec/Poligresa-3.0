<?php
	include_once("web-config.php");

	$condition = "";
	if(isset($_GET['fingreso']) && $_GET['fingreso'] != "")
	{		
		$fingresodate = date("Y-m-d", strtotime($_GET['fingreso']) );
		$condition .= " AND l.App_Logs_DateTime like '%".$fingresodate."%'";
	}
	if(isset($_GET['respuesta']) && $_GET['respuesta'] != "")
	{
		$condition .= "AND a.App_Aux_text='".$_GET['respuesta']."'";
	}
	if(isset($_GET['contacto']) && $_GET['contacto'] != "")
	{
		$condition .= " AND aa.App_Aux_text='".$_GET['contacto']."'";
	}
	if(isset($_GET['telefono']) && $_GET['telefono'] != "")
	{
		$condition .= "AND aaa.App_Aux_text='".$_GET['telefono']."'";
	}
	if(isset($_GET['valro']) && $_GET['valro'] != "")
	{
		$condition = "AND l.App_Logs_TransAmmount='".$_GET['valro']."'";
	}
	if(isset($_GET['fComp']) && $_GET['fComp'] != "")
	{
		$fCompdate = date("Y-m-d", strtotime($_GET['fComp']) );
		$condition .= "AND l.App_Logs_TransDateTime like '%".$fCompdate."%'";
	}
	if(isset($_GET['comentarios']) && $_GET['comentarios'] != "")
	{
		$condition .= "AND l.App_Logs_Notes='".$_GET['comentarios']."'";
	}	
	if($condition == ""){
		$condition = "";
	}  																															
	
		$sql="select l.App_Logs_Id,l.App_Logs_DateTime,l.App_Logs_Answer,l.App_Logs_Contact,l.App_Logs_Type,l.App_Logs_TransAmmount,l.App_Logs_TransDateTime,l.App_Logs_Notes,a.App_Aux_text as respuesta,aa.App_Aux_text as contactto,aaa.App_Aux_text as telefono
							from App_Logs l 
							inner join App_Aux a ON l.App_Logs_Answer = a.App_Aux_value 
							inner join App_Aux aa ON l.App_Logs_Contact = aa.App_Aux_value
							inner join App_Aux aaa ON l.App_Logs_Type = aaa.App_Aux_value							
							where 1=1 $condition AND  App_Logs_OperationID = '".$_GET['operno']."' and a.App_Aux_field = 'Answer' and aa.App_Aux_field='Relation' and aaa.App_Aux_field='Tipo_Gestion' order by App_Logs_Id DESC LIMIT 0,$resultsPerPage";																																																					
				
		$result=mysql_query($sql);
				
	while($row=mysql_fetch_array($result))
	{ 				
		echo  '<tr>
					<td>'.date(DEFAULT_DATE_FORMAT,strtotime($row['App_Logs_DateTime'])).'</td>
					<td>'.$row['respuesta'].'</td>
					<td>'.$row['contactto'].'</td>
					<td>'.$row['telefono'].'</td>
					<td>'.$row['App_Logs_TransAmmount'].'</td>
					<td>'.date(DEFAULT_DATE_FORMAT,strtotime($row['App_Logs_TransDateTime'])).'</td>											
					<td>'.$row['App_Logs_Notes'].'</td>
				</tr>';
				
	}						
?>
