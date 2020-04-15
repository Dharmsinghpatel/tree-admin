<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>

<form id="add-resources" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title">
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-group">
        <label for="url">Link<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="url" name="url" placeholder="http://..">
        <small class="text-danger"><?php echo form_error('url'); ?></small>
    </div>

    <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select class="form-control" id="type" name="type">
            <option value="">Select Type</option>
            <option value="image">Image</option>
            <option value="site">Site</option>
            <option value="video">Video</option>
        </select>
        <small class="text-danger"><?php echo form_error('type'); ?></small>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('resources/list-resources') ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add-more" name="add-more" value="add-more" class="btn btn-outline-dark mr-10">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary ">Add Only</button>
        </div>
    </div>
</form>