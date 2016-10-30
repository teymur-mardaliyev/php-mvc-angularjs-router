<?php
/**
 * Created by Teymur Lennon Mardaliyev.
 */

class Mail{

    public static function sendEmail($to , $html, $title, $from, $replay, $sitename){

        $headers  = "From: ".$from."\r\n";
        $headers .= "Reply-To: ". $replay . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UFT-8\r\n";
        $subject = $title." | ".$sitename;


        if(mail($to, $subject, $html, $headers)){
            return true;
        }else{
            return false;
        }

    }

    public static function template($html){

        $html = '<div>Template of mail header</div>
                 <div>Mail body = '.$html.' </div>
                 <div>Template of mail footer</div>';

        return $html;

    }

}