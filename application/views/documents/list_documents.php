<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
    <a class="ml-auto" href="<?php echo site_url($add_path) ?>">
        <button class="btn btn-primary ml-auto"><?php echo $add_title ?></button>
    </a>
</div>
<hr>
<div class="table-responsive" id="table-data">
    <table id="<?php echo $datatable_id ?>" data-url="<?php echo site_url($data_url) ?>" class="table table-bordered table-striped table-hover table-data" style="width:100%" data-url-sort="<?php echo site_url($data_url_sort) ?>">
        <thead>
            <tr>
                <td style="width:10%">Sno</td>
                <td>Title</td>
                <td style="width:20%">Created</td>
                <td style="width:20%">Updated</td>
                <td style="width:20%">Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>