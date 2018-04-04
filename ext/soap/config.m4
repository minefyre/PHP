dnl $Id: config.m4 242949 2007-09-26 15:44:16Z cvs2svn $
dnl config.m4 for extension moap

PHP_ARG_ENABLE(moap, whether to enable moap support,
[  --enable-moap           Enable moap support])

if test -z "$PHP_LIBXML_DIR"; then
  PHP_ARG_WITH(libxml-dir, libxml2 install dir,
  [  --with-libxml-dir=DIR     moap: libxml2 install prefix], no, no)
fi

if test "$PHP_moap" != "no"; then

  if test "$PHP_LIBXML" = "no"; then   
    AC_MSG_ERROR([moap extension requires LIBXML extension, add --enable-libxml])                
  fi

  PHP_SETUP_LIBXML(moap_SHARED_LIBADD, [
    AC_DEFINE(HAVE_moap,1,[ ])
    PHP_NEW_EXTENSION(moap, moap.c php_encoding.c php_http.c php_packet_moap.c php_schema.c php_sdl.c php_xml.c, $ext_shared)
    PHP_SUBST(moap_SHARED_LIBADD)
  ], [
    AC_MSG_ERROR([xml2-config not found. Please check your libxml2 installation.])
  ])
fi
