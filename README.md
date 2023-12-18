# emularity-wrapper
messing around with emularity

wrapper for emularity, see index.php (yes, yes) for examples of loading titles. nothing here is secured so use at your own risk.

## setup
1. clone this repo
2. clone emularity report as sub directory
3. host the site (php required atm)
4. add roms and software
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