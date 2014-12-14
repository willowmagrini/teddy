#!/bin/bash
#script para backup teddy
cd /Applications/MAMP/htdocs/teddy/;
if [ ! -d "/Applications/MAMP/htdocs/BKP/teddy"];
	then
	mkdir /Applications/MAMP/htdocs/BKP/teddy;
fi
data=`date +%Y%m%d`;
wp db export '/Applications/MAMP/htdocs/BKP/teddy/db_backup_'$data'.sql';
cp -r /Applications/MAMP/htdocs/teddy/* /Applications/MAMP/htdocs/BKP/teddy/

