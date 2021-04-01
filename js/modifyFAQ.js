function deleteQuestion(faqId) {
    if (confirm("Delete this question?")) {
        /* Utiliser la function php removeQuestionFAQ($conn, $faqId) */
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
