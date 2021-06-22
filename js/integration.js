/* $.confirm({
    title: "Starting test",
    content: "Press the button on the card",
    buttons: {
        confirm: function () {
            /* $(document).find(".data").html("<p>bite</p>"); */
/* var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
                data = { test: "bpm" };
            do {
                $.post(ajaxurl, data, function (data) {
                    d1 = JSON.parse(data);
                });
            } while (d1.bool != d1.test);
            $.post(ajaxurl, { data: d1.trame, test: d1.test }, function (data) {
                d2 = JSON.parse(data);
                $(document)
                    .find(".data")
                    .html("<p>" + d2.value + "</p>");
            }); 
        },
    },
});
$(document).ready(function ($) {
    var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
        data = { test: "bpm" };
    do {
        d1 = getTrame(returnData);
        $(document)
            .find(".test")
            .html("<p>" + d1.trame + "   " + d1.bool + "   " + d1.test + "</p>");
    } while (int(window.d1.bool) != int(window.d1.test));
    $(document)
        .find(".data")
        .html("<p>" + d1.trame + " bite  " + d1.bool + "   " + d1.test + "</p>");
    $.post(ajaxurl, { data: d1.trame, test: d1.test }, function (data) {
        d2 = JSON.parse(data);
        $(document)
            .find(".data")
            .html("<p>" + d2.value + "</p>");
    });
});
function returnData(param) {
    console.log(param);
}

function getTrame(callback) {
    $.post(ajaxurl, data, function (data) {
        callback(data);
    });
}

getCartProduct(id, returnData); */
document.getElementById("gameStart").addEventListener("click", function () {
    var timeleft = 10;

    var downloadTimer = setInterval(function function1() {
        document.getElementById("countdown").innerHTML = timeleft + " " + "seconds remaining";

        timeleft -= 1;
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("countdown").innerHTML = "Time is up!";
            var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
                data = { test: "bpm" };
            $.post(ajaxurl, data, function (data) {
                d = JSON.parse(data);
                $(document)
                    .find(".data")
                    .html("<p>" + d.value + "</p>");
            });
        }
    }, 1000);

    console.log(countdown);
});
