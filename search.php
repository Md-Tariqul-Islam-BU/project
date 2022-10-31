<?php include 'inc/header.php';?>
	
<?php 

	if(!isset($_GET['search']) || $_GET['search']==NULL){
		header("LOCATION: 404.php");
	}
	else{
		$search = $_GET['search'];
	}

?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <?php 
		$query = "select * from tbl_post where title LIKE '%$search%' or body LIKE '%$search%'";
		$post = $db->select($query);
		if($post){
			while($result = $post->fetch_assoc()){
		?>

            <div class="samepost clear">
				<h2><a href="post.php?id= <?php echo $result['id']; ?>">  <?php echo $result['title'];?> </a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?>, By <a href="#"><?php echo $result['tourist']; ?></a></h4>
				 <a href="#"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
				 <?php echo $fm->textshortent($result['body'], 200); ?>

				<div class="readmore clear">
					<a href="post.php?id= <?php echo $result['id']; ?>">Read More</a>
				</div>
			</div>
            <?php } } else{ ?>
            <p>Your earch will not found</p>
            <?php } ?>
      
        </div>
    <?php include "inc/sidebar.php"; ?>

<?php include "inc/footer.php"; ?>