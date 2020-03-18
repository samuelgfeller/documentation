# My own cheatsheet


### Webserver

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
`java -Xmx5G -Xms5G -XX:+UseConcMarkSweepGC -jar /home/mcsvr/spigot/spigot-1.15.2.jar`  
  
Stop server     
`stop`
