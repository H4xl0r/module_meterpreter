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
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title>FruityWifi : Meterpreter</title>
<script src="../js/jquery.js"></script>
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css" />
<link rel="stylesheet" href="../css/style.css" />
<link rel="stylesheet" href="../../../style.css" />

<script>
$(function() {
    $( "#action" ).tabs();
    $( "#result" ).tabs();
});

</script>

</head>
<body>

<? include "../menu.php"; ?>

<br>

<?

include "_info_.php";
include "../../config/config.php";
include "../../login_check.php";
include "../../functions.php";

// Checking POST & GET variables...
if ($regex == 1) {
    regex_standard($_POST["newdata"], "msg.php", $regex_extra);
    regex_standard($_GET["logfile"], "msg.php", $regex_extra);
    regex_standard($_GET["action"], "msg.php", $regex_extra);
    regex_standard($_POST["service"], "msg.php", $regex_extra);
}

$newdata = $_POST['newdata'];
$logfile = $_GET["logfile"];
$action = $_GET["action"];
$tempname = $_GET["tempname"];
$service = $_POST["service"];


?>

<div class="rounded-top" align="left"> &nbsp; <b><?=$mod_alias?></b> </div>
<div class="rounded-bottom">

    &nbsp;version <?=$mod_version?><br>
    
    <?
    if (file_exists($payloc)){
        echo "&nbsp; $mod_alias  <font color='lime'><b>build</b></font><br>";
    } else { 
        echo "&nbsp; $mod_alias  <font color='red'><b>needs build</b></font><br>"; 
    }
    ?>

    <?
    if (file_exists($payloc)){
    $ismoduleup = exec($mod_isup);
    if ($ismoduleup != "") {
        echo "&nbsp;&nbsp;$mod_alias  <font color='lime'><b>enabled</b></font><br>";
    } else { 
        echo "&nbsp;&nbsp;$mod_alias  <font color='red'><b>disabled</b></font><br>"; 
     }
    }
    ?>

</div>

<br>


<div id="msg" style="font-size:largest;">
Loading, please wait...
</div>

<div id="body" style="display:none;">

    <div id="result" class="module">
        <ul>
            <li><a href="#result-1">Setup</a></li>
	        <li><a href="#result-2">Build</a></li>
	        <li><a href="#result-3">Execute</a></li>
            <li><a href="#result-4">About</a></li>
        </ul>
        <div id="result-1">
	    <form method="POST" autocomplete="off" action="includes/save.php">
        <div class="module-options">
		<h4>Setup</h4>
		<p>Basic Payload Settings</p>
                    <table>
                        <tr>
                            <td>Host: </td>
                            <td><input name="meterpreter_host" value="<?=$meterpreter_host?>"></td>
                        </tr>
                        <tr>
                            <td>Port: </td>
                            <td><input name="meterpreter_port" value="<?=$meterpreter_port?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="save">
                                <input name="type" type="hidden" value="settings">
                            </td>
                        </tr>
                    </table>
		</div> 
	    </form>
        </div>

	<!-- Build -->

        <div id="result-2" class="history">
        <div class="module-options">
        <form method="POST" autocomplete="off" action="includes/module_action.php">
		<h4>Build</h4>
		<p>Msfvenom is the combination of payload generation and encoding. <br>
		   It replaced msfpayload and msfencode on June 8th 2015.</p>
		<p>Generate preconfigured Payloads Here</p>
		<p>Generated Payload will be meterpreter_reverse_tcp (nonstager) !</p>
            <select name="payloadtype" id="payloadtype" required>
  			<option id="payloadtype" value="default" selected disabled>Select Payload Type</option>
  			<option id="payloadtype" value="python">Python Payload (.py)</option>
  			<option id="payloadtype" value="php">PHP Payload (.php)</option>
			<option id="payloadtype" value="app">APP Payload (.apk)</option>
  			<option id="payloadtype" value="exe">EXE Payload (.exe)</option>
			<option id="payloadtype" value="osx">OSX EXE (.bin)</option>

		    </select>
		    <? 
			$ismoduleup = exec($mod_building);
            		if ($ismoduleup != "") {
			echo "<button style='color:red' disabled>Build Running !</button>";
			}else{
			echo "<input name='action' type='hidden' value='build'>";
		    echo "<button type='submit' style='color:red;'>Build</button>";
			}
		     ?> 
            </form>
	    <? 
	    if (file_exists($payloc)){
	    echo "<form method='POST' autocomplete='off' action='includes/module_action.php'>";
	    echo "<br>";
		$ismoduleup = exec($mod_isup);
		if ($ismoduleup == "") {
        		echo "<input name='action' type='hidden' value='deletepayload'>";
        		echo "<button type='submit' style='color:red;'>Delete Payload</button>";   
         	}
	    echo "</form>";
	    echo "<br>";
	    echo "<a href='includes/builds/download.php'style='color:red;'><button>Download Payload</button></a>";	
        }
	    ?>             
	   </div>
        </div>
  
        <!-- END Build -->

	<!-- EXECUTE -->

        <div id="result-3" class="history">
	<div class='module-options'>
	<h4>Execute</h4>
	<p sytle='color:red;'>Local Payload Execution !</p>	
        <?
	if (file_exists($payloc)){
	echo "<p>Go On</p>";
	}else{
	echo "<p>Build First !</p>";
	}
	if (file_exists($payloc)){
 	    echo "<p>Execute Your Payload: <b> $payfile</b></p>";
	    echo "<p>Type: $paytype | Comp: $paycomp</p>";
	    echo "<form method='POST' autocomplete='off' action='includes/module_action.php'>";
	    if ($paycomp == "true"){
            echo "<input name='action' type='hidden' value='executepayload'>";
            echo "<button type='submit' style='color:red;'>Execute Payload</button>";     
      	    }else{
            echo "<button  style='color:red;' disabled>Payload not compatible !</button>"; 
	    }
	    echo "</form>";
	    
	    $ismoduleup = exec($mod_isup);
	    if ($ismoduleup != "") {
	    echo "<form method='POST' autocomplete='off' action='includes/module_action.php'>";
	    echo "<br>";
            echo "<input name='action' type='hidden' value='stoppayload'>";
            echo "<button type='submit' style='color:red;'>Stop Payload</button>";
            echo "</form>";
	    }
        }
	?>  


          </div>
        </div>

        <!-- END EXECUTE -->

        <!-- ABOUT -->

        <div id="result-4" class="history">
            <? include "includes/about.php"; ?>
        </div>

        <!-- END ABOUT -->
        
    </div>

    <div id="loading" class="ui-widget" style="width:100%;background-color:#000; padding-top:4px; padding-bottom:4px;color:#FFF">
        Loading...
    </div>

    <script>
    $('#formLogs').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#output').html('');
                $.each(data, function (index, value) {
                    $("#output").append( value ).append("\n");
                });
                
                $('#loading').hide();
            }
        });
        
        $('#output').html('');
        $('#loading').show()

    });

    $('#loading').hide();

    </script>

    <script>
    $('#form1').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#output').html('');
                $.each(data, function (index, value) {
                    if (value != "") {
                        $("#output").append( value ).append("\n");
                    }
                });
                
                $('#loading').hide();

            }
        });
        
        $('#output').html('');
        $('#loading').show()

    });

    $('#loading').hide();

    </script>

    <script>
    $('#formInject2').submit(function(event) {
        event.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'includes/ajax.php',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                console.log(data);

                $('#inject').html('');
                $.each(data, function (index, value) {
                    $("#inject").append( value ).append("\n");
                });
                
                $('#loading').hide();
                
            }
        });
        
        $('#output').html('');
        $('#loading').show()

    });

    $('#loading').hide();

    </script>

    <?
    if ($_GET["tab"] == 1) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 1 });";
        echo "</script>";
    } else if ($_GET["tab"] == 2) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 2 });";
        echo "</script>";
    } else if ($_GET["tab"] == 3) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 3 });";
        echo "</script>";
    } else if ($_GET["tab"] == 4) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 4 });";
        echo "</script>";
    } else if ($_GET["tab"] == 5) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 5 });";
        echo "</script>";
    } else if ($_GET["tab"] == 6) {
        echo "<script>";
        echo "$( '#result' ).tabs({ active: 6 });";
        echo "</script>";
    } 


    ?>

</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#body').show();
    $('#msg').hide();
});
</script>
</body>
</html>
