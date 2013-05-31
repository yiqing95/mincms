### 开发版 安装说明

步骤 1  使用composer安装依赖包，包含yii2
```
  php composer.phar install  
```
步骤 2 数据库配置及导入

```
修改数据库链接信息
protected/config/main.php
或直接在本地mysql创建用户test 密码 test 数据库名 books
导入根目录下的schema.sql
```
步骤 3 访问

```
public为入口目录。如未配置apache 可直接访问 /public/
后台用户名 admin 密码 123456 如不正确 密码为 111111
由于代码开发中，使用该GIT的master可能会经常更新。
相关git 操作请google
```

