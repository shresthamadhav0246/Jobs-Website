
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
<h2>Add Category</h2>

	<form action="" method="POST">

			<input type="hidden" name="category[id]" value="<?= $category->id ?? ''?>" />
		    <label>Name</label>
			<input type="text" name="category[name]" value="<?=$category->name ?? ''?>" />


			<input type="submit" name="submit" value="Save Category" />

	</form>

</section>
</main>