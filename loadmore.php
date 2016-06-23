<?php include('config.php'); ?>
<?php
	if(isset($_POST['page'])):
 	$paged=$_POST['page'];
	$sql="SELECT * FROM `news_feed`ORDER BY `news_feed`.`news_id` ASC";
	if($paged>0){
	       $page_limit=$resultsPerPage*($paged-1);
	       $pagination_sql=" LIMIT  $page_limit, $resultsPerPage";
	       }
	else{
	$pagination_sql=" LIMIT 0 , $resultsPerPage";
	}

	$result=mysql_query($sql.$pagination_sql);

	$num_rows = mysql_num_rows($result);
	if($num_rows>0){
	while($data=mysql_fetch_array($result)){
	$title=$data['news_title'];
	$content=$data['news_description'];
	echo "<li><h3>$title</h3><p>$content<p></li>";
	}
	}
	if($num_rows == $resultsPerPage){?>
 	<li class="loadbutton"><button class="loadmore" data-page="<?php echo  $paged+1 ;?>">Load More</button></li>
 <?php 
  }else{
  	echo "<li class='loadbutton'><h3>No More Feeds</h3></li>";
 }
  endif;
   ?>