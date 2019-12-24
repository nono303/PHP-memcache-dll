# PHP 7.x pecl-memcache Windows binaries
### `NON_BLOCKING_IO_php7`
### `VC15 & VS16`
- **src**: https://github.com/websupport-sk/pecl-memcache
- **doc:** https://www.php.net/manual/en/book.memcache.php
> Personally use (and working fine...) **x64 avx nts** version.  
> See ```memcache.ini``` configuration file exemple

----
## Version [4.0.5.2 "baec8a2"](https://github.com/websupport-sk/pecl-memcache/commit/baec8a29aa48064c1c9bb540749263cbc14f21ef)  
>2019-12-24
> 
> - `php-7.4.x_memcache.dll` with [php-src 7.4.1](https://github.com/php/php-src/tree/php-7.4.1)  
> - `php-7.3.x_memcache.dll` with [php-src 7.3.13](https://github.com/php/php-src/tree/php-7.3.13)  
> - `php-7.2.x_memcache.dll` with [php-src 7.2.26](https://github.com/php/php-src/tree/php-7.2.26)  
>   - Visual Studio 2019 v16.4.2
>   - VS16 : toolset 14.24.28314
>   - VC15 : toolset 14.16.27023
>   - Window Kit 10.1.18362.1

## Version [4.0.4 "459ad85"](https://github.com/websupport-sk/pecl-memcache/commit/459ad858a5b5c55bd7346afa27793ffcad58562c) ![](https://placehold.it/15/f03c15/000000?text=+) _discontinued_
### Fix crash when serialization fails [#53](https://github.com/websupport-sk/pecl-memcache/pull/53) 2019-06-17  
> 2019-08-07
>
> - `php-7.1.x_memcache.dll` with [php-src 7.1.31](https://github.com/php/php-src/tree/php-7.1.31) 
>   - Visual Studio 2019 v16.2
>   - VS16 14.22.27905
>   - VC15 14.16.27023
>   - Window Kit 10.0.18362.0  
----
- **[AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases** __for specified directory__, SSE2 for others
- MSVC redist [x86](https://aka.ms/vs/16/release/vc_redist.x86.exe) - [x64](https://aka.ms/vs/16/release/vc_redist.x64.exe) 
#### Dependencies

- [php-sdk-binary-tools 2.2.0](https://github.com/microsoft/php-sdk-binary-tools/tree/php-sdk-2.2.0)
- [php-sdk 'staging'](https://windows.php.net/downloads/php-sdk/deps/series/)

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
