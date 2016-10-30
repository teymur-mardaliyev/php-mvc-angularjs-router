<?php
/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 6/24/15
 * Time: 04:11
 */

class CategoryModel{

    public function insert(){

        $q  = Registry::get('db')->prepare("INSERT INTO `".DB_PREFIX."_category`(`id`, `parent_id`, `title`, `order`) VALUES (NULL,:parent_id,:title,:order)");

        $title = htmlspecialchars(Request::post('title'));
        $template = htmlspecialchars(Request::post('template'));
        $slug = htmlspecialchars(Request::post('slug'));

        $slug = $slug!=''?$slug:$title;

        try {

            if ($q->execute(array(
                ":parent_id" => 0,
                ":title" => $title,
                ":order" => 0
            ))
            ) {

                Utils::loadModel('SlugModel')->add(
                    Registry::get('db')->lastInsertId(),
                    $template,
                    TBL_CATEGORY,
                    $slug, 1);

                return array(
                    "status" => 200
                );

            } else {
                return array("status" => 400);
            }

        } catch (PDOException $e) {
            echo $e->errorInfo();
        }

    }

    public function get($id){

        $q  = Registry::get('db')->prepare("SELECT c.`id`,c.`parent_id`,c.`order`,c.`title`,p.`url`,p.`template` FROM `".DB_PREFIX."_category` c
        LEFT JOIN `".DB_PREFIX."_pages` p ON p.`data_id`=c.`id` AND p.`related_table`=:related_table
        WHERE 1=1 AND c.`id`=:id GROUP BY c.`id` ORDER BY c.`order`");

        try{
            $q->execute(array(
                ":id"            => $id,
                ":related_table" => TBL_CATEGORY
            ));

            return $q->fetch();
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    public function all($sql=''){

        $q  = Registry::get('db')->prepare("SELECT c.`id`,c.`parent_id`,c.`order`,c.`title`,p.`url`,p.`created_time`,p.`template` FROM `".DB_PREFIX."_category` c
        LEFT JOIN `".DB_PREFIX."_pages` p ON p.`data_id`=c.`id`
        WHERE 1=1 AND p.`related_table`=:related_table ".$sql." GROUP BY c.`id` ORDER BY p.`created_time` DESC");

        try{
            $q->execute(array(
                ":related_table" => TBL_CATEGORY
            ));

            return $q->fetchAll();
        }catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    public function remove() {

        $q = Registry::get('db')->prepare("DELETE FROM `" . DB_PREFIX . "_category` WHERE `id`=:id");
        $id = htmlspecialchars(Request::post('id'));
        try {

            if ($q->execute(array(
                ":id" => $id
            ))
            ) {
                Utils::loadModel('SlugModel')->remove($id,TBL_CATEGORY);
                return array("status" => 200);
            } else {
                return array("status" => 400);
            }

        } catch (PDOException $e) {
            echo $e->errorInfo();
        }
    }

}