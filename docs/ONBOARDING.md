## Gymkhana IITH On-Boarding Guide. 
### Pre-requisites 
- Basic Knowledge of git and a Github Account
- Some experience of using the command line and ssh
- Linux is recommended but not necessary. In case you use Windows, please have git and ssh pre-installed. The following section on command line tips may not work on a Windows Machine.

### Website Infrastructure.

The website is deployed on a container provided by Computer Centre (also known as ISAC). 
The Container runs Ubuntu 20.04 LTS as it's operating system.

The website is deplyed using the NGINX Webserver. 
It uses `git` as a version control system and for deployment. 

### Making Changes 

The source code of the website resides in the [GymkhanaIITH](https://github.com/GymkhanaIITH/GymkhanaIITH) repository.
The website is currently written in HTML, CSS and vanilla JS.

To test it locally , `git clone` the repository onto your local machine. 
Make changes locally and test them. Make sure that there is cross-browser compatibility, i.e. changes work on both Chrome and Firefox. 

#### Command Line specific Tips: 

Since this is written in pure HTML, making changes to all the files can be quite a hassle. This is especially for the situation when there is a minor change to be made
in the navigation bar / footer. All the necessary files will have to be changed for website consistency. 

You can use `grep` to locate the occurence of a particular pattern.  Particular options that might be of help include, `-r` (recursive), `-i` (case insensitive) and `-n`(line numbers).  

An example usage of `grep` for searching for `<li>HOME</li>` in all `.html` can be seen below: 
```
grep -rin "<li>HOME</li>" *.html
```

Another tool, `sed` can be used to make batch changes in all the files through simply one or two commands. This tool **must** be used with **extreme caution**, as it is potentially destructive in nature. A wrong command can cause incorrect changes across a batch of files which can lead to further problems. Known consequences include frustration, swearing and headaches for the developer. 

In case you have erroneously saved a change in a file and want to reset it to the repository contents, use 
```
git checkout /path/to/file
```
This will reset the file contents to the repository HEAD. **Note**: This change is irreversible. All local changes to the file will be lost. Use with caution.

### Deploying Changes: 


Under normal circumstances, pushing the repository to the `deploy` branch will auto-deploy the changes on the server.
The deployment takes upto a minute to take effect. Internally, a cron job is scheduled to pull changes from github every minute and apply them.

However, the command has been configured to only succeed on fast forward commits. It will in the case where there have been forced updates to the server. 
In such a case, you will have to use your server credentials to login into the server, and pull manually.

To log in to the server, you will need to ssh into the server. Before attempting to login, you must be connected into the IITH Local network.  This can be accomplished either by connecting to IITH Wifi/LAN or connecting through the VPN (preferably using Wireguard).

Then, you can ssh in using the server credentials. After you're logged into the server, move into the website repository and run `git pull origin deploy` to update the repository.

### Server Layout

A nginx webserver is used to deply the website online. The Nginx configuration is present in `/etc/nginx/sites-enabled/default`. 

The location root is `/var/www/html`. Currently, this a symlink to /home/ee18btech11049/html/ . 
