dnl $Id$
dnl config.m4 for extension jsond

PHP_ARG_ENABLE(jsond,
  [whether to enable Jsond support],
  [AS_HELP_STRING([--disable-jsond],
                  [Disable new JavaScript Object Serialization support])],
  yes)

AC_ARG_ENABLE(jsond-buffer-native,
  [AS_HELP_STRING([--enable-jsond-buffer-native],
                  [Enable new Jsond native buffer])],
  [AC_DEFINE([PHP_JSOND_BUF_TYPE_NATIVE],1,
             [whether native buffer is enabled])])

if test "$PHP_JSOND" != "no"; then
  AC_DEFINE([HAVE_JSOND],1 ,[whether to enable Jsond support])
  AC_HEADER_STDC

  PHP_NEW_EXTENSION(jsond, 
      jsond.c \
      jsond_buffer.c \
      jsond_encoder.c \
      jsond_parser.tab.c \
      jsond_scanner.c,
      $ext_shared)
dnl PHP_PROG_RE2C()
dnl PHP_PROG_BISON()
  PHP_ADD_MAKEFILE_FRAGMENT()
  PHP_INSTALL_HEADERS([ext/jsond], [php_jsond.h])
  PHP_SUBST(JSOND_SHARED_LIBADD)
fi
