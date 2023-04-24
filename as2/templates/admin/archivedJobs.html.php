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

			<h2>Archived Jobs</h2>

			<table>
			 <thead>
			 <tr>
			 <th>Title</th>
			 <th style="width: 15%">Salary</th>
			 <th style="width: 5%">&nbsp;</th>
			 <th style="width: 5%">&nbsp;</th>
			 </tr>


<?php
foreach($jobs as $job){
	if($job->status ==='archived'){
    ?>
				 <tr>
				 <td> <?=$job->title ?></td>
				 <td><?=$job->salary ?> </td>
				 <td> <form action="/job/delete" method="POST">
		        <input type="hidden" name="id" value="<?=$job->id?>" />
		        <input type="submit" name="submit" value="Delete" /></td>

			<td><a href="/job/getArchivedJobs?id=<?=$job->id?>">Repost</a></a> </td>

				
</form></td>
			 </tr>
			<?php
}
}
?>

			</thead>
		</table>
</section>
</main>

