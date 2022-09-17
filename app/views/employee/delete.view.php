<?php

//because we used extract($this->_data) so the key of the array can be called directly 
//so instead use $this->_data['employees'] we will use $employees directly 
/*foreach($employees as $employee) {
    var_dump($employee);
}*/

?> 

    
		  
		  <div class="container">
		  
              
		        <h4>Are you sure you want to delete this employee?</h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Salary</th>
                    <th>Tax %</th>
                        

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $employee) {
                       
                    ?>
                    <tr>
                    <td><?= $employee->name?></td>
                    <td><?= $employee->age?></td>
                    <td><?= $employee->address?></td>
                    <td><?= $employee->salary?></td>
                    <td><?= $employee->tax?></td>
                       

                    </tr>
                    <?php
                       
                    } else {
                        ?>
                        <td colspan="5"> Sorry no employees to delete</td>

                        <?php
                    }
                    ?>

                    </tbody>

                </table>
				<form method="post" enctype = "application/x-www-form-urlencoded">
				<button type="submit" name = "submit" class="btn btn-primary">Delete</button>
				</form>
				
              
		  </div>

  