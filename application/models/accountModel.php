<?php

class accountModel extends database {


    public function userSignup($username,$lastname,$email,$password,$phonenumber,$cpassword ){

        $server="localhost";
        $user="root";
        $password="";
        $db="company";

      $con =mysqli_connect($server,$user,$password,$db);

      if(isset($_POST['submit'])){
      $username = mysqli_real_escape_string($con,$_POST['firstname']);
      $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
      $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

      $token=bin2hex(random_bytes(15));



    $pass=password_hash($password,PASSWORD_BCRYPT);
    $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

    $emailquery = "select * from registration where email='$email'";
    $query=mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount >0){
        echo "email already registered";
    }
    else{
        if($password==$cpassword){
                    $insertquery="INSERT INTO registration(username, lastname, email, mobile, password, cpassword,token,status,UserTypeId) VALUES ('$username','$lastname','$email','$phonenumber', '$pass', '$cpass','$token','inactive','user') ";
        
                    $iquery=mysqli_query($con,$insertquery);

                    if($iquery){
                       $last_id=mysqli_insert_id($con);
                       if($last_id){
                           $code=rand(1,99999);
                           $user_id="EEM_".$code."_".$last_id;
                            $query2="UPDATE registration SET user_id='".$user_id."' WHERE id='".$last_id."'";
                            $res=mysqli_query($con,$query2);
                       }
                       $subject="sample mail";
                        $body="hey my name is dhruv http://localhost/MVCFramework/accountController/activate?token=$token";
                        $sender_email="From: jadav.dhruv.74@gmail.com";
                        if(mail($email,$subject,$body,$sender_email)){
                            $_SESSION['msg'] ="check you mail to activate your account $email";
                            header('location:http://localhost/MVCFramework/accountController/login');
                        }
                        else{
                            echo "email sending failed";
                        }
                    }
                    else{
                        ?>
                        <script>
                    
                    alert("no success");
                            </script>
                    
                            <?php
                    }
        
                }
        else{
            echo "password not matching";
        }
    }



    }
    }

    public function serviceSignUp($username,$lastname,$email,$password,$phonenumber,$cpassword ){

        $server="localhost";
        $user="root";
        $password="";
        $db="company";

      $con =mysqli_connect($server,$user,$password,$db);

      if(isset($_POST['submit'])){
      $username = mysqli_real_escape_string($con,$_POST['firstname']);
      $lastname = mysqli_real_escape_string($con,$_POST['lastname']);
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $phonenumber = mysqli_real_escape_string($con,$_POST['phonenumber']);
      $password = mysqli_real_escape_string($con,$_POST['password']);
      $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

      $token=bin2hex(random_bytes(15));



    $pass=password_hash($password,PASSWORD_BCRYPT);
    $cpass=password_hash($cpassword,PASSWORD_BCRYPT);

    $emailquery = "select * from registration where email='$email'";
    $query=mysqli_query($con,$emailquery);

    $emailcount = mysqli_num_rows($query);

    if($emailcount >0){
        echo "email already registered";
    }
    else{
        if($password==$cpassword){
                    $insertquery="INSERT INTO registration(username, lastname, email, mobile, password, cpassword,token,status,UserTypeId) VALUES ('$username','$lastname','$email','$phonenumber', '$pass', '$cpass','$token','inactive','service') ";
        
                    $iquery=mysqli_query($con,$insertquery);

                    if($iquery){
                       
                       $subject="sample mail";
                        $body="hey my name is dhruv http://localhost/MVCFramework/accountController/activate?token=$token";
                        $sender_email="From: jadav.dhruv.74@gmail.com";
                        if(mail($email,$subject,$body,$sender_email)){
                            $_SESSION['msg'] ="check you mail to activate your account $email";
                            header('location:http://localhost/MVCFramework/accountController/login');
                        }
                        else{
                            echo "email sending failed";
                        }
                    }
                    else{
                        ?>
                        <script>
                    
                    alert("no success");
                            </script>
                    
                            <?php
                    }
        
                }
        else{
            echo "password not matching";
        }
    }



    }
    }


    public function userlogin($email,$password){
    
        
        $server="localhost";
        $user="root";
        $password="";
        $db="company";

      $con =mysqli_connect($server,$user,$password,$db);       
                            
        if(isset($_POST['submit'])){
            $email = mysqli_real_escape_string($con,$_POST['email']);
            $password = mysqli_real_escape_string($con,$_POST['password']);
        
            $email_search="select * from registration where email='$email' and status='active' and UserTypeId='user'";
            $query=mysqli_query($con,$email_search);
        
            $email_count=mysqli_num_rows($query);

            $email_search1="select * from registration where email='$email' and status='active' and UserTypeId='service'";
            $query1=mysqli_query($con,$email_search1);
            $email_count1=mysqli_num_rows($query1);
        
            if($email_count){
                $email_pass= mysqli_fetch_assoc($query);
                $dbpass=$email_pass['password'];
                $_SESSION['username']=$email_pass['username'];
                $_SESSION['user_id']=$email_pass['user_id'];
            
                $pass_decode=password_verify($password,$dbpass);
        
                if($pass_decode){
                    echo"login successful";
                    ?>
                
        
                    <script>
                        location.replace("<?php echo BASEURL; ?>/accountController/Service_Book");
                    </script>
                    <?php
                }
                else{
                    echo "password incorrect";
                }
        
            }
            elseif($email_count1){
                $email_pass1= mysqli_fetch_assoc($query1);
                $dbpass1=$email_pass1['password'];
                $_SESSION['username']=$email_pass1['username'];
                $pass_decode1=password_verify($password,$dbpass1);
        
                if($pass_decode1){
                    echo"login successful";
                    ?>
                
        
                    <script>
                        location.replace("http://localhost/MVCFramework/accountController/serviceProfile");
                    </script>
                    <?php
                }
                else{
                    echo "password incorrect";
                }
        
            }
            
            else{
                echo "incorrect";
            }
        }
        
    }

    public function Reset($email){
    
    
        $server="localhost";
        $user="root";
        $password="";
        $db="company";

      $con =mysqli_connect($server,$user,$password,$db);    
if(isset($_POST['submit'])){
     $email = mysqli_real_escape_string($con,$_POST['email']);
     
   $emailquery = "select * from registration where email='$email'";
   $query=mysqli_query($con,$emailquery);

   $emailcount = mysqli_num_rows($query);

   if($emailcount){

       $userdata=mysqli_fetch_array($query);
       $username=$userdata['username'];
       $token=$userdata['token'];
                      $subject="Password reset";
                       $body="hi $username click here to reset password http://localhost/MVCFramework/accountController/resetpassword?token=$token";
                       $sender_email="From: jadav.dhruv.74@gmail.com";
                       if(mail($email,$subject,$body,$sender_email)){
                           $_SESSION['msg'] ="check you mail to reset your password $email";
                           header('location:http://localhost/MVCFramework/accountController/login');
                       }
                       else{
                           echo "email sending failed";
                       }
                   }
                   else{
                       echo "no email found";
                   }
    }


    
    }

    public function Repass($password,$cpassword){

        $server="localhost";
        $user="root";
        $password="";
        $db="company";

      $con =mysqli_connect($server,$user,$password,$db); 
        if(isset($_POST['submit'])){
            $newpassword = mysqli_real_escape_string($con,$_POST['password']);
            $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);
         if(isset($_POST['submit'])){
             $token=$_GET['token'];
         
          $pass=password_hash($newpassword,PASSWORD_BCRYPT);
          $cpass=password_hash($cpassword,PASSWORD_BCRYPT);
      
          
      
              if($newpassword==$cpassword){
      
                  $updatequery="update registration set password='$pass' where token='$token'";
          
                          $iquery=mysqli_query($con,$updatequery);
      
                          if($iquery){
                             
                           $_SESSION['msg'] ="Your Password has been updated";
                           header('location:http://localhost/MVCFramework/accountController/login');
                          }
                          else{
                              $_SESSION['passmsg'] ="Your Password has not updated";
                           header('location:http://localhost/MVCFramework/accountController/resetpassword');
                          }
              
                      }
                      else{
                          $_SESSION['passmsg'] ="password are not matching;";
                      }
      
          }else{
              echo "no token found";
          }
      }


    }


}


?>