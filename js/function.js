function timestamp2date(data) {
    for (var i = 0; i < data.length; i++) {
        // Split timestamp into [ Y, M, D, h, m, s ]
        var t = data[i].x.split(/[- :]/);
        // Apply each element to the Date function
        data[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
    }
    return data;
}

function printGraph(title, axisX, axisY, data) {
    var chart = new CanvasJS.Chart("chartContainer", {
        animationEnabled: true,
        title: {
            text: title,
        },
        axisX: {
            title: axisX,
            crosshair: {
                enabled: true,
                snapToDataPoint: true,
            },
        },
        axisY: {
            title: axisY,
            includeZero: true,
            crosshair: {
                enabled: true,
                snapToDataPoint: true,
            },
        },
        toolTip: {
            enabled: false,
        },
        data: [
            {
                type: "area",
                dataPoints: data,
            },
        ],
    });
    chart.render();
}
