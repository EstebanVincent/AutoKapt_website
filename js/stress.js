for (var i = 0; i < dataBPM.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataBPM[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataBPM[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
}

for (var i = 0; i < dataTemp.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataTemp[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataTemp[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
}

window.onload = function () {
    var chartBPM = new CanvasJS.Chart("UserBPM", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2",
        title: {
            text: "Stress BPM Statistics",
        },
        axisX: {
            title: "Date",
            crosshair: {
                enabled: true,
                snapToDataPoint: true,
            },
        },
        axisY: {
            title: "BPM",
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
                dataPoints: dataBPM,
            },
        ],
    });
    var chartTemp = new CanvasJS.Chart("UserTemp", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2"
        title: {
            text: "Stress Temperature Statistics",
        },
        axisX: {
            title: "Date",
            crosshair: {
                enabled: true,
                snapToDataPoint: true,
            },
        },
        axisY: {
            title: "Temperature",
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
                dataPoints: dataTemp,
            },
        ],
    });
    chartBPM.render();
    chartTemp.render();
};
