chown www-data:www-data * -Rf
filename=$(date +%Y%m%d);
git add --all;
git commit -am $filename;
git push;
