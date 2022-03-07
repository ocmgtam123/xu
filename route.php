<?php 
$route = new Route();
// ajax
$route->get('ajax', '/ajax.html', null);
//web
$route->get('home'   , '/', 'dashboard@home');
$route->get(''       , '/home.html', 'dashboard@home');
$route->get('about'  , '/about.html', 'dashboard@about');
$route->get('product', '/product.html', 'dashboard@product');
$route->get('uploadimages', '/uploadimages.html', 'dashboard@uploadimages');

$route->get('news'   , '/news.html', 'dashboard@news');
$route->get('news1', '/news{page?}.html', 'dashboard@news')->where(['page'=>'[0-9]+']);
$route->get('newsdetail{slug}', '/news-detail/{slug}.html', 'dashboard@newsdetail')->where(['slug'=>'[a-zA-Z0-9%-]+']); //'[a-zA-Z0-9-]+'
$route->get('contact', '/contact.html', 'dashboard@contact');
$route->get('cart'   , '/cart.html', 'dashboard@cart');

$route->get('admindashboard', '/admindashboard.html', 'admindashboard@index');
$route->get('admindashboardedit', '/admindashboard-edit.html/{id?}', 'admindashboard@edit')->where(['id'=>'[0-9]+']);

$route->get('adminlogin', '/adminlogin.html', 'adminuser@login');
$route->get('adminlogout', '/adminlogout.html', 'adminuser@logout');
$route->get('adminuser', '/adminuser.html', 'adminuser@index');
$route->get('adminuseredit', '/adminuseredit.html/{id?}', 'adminuser@edit');

$route->get('admininformation', '/admininformation.html', 'admininformation@index');
$route->get('admininformationedit', '/admininformationedit.html/{id}', 'admininformation@edit');

$route->get('adminorder', '/adminorder.html', 'adminorder@index');
$route->get('adminorderstatus', '/adminorder-{status}.html', 'adminorder@status');
$route->get('adminorderadd', '/adminorderadd.html', 'adminorder@add');
$route->get('adminorderedit', '/adminorderedit.html/{id}', 'adminorder@edit');

$route->get('adminproduct', '/adminproduct.html', 'adminproduct@index');
$route->get('adminproductadd', '/adminproductadd.html', 'adminproduct@add');
$route->get('adminproductedit', '/adminproductedit.html/{id}', 'adminproduct@edit');

$route->get('adminfollow', '/adminfollow.html', 'adminfollow@index');
$route->get('adminfollowedit', '/adminfollowedit.html/{id}', 'adminfollow@edit');

$route->get('adminnews', '/adminnews.html', 'adminnews@index');
$route->get('adminnewsadd', '/adminnewsadd.html', 'adminnews@add');
$route->get('adminnewsedit', '/adminnewsedit.html/{id}', 'adminnews@edit');

?>