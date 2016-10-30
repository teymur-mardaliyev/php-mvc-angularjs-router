<h1>Article page</h1>
<p>Article information</p>

<div id="messages" class="alert alert-{{alert_mode}} alert-dismissible" role="alert" ng-show="alert_message">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ alert_message }}</div>

<div class="row top-buffer">
    <div class="col-md-12">
        <ol class="breadcrumb">
            <li class="active">Articles list</li>
        </ol>

        <a class="btn btn-sm btn-success" href="#/add-article">Add new article</a>
        <div class="clear-fix"></div>
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
            <tr ng-repeat="art in articles" ng-include="'display'">
            </tr>
        </table>
    </div>
</div>
<script type="text/ng-template" id="display">
    <td>{{art.id}}</td>
    <td>{{art.title}}</td>
    <td>{{art.description}}</td>
    <td>{{art.url}}</td>
    <td>{{art.template}}</td>
    <td>{{art.datetime}}</td>
    <td>
        <a class="btn btn-sm btn-warning" href="#/edit-article/{{art.id}}" >Edit</a>
        <button class="btn btn-sm btn-danger" ng-click="removeArticle($index,art)" >Del</button>
    </td>
</script>