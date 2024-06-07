<style>
#revisions {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#revisions td, #revisions th {
  border: 1px solid #ddd;
  padding: 8px;
}

#revisions tr:nth-child(even){background-color: #f2f2f2;}

#revisions tr:hover {background-color: #ddd;}

#revisions th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
<!--  -->
<div class="card">
<h2>Результаты поиска</h2>

<?php
//use App\Libraries\MyData as MyData;
$table = new \CodeIgniter\View\Table();
$template = ['table_open' => '<table id="revisions">',];
$table->setTemplate($template);
$table->setHeading($table_header)->setSyncRowsWithHeading(true);
echo $table->generate($table_body);
?>

</div>