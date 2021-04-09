var isCanvasSupported = !!document.createElement("canvas").getContext; // You might want to remove this line if you are not planning on using it.

var theme = {
    Chart: {
        colorSet: "colorSet1",
    },
    Title: {
        fontFamily: isCanvasSupported ? "Calibri, Optima, Candara, Verdana, Geneva, sans-serif" : "calibri",
        fontSize: 33,
        fontColor: "#3A3A3A",
        fontWeight: "bold",
        verticalAlign: "top",
        margin: 10,
    },
    Axis: {
        titleFontSize: 26,
        titleFontColor: "#666666",
        titleFontFamily: isCanvasSupported ? "Calibri, Optima, Candara, Verdana, Geneva, sans-serif" : "calibri",

        labelFontFamily: isCanvasSupported ? "Calibri, Optima, Candara, Verdana, Geneva, sans-serif" : "calibri",
        labelFontSize: 18,
        labelFontColor: "grey",
        tickColor: "#BBBBBB",
        tickThickness: 2,
        gridThickness: 2,
        gridColor: "#BBBBBB",
        lineThickness: 2,
        lineColor: "#BBBBBB",
    },
    Legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center",
        fontFamily: isCanvasSupported ? "monospace, sans-serif,arial black" : "calibri",
    },
    DataSeries: {
        //bevelEnabled: true,
        indexLabelFontColor: "grey",
        //indexLabelFontFamily: "Trebuchet MS, monospace, Courier New, Courier",
        indexLabelFontFamily: isCanvasSupported ? "Calibri, Optima, Candara, Verdana, Geneva, sans-serif" : "calibri",
        //indexLabelFontWeight: "bold",
        indexLabelFontSize: 18,
        //indexLabelLineColor: "lightgrey",
        indexLabelLineThickness: 1,
    },
};
CanvasJS.addTheme("Dark", theme); // You can use any name
