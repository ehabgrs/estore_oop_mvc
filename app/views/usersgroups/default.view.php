    <div class="container">
            <h4><?= @$text_header?></h4>

            <table class="table border-1">

                <thead>
                <tr>
                <th><?= @$text_table_group?></th>
                <th><?= @$text_table_group_privileges?> </th>
                <th><?= @$text_table_control?></th>

                </tr>
                </thead>

                <tbody>

                <?php
        
                if(isset($users_groups) && false !== $users_groups) {
                    foreach($users_groups as $user_group) { 
                ?>
                <tr>
                <td><?= $user_group->group_name?></td>
                    
                <?php // I created this function getGroupPrivileges() inside UsersGroupsPrivilegesModel class and i sent the class itself in the defaultaction into _data[$groups_privileges_model] array  ?>
                    
                <td><?= $groups_privileges_model::getGroupPrivileges($user_group->id)?></td>
                    
                    <br>
                    <td>
                        <a href="/usersgroups/edit/<?=$user_group->id?>">Edit</a>
                        <a href="/usersgroups/delete/<?=$user_group->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>

                    </td>

                </tr>
                <?php
                    }
                } else {
                    ?>
                    <td colspan="5"> <?= @$text_no_usersgroups_message?></td>

                    <?php
                }
           
                ?>

                </tbody>

            </table>
            <a href="/usersgroups/create"> <?= @$text_new_item ?></a>

    </div>