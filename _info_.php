<?
$mod_name="meterpreter";
$mod_version="2.b";
$mod_path="/usr/share/fruitywifi/www/modules/$mod_name";
$mod_logs="$log_path/$mod_name.log"; 
$mod_logs_history="$mod_path/includes/logs/";
$mod_logs_panel="enabled";
$mod_panel="show";
$mod_type="service";
$mod_isup="ps auxww | grep -iEe 'payload' | grep -v -e grep";
$mod_building="ps auxww | grep -iEe 'msfvenom' | grep -v -e grep";
$mod_alias="Meterpreter";

# USER OPT
$meterpreter_host = "10.0.0.1";
$meterpreter_port = "666";
$payfile = "payload.bin";
$payloc = "$mod_path/includes/builds/$payfile";
$paytype = "bin";
$paycomp = "false";


# EXEC
$bin_sudo = "/usr/bin/sudo";
$bin_msfvenom = "/usr/bin/msfvenom";
$bin_sh = "/bin/sh";
$bin_echo = "/bin_echo";
$bin_killall = "/usr/bin/killall";
$bin_cp = "/bin/cp";
$bin_chmod = "/bin/chmod";
$bin_sed = "/bin/sed";
$bin_rm = "/bin/rm";
$bin_kill = "/bin/kill";
?>
