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
        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail['content']->title : '' ?>" placeholder="Title">
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-group">
        <label for="type">Type<span class="text-danger">*</span></label>
        <select class="form-control" id="type" name="type">
            <option value="<?php echo isset($detail) ? $detail['content']->type : '' ?>"><?php echo isset($detail) ? $detail['content']->type : 'Select Type' ?></option>
            <option value="">Select Type</option>
            <option value="image">Image</option>
            <option value="site">Site</option>
            <option value="video">Video</option>
        </select>
        <small class="text-danger"><?php echo form_error('type'); ?></small>
    </div>

    <input type="hidden" name="hidden_file" value="<?php echo isset($detail) ? $detail['content']->file_id : '' ?>" id="hidden_file" data-file-type="<?php echo isset($detail) ? $detail['content']->type : '' ?>">

    <input type="hidden" name="hidden_file_2" value="<?php echo isset($detail) ? $detail['content']->file_id_2 : '' ?>" id="hidden_file_2">

    <input type="hidden" name="resource_id" value="<?php echo isset($detail) ? $detail['content']->id : '' ?>" id="resource_id">

    <div id="resource_file">
        <?php echo isset($detail) && $detail['content_view'] ? $detail['content_view'] : '' ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description"><?php echo isset($detail) ? $detail['content']->description : '' ?> </textarea>

    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('resources/list-resources') ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add_more" name="add_more" value="add-more" class="btn btn-outline-dark mr-10 <?php echo isset($detail) ? ($detail['content']->id ? 'd-none' : '') : '' ?> ">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary "><?php echo isset($detail) ? ($detail['content']->id ? 'Edit' : 'Add') : 'Add' ?> </button>
        </div>
    </div>
</form>