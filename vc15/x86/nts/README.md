```
configure --disable-all --enable-cli --enable-zlib --enable-hash --enable-session --without-gd --with-bz2 --enable-memcache=shared --enable-fd-setsize=2048 --enable-sanitizer --disable-zts
```

LDFLAGS add: ```/LTCG /NODEFAULTLIB:libcmt.lib /OPT:ICF```
CFLAGS add: ```/GL /GS- /Oy-```

 - Build type       : Release
 - Thread Safety    : No
 - Compiler         : MSVC15 (Visual C++ 2017)
 - Architecture     : x86
 - Optimization     : PGO disabled
 - Static analyzer  : disabled