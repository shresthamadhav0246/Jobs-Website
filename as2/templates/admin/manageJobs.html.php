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

			<h2>Jobs</h2>
		
<a class="new" href="/job/edit">Add new job</a>
<div style=" display: flex;
   align-items: center;
   justify-content: space-between;">

<form action="/job/jobFilterByCategory" method="GET">
<select name="category" id="category">
        <option value="">Category</option>
        <?php 
		
		foreach ($categories as $category) { ?>
            <option value="<?= $category->id ?>"><?= $category->name ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Filter Jobs"/>
<div>

			<table>
			 <thead>
			 <tr>
			 <th>Title</th>
			 <th style="width: 15%">Salary</th>
			 <th >Catogery</th>
			 <th style="width: 5%">&nbsp;</th>
			 <th style="width: 15%">&nbsp;</th>
			 <th style="width: 5%">&nbsp;</th>
			 <th style="width: 5%">&nbsp;</th>
			 </tr>

<?php
foreach($jobs as $job){

    ?>
				 <tr>
				 <td> <?=$job->title ?></td>
				 <td><?=$job->salary ?> </td>
				 <td><?=$job->getCategory()->name;?> </td>
				
	<?php if ($user->id == $job->userId || $user->hasPermission(\Job\Entity\Users::APPLICANT_LIST)): ?>
		<td><a style="float: right" href="/applicant/list?id=<?=$job->id?>">View applicants (<?=$job->applicantCount?>)</a></td>
  <?php endif; ?>
				 <?php if ($user): ?>
  <?php if ($user->id == $job->userId || $user->hasPermission(\Job\Entity\Users::EDIT_JOB)): ?>
	<td><a style="float: right" href="/job/edit?id=<?=$job->id?>">Edit</a></td>
  <?php endif; ?>
  <?php if ($user->id == $job->userId || $user->hasPermission(\Job\Entity\Users::DELETE_JOB)): ?>
	<td> <form action="/job/delete" method="POST">
		        <input type="hidden" name="id" value="<?=$job->id?>" />
		        <input type="submit" name="submit" value="Delete" />
  <?php endif; ?>
		 
				<?php if ($job->status === 'active') { ?>
					<?php if ($user->id == $job->userId || $user->hasPermission(\Job\Entity\Users::ARCHIVE_JOB)): ?>
              <td> <a href="/job/archiveJob?id=<?=$job->id?>">Archive</a>
			  <?php endif; ?>
              <?php } else { ?>
         Archived
      <?php } ?>
	  <?php endif; ?>
</form>

</td>
</tr>
<?php
}
?>

			</thead>
		</table>
</section>
</main>

