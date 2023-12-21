# emularity-wrapper
messing around with emularity

wrapper for emularity, see index.php (yes, yes) for examples of loading titles. nothing here is secured so use at your own risk. You can download and upload states from/to your session

## setup
1. clone this repo
2. clone emularity repo into vendor directory
2. clone the fancy-ass icons8 set repo into vendor directory
3. host the site (php required atm)
4. add roms and software, update index.php
4. play some games

## layout
```
/
├── assets
│   ├── autoboot
│   └── hash
├── binaries
│   ├── machines
│   ├── roms
│   └── software
│       ├── apple2_flop_orig
│       ├── psx
│       │   └── thps2
│       ├── sms
├── vendor
```

## folders
```
autoboot    -> lua scripts
hass        -> mame softlists
machine     -> wasm/js files
rom         -> machine files
software    -> software files
```

## get params
```
m       -> machine
a[]     -> assets
r[]     -> roms
s[]     -> software
sl[]    -> software lists
rw      -> width
rh      -> height
sc      -> scale
p[s]    -> peripheral key->slot, value->attachment
cli[]   -> custom cli options (extraArgs)
```


## basic requirements for a machine with software
1. the wasm/js machine files from MAME
2. load the driver
3. mount machine roms
4. mount additional software and/or assets 
5. attach software to slots
6. start the machine


Have only tried out MAME so far