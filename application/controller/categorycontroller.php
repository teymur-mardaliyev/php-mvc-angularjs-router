<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 7/22/16
 * Time: 22:50
 */

class CategoryController extends Controller{

    private $CategoryModel;
    public  $ArticleModel;
    public  $data = array();

    function __construct() {
        parent::__construct();
        $this->ArticleModel  = Utils::loadModel('ArticleModel');
        $this->CategoryModel = Utils::loadModel('CategoryModel');
    }

    // It will run with angular js
    public function index(){
        $this->View->renderWithoutHeaderAndFooter('category/category-angular');
    }


    public function insert(){
        $this->View->renderJSON($this->CategoryModel->insert());
    }

    public function get(){
        $this->View->renderJSON($this->CategoryModel->all());
    }

    public function remove(){
        $this->View->renderJSON($this->CategoryModel->remove());
    }

    public function getPosts(){
        $this->View->renderJSON($this->ArticleModel->all('AND art.`category_id`="'.Router::get('id').'"'));
    }


    // For instance: we can call this page by AngularJs and also send and print data with php
    // Router:get('data_id') - `data_id` is from `pages` - table, it is article id which has been inserted for relation
    public function category_left_sidebar(){
        $this->data["category"] = $this->CategoryModel->get(Router::get('data_id'));
        $this->View->renderWithoutHeaderAndFooter('category/category_left_sidebar',$this->data);
    }

    // In this example, everything is worked by angular.
    public function category_right_sidebar(){
        $this->data["category"] = $this->CategoryModel->get(Router::get('data_id'));
        $this->View->renderWithoutHeaderAndFooter('category/category_right_sidebar',$this->data);
    }
}