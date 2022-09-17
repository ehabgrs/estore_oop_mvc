<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><?=@$text_website_name?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
	  
	
      </div>
	   
    </div>
  </div>
</nav>
<br>
<div class="container">
<?php $messages = $this->messenger->getMessages(); if(!empty($messages)) {
    foreach($messages as $message) { ?>
    <div class="alert alert-<?= $message[1]?>" role="alert">
  <?= $message[0] ?>
     </div>
    
<?php    
    }
}
?>
</div>

