window.onload = function () {
    var chartMemoryStats = new CanvasJS.Chart("memoryStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Memory Global Statistics",
        },
        axisX: {
            title: "Score",
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
                dataPoints: dataMemoryTotal,
            },
        ],
    });
    
    chartMemoryStats.render();
};
