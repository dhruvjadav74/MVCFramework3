<?php

class accountController extends framework {


    public function __construct(){

        $this->helper("link");
        
    }

    public function index(){

        $this->view("homepage");
    }

    public function register(){

        $this->view("regis");
    }
    public function login(){

        $this->view("login");
    }
    
    public function profile(){

        $this->view("profile");
    }

    public function serviceProfile(){

        $this->view("serviceprofile");
    }

    public function logout(){

        $this->view("logout");
    }
    public function activate(){

        $this->view("activate");
    }

    public function resetpassword(){

        $this->view("reset_password");
    }
    public function recovermail(){

        $this->view("recover_email");
    }

    public function  pricesPage(){
        $this->view("prices");
    }

    public function contactUs(){
        $this->view('contact');
    }
    public function aboutPage(){
        $this->view('about');
    }
    public function faqPage(){
        $this->view('faq');
    }

    public function serviceSignUp(){
        $this->view('servicesignup');
    }

    public function Service_Book(){
        $this->view('servicebook');
    }

    public function Server_address(){
        $this->view('server');
    }

  
    
    
   

    public function signup(){
        $accountModel= $this->model('accountModel');
        $username= $this->input('firstname');
         $lastname= $this->input('lastname');
         $email= $this->input('email');
         $password= $this->input('password');
         $cpassword = $this->input('cpassword');
         $phonenumber= $this->input('phonenumber');
                    if($accountModel->userSignup($username,$lastname,$email,$password,$phonenumber,$cpassword)){
                        echo "success";
                  } 
                  else{
                      "no success";
                  }
    
            } 
            public function serSignup(){
                $accountModel= $this->model('accountModel');
                $username= $this->input('firstname');
                 $lastname= $this->input('lastname');
                 $email= $this->input('email');
                 $password= $this->input('password');
                 $cpassword = $this->input('cpassword');
                 $phonenumber= $this->input('phonenumber');
                            if($accountModel->serviceSignUp($username,$lastname,$email,$password,$phonenumber,$cpassword)){
                                echo "success";
                          } 
                          else{
                              "no success";
                          }
            
                    } 
            public function userLogin(){
                $accountModel= $this->model('accountModel');
                 $email= $this->input('email');
                 $password= $this->input('password');
                            if($accountModel->userlogin($email,$password)){
                                echo "success";
                          } 
                          else{
                              "no success";
                          }
            
                    } 

                    public function repassword(){
                        $accountModel= $this->model('accountModel');
                         $email= $this->input('email');
                                    if($accountModel->Reset($email)){
                                        echo "success";
                                  } 
                                  else{
                                      "no success";
                                  }
                    
                            }
                            
                            public function rePass(){
                                $accountModel= $this->model('accountModel');
                                
                               $password= $this->input('password');
                                $cpassword = $this->input('cpassword');
                                           if($accountModel->Repass( $password, $cpassword)){
                                               echo "success";
                                         } 
                                         else{
                                             "no success";
                                         }
                            
                            }

                            public function hey(){
                                $userModel= $this->model('userModel');
                                 $file= $this->input('file');
                                 $name= $this->input('name');
                                 $email= $this->input('email');
                                 $message= $this->input('message');
                                 $phonenumber= $this->input('phonenumber');
                                            if($userModel->up($file,$name,$email,$phonenumber,$message)){
                                              echo "success";
                                          } 
                                
                                    } 

                                    public function PostalCode(){
                                        $accountModel= $this->model('accountModel');
                                        $postalcode= $this->input('postalcode');
                                    
                                        if($accountModel->pincode($postalcode)){
                                            echo "success";
                                        }
                                    }

                                    public function Scplan(){
                                        $accountModel= $this->model('accountModel');
                                       $dateofservice  =$_POST['dateofservice'];
                                       $servicehours= $_POST['servicehours'];
                                      $comment= $_POST['comment'];
                                       $pets=$_POST['pets'];
                                     if($accountModel->plans($dateofservice,$servicehours,$comment,$pets)){
                                        
                                    }
                                    }

                                    public function add(){
                                        $accountModel= $this->model('accountModel');
                                        $street = $this->input('street');
                                        $house = $this->input('house');
                                        $postal=$this->input('postal');
                                        $mobile = $this->input('Mobile');
                                        $city = $this->input('city');
                                        if($accountModel->addressdetails( $street, $house , $postal, $mobile, $city)){
                                        
                                        }
                                    }

        }
?>