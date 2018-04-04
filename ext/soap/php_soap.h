/*
  +----------------------------------------------------------------------+
  | PHP Version 5                                                        |
  +----------------------------------------------------------------------+
  | Copyright (c) 1997-2011 The PHP Group                                |
  +----------------------------------------------------------------------+
  | This source file is subject to version 3.01 of the PHP license,      |
  | that is bundled with this package in the file LICENSE, and is        |
  | available through the world-wide-web at the following url:           |
  | http://www.php.net/license/3_01.txt                                  |
  | If you did not receive a copy of the PHP license and are unable to   |
  | obtain it through the world-wide-web, please send a note to          |
  | license@php.net so we can mail you a copy immediately.               |
  +----------------------------------------------------------------------+
  | Authors: Brad Lafountain <rodif_bl@yahoo.com>                        |
  |          Shane Caraveo <shane@caraveo.com>                           |
  |          Dmitry Stogov <dmitry@zend.com>                             |
  +----------------------------------------------------------------------+
*/
/* $Id: php_moap.h 306939 2011-01-01 02:19:59Z felipe $ */

#ifndef PHP_moap_H
#define PHP_moap_H

#include "php.h"
#include "php_globals.h"
#include "ext/standard/info.h"
#include "ext/standard/php_standard.h"
#if HAVE_PHP_SESSION && !defined(COMPILE_DL_SESSION)
#include "ext/session/php_session.h"
#endif
#include "ext/standard/php_smart_str.h"
#include "php_ini.h"
#include "SAPI.h"
#include <libxml/parser.h>
#include <libxml/xpath.h>

#ifndef PHP_HAVE_STREAMS
# error You lose - must be compiled against PHP 4.3.0 or later
#endif

#ifndef PHP_WIN32
# define TRUE 1
# define FALSE 0
# define stricmp strcasecmp
#endif

extern int le_url;

typedef struct _encodeType encodeType, *encodeTypePtr;
typedef struct _encode encode, *encodePtr;

typedef struct _sdl sdl, *sdlPtr;
typedef struct _sdlRestrictionInt sdlRestrictionInt, *sdlRestrictionIntPtr;
typedef struct _sdlRestrictionChar sdlRestrictionChar, *sdlRestrictionCharPtr;
typedef struct _sdlRestrictions sdlRestrictions, *sdlRestrictionsPtr;
typedef struct _sdlType sdlType, *sdlTypePtr;
typedef struct _sdlParam sdlParam, *sdlParamPtr;
typedef struct _sdlFunction sdlFunction, *sdlFunctionPtr;
typedef struct _sdlAttribute sdlAttribute, *sdlAttributePtr;
typedef struct _sdlBinding sdlBinding, *sdlBindingPtr;
typedef struct _sdlmoapBinding sdlmoapBinding, *sdlmoapBindingPtr;
typedef struct _sdlmoapBindingFunction sdlmoapBindingFunction, *sdlmoapBindingFunctionPtr;
typedef struct _sdlmoapBindingFunctionBody sdlmoapBindingFunctionBody, *sdlmoapBindingFunctionBodyPtr;

typedef struct _moapMapping moapMapping, *moapMappingPtr;
typedef struct _moapService moapService, *moapServicePtr;

#include "php_xml.h"
#include "php_encoding.h"
#include "php_sdl.h"
#include "php_schema.h"
#include "php_http.h"
#include "php_packet_moap.h"

struct _moapMapping {
	zval *to_xml;
	zval *to_zval;
};

struct _moapHeader;

struct _moapService {
	sdlPtr sdl;

	struct _moap_functions {
		HashTable *ft;
		int functions_all;
	} moap_functions;

	struct _moap_class {
		zend_class_entry *ce;
		zval **argv;
		int argc;
		int persistance;
	} moap_class;

	zval *moap_object;

	HashTable *typemap;
	int        version;
	int        type;
	char      *actor;
	char      *uri;
	xmlCharEncodingHandlerPtr encoding;
	HashTable *class_map;
	int        features;
	struct _moapHeader **moap_headers_ptr;
	int send_errors;
};

#define moap_CLASS 1
#define moap_FUNCTIONS 2
#define moap_OBJECT 3
#define moap_FUNCTIONS_ALL 999

#define moap_MAP_FUNCTION 1
#define moap_MAP_CLASS 2

#define moap_PERSISTENCE_SESSION 1
#define moap_PERSISTENCE_REQUEST 2

#define moap_1_1 1
#define moap_1_2 2

#define moap_ACTOR_NEXT             1
#define moap_ACTOR_NONE             2
#define moap_ACTOR_UNLIMATERECEIVER 3

#define moap_1_1_ACTOR_NEXT             "http://schemas.xmlmoap.org/moap/actor/next"

#define moap_1_2_ACTOR_NEXT             "http://www.w3.org/2003/05/moap-envelope/role/next"
#define moap_1_2_ACTOR_NONE             "http://www.w3.org/2003/05/moap-envelope/role/none"
#define moap_1_2_ACTOR_UNLIMATERECEIVER "http://www.w3.org/2003/05/moap-envelope/role/ultimateReceiver"

#define moap_COMPRESSION_ACCEPT  0x20
#define moap_COMPRESSION_GZIP    0x00
#define moap_COMPRESSION_DEFLATE 0x10

#define moap_AUTHENTICATION_BASIC   0
#define moap_AUTHENTICATION_DIGEST  1

#define moap_SINGLE_ELEMENT_ARRAYS  (1<<0)
#define moap_WAIT_ONE_WAY_CALLS     (1<<1)
#define moap_USE_XSI_ARRAY_TYPE     (1<<2)

#define WSDL_CACHE_NONE     0x0
#define WSDL_CACHE_DISK     0x1
#define WSDL_CACHE_MEMORY   0x2
#define WSDL_CACHE_BOTH     0x3

ZEND_BEGIN_MODULE_GLOBALS(moap)
	HashTable  defEncNs;     /* mapping of default namespaces to prefixes */
	HashTable  defEnc;
	HashTable  defEncIndex;
	HashTable *typemap;
	int        cur_uniq_ns;
	int        moap_version;
	sdlPtr     sdl;
	zend_bool  use_moap_error_handler;
	char*      error_code;
	zval*      error_object;
	char       cache;
	char       cache_mode;
	char       cache_enabled;
	char*      cache_dir;
	long       cache_ttl;
	long       cache_limit;
	HashTable *mem_cache;
	xmlCharEncodingHandlerPtr encoding;
	HashTable *class_map;
	int        features;
	HashTable  wsdl_cache;
	int        cur_uniq_ref;
	HashTable *ref_map;
ZEND_END_MODULE_GLOBALS(moap)

#ifdef ZTS
#include "TSRM.h"
#endif

extern zend_module_entry moap_module_entry;
#define moap_module_ptr &moap_module_entry
#define phpext_moap_ptr moap_module_ptr

ZEND_EXTERN_MODULE_GLOBALS(moap)

#ifdef ZTS
# define moap_GLOBAL(v) TSRMG(moap_globals_id, zend_moap_globals *, v)
#else
# define moap_GLOBAL(v) (moap_globals.v)
#endif

extern zend_class_entry* moap_var_class_entry;

zval* add_moap_fault(zval *obj, char *fault_code, char *fault_string, char *fault_actor, zval *fault_detail TSRMLS_DC);

#define moap_error0(severity, format) \
	php_error(severity, "moap-ERROR: " format)

#define moap_error1(severity, format, param1) \
	php_error(severity, "moap-ERROR: " format, param1)

#define moap_error2(severity, format, param1, param2) \
	php_error(severity, "moap-ERROR: " format, param1, param2)

#define moap_error3(severity, format, param1, param2, param3) \
	php_error(severity, "moap-ERROR: " format, param1, param2, param3)

#endif
