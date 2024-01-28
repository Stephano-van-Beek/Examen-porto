<?php 
/*

LET OP WERK ALLEEN HTTPS VOOR PRIVACY!!!!!!!

$_SESSION['foto_map'] = "C:/Fototest/test1/";  bij het aanropen hier de opslaglocatie in vermelden.

*/
session_start();

?>
<!--LET OP STYLE MOET HIER STAAN OF WERKT NIET!!!!!-->
<style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  background-color: #f5f5f5;
  
}

.error-block {
  text-align: center;
  background-color: #fff;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.error-text {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.error-images {
  display: flex;
  justify-content: center;
}

.error-image {
width: 30px;
height: 30px;
margin: 0 10px;
max-width: 200px;
height: auto;
}

.modal {
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
 position: absolute;
 left: 30vh;
 top: 10vh;
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
}

.screenshot-image {
    width: 150px;
    height: 90px;
    border-radius: 4px;
    border: 2px solid whitesmoke;
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
    position: absolute;
    bottom: 5px;
    left: 10px;
    background: white;
}

.display-cover {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 70%;
    margin: 5% auto;
    position: relative;
}

video {
    width: 100%;
    background: rgba(0, 0, 0, 0.2);
}

.video-options {
    position: absolute;
    left: 20px;
    top: 30px;
}

.controls {
    position: absolute;
    right: 20px;
    top: 20px;
    display: flex;
}

.controls > button {
    width: 45px;
    height: 45px;
    text-align: center;
    border-radius: 100%;
    margin: 0 6px;
    background: transparent;
}

.controls > button:hover svg {
    color: white !important;
}

@media (min-width: 300px) and (max-width: 400px) {
    .controls {
        flex-direction: column;
    }

    .controls button {
        margin: 5px 0 !important;
    }
}

.controls > button > svg {
    height: 20px;
    width: 18px;
    text-align: center;
    margin: 0 auto;
    padding: 0;
}

.controls button:nth-child(1) {
    border: 2px solid #D2002E;
}

.controls button:nth-child(1) svg {
    color: #D2002E;
}

.controls button:nth-child(2) {
    border: 2px solid #008496;
}

.controls button:nth-child(2) svg {
    color: #008496;
}

.controls button:nth-child(3) {
    border: 2px solid #00B541;
}

.controls button:nth-child(3) svg {
    color: #00B541;
}

.controls > button {
    width: 45px;
    height: 45px;
    text-align: center;
    border-radius: 100%;
    margin: 0 6px;
    background: transparent;
}

.controls > button:hover svg {
    color: white;
}

.button {
  padding: 15px 25px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
  margin-left: 5em;
}

input.checkboxbig {
  width: 15px;
  height: 15px;
}

.bottom{
  position: fixed;
  bottom: 25px;
  right: 0px;
  z-index: 15;
  width: 40em;
  height: 70px;
  border: 1px solid #333;
  box-shadow: 8px 8px 5px #444;
  padding: 8px 12px;
  background-image: linear-gradient(180deg, #fff, #ddd 40%, #ccc);
}

.dropbtn {
  background-color: white;
  color: white;
  padding: 2px;
  font-size: 16px;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: lime;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: lime;}

</style>
<div id="error-compleet">
<?php 

//Kijk of er een foto_map bestaat als niet error
//echo $_SESSION['foto_map'];
if (
        empty($_SESSION['foto_map'])

          or

          !empty($_SESSION['foto_map']) and !is_dir($_SESSION['foto_map'])

    ) 

{
?>
    <div class="container">
        <div class="error-block">
            <div class="error-images">
                <img src="./images/caution-sign.png" alt="Linker afbeelding" class="error-image" >
                <div class="error-text">
                    Er is geen fotomap gevonden.<?php if (!empty($_SESSION['foto_map'])) {echo "<br>".$_SESSION['foto_map'];};?>
                </div>
                <img src="./images/caution-sign.png" alt="Rechter afbeelding" class="error-image" >
            </div>
        </div>
    </div>
<?php

goto geenfotomap;

};

//$_SESSION['foto_map'] = getcwd() ."/";




//if click button save. save image in huidige datum
if (!empty($_POST['foto']) and strlen($_POST['foto']) > 50 )
{
        
    if ($bestand = fopen( $_SESSION['foto_map'] ."\camera_". date('d-m-Y h i s').".jpg", 'w'))
        {
          //base64_decode($_POST['foto']))
            if(fwrite($bestand, base64_decode(substr($_POST['foto'], 23, strlen($_POST['foto'])-23))) )
            {

              ?><div id="locatiebalk"style="position: absolute; z-index: 4; right: 0px; bottom: 0px"><div class="bottom" style="display:block;"><h2 style="color: black;"><?php echo "Bestand is opgeslagen in: ". $_SESSION['foto_map'] ."camera_". date('d-m-Y h i s').".jpg";?> <img src="./images/productie_gereed.png" width="30" height="20"></h></div></div><?php
              fclose($bestand);    
             
              $imagefile = $_POST['foto'];
              
              
            }
            else
            {
                //help kan niet opslaan
                ?><div><h12 style="color: red;">Error1: iets fout gegaan. Niet opgeslagen<img src="./images/caution-sign.png" width="60" height="50"></h></div><div id="locatiebalk"></div><?php
                
                fclose($bestand);
            }
        }
        else
        {
            ?><div id="locatiebalk"></div><?php
        }
        
    }
    else
    {
        ?><div id="locatiebalk"></div><?php
    }

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body onload="javascript: lsRememberMeonload(); ">
  <!--camera-->
<div class="display-cover">
    <video autoplay></video>
    <canvas class="d-none" style="display:none"></canvas>
    <div class="video-options">
      
    <!--setting dropdown menu-->
    <div class="dropdown">
    <button type="image" class="dropbtn"><img src="../tablet/images/gear_icon.jpg" style="height: 20px; width: 20px; border-radius: 90%;"></button>
    <div class="dropdown-content">
      <div onclick="javascript: toggleautosave()"><a href="#" style="cursor: pointer;"><input type="checkbox" class="checkboxbig" style="font-size: 25px;" id="yesklik" name="yesklik"> <label style="cursor: pointer;" for="yesklik">Autosave</label></a></div>
      <div onclick="javascript: opslagbalk()"><a href="#" style="cursor: pointer;"><input type="checkbox" class="checkboxbig" style="font-size: 25px;" id="opslag_balk" name="opslag_balk"> <label style="cursor: pointer;" for="opslagbalk">Opslag balk</label></a></div>
      <!--
      <div><a href="#">Onbeslist</a></div>
      -->
    </div>
    </div>
        <select id="selectie"  class="custom-select">
            <option value="">Select camera</option>
        </select>
    </div>

    <!--foto-->
    <div id="image_print" onclick="javascript: PrintDiv(screenshotImage); show_modal('fotoupperframe', 'visible'); show_modal('fotocontanger', 'visible'); "><img id="capturefotovandiv" class="screenshot-image d-none" alt="" <?php if (!empty($imagefile)) { echo "src=\"$imagefile\"";};?> ></div>
    
    <!--buttons-->
    <div class="controls">
        <!--niet in gebruik-->
        <button type="image" class="btn btn-danger play" style="display: none;" title="Play">
          <img src="../tablet/images/Play_icon.png" style="height: 30px; width: 30px; border-radius: 90%;">
        </button>
        <button type="image" class="btn btn-info pause d-none" style="display: none;" title="Pause">
          <img src="../tablet/images/Pause_icon.png" style="height: 30px; width: 30px; border-radius: 90%;">
        </button>
      <!--niet in gebruik einde-->
        <button type="image" id="button-screenshot" class="btn btn-outline-success screenshot d-none" title="ScreenShot">
          <img src="../tablet/images/camera_icon.jpg" style="height: 30px; width: 30px; border-radius: 90%;">
        </button>
    </div>
</div>

<!--Mini foto onlick-->
<div id="fotocontanger" class="modal" style="visibility: hidden; z-index: 4; text-align: center;" onclick="javascript: show_modal('fotoupperframe', 'hidden'); javascript: show_modal('fotocontanger', 'hidden')"></div>
<div id="fotoupperframe" class="modal-content" style="visibility: hidden; z-index:5; display: inline-block; min-width: 100px; width: 600px;">
  <div id="image_print" class="fotoupperframe"><img id="capturefotovandiv" class="screenshot-image d-none" style="display: block; margin-left: auto; margin-right: auto;"></div>
</div>
</div>

<!--Javascript-->
<script>
  //achtergrond show_model
  function show_modal(doel, action){
    
    document.getElementById(doel).style.visibility = action; 
}
  
// Selecteer het HTML-video-element opdrachten
const controls = document.querySelector('.controls');
const cameraOptions = document.querySelector('.video-options>select');
const video = document.querySelector('video');
const canvas = document.querySelector('canvas');
const screenshotImage = document.querySelector('#capturefotovandiv');
const buttons = [...controls.querySelectorAll('button')];
let streamStarted = false;
  
// Destructureren van de "buttons" array, waarin alle knopelementen zijn opgeslagen
const [play, pause, screenshot] = buttons;

//video settings
const constraints = {
  video: {
    width: {
      min: 1280,
      ideal: 1920,
      max: 2560,
    },
    height: {
      min: 720,
      ideal: 1080,
      max: 1440
    },
    facingMode: {
      exact: 'environment'
    }
     
  }
};

//beschikbare camera-apparaten?
const getCameraSelection = async () => {
  const devices = await navigator.mediaDevices.enumerateDevices();
  const videoDevices = devices.filter(device => device.kind === 'videoinput');
  const options = videoDevices.map(videoDevice => {
    return `<option id="${videoDevice.deviceId}">${videoDevice.label}</option>`;
  });
  cameraOptions.innerHTML = options.join('');
  //geencamera()
};
  
//gebruik ik niet nu
play.onclick = () => {
  if (streamStarted) {
    video.play();
    play.classList.add('d-none');
    pause.classList.remove('d-none');
    return;
  }
  if ('mediaDevices' in navigator && navigator.mediaDevices.getUserMedia) {
    const updatedConstraints = {
      ...constraints,
      deviceId: {
        exact: cameraOptions.value
      }
    };
    startStream(updatedConstraints);
  }
};
  
//haal een mediastream op van het apparaat van de gebruiker 
const startStream = async (constraints) => {
  const stream = await navigator.mediaDevices.getUserMedia(constraints);
  handleStream(stream);
};
// wijst de mediastream toe aan het srcObject-attribuut van het videoveld. Het verbergt het afspeelknopje, laat het pauzeknopje zien
const handleStream = (stream) => {
  video.srcObject = stream;
  play.classList.add('d-none');
  pause.classList.remove('d-none');
  screenshot.classList.remove('d-none');
  streamStarted = true;
};

getCameraSelection();

cameraOptions.onchange = () => {
  const updatedConstraints = {
    ...constraints,
    deviceId: {
      exact: cameraOptions.value
    }
  };
  startStream(updatedConstraints);
  cameraopslaan();
  
};
  
//Sla de camera op die je hebt gegeven
function cameraopslaan()
      {
        //alert('test');
        localStorage.selectie = document.getElementById("selectie").options[document.getElementById("selectie").selectedIndex].id;
        //geencamera()
        //alert(localStorage.selectie);
      }

      function kiescamerabijladen()
      {
          if (typeof localStorage !== 'string' && localStorage.selectie.length === 0)
          {
            //geencamera();
            //alert('fout');
          }
          else
          {
  		//alert(localStorage.selectie);
              //geencamera()
            //alert(localStorage.selectie);
            document.getElementById(localStorage.selectie).selected = true;

            const updatedConstraints = {
            ...constraints,
            deviceId: {
              exact: cameraOptions.value
            }
          };
          startStream(updatedConstraints);
          
          }
          

      }
//niet in gebruik
const pauseStream = () => {
  video.pause();
  play.classList.remove('d-none');
  pause.classList.add('d-none');
};
//maken van een screenshot van de videostream 
const doScreenshot = () => {
  canvas.width = video.videoWidth;
  canvas.height = video.videoHeight;
  canvas.getContext('2d').drawImage(video, 0, 0);
  screenshotImage.src = canvas.toDataURL('image/webp');
  screenshotImage.classList.remove('d-none');
  doeiets()
};

pause.onclick = pauseStream;
screenshot.onclick = doScreenshot;

//Het blok voor Cancel & Save en foto
function PrintDiv(screenshotImage) {
  //var data=document.getElementById(capturefotovandiv).outerHTML;
  //var myWindow = window.open('', '', 'height=200,width=500');
  //window.location(); height=200,width=500
  var myWindow = 
    
  //image van gemaakte foto
  ("<img style=\"with: 700px; max-height: 250px; display: block; margin-left: auto; margin-right: auto;\" src=\"" + screenshotImage.src +"\">") +
  ('<br> <br> <br> <br>') +
  //Button cancel of save
  ('<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" id="foto"><button type="button" style=" background-color: red; padding: 15px 25px; font-size: 24px; text-align: center; cursor: pointer; outline: none; border: none; border-radius: 15px; box-shadow: 0 9px #999; margin-left: 5em;" onclick="javascript: show_modal(\'fotoupperframe\', \'hidden\'); javascript: show_modal(\'fotocontanger\', \'hidden\')"><b>Cancel</b></button>') +
  ('<input type="hidden" name="foto" value="' + screenshotImage.src +'"> <button type="submit" style="background-color: lime; padding: 15px 25px; font-size: 24px; text-align: center; cursor: pointer; outline: none; border: none; border-radius: 15px; box-shadow: 0 9px #999; margin-left: 5em;"  onclick="javascript: show_modal(\'fotoupperframe\', \'hidden\'); javascript: show_modal(\'fotocontanger\', \'hidden\')"><b>Save</b></button></form>') ;
  document.getElementById("fotoupperframe").innerHTML = myWindow;
  document.getElementById("fotoupperframe").style.visibility = "visible"; 
  document.getElementById("fotocontanger").style.visibility = "visible";

}

//als er camera is dan ga naar cancel & save blok
  function doeiets()
  {
    //alert(' doe iets:' + localStorage.checkbox);
  if(localStorage.checkbox == 1){
    PrintDiv(screenshotImage); show_modal('fotoupperframe', 'hidden'); show_modal('fotocontanger', 'hidden');
    document.getElementById("foto").submit();
  } else {PrintDiv(screenshotImage);}
}
  

//check of autosave gechecked is
function lsRememberMe() {
  //alert('functie');
  if (document.getElementById("yesklik").checked === true) {
    localStorage.checkbox = 1; //alert('wel');

  } else {
    localStorage.checkbox = 0; //alert('niet');
  }
}

//
function lsRememberMeonload() {
 //kijken of autosave/yeskllik is gechecked als niet is dan niks
 kiescamerabijladen();
  if (localStorage.checkbox  == 1) {
    //alert('zet vink aan')
    document.getElementById("yesklik").checked = true;

  } else {
    //alert('zet vink uit')
    document.getElementById("yesklik").checked = false;;
  }
//kijken of opslag_balk is gechecked als niet is dan niks
  if (localStorage.opslag_balk  == 1) {
    //alert('zet vink aan')
    document.getElementById("opslag_balk").checked = true;
    document.getElementById("locatiebalk").style.display = "block";

  } else {
    //alert('zet vink uit')
    document.getElementById("opslag_balk").checked = false;;
    document.getElementById("locatiebalk").style.display = "none";
  }

}

//voor de autosave checkbox
function toggleautosave()
{
  
  if (localStorage.checkbox == 1) {
    localStorage.checkbox = 0; //alert('uit');
    document.getElementById("yesklik").checked = false;
  } else {
    localStorage.checkbox = 1; //alert('aan');
    document.getElementById("yesklik").checked = true;
  }
  lsRememberMe();

  
};
  
//opslagbalk/informatiebalk
function opslagbalk()
{
  
  if (localStorage.opslag_balk == 1) {
    localStorage.opslag_balk = 0; //alert('uit');
    document.getElementById("opslag_balk").checked = false;
  } else {
    localStorage.opslag_balk = 1; //alert('aan');
    document.getElementById("opslag_balk").checked = true;
  }
  lsRememberMeonload() ;
};

//als geen 2 camera's zijn dan error 
//document.getElementById("selectie").style.visibility = "hidden";
function geencamera()
{
if ( document.getElementById("selectie").options.length < 2)
{

   document.getElementById("error-compleet").innerHTML = "<div class=\"container\">"+
        "<div class=\"error-block\">"+
            "<div class=\"error-images\">"+
                "<img src=\"./images/caution-sign.png\" alt=\"Linker afbeelding\" class=\"error-image\" >"+
                "<div class=\"error-text\">"+
                    "Geen bruikbare camera gevonden."+
               " </div>"+
             "   <img src=\"./images/caution-sign.png\" alt=\"Rechter afbeelding\" class=\"error-image\" >"+ 
           " </div>         </div>    </div>";
    //alert('Geen bruikbare camera gevonden.');
    };
}
</script>
</body>
</html>
<?php
geenfotomap:
?>
