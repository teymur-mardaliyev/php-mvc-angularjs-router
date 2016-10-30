</div>
</div>
</div>
</div>

<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Are you sure?</h3>
    </div>
    <div class="modal-body">
        Are you sure to remove {{ title }}?
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary" type="button" ng-click="modalconfirm()">OK</button>
        <button class="btn btn-warning" type="button" ng-click="cancel()">Cancel</button>
    </div>
</script>

<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/jquery.friendurl.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/angular/angular.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/angular/angular-route.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/ui-bootstrap-tpls-1.3.3.min.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/controllers.js"></script>
<script type="text/javascript" src="<?php echo URL; ?>public/assets/js/custom.js"></script>
</body>
</html>