<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
    <p class="ml-auto" href="<?php echo site_url($add_path) ?>">
        <span>Last Updated <strong><?php echo isset($setting) ?  date("d-m-Y h:i:sa D", strtotime($setting->updated)) : 0 ?></strong></span>
    </p>
</div>
<hr>

<form id="setting" method="POST">
    <div class="form-row">
        <div class="col form-group">
            <label>API ON</label>
        </div>

        <div class="col-auto form-group">
            <input name="api_on" type="checkbox" value="<?php echo isset($setting) ? $setting->api_on : 0 ?>" <?php echo isset($setting) ? ($setting->api_on ? 'checked' : '') : '' ?>>
        </div>
    </div>
    <input type="hidden" name="id" value="<?php echo isset($setting) ? $setting->id : 1 ?>">

    <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Dashboard Random Order</label>
        </div>
        <div class="col-auto form-group">
            <input name="dashboard_random" type="checkbox" value="<?php echo isset($setting) ? $setting->dashboard_random : 0 ?>" <?php echo isset($setting) ? ($setting->dashboard_random ? 'checked' : '') : '' ?>>
        </div>
    </div>

    <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Comment Allow</label>
        </div>
        <div class="col-auto form-group">
            <input name="comment_allow" type="checkbox" value="<?php echo isset($setting) ? $setting->comment_allow : 0 ?>" <?php echo isset($setting) ? ($setting->comment_allow ? 'checked' : '') : '' ?>>
        </div>
    </div>

    <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Carousel Carousel Random</label>
        </div>
        <div class="col-auto form-group">
            <input name="carousel_random" type="checkbox" value="<?php echo isset($setting) ? $setting->carousel_random : 0 ?>" <?php echo isset($setting) ? ($setting->carousel_random ? 'checked' : '') : '' ?>>
        </div>
    </div>

    <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Carousel Carousel Click Event</label>
        </div>
        <div class="col-auto form-group">
            <input name="carousel_event" type="checkbox" value="<?php echo isset($setting) ? $setting->carousel_event : 0 ?>" <?php echo isset($setting) ? ($setting->carousel_event ? 'checked' : '') : '' ?>>
        </div>
    </div>

    <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Curousel Slide Limit</label>
        </div>
        <div class="col-auto form-group">
            <input name="carousel_limit" type="number" min="1" max="20" value="<?php echo isset($setting) ? $setting->carousel_limit : 1 ?>">
        </div>
    </div>

    <div class="mt-50 row">
        <div class="ml-auto">
            <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary ">Save</button>
        </div>
    </div>
</form>

 <hr />

    <div class="form-row">
        <div class="col form-group">
            <label>Clean Waste files</label>
        </div>
        <div class="col-auto form-group">
             <a class="mr-10" href="javascript:void(0)">
                    <button class="btn btn-outline-secondary delete" data-delete-url="<?php echo site_url('/setting/clean-waste-files')?>" ><span class="fa fa-trash-o f-24"></span></button>
            </a>
        </div>
    </div>