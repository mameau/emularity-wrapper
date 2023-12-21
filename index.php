<?php ?>

<html lang="en">
<head>
<title>games.retro</title>
<link href="index.css" rel="stylesheet" />
</head>

<body>
<div>
<h1>Arcade</h1>
<a href="mameloader.php?m=puckman&r[]=puckman.zip&rh=288&rw=224">Puck-Man</a><br />
<a href="mameloader.php?m=blktiger&r[]=blktiger.zip&rh=224&rw=256">Black Tiger</a><br />
<a href="mameloader.php?m=1943&r[]=1943.zip&rh=256&rw=224">1943</a><br />
<a href="mameloader.php?m=daytona&r[]=daytona.zip&r[]=model1io.zip&cli[]=-nvram_directory /emulator&rw=496&rh=384&sc=2">Daytona USA</a><br />
<a href="mameloader.php?m=zerogun&r[]=zerogun.zip&r[]=segabill.zip&cli[]=-nvram_directory /emulator&rw=496&rh=384&sc=2">Zero Gunner</a><br />
<a href="mameloader.php?m=vr&r[]=vr.zip&r[]=m1comm.zip&r[]=model1io.zip&rw=496&rh=384&sc=2">Virtua Racing</a> (rendering issues)<br />
</div>

<div>
<h1>Colecovision</h1>
<a href="mameloader.php?m=coleco&r[]=coleco.zip">ColecoVision</a><br />
<a href="mameloader.php?m=coleco&r[]=coleco.zip&s[]=coleco/dkong.zip&p[cart]=dkong.zip">Donkey Kong</a><br />
<a href="mameloader.php?m=coleco&r[]=coleco.zip&s[]=coleco/dkongjr.zip&p[cart]=dkongjr.zip">Donkey Kong Jr.</a><br />
</div>

<div>
<h1>Commodore 64</h1>
<a href="mameloader.php?m=c64p&r[]=c64.zip&r[]=c1541.zip">Commodore 64 (PAL)</a><br />
<a href="mameloader.php?m=c64p&r[]=c64.zip&r[]=c1541.zip&s[]=c64/wizballo.zip&p[cass]=wizballo.zip&a[]=autoboot/c64p_wizballo.lua&cli[]=-autoboot_script emulator/c64p_wizballo.lua -autoboot_delay 3">Wizball</a><br />
</div>

<div>
<h1>Sony PlayStation</h1>
<a href="mameloader.php?m=psu&r[]=psu.zip&r[]=psx_cd.zip">Sony PlayStation (USA)</a><br />
<a href="mameloader.php?m=psu&r[]=psu.zip&r[]=psx_cd.zip&s[]=psx/thps2/tony hawk's pro skater 2 (usa).chd&p[cdrm]=tony hawk's pro skater 2 (usa).chd&rw=640&rh=480&sc=1.5">Tony Hawk's Pro Skater 2</a><br />
</div>

<div>
<h1>SEGA Master System</h1>
<a href="mameloader.php?m=sms&r[]=sms.zip?rw=268&rh=224">SEGA Master System</a><br />
<a href="mameloader.php?m=sms&r[]=sms.zip&s[]=sms/fantzone.zip&p[cart]=fantzone.zip&rw=268&rh=224">Fantasy Zone</a><br />
</div>

<div>
<h1>SEGA Mega Drive</h1>
<a href="mameloader.php?m=megadriv&rw=320&rh=224&sc=3">SEGA Mega Drive</a><br />
<a href="mameloader.php?m=megadriv&s[]=megadriv/wiznliz.zip&p[cart]=wiznliz.zip&rw=320&rh=224&sc=3">Wiz 'n' Liz</a><br />
</div>

<div>
<h1>IBM PC</h1>
<a href="mameloader.php?m=ct486&r[]=ct486.zip&r[]=at_keybc.zip&r[]=kb_ms_natural.zip&r[]=et4000.zip&rw=720&rh=400&sc=2">ct486</a><br />
</div>

<div>
<h1>Apple II/GS</h1>
<a href="mameloader.php?m=apple2gs&r[]=apple2gs.zip">Apple II/GS</a><br />
<a href="mameloader.php?m=apple2gs&r[]=apple2gs.zip&sl[]=apple2gs_flop_orig.xml&sl[]=apple2_flop_orig.xml&s[]=apple2_flop_orig/thexd15.zip&cli[]=thexd15 -hashpath /emulator -rompath /emulator&rw=256&rh=240&sc=3">Thexder</a> (Software List)<br />
<a href="mameloader.php?m=apple2gs&r[]=apple2gs.zip&sl[]=apple2gs_flop_orig.xml&sl[]=apple2_flop_orig.xml&s[]=apple2_flop_orig/marble.zip&cli[]=marble -hashpath /emulator -rompath /emulator&rw=256&rh=240&sc=3">Marble Madness</a> (Software List)<br />
</div>

<div>
<h1>Nintendo GameBoy Advance</h1>
<a href="mameloader.php?m=gba&r[]=gba.zip&rw=240&rh=160&sc=4">Nintendo GameBoy Advance</a><br />
<a href="mameloader.php?m=gba&r[]=gba.zip&s[]=gba/thps2.zip&p[cart]=thps2.zip&rw=240&rh=160&sc=4">Tony Hawk's Pro Skater</a><br />
</div>

<div>
<h1>Nintendo Entertainment System</h1>
<a href="mameloader.php?m=nes&rw=256&rh=240">Nintendo Entertainment System</a><br />
<a href="mameloader.php?m=nes&s[]=nes/smb3.zip&sl[]=nes.xml&cli[]=-cart smb3 -hashpath /emulator -rompath /emulator&rw=256&rh=240">Super Mario Bros. 3</a> (Software List)<br />
</div>

<div>
<h1>Super Nintendo</h1>
<a href="mameloader.php?m=snes&rw=256&rh=240&sc=3">Super Nintendo</a><br />
<a href="mameloader.php?m=snes&r[]=s_smp.zip&sl[]=snes.xml&s[]=snes/smkart.zip&cli[]=-cart smkart -hashpath /emulator -rompath /emulator&rw=256&rh=240&sc=3">Super Mario Kart</a> (Software List)<br />
</div>

</body>
