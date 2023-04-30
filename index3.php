
<?php 
// CHECK IF USER COMING FROM A REQUEST
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    // ASSIN VARABILE  and FILTER 
    $user=filter_var($_POST['username'] , FILTER_SANITIZE_STRING);
    $mail=filter_var($_POST['email'] , FILTER_SANITIZE_EMAIL ) ;
    $cell=filter_var($_POST['phone'] , FILTER_SANITIZE_NUMBER_INT) ;
    $msg= filter_var($_POST['message'] , FILTER_SANITIZE_STRING) ;
    
// error to one var
    // $errorUser='';
    // if(strlen($user) <= 3){
    //     $errorUser='user must be larger than 3 ' . '<br>';
    // }
    // $errorMsg='';
    // if(strlen($msg) <= 10){
    //     $errorMsg='<br>'.'msg must be larger than 10 ' . '<br>';
    // }

// CREATING ARRAY FOR ERRORS
    $formErrors = array();

    if(strlen($user) < 3){  #strlen => string lientgh
        $formErrors[]='user must be larger than 3 ';     //[] means add to array  
    }
    if(strlen($msg) < 3){  #strlen => string lientgh
        $formErrors[]='message must be larger than 3 ';     //[] means add to array  
    }

// IF NO ERROR SEND EMAIL => [mail(To , subject ,message ,headers , parameters )]
    $headers = 'From :' . $user . '\r\n' ;
    if(empty($formErrors)){
        mail('mo.shalash00@gmail.com','Contact Form', $msg , $headers);
        $user='';
        $mail='';
        $cell='';
        $msg='';
    }

    //  FILLTER 
    #1 FILTER_SANITIZE_STRING
    #2 FILTER_SANITIZE_EMAIL
    #3 FILTER_SANITIZE_NUMBER_INT



    // echo $user . '<br>';
    // echo $mail . '<br>';
    // echo $cell. '<br>';
    // echo $msg . '<br>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <div class="errors">
        <?php 
        if(isset($formErrors)){ # if have this thing
            foreach($formErrors as $error)
            echo $error . '<br/>';
        }
        ?>
    </div>
        <input name="username" type="text" 
        value="<?php if(isset($user)){echo $user;} ?>" <!-- keep the value and not remove -- 
        placeholder="Your Name"><br>
        <!-- <?php echo $errorUser ?> -->
        <input name="email" type="email" placeholder="Your Email"><br>
        <input name="phone" type="tel" placeholder="Your phone"><br>
        <textarea name="message" id="" cols="30" rows="10"
        placeholder="message"
        ></textarea>
        <!-- <?php echo $errorMsg ?> -->
        <button type="submit">send</button>
    </form>
</body>
</html>