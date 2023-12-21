<?php
$machine = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_SPECIAL_CHARS);

# unsafe
isset($_GET['r']) ? $roms = $_GET['r'] : $roms = array() ;
isset($_GET['a']) ? $assets = $_GET['a'] : $assets = array();
isset($_GET['s']) ? $software = $_GET['s'] : $software = array();
isset($_GET['sl']) ? $softwarelist = $_GET['sl'] : $softwarelist = array();
isset($_GET['sc']) ? $scale = $_GET['sc'] : $scale = 3;
isset($_GET['rw']) ? $resw = $_GET['rw'] : $resw = 256;
isset($_GET['rh']) ? $resh = $_GET['rh'] : $resh = 224;
isset($_GET['p']) ? $peripherals = $_GET['p'] : $peripherals = array();
isset($_GET['cli']) ? $cli = $_GET['cli'] : $cli = array();

$cliDefaults = "-ui_active -lowlatency -nowaitvsync -nofilter -renderdriver opengles2";
$cliMerge = implode(" ", $cli);
$cliArgs = "$cliDefaults $cliMerge";

## mount
#
# mount an item into the emulator
#
function mount($name="nonlisted.zip",$path="assets") {
	echo('
		MAMELoader.mountFile("'.basename($name).'",
					MAMELoader.fetchFile("'.basename($name).'",
								"'.$path.'/'.$name.'")),
	    ');
}

## mount_all
#
# loop over an array of items to mount into the emulator
#
function mount_all($array, $path){
	if ( $array != NULL )
	{
		foreach ( $array as $item ) {
			mount($item, $path);
		}
	}
}

## peripheral
#
# attach items to slots based on array
# key = slot (i.e. cart)
# value = item
#
function peripheral($array) {
	if ( $array != NULL )
	{
		foreach ( $array as $key => $item ) {
			echo('MAMELoader.peripheral("'.$key.'","'.$item.'"),');
		}
	}
}

?>

