window.onload = function () {
    var chartBPMStats = new CanvasJS.Chart("BPMStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "BPM Global Statistics",
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
        ],
    });
    var chartTempStats = new CanvasJS.Chart("TempStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Température Global Statistics",
        },
        axisX: {
            title: "Température",
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
        ],
    });
    chartTempStats.render();
    chartBPMStats.render();
};
