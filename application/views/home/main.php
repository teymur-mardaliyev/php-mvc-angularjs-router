<div class="col-md-12" ng-init="getAllPosts()">
    <div class="col-sm-8">
        <div class="media" ng-repeat="post in posts">
            <div class="media-left media-middle">
                <a href="<?php echo URL; ?>{{ post.type == 'article' ? '#/article/' : 'blog/read/' }}{{post.url}}">
                    <img class="media-object" src="<?php echo URL; ?>public/uploads/Racoon-Mario-icon.png"
                         alt="{{post.title}}">
                </a>
            </div>
            <div class="media-body">
                <a href="<?php echo URL; ?>{{ post.type == 'article' ? '#/article/' : 'blog/read/' }}{{post.url}}"><h4 class="media-heading">{{post.title}}</h4></a>
                <p>{{post.description}}</p>
                <span class="date">{{post.datetime}}</span>
                <a href="<?php echo URL; ?>{{ post.type == 'article' ? '#/article/' : 'blog/read/' }}{{post.url}}">Read more</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <?php Utils::loadLibrary('View')->renderWithoutHeaderAndFooter('article/sidebar',$this->data);?>
    </div>
</div>