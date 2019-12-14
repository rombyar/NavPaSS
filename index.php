<?php

  /**
  * @author Ahmad Romadhon
  * @website romadhonbyar.github.io
  * @decs Berfungsi untuk melakukan Encrypt dan Decrypt Password Navicat 11/12
  * @date 14 Des 2019
  */
  require_once 'fatsmalltools/src/NavicatPassword.php';
  use FatSmallTools\NavicatPassword;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <title>NavPaSS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  <div class="container">

      <h2>NavPaSS</h2>
      <p>Encrypt or Decrypt? make your <code>choice</code>!</p>

      <div class="row">
          <div class="col-12">
              <div class="card bg-light">
                  <div class="card-body">
                      <form action="" class="needs-validation" novalidate method="post">
                          <div class="row">
                              <div class="col-6">
                                  <div class="form-group">
                                      <label for="version">Version:</label>
                                      <select class="form-control" id="version" name="version" required>
                                          <option value="">-- Select --</option>
                                          <option value="12">v12</option>
                                          <option value="11">v11</option>
                                      </select>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Please fill out this field.</div>
                                  </div>
                              </div>
                              <div class="col-6">
                                  <div class="form-group">
                                      <label for="type">Encrypt or Decrypt:</label>
                                      <select class="form-control" id="type" name="type" required>
                                          <option value="">-- Select --</option>
                                          <option value="1">Encrypt</option>
                                          <option value="2">Decrypt</option>
                                      </select>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Please fill out this field.</div>
                                  </div>
                              </div>
                              <div class="col-12">
                                  <div class="form-group">
                                      <label for="_data">Input the data:</label>
                                      <input type="text" class="form-control" id="_data" placeholder="Enter data encryption or decryption" name="_data" required>
                                      <div class="valid-feedback">Valid.</div>
                                      <div class="invalid-feedback">Please fill out this field.</div>
                                  </div>
                              </div>
                          </div>
                          <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
                      </form>
                  </div>

              </div>
          </div>
      </div>

    <?php if($_POST['submit']==true) { ?>
      <div class="row mt-4">
          <div class="col-12">
              <div class="card bg-warning">
                  <div class="card-body text-center">
                      <p class="card-text">
                        <?php

                          if ($_SERVER["REQUEST_METHOD"] == "POST") {
                              // collect value of input field
                              $version = $_POST['version'];
                              $type = $_POST['type'];
                              $_data = $_POST['_data'];
                              if ((!empty($version) && ($version==11 or $version==12))&& (!empty($type) && ($type==1 or $type==2)) && !empty($_data)) {
                                // Harus menentukan versi, 11 atau 12
                                $navicatPassword = new NavicatPassword($version);
                                if($type==1){ //Encrypt
                                  $output = $navicatPassword->encrypt($_data); // verstion 11 15057D7BA390, version 12 833E4ABBC56C89041A9070F043641E3B
                                  $text = "encrypt";
                                } else {
                                  $output = $navicatPassword->decrypt($_data);
                                  $text = "decrypt";
                                }
                                echo '<span class="font-italic">'.$text.'</span>: <span class="font-weight-bold">'.$output.'</span>';
                              } else {
                                header("Location: index.php");
                              }
                          }
                        ?>
                      </p>
                  </div>
              </div>
          </div>
      </div>
    <?php } ?>

  </div>

<script>
// Disable form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Get the forms we want to add validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>
</html>
