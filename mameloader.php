
<?php @require_once('mameloader_func.php'); ?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?php echo basename($machine); ?></title>
	</head>
	<body style="background: black; font-size:16px;">
		<canvas id="canvas" style="background-color: black; width: 50%; height: 50%; display: block; margin: 0 auto;"></canvas>
		<script type="text/javascript" src="vendor/emularity/es6-promise.js"></script>
		<script type="text/javascript" src="vendor/emularity/browserfs.min.js"></script>
		<script type="text/javascript" src="vendor/emularity/loader.js"></script>
		<script type="text/javascript">
			var machine = "<?php echo $machine ?>";
			var cliArgs = "<?php echo $cliArgs ?>";
			var emulator = new Emulator(document.querySelector("#canvas"),
							null,
							new MAMELoader(MAMELoader.driver("<?php echo basename($machine) ?>"),
							MAMELoader.nativeResolution(<?php echo "$resw,$resh" ?>),
							MAMELoader.scale(<?php echo $scale ?>),
							MAMELoader.keepAspect(1),
							MAMELoader.emulatorJS("binaries/machines/<?php echo $machine ?>.js"),
							MAMELoader.extraArgs(cliArgs.split(" ")),
							<?php peripheral($peripherals); ?>
							<?php mount_all($assets,"assets"); ?>
							<?php mount_all($roms,"binaries/roms"); ?>
							<?php mount_all($software,"binaries/software"); ?>
							<?php mount_all($softwarelist,"assets/hash"); ?>
							<?php mount_all($state,"binaries/state/" . basename($machine)); ?>
			));
			emulator.start({ waitAfterDownloading: false });

		</script>
		<?php require_once('debug.php'); ?>
	</body>
</html>
