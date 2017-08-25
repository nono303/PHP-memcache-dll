# php-7.2.x_memcache.dll
#### 2017-08-25 MSVC 15.3 (19.11.25506) - Window Kit 10.0.15063.0 - Compiled with:

 - https://github.com/php/php-src/tree/php-7.2.0beta3 7.2.0beta3
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
   - Fix memcache session handler with two backend servers Fatal Error (out of memory). https://bugs.php.net/bug.php?id=73539

# php-7.1.x_memcache.dll
#### 2017-08-25 MSVC 15.3 (19.11.25506) - Window Kit 10.0.15063.0 - Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.1.8 php-7.1.8
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
   - Fix memcache session handler with two backend servers Fatal Error (out of memory). https://bugs.php.net/bug.php?id=73539

_See [discution](http://stackoverflow.com/questions/34952502/memcache-for-php7-on-windows/) on stackoverflow_

-----
>Only tested (and working fine) on **x64 nts**.

require Redistribuable Microsoft Visual C++ pour Visual Studio 2017 

 - [x86](https://go.microsoft.com/fwlink/?LinkId=746571) 
 - [x64](https://go.microsoft.com/fwlink/?LinkId=746572)
 
See my ```memcache.ini``` configuration

2016-05-18 : I’ve noticed __2 bugs__ when implementing memcache session.handler
```
session.save_handler = memcache
session.save_path = "tcp://127.0.0.1:11211"
```
1. With ```memcache.protocol = ascii```, there is some random lock on ```session_start()``` according to ```memcache.lock_timeout```
so i've set ```memcache.lock_timeout = 1``` but that doesn’t resolve the problem (just makes it less visible..)
2. With ```memcache.protocol = binary```, first bug seems not appearing but session destroy failed !
All that test have been done with phpmyadmin which write complex data in session

So you can find ```MemcacheSessionHandlerPrepend.php``` a MemcacheSessionHandler implementing SessionHandlerInterface to add to your ```php.ini``` with config:
```
session.save_handler = user
auto_prepend_file = c:/path/to/MemcacheSessionHandlerPrepend.php
; session.save_path = 
```