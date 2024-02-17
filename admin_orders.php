<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'payment has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Pesanan</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Pesanan Masuk</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <p> id user : <span><?= $fetch_orders['user_id']; ?></span> </p>
         <p> Pesanan Tanggal : <span><?= $fetch_orders['placed_on']; ?></span> </p>
         <p> Nama : <span><?= $fetch_orders['name']; ?></span> </p>
         <p> Email : <span><?= $fetch_orders['email']; ?></span> </p>
         <p> No. Telp : <span><?= $fetch_orders['number']; ?></span> </p>
         <p> Alamat : <span><?= $fetch_orders['address']; ?></span> </p>
         <p> Jenis layanan paket : <span><?= $fetch_orders['paket']; ?></span> </p>
         <p> Kota/Kab. : <span><?= $fetch_orders['namakota']; ?></span> </p>
         <p> Provinsi : <span><?= $fetch_orders['namaprovinsi']; ?></span> </p>
         <p> Total Produk : <span><?= $fetch_orders['total_products']; ?></span> </p>
         <p> Total Harga : <span>Rp.<?=number_format($fetch_orders['total_price'], 0 , ',', '.'); ?></span> </p>
         <p> Harga ongkir : <span>Rp.<?= number_format($fetch_orders['ongkir'], 0, ',', '.'); ?>/-</span> </p>
         <p> Metode Pembayaran : <span><?= $fetch_orders['method']; ?></span> </p>
         <p> Bukti Pembayaran : <span><?=$fetch_orders['image']; ?></span> </p>
         <img width="150"src="uploaded_img/<?= $fetch_orders['image']; ?>" alt="">
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="diterima">diterima</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="ubah">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('Tolak Pesanan Ini?');">Tolak</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">belum ada pesanan yang masuk:(</p>';
      }
      ?>

   </div>

</section>












<script src="js/script.js"></script>

</body>
</html>