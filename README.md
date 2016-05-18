# php_memcache.dll for php 7 
## MSVC14 (14.00.23918.0) Compiled with php-src 7.0.6, php_memcache 3.0.9-dev

 - https://github.com/php/php-src/tree/PHP-7.0.6
 - https://github.com/websupport-sk/pecl-memcache.git

Only tested (and working fine) on **x64 nts**.  
See my ```memcache.ini``` configuration

I’ve noticed __2 bugs__ when implementing memcache session.handler
```
session.save_handler = memcache
session.save_path = "tcp://127.0.0.1:11211"
```
1. With ```memcache.protocol = ascii```, there is some random lock on ```session_start()``` according to ```memcache.lock_timeout```
so i've set ```memcache.lock_timeout = 1``` but that doesn’t resolve the problem (just makes it less visible..)
2. With ```memcache.protocol = binary```, first bug seems not apperaing but session destroy failed !
All that test have been done with phpmyadmin which write complexe data in session

So you can find ```MemcacheSessionHandlerPrepend.php``` a MemcacheSessionHandler implementing SessionHandlerInterface to add to your ```php.ini``` with config:
```
session.save_handler = user
auto_prepend_file = c:/path/to/MemcacheSessionHandlerPrepend.php
; session.save_path = 
```