<?php
$config['smtp_host'] = 'smtp.newportconsultoria.com.br';
$config['smtp_port'] = 587;
$config['smtp_user'] = 'ti@newportconsultoria.com.br';
$config['smtp_pass'] = 'master2018';
$config['protocol']  = 'smtp';
$config['validate']  = TRUE;
$config['mailtype']  = 'html';
$config['charset']   = 'utf-8';
$config['newline']   = "\r\n";

//$this->load->library('email', $mail_config);

/*
$config[‘protocol’] = ‘smtp’;
$config[‘smtp_host’] = ‘smtp.office365.com’;
$config[‘smtp_user’] = ‘#######@######’;
$config[‘smtp_pass’] = ‘##############’;
$config[‘smtp_port’] = 587;
$config[‘smtp_timeout’] = 60;
$config[‘charset’] = ‘iso-8859-1’;
$config[‘smtp_crypto’] = ‘tls’;
$config[‘newline’] = “\r\n”;
$config[‘crlf’] = “\r\n”;
$config[‘mailtype’] = ‘html’;
$this->load->library(‘email’, $config);
*/