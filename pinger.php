#!/usr/bin/php
<?php
// thx for :  https://stackoverflow.com/questions/9841635/how-can-i-ping-a-server-port-with-php
$fileloc = "./iplist.ini";
function getList_ip($file_ini){
    $data = parse_ini_file($file_ini, true);
    // $data = json_encode($rawdata);
    return $data;
}
function pinger($list){

    $wait = 10; // wait Timeout In Seconds
    // var_dump($list);
    echo "----------------------------------------------\n";
    echo "| \t \t \t \t \t \t \t \t \t \t\t | \n";
    echo "|\t \t \t port pinger php \t \t\t \t |\n";
    echo "| \t \t \t \t \t \t \t \t \t \t\t | \n";
    echo "----------------------------------------------\n";
    // exit();
    $x = 0;
    foreach ($list as $key => $thisHost) {
        $thisports[$x] = $thisHost['port'];
        $thisHosts[$x] = $key;
        $thisIpaddress[$x] = $thisHost['ip'];
        $pecah_port[$x] = array_map('intval', explode(',', $thisports[$x]));

        $x++;
    }
    for ($a = 0; $a < sizeof($pecah_port); $a++) {
        # code...
        for ($i = 0; $i < sizeof($pecah_port[$a]); $i++) {
            # code...
            $fp = @fsockopen("tcp://" . $thisIpaddress[$a], $pecah_port[$a][$i], $errCode, $errStr, $wait);
            // var_dump($fp);
            if (!$fp) {
                # code...
                echo "Ping " . $thisIpaddress[$a] . ":" . $pecah_port[$a][$i] . " result : code : $errCode - $errStr\n";

            } else {
                # code...
                echo "Ping " . $thisIpaddress[$a] . ":" . $pecah_port[$a][$i] . " result : done \n";
                fclose($fp);
            }
        }
    }
}

$listHost = getList_ip($fileloc);
$listHost2 = pinger($listHost);
