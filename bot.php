<?php

$hitam="\033[0;30m"; $abu2="\033[1;30m";               $putih="\033[0;37m"; $putih2="\033[1;37m";$merah="\033[0;31m"; $merah2="\033[1;31m";             $hijau="\033[0;32m"; $hijau2="\033[1;32m";$kuning="\033[0;33m"; $kuning2="\033[1;33m";           $biru="\033[0;34m"; $biru2="\033[1;34m";$ungu="\033[0;35m"; $purple2="\033[1;35m";             $lblue="\033[0;36m"; $lblue2="\033[1;36m";                                                       $putih1="\033[7;37m";$merah1="\033[7;31m";                                  $hijau1="\033[7;32m";$kuning1="\033[7;33m";$biru1="\033[7;34m";                                   $ungu1="\033[7;35m";$lblue1="\033[7;36m";


include("@iamtubasya");

function menu(){
$pkey=file_get_contents("privatekey.txt");
$pkey=explode("\n",$pkey);
$pkey=count($pkey)-1;

$prox=file_get_contents("proxyuser.txt");
$prox=explode("\n",$prox);
$prox=count($prox)-1;
$hitam="\033[0;30m"; $abu2="\033[1;30m";               $putih="\033[0;37m"; $putih2="\033[1;37m";$merah="\033[0;31m"; $merah2="\033[1;31m";             $hijau="\033[0;32m"; $hijau2="\033[1;32m";$kuning="\033[0;33m"; $kuning2="\033[1;33m";           $biru="\033[0;34m"; $biru2="\033[1;34m";$ungu="\033[0;35m"; $purple2="\033[1;35m";             $lblue="\033[0;36m"; $lblue2="\033[1;36m";                                                       $putih1="\033[7;37m";$merah1="\033[7;31m";                                  $hijau1="\033[7;32m";$kuning1="\033[7;33m";$biru1="\033[7;34m";                                   $ungu1="\033[7;35m";$lblue1="\033[7;36m";
system("clear");
echo banner()."\n";;
    echo $putih2.$lblue1." • Dasboard • $hitam   ".$putih2.$kuning1." PrivateKey : $pkey | Proxy : $prox $hitam \n\n";

    echo $putih2.$putih1." 1 ".$hitam." ".$putih2.$hijau1." Start Session ".$hitam."       ";
    echo $putih2.$putih1." 4 ".$hitam." ".$putih2.$hijau1." Replace Privatekey ".$hitam."\n\n";
    echo $putih2.$putih1." 2 ".$hitam." ".$putih2.$hijau1." Add Proxy ".$hitam."           ";
    echo $putih2.$putih1." 5 ".$hitam." ".$putih2.$hijau1." Delete allProxy ".$hitam."\n\n";
    echo $putih2.$putih1." 3 ".$hitam." ".$putih2.$hijau1." Add your Address ".$hitam."    ";
    echo $putih2.$putih1." 0 ".$hitam." ".$putih2.$merah1." Exit ".$hitam;
    echo $putih2."\n\n Pilih : ";
}


function dashboard(){

$hitam="\033[0;30m"; $abu2="\033[1;30m";               $putih="\033[0;37m"; $putih2="\033[1;37m";$merah="\033[0;31m"; $merah2="\033[1;31m";             $hijau="\033[0;32m"; $hijau2="\033[1;32m";$kuning="\033[0;33m"; $kuning2="\033[1;33m";           $biru="\033[0;34m"; $biru2="\033[1;34m";$ungu="\033[0;35m"; $purple2="\033[1;35m";             $lblue="\033[0;36m"; $lblue2="\033[1;36m";                                                       $putih1="\033[7;37m";$merah1="\033[7;31m";                                  $hijau1="\033[7;32m";$kuning1="\033[7;33m";$biru1="\033[7;34m";                                   $ungu1="\033[7;35m";$lblue1="\033[7;36m";

menu();
$pilih=trim(fgets(STDIN));

if($pilih==0){
exit;
}
if($pilih==1){
gassesi();
}
if($pilih==2){
addproxy();
}
if($pilih==3){
addaddr();
}
if($pilih==4){

privatekey();

}
if($pilih==5){

delprox();

}

else{

dashboard();

}

}




function gassesi(){

    $proxy = file_get_contents("proxyuser.txt");
    $proxy = explode("\n", trim($proxy));
    $proxy = count($proxy);

    if ($proxy > 3) {

        $pkey = file_get_contents("privatekey.txt");
        $pkey = explode("\n", trim($pkey));
        $pkey = count($pkey);

        if ($pkey > 3) {

$s=1;
echo "\n";
while(true){

echo $kuning2."\r START SESSION $s%"; usleep(25000);
$s++;

if($s==100){
break;
}

}
system("xdg-open https://x.com/intent/user?screen_name=chiperflux"); sleep(5);
            startbot();

        } else {
            dashboard();
        }

    } else {

        dashboard();
    }
}


function addproxy(){
global $putih2; global $kuning2;
    echo $putih2."\n Paste proxy lalu -> CTRL+D / enter \n";

    $buffer = "";
    while (($line = fgets(STDIN)) !== false) {

        $line = trim($line, " \t\n\r\0\x0B");

        if ($line === '') continue;

        $buffer .= $line . PHP_EOL;
    }

    $old = file_get_contents("proxyuser.txt");

    file_put_contents("proxyuser.txt", $old . $buffer);


    $s = 1;
    echo "\n";
    while(true){

        echo $kuning2."\r Add proxy $s%";
        usleep(30000);
        $s++;

        if($s == 100){
            break;
        }
    }

    echo $hijau2."\r Proxy telah di tambahkan!";
    sleep(2);
system("clear"); echo banner(); echo $kuning2."\n\n   SILAKAN STATR ULANG BOT -> php bot.php\n\n";       

exit;
}




function addaddr(){
echo $putih2."\n Paste address : ";
$addr=trim(fgets(STDIN));

if (strlen($addr) < 20) {
    $addr="0x05084a4629eda1429114e2fd332a60f6b5e95342";

}

$sj=file_get_contents("sendrep.js");
$save=str_replace("0x05084a4629eda1429114e2fd332a60f6b5e95342",$addr,$sj);
file_put_contents("send.js",$save);


$s=1;
echo "\n";
while(true){

echo $kuning2."\r Add address $s%"; usleep(30000);
$s++;

if($s==100){
break;
}

}

echo $hijau2."\r Address telah di tambahkan!"; sleep(2); dashboard();

}


function privatekey(){
global $kuning2; global $hijau2; global $putih2;
echo $putih2."\n Paste Pharse : ";
$pharse=trim(fgets(STDIN));
$save=file_get_contents("generatepkey.js");
$save=str_replace("REPLACEPHARSE",$pharse,$save);
file_put_contents("generateprivatekey.js",$save);

system("node generateprivatekey.js");

sleep(2);

dashboard();


}



function delprox(){
global $kuning2; global $hijau2;
echo $putih2."\n Hapus seluruh proxy, y/n? : ";
$pil=trim(fgets(STDIN));

if($pil=="y"){
system("rm proxyuser.txt");
file_put_contents("proxyuser.txt","");
$s=1;
echo "\n";
while(true){

echo $kuning2."\r Hapus proxy $s%"; usleep(30000);
$s++;

if($s==100){
break;
}

}

echo $hijau2."\r Seluruh proxy telah di hapus!"; sleep(2); dashboard();

}

if($pil=="n"){

dashboard();

}



}

dashboard();
