<?php
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/Pages.php');
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/functions.php');

    $pages = new Pages();

    if(isset($_POST["pageSelector"]))
    {
        $page = get_page_by_title($_POST["pageSelector"]);
        $pages->add($page->ID);
    }
    var_dump($_POST);

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<h3>Przypisz dostęp</h3>
<span>dodaj stronę, do której chcesz ograniczyć dostęp</span>
<form method="POST">
<select name="pageSelector">

<?php foreach ($pages->getAllPagesIDS() as $pageID)
{
    echo '<option>'.get_the_title($pageID).'</option>';
}?>

</select>
<button>dodaj</button>
</form>

<div class="pt-5">
<table class="table">
<thead>
    <tr>
      <th scope="col">Strona</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
<tbody>
<form method="POST">
<?php  foreach(getAllAmaraPagesIDS() as $pageID)

echo "<tr><td>".get_the_title($pageID)."</td><td>".displayCheckboxes($pageID)."</td></tr>";

?>
</tbody>
</table>
<button type="submit">zapisz</button>
</form>
</div>

