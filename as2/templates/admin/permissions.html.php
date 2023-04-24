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
<h2><?=$user->name?></h2>

<form action="" method="post">
    <input type="hidden" name="id" id="id" value="<?=$user->id?>"/>
<?php foreach ($permissions as $name => $value): ?>
<div>
    <input name="permissions[]" type="checkbox" value="<?=$value?>"<?php if ($user->hasPermission($value)): echo 'checked'; endif; ?> />
    <?php $name = str_replace("_", " ", $name);
    $name = ucwords(strtolower($name)); ?>
    <label><?=$name?>
</div>
<?php endforeach; ?>
<input type="submit" value="Submit" />
</form>
</section>
</main>


<style>


form {
    display: flex;
    flex-wrap: wrap;
    justify-content: left;
}

form div {
    display: flex;
    margin-bottom: 10px;
}

form label {
    margin-left: 10px;
}

</style>

