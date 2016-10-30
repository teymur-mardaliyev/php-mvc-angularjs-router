<h1>Blog page</h1>
<p>It runs without angular js</p>

<div class="row top-buffer">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="active">Blog posts</li>
        </ol>

        <a class="btn btn-sm btn-success" href="<?php echo URL;?>blog/add-blog-post">Add new blog post</a>
        <div class="clear-fix"></div>
        <br />
        <?php Utils::loadLibrary('View')->renderFeedbackMessages(); ?>
        <br />
        <table class="table table-bordered table-stripped">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Slug</th>
                <th>Template</th>
                <th>Created date</th>
                <th>Action</th>
            </tr>
            <?php
                if(count($this->data->result)>0) {
                    foreach ($this->data->result as $key => $val) {
                        ?>
                        <tr>
                            <td><?php echo $val->id;?></td>
                            <td><?php echo $val->title;?></td>
                            <td><?php echo $val->description;?></td>
                            <td><?php echo $val->url;?></td>
                            <td><?php echo $val->template;?></td>
                            <td><?php echo $val->datetime;?></td>
                            <td>
                                <a class="btn btn-sm btn-warning" href="<?php echo URL;?>blog/edit-blog-post/<?php echo $val->id;?>">Edit</a>
                                <a class="btn btn-sm btn-danger" onclick="DeleteConfirm('<?php echo htmlspecialchars($val->title);?>');" href="<?php echo URL;?>blog/delete/<?php echo $val->id;?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </table>
    </div>
</div>