<?php 
include("connection.php");
 ?>

 
<?php

$user_id=$_SESSION['user_id']; 
	$query = mysqli_query($db, "SELECT * FROM useraddress where UserId='$user_id'");

  

	while($row = mysqli_fetch_array($query)){

		$address1 = $row['AddressLine1'];
		$phonenumber = $row['Mobile'];
 ?>
	
			

	<div class="row">
              <div class="col-md-7" style="border: 1px solid gray;height: auto;margin-top: 1rem;"  >
          <div class="form-check" >
            <input class="form-check-input" type="radio" value="<?php echo $address1; ?>" name="flexRadioDefault" id="flexRadioDefault2">
                  <p>  Address: <?php echo $address1; ?></p>
                    <p>Phonenumber: <?php echo $phonenumber; ?></p>
              
             </div>
      </div>
    </div>
<?php 	} 
?>
	