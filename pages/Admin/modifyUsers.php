<?php
  $pathHeader = $_SERVER['DOCUMENT_ROOT'];
  $pathHeader .= '/AutoKapt/bases/header.php'; /* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathHeader);

  require_once '../../includes/dataBaseHandler.inc.php';
  require_once '../../includes/functions.inc.php';
?>


<div class="container-fluid bg-secondary text-white-50">
	<div class="py-3"></div>
	<section class="dark2 py-2 mx-5 rounded">
		<h2>Gerer les utilisateurs</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam iusto dolorem explicabo maxime sapiente dolorum at sunt velit fugit numquam necessitatibus, delectus nisi unde repudiandae qui itaque voluptatibus alias doloremque.</p>
    </section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 rounded">
        <div class="row">
			<div class="col text-center">
				<h2 class="text-success">Test</h2>
			</div>
		</div>
        <div class="table_test"></div>
	  </section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 rounded">
        <div class="row">
			<div class="col text-center">
				<h2  class="text-danger">Admins</h2>
			</div>
		</div>
        <table class="table table-dark text-white-50">
            <thead>
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                </tr>
            </thead>
            <tbody>
<?php
                showUsers($conn,0)
?>
            </tbody>
        </table>

	  </section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 rounded">
        <div class="row">
			<div class="col text-center">
				<h2 class="text-success">Managers</h2>
			</div>
		</div>
        <table class="table table-dark text-white-50">
            <thead>
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                </tr>
            </thead>
            <tbody>
<?php
                showUsers($conn,1)
?>
            </tbody>
        </table>
	  </section>
    <div class="py-3"></div>
    <section class="dark2 py-2 mx-5 rounded">
        <div class="row">
			<div class="col text-center">
				<h2 class="text-info">Users</h2>
			</div>
		</div>
        <table class="table table-dark text-white-50">
            <thead>
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Gender</th>
                  <th scope="col">Age</th>
                </tr>
            </thead>
            <tbody>
<?php
                showUsers($conn,2)
?>
            </tbody>
        </table>
	  </section>
    <div class="py-3"></div>

</div>
<script>
$(document).ready(function($)
{ 	 
	function create_html_table (tbl_data)
	{
		//--->create data table > start
		var tbl = '';
		tbl +='<table class="table table-dark table-hover text-white-50 tbl_code_with_mark">'

			//--->create table header > start
			tbl +='<thead>';
				tbl +='<tr>';
				tbl +='<th scope="col">Username</th>';
				tbl +='<th scope="col">Email</th>';
				tbl +='<th scope="col">Gender</th>';
				tbl +='<th scope="col">Date of Birth</th>';
                tbl +='<th scope="col">Options</th>';
				tbl +='</tr>';
			tbl +='</thead>';
			//--->create table header > end
			
			//--->create table body > start
			tbl +='<tbody>';

				//--->create table body rows > start
				$.each(tbl_data, function(index, val) 
				{
					//you can replace with your database row id
					var row_id = val['usersId'];

					//loop through ajax row data
					tbl +='<tr row_id="'+row_id+'">';
						tbl +='<td ><div class="row_data" edit_type="click" col_name="fname">'+val['usersUsername']+'</div></td>';
						tbl +='<td ><div class="row_data" edit_type="click" col_name="lname">'+val['usersEmail']+'</div></td>';
						tbl +='<td ><div class="row_data" edit_type="click" col_name="email">'+val['usersGender']+'</div></td>';
                        tbl +='<td ><div class="row_data" edit_type="click" col_name="email">'+val['usersBirth']+'</div></td>';

						//--->edit options > start
						tbl +='<td>';						 
							tbl +='<span class="btn_edit" > <a href="#" class="btn btn-link " row_id="'+row_id+'" > Edit</a> </span>';
							//only show this button if edit button is clicked
							tbl +='<a href="#" class="btn_save btn btn-link"  row_id="'+row_id+'"> Save </a>';
							tbl +='<a href="#" class="btn_cancel btn btn-link" row_id="'+row_id+'"> Cancel </a>';
							tbl +='<a href="#" class="btn_delete btn btn-link1 text-danger" row_id="'+row_id+'"> Delete</a>';
						tbl +='</td>';
						//--->edit options > end						
					tbl +='</tr>';
				});
				//--->create table body rows > end
			tbl +='</tbody>';
			//--->create table body > end

		tbl +='</table>';
		//--->create data table > end

		//add new table row
		tbl +='<div class="text-center">';
			tbl +='<span class="btn btn-primary btn_new_row">Add New Row</span>';
		tbl +='<div>';

		//out put table data
		$(document).find('.table_test').html(tbl);

		$(document).find('.btn_save').hide();
		$(document).find('.btn_cancel').hide(); 	
		$(document).find('.btn_delete').hide(); 
	}

    var ajax_url = "../../ajax.php" ;

	//create table on page load
	//create_html_table(ajax_data);

	//--->create table via ajax call > start
	$.getJSON(ajax_url,{call_type:'get'},function(data) 
	{
		create_html_table(data);
	});
	//--->create table via ajax call > end
});
</script>

<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>