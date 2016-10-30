<div class="text-center">
    <h1>Edit blog page</h1>
    <p>Edit blog page runs without angularjs</p>
</div>

<div class="col-md-7 center-block center">
    <?php if (!empty($this->data->result)) { ?>

        <?php echo Utils::loadLibrary('View')->renderFeedbackMessages(); ?>

        <form class="form-horizontal article-form" method="post" action="<?php echo URL; ?>blog/update">
            <input type="hidden" value="<?php echo $this->data->result->id; ?>" name="id"/>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title" class="col-sm-2 control-label"> Title</label>
                    <div class="col-sm-10">
                        <input type="text" id="title" class="form-control slug-link" placeholder="Title" name="title"
                               value="<?php echo $this->data->result->title; ?>" required>
                        <br>
                        <input type="text" class="form-control slug-link" id="slug-link" name="url"
                               placeholder="Slug (url)" value="<?php echo $this->data->result->url; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label"> Category</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="category_id" required>
                            <option> Select category</option>
                            <?php
                            if (count($this->data->categories) > 0) {
                                foreach ($this->data->categories as $key => $val) {
                                    $selected = $val->id == $this->result->category_id ? 'selected' : '';
                                    ?>
                                    <option
                                        value="<?php echo $val->id; ?>" <?php echo $selected; ?>><?php echo $val->title; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="describe" class="col-sm-2 control-label"> Describe</label>
                    <div class="col-sm-10">
                        <textarea id="describe" class="form-control" placeholder="Describe" name="description"
                                  required><?php echo $this->data->result->description; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">Body</label>
                    <div class="col-sm-10">
                        <textarea id="body" class="form-control" placeholder="Body" name="body"
                                  required><?php echo $this->data->result->body; ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label for="body" class="col-sm-2 control-label">Template (page view)</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="template" required>
                            <option value="">Select template</option>
                            <option <?php echo $this->data->result->template == 'blog/view_left_sidebar' ? 'selected' : '';; ?>
                                value="blog/view_left_sidebar">Blog Left sidebar
                            </option>
                            <option <?php echo $this->data->result->template == 'blog/view_right_sidebar' ? 'selected' : '';; ?>
                                value="blog/view_right_sidebar">Blog Right sidebar
                            </option>
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
    <?php } else { ?>
        <div class="alert alert-danger">Blog post not found.</div>
    <?php } ?>
</div>