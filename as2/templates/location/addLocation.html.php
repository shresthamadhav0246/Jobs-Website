<main class="sidebar">

	<section class="left">
		<ul>
		<li><a href="/job/manageJobs">Jobs</a></li>
			<li><a href="/category/manageCategory">Categories</a></li>
			<li><a href="/archivedJobs/list">Archived Jobs</a> </li>
            <li><a href="/location/list">Locations</a></li>
            <li><a href="/user/list">Permissions</a></li>
		</ul>
	</section>

	<section class="right">
<h2>Add New Location</h2>

<form action="" method="POST">

<input type="hidden" name="location[id]" value="<?= $location->id ?? ''?>" />
<label>Name</label>
<input type="text" name="location[location_name]" value="<?=$location->location_name ?? ''?>" />


<input type="submit" name="submit" value="Add Location" />

</form>

</section>
</main>