/* envoi de la demande */
$(document).ready(function () {
    $(".btn").click(function () {
        var clickBtnValue = $(this).val();
        var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
            data = { action: clickBtnValue };
        $.post(ajaxurl, data, function (response) {});
        if (clickBtnValue == "saveStress") {
            $(document)
                .find("." + clickBtnValue)
                .html("<p class='text-danger'>Test sauvegardé dans la base de donnée</p>");
        } else {
            $(document)
                .find("." + clickBtnValue)
                .html("<p class='text-danger'>La demande a été envoyée</p>");
        }
    });
});
/* countdown et récupération des donnée en bpm */
document.getElementById("bpmStart").addEventListener("click", function () {
    var timeleft = 10;

    var downloadTimer = setInterval(function function1() {
        document.getElementById("bpmCountdown").innerHTML = timeleft + " " + "seconds remaining";

        timeleft -= 1;
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("bpmCountdown").innerHTML = "Time is up!";
            var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
                data = { test: "bpm" };
            $.post(ajaxurl, data, function (data) {
                d = JSON.parse(data);
                $(document)
                    .find(".bpmResult")
                    .html("<p>" + d.value + " BPM</p>");
            });
        }
    }, 1000);

    console.log(countdown);
});

/* countdown et récupération des donnée en °C */
document.getElementById("tempStart").addEventListener("click", function () {
    var timeleft = 10;

    var downloadTimer = setInterval(function function1() {
        document.getElementById("tempCountdown").innerHTML = timeleft + " " + "seconds remaining";

        timeleft -= 1;
        if (timeleft <= 0) {
            clearInterval(downloadTimer);
            document.getElementById("tempCountdown").innerHTML = "Time is up!";
            var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
                data = { test: "temp" };
            $.post(ajaxurl, data, function (data) {
                d = JSON.parse(data);
                $(document)
                    .find(".tempResult")
                    .html("<p>" + d.value + " °C</p>");
            });
        }
    }, 1000);

    console.log(countdown);
});
