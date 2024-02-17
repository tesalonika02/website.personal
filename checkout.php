<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = ''. $_POST['flat'] .' '. $_POST['kecamatan'] .' '. $_POST['kelurahan'] .' '. $_POST['kota'] .' '. $_POST['provinsi'] .' - '. $_POST['jasaekspedisi'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');
   $paket = $_POST['paket'];
   $ongkir = $_POST['ongkir'];
   $estimasi = $_POST['estimasi'];
   $namaprovinsi = $_POST['namaprovinsi'];
   $namakota = $_POST['namakota'];
   $tipe = $_POST['tipe'];

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   move_uploaded_file($image_tmp_name, $image_folder);

   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $cart_query->execute([$user_id]);
   if($cart_query->rowCount() > 0){
      while($cart_item = $cart_query->fetch(PDO::FETCH_ASSOC)){
         $cart_products[] = $cart_item['name'].' ( '.$cart_item['quantity'].' )';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      };
   };

   $total_products = implode(', ', $cart_products);

   $order_query = $conn->prepare("SELECT * FROM `orders` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_products = ? AND total_price = ? AND image = ? AND paket = ? AND ongkir = ? AND estimasi = ? AND namaprovinsi = ? AND namakota = ? AND tipe = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_products, $cart_total, $image, $paket, $ongkir, $estimasi, $namaprovinsi, $namakota, $tipe]);

   if($cart_total == 0){
      $message[] = 'Keranjang anda kosong';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'Pesanan anda sudah ditambahkan!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on, image, paket, ongkir, estimasi, namaprovinsi, namakota, tipe) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $cart_total, $placed_on, $image, $paket, $ongkir, $estimasi, $namaprovinsi, $namakota, $tipe]);
      $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
      $delete_cart->execute([$user_id]);
      $message[] = 'order berhasil!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $cart_grand_total = 0;
      $select_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart_items->execute([$user_id]);
      if($select_cart_items->rowCount() > 0){
         while($fetch_cart_items = $select_cart_items->fetch(PDO::FETCH_ASSOC)){
            $cart_total_price = ($fetch_cart_items['price'] * $fetch_cart_items['quantity']);
            $cart_grand_total += $cart_total_price;
   ?>
   <p> <?= $fetch_cart_items['name']; ?> <span>(<?='Rp.'.$fetch_cart_items['price'].'/- x '. $fetch_cart_items['quantity']; ?>)</span> </p>
   <?php
    }
   }else{
      echo '<p class="empty">Keranjang kamu kosong:(!</p>';
   }
   ?>
   <div class="grand-total">Grand total : <span>Rp.<?=number_format($cart_grand_total, 0, ',', '.'); ?>/-</span></div>
</section>

<section class="checkout-orders">

   <form action="" enctype="multipart/form-data" method="POST">

      <h3>Pesanan Anda</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Nama Anda :</span>
            <input type="text" name="name" placeholder="Masukan Nama Anda" class="box" required>
         </div>
         <div class="inputBox">
            <span>No. Telp :</span>
            <input type="tel" minlength ="12" maxlength="12" name="number" placeholder="Masukan No. Telp Anda" class="box" required >
         </div>
         <div class="inputBox">
            <span>Email Anda :</span>
            <input type="email" name="email" placeholder="Masukan Email Anda" class="box" required>
         </div>
         <div class="inputBox">
            <span>Metode Pembayaran :</span>
            <select name="method" class="box" required>
               <option value="Dana">Dana 081219303800 An.Artha Tesa</option>
               <option value="Gopay">Gopay 081219303800 An.Artha Tesa</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Bukti Pembayaran : </span>
            <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png" required>  
         </div>
         <div class="inputBox">
            <span>Alamat Lengkap : </span>
            <input type="text" name="flat" placeholder="Alamat Lengkap" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kecamatan  :</span>
            <input type="text" name="kecamatan" placeholder="Kecamatan" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kelurahan :</span>
            <input type="text" name="kelurahan" placeholder="Kelurahan" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kota :</span>
            <select name="kota" class="box" required>
            </select>
         </div>
         <div class="inputBox">
            <span>Provinsi :</span>
            <select name="provinsi" class="box" required>
            </select>
         </div>
         <div class="inputBox">
            <span>Ekspedisi :</span>
            <select name="jasaekspedisi" class="box" required>
            </select>
         </div>
         <div class="inputBox">
            <span>Paket :</span>
            <select name="nama_paket" class="box" required>
            </select>
         <div>
            <input type="text" name="total_berat" value="2000">
            <input type="text" name="paket">
            <input type="text" name="ongkir">
            <input type="text" name="estimasi">
            <input type="text" name="namaprovinsi">
            <input type="text" name="namakota">
            <input type="text" name="tipe">
         </div>
         <div class="content">
         <h4>*Note : Maksimal berat untuk sekali pengiriman 2000 gram. Apabila melebihi 2000 gram silahkan hubungi kontak yang tersedia. Terima Kasih.</h4>
         
         
      </div>

      <input type="submit" name="order" class="btn <?= ($cart_grand_total > 1)?'':'disabled'; ?>" value="Checkout">

   </form>

</section>







<?php include 'footer.php'; ?>

<script src="js/script.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
   $(document).ready(function(){
      $.ajax({
         type:'post',
         url:'dataprovinsi.php',
         success:function(hasil_provinsi)
         {
            $("select[name=provinsi]").html(hasil_provinsi);
         }
      })

   });
   $("select[name=provinsi]").on("change", function(){
        // Ambil id_provinsi ynag dipilih (dari atribut pribadi)
        var id_provinsi_terpilih = $("option:selected", this).attr("id_provinsi");
        $.ajax({
          type: 'post',
          url: 'datakota.php',
          data: 'id_provinsi='+id_provinsi_terpilih,
          success:function(hasil_kota){
            $("select[name=kota]").html(hasil_kota);
          }
        })
      });
      $.ajax({
        type: 'post',
        url: 'jasaekspedisi.php',
        success: function(hasil_ekspedisi){
          $("select[name=jasaekspedisi]").html(hasil_ekspedisi);
        }
      });

      $("select[name=jasaekspedisi]").on("change", function(){
        // Mendapatkan data ongkos kirim

        // Mendapatkan ekspedisi yang dipilih
        var ekspedisi_terpilih = $("select[name=jasaekspedisi]").val();
        // Mendapatkan id_distrik yang dipilih
        var kota_terpilih = $("option:selected", "select[name=kota]").attr("id_kota");
        var total_berat = $("input[name=total_berat]").val();
        $.ajax({
          type: 'post',
          url: 'datapaket.php',
          data: 'jasaekspedisi='+ekspedisi_terpilih+'&kota='+kota_terpilih+'&berat='+total_berat,
          success: function(hasil_paket){
            // console.log(hasil_paket);
            $("select[name=nama_paket]").html(hasil_paket);
          }
        })
      });
        $("select[name=nama_paket]").on("change", function(){
        var paket = $("option:selected", this).attr("paket");
        var ongkir = $("option:selected", this).attr("ongkir");
        var etd = $("option:selected", this).attr("etd");
        $("input[name=paket]").val(paket);
        $("input[name=ongkir]").val(ongkir);
        $("input[name=estimasi]").val(etd);
      });
         $("select[name=kota]").on("change", function(){
         var prov = $("option:selected", this).attr('namaprovinsi');
         var dist = $("option:selected", this).attr('namakota');
         var tipe = $("option:selected", this).attr('tipe_kota');
         $("input[name=namaprovinsi]").val(prov);
         $("input[name=namakota]").val(dist);
         $("input[name=tipe]").val(tipe);
      });
  </script>

</body>
</html>