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

<h2>User List</h2>

   <table>
        <thead>
           <th>Name</th>
           <th>User type</th>
           <th>Edit</th>
           <th>Remove</th>
         </thead>
<tbody>
<?php foreach ($users as $user){ ?>
<tr>
<td><?=$user->name;?></td>
<td><?=$user->user_type;?></td>
<td><a href="/admin/permissions?id=<?=$user->id;?>">Edit Permissions</a></td>
<td> 
<!-- <form action="/admin/delete" method="post">
    <input type="hidden" name="id" >
    <input type="submit" value="Delete">
  </form> -->
</td>
</tr>
<?php 
}
?>
</tbody>
</table>
</section>
</main>