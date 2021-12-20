<?php 

function dashboard_count ($table) {
    $query = "SELECT * FROM $table";
    return QueryHandler::query_handler($query, 'num_rows');
}

function dashboard_chart_script () {
    ?>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Data', 'count'],
            ['Posts', <?php echo (int) dashboard_count('posts'); ?>],
            ['Comments', <?php echo (int) dashboard_count('comments'); ?>],
            ['Users', <?php echo (int) dashboard_count('users'); ?>],
            ['Categories', <?php echo (int) dashboard_count('categories'); ?>]
            ]);

            var options = {
            chart: {
                title: 'Statistics',
                subtitle: '',
            }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
    <?php
}







?>