<?php
if(empty($_SERVER['PHP_AUTH_USER']) or  @$_SERVER['PHP_AUTH_USER'] != 'amertad' or @$_SERVER['PHP_AUTH_PW'] != '34794'  ){
@header('WWW-Authenticate: Basic realm=" MERLI Authentication "');
@header('HTTP/1.0 401 Unauthorized');
die('get away');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<title>دفترچه تلفن SEPCO</title>
<link rel="stylesheet" href="../css/style.css" media="screen" type="text/css" />
<script language="javascript" src="../css/jquery-1.9.1.min.js"></script>
<script language="javascript" src="../css/jquery.dataTables.js"></script>

</head>
<body>

 
<fieldset>
  <legend><a href="index.php">اضافه کردن شماره تلفن</a></legend>
  
  
<?php 
  
 error_reporting(0);
 
include_once('../inc_core/core_db.php');

$action = ($_GET['do']=='edit') ? 'index.php?do=editsave&id='.intval($_GET['id']).'' : 'index.php?do=add';

if($_GET['do']=='edit'){
	
list($cid, $cname, $tell, $gid, $disc, $date_add, $trash, $mail, $site, $fax, $reffrence) = mysql_fetch_array(mysql_query("select * from contact where cid='".intval($_GET['id'])."'"));
}
 
 
 
$all_cats = file_get_contents('../cats.mrm');
$all_cats_rec = explode("\n",$all_cats);
 


$selectds = "<select name='gid' >";
$index='';
foreach($all_cats_rec as $index=>$inselect){
	
	$cheksekected = ($index==$gid) ? 'selected="selected"' : '';
	$selectds .="<option value='".$index."' ".$cheksekected.">".$inselect."</option>";	
	$cat_title[$index] = $inselect;
	}
$selectds .= "</select>";

?>
  <form action="<?=$action?>" method="post">
    <table width="90%" border="0" align="center" cellspacing="2" cellpadding="2">
      <tr>
        <td align="center" valign="top" scope="col">نام و نام خانوادگی :
          <input value="<?=$cname?>" size="40" type="text" dir="rtl" name="cname"  /></td>
        <td align="center" valign="top" scope="col">شماره تماس :
          <input size="40" value="<?=$tell?>"  type="text" dir="ltr" name="tell" /></td>
        <td align="center" valign="top" scope="col">انتخاب گروه : <?php echo $selectds; ?></td>
		<tr>
		
		 <td align="center" valign="top" scope="col">ایمیل :
          <input value="<?=$mail?>" size="40" type="text" dir="rtl" name="mail"  /></td>
        <td align="center" valign="top" scope="col">فکس :
          <input size="40" value="<?=$fax?>"  type="text" dir="ltr" name="fax" /></td>
        <td align="center" valign="top" scope="col">وب سایت : 
		<input size="40" value="<?=$site?>"  type="text" dir="ltr" name="site" /></td>
		</tr>
		<tr>
		 <td align="center" valign="top" scope="col">مرجع/منبع :
          <input size="40" value="<?=$reffrence?>"  type="text"  name="reffrence" /></td>
		   <td align="center" valign="top" scope="col">توضیحات :
          <input size="40" value="<?=$disc?>"  type="text"  name="disc" /></td>
        <td align="center" valign="bottom" scope="col"><input type="submit" value="ثبت" /></td>
		<tr>
      </tr>
    </table>
  </form>
</fieldset>

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



<table cellspacing="1"   width="90%" class="tablesorter" id="allphonebook" >
  <thead>
    <th>#</th>
    <th>نام </th>
    <th>شماره تماس</th>
    <th>بخش</th>
	<th>فکس</th>
	<th>ایمیل</th>
	<th>سایت</th>
	<th>منبع/مرجع</th>
	<th>توضیحات</th>
    <th>ویرایش</th>
      </thead>
  <tbody>
    <?php



	
	$all_contact = mysql_query("select * from contact where trash='0' order by cid desc");
	
	


	if(mysql_num_rows($all_contact)>0)
	{
		
		 
		
		$rows .= 'تعداد کل رکوردهای ثبت شده : '.c2f( mysql_num_rows($all_contact) );
		
		
		 
	while(list($cid, $cname, $tell, $gid, $disc, $date_add, $trash, $mail, $site, $fax, $reffrence) = 
	mysql_fetch_array($all_contact) ){
		
		$rows .=' 
		<tr>
				<td>'. $cid.' </td>
				<td>'.$cname.'</td>
				<td><B>'.  $tell .'</B></td>
				<td>'. $cat_title[$gid] .'</td> 
				<td>'. $fax .'</td> 
				<td>'. $mail .'</td> 
				<td>'. $site .'</td> 
				<td>'. $reffrence .'</td>
				<td title="'.$disc.'">'. mb_substr($disc,0,53) .'</td>
				<td><a href="index.php?do=dell&id='.$cid.'">حذف</a> | <a href="index.php?do=edit&id='.$cid.'">ویرایش</a></td> 	
		</tr>';
		
		
		
		
		
		
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