
<main class="sidebar">
<section class="left">
		<ul>
			<?php
		foreach($jobs as $job){
		}
	?>
			<li class="current"> <a href="/job/list?id=<?=$job->getCategory()->id?>"><?=$job->getCategory()->name?></a> </li>
           

<form action="/job/jobFilter" method="GET">

    <select name="location" id="location">
        <option value="">Location</option>
	<?php
		
        foreach ($locations as $location) { ?>
            <option value="<?= $location->id ?>"><?= $location->location_name ?></option>
        <?php } ?>
    </select>

    <select name="category" id="category">
        <option value="">Category</option>
        <?php 
		
		foreach ($categories as $category) { ?>
            <option value="<?= $category->id ?>"><?= $category->name ?></option>
        <?php } ?>
    </select>
    <input type="submit" value="Filter Jobs"/>
  
    </form>

			</li>
		</ul>
	</section>

	<section class="right">
	<h1><?=$job->getCategory()->name?> Jobs</h1>

<ul class="listing">
<?php
foreach($jobs as $job){
  if($job->status ==='active'){
	?>
 <li>
		 <div class="details">
		 <h2> <?=$job->title?> </h2>
		 <h3> <?=$job->salary?> </h3>
		 <p> <?= nl2br($job->description)?> </p>

		 <a class="more" href="/applicant/edit?id=<?=$job->id?>">Apply for this job</a>

		 </div>
		 </li>
<?php
}
}
?>
</ul>	
</section>
</main>


 <style>
    /* Add some styling to the form fields */
    select[name="location"],select[name="category"] {
      padding: 12px 20px;
      margin: 8px 0;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
	  width:120px;
    }

    /* Add some styling to the submit button */
    input[type="submit"] {
      background-color:#3868bd ;
      color: white;
      text-align : center;
      padding: 14px 20px;
      margin: 8px 0;
      width:100px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    /* Add some styling to the form container */
    form {
      /* border: 3px solid #f1f1f1; */
      width: 40%;
    

    }


  </style> 