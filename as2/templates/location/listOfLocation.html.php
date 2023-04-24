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
        <h2>Job Locations</h2>
        <a href="/location/edit">Add Location</a>

    <table>
			 <thead>
			 <tr>
			 <th style="width: 50%">Location</th>
			 <th style="width: 15%">Update</th>
</tr>
<?php
foreach($locations as $location){
    ?>
 <tr>
				 <td style="width: 50%"> <?=$location->location_name ?></td>;
				 <td><a href="/location/edit?id=<?=$location->id?>"> Edit</a></td>
                 <td> 
                    <form action="/location/delete" method="POST">
		        <input type="hidden" name="id" value="<?=$location->id?>" />
		        <input type="submit" name="submit" value="Delete" /></td>
</tr>

<?php
}
?>
	</thead>
		</table>
</section>
</main>