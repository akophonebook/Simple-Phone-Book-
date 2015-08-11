<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>دفترچه تلفن SEPCO</title>
<link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
<script language="javascript" src="css/jquery-1.9.1.min.js"></script>
<script language="javascript" src="css/jquery.dataTables.js"></script>

</head>
<body>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				
				
				 
	
				$('#allphonebook').dataTable(
				{
		"bPaginate": false,
		"bLengthChange": true,
		"bFilter": true,
		"bSort": true,
		"bInfo": false,
		"bAutoWidth": false,
		"sSearchStr":'جستجو'				
				});
				 
			} );
		</script>
<!-- form method="post">
  جستجو :
  <input name="q" type="text" value="<?php /*echo isset($_POST['q']) ? strip_tags($_POST['q']) : ''ک */ ?>" />
  <input type="submit" value="بگرد!" />
</form -->
<fieldset>
  <legend><a href="index.php">راهنمای تلفن تماس</a></legend>
 <?php 
error_reporting(0);
 
include_once('inc_core/core_db.php');

$all_cats = file_get_contents('./cats.mrm');
$all_cats_rec = explode("\n",$all_cats);
 
 
 
foreach($all_cats_rec as $index=>$inselect){
	
	 $cat_title[$index] = $inselect;
	 
	 	
	}
 

?>

 
  
<table cellspacing="1" width="100%"  class="display tablesorter" id="allphonebook" >
 <thead> 
<tr> 
  
    <th># </th>
    <th>نام </th>
    <th>شماره تماس</th>
    <th>بخش</th>
	<th>فکس</th>
	<th>ایمیل</th>
	<th>سایت</th>
	<th>منبع/مرجع</th>
	<th>توضیحات</th>
  
     </tr>
     </thead> 
	<tbody> 
    <?php


if(isset($_POST['q']) and !empty($_POST['q'])){
 
 $q = mysql_real_escape_string($_POST['q']);
 
 
$all_contact = mysql_query("select * from contact where trash='0' and ( cname like '%$q%' or tell like '%$q%' )order by gid asc");
}
else{
	
	$all_contact = mysql_query("select * from contact where trash='0' order by cid desc");
	
	}

$counter = 1;
	if(mysql_num_rows($all_contact)>0)
	{
		
		 
	//cid, cname, tell, gid, disc, date_add, trash, mail, site, fax, reffrence	 
	while(list($cid, $cname, $tell, $gid, $disc, $date_add, $trash, $mail, $site, $fax, $reffrence) = mysql_fetch_array($all_contact)){
		
		$rows .='
		<tr>
				<td>'.$counter.' ( '.$cid.' )</td>
				<td>'.$cname.'</td>
				<td><B>'.$tell.'</B></td>
				<td>'. $cat_title[$gid] .'</td> 
				<td>'. $fax .'</td> 
				<td>'. $mail .'</td> 
				<td>'. $site .'</td> 
				<td>'. $reffrence .'</td>
				<td title="'.$disc.'">'. mb_substr($disc,0,53) .'</td> 	
		</tr>';
		$counter++;
		
		}
	}
	else{
		
		$rows = "<tr><td colspan=\"5\">رکوردی یافت نگردید...!!</td></tr>";
		
		}
	echo $rows;

?>
  </tbody>
</table>
</body>
</html>