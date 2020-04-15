<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
    <a class="ml-auto" href="<?php echo site_url($add_path) ?>">
        <button class="btn btn-primary ml-auto">Add Resource</button>
    </a>
</div>
<hr>
<div class="table-responsive" id="table-data">
    <table id="<?php echo $datatable_id ?>" data-url="<?php echo site_url($data_url) ?>" class="table table-bordered table-striped table-hover table-data" style="width:100%">
        <thead>
            <tr>
                <td>Sno</td>
                <td style="width:10%">Title</td>
                <td>Type</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>