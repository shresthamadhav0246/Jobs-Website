<main class="sidebar">

	<section class="left">
		<ul>
		    <li><a href="/job/manageJobs">Jobs</a></li>
			<li><a href="/category/manageCategory">Categories</a></li>
			<li><a href="/job/archivedJobs">Archived Jobs</a> </li>
            <li><a href="/location/list">Locations</a></li>
			<li><a href="/admin/edit">Add user</a></li>
			<li><a href="/admin/list">Permissions</a></li>
			<li><a href="/enquiry/list">Enquires</a></li>
            <li><a href="/login/adminlogout">Logout</a></li>

		</ul>
	</section>

	<section class="right">

			<h2>Categories</h2>

			<a class="new" href="/category/edit">Add new category</a>


			 <table>
			 <thead>
			 <tr>
			 <th>Name</th>
			 <th style="width: 5%">&nbsp;</th>
			 <th style="width: 5%">&nbsp;</th>
			 </tr>
<?php
foreach($categories as $category){
    ?>
				 <tr>
				 <td> <?=$category->name?> </td>
				 <td><a style="float: right" href="/category/edit?id=<?=$category->id?>">Edit</a></td>
				<td> <form action="/category/delete" method="POST">
		        <input type="hidden" name="id" value="<?=$category->id?>" />
		        <input type="submit" name="submit" value="Delete" /></td>
	</form>
				 
				 </tr>
			<?php
}
?>

			</thead>
			</table>

</section>
</main>

		
