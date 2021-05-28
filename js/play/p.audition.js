window.onload = function () {
    var chartAuditionStats = new CanvasJS.Chart("AuditionStats", {
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
        ],
    });
   
    chartAuditionStats.render();
    
};