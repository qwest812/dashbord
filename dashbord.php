
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Highcharts Example</title>

    <style type="text/css">

    </style>
</head>
<body>
<script src="/js/highcharts.js"></script>
<script src="/js/exporting.js"></script>
<script src="/js/export-data.js"></script>
<script>
    'use strict';
    //        console.log(ourData);
    //        console.log(ourData['DATEOPEN']);

    //        picture.innerHTML='Спасибо за заявку';
    //        var picture_name = document.getElementsByName('picture_name')[0];
    //        picture_name.className+=" disable";
    //        var picture_number = document.getElementsByName('picture_number')[0];
    //        picture_number.className+=" disable";
    //        p_sub.className+=" disable";
var data;
    function uniq(a) {
        var seen = {};
        return a.filter(function(item) {
            return seen.hasOwnProperty(item) ? false : (seen[item] = true);
        });
    }
    function ajax(callback){
        var ourRequest = new XMLHttpRequest;
        var url ="http://dashbord/Controller/ControllerJson/ControllerJson.php?get=all";
        ourRequest.open("GET", url, true);
        ourRequest.onload = function () {
            var ourData = JSON.parse(ourRequest.responseText);

            callback(ourData);
        };
        ourRequest.send();
    }
    var dataopen=[];
    ajax(function(data) {
//        console.log(data);
data.forEach(function(value,i){
//    console.log(i);
    dataopen[i]=value['DATEOPEN'];

});
        dataopen=uniq(dataopen);
//        console.log(dataopen);
        var countOpen=[];
        var countClouse=[];
            dataopen.forEach(function(v, k){
                countOpen[k]=0;
                countClouse[k]=0;
            });
//        var count =[0,0,0,0,0,0,0,0,0];
        data.forEach(function(value, i){
            dataopen.forEach(function(valueData, j){

                if(value['DATEOPEN'] == valueData){
                    countOpen[j]++;
                    if(value['DATECLOSE']!= null){
                        console.log(value['DATECLOSE']);
                        countClouse[j]++;
                    }
                }

//                console.log(valueData);
//                console.log(j);
//                if(value['DATEOPEN'] == valueData[j]){
//                console.log(uniq(dataopen));
//                console.log(data);
//            }
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
            },]
        });
//        data=result;
    });
</script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



<script type="text/javascript">

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
</script>
</body>
</html>
