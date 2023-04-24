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
    <h2>Add Job</h2>

    <form action="" method="POST">
        <input type="hidden" name="job[id]" value="<?=$job->id ?? ''?>">
        <label>Title</label>
        <input type="text" name="job[title]" value="<?=$job->title ?? ''?>">

        <label>Description</label>
        <textarea name="job[description]" ><?=$job->description ?? ''?></textarea>

        <label>Salary</label>
        <input type="text" name="job[salary]" value="<?=$job->salary ?? ''?>" />

        <label>Location</label>
        <select name="job[locationId]">
        <?php
        foreach($locations as $location) {
            $selected = $location->id == $job->locationId ? 'selected' : '';
        ?>
            <option value="<?=$location->id?>" <?=$selected?>><?=$location->location_name?></option>
        <?php
        }
        ?>
        </select>

        <label>Category</label>
        <select name="job[categoryId]">
        <?php
        foreach ($categories as $category) {
            $selected = $category->id == $job->categoryId ? 'selected' : '';
        ?>
            <option value="<?=$category->id?>" <?=$selected?>><?=$category->name?></option>
        <?php  
        }
        ?>
        </select>

        <label>Closing Date</label>
        <input type="date" name="job[closingDate]" value="<?=$job->closingDate ?? ''?>" />
 
          <input type="hidden" name="job[userId]" value="<?=$userId?>"/>
        <input type="submit" name="submit" value="Save" />
    </form>
 




</section>
</main>


