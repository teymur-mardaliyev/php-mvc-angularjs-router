<?php


class HomeController extends Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
    }

    public function index() {

        $this->data["title"] = "Router - Home";

        $this->View->renderMulti(array('_templates/header', 'home/index', '_templates/footer'), $this->data);
    }

    public function open() {

        $this->data["title"] = "Router - Home";

        $this->View->renderWithoutHeaderAndFooter('home/main', $this->data);
    }

    public function getAllPosts(){
        $posts = Utils::loadModel('ArticleModel')->all();
        echo $this->View->renderJSON($posts);
    }
}
