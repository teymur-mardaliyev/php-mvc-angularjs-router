<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 11/24/14
 * Time: 6:13 PM
 */

/**
 *
 *  Router regular expressions.
 *
    ":alphabet" => '(\w+)', // only alphabet - /slug
    ":number" => '(\d+)', // only numbers - /6996
    ":slug" => '([a-z0-9_-]+)', // alphabet from A to Z and numbers from 0 to 9 - /human-readable-url-69
    ":page" => '([0-9]+)', // only numbers - 69
    ":username" => '([a-z0-9_.-]{4,40})', // A-Z 0-9 minimum 4 maximum 40 character
    ":keyword" => '(.+)', // all symbols
    ":lang" => '([a-z]{3})', // A-Z max 3 symbol like aze;eng;rus;
 *
 */

/**
 * Note
 *        For example - $router->route('ajax/article/get/:number', 'article/get',array('id'));
 *        ajax/article/get - is requested url.
 *        We write url to router in order to it could identify url when request will be sent to him.
 *        article/get - is controller/action - it means that which controller and action has to work.
 *
 *        *****array('id') - for, router can parse it and gives :number - a name,
 *        You can call and get value like this - Router::get('id')
 */


$router = new Router($url);

/**
 *      AJAX Requests
 **/

/* Home page ajax requests */

$router->route('ajax/post/all', 'home/getAllPosts');

/* Category ajax requests */

$router->route('ajax/category/add', 'category/insert');
$router->route('ajax/category/all', 'category/get');
$router->route('ajax/category/remove', 'category/remove');
$router->route('ajax/category/posts/:number', 'category/getPosts',array('id'));

/* Article ajax requests */

$router->route('ajax/article/all', 'article/all');
$router->route('ajax/article/insert', 'article/insert');
$router->route('ajax/article/update', 'article/update');
$router->route('ajax/article/remove', 'article/remove');
$router->route('ajax/article/get/:number', 'article/get',array('id'));

/**
 *      Pages
 **/

/* Category page - Request is sent by Angular JS Router */

$router->route('page/category/:slug','*',array('slug'));
$router->route('page/category','category/index');

/*
 * Yes, also we can use this version
$router->route('page/category/:slug','*',array('slug'));*/

/* Article pages - Request is come by Angular JS Router */

$router->route('page/articles','article/index');
$router->route('page/add-article','article/add');
$router->route('page/edit-article','article/edit');
$router->route('page/article/:slug','*',array('slug'));

/* Blog pages - Request is come by http */

$router->route('blog/list','blog/posts');
$router->route('blog/add-blog-post','blog/add');
$router->route('blog/read/:slug','*',array('slug'));
$router->route('blog/edit-blog-post/:number','blog/edit',array('id'));
$router->route('blog/delete/:number','blog/remove',array('id'));

/* Static pages */

$router->route('page/homepage','home/open');
$router->route('page/contact','staticpages/contact');

/* Contact send */
$router->route('contact/send', 'contact/send');

/* Main page */
$router->route('contact', 'staticpages/contact');
$router->route('index', 'home/index', array('page'));


$router->splitUrl();
