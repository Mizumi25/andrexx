<?php
    $cookie_name1="num";
    $cookie_value1="";
    $cookie_name2="op";
    $cookie_value2="";

    if(isset($_POST['num']))
    {
        $num = $_POST['input'] . $_POST['num'];
    }
    else {
        $num = @$_POST['input']; 
    }

    if(isset($_POST['decimal']))
    {
        // Check if the input already contains a decimal point
        if(strpos($_POST['input'], '.') === false) {
            // If not, append a decimal point to the input
            $num .= '.';
        }
    }

    if(isset($_POST['op']))
    {
        // Store current input in cookies
        $cookie_value1 = $_POST['input'];
        setcookie($cookie_name1, $cookie_value1, time()+(86400*30), "/");

        // Store the clicked operation in cookies
        $cookie_value2 = $_POST['op'];
        setcookie($cookie_name2, $cookie_value2, time()+(86400*30), "/");
        
        // Clear input field after operation is performed
        $num = "";
    }

    if(isset($_POST['equal']))
    {
        // Check if input is not empty and cookies are set
        if (!empty($_POST['input']) && isset($_COOKIE['num']) && isset($_COOKIE['op'])) {
            $num = $_POST['input'];
            switch($_COOKIE['op']) {
                case "+":
                    $result = $_COOKIE['num'] + $num;
                    break;
                case "-":
                    $result = $_COOKIE['num'] - $num;
                    break;
                case "*":
                    $result = $_COOKIE['num'] * $num;
                    break;
                case "/":
                    // Check if divisor is not zero
                    if ($num != 0) {
                        $result = $_COOKIE['num'] / $num;
                    } else {
                        $result = "Error: Division by zero";
                    }
                    break;
            }
            $num = $result;
        }
        else {
            // Handle error if input field is empty
            $num = "Error: Incomplete expression";
        }
    }

    if(isset($_POST['clear'])) {
        // Clear individual characters from the input
        $num = substr($_POST['input'], 0, -1);
    }
    
    if(isset($_POST['clearall'])) {
        // Clear all cookies and reset input
        $num = "";
        setcookie($cookie_name1, "", time() - 3600, "/");
        setcookie($cookie_name2, "", time() - 3600, "/");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
        <div class="calc">
            <form action="" method="post">
                <br>
                <input type="text" class="maininput" name="input" value="<?php echo $num ?>"> <br> <br>

                <input type="submit" class="c" name="clear" value="C">
                
                <input type="submit" id="call" class="c" name="clearall" value="Clear All">
                <input type="submit" id="div" class="calbtn" name="op" value="/"><br><br>
                <input type="submit" class="numbtn" name="num" value="7">
                <input type="submit" class="numbtn" name="num" value="8">
                <input type="submit" class="numbtn" name="num" value="9">
                <input type="submit" class="calbtn" name="op" value="+"> <br><br>
                <input type="submit" class="numbtn" name="num" value="4">
                <input type="submit" class="numbtn" name="num" value="5">
                <input type="submit" class="numbtn" name="num" value="6">
                <input type="submit" class="calbtn" name="op" value="-"><br><br>
                <input type="submit" class="numbtn" name="num" value="1">
                <input type="submit" class="numbtn" name="num" value="2">
                <input type="submit" class="numbtn" name="num" value="3">
                <input type="submit" class="calbtn" name="op" value="*"><br><br>
                <input type="submit" class="numbtn" name="num" value="0">
                <input type="submit" class="numbtn" name="decimal" value=".">
                <input type="submit" class="equal" id="eq" name="equal" value="=">
                
                
                
                


            </form>
        </div>



</body>
</html>
