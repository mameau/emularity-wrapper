<?php @require_once('mameloader_func.php'); ?>

<html>
	<head>
		<link href="debug.css" rel="stylesheet" />
		<link href="vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
	</head>
	<body>
		<div id="menu">	
			<ul class="menu">
				<li class="item"><a href="index.php" title="Home"><i class="las la-home"></i> Menu</a></li>
				<li class="item"><a onclick="location.reload();" href="javascript:void(0);" title="Reload"><i class="las la-redo-alt"></i> Reload Page</a></li>
				<li class="item"><a onclick="JSMAME.soft_reset();" href="javascript:void(0);" title="Reset Machine (Soft)"><i class="las la-sync-alt"></i> Reset Machine (Soft)</a></li>
				<li class="item"><a onclick="JSMAME.save('<?php echo $machine ?>')" href="javascript:void(0);" title="Save State"><i class="las la-save"></i> Save State</a></li>
				<li class="item"><a onclick="JSMAME.load('<?php echo $machine ?>')" href="javascript:void(0);" title="Load State"><i class="las la-door-open"></i> Load State</a></li>
				<li class="item"><a onclick="dumpState()" href="javascript:void(0);" title="Dump State (no custom state folder)"><i class="las la-folder-open"></i> Dump State</a></li>
				<li class="item"><label for="state-upload"><i class="las la-file-import" title="Import State (no custom state folder)"></i></label><input id="state-upload" class="upload" type="file" onchange="uploadFile('sta', true, 'state')"/> Import State</li>
				<li class="item"><label for="software-upload"><i class="las la-file-upload" title="Upload Software"></i></label><input id="software-upload" class="upload" type="file" onchange="uploadFile()"/> Upload Software</li>
				<li class="item"><a onclick="toggleFullScreen()" href="javascript:void(0);" title="Toggle Fullscreen"><i class="las la-expand"></i> Toggle Fullscreen</a></li>
				<li class="item"><a onclick="toggleMute()" href="javascript:void(0);" title="Mute"><i class="las la-volume-up"></i> Toggle Audio</a></li>
			</ul>
			<ul class="menu debug">
				<li class="item"><a onclick="toggleFPS()" href="javascript:void(0);" title="Toggle FPS"><i class="las la-infinity"></i> Toggle FPS Display</a></li>
				<li class="item"><a onclick="getDirectory('/')" href="javascript:void(0);" title="DumpFS"><i class="las la-folder-open"></i> Dump Internal FS</a></li>
				<li class="item"><a onclick="dumpCLI()" href="javascript:void(0);" title="Dump CLI"><i class="las la-terminal"></i> Dump CLI</a></li>
				<li class="item"><a onclick="dumpObj()" href="javascript:void(0);" title="Dump Objects"><i class="las la-object-group"></i> Dump Objects</a></li>
				<!--  Broken Options, either doesn't work or breaks machine in browser
				<li class="item"><a onclick="createNVRAM()" href="javascript:void(0);" title="Create NVRAM"><i class="las la-microchip"></i></a></li>
				<li class="item"><a onclick="JSMAME.hard_reset();" href="javascript:void(0);" title="Reset Machine (Hard)"><i class="las la-sync-alt"></i></a></li>
				-->

			</ul>
		</div>
		<div id="states" style="display: none;"></div>
		<script type="text/javascript">
			var machine = "<?php echo $machine ?>";
			var cliArgs = "<?php echo $cliArgs ?>";

			function createNVRAM(dir='nvram') {
				FS.createPath(FS.root, dir, true, true);
				FS.createPath(dir, machine, true, true);
			}

			// dump some of our objects to the console
			function dumpObj() {
				console.log(emulator);
				console.log(MAMELoader);
				console.log(window);
			}

			// recurse directories
			function getDirectory(path, files=[]) {
				//console.log("[I] " + path);
				var sessionFS = window.FS.readdir(path);
				if ( sessionFS !== 'undefined' ) {
					sessionFS.forEach((element) => {
						if ( path === '/' ) {
							var abs = path +  element;
						} else {
							var abs = path + '/' + element;
						}
						if ( element !== '..' && element !== '.' && element !== 'dev' && element !== 'proc' ) {
							//console.log("[A] " + abs);
							try {
								if ( window.FS.readdir(abs) !== 'undefined' ) {
									console.log("[D] " + element);
									files = getDirectory(abs, files);
								}
							} catch {
								console.log("[F] " + abs);
								files.push(abs);
							}
						}
					});
				}
				return files;
			};

			// toggle fullscreen
			function toggleFullScreen() {
				emulator.requestFullScreen();
			}

			// download a file to local user
			// https://forums.overclockers.com.au/posts/18652688/
			function dumpFile(abs) {
			var bytes = window.FS.readFile(abs);
			var saveByteArray = (function () {
				var a = document.createElement("a");
				document.body.appendChild(a);
				a.style = "display: none";
				return function (data, name) {
				var blob = new Blob(data, {type: "octet/stream"}),
				url = window.URL.createObjectURL(blob);
				a.href = url;
				a.download = name;
				a.click();
				window.URL.revokeObjectURL(url);
				};
			}());
			saveByteArray([bytes],basename(abs));
			}

			// simple basename function
			function basename(path) {
				return path.split('/').reverse()[0];
			}

			// dump the cli to the console
			function dumpCLI() {
				console.log(cliArgs);
			}

			// we need to find the nvram for this to be useful
			function dumpNVRAM(path) {
				var sessionFS = window.FS.readdir(path);
				sessionFS.forEach((element) => console.log(element));
			};

			// dump the state files for the user to download
			function dumpState(dir='sta') {

				try {
					var stateFS = getDirectory(dir);
					var staOpts = [];
					stateFS.forEach((element) => {
						if ( element !== '..' && element !== '.' && element.match(/.*\.sta$/) != 'null' ) {
							staOpts.push(element);
						}
					});

					var states = document.getElementById('states');
					states.innerHTML = "";
						staOpts.forEach((element) => {
							var aTag = document.createElement('a');
							aTag.setAttribute('href',"javascript:void(0);");
							aTag.setAttribute('title',basename(element));
							aTag.addEventListener('click',function(event) {
								dumpFile(element)
								states.style.display = "none";
								// Prevent the default behavior (in this case, following the link)
								event.preventDefault();
							});
							aTag.innerHTML = '<i class="las la-file-export">';
							states.appendChild(aTag);
							states.style.display = "block";
						});
				} catch {
					alert("save state not found");
				}
			};

			// upload a file into local storage
			function uploadFile(dir="emulator", makeMachine=false, id="software") {
				const file = document.getElementById(id + "-upload").files[0];
				const reader = new FileReader();

				if (file) {
					reader.readAsArrayBuffer(file);

					var sta = FS.createPath(FS.root,dir);
					var destfile = dir + '/' + file.name;

					if ( makeMachine ) {
						destfile = dir + '/' + machine + '/' + file.name;
						FS.createPath(sta,machine);
					}
					Buffer = BrowserFS.BFSRequire('buffer').Buffer;
					reader.addEventListener('loadend', function(e) {
						data = e.target.result;
						FS.writeFile(destfile,new Buffer(data));
						console.log(destfile);
					});
				} else {
					alert("Upload failed");
				}
			};

			// creates the /nvram/machine structure and symlinks nvram files from /emulator
			// MAME does not read these NV ram file (x86/wasm incompat? or requires hard reset 
			// which is broken atm)
			function createNVRAM(dir='nvram') {
				console.log(dir + " creation");
				var base = FS.createPath(FS.root,dir);
				FS.createPath(base,machine);
				var machinebase = base + '/' + machine;

				<?php echo "var nvram = ". json_encode($nvram) . ";\n"; ?>
				for ( item in nvram ) {
						value = nvram[item];
						FS.symlink('/emulator/' + value, machinebase + '/' + value);
						console.log(machinebase + '/' + value);
				}
			}

			function toggleFPS() {
				const ui = JSMAME.get_ui();
				var fpsState = JSMAME.ui_get_show_fps(ui);
				if ( fpsState ) {
					JSMAME.ui_set_show_fps(ui,0);
				} else {
					JSMAME.ui_set_show_fps(ui,1);
				}
			}

			function toggleMute() {
				emulator.toggleMute()
			}
		</script>
	</body>
</html>
