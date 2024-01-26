am4core.ready(function () {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    var chart = am4core.create("chartdiv", am4charts.PieChart3D);
    chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

    chart.legend = new am4charts.Legend();

    chart.data = [{
        country: "Hadir",
        litres: 501.9
    },
    {
        country: "Sakit",
        litres: 301.9
    },
    {
        country: "Izin",
        litres: 201.1
    },
    {
        country: "Terlambat",
        litres: 165.8
    },
    ];



    var series = chart.series.push(new am4charts.PieSeries3D());
    series.dataFields.value = "litres";
    series.dataFields.category = "country";
    series.alignLabels = false;
    series.labels.template.text = "{value.percent.formatNumber('#.0')}%";
    series.labels.template.radius = am4core.percent(-40);
    series.labels.template.fill = am4core.color("white");
    series.colors.list = [
        am4core.color("#1171ba"),
        am4core.color("#fca903"),
        am4core.color("#37db63"),
        am4core.color("#ba113b"),
    ];
}); // end am4core.ready()
