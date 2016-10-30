<div class="text-center">
    <h1>Article view</h1>
</div>

<div class="col-sm-12 center-block center" ng-init="getArticle(<?php echo Router::get('data_id');?>)">
    <div class="col-sm-8">
        <h1>{{article.title}}</h1>
        <span class="datetime">{{article.datetime}}</span>
        <div class="text text-justify">
            {{article.body}}
        </div>
    </div>
    <div class="col-sm-4">
        <?php Utils::loadLibrary('View')->renderWithoutHeaderAndFooter('article/sidebar',$this->data);?>
    </div>
</div>