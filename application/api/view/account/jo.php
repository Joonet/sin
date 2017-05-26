<?php
///**
// * Created by PhpStorm.
// * User: Jo
// * Date: 15/5/2017
// * Time: 11:31
// */
//
//?>
<!--<!DOCTYPE html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="UTF-8">-->
<!--    <title>test</title>-->
<!--    <script>-->
<!--        function loadXMLDoc() {-->
<!--            var xmlhttp;-->
<!---->
<!--            xmlhttp = new XMLHttpRequest();-->
<!---->
<!--            xmlhttp.onreadystatechange=function()-->
<!--            {-->
<!--                if (xmlhttp.readyState==4 && xmlhttp.status==200)-->
<!--                {-->
<!--                    document.getElementById("joke").innerHTML=xmlhttp.responseText;-->
<!--                }-->
<!--            }-->
<!--            xmlhttp.open("GET","jo", true);-->
<!--            xmlhttp.send();-->
<!--        }-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->
<!--    <div id="joke">Joke</div>-->
<!--    <button type="button" onclick="loadXMLDoc()">On</button>-->
<!--</body>-->
<!--</html>-->

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>菜鸟教程(runoob.com)</title>
    <style>
        .error {color: #FF0000;}
    </style>
</head>
<body>

<?php
// 定义变量并默认设置为空值
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (empty($_POST["name"]))
    {
        $nameErr = "名字是必需的";
    }
    else
    {
        $name = test_input($_POST["name"]);
        // 检测名字是否只包含字母跟空格
        if (!preg_match("/^[a-zA-Z ]*$/",$name))
        {
            $nameErr = "只允许字母和空格";
        }
    }

    if (empty($_POST["email"]))
    {
        $emailErr = "邮箱是必需的";
    }
    else
    {
        $email = test_input($_POST["email"]);
        // 检测邮箱是否合法
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email))
        {
            $emailErr = "非法邮箱格式";
        }
    }

    if (empty($_POST["website"]))
    {
        $website = "";
    }
    else
    {
        $website = test_input($_POST["website"]);
        // 检测 URL 地址是否合法
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website))
        {
            $websiteErr = "非法的 URL 的地址";
        }
    }

    if (empty($_POST["comment"]))
    {
        $comment = "";
    }
    else
    {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"]))
    {
        $genderErr = "性别是必需的";
    }
    else
    {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<h2>PHP 表单验证实例</h2>
<p><span class="error">* 必需字段。</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    名字: <input type="text" name="name" value="<?php echo $name;?>">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    网址: <input type="text" name="website" value="<?php echo $website;?>">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    备注: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
    <br><br>
    性别:
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">女
    <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">男
    <span class="error">* <?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>

<?php
echo "<h2>您输入的内容是:</h2>";
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

<?php

function spamcheck($filter) {
    $field = filter_var($filter, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)){
        return false;
    }else {
        return true;
    }
}


setcookie('3silkworm.com.user', "ddd".md5(" "),60 * 60 * 24 * 30);
echo cookie('3silkworm.com.user');


$to = "wwwwa@baiduc.com";         // 邮件接收者
$subject = "参数邮件";                // 邮件标题
$message = "Hello,这是邮件的内容";  // 邮件正文
$from = "huha@gmail.com";   // 邮件发送者
$headers = "From:" . $from;         // 头部信息设置
mail($to,$subject,$message,$headers);
echo "邮件已发送";
?>

</body>
</html>
