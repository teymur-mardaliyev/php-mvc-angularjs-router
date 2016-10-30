<div class="text-center">
    <h1>Contact us</h1>
    <p>Contact information</p>
</div>

<div class="col-md-7 center-block center">
    <?php if($this->data->angular==true){ ?>
    <div id="messages" class="alert alert-{{alert_mode}} alert-dismissible" role="alert" ng-show="alert_message">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ alert_message }}</div>

    <?php }else{ Utils::loadLibrary('View')->renderFeedbackMessages(); } ?>

    <form class="form-horizontal contac-form" method="post"
          <?php if($this->data->angular==true){ ?>ng-submit="sendContact(fields)"<?php }else{ ?>action="<?php echo URL;?>contact/send" <?php } ?>>
        <div class="col-md-12">
            <div class="form-group">
                <label for="fullname" class="col-sm-2 control-label">Fullname</label>
                <div class="col-sm-10">
                    <input type="text" id="fullname" class="form-control"  placeholder="Fullname" ng-model="fields.fullname" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <input type="text" id="email" class="form-control"  placeholder="Title" ng-model="fields.title" required>
                </div>
            </div>
            <div class="form-group">
                <label for="subject" class="col-sm-2 control-label">Subject</label>
                <div class="col-sm-10">
                    <select id="subject" class="form-control" ng-model="fields.subject" required>
                        <option value="">Select subject</option>
                        <option value="Thanks">Thanks</option>
                        <option value="You can better">You can better</option>
                        <option value="Improve it to perfection">Improve it to perfection</option>
                        <option value="I don't pleased">I don't pleased</option>
                        <option value="Bad resource">Bad resource</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="messages" class="col-sm-2 control-label">Message</label>
                <div class="col-sm-10">
                    <textarea id="messages" class="form-control" placeholder="Message" ng-model="fields.messages" required></textarea>
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