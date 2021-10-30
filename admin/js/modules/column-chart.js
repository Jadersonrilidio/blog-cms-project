// source: <https://developers.google.com/chart/interactive/docs/gallery/columnchart>

google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
    ['Data', 'count'],
    ['Posts', 12],
    ['Comments', 11],
    ['Users', 5],
    ['Categories', 1]
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
