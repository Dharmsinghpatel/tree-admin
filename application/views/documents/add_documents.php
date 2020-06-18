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
        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail['general_detail']->title : '' ?>" placeholder="Title" autofocus>
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-group">
        <label for="display_type">Display Type<span class="text-danger">*</span></label>
        <select class="form-control" id="display_type" name="display_type">
            <option value="<?php echo isset($detail) ? $detail['general_detail']->display_type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->display_type) ? $detail['general_detail']->display_type : 'Select Display Type' ?></option>
            <option value="">Select Display Type</option>
            <option value="info">Info</option>
            <option value="news">News</option>
            <option value="blog">Blog</option>
        </select>
        <small class="text-danger"><?php echo form_error('display_type'); ?></small>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="product_type">Product Type<span class="text-danger">*</span></label>
                <select class="form-control text-capitalize" id="product_type" name="product_type">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->cl_type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->cl_type) ? $detail['general_detail']->cl_type : 'Select Product Type' ?></option>
                    <option value="">Select Product Type</option>
                    <option value="none">None</option>
                    <option value="animal">Animal</option>
                    <option value="crop">Crop</option>
                    <option value="fertilizer">Fertilizer</option>
                    <option value="pesticides">Pesticides</option>
                </select>
                <small class="text-danger"><?php echo form_error('product_type'); ?></small>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo isset($detail) ? $detail['general_detail']->product_name : '' ?>" placeholder="Product Name">
                <small class="text-danger"><?php echo form_error('product_name'); ?></small>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="product_use">Product Use</label>
                <input type="text" class="form-control" id="product_use" name="product_use" value="<?php echo isset($detail) ? $detail['general_detail']->product_use : '' ?>" placeholder="Product Use">
                <small class="text-danger"><?php echo form_error('product_use'); ?></small>
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

    <div id="aditional_sort">
        <?php echo isset($detail) ? $detail['resources'] : '' ?>
    </div>

    <div class="form-group mt-25">
        <label>Additional Content</label>
        <select class="form-control" id="add_resource" data-url="<?php echo site_url('resources/get-resource-content') ?>" data-file-url="<?php echo site_url('resources/get-resource') ?>">
            <option value="">Select Resource Type</option>
            <option value="image">Image</option>
            <option value="video">Video</option>
            <option value="site">Site</option>
            <?php
            $options = '';
            if (!isset($detail) || (isset($detail) && empty(($detail['general_detail']->is_topic)))) {
                $options = '<option value="document">Document</option>';
            }
            echo $options;
            ?>
            <option value="description">Description</option>
        </select>
    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('documents/list-documents') ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add_more" name="add_more" value="add-more" class="btn btn-outline-dark mr-10 <?php echo isset($detail) ? ($detail['general_detail']->id ? 'd-none' : '') : '' ?> ">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary "><?php echo isset($detail) ? ($detail['general_detail']->id ? 'Edit' : 'Add') : 'Add' ?></button>
        </div>
    </div>
</form>