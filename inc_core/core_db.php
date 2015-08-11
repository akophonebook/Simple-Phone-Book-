<?php

$server =  mysql_connect('localhost','root','34794');

(!$server) ? die('CHEKED SERVER OR MYSQL SERVER') : '';

$set_db =  mysql_select_db('phonebook');


(!$set_db) ? die('CHEKED DB OR TABLE') : '';
##############################################################################
function c2f($srting){
 
    $persiannumber = array("۱","۲","۳","۴","۵","۶","۷","۸","۹","۰");
	
	$ennumber      = array('1','2','3','4','5','6','7','8','9','0');
 
	$stringtemp    = str_replace($ennumber, $persiannumber,$srting );
	
	return $stringtemp;
	
	}
###############################################################################	
	if( $_GET['do']=='add' and !empty($_POST['cname'])  and !empty($_POST['tell']) ){
		
		
		$alllist = mysql_query("select * from contact where tell='".mysql_real_escape_string(trim($_POST['tell']))."' ");
		
		$maxrows = mysql_num_rows($alllist);
		
		 
/////////////////////////	
		if($maxrows<1){
		
	 
		
				if(mysql_query("
				insert into contact SET  
				cname='".$_POST['cname']."', 
				tell='".$_POST['tell']."', 
				gid='".intval($_POST['gid'])."', 
				mail='".$_POST['mail']."',
				site='".$_POST['site']."',
				fax='".$_POST['fax']."',
				disc='".$_POST['disc']."',
				reffrence = '".$_POST['reffrence']."',
				date_add=NOW()")){
					
				 echo  '<div class="msg">شماره تماس مورد نظر با موفقیت در سیستم ثبت گردید.</div>' ;
					
					}
		}
		
		else{
		
 
				echo  '<div class="ermsg">این شماره تلفن قبلا در سیستم ثبت گردیده است.</div>' ;
			
			}
		}
///////////////////////////
		
		
		
		
		 
		
		
		if(isset($_GET['do']) and ($_GET['do']=='dell') ){
			
			
			mysql_query("update contact SET trash='1' where cid='".intval($_GET['id'])."'");
			
			echo  '<div class="msg">شماره تماس مورد نظر با موفقیت از  سیستم حذف گردید.</div><meta content="5,index.php" http-equiv="refresh" />' ;
			
			
			}
			
			
			
			
		if( ($_GET['do']=='editsave') and !empty($_POST['cname'])  and !empty($_POST['tell']) ){
			
			
				if(mysql_query("
				update contact SET  				
				cname='".$_POST['cname']."', 
				tell='".$_POST['tell']."', 
				gid='".intval($_POST['gid'])."', 
				mail='".$_POST['mail']."',
				site='".$_POST['site']."',
				fax='".$_POST['fax']."',
				disc='".$_POST['disc']."',
				reffrence = '".$_POST['reffrence']."'			
				where cid='".intval($_GET['id'])."' ")){
			
			
			echo  '<div class="msg">شماره تماس مورد نظر با موفقیت در ویرایش گردید.</div> ' ;
			
			}
			
		}
			
		 
		