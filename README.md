# emularity-wrapper
messing around with emularity

wrapper for emularity, see index.php (yes, yes) for examples of loading titles. nothing here is secured so use at your own risk. You can download and upload states from/to your session

## setup
1. clone this repo `git clone --recurse-submodules https://github.com/mameau/emularity-wrapper.git`
2. host the site (php required atm)
3. add roms and software
4. copy index.example.php to index.php and modify it
5. play some games

## layout
```
/
├── assets
│   ├── autoboot
│   └── hash
├── binaries
│   ├── machines
│   ├── nvram
│   ├── state
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


## known issues
* no nvram support, doesn't matter if you get into the storage MAME does appear to read it
