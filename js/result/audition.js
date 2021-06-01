for (var i = 0; i < dataAudition.length; i++) {
    // Split timestamp into [ Y, M, D, h, m, s ]
    var t = dataAudition[i].x.split(/[- :]/);
    // Apply each element to the Date function
    dataAudition[i].x = new Date(t[0], t[1] - 1, t[2], t[3], t[4], t[5]);
}

window.onload = function () {
    var chartAudition = new CanvasJS.Chart("UserAudition", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2",
        title: {
            text: "Audition Personal Statistics",
        },
        axisX: {
            title: "Date",
        },
        axisY: {
            title: "Score",
        },
        data: [
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataAudition,
            },
        ],
    });

    var chartAuditionTotal = new CanvasJS.Chart("AuditionStats", {
        animationEnabled: true,
        theme: "dark2", //"light2", "dark1", "dark2"
        title: {
            text: "Audition Global Statistics",
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
                dataPoints: dataAuditionTotal,
            },
            {
                type: "splineArea",
                showInLegend: true,
                name: "Perso",
                color: "#2020FC",
                dataPoints: dataAuditionPerso,
            },
        ],
    });
    chartAuditionTotal.render();
    chartAudition.render();
};
