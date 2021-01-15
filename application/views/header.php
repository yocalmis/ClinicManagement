<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title>Klinik Yönetimi</title>
	<?php $this->load->view('fonts'); ?> 
	<?php $this->load->view('favicon'); ?> 

	<?php foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>

	<?php $this->load->view('css'); ?> 
	<?php $this->load->view('preloader'); ?> 

</head>
<body>
	<?php $this->load->view('body_inner'); ?> 
