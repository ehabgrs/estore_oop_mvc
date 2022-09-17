
        <div class="container">
		
		<h4>Edit your employees data</h4>
		
		  <form method="post" enctype = "application/x-www-form-urlencoded">
		  
				  <p><?= isset($message) ? $message : '' ?></p>
				  
				  <div class="mb-3">
					<label for="name" class="form-label">Name</label>
					<input type="text" class="form-control" id="name" name="name" value="<?= isset($employee) ? $employee->name : '' ?>" maxlength='50'>
				  </div>
				
				  <div class="mb-3">
					<label for="age" class="form-label">Age</label>
					<input type="number" min = "20" max= "60" class="form-control" id="age" name="age" value="<?= isset($employee) ? $employee->age : '' ?>" >
				  </div>
				  
				  <div class="mb-3">
					<label for="Address" class="form-label">Address</label>
					<input type="text" class="form-control" id="address" name="address" maxlength='100' value="<?= isset($employee) ? $employee->address : '' ?>">
				  </div>
				  
				  <div class="mb-3">
					<label for="salary" class="form-label">Salary</label>
					<input type="number" step="0.01" min="1500" max="9000" class="form-control" id="salary" name="salary" value="<?= isset($employee) ? $employee->salary : '' ?>" >
				  </div>
				  
				  <div class="mb-3">
					<label for="tax" class="form-label">Tax</label>
					<input type="number" step="0.01" min="1" max="15" class="form-control" id="tax" name="tax" value="<?= isset($employee) ? $employee->tax : '' ?>">
				  </div>
				  
				   <button type="submit" name = "submit" class="btn btn-primary">Submit</button>
		
		    </form>
			
		</div>
		
	