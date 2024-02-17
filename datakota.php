<?php

$id_provinsi_terpilih = $_POST['id_provinsi'];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$id_provinsi_terpilih,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    // Silahkan diisi dengan api_key dari rajaongkir.com
    "key: 4cd3e3de40d1c1a0119c95e213fbcbc2"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  // echo $response;
  // Menjadikan array dari json
  $array_response = json_decode($response, TRUE);
  $data_kota = $array_response['rajaongkir']['results'];

  // echo "<pre>";
  // print_r($data_kota);
  // echo "</pre>";

  echo "<option value=''>--Pilih Kota--</option>";

  foreach($data_kota as $key => $tiap_kota){
    echo "<option value='' id_kota='".$tiap_kota['city_id']."'namaprovinsi='".$tiap_kota['province']."'namakota='".$tiap_kota['city_name']."' tipe_kota='".$tiap_kota['type']."' kodepos='".$tiap_kota['postal_code']."'>";
    echo $tiap_kota['type']." ";
    echo $tiap_kota['city_name'];
    echo "</option>";
  }
}