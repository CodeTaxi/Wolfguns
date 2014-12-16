<?php
set_time_limit(0);

// load requirements:
require_once '../autoload.php';

/* ftp: */
$ftp_config = $config['ftp'];

// defaults:
$data = false;
$result = array();

// work:
try {
    $ftp_o = new Ftp();
    $ftp_o->connect($ftp_config['host']);
    $ftp_o->login($ftp_config['user'], $ftp_config['pass']);
    $ftp_o->pasv(true);

    // get data to memory:
    ob_start();
    $ftp_o->get("php://output", 'ftpdownloads/fulfillment-inv-new.txt', FTP_ASCII);
    $data = ob_get_contents();
    ob_end_clean();

    //echo 'completed download ..'."\n";
} catch (FtpException $e) {
    echo $e->getMessage() . "\n";
}

if($data) {
    $lines = explode(PHP_EOL, $data);
    foreach($lines as $l_no => $line) {
        if($l_no < 1) {
            $result[$l_no] = str_getcsv(trim($line), ';');
        }
    }
}

echo '<pre>';
print_r($result);