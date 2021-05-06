window.onload = function () {
    var chartVisualStats = new CanvasJS.Chart("VisualStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Visual Global Statistics",
        },
        axisX: {
            title: "Time (ms)",
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
                dataPoints: dataVisualTotal,
            },
        ],
    });
    var chartSoundStats = new CanvasJS.Chart("SoundStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Sound Global Statistics",
        },
        axisX: {
            title: "Time (ms)",
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
                dataPoints: dataSoundTotal,
            },
        ],
    });
    chartSoundStats.render();
    chartVisualStats.render();
};
