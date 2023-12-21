
<?php @require_once('mameloader_func.php'); ?>

<html>
  <head>
	<link href="debug.css" rel="stylesheet" />
	<link href="vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css" rel="stylesheet" />
  </head>
  <body>
    <div id="menu">	
	<ul class="menu">
		<li class="item"><a href="index.php" title="Home"><i class="las la-home"></i></a></li>
		<li class="item"><a onclick="location.reload();" href="javascript:void(0);" title="Reload"><i class="las la-redo-alt"></i></a></li>
		<li class="item"><a onclick="dumpState()" href="javascript:void(0);" title="Dump State"><i class="las la-save"></i></a></li>
    		<li class="item"><label for="state-upload"><i class="las la-upload"></i></label><input id="state-upload" type="file" onchange="uploadState()" title="Upload State"/></li>
		<li class="item"><a onclick="toggleFullScreen()" href="javascript:void(0);" title="Fullscreen"><i class="las la-expand"></i></a></li>
		<li class="item"><a onclick="emulator.toggleMute()" href="javascript:void(0);" title="Mute"><i class="las la-volume-mute"></i></a></li>
	</ul>
	<ul class="menu debug">
		<li class="item"><a onclick="getDirectory('/')" href="javascript:void(0);" title="DumpFS"><i class="las la-folder-open"></i></a></li>
		<li class="item"><a onclick="dumpCLI()" href="javascript:void(0);" title="Dump CLI"><i class="las la-terminal"></i></a></li>
		<li class="item"><a onclick="dumpObj()" href="javascript:void(0);" title="Dump Objects"><i class="las la-object-group"></i></a></li>
		<!-- <li class="item"><a onclick="createNVRAM()" href="javascript:void(0);" title="Create NVRAM"><i class="las la-microchip"></i></a></li> -->
	</ul>
    </div>
    <div id="states"></div>
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
		      	      var abs = path + '/' + element;
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
	saveByteArray([bytes],machine+"_"+basename(abs));
      }

      // simple basename funciton
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
			    // Prevent the default behavior (in this case, following the link)
			    event.preventDefault();
			});
			aTag.innerHTML = '<i class="las la-file">';
			states.appendChild(aTag);
		      });
	      } catch {
			alert("save state not found");
	      }

      };

	function uploadState() {
	  const file = document.querySelector("input[type=file]").files[0];
	  const reader = new FileReader();

	  if (file) {
		  reader.readAsArrayBuffer(file);
		  var sta = FS.createPath(FS.root,'sta');
		  destfile = 'sta/' + machine + '/' + file.name;
		  FS.createPath(sta,machine);

		  Buffer = BrowserFS.BFSRequire('buffer').Buffer;
		  reader.addEventListener('loadend', function(e) {
		 	data = e.target.result;
			FS.writeFile(destfile,new Buffer(data));
		  });

		  
	  }
	};


    </script>
  </body>
</html>