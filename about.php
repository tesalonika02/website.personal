<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/tes.png" alt="">
         <h3>Tentang Kami</h3>
         <p>Selamat datang di Tesa Hat Store! Toko kami menawarkan koleksi topi trendi dan berkualitas tinggi untuk gaya remaja hingga dewasa. Temukan pilihan terbaik dari snapback hingga beanie, semua dengan desain inovatif dan kenyamanan yang tak tertandingi. Sambut gaya Anda dengan Tesa Hat Store!</p>
      </div>

      <div class="box">
         <img src="images/tm.jpg" alt="">
         <h3>Apa yang Kami Sediakan?</h3>
         <p>Kami menyediakan berbagai jenis topi, mulai dari bahan katun sampai bahan kulit. Cocok untuk kaum milenial fashion tren masa kini! Ayo tingkatkan Fashion Trendy mu di Tesa Hat Store!</p>
      </div>

   </div>

</section>











<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>