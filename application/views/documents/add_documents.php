<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>
<form id="add-document" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title<span class="text-danger">*</span></label>
        <input type="hidden" name="document_id" value="<?php echo isset($detail) ? $detail['general_detail']->id : ''; ?>">
        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail['general_detail']->title : '' ?>" placeholder="Title">
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-group">
        <label for="content_type">Content Type<span class="text-danger">*</span></label>
        <select class="form-control" id="content_type" name="content_type">
            <option value="<?php echo isset($detail) ? $detail['general_detail']->content_type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->content_type) ? $detail['general_detail']->content_type : 'Select Type' ?></option>
            <option value="">Select Type</option>
            <option value="info">Info</option>
            <option value="news">News</option>
            <option value="document">Reading Content</option>
        </select>
        <small class="text-danger"><?php echo form_error('type'); ?></small>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="type">Type<span class="text-danger">*</span></label>
                <select class="form-control" id="type" name="type">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->cl_type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->cl_type) ? $detail['general_detail']->cl_type : 'Select Type' ?></option>
                    <option value="">Select Type</option>
                    <option value="animal">Animal</option>
                    <option value="crop">Crop</option>
                    <option value="fertilizer">Fertilizer</option>
                    <option value="pesticides">Pesticides</option>
                </select>
                <small class="text-danger"><?php echo form_error('type'); ?></small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($detail) ? $detail['general_detail']->name : '' ?>" placeholder="name">
                <small class="text-danger"><?php echo form_error('name'); ?></small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="use_in">use_in</label>
                <input type="text" class="form-control" id="use_in" name="use_in" value="<?php echo isset($detail) ? $detail['general_detail']->use_in : '' ?>" placeholder="use_in">
                <small class="text-danger"><?php echo form_error('use_in'); ?></small>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group" id="icon">
                <label for="icon">Icon<span class="text-danger">*</span></label>
                <input type="hidden" id='icon_id' name="icon_id" value="<?php echo isset($detail) ? $detail['general_detail']->icon : ''; ?>">
                <input type="file" class="form-control p-0 border-0" id="icon" name="icon">
            </div>
        </div>
        <div class="<?php echo isset($detail) ? ($detail['general_detail']->icon ? 'col-4' : 'col-4 d-none') : 'col d-none' ?>">
            <?php echo isset($detail) ? get_resource($detail['general_detail']->icon) : ''; ?>
        </div>
    </div>

    <!-- <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control description" id="description" rows="3" name="documents[][2][]"></textarea>
    </div> -->

    <div id="aditional_sort">
        <?php echo isset($detail) ? $detail['resources'] : '' ?>
    </div>

    <div class="form-group mt-25">
        <label for="type">Additional Content</label>
        <select class="form-control" id="add_content" data-url="<?php echo site_url('resources/get-resource-content') ?>" data-file-url="<?php echo site_url('resources/get-resource') ?>">
            <option value="">Select Type</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="site">Site</option>
            <option value="topic">Topic</option>
            <option value="description">Description</option>
        </select>
    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('documents/list-documents') ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add_more" name="add_more" value="add-more" class="btn btn-outline-dark mr-10 <?php echo isset($detail) ? ($detail['general_detail']->id ? 'd-none' : '') : '' ?> ">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary ">Add Only</button>
        </div>
    </div>
</form>