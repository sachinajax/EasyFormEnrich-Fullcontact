

<?php

function easy_contact_list() {
  


	global $wpdb;
	$results = $wpdb->get_results("select * from wp_easyform_contacts");
  echo '<table id="customers">
  
  <tr>
    <th>Name</th>
    <th>email</th>
    <th>Gender</th>
    <th>Location</th>
    <th>Twitter</th>
    <th>action</th>

  </tr>';

  if(empty($results)){
    echo "<tr>
    <td colspan='3'> No Records Found</td>
    </tr>";
  }else{
    
	foreach( $results as $user_data) {
		echo "<tr>
    <td>$user_data->fname</td>
    <td>$user_data->email</td>
    <td>$user_data->gender</td>
    <td>$user_data->loc</td>
    <td>$user_data->twitter</td>
    <td><form method='post'><input hidden type='text' value='$user_data->id' name='id' ><button class='delete-btn' type='submit' name='delete'>Delete</button></form></td>
  </tr>";
	}
  }
  if(isset($_POST['delete'])){
     $id =$_POST['id'];
     
     
     $wpdb->query(
      'DELETE  FROM '.$wpdb->prefix.'easyform_contacts
       WHERE id = "'.$id.'"'   
    );
    $deleted= "Deleted Successfully !!";
    

  }
	echo '</table>';
	
}



?>