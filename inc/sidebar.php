<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>

						<?php  //select data from database
							$query = "SELECT * FROM `tbl_category`";
							$category = $db->select($query);
							if ($category) {
								while ($result = $category->fetch_assoc()) { ?>

						<!-- category id & name patacchi (catid)-->
						<li><a href="cat_post.php?catid=<?php echo $result['id'] ;?>">
							<?php echo $result['name'] ;?></a></li>
							
						<!--end while & if loop-->
						<?php } }else{ ?>

						<li>No Category Created !</li>

				        <?php } ?>

					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>

				<?php  //select data from database table
	                $query = "SELECT * FROM `tbl_post` LIMIT 4"; //show 5 latest article
	                $post = $db->select($query);
	                if($post){
	                	while( $result = $post->fetch_assoc() ){  ?>

					<div class="popular clear">

						<!-- latest post id & title -->
						<h3><a href="post.php?id=<?php echo $result['id'] ;?>">
						<?php echo $result['title'] ;?></a></h3>
						
						<!-- latest post id & image -->
						<a href="post.php?id=<?php echo $result['id'] ;?>">
							<img src="admin/<?php echo $result['image'] ;?>" alt="post image"/></a>

						<!-- latest article part -->
				        <?php echo $fm->textShorten($result['body'], 80);?><!--show 80 words-->

					</div>

					<!--end while & if loop-->
	                <?php } } else{ header("location: 404.php"); } ?> 

		  </div>
</div> 