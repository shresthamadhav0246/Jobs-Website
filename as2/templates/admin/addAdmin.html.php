<main class="sidebar">
<section class="left">
		<ul>
	
    <li><a href="/job/manageJobs">Jobs</a></li>
			<li><a href="/category/manageCategory">Categories</a></li>
			<li><a href="/admin/edit">Add User</a></li>
		  <li><a href="/job/archivedJobs">Archived Jobs</a> </li>
            <li><a href="/location/list">Locations</a></li>
			<li><a href="/admin/edit">Add user</a></li>
			<li><a href="/admin/list">Permissions</a></li>
      <li><a href="/enquiry/list">Enquires</a></li>
            <li><a href="/login/adminlogout">Logout</a></li>

		</ul>
	</section>

	<section class="right">
      
    <h2>Admin Account </h2>

	<form action="" method="POST">
  <input type="hidden" name="admin[id]" />

    <label for="name">Name</label>
    <input type="text" name="admin[name]" id="name"  placeholder="Enter your name"/>


  
    <label for="email">Email</label>
    <input type="text" name="admin[email]" id="email"  placeholder="Enter your email"/>



    <label for="user_type">User Type</label>
    <select name="admin[user_type]" id="user_type">
      <option name="admin">Admin</option>
      <option name="client">Client</option>
    </select>
 


    <label for="password">Password</label>
    <input type="password" name="admin[password]" id="password"  placeholder="Enter your password"/>


  <input type="submit" name="submit" value="REGISTER" />
</form>

</main>

<style>