<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 8/6/16
 * Time: 20:27
 */

class ContactController extends Controller {

    public $data = array();

    function __construct() {
        parent::__construct();
    }

    public function send(){

        $html = '<div>
                    <div>Fullname: ' . htmlspecialchars(Request::post('fullname')) . '</div>
                    <div>Mail: ' . htmlspecialchars(Request::post('mail')) . '</div>
                    <div>Subject: ' . htmlspecialchars(Request::post('subject')) . '</div>
                    <div>Message: ' . htmlspecialchars(Request::post('message')) . '</div>
                </div>';

        $html = Mail::template($html);

        $mail = Mail::sendEmail('teymur.oqtayoglu@gmail.com',$html,'Contact','info@owl.az','no-replay@example.com','Router');

        if(Request::HttpXRequestedWith()) {

            $status = $mail ? 200 : 400;

            echo $this->View->renderJSON(array('status'=>$status));
        }else{
            if($mail) {
                Session::add('feedback_positive', Text::get('MESSAGE_HAS_BEEN_SENT'));
            }else{
                Session::add('feedback_negative', Text::get('MESSAGE_HASNT_BEEN_SENT'));
            }
            Redirect::to('contact'); // it will redirect to non-angular page
        }
    }

}