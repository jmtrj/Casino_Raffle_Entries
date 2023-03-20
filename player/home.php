<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php include 'includes/navbar.php'; ?>
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home.php">Home</a></li>
              <li class="breadcrumb-item active">GAME PLAY</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
       <?php include '../validation.php'; ?>
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <div class="col-md-12" >
            <div class="card"  >
              <div class="card-header" >
                <h3 class="card-title" >GAME PLAY</h3>
              </div>
                <input type="text" id="PlayerId" name="PlayerId" value="<?php echo $user['Id'];?>" hidden>
                <audio id="spin-sound"><source src="audio/spin.mp3" type="audio/mpeg" loop></audio>
                <audio id="spin-sounds"><source src="audio/win.mp3" type="audio/mpeg"></audio>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8"  >
                      <div class="col-lg-12">
                          <div class="slot-machine-graphic">
                            <div class="top">
                              <div class="logo-wrapper">
                                <div style="padding: 20px;"></div>
                                <center> <h1 class="slot" style="font-family: 'Courier New', monospace;">START!</h1></center>
                                 <div style="padding: 20px;"></div>
                                <div class="more-borders"></div>
                                <div class="decoration-container">
                                  <div class="red-angle"></div>

                                  <div class="line-decoration red">
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                  </div>

                                  <div class="line-decoration blue ">
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                  </div>

                                  <div class="line-decoration orange">
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                    <span class="line-group"></span>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="body">
                              <div class="numbers-wrapper">
                                <div class=" shadow-lg p-3 mb-5 bg-white rounded">
                                      <center>  <button class="btn btn-danger px-5" id="pick-button"><i class="fas fa-sync-alt"></i> SPIN</button></center>
                          
                                </div>
                         
                              </div>
                            </div>
                            <div class="handle">
                              
                            </div>
                          </div><!-- /machine graphic -->
                        </div><!-- /col -->



                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <h2 style="font-family: 'Courier New', monospace;" >LIST OF PRIZES</h2>
                    <ul class="chart-legend clearfix"   id="data-list">
                    </ul>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>


<script type="text/javascript">
$(document).ready(function() {
  $.ajax({
    url: "display.php",
    type: "post",
    success: function(data) {
       var items = JSON.parse(data);
       var li = "";
       for (var i = 0; i < items.length; i++) {
         li += "<li><i class='far fa-circle text-danger'></i> " + items[i]  + "</li>";
       }
       $("#data-list").append(li);
    }
  });
});
</script>





 <script type="text/javascript">
const pickButton = document.getElementById("pick-button");
const spin_count = document.getElementById("spin-count");
const slots = document.querySelectorAll(".slot");
const textfield = document.getElementById("PlayerId");
const PlayerId = textfield.value;
const spinSound = document.getElementById("spin-sound");
const spinSounds = document.getElementById("spin-sounds");

pickButton.addEventListener("click", pickPrize);

var item = [];



function pickPrize() {
  // Disable the pick button
  pickButton.disabled = true;

  // Make an AJAX call to check the available number of spins
  $.ajax({
    url: "check_spins.php",
    type: "post",
    data: { PlayerId: PlayerId },
    success: function(data) {
      const availableSpins = parseInt(data);
      if (availableSpins > 0) {
        // Play the spin sound
        spinSound.play();

        // Make an AJAX call to get the items for the roulette
        $.ajax({
          url: "data.php",
          type: "post",
          success: function(data) {
            item = JSON.parse(data);
            let winner = get(item);

            // Spin the slots
            spinSlots(winner);

         

            // Update the available number of spins
            textfield.value = availableSpins - 1;
          }
        });
      } else {
        alert("You don't have any spins left.");
        pickButton.disabled = false;
      }
    }
  });
}





function get(input) {
    var array = []; 
    for(var item in input) {
        if (input.hasOwnProperty(item)) { 
            for(var i = 0; i < input[item]; i++) {
                array.push(item);
            }
        }
    }
    return array[Math.floor(Math.random() * array.length)];
}



function insertIntoDB(winner) {
  $.ajax({
    url: "function.php",
    type: "post",
    data: { winner: winner, PlayerId: PlayerId },
    success: function(data) {
      console.log("Data inserted successfully");
       textfield.value = parseInt(textfield.value);
      spin_count.textContent = "(" + textfield.value + ")";
    }
  });
}


function spinSlots(winner) {
  let count = 0;
  let slotIntervals = [];

  for (let i = 0; i < slots.length; i++) {
    slotIntervals[i] = setInterval(function() {
      slots[i].textContent = Object.keys(item)[count % Object.keys(item).length];
      count++;
    }, 1);
  }

  setTimeout(function() {
    for (let i = 0; i < slots.length; i++) {
      clearInterval(slotIntervals[i]);
      slots[i].textContent = winner;
    }
    spinSound.pause(); 
    spinSounds.play();// Stop playing audio when the spinning stops
    pickButton.disabled = false;
    insertIntoDB(winner);

  }, (slots.length + 1) * 4100);
}

</script>
 <?php include 'includes/script.php'; ?>

