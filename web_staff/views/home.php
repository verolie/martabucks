<?php 
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>alert('Anda tidak memiliki hak akses untuk halaman ini')</script>";
    echo "<script> window.location.href = '../../index.php';</script>"; 
}
$id_staff = $_SESSION['staff_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home Staff</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<style>
  .dropdown{
    margin: 20px;
  }

  .carousel-inner{
    height: 300px;
    width: 700px;
    margin: auto;
  }

  p{
    margin-top: 50px;
    margin-bottom: 50px;
    margin-left: 100px;
    margin-right: 100px;
    text-align: justify;
  }

  hr.dashed {
  border-top: 3px dashed #bbb;
  margin-left: 30px;
  margin-right: 30px;
  }

  .footer-nav li {
    margin: 30px;
    display: inline;
    padding: 30px;
  }

  h2{
    text-align: center;
    font-size: small;
    margin-bottom: 30px;
  }

  .deskripsi{
    font-size: 12pt;
  }
</style>

<body>
    <div class="wrapper">
    <header class = "header">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Profile
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                <li data-toggle="modal" data-target="#exampleModal"><a href="#">Profile</a></li>
                <li><a href="signout.php">Log out</a></li>
            </ul>
        </div>
        <nav class = "navbar navbar-style">
            <div class="container">
                <div class = "navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="home.php"><img class ="logo" src="logonew.png"></a>
                </div>
                <div class="collapse navbar-collapse" id = "micon">
                <ul class="nav navbar-nav navbar-right"> 
                    <li><a href="home.php">Beranda</a></li>
                    <li><a href="menu.php">Menu</a></li>
                    <li><a href="pesanan.php">Pesanan</a></li>
                    <li><a href="payment.php">Pembayaran</a></li>
                    <li><a href="promo.php">Promosi</a></li>
                    <li><a href="staff.php">Staff</a></li>
                    <li><a href="signout.php">Sign Out</a></li>
                </ul>
                </div>
            </div>
          </nav>
    </header>

    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
    
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
            <img src="slide1.jpg" alt="Martabak Manis" style="width:100%;">
          </div>
    
          <div class="item">
            <img src="slide2.jpg" alt="Martabak Telur" style="width:100%;">
          </div>
        
          <div class="item">
            <img src="slide3.jpg" alt="Cook" style="width:100%;">
          </div>
        </div>
    
        <!-- Left and right controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>

    <p class=deskripsi>
      Martabak adalah salah satu jajanan paling populer yang tersebar di seluruh wilayah Indonesia.
      Dengan rasanya yang manis dan creamy, martabak manis menjadi comfort food yang dapat dimakan sebagai
      camilan maupun makanan berat. Selain martabak manis, ada pula martabak dengan cita rasa gurih dan asin.
      Yupss, itu adalah martabak telur. Bagi yang kurang menyukai makanan manis, martabak telur pas banget nih
      dijadiin teman bergadang atau sekedar camilan saat kumpul bareng teman-teman.
    </p>
    <p class=deskripsi>
      Kalau mau ngerasain taste martabak manis dan martabak telur yang otentik tapi ga nguras dompet, datang
      aja ke MARTABUCKS, dijamin akan ketagihan deh. Untuk para staff MARTABUCKS, you are the real hero for all 
      martabak lovers out there!!! Keep spreading all sweets and umami taste in every bites of MARTABUCKS :)
    </p>

    <hr class="dashed">
    
    <section class="social">
      <div class="container text-center">
        <h2>Untuk informasi lebih lanjut, hubungin kami:</h2>
        <ul class="footer-nav">
          <li><a href="#"><img src="https://img.icons8.com/fluent/48/000000/gmail.png" >martabucks@gmail.com</a></li>
          <li><a href="#"><img src="https://img.icons8.com/fluent/48/000000/whatsapp.png" >Whatsapp - 081811556677</a></li>
          <li><a href="#"><img src="https://img.icons8.com/fluent/48/000000/phone.png">(021) 77889966</a></li>
        </ul>
      </div>
    </section>
  </div>
</body>
<?php include 'show-profile.php'; ?>