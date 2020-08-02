<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>

<form id="add-carousel" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo isset($detail) ? $detail['content']->title : '' ?>" placeholder="Title" autofocus>
        <small class="text-danger"><?php echo form_error('title'); ?></small>
    </div>

    <div class="form-row">
        <div class="col-6">
            <div class="form-group">
                <label for="link">Link</label>
                <input type="text" class="form-control" id="link" name="link" value="<?php echo isset($detail) ? $detail['content']->link : '' ?>" placeholder="Link">
                <small class="text-danger"><?php echo form_error('link'); ?></small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label>Document</label>
                <select class="form-control" name="document_slug">
                    <option value="">Please select</option>

                    <?php echo empty($options) ? '' : $options; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="form-row">
        <div class="col-6">
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($detail) ? $detail['content']->start_date : '' ?>" placeholder="Start Date">
                <small class="text-danger"><?php echo form_error('start_date'); ?></small>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($detail) ? $detail['content']->end_date : '' ?>" placeholder="Start Date">
                <small class="text-danger"><?php echo form_error('end_date'); ?></small>
            </div>
        </div>
    </div>

    <div class="form-group <?php echo isset($detail) && $detail['content']->file_id ? 'd-none' : '' ?>">
        <label for="image">Image</label>
        <input type="file" class="form-control p-0 border-0" id="image" name="image" value="<?php echo isset($detail) ? $detail['content']->file_id : '' ?>" placeholder="Image">
        <small class="text-danger"><?php echo form_error('image'); ?></small>
    </div>

    <input type="hidden" name="hidden_file" value="<?php echo isset($detail) ? $detail['content']->file_id : '' ?>" id="hidden_file">

    <input type="hidden" name="carousel_id" value="<?php echo isset($detail) ? $detail['content']->id : '' ?>" id="carousel_id">

    <div id="carousel_file">
        <?php echo isset($detail) && $detail['content_view'] ? $detail['content_view'] : '' ?>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" rows="3" name="description"><?php echo isset($detail) ? $detail['content']->description : '' ?> </textarea>

    </div>

    <div class="mt-50 row">
        <a href="<?php echo site_url('carousel/list-carousel/' . $is_notification) ?>" class="btn btn-outline-dark">Cancel</a>
        <div class="ml-auto">
            <button type="submit" id="add_more" name="add_more" value="add-more" class="btn btn-outline-dark mr-10 <?php echo isset($detail) ? ($detail['content']->id ? 'd-none' : '') : '' ?> ">Add More</button>
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary "><?php echo isset($detail) ? ($detail['content']->id ? 'Edit' : 'Add') : 'Add' ?> </button>
        </div>
    </div>
</form>