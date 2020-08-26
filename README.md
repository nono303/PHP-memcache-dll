# PHP 7.x pecl-memcache Windows binaries
### `NON_BLOCKING_IO_php7`
### `VC15 & VS16`
- **src**: https://github.com/websupport-sk/pecl-memcache
- **doc:** https://www.php.net/manual/en/book.memcache.php
> Personally use (and working fine...) **x64 avx nts** version.  
> See ```memcache.ini``` configuration file exemple

----
## Version [4.0.5.2 "baec8a2-pr71"](https://github.com/websupport-sk/pecl-memcache/pull/71)  
###  Use `zend_bool` for ini bool settings [pr71](https://github.com/websupport-sk/pecl-memcache/pull/71) < _Bug with prefix_host_key [#56](https://github.com/websupport-sk/pecl-memcache/issues/56)_

​	_see [patch](https://github.com/nono303/PHP7-memcache-dll/blob/master/pr71.patch)_

> 2020-08-26

- VS16 : toolset 14.27.29016
- VC15 : toolset 14.16.27012
  - MSVC redist  [x86](https://aka.ms/vs/16/release/vc_redist.x86.exe) - [x64](https://aka.ms/vs/16/release/vc_redist.x64.exe)
- Window Kit 10.0.19041.0
- **[AVX](https://msdn.microsoft.com/fr-fr/library/jj620901.aspx) releases** __for specified directory__
- `php-7.4.x_memcache.dll` with [php-src 7.4.9](https://github.com/php/php-src/tree/php-7.4.9)  
- `php-7.3.x_memcache.dll` with [php-src 7.3.21](https://github.com/php/php-src/tree/php-7.3.21)  
- `php-7.2.x_memcache.dll` with [php-src 7.2.33](https://github.com/php/php-src/tree/php-7.2.33)  
- `php-7.1.x_memcache.dll` with [php-src 7.1.31](https://github.com/php/php-src/tree/php-7.1.31) 

## ![](https://placehold.it/15/f03c15/000000?text=+) MSVC14 _discontinued_ 

### [3.0.9-dev](https://github.com/websupport-sk/pecl-memcache/commit/4991c2fff22d00dc81014cc92d2da7077ef4bc86)

> 2016-12-08

- `php-7.1.x_memcache.dll` with [php-src 7.1.0](https://github.com/php/php-src/tree/php-7.1.0) 
- `php-7.0.x_memcache.dll` with [php-src 7.0.6](https://github.com/php/php-src/tree/php-7.0.6) 

----
#### **Build Scripts** 

- [@nono303/win-build-scripts](https://github.com/nono303/win-build-scripts)

#### Dependencies

- [php-sdk-binary-tools 2.2.0](https://github.com/microsoft/php-sdk-binary-tools/tree/php-sdk-2.2.0)
- [php-sdk 'staging'](https://windows.php.net/downloads/php-sdk/deps/series/)

#### CFLAGS add:

- [/GL](https://msdn.microsoft.com/en-us/library/0zza0de8.aspx)
- MD
- /Zi
- /O2

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
