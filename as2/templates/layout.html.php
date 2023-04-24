<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css"/>
		<title><?=$title?></title>
	</head>
	<body>
	<header>
		<section>
			<aside>
				<h3>Office Hours:</h3>
				<p>Mon-Fri: 09:00-17:30</p>
				<p>Sat: 09:00-17:00</p>
				<p>Sun: Closed</p>
			</aside>
			<h1>Jo's Jobs</h1>

		</section>
	</header>
	<nav>
		<ul>
			<li><a href="/">Home</a></li>
			<li>Jobs
				<ul>
<?php
$pdo = new PDO('mysql:host=mysql;dbname=job;charset=utf8', 'student', 'student');
$stmt = $pdo->prepare('SELECT * FROM category');
$stmt->execute();
$categories=$stmt->fetchAll();
foreach($categories as $category){
?>
<li><a href="/job/list?id=<?=$category['id']?>"><?=$category['name']?></a> </li>
<?php
}
?>
				</ul>
			</li>
			<?php if ($loggedIn): ?>
            <li><a href="/login/logout">Log out</a></li>
             <?php else: ?>
            <li><a href="/login/login">Log in</a></li>
             <?php endif; ?>
			<li><a href="/user/edit">Sign Up</a>  </li>
			<li><a href="/faqs/FAQs">FAQs</a></li>
			<li><a href="/enquiry/edit">About</a></li>
		</ul>

	</nav>
<img src="/images/randombanner.php"/>
	
		<?=$output?>
	


	<footer>
		&copy; <?=date('Y')?>
	</footer>
</body>
</html>
