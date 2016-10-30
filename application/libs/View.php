<?php

/**
 * Class View
 * The part that handles all the output
 */

class View {

    public $data;

    function __construct() {
        $this->data = new stdClass;
    }

    /**
     * simply includes (=shows) the view. this is done from the controller. In the controller, you usually say
     * $this->view->render('help/index'); to show (in this example) the view index.php in the folder help.
     * Usually the Class and the method are the same like the view, but sometimes you need to show different views.
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param array $data Data to be used in the view
     */
    public function render($filename, $data = null) {
        //print_r($data);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $this->data->{$key} = $value;
            }
        }

        require Config::get('DEFAULT_PATH_VIEW') . '_templates/header.php';
        require Config::get('DEFAULT_PATH_VIEW') . $filename . '.php';
        require Config::get('DEFAULT_PATH_VIEW') . '_templates/footer.php';
    }

    /**
     * Similar to render, but accepts an array of separate views to render between the header and footer. Use like
     * the following: $this->view->renderMulti(array('help/index', 'help/banner'));
     * @param array $filenames Array of the paths of the to-be-rendered view, usually folder/file(.php) for each
     * @param array $data Data to be used in the view
     * @return bool
     */
    public function renderMulti($templates, $data = null) {

        if ($data) {
            foreach ($data as $key => $value) {
                $this->data->{$key} = $value;
            }
        }

        if (is_array($templates)) {
            foreach ($templates as $key => $val) {
                $file = 'application/views/' . strtolower($val) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                } else {
                    require_once Config::get('DEFAULT_PATH_VIEW') . '_templates/error404.php';
                }
            }
        } else {
            require Config::get('DEFAULT_PATH_CONTROLLER') . 'home.php';
            $home = new HomeController();
            $home->index();
        }
    }

    /**
     * Same like render(), but does not include header and footer
     * @param string $filename Path of the to-be-rendered view, usually folder/file(.php)
     * @param mixed $data Data to be used in the view
     */
    public function renderWithoutHeaderAndFooter($filename, $data = null) {

        if ($data) {
            foreach ($data as $key => $value) {
                $this->data->{$key} = $value;
            }
        }

        require Config::get('DEFAULT_PATH_VIEW') . $filename . '.php';
    }

    /**
     * Renders pure JSON to the browser, useful for API construction
     * @param $data
     */
    public function renderJSON($data) {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    /**
     * renders the feedback messages into the view
     */
    public function renderFeedbackMessages() {
        // echo out the feedback messages (errors and success messages etc.),
        // they are in $_SESSION["feedback_positive"] and $_SESSION["feedback_negative"]
        require Config::get('DEFAULT_PATH_VIEW') . '_templates/feedback.php';

        // delete these messages (as they are not needed anymore and we want to avoid to show them twice
        Session::set('feedback_positive', null);
        Session::set('feedback_negative', null);
    }

    /**
     * Converts characters to HTML entities
     * This is important to avoid XSS attacks, and attempts to inject malicious code in your page.
     *
     * @param  string $str The string.
     * @return string
     */
    public function encodeHTML($str) {
        return htmlentities($str, ENT_QUOTES, 'UTF-8');
    }
}
