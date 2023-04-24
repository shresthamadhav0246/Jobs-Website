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
    <h2>Repost Job</h2>

<form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
    <input type="hidden" name="job[id]" value="<?= $job->id ?? ''?>"/>
    <label>Title</label>
    <input type="text" name="job[title]" value="<?= $job->title ?? ''?>"/>

    <label>Description</label>
    <textarea name="job[description]" ><?= $job->description ?? ''?></textarea>

    <label>Salary</label>
    <input type="text" name="job[salary]" value="<?= $job->salary ?? ''?>" />

    <label>Location</label>
    <input type="text" name="job[location]" value="<?= $job->location ?? ''?>"/>

    <label>Category</label>

    <select name="job[categoryId]" value="<?= $job->categoryId ?? ''?>">
   <?php
   require '../connection/connection.php';
   $categoriesTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');
   $categories = $categoriesTable->findAll();

     foreach ($categories as $category) {
            ?>
        <option value="<?= $category->id?>"><?=$category->name?> </option>
    <?php  
      }

    ?>

    </select>

    <label>Closing Date</label>
    <input type="date" name="job[closingDate]" value="<?= $job->closingDate ?? ''?>" />

    <input type="submit" name="submit" value="Add" />

</form>
    </section>
    </main>

