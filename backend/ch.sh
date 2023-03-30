# /bin/bash
chown -Rf 1000:1000 app &&
chown -Rf 1000:1000 database &&
chmod -Rf 777 storage/logs &&
chmod -Rf 777 storage/framework
