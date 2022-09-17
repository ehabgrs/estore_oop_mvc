    <div class="container">


            <h4><?= @$text_header?></h4>

            <table class="table border-1">

                <thead>
                <tr>
				<th><?= @$text_users_privilege_title?></th>
                <th><?= @$text_users_privilege_url?></th>
				

                </tr>
                </thead>

                <tbody>

                <?php

                if(isset($users_privileges) && false !== $users_privileges) {
               
                ?>
                <tr>
                <td><?= $users_privileges->privilege_title?></td>
				<td><?= $users_privileges->privilege_url?></td>
                

                </tr>
                <?php
                } else {
                 ?>
                    <td colspan="5"> <?= @$text_no_data_message?></td>

                    <?php
                }
           
                ?>

                </tbody>

            </table>
			<form method="post" enctype="application/x-www-form-urlencoded" >
			  <button type="submit" name="submit" class="btn btn-primary">Delete</button>
			</form>

    </div>