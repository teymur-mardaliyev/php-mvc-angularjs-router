<div class="text-center">
    <h1>Article view</h1>
</div>

<div class="col-sm-12 center-block center">
    <div class="col-sm-4">
        <?php Utils::loadLibrary('View')->renderWithoutHeaderAndFooter('article/sidebar',$this->data);?>
    </div>
    <div class="col-sm-8">
        <h1><?php echo $this->data->result->title;?></h1>
        <span class="datetime"><?php echo $this->data->result->datetime;?></span>
        <div class="text text-justify">
            <?php echo $this->data->result->body;?>
        </div>
    </div>
</div>