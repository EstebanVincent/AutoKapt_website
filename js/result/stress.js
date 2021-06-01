/* timestamp sql to date js */
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
/* on utilise canvasJS pour les graphs */
window.onload = function () {
    var chartBPM = new CanvasJS.Chart("UserBPM", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2",
        title: {
            text: "Stress BPM Personal Statistics",
        },
        axisX: {
            title: "Date",
        },
        axisY: {
            title: "BPM",
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataBPM,
            },
        ],
    });
    var chartTemp = new CanvasJS.Chart("UserTemp", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Stress Temperature Personal Statistics",
        },
        axisX: {
            title: "Date",
        },
        axisY: {
            title: "Temperature",
            suffix: "°C",
        },
        legend: {
            fontSize: 13,
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataTemp,
            },
        ],
    });
    var chartBPMTotal = new CanvasJS.Chart("BPMStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Stress BPM Global Statistics",
        },
        axisX: {
            title: "BPM",
        },
        axisY: {
            title: "Percentage",
            suffix: "%",
        },
        toolTip: {
            shared: true,
        },
        legend: {
            fontSize: 13,
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Global",
                color: "#FC2020",
                dataPoints: dataBPMTotal,
            },
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataBPMPerso,
            },
        ],
    });
    var chartTempTotal = new CanvasJS.Chart("TempStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Stress Temperature Global Statistics",
        },
        axisX: {
            title: "Temperature",
            suffix: "°C",
        },
        axisY: {
            title: "Percentage",
            suffix: "%",
        },
        toolTip: {
            shared: true,
        },
        legend: {
            fontSize: 13,
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Global",
                color: "#FC2020",
                dataPoints: dataTempTotal,
            },
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataTempPerso,
            },
        ],
    });
    chartBPMTotal.render();
    chartBPM.render();
    chartTempTotal.render();
    chartTemp.render();
};
