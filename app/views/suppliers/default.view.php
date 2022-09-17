  <div class="container">

              
		        <h4><?= @$text_start_line?></h4>
              
                <table class="table border-1">

                    <thead>
                    <tr>
                    <th><?= @$text_name?></th>
                    <th><?= @$text_email?></th>
                    <th><?= @$text_phone_number?></th>
                    <th><?= @$text_address?></th>
                    <th><?= @$text_control?></th>

                    </tr>
                    </thead>

                    <tbody>

                    <?php
                    if(false !== $suppliers) {
                        foreach($suppliers as $supplier) { 
                    ?>
                    <tr>
                    <td><?= $supplier->name?></td>
                    <td><?= $supplier->email?></td>
                    <td><?= $supplier->phone_number?></td>
                    <td><?= $supplier->address?></td>
                        <td>
                            <a href="/suppliers/edit/<?=$supplier->id?>">Edit</a>
                            <a href="/suppliers/delete/<?=$supplier->id?>" onclick="if(!confirm('Do you want to delete this employee')) return false;"> Delete  </a>
                            
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
				<a href="/suppliers/create"> <?= @$text_new_item ?></a>
              
		  </div>