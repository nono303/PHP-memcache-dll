# pecl-memcache for PHP 7.X - Windows MSVC binaries #
- https://github.com/websupport-sk/pecl-memcache
> Personally use (and working fine...) **x64 avx nts** version.  
> See ```memcache.ini``` configuration file exemple

----
## Version [4.0.3](https://github.com/websupport-sk/pecl-memcache/tree/v4.0.3) `NON_BLOCKING_IO_php7`

- `php-7.3.x_memcache.dll` with [php-src 7.3.5](https://github.com/php/php-src/tree/php-7.3.5)  
- `php-7.2.x_memcache.dll` with [php-src 7.2.17](https://github.com/php/php-src/tree/php-7.2.17)  
- `php-7.1.x_memcache.dll` with [php-src 7.1.28](https://github.com/php/php-src/tree/php-7.1.28)  
- [php-sdk-binary-tools 2.2.0 beta5](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.2.0beta5)
- [AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases for specified directory  
> 
> 2019-04-08 **VC15**
- MSVC 15.9.11 / 14.16.27030.1
- Window Kit 10.0.17763.0
>
> 2019-05-07 **VS16**
- MSVC 16.1.0 preview 3.0 / 14.21.27619.1
- Window Kit 10.0.18362.0  

#### [Dependencies](https://windows.php.net/downloads/php-sdk/deps/vc15/) - *[staging](https://windows.php.net/downloads/php-sdk/deps/series/)*
- MSVC redist 14.21.27619 [x86](https://download.visualstudio.microsoft.com/download/pr/1a6314bb-c949-42e9-925f-1c0bf4eb00de/41482628dd05373a7c24b0d43ae1753e/vc_redist.x86.exe) - [x64](https://download.visualstudio.microsoft.com/download/pr/0eac0881-2173-4d79-bee7-fda4dccb0005/aa1dfcd3b6c304fa8b8b57d1e3d6ae63/vc_redist.x64.exe)

#### CFLAGS add:

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- [/GS-](https://msdn.microsoft.com/en-us/library/8dbf701c.aspx)
- [/Oy-](https://msdn.microsoft.com/en-us/library/2kxx5t2c.aspx)

#### LDFLAGS add:

- [/LTCG ](https://msdn.microsoft.com/en-us/library/xbf3tbeh.aspx)
- [/NODEFAULTLIB](https://msdn.microsoft.com/en-us/library/3tz4da4a.aspx):[libcmt.lib ](https://msdn.microsoft.com/en-us/library/abx4dbyh.aspx)
- [/OPT:ICF](https://msdn.microsoft.com/en-us/library/bxwfs976.aspx)

----
2016-05-18
> I’ve noticed __2 bugs__ when implementing memcache session.handler for 
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
_See [issue #23](https://github.com/websupport-sk/pecl-memcache/issues/23#issuecomment-327702906) and [discution](http://stackoverflow.com/questions/34952502/memcache-for-php7-on-windows/) on stackoverflow_

----
>MSVC14 discontinued.