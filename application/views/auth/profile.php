<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>
<form id="profile" method="POST" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($detail) ? $detail->name : '' ?>" placeholder="Name">
        <small class="text-danger"><?php echo form_error('name'); ?></small>
    </div>

    <div class="form-group">
        <label for="user_id">User Id<span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo isset($detail) ? $detail->user_id : '' ?>" placeholder="User Id">
        <small class="text-danger"><?php echo form_error('user_id'); ?></small>
    </div>

    <div class="form-row">
        <div class="col">
            <div class="form-group" id="icon">
                <label for="logo">logo<span class="text-danger">*</span></label>
                <input type="hidden" id='logo_id' name="logo_id" value="<?php echo isset($detail) ? $detail->logo_id : ''; ?>">
                <input type="file" class="form-control p-0 border-0" id="logo" name="logo">
            </div>
        </div>
        <div class="<?php echo isset($detail) ? ($detail->logo_id ? 'col-4' : 'col-4 d-none') : 'col d-none' ?>">
            <?php echo isset($detail) ? get_resource($detail->logo_id) : ''; ?>
        </div>
    </div>

    <hr />
    <div class="form-group">
        <label for="crpassword">Current Password</label>
        <input type="text" class="form-control" id="crpassword" name="crpassword" placeholder="Current Password">
        <small class="text-danger"><?php echo form_error('crpassword'); ?></small>
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="text" class="form-control" id="password" name="password" placeholder="Password">
        <small class="text-danger"><?php echo form_error('password'); ?></small>
    </div>

    <div class="form-group">
        <label for="cpassword">Confirm Password</label>
        <input type="text" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
        <small class="text-danger"><?php echo form_error('cpassword'); ?></small>
    </div>

    <div class="mt-50 row">
        <div class="ml-auto">
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary ">Update</button>
        </div>
    </div>
</form>