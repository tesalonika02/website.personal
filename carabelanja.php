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
   <title>Alur Pesanan</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="cara">


      <div class="box">
         <h1>Alur Pesanan</h1>
         <p>Bagaimana Cara Memesan di Tesa Hat Store?</p>
         <p>1. Anda dapat melihat produk pada menu "Produk" </p>
         <p>2. Pilih produk, lalu Anda dapat menambahkannya ke keranjang sehingga otomatis masuk pada icon keranjang</p>
         <p>3. Selain itu Anda dapat menambahkannya ke wishlist sehingga otomatis masuk pada icon hati</p>
         <p>4. Lakukan proses pembayaran dengan memilih "Proses Checkout"</p>
         <p>5. Isi formulir sesuai dengan data Anda</p>
         <p>6. Pilih metode pembayaran, sertakan bukti pembayaran</p>
         <p>7. Admin akan memproses belanjaan Anda, Anda dapat melihat nya pada menu "Pesanan"
      </div>

   </div>

</section>











<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>