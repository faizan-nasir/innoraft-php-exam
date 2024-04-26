<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous" />
  <link rel="stylesheet" href="styles/user_styles.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <title>Stock</title>
</head>

<body>
  <header>
    <?php

    require 'header.php';
    ?>
  </header>
  <main class="container">

    <div class="profile-view flex-all flex-column">
      <label for="stock">Stock Name: </label>
      <input name="stock" type="text" placeholder="Enter Stock">
      <label for="price">Stock Price: </label>
      <input name="price" type="text" placeholder="Enter price">
      <button class="loadBtn">Add Stock</button>
    </div>

    <div class="profile-view" id="userTable">
      <table class="table table-dark">
        <thead>
          <tr>
            <th scope="col">Stock ID</th>
            <th scope="col">Email</th>
            <th scope="col">Stock Name</th>
            <th scope="col">Stock price</th>
            <th scope="col">Created</th>
            <th scope="col">Last Updated</th>
          </tr>
        </thead>
        <tbody class="tbody">
        </tbody>
    </div>

    <div>
      <h5>Update Stock</h5>
      <div class="flex-all flex-column editForm">
        <h5 class="id-content"></h5>
        <label for="stock">Stock Name: </label>
        <input class="stockname" name="stock" type="text" placeholder="Enter Stock" value="">
        <label for="price">Stock Price: </label>
        <input class="stockprice" name="price" type="text" placeholder="Enter price" value="">
        <button class="editBtn">Edit Stock</button>
      </div>
    </div>
  </main>

  <!-- Optional JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="js/stock_script.js"></script>
</body>

</html>
