# php-mvc-angularjs-router
By helping “PHP MVC AngularJS Router” we can make mobile and web applications.

First of all, thanks to <a href="https://github.com/panique">Chris</a> for simple MVC framework. You can get detailed information about  “<a href="https://github.com/panique/php-login-advanced">PHP-MVC-Login</a>” made by Chris.

 “AngularJS PHP MVC Router” can help to us to make mobile and web applications together. If we know only PHP and can not write backend on `node.js`,`python`,`java` etc. for AngularJS. We are able to take advantage of  “AngularJS PHP MVC Router”, which can contribute our targets. We can enjoy with PHP Router without AngularJS. Please enter here to get information and source how to use Router without AngularJS.

With “AngularJS PHP MVC Router” we can make own CMS or simple or advantage blogs, information share or news portals, ect. Moreover we can do it very quickly and at short time.

Below, I wrote some examples how to use “Router”.

The site URL is caught via $_GET without domain, also includes/sends to Router.

 $url = isset($_GET['url']) ? $_GET['url'] : "";

 $router = new Router($url);


Notice that, we catch URL by helping .htaccess

 RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]


Adding features to Router:
Firstly, we must explain how to would be URL, for example if url like this - http://www.example.com/post/read/id/69  then run `readByID` (#2 – controller/action name) action which in article controller, and equal `:number` (in example it’s 69) to `id` (#3)
(application/controller/articlecontroller.php) 
So, the `controller/action` shows as a static and demonstrate as conventional.


 			              #1 		            #2		        #3
 $router->route('post/read/id/:number', 'article/readByID',array('id'));


To get any parameter to use we must use `get` function from `Router` class. Notice, there has been written some `regular expressions` for parameters, you can find it in Router class, moreover you can write own `regular expressions` for verify parameters value.

#examples


 echo Router::get('id');

 echo Router::get('slug');


Below we will make dynamic controller/action which got from database. For it, we have to write `*` instead of “controller/action”. It means, controller/action is held in database, and it can be any controller/action.


$router->route('page/article/:slug','*',array('slug'));


Below, after finish write Router parameters we start `splitUrl` function to start Router.


$router->splitUrl();


Database structure:</br>


`data_id` - is come from other tables `id` like post table, category table etc.</br>
`related_table` - shows that a data connected to which table</br>
`url` - unique url for page</br>
`template` - controller/action name for router.</br>



