# php_memcache.dll compiled with php 7.0.6, php_memcache 3.0.9-dev, VC14 :

http://windows.php.net/downloads/php-sdk/
 - 5/7/2016 12:09 AM     38219599 deps-7.0-vc14-x64.7z
 - 5/7/2016 12:09 AM     35623894 deps-7.0-vc14-x86.7z

http://windows.php.net/downloads/releases/
 - 4/29/2016 12:38 AM     25251414 php-7.0.6-src.zip

https://github.com/websupport-sk/pecl-memcache.git

-----

###### configure --disable-all --enable-cli --enable-zlib --enable-hash --enable-session --without-gd --with-bz2 --enable-memcache=shared

## x86 nts
 - Build type       : Release
 - Thread Safety    : No
 - Compiler         : MSVC14 (Visual C++ 2015)
 - Architecture     : x86
 - Optimization     : PGO disabled
 - Static analyzer  : disabled
## x86 ts
 - Build type       : Release
 - Thread Safety    : Yes
 - Compiler         : MSVC14 (Visual C++ 2015)
 - Architecture     : x86
 - Optimization     : PGO disabled
 - Static analyzer  : disabled
## x64 nts
 - Build type       : Release
 - Thread Safety    : No
 - Compiler         : MSVC14 (Visual C++ 2015)
 - Architecture     : x64
 - Optimization     : PGO disabled
 - Static analyzer  : disabled
## X64 ts
 - Build type       : Release
 - Thread Safety    : Yes
 - Compiler         : MSVC14 (Visual C++ 2015)
 - Architecture     : x64
 - Optimization     : PGO disabled
 - Static analyzer  : disabled

only tested (working) on x64 nts.