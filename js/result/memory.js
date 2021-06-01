for (var i = 0; i < dataMemory.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataMemory[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataMemory[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
}

window.onload = function () {
    var chartMemory = new CanvasJS.Chart("UserMemory", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2",
        title: {
            text: "Memory and rythm Personal Statistics",
        },
        axisX: {
            title: "Date",
        },
        axisY: {
            title: "Time (ms)",
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataMemory,
            },
        ],
    });
    var chartMemoryTotal = new CanvasJS.Chart("MemoryStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Audio Reflex Global Statistics",
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
                dataPoints: dataMemoryTotal,
            },
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataMemoryPerso,
            },
        ],
    });
    chartMemoryTotal.render();
    chartMemory.render();
};
