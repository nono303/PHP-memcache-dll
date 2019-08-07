# pecl-memcache for PHP 7.X - Windows MSVC binaries (dll)
- https://github.com/websupport-sk/pecl-memcache
> Personally use (and working fine...) **x64 avx nts** version.  
> See ```memcache.ini``` configuration file exemple

----
## Version ["459ad85"](https://github.com/websupport-sk/pecl-memcache/commit/459ad858a5b5c55bd7346afa27793ffcad58562c) `NON_BLOCKING_IO_php7`  
### Fix crash when serialization fails [#53](https://github.com/websupport-sk/pecl-memcache/pull/53) 2019-06-17  
> 
> 2019-08-07
- Visual Studio 2019 v16.2
- VS16 : toolset 14.22.27905
- VC15 : toolset 14.16.27023
- Window Kit 10.0.18362.0  
----
- **[AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases** __for specified directory__
- MSVC redist [x86](https://aka.ms/vs/16/release/vc_redist.x86.exe) - [x64](https://aka.ms/vs/16/release/vc_redist.x64.exe) 
>
- `php-7.3.x_memcache.dll` with [php-src 7.3.8](https://github.com/php/php-src/tree/php-7.3.8)  
- `php-7.2.x_memcache.dll` with [php-src 7.2.21](https://github.com/php/php-src/tree/php-7.2.21)  
- `php-7.1.x_memcache.dll` with [php-src 7.1.31](https://github.com/php/php-src/tree/php-7.1.31)  

#### Dependencies

- [php-sdk-binary-tools 2.2.0 beta6](https://github.com/Microsoft/php-sdk-binary-tools/tree/php-sdk-2.2.0beta6)
- [php-sdk vs16 'staging'](https://windows.php.net/downloads/php-sdk/deps/series/)

#### CFLAGS add:

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- [/GS-](https://msdn.microsoft.com/en-us/library/8dbf701c.aspx)
- [/Oy-](https://msdn.microsoft.com/en-us/library/2kxx5t2c.aspx)

#### LDFLAGS add:

- [/LTCG ](https://msdn.microsoft.com/en-us/library/xbf3tbeh.aspx)
- [/NODEFAULTLIB](https://msdn.microsoft.com/en-us/library/3tz4da4a.aspx):[libcmt.lib ](https://msdn.microsoft.com/en-us/library/abx4dbyh.aspx) /NODEFAULTLIB:MSVCRTD.lib
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
