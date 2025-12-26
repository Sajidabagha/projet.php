<?php
include("php/config.php");
$message=""; $type="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

  if(!empty($_POST['website'])) exit; // anti-spam

  $name=$_POST['name'];
  $email=$_POST['email'];
  $course=$_POST['course'];
  $msg=$_POST['message'];
  $ip=$_SERVER['REMOTE_ADDR'];

  if($name && $email && $course){
    $stmt=$conn->prepare(
      "INSERT INTO inscriptions(name,email,course,message,ip)
       VALUES (?,?,?,?,?)"
    );
    $stmt->bind_param("sssss",$name,$email,$course,$msg,$ip);

    if($stmt->execute()){
      $message="✅ تم التسجيل بنجاح";
      $type="success";

      /*mail($email,"تأكيد التسجيل",
      "شكراً $name لتسجيلك في $course",
      "From: academy@proformation.com");*/
    }
  }else{
    $message="❌ يرجى ملء جميع الحقول";
    $type="error";
  }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<title>التسجيل</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Cairo', sans-serif;
}

body {
    background: #f5f7fa;
    color: #1b0346ff;
}
.container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        header {
            background: #0b1c2d;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    nav a {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        nav a:hover {
            color: #d4af37;
        }

        .logo {
            color: #d4af37;
            font-size: 28px;
            font-weight: bold;
        }

h2 {
    text-align: center;
    margin: 30px 0;
}

form {
    width: 350px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    border-left: 6px solid #d4af37;
}

input, select, textarea, button {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1em;
}

button {
    background: #d4af37;
    color: #0b1c2d;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    transform: scale(1.03);
}

.alert.success {
    background: #d4ffd4;
    padding: 12px;
    text-align: center;
    margin: 15px auto;
    width: 350px;
    border-radius: 8px;
}

.alert.error {
    background: ;
    padding: 12px;
    text-align: center;
    margin: 15px auto;
    width: 350px;
    border-radius: 8px;
}
</style>


<script src="assets/main.js"></script>
</head>
<body>
<header>
        <div class="container">
            <h1 class="logo">ProFormation Academy</h1>
            <nav>
                <a href="index.html">الرئيسية</a>
                <a href="courses.html">الدورات</a>
                <a href="register.php">التسجيل / تواصل</a>
            </nav>
        </div>
    </header>
<h2>التسجيل</h2>

<?php if($message): ?>
<div class="alert <?= $type ?>"><?= $message ?></div>
<?php endif; ?>

<form method="post">
<input type="text" name="website" style="display:none">
<input name="name" placeholder="الاسم" required>
<input type="email" name="email" placeholder="البريد" required>
<select name="course" required>
  <option value="">اختر دورة</option>
  <option>إعلام آلي</option>
  <option>لغات</option>
  <option>محاسبة</option>
</select>
<textarea name="message" placeholder="رسالة"></textarea>
<button>إرسال</button>
</form>

</body>
</html>
