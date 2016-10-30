<h1>Category page</h1>
<p>Category runs with angularjs</p>

<div class="col-md-12" ng-init="getCategories()">
    <div id="messages" class="alert alert-{{alert_mode}} alert-dismissible" role="alert" ng-show="alert_message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        {{ alert_message }}
    </div>

    <form class="form-inline category-form" method="post" ng-submit="addNewCategory(categoryfields)">
        <div class="form-group">
            <input type="text" name="title" class="form-control slug-link" placeholder="Title"
                   ng-model="categoryfields.title">
            <input type="text" class="form-control slug-link" id="slug-link" name="json_data[slug]" placeholder="Slug">

            <select class="form-control" name="template" ng-model="categoryfields.template">
                <option value="">Select template</option>
                <option value="category/category_left_sidebar">Left sidebar</option>
                <option value="category/category_right_sidebar">Right sidebar</option>
            </select>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

    <div class="row top-buffer">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li class="active">Category list</li>
            </ol>

            <table class="table table-bordered table-stripped">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Template</th>
                    <th>Created date</th>
                    <th>Action</th>
                </tr>
                <tr ng-repeat="category in categories" ng-include="'display'">
                </tr>
            </table>
        </div>
    </div>
    <script type="text/ng-template" id="display">
        <td>{{category.id}}</td>
        <td><a href="<?php echo URL; ?>#/category/{{category.url}}">{{category.title}}</a></td>
        <td><a href="<?php echo URL; ?>#/category/{{category.url}}">{{category.url}}</a></td>
        <td>{{category.template}}</td>
        <td>{{category.created_time}}</td>
        <td>
            <button class="btn btn-sm btn-danger" ng-click="removeCategory($index,category)">Del</button>
        </td>
    </script>
</div>