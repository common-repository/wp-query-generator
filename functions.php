<?php

/*
*	DEFINE CONTSTAINTS
*/

if(!defined('__PLUGINNAME'))
  define('__PLUGINNAME','WP QUERY GENRATOR');
if(!defined('PLUGINFOLDER'))
  define('PLUGINFOLDER', basename(dirname(__FILE__)));
if(!defined('WP_QG'))
  define('WP_QG', admin_url('admin.php?page=wp_query_genrator'));




function load_wp_qg_required_files($hook) {

/*
*   STOP ADDING STYLES AND SCRIPTS TO OTHER PAGES 
*/
if($hook != "toplevel_page_wp_query_genrator") 
  return;

/*
* ENQUEE WP QG STYLE SHEET AND JAVASCRIPT'S
*/


wp_enqueue_style('wp_query_genrator_styles', plugins_url()."/".PLUGINFOLDER."/css/style.css");
wp_enqueue_style('wp_query_genrator_bootstrap', plugins_url()."/".PLUGINFOLDER."/css/bootstrap.min.css");
wp_enqueue_script('wp_query_genrator_bootstrapjs', plugins_url()."/".PLUGINFOLDER."/js/bootstrap.min.js");
wp_enqueue_script('wp_query_genrator_scripts', plugins_url()."/".PLUGINFOLDER."/js/scripts.js");

/*
* ENQUEE SYNTAX HIGHLIGHTER STYLE SHEET AND JAVASCRIPT'S
*/


}

add_action( 'admin_enqueue_scripts', 'load_wp_qg_required_files' );


/*
*	AJAX SERVER SIDE PAGE
*/

function printspaces($string , $sp = 22){
  
  $m = strlen($string);
  $s = '';
  for($i = 0; $i <= ($sp-$m);$i++){
    $s .= " ";
  }

  return $s;
}

function update_code_area() {
  	
  	$args = $_POST;
    

    // Get Meta Query if Exists 
    $meta_keys = array(
      'meta_key',
      'meta_value',
      'meta_compare',
      'meta_type'
      );

    $meta_in_post = array();
    $invalid = array('+','-','$','%','!','@','#','^','&','*','(',')','`','~',' ','=','/','\\','\'','"',',','}','{',']','[',':',';','.','>','<','|','?');
    $isloop  = $_POST['is_show_loop'];
    $var     = $_POST['var_name'];
    $var     = str_replace($invalid, '', $var);
    if($var == "" || is_numeric($var[0]))
      $var = 'query';
  	unset($args['var_name'],$args['is_show_loop']);
  	$code = "// WP_Query args \n";
    $code .= '$args = array ('."\n";
  	foreach($args as $k => $v){
  		if($v == "") continue;
      if(in_array($k, $meta_keys)) {
        $_k = str_replace('meta_', '', $k);
        $meta_in_post[$_k] = $v;
        continue;
      }
    		$code .= "\t'".$k."'". printspaces($k) ." => ";
      if($v == 'true' || $v == 'false'){
        $code .= " ".$v.",\n";
      } else {
        $code .= "'".$v."',\n";
      }
  	
    }

    if(!empty($meta_in_post)) {
      $code .= "\t'meta_query' => array ( \n";
      $code .= "\t\t array (\n";
      foreach ($meta_in_post as $key => $value) {
      $code .= "\t\t\t'".$key."'".printspaces($key , 7)."=> '".$value."',\n";
      }
      $code .= "\t\t\t),\n";
      $code .= "\t\t),\n";
    }

  	// var_dump($_POST['azeem']);
  	$code .= ');'."\n\n";
  $code .= "// The QUERY \n";
	$code .=  "$".$var.' = new WP_Query( $args );';

  if($isloop == 'yes') {
    $code .= "\n\n";
    $code .= "// The Loop";
    $code .="
if( $".$var."->have_posts() ) {
 while( $".$var."->have_posts() ) {
     
        $".$var."->the_post();
     
        // your html markup
     
 }
} else {
  // No posts found
}

// Restore Post Data
wp_reset_postdata();
    ";
  }

  echo get_sourcecode_string("<?php \n".$code, true);

  die();
}
add_action('wp_ajax_update_code_area', 'update_code_area');


function wp_qg_the_slug($id) {
$post_data = get_post($id, ARRAY_A);
$slug = $post_data['post_name'];
return $slug; 
}



function get_sourcecode_string($str , $return = false) {
  $str = highlight_string($str , true);
  $code = $str;

   $myHighLight = array(
      '('             =>  'color:green',
      ')'             =>  'color:green',
      '{'             =>  'color:green',
      '}'             =>  'color:green',
      'while'         =>  'color:brown',
      'if'         =>  'color:brown',
      'else'         =>  'color:brown',
      'else if'         =>  'color:brown',
      'array'         =>  'color:green',
    );

   $str = substr($str, 65);
  foreach ($myHighLight as $key => $val) {
      $str = str_replace($key, '<span style="'.$val.'">'. $key .'</span>', $str);
  }


  $lines = explode('<br />', $str);

  $code = "<ol>";
  foreach ($lines as $line) {
    $code .= "<li>".$line."</li>";
  }
  $code .= "</ol>";
  if($retrun) return $code;
  else echo $code;
}


