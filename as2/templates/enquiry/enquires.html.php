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

			<h2>Enquires</h2>
			<table>
			 <thead>
			 <tr>
			 <th>Name</th>
			 <th >email</th>
			 <th >Phone Number</th>
			 <th >Enquiry</th>
		
			 </tr>

<?php
foreach($enquires as $enquiry){

    ?>
				 <tr>
				 <td> <?php echo $enquiry->firstname.' '.$enquiry->surname;?></td>
				 <td><?=$enquiry->email ?> </td>
				 <td><?=$enquiry->number?> </td>
				 <td><?=$enquiry->enquiry?> </td>

</td>
</tr>
<?php
}
?>

			</thead>
		</table>
</section>
</main>

