<div class="text-center">
    <h1>Add new blog page</h1>
    <p>Add new blog page runs without angularjs</p>
</div>

<div class="col-md-7 center-block center">

    <?php Utils::loadLibrary('View')->renderFeedbackMessages(); ?>

    <form class="form-horizontal article-form" method="post" action="<?php echo URL; ?>blog/insert">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" id="title" class="form-control slug-link" placeholder="Title" name="title"
                           required>
                    <br>
                    <input type="text" class="form-control slug-link" id="slug-link" name="slug" placeholder="Slug"
                           required>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" name="category" required>
                        <option value="">Select category</option>
                        <?php
                        if (count($this->data->categories) > 0) {
                            foreach ($this->data->categories as $key => $val) {
                                ?>
                                <option value="<?php echo $val->id;?>"><?php echo $val->title;?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="describe" class="col-sm-2 control-label">Describe</label>
                <div class="col-sm-10">
                    <textarea id="describe" class="form-control" placeholder="Describe" name="describe"
                              required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Body</label>
                <div class="col-sm-10">
                    <textarea id="body" class="form-control" placeholder="Body" name="body" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Template (page view)</label>
                <div class="col-sm-10">
                    <select class="form-control" name="template" required>
                        <option value="">Select template</option>
                        <option value="blog/view_left_sidebar">Blog Left sidebar</option>
                        <option value="blog/view_right_sidebar">Blog Right sidebar</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </div>
    </form>
</div>