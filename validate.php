<!DOCTYPE html>
<html>
    <head>
        <style>
            .error {color: #FF0000;}
        </style>
    </head>
    <body>
        <?php
            //define variables and set to empty
            $nameErr= $emailErr= $genderErr= $websiteErr = "";
            $name= $email= $gender= $comment= $website= "";

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($_POST["name"])){
                    $nameErr = "Please enter a valid name";
                } else {
                    $name = test_input($_POST["name"]);
                    if(!preg_match("/^[a-zA-Z-']*$/",$name)){
                        $nameErr = "Only letters and white spaces are allowed";
                    }
                }
            }

            if(empty($_POST["email"])){
                $emailErr = "Please enter a valid email";
            } else {
                $email = test_input($_POST["email"]);
                if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                    $emailErr = "The email address is incorrect";
                }
            }

            if(empty($_POST["website"])){
                $websiteErr = "";
            } else {
                $website = test_input($_POST["website"]);
                if(!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&#\/%=~_|]/i",$website)){
                    $websiteErr = "Enter a valid Website URL";
                }
            }

            if(empty($_POST["comment"])){
                $commentErr = "";
            } else {
                $comment = test_input($_POST["comment"]);
            }

            if(empty($_POST["gender"])){
                $genderErr = "Please select a gender";
            } else {
                $gender = test_input($_POST["gender"]);
            }

            function test_input($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>

        <h2> PHP Form Validation Example </h2>
        <p> <span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
            Full Name: <input type="text" name="name"/>
            <span class="error">* <?php echo $nameErr;?></span>
            <br/> <br/>
            E-mail: <input type="text" name="email"/>
            <span class="error">* <?php echo $emailErr;?></span>
            <br/> <br/>
            Website: <input type="text" name="website"/>
            <span class="error">* <?php echo $websiteErr;?></span>
            <br/> <br/>
            Comment: <textarea name="comment" rows="10" cols="30"></textarea>
            <br/> <br/>
            Gender: <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male"> Male
            <span class="error">* <?php echo $genderErr;?></span>
            <br/> <br/>
            <input type="submit" name="Click here" value="Click here"/>
        
        </form>

        <?php
            echo "<h2> Your Input:</h2>";
            echo $name;
            echo "<br>";
            echo $email;
            echo "<br>";
            echo $website;
            echo "<br>";
            echo $comment;
            echo "<br>";
            echo $gender;
        ?>

    </body>
</html>