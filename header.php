<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>

<header class="header">

   <div class="flex">

      <a href="home.php" class="logo">Tesa Hat Store<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">Beranda</a>
         <a href="shop.php">Produk</a>
         <a href="orders.php">Pesanan</a>
         <a href="about.php">Tentang Kami</a>
         <a href="carabelanja.php">Alur Pesanan</a>
      </nav>

      <div class="icons">
      <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <div id="user-btn" class="fas fa-user"></div>
         </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">Ubah Profil</a>
         <a href="logout.php" class="delete-btn">Keluar</a>
         <div class="flex-btn">
         </div>
      </div>

   </div>

</header>