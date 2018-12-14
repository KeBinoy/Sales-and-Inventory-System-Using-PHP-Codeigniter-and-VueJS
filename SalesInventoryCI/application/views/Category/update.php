<div id="container">
	<h1>Category Index Page!</h1>

	<div id="body">
		 
		 	<ul>
		 		<li><?php echo $result->category_name; ?></li>
		 	</ul>

		 	<form  method="post" action="<?php echo base_url(); ?>category/updateCategory">
         <?php echo validation_errors(); ?>  
         <?php echo form_open('form'); ?>  
         <input type = "hidden" name = "category_id" value = "<?php echo $result->category_id; ?>" size = "50" />  
         <h5>Category Name</h5> 
         <input type = "text" name = "category_name" value = "<?php echo $result->category_name; ?>" size = "50" />  
         <div><input type = "submit" value = "Submit" /></div>  
      </form>  
		 
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>