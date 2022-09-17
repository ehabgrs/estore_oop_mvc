
<div class="container">
<h2><?= @$text_header?></h2>
<form method="post" enctype="application/x-www-form-urlencoded">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
   <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>  -->
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="epassword" name="password" placeholder="Password">
  </div>
  <!-- <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  
  <button type="submit" name="submit" class="btn btn-primary">Login</button>
</form>
</div>