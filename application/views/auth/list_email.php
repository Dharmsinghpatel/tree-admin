<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>
<div class="table-responsive" id="table-data">
    <table id="<?php echo $datatable_id ?>" data-url="<?php echo site_url($data_url) ?>" class="table table-bordered table-striped table-hover table-data" style="width:100%">
        <thead>
            <tr>
                <td style="width:10%">Sno</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td class="bold">Email</td>
                <td style="width:20%">Created</td>
                <td style="width:20%">Action</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>