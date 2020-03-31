# My own cheatsheet


### Webserver

### Permissions
Adding `-R` will execute the following commands recursively

For a user `someusername` to be able to write in folder, that was initially made by root, you need to change the `rwx` permissions and/or the owner resp. group. If you restrict the permissions then `someusername` needs to be either owner or group member.

If you do `chmod 777 /somefolder`, everyone can read and write, including `someusername`.

If you do `chmod 770 /somefolder`, then `someusername` has to be member of the group owning `/somefolder` and you additionally have to do:

    chgrp someusername /somefolder
(assuming that there is a group `someusername` created when the user `someusername` was created, as is nowadays often the case. You can get the groups for `someusername` by typing `id someusername`). 

If you do `chmod 700 /somefolder`, then `someusername` has to be owner of `/somefolder` and you additionally have to do:

    chown someusername /somefolder

For a directory you need the execute bit set in order to access files and directories inside that directory. Therefore `644` is seldom appropriate for a directory and `700`, `755`, `750` permissions are much more often seen on directories.
[Source](https://unix.stackexchange.com/a/174793)

### Minecraft


**Screen**  
`screen -list`  
Screen with name `screen -S "minecraft"`  
Then press `Ctrl+a` (release) and then `d` to detach the process/screen (so it'll continue to run)  
To resume detached process, use:  
`screen -r` followed by name or numeber or `CTRL+A+D`  
See what screen I'm on: `echo $STY`  
Quit screen: `screen -XS [session # you want to quit] quit`  
   
**Launch server:**  
``` 
su mcsvr

cd /home/mcsvr/spigot/
java -Xmx5G -Xms5G -XX:+UseConcMarkSweepGC -jar spigot-1.15.2.jar
```  
Stop server     
`stop`

**Permissions LuckyPerms**
[Wiki](https://github.com/lucko/LuckPerms/wiki/Usage)
Give group access to command:  
`lp group admin permission set minecraft.command.ban true`
  
**Multiverse**  
[Wiki](https://github.com/Multiverse/Multiverse-Core/wiki/Permissions)  
Allow user to enter world  
`/lp <group/user> <group name or username> permission set multiverse.access.WORLDNAME true`  

#### Minecraft Places 
Village `in world`:    `260 -460`   
Swamp `in world`: `240 -170`  
House `in world`: `15 66 -316`  
Spider spawner `in world`: `30 38 -178`  
Poisened Spider spawner `in world`: `1 35 -174`  
Zombie spawner `in world`: `44 26 -250`  
Zombie spawner `in world`: `-27 19 -141`  
Horses `in world`: `50 66 100`  
Jungle `in world`: `-250 64 -90`
