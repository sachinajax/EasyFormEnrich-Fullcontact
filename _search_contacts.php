<form method="POST">
            <div class="form-group">
                <input type="text" placeholder="Search.." name="searchname" >
                <button type="submit" name="search" >Search</button>
            </div>
</form>

<?php

function search(){
if(ISSET($_POST['search'])){
    $search_name = $_POST['searchname'];
    global $wpdb;
    $r = $wpdb->get_results("SELECT fname, lname, email FROM wp_easyform_contacts WHERE fname LIKE '%{$search_name}%' ");
    if(!empty($r)){


  echo '<table id="customers">
  
      <tr>
        <th>Name</th>
        <th>email</th>
        <th>action</th>
    
      </tr>';
      foreach( $r as $search_data) {
        echo "<tr>
        <td> $search_data->fname </td>
        <td>   $search_data->lname </td>
        <td>   $search_data->email </td>
           </tr>";
      }

    echo '</table>';

    }
    else{
        echo '<div style="text-align:center; padding:50px; padding-left:0px;"> No records Found</div>';
    }
  }
  
}

?>