#!/usr/bin/env bash
cd /home/xaobin/_Documents/Code/PHP/Send_Github/app_rent_car/
 /usr/bin/git init
 /usr/bin/git add .
 /usr/bin/git status
 /usr/bin/git commit -m "Upd_APP"
 /usr/bin/git branch -M main
 /usr/bin/git remote add origin git@github.com:Xaobin/RentACar_API.git
 /usr/bin/git push -f origin main
exec bash
 
