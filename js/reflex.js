for (var i = 0; i < dataVisual.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataVisual[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataVisual[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
}

/* for (var i = 0; i < dataSound.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataSound[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataSound[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
} */

window.onload = function () {
    var chartVisual = new CanvasJS.Chart("UserVisual", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2",
        title: {
            text: "Visual Reflex Personal Statistics",
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
                name: "Time",
                color: "#FC2020",
                dataPoints: dataVisual,
            },
        ],
    });
    /* var chartTemp = new CanvasJS.Chart("UserVisual", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2"
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
                name: "Time",
                color: "#FC2020",
                dataPoints: dataTemp,
            },
        ],
    }); */
    var chartVisualTotal = new CanvasJS.Chart("VisualStats", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2"
        title: {
            text: "Visual Reflex Global Statistics",
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
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataVisualPerso,
            },
        ],
    });
    /* var chartTempTotal = new CanvasJS.Chart("TempStats", {
        animationEnabled: true,
        theme: "light1", //"light2", "dark1", "dark2"
        title: {
            text: "Stress Température Global Statistics",
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
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataTempPerso,
            },
        ],
    }); */
    chartVisualTotal.render();
    chartVisual.render();
    /* chartTempTotal.render();
    chartTemp.render(); */
};
