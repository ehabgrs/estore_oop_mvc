<?php

//because we used extract($this->_data) so the key of the array can be called directly 
//so instead use $this->_data['employees'] we will use $employees directly 
/*foreach($employees as $employee) {
    var_dump($employee);
}*/

?> 

    
		  
		  <div class="container">
		  
              
		        <h4><?= @$text_start_line?></h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th><?= @$text_name?></th>
                    <th><?= @$text_age?></th>
                    <th><?= @$text_address?></th>
                    <th><?= @$text_salary?></th>
                    <th><?= @$text_tax?></th>
                        <th><?= @$text_control?></th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $employees) {
                        foreach($employees as $employee) {
                    ?>
                    <tr>
                    <td><?= $employee->name?></td>
                    <td><?= $employee->age?></td>
                    <td><?= $employee->address?></td>
                    <td><?= $employee->salary?></td>
                    <td><?= $employee->tax?></td>
                        <td>
                            <a href="/public/employee/edit/<?=$employee->id?>">Edit</a>
                            <a href="/public/employee/delete/<?=$employee->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>
                            
                        </td>

                    </tr>
                    <?php
                        }
                    } else {
                        ?>
                        <td colspan="5"> <?= @$text_no_employee_message?></td>

                        <?php
                    }
                    ?>

                    </tbody>

                </table>
              
		  </div>

    
  