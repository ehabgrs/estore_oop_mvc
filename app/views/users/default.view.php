  <div class="container">

              
		        <h4><?= @$text_start_line?></h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th><?= @$text_username?></th>
                    <th><?= @$text_email?></th>
                    <th><?= @$text_phone_number?></th>
                    <th><?= @$text_subscription_date?></th>
                    <th><?= @$text_last_login?></th>
					<th><?= @$text_group_id?></th>
                    <th><?= @$text_control?></th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $users) {
                        foreach($users as $user) { 
                    ?>
                    <tr>
                    <td><?= $user->username?></td>
                    <td><?= $user->email?></td>
                    <td><?= $user->phone_number?></td>
                    <td><?= $user->subscription_date?></td>
                    <td><?= $user->last_login?></td>
					<td><?= $user->group_name?></td>
                        <td>
                            <a href="/users/edit/<?=$user->id?>">Edit</a>
                            <a href="/users/delete/<?=$user->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>
                            
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
				<a href="/users/create"> <?= @$text_new_item ?></a>
              
		  </div>