<?php
class AppController extends Controller {
	
	/*  主体：0:无效 1:公司 2:会员 3:工作站 4:会员消费单位*/
	var $_company = 1;
	var $_user = 2;
	var $_workstation = 3;
	var $_merchant = 4;


	function bzip2($in, $out){
	   if (!file_exists ($in) || !is_readable ($in))
		   return false;
	   if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
		   return false;
	   
	   $in_file = fopen ($in, "r");
	   $out_file = bzopen($out, "w");
	   
	   while (!feof ($in_file)) {
		   $buffer = fgets ($in_file, 4096);
			 bzwrite ($out_file, $buffer, 4096);
	   }

	   fclose ($in_file);
	   bzclose ($out_file);
	   
	   return true;
	}
	
}
?>