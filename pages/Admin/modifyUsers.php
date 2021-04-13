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

<?php
  $pathFooter = $_SERVER['DOCUMENT_ROOT'];
  $pathFooter .= '/AutoKapt/bases/footer.php';/* psq le / va voir la vrai root d'ou cette méthode */
  include_once($pathFooter);
?>