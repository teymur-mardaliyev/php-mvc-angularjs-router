<div class="text-center">
    <h1>Add article page</h1>
    <p>Add article page runs with angularjs</p>
</div>

<div class="col-md-7 center-block center">
    <div id="messages" class="alert alert-{{alert_mode}} alert-dismissible" role="alert" ng-show="alert_message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ alert_message }}</div>

    <form class="form-horizontal article-form" method="post" ng-submit="addNewArticle(fields)">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" id="title" class="form-control slug-link" placeholder="Title" ng-model="fields.title">
                    <br>
                    <input type="text" class="form-control slug-link" id="slug-link" ng-model="fields.slug" placeholder="Slug">
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control" ng-model="fields.category" ng-options="cat.id as cat.title for cat in categories track by cat.id">
                        <option value="">Select category</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="describe" class="col-sm-2 control-label">Describe</label>
                <div class="col-sm-10">
                    <textarea id="describe" class="form-control" placeholder="Describe" ng-model="fields.describe"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Body</label>
                <div class="col-sm-10">
                    <textarea id="body" class="form-control" placeholder="Body" ng-model="fields.body"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Template (page view)</label>
                <div class="col-sm-10">
                    <select class="form-control" ng-model="fields.template">
                        <option value="">Select template</option>
                        <option value="article/view_left_sidebar">Left sidebar</option>
                        <option value="article/view_right_sidebar">Right sidebar</option>
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