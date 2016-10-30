<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 7/22/16
 * Time: 23:00
 */

class BlogController extends Controller{

    private $ArticleModel;
    private $CategoryModel;
    public  $data = array();

    function __construct() {
        parent::__construct();
        $this->CategoryModel = Utils::loadModel('CategoryModel');
        $this->ArticleModel = Utils::loadModel('ArticleModel');
    }

    public function index() {
        $this->data["result"] = $this->ArticleModel->all(' AND art.`type`="blog"');
        $this->View->render('blog/posts',$this->data);
    }

    // it is just for example.
    public function posts(){
        $this->index();
    }

    public function add(){
        $this->data["categories"] = $this->CategoryModel->all();
        $this->View->render('blog/add-blog',$this->data);
    }

    public function edit(){
        $this->data["result"] = $this->ArticleModel->get(Router::get('id'));
        $this->data["categories"] = $this->CategoryModel->all();
        $this->View->render('blog/edit-blog',$this->data);
    }

    public function insert(){
        $insert = $this->ArticleModel->insert('blog');
        if($insert['status']==200){
            Session::add('feedback_positive','Blog post was inserted.');
        }else{
            Session::add('feedback_negative','Blog post was not inserted.');
        }
        Redirect::to('blog/add-blog-post');
        // you can also redirect to edit page
        // Redirect::to('blog/add-blog-post' . $insert["id"]);
    }

    public function update(){
        $update  = $this->ArticleModel->update();
        if($update['status']==200){
            Session::add('feedback_positive','Blog post was updated.');
        }else{
            Session::add('feedback_negative','Blog post was not updated.');
        }
        Redirect::to('blog/edit-blog-post/'.$update['id']);
    }

    public function remove(){
        $remove = $this->ArticleModel->remove(Router::get('id'));
        if($remove['status']==200){
            Session::add('feedback_positive','Blog post was deleted.');
        }else{
            Session::add('feedback_negative','Blog post was not deleted.');
        }
        Redirect::to('blog/list');
    }

    // For instance: we can call this page by AngularJs and also send and print data with php
    // Router:get('data_id') - `data_id` is from `pages` - table, it is article id which has been inserted for relation
    public function view_left_sidebar(){
        $this->data["result"] = $this->ArticleModel->get(Router::get('data_id'));
        $this->View->render('blog/view_left_sidebar',$this->data);
    }

    // In this example, everything works by angular.
    public function view_right_sidebar(){
        $this->data["result"] = $this->ArticleModel->get(Router::get('data_id'));
        $this->View->render('blog/view_right_sidebar',$this->data);
    }

}