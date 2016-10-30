<?php

/**
 * Created by PhpStorm.
 * User: Tima
 * Date: 8/2/16
 * Time: 16:12
 */
class ArticleModel {

    public function insert($type = 'article') {

        $q = Registry::get('db')->prepare("INSERT INTO `" . DB_PREFIX . "_articles`(`category_id`, `type`, `title`, `description`, `body`, `datetime`) VALUES (:cat_id, :type, :title, :description, :body, :datetime)");

        $title = htmlspecialchars(Request::post('title'));
        $slug = htmlspecialchars(Request::post('slug'));
        $category = htmlspecialchars(Request::post('category'));
        $describe = htmlspecialchars(Request::post('describe'));
        $body = htmlspecialchars(Request::post('body'));
        $template = htmlspecialchars(Request::post('template'));

        $slug = $slug != '' ? $slug : $title;

        try {

            if ($q->execute(array(
                ":cat_id" => $category,
                ":type" => $type,
                ":title" => $title,
                ":description" => $describe,
                ":body" => $body,
                ":datetime" => Config::get('DATETIME')
            ))
            ) {

                Utils::loadModel('SlugModel')->add(
                    Registry::get('db')->lastInsertId(),
                    $template,
                    TBL_ARTICLES,
                    $slug, 1);

                return array(
                    "status" => 200,
                    "id" => Registry::get('db')->lastInsertId()
                );

            } else {
                return array("status" => 400);
            }

        } catch (PDOException $e) {
            echo $e->errorInfo();
        }

    }

    public function update() {

        $q = Registry::get('db')->prepare("UPDATE `" . DB_PREFIX . "_articles` SET `category_id`=:cat_id,`title`=:title,`description`=:description,`body`=:body WHERE `id`=:id");

        $title = htmlspecialchars(Request::post('title'));
        $slug = htmlspecialchars(Request::post('url'));
        $category = htmlspecialchars(Request::post('category_id'));
        $describe = htmlspecialchars(Request::post('description'));
        $body = htmlspecialchars(Request::post('body'));
        $template = htmlspecialchars(Request::post('template'));
        $id = htmlspecialchars(Request::post('id'));

        try {

            if ($q->execute(array(
                ":cat_id" => $category,
                ":title" => $title,
                ":description" => $describe,
                ":body" => $body,
                ":id" => Request::post('id')
            ))
            ) {

                Utils::loadModel('SlugModel')->edit(
                    $id,
                    $template,
                    TBL_ARTICLES,
                    $slug, 1);

                return array(
                    "status" => 200,
                    "id" => $id
                );

            } else {
                return array(
                    "status" => 400,
                    "id" => $id
                );
            }

        } catch (PDOException $e) {
            echo $e->errorInfo();
        }
    }

    public function get($id) {

        $q = Registry::get('db')->prepare("SELECT art.`id`, art.`category_id`, art.`type`, art.`title`, art.`description`,
        art.`body`, art.`datetime`,p.`url`,p.`template`
        FROM `" . DB_PREFIX . "_articles` art
        LEFT JOIN `" . DB_PREFIX . "_pages` p
        ON p.`data_id`=art.`id` AND p.`related_table`=:related_table
        WHERE 1=1 AND art.`id`=:id
        GROUP BY art.`id` ORDER BY art.`id` DESC");

        try {
            $q->execute(array(
                ":id" => $id,
                ":related_table" => TBL_ARTICLES
            ));

            return $q->fetch();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function all($sql = '') {

        $q = Registry::get('db')->prepare("SELECT art.`id`, art.`category_id`, art.`type`, art.`title`, art.`description`,
        art.`body`, art.`datetime`,p.`url`,p.`template`
        FROM `" . DB_PREFIX . "_articles` art
        LEFT JOIN `" . DB_PREFIX . "_pages` p
        ON p.`data_id`=art.`id` AND p.`related_table`=:related_table
        WHERE 1=1 " . $sql . "
        GROUP BY art.`id` ORDER BY art.`id` DESC");

        try {
            $q->execute(array(
                ":related_table" => TBL_ARTICLES
            ));

            return $q->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function remove($id) {

        $q = Registry::get('db')->prepare("DELETE FROM `" . DB_PREFIX . "_articles` WHERE `id`=:id");

        try {

            if ($q->execute(array(
                ":id" => $id
            ))
            ) {
                Utils::loadModel('SlugModel')->remove($id,TBL_ARTICLES);
                return array("status" => 200);
            } else {
                return array("status" => 400);
            }

        } catch (PDOException $e) {
            echo $e->errorInfo();
        }
    }
}