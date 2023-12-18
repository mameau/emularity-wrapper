
<?php @require_once('jsmame-load_func.php'); ?>

<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?php echo $machine ?></title>
  </head>
  <body style="background: black;">
    <canvas id="canvas" style="background-color: black; width: 50%; height: 50%; display: block; margin: 0 auto;"></canvas>
    <script type="text/javascript" src="emularity/es6-promise.js"></script>
    <script type="text/javascript" src="emularity/browserfs.min.js"></script>
    <script type="text/javascript" src="emularity/loader.js"></script>
    <script type="text/javascript">
      var cliArgs = "<?php echo $cliArgs ?>".split(" ");
      console.log(cliArgs);
      var emulator = new Emulator(document.querySelector("#canvas"),
              null,
              new JSMAMELoader(JSMAMELoader.driver("<?php echo $machine ?>"),
						  JSMAMELoader.nativeResolution(<?php echo "$resw,$resh" ?>),
						  JSMAMELoader.scale(<?php echo $scale ?>),
              JSMAMELoader.emulatorJS("binaries/machines/<?php echo $machine ?>.js"),
						  JSMAMELoader.extraArgs(cliArgs),
							<?php peripheral($peripherals); ?>
							<?php mount_all($assets,"assets"); ?>
							<?php mount_all($roms,"binaries/roms"); ?>
							<?php mount_all($software,"binaries/software"); ?>
							<?php mount_all($softwarelist,"assets/hash"); ?>
	    ));
      emulator.start({ waitAfterDownloading: false });
    </script>
  </body>
</html>
