$(document).ready(function ($) {
    function create_html_table(tbl_data) {
        //--->create data table > start
        var tbl = "";
        tbl += '<table class="table table-dark table-hover table-bordered text-white-50 rounded overflow-hidden table-faq">';

        //--->create table header > start
        tbl += "<thead>";
        tbl += "<tr>";
        tbl += '<th style="width: 32%" scope="col">Question</th>';
        tbl += '<th style="width: 39%" scope="col">Answer</th>';
        tbl += '<th style="width: 12.33%" scope="col">Language</th>';
        tbl += '<th style="width: 16.66%" scope="col">Options</th>';
        tbl += "</tr>";
        tbl += "</thead>";
        //--->create table header > end

        //--->create table body > start
        tbl += "<tbody>";

        //--->create table body rows > start
        $.each(tbl_data, function (index, val) {
            var row_id = val["faqId"];

            //loop through ajax row data
            tbl += '<tr row_id="' + row_id + '">';
            tbl += '<td ><div class="row_data" edit_type="click" col_name="faqQuestion">' + val["faqQuestion"] + "</div></td>";
            tbl += '<td ><div class="row_data" edit_type="click" col_name="faqAnswer">' + val["faqAnswer"] + "</div></td>";
            tbl +=
                '<td class="align-middle"><div class="row_data" edit_type="click" col_name="faqLanguage">' +
                val["faqLanguage"] +
                "</div></td>";

            //--->edit options > start
            tbl += "<td class='align-middle'>";
            tbl += '<span class="btn_edit" > <a href="#" class="btn btn-link " row_id="' + row_id + '" > Edit</a> </span>';
            //only show this button if edit button is clicked
            tbl += '<a href="#" class="btn_save btn btn-link"  row_id="' + row_id + '"> Save </a>';
            tbl += '<a href="#" class="btn_cancel btn btn-link" row_id="' + row_id + '"> Cancel </a>';
            tbl += '<a href="#" class="btn_delete btn btn-link text-danger" row_id="' + row_id + '"> Delete</a>';
            tbl += "</td>";
            //--->edit options > end
            tbl += "</tr>";
        });
        //--->create table body rows > end
        tbl += "</tbody>";
        //--->create table body > end

        tbl += "</table>";
        //--->create data table > end

        //add new table row
        tbl += '<div class="text-center">';
        tbl += '<span class="btn btn-primary btn_new_row">Add New Row</span>';
        tbl += "<div>";

        //out put table data
        $(document).find(".table_faq").html(tbl);

        $(document).find(".btn_save").hide();
        $(document).find(".btn_cancel").hide();
        $(document).find(".btn_delete").hide();
    }

    //variable de fonction
    var ajax_url = "/AutoKapt/includes/ajax/faqAdmin.ajax.php";

    //--->create table via ajax call > start
    $.getJSON(ajax_url, { call_type: "get_faq" }, function (data) {
        //create table on page load
        create_html_table(data);
    });
    //--->create table via ajax call > end

    //--->button > edit > start
    $(document).on("click", ".btn_edit", function (event) {
        event.preventDefault();
        var tbl_row = $(this).closest("tr");

        var row_id = tbl_row.attr("row_id");

        tbl_row.find(".btn_save").show();
        tbl_row.find(".btn_cancel").show();
        tbl_row.find(".btn_delete").show();

        //hide edit button
        tbl_row.find(".btn_edit").hide();

        //make the whole row editable
        tbl_row
            .find(".row_data")
            .attr("contenteditable", "true")
            .attr("edit_type", "button")
            .addClass("bg-secondary rounded")
            .css("padding", "3px");

        //--->add the original entry > start
        tbl_row.find(".row_data").each(function (index, val) {
            //this will help in case user decided to click on cancel button
            $(this).attr("original_entry", $(this).html());
        });
        //--->add the original entry > end
    });
    //--->button > edit > end

    //--->button > cancel > start
    $(document).on("click", ".btn_cancel", function (event) {
        event.preventDefault();

        var tbl_row = $(this).closest("tr");

        var row_id = tbl_row.attr("row_id");

        //hide save and cacel buttons
        tbl_row.find(".btn_save").hide();
        tbl_row.find(".btn_cancel").hide();
        tbl_row.find(".btn_delete").hide();

        //show edit button
        tbl_row.find(".btn_edit").show();

        //make the whole row non editable
        tbl_row
            .find(".row_data")
            .attr("contenteditable", "false")
            .attr("edit_type", "click")
            .removeClass("bg-secondary rounded")
            .css("padding", "");

        tbl_row.find(".row_data").each(function (index, val) {
            $(this).html($(this).attr("original_entry"));
        });
    });
    //--->button > cancel > end

    //--->update row entery > start
    $(document).on("click", ".btn_save", function (event) {
        event.preventDefault();
        var tbl_row = $(this).closest("tr");

        var row_id = tbl_row.attr("row_id");

        //hide save and cacel buttons
        tbl_row.find(".btn_save").hide();
        tbl_row.find(".btn_cancel").hide();
        tbl_row.find(".btn_delete").hide();

        //show edit button
        tbl_row.find(".btn_edit").show();

        //make the whole row non editable
        tbl_row
            .find(".row_data")
            .attr("contenteditable", "false")
            .attr("edit_type", "click")
            .removeClass("bg-secondary rounded")
            .css("padding", "");

        //--->get row data > start
        var arr = {};
        tbl_row.find(".row_data").each(function (index, val) {
            var col_name = $(this).attr("col_name");
            var col_val = $(this).html();
            arr[col_name] = col_val;
        });
        //--->get row data > end

        //get row id value
        arr["row_id"] = row_id;

        //out put to show
        $(".post_msg").html('<pre class="dark2 rounded">' + JSON.stringify(arr, null, 2) + "</pre>");

        //add call type for ajax call
        arr["call_type"] = "question_entry";

        //call ajax api to update the database record
        $.post(ajax_url, arr, function (data) {
            var d1 = JSON.parse(data);
            $(".post_msg").html(msg);
            if (d1.status == "error") {
                var msg = "" + "<h4>" + d1.msg + "</h4>" + '<pre class="dark2 rounded">' + JSON.stringify(arr, null, 2) + "</pre>" + "";
                $(".post_msg").html(msg);
            } else if (d1.status == "success") {
                var msg = "" + "<h4>" + d1.msg + "</h4>" + '<pre class="dark2 rounded">' + JSON.stringify(arr, null, 2) + "</pre>" + "";
                $(".post_msg").html(msg);
            }
        });
    });
    //--->update row entery > end

    //--->button > delete > start
    $(document).on("click", ".btn_delete", function (event) {
        event.preventDefault();
        var ele_this = $(this);
        $.confirm({
            title: "Deleting row",
            content: "Are you sure ?",
            buttons: {
                confirm: function () {
                    var row_id = ele_this.attr("row_id");
                    var data_obj = {
                        call_type: "delete_question_entry",
                        row_id: row_id,
                    };

                    ele_this.html('<p class="bg-secondary rounded">Please wait....deleting your entry</p>');
                    $.post(ajax_url, data_obj, function (data) {
                        var d1 = JSON.parse(data);
                        if (d1.status == "error") {
                            var msg = "<h4>" + d1.msg + "</h4>";
                            $(".post_msg").html(msg);
                        } else if (d1.status == "success") {
                            ele_this.closest("tr").css("background", "red").slideUp("slow");

                            var msg = "<h4>" + d1.msg + "</h4>";
                            $(".post_msg").html(msg);
                        }
                    });
                },
                cancel: function () {},
            },
        });
    });
    //--->button > delete > end

    function add_question(question_data) {
        //create an id = max id existant + 1
        var row_id;
        $.each(question_data, function (key, val) {
            row_id = val;
        });
        var tbl_row = $(document).find(".table-faq").find("tr");
        var tbl = "";
        tbl += '<tr row_id="' + row_id + '">';
        tbl +=
            '<td ><div class="new_row_data faqQuestion bg-secondary  rounded" contenteditable="true" edit_type="click" col_name="faqQuestion"></div></td>';
        tbl +=
            '<td ><div class="new_row_data faqAnswer bg-secondary  rounded" contenteditable="true" edit_type="click" col_name="faqAnswer"></div></td>';
        tbl +=
            '<td ><div class="new_row_data faqLanguage bg-secondary  rounded" contenteditable="true" edit_type="click" col_name="faqLanguage"></div></td>';
        //--->edit options > start
        tbl += "<td>";
        tbl += '  <a href="#" class="btn btn-link btn_new" row_id="' + row_id + '" > Add Entry</a>   | ';
        tbl += '  <a href="#" class="btn btn-link btn_remove_new_entry" row_id="' + row_id + '"> Remove</a> ';
        tbl += "</td>";
        //--->edit options > end

        tbl += "</tr>";
        tbl_row.last().after(tbl);

        $(document).find(".table-faq").find("tr").last().find(".faqQuestion").focus();
    }
    //--->button > add > start
    $(document).on("click", ".btn_new_row", function (event) {
        event.preventDefault();

        $.getJSON(ajax_url, { call_type: "get_max_faqId" }, function (data) {
            add_question(data);
        });
    });
    //--->button > add > end

    //--->button > remove > start
    $(document).on("click", ".btn_remove_new_entry", function (event) {
        event.preventDefault();

        $(this).closest("tr").remove();
    });
    //--->button > remove > start

    function alert_msg(msg) {
        return '<span class="alert_msg text-danger">' + msg + "</span>";
    }

    //--->save new row > start
    $(document).on("click", ".btn_new", function (event) {
        event.preventDefault();

        var ele_this = $(this);
        var ele = ele_this.closest("tr");

        //remove all old alerts
        ele.find(".alert_msg").remove();

        //get row id
        var row_id = $(this).attr("row_id");

        //get field names
        var faqQuestion = ele.find(".faqQuestion");
        var faqAnswer = ele.find(".faqAnswer");
        var faqLanguage = ele.find(".faqLanguage");

        if (faqQuestion.html() == "") {
            faqQuestion.focus();
            faqQuestion.after(alert_msg("Enter Question"));
        } else if (faqAnswer.html() == "") {
            faqAnswer.focus();
            faqAnswer.after(alert_msg("Enter Answer"));
        } else if (faqLanguage.html() == "") {
            faqLanguage.focus();
            faqLanguage.after(alert_msg("Enter Language"));
        } else {
            var data_obj = {
                call_type: "new_question_entry",
                row_id: row_id,
                faqQuestion: faqQuestion.html(),
                faqAnswer: faqAnswer.html(),
                faqLanguage: faqLanguage.html(),
            };

            ele_this.html('<p class="bg-secondary rounded">Please wait....adding your new row</p>');

            $.post(ajax_url, data_obj, function (data) {
                var d1 = JSON.parse(data);

                var tbl = "";
                tbl += '<a href="#" class="btn btn-link btn_edit" row_id="' + row_id + '" > Edit</a>';
                tbl += '<a href="#" class="btn btn-link btn_save"  row_id="' + row_id + '" style="display:none;"> Save</a>';
                tbl += '<a href="#" class="btn btn-link btn_cancel" row_id="' + row_id + '" style="display:none;"> Cancel</a>';
                tbl += '<a href="#" class="btn btn-link text-danger btn_delete" row_id="' + row_id + '" style="display:none;" > Delete</a>';

                if (d1.status == "error") {
                    var msg = "" + "<h4>" + d1.msg + '</h4><pre class="dark2 rounded">' + JSON.stringify(data_obj, null, 2) + "</pre>" + "";
                    $(".post_msg").html(msg);
                } else if (d1.status == "success") {
                    var msg = "" + "<h4>" + d1.msg + '</h4><pre class="dark2 rounded">' + JSON.stringify(data_obj, null, 2) + "</pre>" + "";
                    $(".post_msg").html(msg);

                    ele_this.closest("td").html(tbl);
                    ele.find(".new_row_data").attr("contenteditable", "false").removeClass("bg-secondary");
                    ele.find(".new_row_data").toggleClass("new_row_data row_data");
                }
            });
        }
    });
    //--->save new row > end
});
