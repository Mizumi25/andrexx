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
        if(strpos($_POST['input'], '.') === false) {
            $num .= '.';
        }
    }

    if(isset($_POST['op']))
    {
        $cookie_value1 = $_POST['input'];
        setcookie($cookie_name1, $cookie_value1, time()+(86400*30), "/");


        $cookie_value2 = $_POST['op'];
        setcookie($cookie_name2, $cookie_value2, time()+(86400*30), "/");
        
        $num = "";
    }

    if(isset($_POST['equal']))
    {
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
                    if ($num != 0) {
                        $result = $_COOKIE['num'] / $num;
                    } else {
                        $result = "";
                    }
                    break;
                case "%":
                    $result = $_COOKIE['num'] * ($num / 100);
                    break;
            }
            $num = $result;
        }
        else {
            $num = "Invalid";
        }
    }

    if(isset($_POST['clear'])) {
        $num = substr($_POST['input'], 0, -1);
    }
    
    if(isset($_POST['clearall'])) {
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
    <style>
        body{
            background-color: #dbdbdb;
            width:100vw;
            height:100vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .calc{
            position: absolute;
            background-color: #fefefe;
            width: 400px;
            height: 730px;
            border-radius: 20px;
            box-shadow: 10px 10px 40px;
            display: flex;
        }
        .maininput{
            background-color: #fefefe;
            height: 145px;
            width: 98.2%;
            font-size: 80px;
            color: #fbacb0;
            border: none;
            text-align: right;
        }
        .numbtn{
            padding: 25px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: #f8f8f8;
            border: none;
            box-shadow: #f3d5dd 0px 30px 60px -12px, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px;
            margin: 7px 7px;
            transition: background-color 1s ease;
        }
        .numbtn:hover{
            background-color: rgb(136, 133, 133);
            color: whitesmoke;
        }
        .calbtn{
            padding: 25px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: #f7e1e5;
            border: none;
            margin: 7px 7px;
            transition: background-color 1s ease;
        }
        .calbtn:hover{
            background-color: #ff626c;
            color: whitesmoke;
        }
        .c{
            padding: 25px 30px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: #f7e1e5;
            border: none;
            transition: background-color 1s ease;
        }
        .c:hover{
            background-color: rgb(188, 16, 16);
            color: whitesmoke;
        }
        .equal{
            padding: 30px 80px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: #ff626c;
            border: none;
            transition: background-color 1s ease;
        }
        .equal:hover{
            background-color: #dbdbdb;
            color: whitesmoke;
        }

        .butts {
            border-radius: 40px;
            background-color: #f5faf8;
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 70%;
            text-align: center;
            padding: 20px 0;
        }

        #colorButton {
            position: absolute;
            left: 0;
            top: 0;
        }

    </style>
</head>
<body>
<button id="colorButton" onclick="changeColor()">Change Color</button>
        <div class="calc">
            <form action="" method="post">
                <br>
                <input type="text" class="maininput" name="input" value="<?php echo $num ?>"> <br> <br>

                <div class="butts">
                <input type="submit" class="c" name="clear" value="C">
                <input type="submit" class="calbtn" name="op" value="%">
                <input type="submit" class="calbtn" name="op" value="/">
                <input type="submit" class="c" name="clearall" value="CA"><br><br>
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
                <input type="submit" class="equal" name="equal" value="=">
                
                </div>


            </form>
        </div>





<script>
  var isColorChanged = false;

function changeColor() {
  var button = document.querySelector(".calc");

  if (!isColorChanged) {
    button.style.backgroundColor = "black";
    button.textContent = "Return Color";
    isColorChanged = true;
  } else {
    button.style.backgroundColor = "blue";
    button.textContent = "Change Color";
    isColorChanged = false;
  }
}
</script>

</body>
</html>
