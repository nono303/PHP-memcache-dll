# pecl-memcache for PHP 7.X - Windows MSVC binaries #
- https://github.com/websupport-sk/pecl-memcache
> Personally use (and working fine...) **x64 avx nts** version.  
> See my ```memcache.ini``` configuration

----
# php-7.3.x_memcache.dll
2019-02-28
> **Version [4.0.1](https://github.com/websupport-sk/pecl-memcache/tree/v4.0.1-php73) `NON_BLOCKING_IO_php7`**

- [php-src 7.3.2](https://github.com/php/php-src/tree/php-7.3.2)  
- [php-sdk-binary-tools 2.2.0 beta3](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.2.0beta3)
- MSVC 15.9.7 / 19.16.27027.1
  - MSVC redist 14.16.27024.1 [x86](https://aka.ms/vs/15/release/VC_redist.x86.exe) - [x64](https://aka.ms/vs/15/release/VC_redist.x64.exe)
- Window Kit 10.0.17763.0
- [AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases for specified directory  

#### [Dependencies](https://windows.php.net/downloads/php-sdk/deps/vc15/) - *[staging](https://windows.php.net/downloads/php-sdk/deps/series/)*

#### CFLAGS add:

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- [/GS-](https://msdn.microsoft.com/en-us/library/8dbf701c.aspx)
- [/Oy-](https://msdn.microsoft.com/en-us/library/2kxx5t2c.aspx)

#### LDFLAGS add:

- [/LTCG ](https://msdn.microsoft.com/en-us/library/xbf3tbeh.aspx)
- [/NODEFAULTLIB](https://msdn.microsoft.com/en-us/library/3tz4da4a.aspx):[libcmt.lib ](https://msdn.microsoft.com/en-us/library/abx4dbyh.aspx)
- [/OPT:ICF](https://msdn.microsoft.com/en-us/library/bxwfs976.aspx)

----
# php-7.2.x_memcache.dll
2018-12-06
> **Version [3.0.9](https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7) `NON_BLOCKING_IO_php7`**
>   - [Fix memcache session handler with two backend servers Fatal Error (out of memory)](https://bugs.php.net/bug.php?id=73539)
>   - Patch with pull [#26](https://github.com/websupport-sk/pecl-memcache/pull/26/) to fix issue [#23](https://github.com/websupport-sk/pecl-memcache/issues/23#issuecomment-327702906) Failed to read session data with 7.1/7.2

- [php-src 7.2.13](https://github.com/php/php-src/tree/php-7.2.13)
- [php-sdk-binary-tools 2.1.9](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.1.9)
- MSVC 15.9.0 / 19.16.27023.1
  - MSVC15 redist 14.16.27012 [x86](https://aka.ms/vs/15/release/VC_redist.x86.exe) - [x64](https://aka.ms/vs/15/release/VC_redist.x64.exe)
- Window Kit 10.0.17134.0
- [AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases for specified directory  

#### [Dependencies](https://windows.php.net/downloads/php-sdk/deps/vc15/) - *[staging](https://windows.php.net/downloads/php-sdk/deps/series/)*

#### CFLAGS add:

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- [/GS-](https://msdn.microsoft.com/en-us/library/8dbf701c.aspx)
- [/Oy-](https://msdn.microsoft.com/en-us/library/2kxx5t2c.aspx)

#### LDFLAGS add:

- [/LTCG ](https://msdn.microsoft.com/en-us/library/xbf3tbeh.aspx)
- [/NODEFAULTLIB](https://msdn.microsoft.com/en-us/library/3tz4da4a.aspx):[libcmt.lib ](https://msdn.microsoft.com/en-us/library/abx4dbyh.aspx)
- [/OPT:ICF](https://msdn.microsoft.com/en-us/library/bxwfs976.aspx)
   
### it is no longer worth using ```MemcacheSessionHandlerPrepend.php``` for php-7.2.x_memcache.dll!  
Just put in your php.ini something like:
  ```
  session.save_handler = memcache  
  session.save_path = "tcp://127.0.0.1:11211?persistent=1&weight=1&timeout=1&retry_interval=15"
  ````

----
# php-7.1.x_memcache.dll
2017-08-25
> **Version [3.0.9](https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7) `NON_BLOCKING_IO_php7`**
>   - Fix memcache session handler with two backend servers Fatal Error (out of memory). https://bugs.php.net/bug.php?id=73539

- [php-src 7.1.8](https://github.com/php/php-src/tree/php-7.1.8)
- [php-sdk-binary-tools 2.1.9 tag](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.1.9)
- MSVC 15.3.0 / 19.11.25506
  - MSVC15 redist 14.16.27012 [x86](https://aka.ms/vs/15/release/VC_redist.x86.exe) - [x64](https://aka.ms/vs/15/release/VC_redist.x64.exe)
- Window Kit 10.0.15063.0
- [AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases for specified directory  

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