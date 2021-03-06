<?php
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/Pages.php');
    require_once(ABSPATH.'wp-content/plugins/amara-page-access/functions.php');

    $pages = new Pages();

    if(isset($_POST["pages_button"]))
    {
        $page = get_page_by_title($_POST["pageSelector"]);
        $pages->add($page->ID);
    }

    if(isset($_POST["access_button"])|| isset($_POST["delete_button"]))
    {
      header("Refresh:0");
    }

?>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<h3>Przypisz dostęp</h3>
<span>dodaj stronę, do której chcesz ograniczyć dostęp</span>
<form method="POST">
<select name="pageSelector">

<?php foreach (getAllAmaraPagesIDS() as $pageID)
{
    echo '<option>'.get_the_title($pageID).'</option>';
}?>

</select>
<button name="pages_button" type="submit">dodaj</button>
</form>

<div class="pt-5">
<table class="table">
<thead>
    <tr>
      <th scope="col">Strona</th>
      <th scope="col">Role z zaznaczoną zgodą marketingową</th>
    </tr>
  </thead>
<tbody>
<form method="POST" class="apa_checkbox" id="apa_checkbox">
<?php  foreach($pages->getAllPagesIDS() as $pageID)

echo "<tr><td id='".$pageID."' class='apa_page'>".get_the_title($pageID)."</td><td>".displayCheckboxes($pageID).
"</td><td><button type ='submit' class=' delete_button btn btn-danger' value=".$pageID." name='delete_button'>usuń</button></td></tr>";
?>
</tbody>
</table>
<button class="access_button btn btn-success" name="access_button" type="submit">zapisz</button>
</form>
</div>