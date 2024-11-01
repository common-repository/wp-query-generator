<?php
/*
* Plugin Name: WP Query Generator
* Author: Azi Baloch
* Author Uri: http://azibaloch.com
* Version:1.0
* Description: this  simple plugin will allow you to genrate WordPress queries right from you wp-admin . 
*/


require_once('functions.php');
   
   
   function wp_query_genrator_InIt(){
       add_menu_page('WP Query Generator by Azi Baloch', 'Query Generator', 'manage_options', 'wp_query_genrator','_aziQueryGenContent','');
   }
   
   add_action('admin_menu','wp_query_genrator_InIt');
   



/*
*
* 	DRAW PAGE CONTENT
*/
function _aziQueryGenContent() { ?>
<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<div class="page-header">
				<h1>
					WP_QUERY Generator <small>beta</small>
				</h1>
			</div>
			<div class="row clearfix">
				<div class="col-md-12 column">
					<h4>
						
					</h4>
					<div class="row clearfix">
						<div class="col-md-6 column">
							
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title" style='color:#fff'>
								Arguments
							</h3>
						</div>
						<div class="panel-body">
						

						<form id="args_form" role="form">
								
				<div class="panel-group" id="panel-264602">
				
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-44584">Genral</a>
					</div>
					<div id="panel-element-44584" class="panel-collapse in">
						<div class="panel-body">
								

							<div class="form-group">
								 <label for="var_name">Variable Name</label>
								 <input type="name" name='var_name' value="query" class="form-control" id="var_name" />
							</div>

							<div class="form-group">
								 <label for="is_show_loop">Show The Loop</label>
								 <select name="is_show_loop">
								 	<option value="no" selected>NO</option>
								 	<option value="yes" >YES</option>
								 </select>
							</div>


						</div>
					</div>
				</div>



				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518263">Post & Page</a>
					</div>
					<div id="panel-element-518263" class="panel-collapse collapse">
						<div class="panel-body">
							

							<div class="form-group">
								 <label for="var_name">Post ID</label>
								 <input list='post_ids' type="name" name='p'  class="form-control" id="wp_qg_control" />
								 <datalist id="post_ids">
								 	<?php 
								 	$args = array(
								 		'post_type' => 'post'
								 		); 
								 	$query_posts = new WP_Query($args);
								 	if($query_posts->have_posts()) {
								 		while($query_posts->have_posts()){
								 			$query_posts->the_post();
								 			echo "<option value='".get_the_ID()."'>". get_the_title() ."</option>";
								 		}
								 	}
								 	?>
								 </datalist>
							</div>
							
							<div class="form-group">
								 <label for="var_name">Post Slug</label>
								 <input type="name" list="post_slugs" name='name'  class="form-control" id="wp_qg_control" />
								 <datalist id="post_slugs">
								 	<?php 
								 	$args = array(
								 		'post_type' => 'post'
								 		); 
								 	$query_posts = new WP_Query($args);
								 	if($query_posts->have_posts()) {
								 		while($query_posts->have_posts()){
								 			$query_posts->the_post();
								 			echo "<option value='".wp_qg_the_slug(get_the_ID())."'>". get_the_title() ."</option>";
								 		}
								 	}
								 	?>
								 </datalist>
							</div>

							<div class="form-group">
								 <label for="var_name">Page ID</label>
								 <input type="name" list='page_ids' name='page_id'  class="form-control" id="wp_qg_control" />
								  <datalist id="page_ids">
								 	<?php 
								 	$args = array(
								 		'post_type' => 'page'
								 		); 
								 	$query_posts = new WP_Query($args);
								 	if($query_posts->have_posts()) {
								 		while($query_posts->have_posts()){
								 			$query_posts->the_post();
								 			echo "<option value='".get_the_ID()."'>". get_the_title() ."</option>";
								 		}
								 	}
								 	?>
								 </datalist>
							</div>

							<div class="form-group">
								 <label for="var_name">Page Slug</label>
								 <input type="name" list="page_slugs" name='pagename'  class="form-control" id="wp_qg_control" />
								 <datalist id="page_slugs">
								 	<?php 
								 	$args = array(
								 		'post_type' => 'page'
								 		); 
								 	$query_posts = new WP_Query($args);
								 	if($query_posts->have_posts()) {
								 		while($query_posts->have_posts()){
								 			$query_posts->the_post();
								 			echo "<option value='".wp_qg_the_slug(get_the_ID())."'>". get_the_title() ."</option>";
								 		}
								 	}
								 	?>
								 </datalist>
							</div>

							<div class="form-group">
								 <label for="var_name">Parent</label>
								 <input type="name" name='post_parent'  class="form-control" id="wp_qg_control" />
							</div>

						



						</div>
					</div>
				</div>


					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518264">Type & Status</a>
					</div>
					<div id="panel-element-518264" class="panel-collapse collapse">
						<div class="panel-body">
							

							<div class="form-group">
								 <label for="var_name">Post Type</label>
								 <input type="name" list="post_types" name='post_type'  class="form-control" id="wp_qg_control" />
								 <datalist id="post_types">
								  <?php 

								  $post_types = get_post_types( '', 'names' ); 

									foreach ( $post_types as $post_type ) {

									   echo '<option value='. $post_type .'>' . $post_type . '</option>';
									}
									?>
								</datalist>
							</div>
							
							<div class="form-group">
								 <label for="var_name">Post Status</label>
								 <input type="name" name='post_status'  class="form-control" id="wp_qg_control" />
							</div>

	

						</div>
					</div>
				</div>





					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518265">Taxonomy</a>
					</div>
					<div id="panel-element-518265" class="panel-collapse collapse">
						<div class="panel-body">
							

							<div class="form-group">
								 <label for="cat">Category ID</label>
								 <input type="name" list="cat_ids" name='cat'  class="form-control" id="wp_qg_control" />
								 	<datalist id="cat_ids">
								 <?php
								 $args = array(
									'type'                     => 'post',
									'child_of'                 => 0,
									'parent'                   => '',
									'orderby'                  => 'name',
									'order'                    => 'ASC',
									'hide_empty'               => 0,
									'hierarchical'             => 1,
									'exclude'                  => '',
									'include'                  => '',
									'number'                   => '',
									'taxonomy'                 => 'category',
									'pad_counts'               => false 

								); 
								$tr = get_categories($args);

								 foreach ($tr as $key => $value) {
								 	echo "<option value='".$value->term_id."'>".$value->name."</option>";
								 }
								 ?>
								</datalist>
							</div>
							
							<div class="form-group">
								 <label for="category_name">Category Name</label>
								 <input list="cat_slugs" type="name" name='category_name'  class="form-control" id="wp_qg_control" />
								<datalist id="cat_slugs">
								 <?php
								 $args = array(
									'type'                     => 'post',
									'child_of'                 => 0,
									'parent'                   => '',
									'orderby'                  => 'name',
									'order'                    => 'ASC',
									'hide_empty'               => 0,
									'hierarchical'             => 1,
									'exclude'                  => '',
									'include'                  => '',
									'number'                   => '',
									'taxonomy'                 => 'category',
									'pad_counts'               => false 

								); 
								$tr = get_categories($args);

								 foreach ($tr as $key => $value) {
								 	echo "<option value='".$value->slug."'>".$value->name."</option>";
								 }
								 ?>
								</datalist>
							</div>

							<div class="form-group">
								 <label for="var_name">Tag ID</label>
								 <input type="name" list="tag_ids" name='tag_id'  class="form-control" id="wp_qg_control" />
								 <datalist id="tag_ids">
								 <?php
								 $args = array(
									'orderby'                  => 'name',
									'order'                    => 'ASC',
									'hide_empty'               => 0,
								); 
								$tr = get_tags($args);
								 foreach ($tr as $key => $value) {
								 	echo "<option value='".$value->term_id."'>".$value->name."</option>";
								 }
								 ?>
								</datalist>
							</div>
							
							<div class="form-group">
								 <label for="var_name">Tag Name</label>
								 <input type="name" list="tag_slugs" name='tag_name'  class="form-control" id="wp_qg_control" />
								 	 <datalist id="tag_slugs">
								 <?php
								 $args = array(
									'orderby'                  => 'name',
									'order'                    => 'ASC',
									'hide_empty'               => 0,
								); 
								$tr = get_tags($args);
								 foreach ($tr as $key => $value) {
								 	echo "<option value='".$value->slug."'>".$value->name."</option>";
								 }
								 ?>
								</datalist>
							</div>

	

						</div>
					</div>
				</div>




					<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518266">Author</a>
					</div>
					<div id="panel-element-518266" class="panel-collapse collapse">
						<div class="panel-body">
							

							<div class="form-group">
								 <label for="cat">Author ID</label>
								 <input type="name" list="user_ids" name='author'  class="form-control" id="wp_qg_control" />
								 <?php 
								 $args = array(
									'orderby'      => 'login',
									'order'        => 'ASC',
								 );

								 $users = get_users($args);
								 ?>

								 <datalist id="user_ids">
								 	<?php 
								 foreach ($users as $user) {
								 	echo "<option value='".$user->ID."'>".$user->display_name."</option>";
								 }
								 	?>
								 </datalist>
							</div>
							
							<div class="form-group">
								 <label for="category_name">Author Name</label>
								 <input type="name" list="user_names" name='author_name'  class="form-control" id="wp_qg_control" />
								 		 <?php 
								 $args = array(
									'orderby'      => 'login',
									'order'        => 'ASC',
								 );

								 $users = get_users($args);
								 ?>

								 <datalist id="user_names">
								 	<?php 
								 foreach ($users as $user) {
								 	echo "<option value='".$user->user_login."'>".$user->display_name."</option>";
								 }
								 	?>
								 </datalist>
							</div>


	

						</div>
					</div>
				</div>


				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518267">Search</a>
					</div>
					<div id="panel-element-518267" class="panel-collapse collapse">
						<div class="panel-body">
							

							<div class="form-group">
								 <label for="s">Search Keyword</label>
								 <input type="text" autocomplete="off" name='s'  class="form-control" id="wp_qg_control" />
							</div>
							
						</div>
					</div>
				</div>

				
				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518268">Pagination</a>
					</div>
					<div id="panel-element-518268" class="panel-collapse collapse">
						<div class="panel-body">
							

						<div class="form-group">
							 <label for="pagination">Use Pagination</label>
							 <select name='pagination'>
							 	<option value='' selected> Chose... </option>
							 	<option value='true'> Yes </option>
							 	<option value='false'> No </option>
							 </select>
						</div>
						
						<div class="form-group">
							 <label for="paged">Paged</label>
							 <input type="text" autocomplete="off" name='paged'  class="form-control" id="wp_qg_control" />
						</div>

						<div class="form-group">
							 <label for="posts_per_page">Posts per page</label>
							 <input type="text" autocomplete="off" name='posts_per_page'  class="form-control" id="wp_qg_control" />
						</div>
						
						<div class="form-group">
							 <label for="posts_per_archive_page">Posts per archive page</label>
							 <input type="text" autocomplete="off" name='posts_per_archive_page'  class="form-control" id="wp_qg_control" />
						</div>
						
						<div class="form-group">
							 <label for="ignore_sticky_posts">Sticky Post</label>
							  <select name='ignore_sticky_posts'>
							 	<option value='' selected> Chose... </option>
							 	<option value='true'> Yes </option>
							 	<option value='false'> No </option>
							 </select>
							 
						</div>
						
						<div class="form-group">
							 <label for="offset">Offset</label>
							 <input type="text" autocomplete="off" name='offset'  class="form-control" id="wp_qg_control" />
						</div>
							



						</div>
					</div>
				</div>
				

				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518269">Order</a>
					</div>
					<div id="panel-element-518269" class="panel-collapse collapse">
						<div class="panel-body">
							

						<div class="form-group">
							 <label for="order">Order</label>
							<select name="order" id="order">
								<option selected="" value="">Choose..</option>
								<option value="ASC">ASC</option>
								<option value="DESC">DESC (Default)</option>
							</select>
						</div>
						
						<div class="form-group">
							 <label for="orderby">Order by</label>
							 <select name="orderby">
								<option selected="" value="">Choose..</option>
								<option value="none">None</option>
								<option value="rand">Random</option>
								<option value="id">ID</option>
								<option value="title">Title</option>
								<option value="name">Slug</option>
								<option value="date">Date - Default</option>
								<option value="modified">Modified Date</option>
								<option value="parent">Parent ID</option>
								<option value="menu_order">Menu Order</option>
								<option value="comment_count">Comment Count</option>
							</select>
						</div>

						</div>
					</div>
				</div>

				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518270">Date</a>
					</div>
					<div id="panel-element-518270" class="panel-collapse collapse">
						<div class="panel-body">
							

						
						<div class="form-group">
							 <label for="year">Year</label>
							 <input type="text" autocomplete="off" name='year'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">4 digit year e.g : 2014</p>
						</div>

						<div class="form-group">
							 <label for="monthnum">Month</label>
							 <input type="text" autocomplete="off" name='monthnum'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">from 1 to 12</p>
						</div>
						
						<div class="form-group">
							 <label for="day">Day</label>
							 <input type="text" autocomplete="off" name='day'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">from 1 to 31</p>
						</div>
					
						
						<div class="form-group">
							 <label for="hour">Hour</label>
							 <input type="text" autocomplete="off" name='hour'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">from 0 to 23</p>
						</div>
													
						<div class="form-group">
							 <label for="minute">Minute</label>
							 <input type="text" autocomplete="off" name='minute'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">from 0 to 59</p>
						</div>
					
						
						<div class="form-group">
							 <label for="second">Second</label>
							 <input type="text" autocomplete="off" name='second'  class="form-control" id="wp_qg_control" />
							 <p class="help-block">from 0 to 59</p>
						</div>
							



						</div>
					</div>
				</div>



				<div class="panel panel-default">
					<div class="panel-heading">
						 <a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-264602" href="#panel-element-518271">Cucstom Fields</a>
					</div>
					<div id="panel-element-518271" class="panel-collapse collapse">
						<div class="panel-body">
							

						
						<div class="form-group">
							 <label for="meta_key">Custom Field Key</label>
							 <input type="text" autocomplete="off" name='meta_key'  class="form-control" id="wp_qg_control" />

						</div>

						<div class="form-group">
							 <label for="meta_value">Custom Field Value</label>
							 <input type="text" autocomplete="off" name='meta_value'  class="form-control" id="wp_qg_control" />
						</div>
						
						<div class="form-group">
							<label for="meta_compare">Compare Operator</label>
							<select name="meta_compare">
								<option selected="" value="">Choose..</option>
								<option value="=">= (Default)</option>
								<option value="!=">!=</option>
								<option value=">">&gt;</option>
								<option value=">=">&gt;=</option>
								<option value="<">&lt;</option>
								<option value="<=">&lt;=</option>
								<option value="LIKE">LIKE</option>
								<option value="NOT LIKE">NOT LIKE</option>
								<option value="IN">IN</option>
								<option value="NOT IN">NOT IN</option>
								<option value="BETWEEN">BETWEEN</option>
								<option value="NOT BETWEEN">NOT BETWEEN</option>
								<option value="EXISTS">EXISTS</option>
							</select>
						</div>
					
						
						<div class="form-group">
							<label for="meta_type">Meta Type</label>
							<select name="meta_type">
								<option selected="" value="">Choose..</option>
								<option value="NUMERIC">NUMERIC</option>
								<option value="BINARY">BINARY</option>
								<option value="DATE">DATE</option>
								<option value="CHAR">CHAR (Default)</option>
								<option value="DATETIME">DATETIME</option>
								<option value="DECIMAL">DECIMAL</option>
								<option value="SIGNED">SIGNED</option>
								<option value="TIME">TIME</option>
								<option value="UNSIGNED">UNSIGNED</option>
							</select>
						</div>
													
						</div>
					</div>
				</div>




			</div>


							<br />
							<br />

							 <button type="submit" class="btn btn-default">Update Code</button>
							</form>

		<script>


			 

			jQuery(function($){
				
				$('.goFull').click(function(){
					$('.code_panel').css({'position':'fixed','z-index':99999999999,'overflow':'auto'});
					$('.code_panel').animate({
						'width':'100%',
						'height':'100%',
						'top':0,
						'left':0
					}, function(){
						$('.goFull').hide();
						$('.exitFull').show();
					});
				});
				$('.exitFull').click(function(){
					$('.code_panel').removeAttr('style');
					$('.exitFull').hide();
					$('.goFull').show();
				});
	
			

				var timeout;

				

				// AJAX RUN
				function runAjax(){
					var data = $("#args_form").serialize();

					$('.output_screen').animate({
						"opacity": 0.2
					}, 500);
					    jQuery.ajax({
					        type: "POST",
					        url: "<?php echo admin_url('admin-ajax.php?action=update_code_area') ?>",
					        data: data,
					        success: function(response) {
					        	var _html = "<pre id='output_tag'>";
					        		_html += response;
					        		_html += "</pre>";
					            $(".output_screen").html(_html);
					            	$('.output_screen').animate({
										"opacity": 1
									}, 500);
					  

						}
					    });

					     clearTimeout(timeout);
				}

				// ON FORM SUBMIT

				$('#args_form').submit(function(ev){
					ev.preventDefault();
					runAjax();
				})

				// ON CODE CHANGE
				$('input').keyup(function() {
				    if(timeout) {
				        clearTimeout(timeout);
				        timeout = null;
				    }

				    timeout = setTimeout(runAjax, 1000)
				});

				$('select').on("change", function() {
				    if(timeout) {
				        clearTimeout(timeout);
				        timeout = null;
				    }

				    timeout = setTimeout(runAjax, 1000)
				});


				$('input').on("input", function() {
				    if(timeout) {
				        clearTimeout(timeout);
				        timeout = null;
				    }

				    timeout = setTimeout(runAjax, 1000)
				});


			});
		</script>

						</div>
						<div class="panel-footer">
							
						</div>
					</div>
							
						</div>
						<div class="col-md-6 column">
<div class="panel panel-primary code_panel">
						<div class="panel-heading">
							<h3 class="panel-title" style='color:#fff'>
								Output Code
							</h3>
							<a style='float:right;color:#fff;margin-bottom:5px;margin-right:5px;position: relative;top: -17px;' class='goFull' href='javascript:void()'>Full Screen</a>
							<a style='float:right;display:none;color:#fff;margin-bottom:5px;margin-right:5px;position: relative;top: -17px;' class='exitFull' href='javascript:void()'>Exit Full Screen</a>
						</div>
						<div class="panel-body">
						<div class='output_screen'>
<pre id='output_tag'>
<?php echo get_sourcecode_string("<?php 
// WP_Query args 
\$args = array ( ); 

// The QUERY 
\$query = new WP_Query( \$args ); 

", true); ?>
</pre>
</div>

						</div>
						<div class="panel-footer">
							
						</div>
					</div>












					<div class="donate" style="text-align:center">

						Developed by <strong><a href="http://azibaloch.com" target="_blank">Azi Baloch</a></strong>
						<br />
	If you like my work then please consider donating for <a href="http://www.brahvimedia.net" target="_blank">Brahvi Media </a> <br><br>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="LLNJNL2X3L6SQ">
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>

</div>



						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
   <?php } ?>