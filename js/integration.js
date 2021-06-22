$.confirm({
    title: "Starting test",
    content: "Press the button on the card",
    buttons: {
        confirm: function () {
            var ajaxurl = "/AutoKapt/includes/ajax/integration.ajax.php",
                data = { test: "bpm" };
            $.post(ajaxurl, data, function (data) {
                var d1 = JSON.parse(data);

                alert(d1.value);
            });
        },
    },
});
