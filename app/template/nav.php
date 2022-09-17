<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/"><?=@$text_website_name?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
	  
          <?php //urlmatch() in templatehelper trait ?>
        <a class="nav-link <?= $this->urlMatch('/statistics') === true ? 'active' : '' ?>" href="/statistics"><?=@$text_statistics?></a>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/store" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?=@$text_store?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="/products"><?=@$text_store_products?></a></li>
			<li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="/productscategories"><?=@$text_store_categories?></a></li>
          </ul>
        </li>
          
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?=@$text_accounts_users?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
             <li><a class="dropdown-item" href="/users"><?=@$text_accounts_users_list?></a></li> 
            <li><a class="dropdown-item" href="/usersgroups"><?=@$text_accounts_users_groups?></a></li>
            <li><a class="dropdown-item" href="/usersprivileges"><?=@$text_accounts_users_privilege?></a></li>
          </ul>
        </li>
          
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?=@$text_accounts?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item <?= @$this->hasAcccessToLink('/clients/default')?>" href="/clients" ><?=@$text_accounts_clients?></a></li>
            <li><a class="dropdown-item <?= @$this->hasAcccessToLink('/suppliers/default')?>" href="/suppliers"><?=@$text_accounts_suppliers?></a></li>
          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="/transaction" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?=@$text_transaction?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#"> <?=@$text_transaction_purchases?></a></li>
            <li><a class="dropdown-item" href="#"> <?=@$text_transaction_sales?></a></li>
          </ul>
        </li>
		
		<li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= @$this->hasAcccessToLink('/expenses/default')?>" href="/expenses" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           <?=@$text_expenses?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#"> <?=@$text_expenses_list?></a></li>
            <li><a class="dropdown-item" href="#"> <?=@$text_expenses_daily?></a></li>
          </ul>
        </li>
		
        <a class="nav-link <?= @$this->hasAcccessToLink('/reports/default')?> <?= $this->urlMatch('/reports') === true ? 'active' : '' ?>" href="/reports"><?=@$text_reports?> </a>
        
		<a class="nav-link" href="/language"><?=@$text_lang?></a>
		<a class="nav-link" href="/authentication/logout"><?=@$text_logout . ' ' . $this->session->u->username . ' ' . $this->session->u->group_name?> </a>
		
		
	
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

