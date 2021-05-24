# My own cheatsheet


### Webserver
Test autorenew of cert. [doc](https://www.tecmint.com/secure-apache-with-lets-encrypt-ssl-certificate-on-centos-8/)
```
sudo /usr/local/bin/certbot-auto renew --dry-run
```

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
** Install server on Centos 8 **
https://www.spinup.com/setting-up-a-minecraft-server-on-centos-8/

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
[Wiki permissions](https://github.com/Multiverse/Multiverse-Core/wiki/Permissions)  
Allow user to enter world  
`/lp <group/user> <group name or username> permission set multiverse.access.WORLDNAME true`  

**Links**  
* [Potions](https://static1.millenium.org/articles/3/56/24/3/@/1273086-20160229160932minecraft-brewing-en-amp_main_img-2.png)  
* [WorldEdit wiki](https://worldedit.enginehub.org/en/latest/commands/#biome-commands)
* [Villager trades](https://i.imgur.com/1Rb08Ua.png)

#### Plugins
 * [Per world inventory](https://www.spigotmc.org/resources/per-world-inventory.4482/)
 * Keep chunks

#### Minecraft Places 
Village `in world`:    `260 -460`   
Swamp `in world`: `240 -170`  
House `in world`: `40 66 -229`  
Spider spawner `in world`: `30 38 -178`  
Poisened Spider spawner `in world`: `1 35 -174`  
Zombie spawner `in world`: `44 26 -250`  
Zombie spawner `in world`: `-27 19 -141`  
Horses `in world`: `50 66 100`  
Jungle `in world`: `-250 64 -90`  
Poisened Spider spawner `in world`: `84 43 -227`  
Blaze spawner `in nether_world`: `16 70 187`  
Blaze spawner `in nether_world`: `-44 70 161`  
Skeleton spawner `in world`: `234 43 -439`  
Poisened Spider spawner `in world`: `230 18 -417`  
Red temple `in nether`: `150 55 250`
Double Poisened Spider spawner `in world`: `186 38 -227`   

#### Best give commands
https://www.digminecraft.com/generators/index.php
```
Helmet 
/give @p diamond_helmet{Enchantments:[{id:protection,lvl:4},{id:respiration,lvl:3},{id:aqua_affinity,lvl:1},{id:thorns,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
Chestplate 
/give @p diamond_chestplate{Enchantments:[{id:protection,lvl:4},{id:thorns,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 2
Leggings 
/give @p diamond_leggings{Enchantments:[{id:protection,lvl:4},{id:thorns,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 2
Boots 
/give @p diamond_boots{Enchantments:[{id:soul_speed,lvl:3},{id:protection,lvl:4},{id:feather_falling,lvl:4},{id:thorns,lvl:3},{id:depth_strider,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
Sword
/give @p diamond_sword{display:{Name:"\"Excalibur II\""},Enchantments:[{id:smite,lvl:5},{id:knockback,lvl:2},{id:fire_aspect,lvl:2},{id:looting,lvl:3},{id:sweeping,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
Bow
/give @p bow{Enchantments:[{id:unbreaking,lvl:3},{id:power,lvl:4},{id:punch,lvl:2},{id:flame,lvl:1},{id:infinity,lvl:1}]} 1
Pickaxe
/give @p diamond_pickaxe{Enchantments:[{id:efficiency,lvl:5},{id:silk_touch,lvl:1},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
Axe
/give @p diamond_axe{Enchantments:[{id:smite,lvl:5},{id:efficiency,lvl:5},{id:silk_touch,lvl:1},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
 
```
#### Also best give commands
```
/give emillycami netherite_sword{Enchantments:[{id:sharpness,lvl:5},{id:knockback,lvl:2},{id:fire_aspect,lvl:2},{id:looting,lvl:3},{id:sweeping,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
/give emillycami bow{Enchantments:[{id:unbreaking,lvl:3},{id:power,lvl:5},{id:punch,lvl:2},{id:flame,lvl:1},{id:mending,lvl:1}]} 1
/give emillycami netherite_helmet{Enchantments:[{id:protection,lvl:4},{id:respiration,lvl:3},{id:aqua_affinity,lvl:1},{id:unbreaking,lvl:2},{id:mending,lvl:1}]} 1
/give emillycami netherite_chestplate{Enchantments:[{id:protection,lvl:4},{id:thorns,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
/give emillycami netherite_leggings{Enchantments:[{id:protection,lvl:4},{id:thorns,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
/give emillycami netherite_boots{Enchantments:[{id:soul_speed,lvl:3},{id:protection,lvl:4},{id:feather_falling,lvl:4},{id:thorns,lvl:3},{id:depth_strider,lvl:3},{id:unbreaking,lvl:3},{id:mending,lvl:1}]} 1
```
