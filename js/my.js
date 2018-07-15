'use strict';
var data;
function uniq(a) {
    var seen = {};
    return a.filter(function (item) {
        return seen.hasOwnProperty(item) ? false : (seen[item] = true);
    });
}
function ajax(callback) {
    var ourRequest = new XMLHttpRequest;
    var url = "http://dashbord/Controller/ControllerJson/ControllerJson.php?get=all";
    ourRequest.open("GET", url, true);
    ourRequest.onload = function () {
        var ourData = JSON.parse(ourRequest.responseText);

        callback(ourData);
    };
    ourRequest.send();
}
var dataopen = [];
ajax(function (data) {
    data.forEach(function (value, i) {
        dataopen[i] = value['DATEOPEN'];
    });
    dataopen = uniq(dataopen);
    var countOpen = [];
    var countClouse = [];
    dataopen.forEach(function (v, k) {
        countOpen[k] = 0;
        countClouse[k] = 0;
    });
    data.forEach(function (value, i) {
        dataopen.forEach(function (valueData, j) {

            if (value['DATEOPEN'] == valueData) {
                countOpen[j]++;
                if (value['DATECLOSE'] != null) {
                    console.log(value['DATECLOSE']);
                    countClouse[j]++;
                }
            }

        });
    });
    console.log(countOpen);
    console.log(countClouse);

    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Open And Clouse'
        },
        xAxis: {
            categories: dataopen
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Total fruit consumption'
            },
            stackLabels: {
                enabled: true,
                style: {
                    fontWeight: 'bold',
                    color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                }
            }
        },
        legend: {
            align: 'right',
            x: -30,
            verticalAlign: 'top',
            y: 25,
            floating: true,
            backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
            borderColor: '#CCC',
            borderWidth: 1,
            shadow: false
        },
        tooltip: {
            headerFormat: '<b>{point.x}</b><br/>',
            pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: [{
            name: 'Open',
            data: countOpen
        }, {
            name: 'Clouse',
            data: countClouse
        }]
    });
//        data=result;
});


//=============================================
//dashbord
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Stacked column chart'
    },
    xAxis: {
        categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas']
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Total fruit consumption'
        },
        stackLabels: {
            enabled: true,
            style: {
                fontWeight: 'bold',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
            }
        }
    },
    legend: {
        align: 'right',
        x: -30,
        verticalAlign: 'top',
        y: 25,
        floating: true,
        backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
        borderColor: '#CCC',
        borderWidth: 1,
        shadow: false
    },
    tooltip: {
        headerFormat: '<b>{point.x}</b><br/>',
        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
    },
    plotOptions: {
        column: {
            stacking: 'normal',
            dataLabels: {
                enabled: true,
                color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
            }
        }
    },
    series: [{
        name: 'John',
        data: [5, 3, 4, 7, 2]
    }, {
        name: 'Jane',
        data: [2, 2, 3, 2, 1]
    }, {
        name: 'Joe',
        data: [3, 4, 4, 2, 5]
    }]
});