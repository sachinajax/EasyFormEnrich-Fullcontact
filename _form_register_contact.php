

<div class="contact-form">

<h2>Contact Form</h2>

        <form method="post">
            <div class="form-group">
                <label>First Name</label>
                <input  type="text" required name="fname" >
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input required type="text" name="lname" >
            </div>
            <div class="form-group">
                <label>Email</label>
                <input required="email" type="text" name="email" >
            </div>
            
            <div class="form-group">     
                <button type="submit" name="save">Register</button>
            </div>
        </form>
</div>

<?php
	function easy_form_register(){
		global $wpdb;
		$table_name = $wpdb->prefix.'easyform_contacts';

		if(isset($_POST['save'])){

			$args =	$_POST['email'];
			
		/*Api Starts */
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.fullcontact.com/v3/person.enrich",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "{\r\n  \"emails\": [\r\n    \"$args\"\r\n  ]\r\n}",
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer P77Kvtivsp1TLVgWbrlbipqerfO822NI",
			"cache-control: no-cache",
			"content-type: application/json",
			"postman-token: 57941d2b-9fda-61b3-56c3-c1529ca80a41"
		  ),
		));
		
		$response = curl_exec($curl);
		$err = curl_error($curl);
		
		curl_close($curl);
		
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		
		   $output =  json_decode($response, true);		
			// print_r($output);
			if(array_key_exists('gender',$output)){
			 $gender = $output['gender'];
			}else{
				$gender = "(empty api data)";
			}
			if(array_key_exists('location',$output)){
				$loc = $output['location'];
			   }else{
				$loc = "(empty api data)";
			}
			if(array_key_exists('twitter',$output)){
				$twitter = $output['twitter'];
			}else{
				$twitter = "(empty api data)";
			}
		
		}
		/*Api Ends */

			$wpdb->insert($table_name,
				array(
					'fname' => $_POST['fname'],
					'lname' => $_POST['lname'],
					'email' => $_POST['email'],
					'gender' => $gender,
					'loc' => $loc,
					'twitter' => $twitter,
					 ),
					array(
					'%s',
					'%s',
					'%s', 
					'%s'
					 )

            );
            
			echo "Succesfully Registered";

			

		}

	}



	/*
	nRWPrGpL1V9Do7AunkLZKpsYsy7LDILf

	*/
?>