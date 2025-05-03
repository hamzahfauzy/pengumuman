<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-start g-lg-5 py-5">
      <div class="col-lg-7 text-center text-lg-start mt-0">
        <h1 class="display-4 fw-bold lh-1 text-body-emphasis mb-3 mt-3 text-uppercase">Hasil Kelulusan <?=getSetting('APP_NAMA_SEKOLAH')?> <?=$periode->nama?></h1>
        <p class="col-lg-10 fs-4"><?=getSetting('APP_KATA_SAMBUTAN')?></p>
      </div>
      <div class="col-md-10 mx-auto col-lg-5 mt-0">
        <?php if(strtotime('now') < strtotime(getSetting('APP_WAKTU_PENGUMUMAN'))): ?>
        <div class="p-4 p-md-5 border rounded-3 bg-body-tertiary">
            <div class="text-center mb-4">
                <img src="<?=getLogo()?>" alt="">
                <br><br><br>
                <h2 id="timer"></h2>
            </div>
        </div>
        <?php else: ?>
        <form class="p-4 p-md-5 border rounded-3 bg-body-tertiary" method="POST" action="<?=routeTo('pengumuman/result')?>">
            <?=csrf_field()?>
            <div class="text-center mb-4">
                <img src="<?=getLogo()?>" alt="">
            </div>
          <div class="form-group mb-3">
              <label class="mb-2">NISN</label>
            <input type="text" name="kode" class="form-control" placeholder="Masukan NISN Disini" required>
          </div>
          <div class="form-group mb-3">
          <label class="mb-2">Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" placeholder="Masukan Tanggal Lahir Disini" required>
          </div>
          <button class="w-100 btn btn-lg btn-primary rounded-pill" type="submit">Lihat Hasil Pengumuman</button>
        </form>
        <?php endif ?>
      </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script>
// Set the date we're counting down to
const countDownDate = new Date("<?=getSetting('APP_WAKTU_PENGUMUMAN')?>").getTime();
const now = new Date("<?=date('Y-m-d H:i:s')?>").getTime();
var distance = countDownDate - now;

// Update the count down every 1 second
var x = setInterval(function() {

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  hours = hours < 10 ? "0"+hours : hours
  minutes = minutes < 10 ? "0"+minutes : minutes
  seconds = seconds < 10 ? "0"+seconds : seconds
    
  // Output the result in an element with id="demo"
  document.getElementById("timer").innerHTML = "<span class='p-2 border'>" + hours + "</span> : <span class='p-2 border'>" + minutes + "</span> : <span class='p-2 border'>" + seconds + "</span>";

  distance = distance-1000
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    window.location.reload()
  }
  
}, 1000);
</script>
</body>
</html>