<main class="sidebar">
<section class="left">
		<ul>
	
			<li><a href="/job/list">Jobs</a></li>

		</ul>
	</section>

	<section class="right">

      
    <h2>Apply for <?=$job->title?>  </h2>

<form action="" method="POST" enctype="multipart/form-data">
    
    <label>Your name</label>
    <input type="text" name="name" value="<?= $applicant->name ?? ''?>"/>

    <label>E-mail address</label>
    <input type="text" name="email" value="<?= $applicant->email ?? ''?>"/>

    <label>Cover letter</label>
    <textarea name="details"><?= $applicant->details ?? ''?></textarea>

    <input type="hidden" name="jobId"  value="<?= $job->id ?? ''?>"/>
    <label>CV</label>
    <input type="file" name="cv" id="cv" value="<?= $applicant->cv ?? ''?>"/>


    <input type="submit" name="submit" value="Apply" />

</form>


    </section>
    </main>