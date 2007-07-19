<?php
/*
   Copyright (c) 2001 Maxim Derkachev <kot@books.ru>
   This program is free software; you can redistribute it and/or
   modify it under the terms of the GNU Library General Public License, version 2, 
   or any later version, as published by the Free Software Foundation (http://www.gnu.org); 
   either under the terms of version 2.02 of the PHP license 
   (http://www.php.net/license/2_02.txt), at your choice.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.
   
*/
   
class GNUPG {
    /*
       string $recipient :  recipient's key ID. 
       string $my_key:	   default originator secret key. If empty, the first in the secret 
       			   keyring is used.
       string $gpghome:    The path to directory where personal gnupg files 
       			   (keyrings, etc) are stored (default: ~/.gnupg)
       string $gpgpath:    the path to gpg executable (default: /usr/local/bin/gpg)  
       string $tmpdir:     temp dir path. Encrypted data is temporarily stored here
       bool $have_recipient: do we have a recipient?
       string $error:	   misc. error and status messages

    */    
    var $recipient;			
    var $tmpdir = 'C:/DOCUME~1/ADMINI~1/LOCALS~1/Temp/';	
    var $gpghome = 'c:/gnupg';
    var $gpgpath = 'c:/gnupg/gpg';
    var $my_key;			

    var $have_recipient = false; 
    var $error;


    /* Constructor.
       $my_key, $gpghome, $gpgpath could be overriden here. $recipient could be provided.
    */   
    function GNUPG($recipient = '', $my_key = '', $gpghome = '', $gpgpath = '') {
	
	if($recipient = addslashes($recipient)) {
	    $this->recipient = $recipient;
	    $this->have_recipient = true;
	}
	
	if($my_key = addslashes($my_key)) {
	    $this->my_key = $my_key;
	}

	if($gpghome) {
	    $this->gpghome = $gpghome;
	}
	
	if($gpgpath = quotemeta($gpgpath)) {
	    $this->gpgpath = $gpgpath;
	}

    }
    

    /*
       mixed encrypt():
       string $msg: 		message to encrypt.
       bool $sign:		sign the message (true) or not (false)
       string $recipient:	may override recipient id provided with the constructor, if is set
       
       Returns false when failed, or encrypted message when (if) succeed.
       If failed, look at the $this->error for the reason.       
    */
    function encrypt($msg, $sign = false, $recipient ='') {
	if(!$this->have_recipient || $recipient) {
	    if($recipient && ($recipient = addslashes($recipient))) {
		$this->recipient = $recipient;
		$this->have_recipient = true;
	    }
	    else {
		$this->error = 'No recipient found';
		return false;
	    }
	}
	
	if(!$msg) {
	    $this->error = 'Nothing to encrypt';
	    return false;
	}
	
	$tmpfile = $this->tmpdir.md5(uniqid(microtime())).'.gpg';
	$cmd = "$this->gpgpath -e -a -q --batch --no-tty --homedir '$this->gpghome' -o '$tmpfile' -r '$this->recipient' --no-secmem-warning ";
	$cmd .= ($sign) ? ' -s ' : '';
	$cmd .= ($this->my_key) ? " --default-key '$this->my_key' " : '';
	$cmd .= ' 2>&1 ';

	$p = @popen($cmd, 'w');
	if(!$p) {
	    $this->error = 'Could not fork a pipe';
	    return false;
	}
	
	fwrite($p, $msg);
	pclose($p);

	$f = @fopen($tmpfile, 'r');
	if(!$f) {
	    $this->error = "Could not open file $tmpfile for reading";
	    return false;
	}
	$tmptext = '';
	while(!feof($f)) {
	    $tmptext .= fread($f, 2048);
	}
	fclose($f);
	unlink($tmpfile);

	$matches = array();
	$res = preg_match('/(-----BEGIN PGP MESSAGE-----.+-----END PGP MESSAGE-----)/s', $tmptext, $matches);
	
	if(!$res) {
	    $this->error = $tmptext;
	    return false;
	}
	
	return $matches[0];
    }
}
?>

