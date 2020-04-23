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
        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail->title : '' ?>" placeholder="Title">
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select class="form-control" id="type" name="type">
            <option value="<?php echo isset($detail) ? $detail->type : '' ?>"><?php echo isset($detail) ? $detail->type : '' ?></option>
            <option value="">Select Type</option>
            <option value="image">Image</option>
            <option value="site">Site</option>
            <option value="video">Video</option>
        </select>
        <small class="text-danger"><?php echo form_error('type'); ?></small>
    </div>

    <input type="hidden" name="hidden_file" value="<?php echo isset($detail) ? $detail->file_id : '' ?>" id="hidden_file" data-file-type="<?php echo isset($detail) ? $detail->type : '' ?>">
    <input type="hidden" name="resource_id" value="<?php echo isset($detail) ? $detail->id : '' ?>" id="resource_id">

    <div id="resource_file">
        <?php
        $tr = '';
        $content = isset($detail) ? get_resource($detail->file_id) : '';
        if (isset($detail) && $detail->type == 'image') {
            $tr = '<div class="form-group" id="image">
                    <label for="image">image<span class="text-danger">*</span></label>
                    <input type="file" class="form-control p-0 border-0" id="image" name="image">
                    ' . $content . '
                </div>';
        } else {
            $tr = '<div class="form-group" id="url">
                    <label for="url">Link<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="url" name="url" value="' . $content . '" placeholder="http://..">
                    <small class="text-danger"><?php echo form_error("url"); ?></small>
                </div>';
        }
        echo $tr;
        ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description"><?php echo isset($detail) ? $detail->description : '' ?> </textarea>
    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('resources/list-resources') ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add-more" name="add-more" value="add-more" class="btn btn-outline-dark mr-10">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary ">Add Only</button>
        </div>
    </div>
</form>