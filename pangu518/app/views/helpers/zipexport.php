<?php 
/**
 * By Bytebee Stuido
 * wasenbr at gmail.com
 * http://www.bytebee.com
 *  
 */
class ZipexportHelper extends Helper {
	
	var $helpers = array();
	
    /**
     * set the header configuration
     * @param $filename the zip file name
     */
    function setHeader($filename)
    {
		
        header("Pragma: public");
	    header("Expires: 0");
	    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/zip");
	    header("Content-Type: application/download");;
	    header("Content-Disposition: attachment;filename=$filename");
	    header("Content-Transfer-Encoding: binary ");

		$this->bzip2('d:/pg_export_files/export.csv','d:/workspace4php/pangu518/app/webroot/test/test.bz2');
    }
    
	function bzip2($in, $out)
	{
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