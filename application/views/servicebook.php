<?php 
	include("connection.php");
 ?>
<?php
    session_start();

    if(!isset($_SESSION['username'])){
        echo "you are logged out";
        header('location:http://localhost/MVCFramework/accountController/login');

    }
?>
<?php

$con=mysqli_connect("localhost","root","","company");

if(isset($_POST['submit'])){
  
  $event_dt=$_POST['dateofservice'];
  $datas=$_POST['data'];
  $user_id=$_SESSION['user_id'];
  $allData=implode(" ",$datas);
  $comment=$_POST['comment'];
  $servicehours=$_POST['servicehours'];
  $pets=$_POST['pets'];
  if($pets='on'){
    $pet='1';
  }
  else{
    $pet='0';
  }
  $sql="insert into servicerequest (UserId,ServiceStartDate,ServiceHours,Comments,Extra,HasPets) values('$user_id','$event_dt','$servicehours','$comment','$allData','$pet')";
  $result=mysqli_query($con,$sql);
  if($result){
      echo "inserted";
      echo $pet;
  }

}
elseif(isset($_POST['submit1'])){
  $street = $_POST['street'];
  $house = $_POST['house'];
  $postal=$_POST['postal'];
  $mobile = $_POST['Mobile'];
  $city = $_POST['city'];
  $user_id=$_SESSION['user_id'];

  $emailquery = "select * from useraddress";
  $query=mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

  
      $insertquery="INSERT INTO useraddress(UserId, AddressLine1, City, PostalCode,Mobile) VALUES ('$user_id','$street','$city','$postal', '$mobile')";
      $iquery=mysqli_query($con,$insertquery);
      
  
}
elseif(isset($_POST['third'])){

 $radio=$_POST['radioo'];
 $insert="INSERT INTO useraddress(Email) VALUES ('$radio')";
  $iquery1=mysqli_query($con,$insert);
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <?php linkCSS("assets/css/book.css"); ?>
    <link rel="stylesheet" type="text/css" href="dcodes/payment_icons/dc_payment_icons.css" />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="http://cdn.dcodes.net/2/payment_icons/dc_payment_icons.css" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <title>Contact Us</title>
</head>
<body>
		
<?php include "components/header.php"; ?>




     	<img src="<?=ROOT?>/assets/Images/booknow/book-service-banner.jpg" class="img-fluid" alt="Responsive image">

       
    

       
 	 <section class="prices-section">
        <div class="container">
        <div class="d-flex justify-content-center" style="margin-top: 20px;">
    <h1>Hello <?php echo $_SESSION['username']; ?></h1>
    
</div>
            <h2 class="text-center" >Set up your cleaning service</h2>
        </div>
        <div class="imgcont">
            <div class="line">
                <figure><img src="<?=ROOT?>/assets/Images/booknow/star.png" alt=""></figure>
            </div>
        </div>
</section>
    <div class="row justify-content-center" >
      <div class="container-fluid w-50" style="margin-right: 0px;" id="house">
      <div class="tab-regular">
            <ul class="nav nav-tabs " id="myTab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Setup Service</a> </li>
                <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Shedule & Plan</a> </li>
                <li class="nav-item"> <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Your Details</a> </li>
                <li class="nav-item"> <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment" aria-selected="false">Make Payment</a> </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="container-fluid"  style="margin-top: 10px;" id="div1">
            <div class="row">
        <div class="col-md-auto">
           <p class="h5">Enter your postal code</p>
           <div class="row">
             <div class="col-md-auto">
                  <div class="form-group">
                      <input type="number" class="form-control" id="formGroupExampleInput2" placeholder="Another input">
                   </div>
            </div>
             <div class="col-md-auto">
              <button type="button" class="btn" style="background-color:#1D7A8C;border-radius: 20px;border: 1px solid rgba(255, 255, 255, 0.5);height: 40px;width: auto; color: aliceblue;">Check Availability</button>
             </div>
           </div>
        </div>
      </div>
        </div>
                    </div>



                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  
        <div class="container-fluid" style="margin-top: 10px;">
        <form method="POST" action="">
       
        
      <div class="row">
        <div class="col-md-auto">
           <p class="h5">When do you need the cleaner?</p>
           <div class="row">
             <div class="col-md-auto">
                <div class="form-group" style="width: 140px;">
                <input type="datetime-local" name="dateofservice" id="dateofservice" style="height:38px;">
                </div>
            </div>
           </div>
        </div>
        <div class="col-md-auto">
           <p class="h5">How long do you need your cleaner to stay?</p>
           <div class="form-group" style="width: 140px;">
           <select class="form-control" id="hours" name="hours"style="padding-left: 2px;">
           <option id="0" value="Option 1">Select Hrs</option>
           <option id="3" value="Option 2">3.0 Hrs</option>
                <option id="4" value="Option 3">4.0 Hrs</option>
                <option id="5" value="Option 4">5.0 Hrs</option>
                </select>
                </div>
        </div>
      </div>
       <p><hr/></p>
       <p class="h5">Extra Services</p>
       <ul style="margin-right: -10px;">
  <li class="text-center" ><input type="checkbox" id="cb1" name="data[]" value="Inside cabinets" >
  
    <label for="cb1"  ><img src="<?=ROOT?>/assets/Images/booknow/cabbinet.png" style="height: 50px;max-width: 40px;" /></label>
       <p>Inside cabinets</p>
  </li>
  <li class="text-center"><input type="checkbox" id="cb2" name="data[]"value="Inside fridge" >
    <label for="cb2" style="padding: 30px;"> <img src="<?=ROOT?>/assets/Images/booknow/fridge.png"  style="height: 50px;width: 30px;" /> </label>
    <p>Inside fridge</p>
  </li>
  <li class="text-center"><input type="checkbox" id="cb3"name="data[]"value="Inside oven" >
    <label for="cb3"><img src="<?=ROOT?>/assets/Images/booknow/oven.png" style="height: 50px;max-width: 40px;" /></label>
        <p>Inside oven </p>
  </li>
 <li class="text-center"><input type="checkbox" id="cb4"name="data[]"value="Laundry wash & dry" >
    <label for="cb4"><img src="<?=ROOT?>/assets/Images/booknow/washing_machine.png" style="height: 50px;max-width: 40px;" /></label>
    <p>Laundry wash & dry</p>
  </li>
   <li class="text-center"><input type="checkbox" id="cb5"name="data[]" value="Interiror windows">
    <label for="cb5"><img src="<?=ROOT?>/assets/Images/booknow/window.png" style="height: 50px;max-width: 40px;" /></label>
        <p>Interiror windows</p>
  </li>
</ul>
         <p><hr/></p>
           <div class="form-group">
             <p class="h5">Comment</p>
                <textarea class="form-control"name="comment" id="exampleFormControlTextarea1" rows="3"></textarea>
           </div>
             <div class="form-group form-check">
               <input type="checkbox" name="pets" class="form-check-input" id="exampleCheck1">
               <p class="h6">I have pets at home.</p>
            </div>
            <p><hr/></p>
            <div class="d-flex justify-content-end">
            
            <button class="btn" name="submit" type="submit"  style="background-color:#1D7A8C;border-radius: 20px;border: 1px solid rgba(255, 255, 255, 0.5);height: 40px;width: 100px; color: aliceblue;">Continue</button>
            </div>
            </form>
     </div>
                   </div>


                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="container-fluid" style="margin-top: 10px;max-width: 900px;">
        <p class="h5">Enter your contact details,so we can surve you in better way!</p>
        <form method="POST">
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
            <input class="form-check-input" type="radio" name="radioo"value="<?php echo $address1; ?>" name="flexRadioDefault" id="flexRadioDefault2">
                  <p>  Address: <?php echo $address1; ?></p>
                    <p>Phonenumber: <?php echo $phonenumber; ?></p>
              
             </div>
      </div>
    </div>
<?php 	} 
?>
          <div class="row d-flex justify-content-start">
           <button  type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="background-color:white;border-radius: 20px;border: 2px solid #1D7A8C;;height: 40px;width: 300px; color: ;margin-top: 1rem;color: #1D7A8C;font-weight: bold;">
                  + Add new address
            </button>
          </div>

            <div class="collapse" id="collapseExample" style="margin-top: 1rem;background-color:#F3F3F3;max-width: 900px;">
        
      <div class="row d-flex justify-content-center" >
        <div class="col-md-auto" style="margin-top: 1rem;">
           <p class="h5">Street name</p>
           <div class="row">
             <div class="col-md-auto">
                <div class="form-group" >
                <input type="text" name="street" class="form-control" placeholder="Street name">
                </div>
            </div>
           </div>
        </div>
        <div class="col-md-auto" style="margin-top: 1rem;">
           <p class="h5">House number</p>
           <div class="form-group" >
                <input type="text" name="house"class="form-control" placeholder="House number">
                </div>
        </div>
      </div>
       <div class="row d-flex justify-content-center">
        <div class="col-md-auto">
           <p class="h5">Postal Code</p>
           <div class="row">
             <div class="col-md-auto">
                <div class="form-group" >
                <input type="number" name="postal" class="form-control" placeholder="Postal code">
                </div>
            </div>
           </div>
        </div>
        <div class="col-md-auto">
           <p class="h5">City</p>
           <div class="form-group" >
                <input type="text" name="city" class="form-control" placeholder="City">
                </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-auto">
           <p class="h5">Phone number</p>
           <div class="row">
             <div class="col-md-auto">
                <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend ab">
            <div class="input-group-text">+91</div>
          </div>
           <input type="text" class="form-control ab" name="Mobile" id="inlineFormInputGroupUsername2" placeholder="Phone number">
        </div>
            </div>
           </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center" style="margin-top: 0.5rem;">
        <div class="col-md-auto" >
           <button name="submit1" type="submit" class="btn" style="background-color:#1D7A8C;border-radius: 20px;border: 1px solid rgba(255, 255, 255, 0.5);height: 40px;width: 100px; color: aliceblue;">Save</button>
        </div>
        <div class="col-md-auto" style="margin-bottom: 1rem;">
           <button type="button" class="btn1" style="background-color:transparent;border-radius: 40px;border: 1px solid gray;;height: 40px;width: 100px;" data-target="#collapseExample" data-toggle="collapse">Cancel</button>
        </div>
      </div>

           </div>
    
    

           <p class="h5" style="margin-top: 0.7rem;margin-bottom: 0px;">Your Favourite Service Providers<hr/></p>
            
                <p class="h6">You can choose your favorite service provider from the below list</p>

                 <div class="row d-flex" style="margin-top: 1rem;">
                   <div class="col-md-2  justify-content-center">
                     <div class="row d-flex justify-content-center">
                     <img class="hat" src="<?=ROOT?>/assets/Images/booknow/hat.png" alt="">
                   </div>
                   <div class="row d-flex justify-content-center" style="margin-top: 0.7rem;">
                     <p class="h6">Sandip Patel</p>
                   </div>
                   <div class="row d-flex justify-content-center">
                     <button type="button" class="btn btn-light">Select</button>
                   </div>
                 </div>
                   <div class="col-md-2  justify-content-center">
                     <div class="row d-flex justify-content-center">
                     <img class="hat" src="<?=ROOT?>/assets/Images/booknow/hat.png" alt="">
                   </div>
                   <div class="row d-flex justify-content-center" style="margin-top: 0.7rem;">
                     <p class="h6">Mahesh Patel</p>
                   </div>
                   <div class="row d-flex justify-content-center">
                     <button type="button" class="btn btn-light">Select</button>
                   </div>
                 </div>
                   <div class="col-md-2  justify-content-center">
                     <div class="row d-flex justify-content-center">
                     <img class="hat" src="<?=ROOT?>/assets/Images/booknow/hat.png" alt="">
                   </div>
                   <div class="row d-flex justify-content-center" style="margin-top: 0.7rem;">
                     <p class="h6">ABC</p>
                   </div>
                   <div class="row d-flex justify-content-center">
                     <button type="button" class="btn btn-light">Select</button>
                   </div>
                 </div>
                   <div class="col-md-2  justify-content-center">
                     <div class="row d-flex justify-content-center">
                     <img class="hat" src="<?=ROOT?>/assets/Images/booknow/hat.png" alt="">
                   </div>
                   <div class="row d-flex justify-content-center" style="margin-top: 0.7rem;">
                     <p class="h6">XYZ</p>
                   </div>
                   <div class="row d-flex justify-content-center">
                     <button type="button" class="btn btn-light">Select</button>
                   </div>
                 </div>
                 </div>
                    <p><hr/></p>
                    <div class="d-flex justify-content-end">
            <button class="btn" name="third" type="submit" style="background-color:#1D7A8C;border-radius: 20px;border: 1px solid rgba(255, 255, 255, 0.5);height: 40px;width: 100px; color: aliceblue;">Continue</button>
            </div>
     </form>
           
     
     </div>
    
 
                   </div>
                    
     <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab">
     <p class="h5" style="margin-top: 0.7rem;margin-bottom: 0px;">Pay Securely with Helperland Payment gateway.</p>
            <p class="h6" style="margin-top:1rem;">Promo Code(optional)</p>

            <div class="row">
                <div class="col-md-5"> <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Promo Code(optional)"></div>
                <div class="col-md-5"> <button class="btn btn-success" type="submit" style="background-color:white;border-radius: 20px;border: 1px solid #1D7A8C;height: 40px;width: 100px; color:#1D7A8C;">Apply</button></div>
            </div>
     <p><hr/></p>

     <p class="dis fw-bold mb-2">Card details</p>
     <div class="row d-flex justify-content-start">
       <div class="col-md-10" >
                    <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                        <div class="fa fa-credit-card-alt"></div> <input type="text" class="form-control" placeholder="Card Details">
                        <div class="d-flex w-50"> <input type="text" class="form-control px-0" placeholder="MM/YY"> <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV"> </div>
                    </div>
                    </div>
  </div> 
  <p><hr/></p>
  
  <div class="row d-flex justify-content-end"><p class="h9">Accepted cards</p>
  </div>
  <div class="row d-flex justify-content-end">
    
  <span class="dc_payment_icons_glossy_50 dc_visa_glossy" title="Visa"></span>
<span class="dc_payment_icons_glossy_50 dc_mastercard_glossy" title="Mastercard"></span>
<span class="dc_payment_icons_glossy_50 dc_americanexpress_glossy" title="American Express"></span>
<span class="dc_payment_icons_glossy_50 dc_discover_glossy" title="Discover"></span>
<span class="dc_payment_icons_glossy_50 dc_paypal_glossy" title="PayPal"></span>
<span class="dc_payment_icons_glossy_50 dc_maestro_glossy" title="Maestro"></span>
<span class="dc_payment_icons_glossy_50 dc_cirrus_glossy" title="Cirrus"></span>
<span class="dc_payment_icons_glossy_50 dc_visaelectron_glossy" title="Visa Electron"></span>
  </div>
  <p><hr/></p>
  <div class="form-group form-check">
               <input type="checkbox" name="pets" class="form-check-input" id="exampleCheck1">
               <p class="h6">I have accepted the terms and conditions the cancellation policy and the privacy police. i confirm that Helperland starts to execture the contract before the expiry of the withdrawl period and I lose my right of withdrawal as a consumer with full performance of the contract.</p>
            </div>

            <p><hr/></p>

            <div class="d-flex justify-content-end">
            <button class="btn" type="submit" style="background-color:#1D7A8C;border-radius: 20px;border: 1px solid rgba(255, 255, 255, 0.5);height: 40px; color: aliceblue;">Complete Booking</button>
            </div>


                  </div>
            </div>
        </div>
</div>

      <div class="container-fluid w-25" style="margin-left: 0px;" id="total">
        
      <div class="card mb-3 " style="max-width: 34.56rem;" id="div1">
  <div class="card-header text-white text-left" style=" background-color: #1d7a8c;">Payment Summary</div>
  <div class="card-body text-black ">
    <h5 class="card-title"><div class="col mx-auto text-left">
            <p class="word" id="Time"></p>
            <p class="word"></p>
            <p class="h6">Duration</p>
            <div class="row">
              <div class="col d-flex justify-content-start">
                <p class="word">Basic</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="word" id="totally">0 Hrs</p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-auto d-flex justify-content-start">
              <p id="txtAge" style="display:none">Inside Cabinets</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="word" id="extra" value="1">30 Mins</p>
              </div>
            </div>
            <p style="margin-top: -20px;"><hr/></p>
             <div class="row">
              <div class="col-md-auto d-flex justify-content-start">
                <p class="finalword">Total Service Time</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="finalword" id="t">0 Hrs</p>
              </div>

            </div>
             <p style="margin-top: -20px;"><hr/></p>
            
             <div class="row">
              <div class="col-md-auto d-flex justify-content-start">
                <p class="word">Per Cleaning</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="word" id="amount">$0</p>
              </div>
            </div>
             <div class="row">
              <div class="col d-flex justify-content-start">
                <p class="word">Discount</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="word" id="discount">-$0</p>
              </div>
              </div>
             <p style="margin-top: -20px;"><hr/></p>

               <div class="row">
              <div class="col-md-auto d-flex justify-content-start">
                <p class="payments">Total Payment</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="dolr" id="demo">0</p>
              </div>
              </div>

              <div class="row">
              <div class="col d-flex justify-content-start">
                <p class="word">Effective Price</p>
              </div>
              <div class="col d-flex justify-content-end">
                <p class="finalprice" id="e">$0</p>
              </div>
              </div>

              <p class="word">*You will save 20% according to §35a EStG.</p>


          </div>

          </div>
            <div class="card-footer text-left" style=" background-color: #F3F3F3;padding-bottom: 0px;color:#8D8D8D; ">
           <p>See what is always included</p>
          </div>
  </div>



          <div class="container-fluid">
            <h2 class="text-center">Questions?</h2>
             <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

               <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

                 <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

               <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

                 <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

               <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

                 <button class="accordion">Which Helperland professional will come to my place?</button>
                <div class="panel">
                    <p>Lorem ipsum dolor sit amet, </p>
                 </div>

                 <div class="d-flex justify-content-start">
                  <p style="color: #1D7A8C;font-weight: bold;opacity: 1;margin-top: 10px;">For more help</p>
            </div>
          </div>
</div> 
      </div>
	   </div>
       <?php include "components/footer.php"?>

  <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
<script type="text/javascript">
  function Show1(){
    document.getElementById('div1').style.display="block";

    document.getElementById('div2').style.display="none";

        document.getElementById('div3').style.display="none";


  }
   function Show2(){
    document.getElementById('div2').style.display="block";

    document.getElementById('div1').style.display="none";

        document.getElementById('div3').style.display="none";


  }
   function Show3(){
    document.getElementById('div3').style.display="block";

    document.getElementById('div2').style.display="none";

    document.getElementById('div1').style.display="none";



  }
function loadXMLDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("link_wrapper").innerHTML =
      this.responseText;
    }
  };
  xhttp.open("GET", "<?php echo BASEURL; ?>/accountController/Server_address", true);
  xhttp.send();
}


window.onload = loadXMLDoc;



</script>
<script>
  $('#hours').on('change', function() {
     
     var price = $(this).children(":selected").attr("id");
     var iNum = parseInt(price);
     var z= iNum*30;
     var discount=z/4;
     var total=z-discount;
   $('#totally').text(price  + ' Hrs');
   $('#t').text(price+ " Hrs");
   $('#amount').text("$ " + z);
   $('#discount').text("-$ " +discount);
   $('#demo').text("$ " + total);

});
$('#dateofservice').on('change', function() {
    var b = $(this).val();
    $('#Time').text(b+" ");
  });


  $('#cb1').click(function() {
    $("#").toggle(this.checked);
});
  </script>