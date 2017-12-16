使用说明
首先要安装composer；
如果不会安装的参考 composer的初级使用;
然后点击下面的链接下载项目；
github: https://github.com/youxianyen/laravelangular.git

或者使用git clone；
github:

git clone git@github.com:youxianyen/laravelangular.git
gitee(国内速度快):

git clone git@gitee.com:youxianyen/laravelangular.git
配置好本地环境主要是指向public目录；
参考 phpstudy 配置虚拟主机;

进入项目跟目录执行安装命令；

composer install -vvv
然后把 .env.example改名为.env;
生成APP_KEY；

php artisan key:generate
把 .env 文件中的 APP_URL 改为自己的域名；
把 .env 文件中的 DB_HOST、DB_PORT、DB_DATABASE、DB_USERNAME、DB_PASSWORD；
改为自己实际的数据库链接； 运行迁移命令；

php artisan migrate
运行数据填充命令;

php artisan db:seed
