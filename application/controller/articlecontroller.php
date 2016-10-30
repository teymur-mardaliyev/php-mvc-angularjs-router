<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 7/22/16
 * Time: 22:56
 */

class ArticleController extends Controller{

    private $ArticleModel;
    public $data = array();

    function __construct() {
        parent::__construct();
        $this->ArticleModel = Utils::loadModel('ArticleModel');
    }

    public function index(){
        $this->View->renderWithoutHeaderAndFooter('article/index');
    }

    public function get(){
        $this->View->renderJSON($this->ArticleModel->get(Router::get('id')));
    }

    public function all(){
        $this->View->renderJSON($this->ArticleModel->all(' AND art.`type`="article"'));
    }

    public function add(){
        $this->View->renderWithoutHeaderAndFooter('article/add-article');
    }

    public function edit(){
        $this->View->renderWithoutHeaderAndFooter('article/edit-article');
    }

    public function insert(){
        $this->View->renderJSON($this->ArticleModel->insert('article'));
    }

    public function update(){
        $this->View->renderJSON($this->ArticleModel->update());
    }

    public function remove(){
        $this->View->renderJSON($this->ArticleModel->remove(Request::post('id')));
    }

    // For instance: we can call this page by AngularJs and also send and print data with php
    // Router:get('data_id') - `data_id` is from `pages` - table, it is article id which has been inserted for relation
    public function view_left_sidebar(){
        $this->data["result"] = $this->ArticleModel->get(Router::get('data_id'));
        $this->View->renderWithoutHeaderAndFooter('article/view_left_sidebar',$this->data);
    }

    // In this example, everything works by angular.
    public function view_right_sidebar(){
        $this->View->renderWithoutHeaderAndFooter('article/view_right_sidebar');
    }

}