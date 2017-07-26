>2017-04-27 : MSVC14 discontinued. Update only MSVC15
# php-7.2.x_memcache.dll
#### 2017-07-26 MSVC15 (15.2.26430.16) Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.2 php-7.2-dev
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
   - Fix PHP7 segfault. https://bugs.php.net/bug.php?id=74008 

### Makefile build changes
* ###### LDFLAGS 
  * `+ /LTCG /OPT:ICF`
* ###### CFLAGS
  * `+ /GS- /GL /Oy-`

# php-7.1.x_memcache.dll
#### 2017-04-27 MSVC15 (15.0.26228.9) Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.1.4 php-7.1.4
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
   - Fix PHP7 segfault. https://bugs.php.net/bug.php?id=74008 

### Makefile build changes
* ###### LDFLAGS 
  * `+ /LTCG /OPT:ICF`
* ###### CFLAGS
  * `+ /GS- /GL /Oy-`

# php-7.1.x_memcache.dll
#### 2016-12-08 MSVC14 update 3 (14.00.25420.1) Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.1.0
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
  
# php-7.0.x_memcache.dll
#### 2016-05-18 MSVC14 update 2 (14.00.23918.0) Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.0.6 
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9

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
