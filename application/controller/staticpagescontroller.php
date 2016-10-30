<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 6/18/16
 * Time: 02:54
 */

class StaticPagesController extends Controller{

    public  $data = array();

    function __construct() {
        parent::__construct();
    }

    /**
     * It is just example for begginers.
     * Yes. We can write in /application/controller/contactcontroller.php and change router options on setting.php.
    */

    public function contact(){
        if(Request::HttpXRequestedWith()) {
            $this->data["angular"] = true;
            $this->View->renderWithoutHeaderAndFooter('static/contact',$this->data);
        }else{
            $this->data["angular"] = false;
            $this->View->render('static/contact',$this->data);
        }
    }

}