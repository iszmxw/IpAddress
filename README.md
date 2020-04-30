```text
追梦小窝封装的网络请求包
该包是通过百度提搜索
可以获取用户ip地址，以及所在省市区
```

```php
<?php

require_once './vendor/autoload.php'; // 加载自动加载文件
use Iszmxw\IpAddress\Address;
$ip = Address::ip();
$address = Address::address($ip);
print_r($ip); // 打印ip
print_r($address); //打印详细信息
```
