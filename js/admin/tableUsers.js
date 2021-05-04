$(document).ready(function ($) {
    /* function updateTable() {
        var val = document.getElementById("searchUsername").value;
        return val;
    } */
    function create_html_table(tbl_data) {
        //--->create data table > start
        var tbl = "";
        tbl += '<table class="table table-dark table-hover table-bordered text-white-50 rounded overflow-hidden">';

        //--->create table header > start
        tbl += "<thead>";
        tbl += "<tr>";
        tbl += '<th style="width: 16.66%" scope="col">Username</th>';
        tbl += '<th style="width: 33.33%" scope="col">Email</th>';
        tbl += '<th style="width: 8.33%" scope="col">Gender</th>';
        tbl += '<th style="width: 16.66%" scope="col">Date of Birth</th>';
        tbl += '<th style="width: 8.33%" scope="col">Access</th>';
        tbl += '<th style="width: 16.66%" scope="col">Options</th>';
        tbl += "</tr>";
        tbl += "</thead>";
        //--->create table header > end

        //--->create table body > start
        tbl += "<tbody>";

        //--->create table body rows > start
        $.each(tbl_data, function (index, val) {
            //you can replace with your database row id
            var row_id = val["usersId"];

            //loop through ajax row data
            tbl += '<tr row_id="' + row_id + '">';
            tbl += '<td ><div class="row_data" edit_type="click" col_name="usersUsername">' + val["usersUsername"] + "</div></td>";
            tbl += '<td ><div class="row_data" edit_type="click" col_name="usersEmail">' + val["usersEmail"] + "</div></td>";
            tbl += '<td ><div class="row_data" edit_type="click" col_name="usersGender">' + val["usersGender"] + "</div></td>";
            tbl += '<td ><div class="row_data" edit_type="click" col_name="usersBirth">' + val["usersBirth"] + "</div></td>";
            tbl += '<td ><div class="row_data" edit_type="click" col_name="usersAccess">' + val["usersAccess"] + "</div></td>";

            //--->edit options > start
            tbl += "<td class='align-middle'>";
            tbl += '<span class="btn_edit" > <a href="#" class="btn btn-link " row_id="' + row_id + '" > Edit</a> </span>';
            //only show this button if edit button is clicked
            tbl += '<a href="#" class="btn_save btn btn-link"  row_id="' + row_id + '"> Save </a>';
            tbl += '<a href="#" class="btn_cancel btn btn-link" row_id="' + row_id + '"> Cancel </a>';
            tbl += '<a href="#" class="btn_delete btn btn-link1 text-danger" row_id="' + row_id + '"> Delete</a>';
            tbl += "</td>";
            //--->edit options > end
            tbl += "</tr>";
        });
        //--->create table body rows > end
        tbl += "</tbody>";
        //--->create table body > end

        tbl += "</table>";
        //--->create data table > end

        //out put table data
        $(document).find(".table_users").html(tbl);

        $(document).find(".btn_save").hide();
        $(document).find(".btn_cancel").hide();
        $(document).find(".btn_delete").hide();
    }

    //variable de fonction
    var ajax_url = "/AutoKapt/includes/ajax/tableUsers.ajax.php";
    var val = searchValue; /* la voir cmt transmettre la data */
    var search = {
        call_type: "get_users",
        search: val,
    };

    //--->create table via ajax call > start
    $.post(ajax_url, search, function (data) {
        var table = JSON.parse(data);
        //create table on page load
        create_html_table(table);
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
        arr["call_type"] = "row_entry";

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
                        call_type: "delete_row_entry",
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
});
