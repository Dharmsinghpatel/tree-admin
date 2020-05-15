<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<script>
    window.onload = function() {
        overall = new CanvasJS.Chart("overall", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor Overall"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['overall']['animal'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Crop",
                markerSize: 0,
                toolTipContent: "Crop View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['overall']['crop'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Fertilizer",
                markerSize: 0,
                toolTipContent: "Fertilizer View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['overall']['fertilizer'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Pesticides",
                markerSize: 0,
                toolTipContent: "Pesticides View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['overall']['pesticides'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        overall.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            overall.render();
        }

        info = new CanvasJS.Chart("info", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor Info"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['info']['animal'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Crop",
                markerSize: 0,
                toolTipContent: "Crop View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['info']['crop'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Fertilizer",
                markerSize: 0,
                toolTipContent: "Fertilizer View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['info']['fertilizer'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Pesticides",
                markerSize: 0,
                toolTipContent: "Pesticides View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['info']['pesticides'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        info.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            info.render();
        }

        news = new CanvasJS.Chart("news", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor News"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['news']['animal'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Crop",
                markerSize: 0,
                toolTipContent: "Crop View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['news']['crop'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Fertilizer",
                markerSize: 0,
                toolTipContent: "Fertilizer View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['news']['fertilizer'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Pesticides",
                markerSize: 0,
                toolTipContent: "Pesticides View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['news']['pesticides'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        news.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            news.render();
        }

        document1 = new CanvasJS.Chart("document", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor Document"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['document']['animal'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Crop",
                markerSize: 0,
                toolTipContent: "Crop View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['document']['crop'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Fertilizer",
                markerSize: 0,
                toolTipContent: "Fertilizer View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['document']['fertilizer'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Pesticides",
                markerSize: 0,
                toolTipContent: "Pesticides View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['document']['pesticides'], JSON_NUMERIC_CHECK); ?>
            }]
        });

        document1.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            document1.render();
        }

        video = new CanvasJS.Chart("video", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor Video"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['video']['animal'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Crop",
                markerSize: 0,
                toolTipContent: "Crop View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['video']['crop'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Fertilizer",
                markerSize: 0,
                toolTipContent: "Fertilizer View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['video']['fertilizer'], JSON_NUMERIC_CHECK); ?>
            }, {
                type: "line",
                name: "Pesticides",
                markerSize: 0,
                toolTipContent: "Pesticides View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['video']['pesticides'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        video.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            video.render();
        }

        dashboard = new CanvasJS.Chart("dashboard", {
            animationEnabled: true,
            title: {
                text: "Agri Arbor Dashboard"
            },
            axisX: {
                title: "Time Pariod"
            },
            axisY: {
                title: "View",
            },
            legend: {
                cursor: "pointer",
                dockInsidePlotArea: true,
                itemclick: toggleDataSeries
            },
            data: [{
                type: "line",
                name: "Animal",
                markerSize: 0,
                toolTipContent: "Animal View {y} on {x}",
                showInLegend: true,
                dataPoints: <?php echo json_encode($charts['dashboard']['none'], JSON_NUMERIC_CHECK); ?>
            }]
        });
        dashboard.render();

        function toggleDataSeries(e) {
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            } else {
                e.dataSeries.visible = true;
            }
            dashboard.render();
        }
    }
</script>

<div class="row pt-10 pb-10">
    <h5><?php echo $title ?></h5>
</div>
<hr>

<div id="chart_sort" class="col">

    <div id="dashboard" class="charts"></div>

    <div id="overall" class="charts"></div>

    <div id="info" class="charts"></div>

    <div id="news" class="charts"></div>

    <div id="document" class="charts"></div>

    <div id="video" class="charts"></div>
</div>