Gearman Workshop
=====================================

If you are running a Linux and gearman PHP ext is not installed:
* LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php
* LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/pkg-gearman
* sudo apt-get update
* sudo apt-get install php-gearman

##Gearman usual exceptions:
* PHP Fatal error:  Uncaught GearmanException: Failed to set exception option in /var/www/gearman-workshop/src/GearmanClient.php:13
