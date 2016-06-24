<?php include('web-config.php'); ?>
<?php
	if(isset($_POST['page'])):
		$paged=$_POST['page'];		
				
		$sql="select l.App_Logs_Id,l.App_Logs_DateTime,l.App_Logs_Answer,l.App_Logs_Contact,l.App_Logs_Type,l.App_Logs_TransAmmount,l.App_Logs_TransDateTime,l.App_Logs_Notes,a.App_Aux_text as respuesta,aa.App_Aux_text as contactto,aaa.App_Aux_text as telefono
				from App_Logs l 
				inner join App_Aux a ON l.App_Logs_Answer = a.App_Aux_value 
				inner join App_Aux aa ON l.App_Logs_Contact = aa.App_Aux_value
				inner join App_Aux aaa ON l.App_Logs_Type = aaa.App_Aux_value							
				where App_Logs_OperationID = '".$_POST['operno']."' and a.App_Aux_field = 'Answer' and aa.App_Aux_field='Relation' and aaa.App_Aux_field='Tipo_Gestion' order by App_Logs_Id DESC ";																										
					
		if($paged>0)
		{
		   $page_limit=$resultsPerPage*($paged-1);
		 
		   $pagination_sql=" LIMIT  $page_limit, $resultsPerPage";
		}
		else{
			$pagination_sql=" LIMIT 0 , $resultsPerPage";
		}
		
		
		$result=mysql_query($sql.$pagination_sql);

		$num_rows = mysql_num_rows($result);
		if($num_rows>0)
		{
			while($row=mysql_fetch_array($result))
			{
		?>
				<tr>
					<td><?php echo date(DEFAULT_DATE_FORMAT,strtotime($row['App_Logs_DateTime'])) ?></td>				 
					<td><?php echo $row['respuesta']; ?>	</td>
					<td><?php echo $row['contactto']; ?></td>
					<td><?php echo $row['telefono']; ?></td>
					<td><?php echo $row['App_Logs_TransAmmount']; ?></td>
					<td><?php echo date(DEFAULT_DATE_FORMAT,strtotime( $row['App_Logs_TransDateTime'])) ?></td>											
					<td><?php echo $row['App_Logs_Notes']; ?></td>
						<?php if(!empty($_SESSION["logged_in_user"]["App_Users_SecurityLevel"]) && $_SESSION["logged_in_user"]["App_Users_SecurityLevel"] >= 5  ) { ?>				  
							<td><a href="" data-toggle="modal" data-id="<?php echo $row['App_Logs_Id']  ?>" class="editactivity" >Edit</a></td>
						<?php } ?>				  				  
                </tr>
		<?php
			}
		}
		if($num_rows == $resultsPerPage){?>
			<button type="button" class="btn btn-info loadbutton"  data-page="<?php echo  $paged+1 ;?>" style="float:right; margin:20px;">Load More</button>			
<?php 
		}else{			
			echo "<li class='loadbutton'><h3>No More Feeds</h3></li>";
		}
		endif;
?>