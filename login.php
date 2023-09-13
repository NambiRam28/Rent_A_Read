<?php

session_start();
?>
<!DOCTYPE html>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.emailjs.com/dist/email.min.js"></script>
        <title> Responsive Login and Signup Form </title>

      
        <link rel="stylesheet" href="login.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

                        
    </head>
    
    <body>
    <div class="navbar">
    <h3 class="navbar-title">
        <i class="fas fa-book"></i>
        RENT-A-READ
    </h3>
       
        
    </div>
        <section class="container forms">
            <div class="form login">
                <div class="form-content">
                    <header>Login</header>
                   
                    <?php
                      
                        if (isset($_SESSION['message'])) {
                            echo '<p style="color: green;font-size: 15px;text-aligin:center;">' . $_SESSION['message'] . '</p>';
                           
                            unset($_SESSION['message']);
                        }
                    ?>
                    
      
                    
                    <form action="loginvalidation.php" method="post">
                        <div class="field input-field">
                            <input type="email" id="useremail" name="email" placeholder="Email" class="input">
                        </div>

                        <div class="field input-field">
                            <input type="password" id= "userpassword" name="password" placeholder="Password" class="password">
                            <i class='bx bx-hide eye-icon'></i>
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
                            <button>Login</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="#" class="link signup-link">Signup</a></span>
                    </div>
                </div>

             <!-- <div class="line"></div> -->
<!-- 
                <div class="media-options">
                    <a href="#" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="#" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div> -->

            </div>
            
           
            <!-- Signup Form -->

            <div class="form signup">
                <div class="form-content">
                    <header>Signup</header>
                    <form action="signup.php" method="post">
                        

                        

                        <div class="field input-field">
                <input type="text" id="username" placeholder="Username" class="input">
            </div>
            <div class="field input-field">
            <input type="email" id="email"placeholder="Email" class="input">
                        </div>

            <div class="field input-field">
                <input type="text" id="department" placeholder="Department" class="input">
            </div>
            
            
            <div class="field button-field">
               <button type="button" onclick="send_mail(event)">Signup</button>
             </div>

                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="#" class="link login-link">Login</a></span>
                    </div>
                </div>

              
            </div>
        </section>
          
        <!-- JavaScript -->
        <script src="loginjs.js"></script>
        
    </body>
</html>