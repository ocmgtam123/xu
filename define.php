<?php
define('DS'					, DIRECTORY_SEPARATOR); 				// Ký tự \ or /
define('SCHEME'				, (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http') . '://');
define('URL_HOST'		    , $_SERVER['HTTP_HOST']);                   	// example.com

define('URL_BASE'			, SCHEME . URL_HOST.'/xoaiuc');           			// http://example.com/
define('URL'			    , SCHEME . URL_HOST . $_SERVER['REQUEST_URI']);     	// http://example.com/abcdef.html

define('PATH_ROOT'			, dirname(__FILE__)); 					// Đường dẫn đến thư mục gốc
define('PATH_APPLICATION'	, PATH_ROOT . DS . 'application' . DS); // Đường dẫn đến thư mục application
define('PATH_LIBRARY'		, PATH_ROOT . DS . 'libs' . DS); 		// Đường dẫn đến thư mục libs
define('PATH_PUBLIC'		, PATH_ROOT . DS . 'public' . DS); 		// Đường dẫn đến thư mục public
define('PATH_INCLUDES'		, PATH_ROOT . DS . 'includes' . DS); 	// Đường dẫn đến thư mục includes
define('PATH_CONFIGS'		, PATH_ROOT . DS . 'configs' . DS); 	// Đường dẫn đến thư mục configs
define('PATH_DATABASE'		, PATH_ROOT . DS . 'database' . DS); 	// Đường dẫn đến thư mục database
define('PATH_TEMP'		    , PATH_ROOT . DS . 'temp' . DS); 	    // Đường dẫn đến thư mục temp
define('PATH_LANG'		    , PATH_ROOT . DS . 'language' . DS); 	// Đường dẫn đến thư mục languages
define('PATH_PLUGINS'		, PATH_ROOT . DS . 'plugins' . DS);
define('PATH_CACHE'		    , PATH_ROOT . DS . 'caches' . DS);
define('PATH_VENDOR'		, PATH_ROOT . DS . 'vendor' . DS);
define('PATH_UPLOAD'		,'klkim-project.appspot.com/upload/accounts' . DS);

define('URL_UPLOAD'		    ,URL_BASE .DS. 'klkim-project.appspot.com/upload/accounts' . DS);
define('URL_LANG'			,URL_BASE.DS.'language' . DS);						// Đường dẫn đến thư mục languages
define('URL_APPLICATION'	,URL_BASE.DS.'appllication' . DS);					// Đường dẫn đến thư mục aplication
define('URL_LIBRARY'		,URL_BASE.DS.'libs' . DS); 							// Đường dẫn đến thư mục libs
define('URL_PUBLIC'		    ,URL_BASE.DS. 'public' . DS); 						// Đường dẫn đến thư mục public
define('URL_IMAGES'		    ,URL_PUBLIC . 'images' . DS);   		// Đường dẫn đến thư mục images
define('URL_TEMPLATE'		,URL_PUBLIC . 'templates' . DS);   		// Đường dẫn đến thư mục templates
define('URL_CACHE'          ,URL_BASE. DS . 'caches'. DS);
define('URL_CENTER'			,"http://bidacenter.klkim.com/");
define('DEFAULT_LANG'	, 'VN'); 									// Ngôn ngữ mặc định
define('DEFAULT_CONTROLLER'	, 'dashboard'); 								// Controller mặc định
define('DEFAULT_ACTION'		, 'index');							    // Action mặc định
define('DEFAULT_PREFIX', '');
define('DEFAULT_LENGTH', 5000);										// Số dòng sql lấy ra tối đa
define('DEFAULT_LENGTH_PAGING', 2);

define('FILE_SIZE', '4MB'); 										// Kích thức tối đa của tập tin được tải lên
define('FILE_EXTENSION', 'pdf,PDF,png,jpg,JPG,jpeg,JPEG,PNG,gif,GIF');								// Định dạng tập tin tải lên hơp lệ
define('IMAGE_EXTENSION', 'png,jpg,JPG,jpeg,JPEG,PNG,gif,GIF');

define('URL_PUBLIC_ADMIN'		    ,URL_BASE.DS. 'public' . DS.'temple_admin'.DS);

define('WEBSITE'    ,'http://xoaiuc.com');
define('HOTLINE'    ,'0399176012');		
define('PHONE'    ,'0399176012');											// Password sql
define('EMAIL'	,'kisadlu@gmail.com');	
define('ADDRESS'	,'132-134 Nguyễn Gia Trí, Phường 25, Quận Bình Thạnh, TP Hồ Chí Minh');
/*
define('DB_HOST'	,'mysql:host=localhost');
define('DB_USER'	,'root');
define('DB_PWD'		,'');
*/
define('DB_HOST'	,'mysql:host=ls-4b45821b03b4a608b32200f768ffbe9b8e0935d1.cpkjfygl2loj.ap-northeast-2.rds.amazonaws.com');
define('DB_USER'	,'dbmasteruser');
define('DB_PWD'		,'12345678');

define('DB_NAME'	,'xoaiuc');
?>