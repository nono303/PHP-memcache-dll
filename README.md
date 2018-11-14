# php-7.2.x_memcache.dll
**2018-11-14*

**compiled with:**
- [php-src 7.2.12 tag](https://github.com/php/php-src/tree/php-7.2.12)
- [memcache 3.0.9 NON_BLOCKING_IO_php7](https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7) _shared_
   - [Fix memcache session handler with two backend servers Fatal Error (out of memory)](https://bugs.php.net/bug.php?id=73539)
   - Patch with pull [#26](https://github.com/websupport-sk/pecl-memcache/pull/26/) to fix issue [#23](https://github.com/websupport-sk/pecl-memcache/issues/23#issuecomment-327702906) Failed to read session data with 7.1/7.2
- MSVC 15.9.0 / 19.16.27023.1
- Window Kit 10.0.17134.0
- [php-sdk-binary-tools 2.1.9 tag](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.1.9)

**Dependencies**

- dll (non debug) from deps [x86](http://windows.php.net/downloads/php-sdk/deps/vc15/x86/) - [x64](http://windows.php.net/downloads/php-sdk/deps/vc15/x64/)
- MSVC15 redist 14.16.27012 [x86](https://aka.ms/vs/15/release/VC_redist.x86.exe) - [x64](https://aka.ms/vs/15/release/VC_redist.x64.exe)

**CFLAGS add:** 

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- [/GS-](https://msdn.microsoft.com/en-us/library/8dbf701c.aspx)
- [/Oy-](https://msdn.microsoft.com/en-us/library/2kxx5t2c.aspx)
- **[/arch:AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx)** __only for /avx subdirectoy builds__

**LDFLAGS add:** 

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
#### 2017-08-25 MSVC 15.3 (19.11.25506) - Window Kit 10.0.15063.0 - Compiled with:

 - https://github.com/php/php-src/tree/PHP-7.1.8 php-7.1.8
 - https://github.com/websupport-sk/pecl-memcache/tree/NON_BLOCKING_IO_php7 3.0.9
   - Fix memcache session handler with two backend servers Fatal Error (out of memory). https://bugs.php.net/bug.php?id=73539

2016-05-18 : I’ve noticed __2 bugs__ when implementing memcache session.handler for 
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

>MSVC14 discontinued. Update only MSVC15

>Only tested (and working fine) on **x64 nts**.

>Require Redistribuable [Microsoft Visual C++ pour Visual Studio 2017](https://www.visualstudio.com/fr/downloads/) 
 
See my ```memcache.ini``` configuration
