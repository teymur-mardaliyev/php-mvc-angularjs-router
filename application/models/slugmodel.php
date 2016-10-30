<?php

/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 2/24/15
 * Time: 7:45 PM
 */
class SlugModel {

    public function add($data_id, $template, $table, $url, $visible, $options = array()) {

        $url = !empty($url) && $url != '' ? $url : $data_id;
        $url = Slug::url_slug($url, $options);
        $url = Slug::url_slug($this->pagesnum($url));

        $q = Registry::get('db')->prepare("INSERT INTO `" . DB_PREFIX . "_pages` (`data_id`, `related_table`, `template`, `url`, `visible`, `created_time`)
                                  VALUES (:data_id,:related_table,:template,:url,:visible,:created_time)");

        try {

            $insArr = array(
                ":data_id" => $data_id,
                ":related_table" => $table,
                ":template" => $template,
                ":url" => $url,
                ":visible" => $visible,
                ":created_time" => date("Y-m-d G:i:s")
            );

            $q->execute($insArr);

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }

    }

    public function edit($data_id, $template, $table, $url, $visible, $options = array()) {

        $url = !empty($url) && $url != '' ? $url : $data_id;
        $url = Slug::url_slug($url, $options);
        $url = Slug::url_slug($this->pagesnum($url, $data_id));

        if ($this->checkUrl($table, $data_id) > 0) {

            try {

                $q = Registry::get('db')->prepare("UPDATE `" . DB_PREFIX . "_pages` SET
                           `url`=:url,`template`=:template,`visible`=:visible
                           WHERE data_id=:data_id AND`related_table`=:related_table");

                $q->execute(array(
                    ":url" => $url,
                    ":template" => $template,
                    ":visible" => $visible,
                    ":data_id" => $data_id,
                    ":related_table" => $table
                ));

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;
            }

        } else {
            $this->add($data_id, $template, $table, $url, $visible);
        }

        return true;


    }

    public function checkUrl($table, $data_id) {

        $q = Registry::get('db')->prepare("SELECT `data_id`,`id`,`related_table` FROM `" . DB_PREFIX . "_pages` WHERE data_id=:data_id AND `related_table`=:related_table");

        $q->execute(array(
            ":data_id" => $data_id,
            ":related_table" => $table
        ));

        return $q->rowCount();
    }


    private function pagesnum($url, $id = '', $f_url = '') {

        $f_url = ($f_url == '') ? $url : $f_url;

        $q = Registry::get('db')->prepare("SELECT data_id,id,url,COUNT(id) AS c_id FROM `" . DB_PREFIX . "_pages` WHERE url=:url");
        $q->execute(array(":url" => $url));
        $r = $q->fetch();

        if ($r->c_id > 0 && $r->data_id != $id) {
            $num = explode('-', $r->url);
            $num2 = end($num);
            $num3 = $num2 + 1;
            return $this->pagesnum($f_url . '-' . $num3, $id, $f_url);
        } else {
            return $url;
        }
    }

    public function remove($data_id, $table) {
        $q = Registry::get('db')->prepare("DELETE FROM `" . DB_PREFIX . "_pages` WHERE `data_id`=:data_id AND `related_table`=:related_table");
        $q->execute(array(
            ":data_id" => $data_id,
            ":related_table" => $table
        ));
    }


}