function deleteQuestion(faqId) {
    if (confirm("Delete this question?")) {
        /* Utiliser la function php removeQuestionFAQ($conn, $faqId) */
        jQuery.ajax({
            type: "POST",
            url: "your_functions_address.php",
            dataType: "json",
            data: {
                functionname: "removeQuestionFAQ",
                arguments: [$conn, faqId],
            },

            success: function (obj, textstatus) {
                if (!("error" in obj)) {
                    yourVariable = obj.result;
                } else {
                    console.log(obj.error);
                }
            },
        });
    }
}
function openAdd() {
    document.getElementById("add").style.display = "block";
}

function closeAdd() {
    document.getElementById("add").style.display = "none";
}

function openModif(idFAQ) {
    document.getElementById("modify" + idFAQ.toString()).style.display =
        "block";
}

function closeModif(idFAQ) {
    document.getElementById("modify" + idFAQ.toString()).style.display = "none";
}
