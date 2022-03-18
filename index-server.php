<!DOCTYPE html>
<html lang="en">
<head>
<title>Influencer Website</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="bootstrap.min.css">
<script src="bootstrap.min.js"></script>
<style>
.card-box {
    border: 1px solid #ddd;
    padding: 20px;
    box-shadow: 0px 0px 10px 0px #c5c5c5;
    margin-bottom: 30px;
    float: left;
    border-radius: 10px;
}
.card-box .card-thumbnail {
    overflow: hidden;
    border-radius: 10px;
    transition: 1s;
    object-fit: cover;
    height: 100%;
}
.card-box .card-thumbnail:hover {
    transform: scale(1.1);
}
.card-box h3 a {
    font-size: 20px;
    text-decoration: none;
}
.card-img-top {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
</style>
</head>
<body>

<div class="container p-5 my-5 border">
  <div class="container bcontent">
<?php
  $user_url = "https://softwaretrailers.com/version-test/api/1.1/wf/get_user";
  // alexander: 1645552052354x914742458486495100
  $postRequest = array(
    'prm_id' => '1645552052354x914742458486495100'
  );
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $user_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $postRequest);
  $output = curl_exec($curl);
  $result = json_decode($output,true);
  $name = $result['response']['user']['Name'];

  echo('<div class="container"');
  echo('<div class="card" style="width: 18rem;">');
  echo('<img src="'.$result['response']['user']['Picture'].'" class="card-img-top" alt="...">');
  echo('<div class="card-body">');
  echo('<h5 class="card-title text-center">'.$result['response']['user']['FirstName'].' '.$result['response']['user']['LastName'].'</h5>');
  echo('<p class="card-text text-muted"><i>'.$result['response']['user']['Quote'].'</i></p>');
  //echo('<a href="#" class="btn btn-primary">Go somewhere</a>');
  echo('</div>');
  echo('</div>');
  echo('</div>');

  echo('<hr />');

  $products_url = "https://softwaretrailers.com/version-test/api/1.1/obj/product";
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $products_url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  $output = curl_exec($curl);
  $result = json_decode($output,true);
  echo('<div class="container">');
  echo('<div class="row d-flex">');
  foreach ($result['response']['results'] as $product) {
    echo('<div class="col-md-6 col-lg-3">');
      echo('<div class="card-box">');
        echo('<div class="card-thumbnail mx-auto">');
          echo('<img src="'.$product['Logo'].'" class="img-fluid mx-auto my-auto d-block rounded" alt="" style="object-fit:cover; height:100%;">');
        echo('</div>');
        echo('<h3><a href="'.$product['BuyURL'].'" target="_blank" class="mt-2 text-danger">'.$product['Name'].'</a></h3>');

        if (strlen($product['Description']) > 80)
        {
          echo('<p class="text-secondary">'.mb_substr($product['Description'], 0, 80).'<i> (...)</i></p>');
        }
        else
        {
          echo('<p class="text-secondary">'.$product['Description'].'</p>');
        }
        echo('<a href="'.$product['BuyURL'].'" target="_blank" class="btn btn-sm btn-danger float-right">Buy '.$product['Name'].'</a>');
      echo('</div>');
    echo('</div>');
  }

  echo('</div>');
  echo('</div>');

  curl_close($curl);
?>

  </div>
</div>

</body>
</html>
