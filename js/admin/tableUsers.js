$(document).ready(function ($) {
    var urlTotal = window.location.href;
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

        /* get le numéro de la page */
        var tempo1 = urlTotal.split("page=");
        var tempo2 = tempo1[1].split("&");
        var page = tempo2[0];
        var min_entry = (page - 1) * 20;
        var max_entry = page * 20 - 1;

        //--->create table body rows > start
        $.each(tbl_data, function (index, val) {
            if (index >= min_entry) {
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
                tbl += '<a href="#" class="btn_delete btn btn-link text-danger" row_id="' + row_id + '"> Delete</a>';
                tbl += "</td>";
                //--->edit options > end
                tbl += "</tr>";
            }

            return index < max_entry;
        });
        //--->create table body rows > end
        tbl += "</tbody>";
        //--->create table body > end
        tbl += "</table>";
        //--->create data table > end

        //--->create nav page > start

        var number_row = tbl_data.length;
        var number_pages = Math.floor(number_row / 20) + 1;
        tbl += '<div class="row">';
        tbl += '<div class="col-4">';
        tbl += "<p>";
        tbl += "Showing " + min_entry + " to " + max_entry + " of " + number_row + " entries";
        tbl += "</p>";
        tbl += "</div>";
        tbl += '<div class="col-2"></div>';
        tbl += '<div class="col-6">';
        tbl += '<div class="btn-toolbar" role="toolbar">';
        /* start */
        tbl += '<div class="btn-group me-2" role="group">';
        tbl += '<button type="button" class="btn btn-primary"><i class="fas fa-angle-double-left"></i></button>';
        tbl += '<button type="button" class="btn btn-primary"><i class="fas fa-angle-left"></i></button>';
        tbl += '<button type="button" class="btn btn-primary">1</button>';
        tbl += "</div>";
        /* current */
        tbl += '<div class="btn-group me-2" role="group">';
        tbl += '<button type="button" class="btn btn-primary">...</button>';
        tbl += '<button type="button" class="btn btn-primary">' + (page - 1) + "</button>";
        tbl += '<button type="button" class="btn btn-danger">' + page + "</button>";
        tbl += '<button type="button" class="btn btn-primary">' + (parseInt(page, 10) + 1) + "</button>";
        tbl += '<button type="button" class="btn btn-primary">...</button>';
        tbl += "</div>";
        /* end */
        tbl += '<div class="btn-group me-2" role="group">';
        if (number_pages > 2) {
            tbl += '<button type="button" class="btn btn-primary">' + number_pages + "</button>";
        }
        tbl += '<button type="button" class="btn btn-primary"><i class="fas fa-angle-right"></i></button>';
        tbl += '<button type="button" class="btn btn-primary"><i class="fas fa-angle-double-right"></i></button>';
        tbl += "</div>";
        tbl += "</div>";
        tbl += "</div>";
        //--->create nav page > end

        //out put table data
        $(document).find(".table_users").html(tbl);

        $(document).find(".btn_save").hide();
        $(document).find(".btn_cancel").hide();
        $(document).find(".btn_delete").hide();
    }
    function create_form(form_data) {
        //--->create form > start
        var form = "";
        form += '<form action="/AutoKapt/includes/Admin/search.inc.php" method="POST">';
        /* premiere ligne tjr visible */
        form += '<div class="row">';
        form += '<div class="col-8">';
        form += '<input name="likeUsername" class="form-control" list="datalistOptions" placeholder="Search for username...">';
        form += '<datalist id="datalistOptions">';

        $.each(form_data, function (index, val) {
            var option = val["usersUsername"];
            form += "<option value=" + option + ">";
        });
        form += "</datalist>";
        form += "</div>";
        form += '<div class="col-2 text-center">';
        form += '<input class="btn_search btn btn-primary mt-3" name="search-submit" type="submit" value="Search">';
        form += '<input class="btn_reset btn btn-primary mt-3" name="see-all-submit" type="submit" value="Reset">';
        form += "</div>";
        form += '<div class="col-2 text-center">';
        form += '<input class="btn_adv_search btn btn-primary mt-3" type="button" value="Advanced search">';
        form += "</div>";
        form += "</div>";

        /* lignes suivantes visibles uniquement si advanced search */
        form += '<div class="div_adv_search">';
        form += '<div class="row">';

        /* recherche email */
        form += "<p>";
        form += '<label for="searchEmail" class="form-label">Email</label>';
        form += '<input name="likeEmail" class="form-control" id="searchEmail" placeholder="Search for Email...">';
        form += "</p>";

        /* recherche age */
        form += '<div class="row">';
        form += '<label for="searchAge" class="form-label">Age between</label>';
        form += '<div class="col-6">';
        form += '<input name="ageMin" class="form-control" id="searchAge" placeholder="Minimum age">';
        form += "</div>";
        form += '<div class="col-6">';
        form += '<input name="ageMax" class="form-control" placeholder="Maximum age">';
        form += "</div>";
        form += "</div>";

        /* recherche genre */
        form += '<div class="row">';
        form += '<div class="col-6">';
        form += '<label for="selectGender" class="form-label">Select Gender</label>';
        form += '<select id="selectGender" name="gender" class="form-select">';
        form += "<option value=''>Select Gender</option>";
        form += "<option>Male</option>";
        form += "<option>Female</option>";
        form += "<option>Others</option>";
        form += "</select>";
        form += "</div>";

        /* recherche access */
        form += '<div class="col-6">';
        form += '<label for="selectAccess" class="form-label">Select Access</label>';
        form += '<select id="selectAccess" name="access" class="form-select">';
        form += "<option value=''>Select Access</option>";
        form += "<option value='0'>Admin</option>";
        form += "<option value='1'>Manager</option>";
        form += "<option value='2'>User</option>";
        form += "</select>";
        form += "</div>";
        form += "</div>";
        form += '<input class="btn_big_search btn btn-primary mt-3" name="adv-search-submit" type="submit" value="Search">';
        form += "</div>";
        form += "</div>";
        form += "</form>";

        //--->create form > end

        //out put form
        $(document).find(".form").html(form);

        $(document).find(".btn_reset").hide();
        $(document).find(".div_adv_search").hide();
    }

    //variable de fonction
    var ajax_url = "/AutoKapt/includes/ajax/tableUsers.ajax.php";

    /* on transfert le get à l'ajax */
    var hidden = urlTotal.split("php");
    ajax_url += hidden[1];

    //--->create form via ajax call > start
    $.getJSON(ajax_url, { call_type: "get_usernames" }, function (data) {
        //create form on page load
        create_form(data);
    });
    //--->create form via ajax call > end

    //--->create table via ajax call > start
    $.getJSON(ajax_url, { call_type: "get_users" }, function (data) {
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

    //--->button > advanced search > start
    $(document).on("click", ".btn_adv_search", function (event) {
        event.preventDefault();

        $(document).find(".btn_adv_search").toggleClass("btn-primary");
        $(document).find(".btn_adv_search").toggleClass("btn-danger");
        $(document).find(".div_adv_search").toggle();
        $(document).find(".btn_search").toggle();
        $(document).find(".btn_reset").toggle();

        /* $.getJSON(ajax_url, { call_type: "get_max_faqId" }, function (data) {
            add_question(data);
        }); */
    });
    //--->button > advanced search > end
});
