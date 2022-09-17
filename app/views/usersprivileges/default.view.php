    <div class="container">


            <h4><?= @$text_header?></h4>

            <table class="table border-1">

                <thead>
                <tr>
				<th><?= @$text_table_privileges_title?></th>
                <th><?= @$text_table_privileges_url?></th>
                <th><?= @$text_table_control?></th>
				

                </tr>
                </thead>

                <tbody>

                <?php

                if(isset($users_privileges) && false !== $users_privileges) {
                    foreach($users_privileges as $user_privilege) { 
                ?>
                <tr>
                <td><?= $user_privilege->privilege_title?></td>
				<td><?= $user_privilege->privilege_url?></td>
                    <td>
                        <a href="/usersprivileges/edit/<?=$user_privilege->id?>">Edit</a>
                        <a href="/usersprivileges/delete/<?=$user_privilege->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>

                    </td>

                </tr>
                <?php
                    }
                } else {
                    ?>
                    <td colspan="5"> <?= @$text_no_data_message?></td>

                    <?php
                }
           
                ?>

                </tbody>

            </table>
            <a href="/usersprivileges/create"> <?= @$text_new_item ?></a>

    </div>