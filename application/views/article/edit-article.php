<div class="text-center">
    <h1>Edit article page</h1>
    <p>Edit article page runs with angularjs</p>
</div>

<div class="col-md-7 center-block center" ng-init="getEditArticle()">
    <div id="messages" class="alert alert-{{alert_mode}} alert-dismissible" role="alert" ng-show="alert_message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ alert_message }}</div>

    <form class="form-horizontal article-form" method="post" ng-submit="editArticle(article)">
        <div class="col-md-12">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" id="title" class="form-control slug-link" placeholder="Title" ng-model="article.title" value="{{article.title}}">
                    <br>
                    <input type="text" class="form-control slug-link" id="slug-link" ng-model="article.url" placeholder="Slug (url)" value="{{article.url}}">
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                    <select class="form-control"
                            ng-options="cat.id as cat.title for cat in categories"
                            ng-model="article.category_id">
                        <option value="">Select category</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="describe" class="col-sm-2 control-label">Describe</label>
                <div class="col-sm-10">
                    <textarea id="describe" class="form-control" placeholder="Describe" ng-model="article.description">{{article.description}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Body</label>
                <div class="col-sm-10">
                    <textarea id="body" class="form-control" placeholder="Body" ng-model="article.body">{{article.body}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="body" class="col-sm-2 control-label">Template (page view)</label>
                <div class="col-sm-10">
                    <select class="form-control" ng-model="article.template">
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