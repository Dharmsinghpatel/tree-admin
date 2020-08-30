<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>
<form id="add-document" method="POST" enctype="multipart/form-data">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="title">Title<span class="text-danger">*</span></label>
                <input type="hidden" name="document_id" value="<?php echo isset($detail) ? $detail['general_detail']->id : ''; ?>">
                <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail['general_detail']->title : '' ?>" placeholder="Title" autofocus>
                <small class="text-danger"><?php echo form_error('title'); ?></small>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="slug">Slug<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="slug" name="slug" value="<?php echo isset($detail) ? str_replace('-', ' ', $detail['general_detail']->slug) : '' ?>" placeholder="Slug Title" autofocus>
                <small class="text-danger"><?php echo form_error('slug'); ?></small>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col">
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
        </div>
        <div class="col">
            <div class="form-group">
                <label for="publish_time">Publish Time</label>
                <input type="date" class="form-control" id="publish_time" name="publish_time" value="<?php echo isset($detail) ? $detail['general_detail']->publish_time : '' ?>" placeholder="Start Date">
            </div>
        </div>
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
                    <option value="plant">Plant</option>
                    <option value="flower">Flower</option>
                    <option value="insects">Insects</option>
                    <option value="tree">Tree</option>
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
        <div class="col-4">
            <div class="form-group" id="icon">
                <label for="icon">Icon</label>
               <div id="add_icon" data-selected-id="<?php echo isset($detail) ? $detail['general_detail']->icon : ''; ?>" data-url="<?php echo site_url('resources/get-resource-content') ?>" data-file-url="<?php echo site_url('resources/get-resource') ?>"></div>
            </div>
        </div>
        <div class="<?php echo isset($detail) ? ($detail['general_detail']->icon ? 'col-6' : 'col-6 d-none') : 'col-6 d-none' ?>">
            <?php echo isset($detail) ? get_resource($detail['general_detail']->icon) : ''; ?>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <label for="keywords">Meta Data Keywords</label>
        <input type="text" class="form-control" id="keywords" name="keywords" value="<?php echo isset($detail) ? $detail['general_detail']->keywords : '' ?>" placeholder="Keywords">
    </div>

    <div class="form-group">
        <label for="meta_description">Meta Data Decription</label>
        <textarea type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Description"><?php echo isset($detail) ? $detail['general_detail']->meta_description : '' ?></textarea>
    </div>

    <hr>

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
         <a href="javascript:history.back()" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add_more" name="add_more" value="add-more" class="btn btn-outline-dark mr-10 <?php echo isset($detail) ? ($detail['general_detail']->id ? 'd-none' : '') : '' ?> ">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary "><?php echo isset($detail) ? ($detail['general_detail']->id ? 'Edit' : 'Add') : 'Add' ?></button>
        </div>
    </div>
</form>