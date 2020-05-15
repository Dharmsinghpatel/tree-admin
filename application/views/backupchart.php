<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<script>
    window.onload = function() {
        var line_chart = new CanvasJS.Chart("line_container", {
            title: {
                text: "Users Over a Week"
            },
            axisY: {
                title: "Number of Users"
            },
            data: [{
                type: "line",
                dataPoints: <?php echo json_encode($line_points, JSON_NUMERIC_CHECK); ?>
            }]
        });

        var pie_chart = new CanvasJS.Chart("pie_container", {
            animationEnabled: true,
            title: {
                text: "Usage Share of Desktop Browsers"
            },
            subtitles: [{
                text: "November 2017"
            }],
            data: [{
                type: "pie",
                yValueFormatString: "#,##0.00\"%\"",
                indexLabel: "{label} ({y})",
                dataPoints: <?php echo json_encode($pie_points, JSON_NUMERIC_CHECK); ?>
            }]
        });

        line_chart.render();
        pie_chart.render();

    }
</script>


<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>
<form id="charts" method="POST">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="pariod">Pariod<span class="text-danger">*</span></label>
                <select class="form-control" id="pariod" name="pariod">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->pariod : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->pariod) ? $detail['general_detail']->pariod : 'Select Type' ?></option>
                    <option value="">Select Type</option>
                    <option value="day">Day</option>
                    <option value="week">Week</option>
                    <option value="month">Month</option>
                    <option value="year">Year</option>
                </select>
                <small class="text-danger"><?php echo form_error('type'); ?></small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="type">Type<span class="text-danger">*</span></label>
                <select class="form-control" id="type" name="type">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->type) ? $detail['general_detail']->type : 'Select Type' ?></option>
                    <option value="">Select Type</option>
                    <option value="user">User</option>
                    <option value="video">Video</option>
                    <option value="news">News</option>
                    <option value="document">Reading content</option>
                    <option value="info">Info</option>
                </select>
                <small class="text-danger"><?php echo form_error('type'); ?></small>
            </div>
        </div>
        <div class="col align-self-center">
            <div class="mt-10">
                <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary btn-block">Show</button>
            </div>
        </div>
    </div>
</form>

<div class="col">
    <div id="line_container" class="mt-10" style="height: 370px; width: 100%;"></div>

    <div id="pie_container" class="mt-50" style="height: 370px; width: 100%;"></div>

</div>

$data['line_points'] = array(
array("y" => 25, "label" => "Sunday"),
array("y" => 15, "label" => "Monday"),
array("y" => 25, "label" => "Tuesday"),
array("y" => 5, "label" => "Wednesday"),
array("y" => 10, "label" => "Thursday"),
array("y" => 0, "label" => "Friday"),
array("y" => 20, "label" => "Saturday")
);

$data['pie_points'] = array(
array("y" => 25, "label" => "Sunday"),
array("y" => 15, "label" => "Monday"),
array("y" => 25, "label" => "Tuesday"),
array("y" => 5, "label" => "Wednesday"),
array("y" => 10, "label" => "Thursday"),
array("y" => 0, "label" => "Friday"),
array("y" => 20, "label" => "Saturday")
);


<!-- <form id="charts" method="POST">
    <div class="form-row">
        <div class="col">
            <div class="form-group">
                <label for="pariod">Pariod<span class="text-danger">*</span></label>
                <select class="form-control" id="pariod" name="pariod">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->pariod : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->pariod) ? $detail['general_detail']->pariod : 'Select Type' ?></option>
                    <option value="">Select Type</option>
                    <option value="1">Day</option>
                    <option value="7">Week</option>
                    <option value="30">Month</option>
                    <option value="365">Year</option>
                </select>
                <small class="text-danger"><?php echo form_error('type'); ?></small>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="type">Display Type<span class="text-danger">*</span></label>
                <select class="form-control" id="type" name="type">
                    <option value="<?php echo isset($detail) ? $detail['general_detail']->type : '' ?>"><?php echo isset($detail) && !empty($detail['general_detail']->type) ? $detail['general_detail']->type : 'Select Type' ?></option>
                    <option value="">Select Display Type</option>
                    <option value="video">All</option>
                    <option value="video">Video</option>
                    <option value="news">News</option>
                    <option value="document">Document</option>
                    <option value="info">Info</option>
                </select>
                <small class="text-danger"><?php echo form_error('type'); ?></small>
            </div>
        </div>
        <div class="col align-self-center">
            <div class="mt-10">
                <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary btn-block">Show</button>
            </div>
        </div>
    </div>
</form> -->