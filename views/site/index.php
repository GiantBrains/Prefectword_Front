<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */

$this->title = 'Verified Professors - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers.';
$description = "Verified Professors - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers";
$title = $this->title;
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'Ask a writer to do your assignment at a cheap price. We are the best and most trusted custom essay writers online.
     We deliver before deadline.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => 'Custom essay,essay help, research paper, free essays, write my essay, best essay writers,extra credit paper, plagiarism free, 
    online essay writing,great paper, cheap, best writing website, Free cover page, Need to pass, Write my dissertation, Paper is due, Hate doing assignments, Professional essay writers, Online A+ essays'
]);

$val = 'Africa/Nairobi';

$myscript = <<< JS
  $(document).ready(function(){
      	$('.numbers-with-commas').counterUp({
        delay: 10, // the delay time in ms
        time: 1000 // the speed time in ms
        });

         moment().format('MMMM Do YYYY, h:mm:ss a');
            var myservice = 8;
            var mytype = 1;
            var myurgency = 1;
            var mypages = 1;
            var mylevel = 1;
        $('#frontorder-service_id').change('focusin', function(){
            order_service = parseInt($(this).val());
            
            if(order_service===1){
                myservice = 8;
            }else if(order_service===2){
                myservice = 6;
            }else if(order_service===3){
                myservice = 5;
            }
            $('#min-amount').val('$'+(myservice*mytype*myurgency*mypages*mylevel).toFixed(2));
        });
        $("#frontorder-type_id").change('focusin', function(){
               typeoforder = parseInt($(this).val());
                 if(typeoforder===1){
                mytype = 1.2;
                }else if (typeoforder===2){
                 mytype = 1.2;      
                }else if (typeoforder===3){
                 mytype = 1.2;      
                }else if (typeoforder===4){
                 mytype = 1.2;      
                }else if (typeoforder===5){
                 mytype = 1.2;      
                 }else if (typeoforder===6){
                 mytype = 1.2;      
                 }else if (typeoforder===7){
                 mytype = 1.2;      
                 }else if (typeoforder===8){
                 mytype = 1.2;      
                 }else if (typeoforder===9){
                 mytype = 1.2;      
                 }else if (typeoforder===10){
                 mytype = 1.2;      
                 }else if (typeoforder===11){
                 mytype = 1.2;      
                 }else if (typeoforder===12){
                 mytype = 1.2;      
                 }else if (typeoforder===13){
                 mytype = 1.2;      
                 }else if (typeoforder===14){
                 mytype = 1.2;      
                 }else if (typeoforder===15){
                 mytype = 1.2;      
                 }else if (typeoforder===16){
                 mytype = 1.2;      
                 }else if (typeoforder===17){
                 mytype = 1.2;      
                 }else if (typeoforder===18){
                 mytype = 1.2;      
                 }else if (typeoforder===20){
                 mytype = 1.2;      
                 }else if (typeoforder===22){
                 mytype = 2.0;      
                 }else if (typeoforder===23){
                 mytype = 2.2;      
                 }else if (typeoforder===24){
                 mytype = 1.5;      
                 }else if (typeoforder===25){
                 mytype = 1.2;      
                 }else if (typeoforder===26){
                 mytype = 1.2;      
                 }else if (typeoforder===27){
                 mytype = 0.7;      
                 }else if (typeoforder===28){
                 mytype = 0.8;      
                 }else if (typeoforder===31){
                 mytype = 1.2;      
                 }else if (typeoforder===32){
                 mytype = 1.2;      
                 }else if (typeoforder===33){
                 mytype = 1.2;      
                 }else if (typeoforder===34){
                 mytype = 1.2;      
                 }else if (typeoforder===35){
                 mytype = 2.2;      
                 }else if (typeoforder===36){
                 mytype = 1.2;      
                 }else if (typeoforder===37){
                 mytype = 1.2;      
                 }else if (typeoforder===38){
                 mytype = 1.2;      
                 }else if (typeoforder===39){
                 mytype = 1.5;      
                 }else if (typeoforder===40){
                 mytype = 1.2;      
                  }else if (typeoforder===41){
                 mytype = 1.4;      
                  }else if (typeoforder===42){
                 mytype = 1.4;      
                 }else if (typeoforder===43){
                 mytype = 1.4;      
                 }else if (typeoforder===44){
                 mytype = 1.3;      
                 }else if (typeoforder===45){
                 mytype = 1.2;      
                 }                                                       
                $('#min-amount').val('$'+(myservice*mytype*myurgency*mypages*mylevel).toFixed(2));
        });
        $("#frontorder-urgency_id").change('focusin', function(){
                order_urgency = parseInt($(this).val());
                
                if(order_urgency===1){
                myurgency = 2.5;
                }else if (order_urgency===2){
                 myurgency = 2.0;      
                }else if (order_urgency===3){
                 myurgency = 1.8;      
                }else if (order_urgency===4){
                 myurgency = 1.6;      
                }else if (order_urgency===5){
                 myurgency = 1.5;      
                }else if (order_urgency===6){
                 myurgency = 1.4;      
                }else if (order_urgency===7){
                 myurgency = 1.3;      
                }else if (order_urgency===8){
                 myurgency = 1.2;      
                }else if (order_urgency===9){
                 myurgency = 1.2;      
                }else if (order_urgency===10){
                 myurgency = 1.1;      
                }else if (order_urgency===11){
                 myurgency = 1.1;      
                }else if (order_urgency===12){
                 myurgency = 1.1;      
                }else if (order_urgency===13){
                 myurgency = 1.0;      
                }else if (order_urgency===14){
                 myurgency = 1.0;      
               }else if (order_urgency===15){
                 myurgency = 1.0;      
                }
                $('#min-amount').val('$'+(myservice*mytype*myurgency*mypages*mylevel).toFixed(2));
        });
         $('#frontorder-pages_id').change('focusin', function(){
                order_pages = parseInt($(this).val());
                if(order_pages===1){
                    mypages = 1;
                }else if(order_pages===2){
                    mypages=2*0.95;
                }else if(order_pages===3){
                    mypages= 3*0.95;
                 }else if(order_pages===4){
                    mypages=4*0.95;
                }else if(order_pages===5){
                    mypages= 5*0.95;
                 }else if(order_pages===6){
                    mypages=6*0.925;
                }else if(order_pages===7){
                    mypages= 7*0.925;
                }else if(order_pages===8){
                    mypages=8*0.925;
                }else if(order_pages===9){
                    mypages= 9*0.925;
                 }else if(order_pages===10){
                    mypages=10*0.9;
                }else if(order_pages===11){
                    mypages= 11*0.9;
                 }else if(order_pages===12){
                    mypages=12*0.9;
                }else if(order_pages===13){
                    mypages= 13*0.9;
                }else if(order_pages===14){
                    mypages=14*0.9;
                }else if(order_pages===15){
                    mypages= 15*0.9;
                }else if(order_pages===16){
                    mypages=16*0.9;
                }else if(order_pages===17){
                    mypages= 17*0.9;
                }else if(order_pages===18){
                    mypages=18*0.9;
                }else if(order_pages===19){
                    mypages= 19*0.9;
                }else if(order_pages===20){
                    mypages=20*0.9;
                }else if(order_pages===21){
                    mypages= 21*0.85;
                 }else if(order_pages===22){
                    mypages=22*0.85;
                }else if(order_pages===23){
                    mypages= 23*0.85;
                 }else if(order_pages===24){
                    mypages=24*0.85;
                }else if(order_pages===25){
                    mypages= 25*0.85;
                }else if(order_pages===26){
                    mypages=26*0.85;
                }else if(order_pages===27){
                    mypages= 27*0.85;
                }else if(order_pages===28){
                    mypages=28*0.85;
                }else if(order_pages===29){
                    mypages= 29*0.85;
                }else if(order_pages===30){
                    mypages=30*0.85;
                }else if(order_pages===31){
                    mypages= 31*0.85;
                }else if(order_pages===32){
                    mypages=32*0.85;
                }else if(order_pages===33){
                    mypages= 33*0.85;
                 }else if(order_pages===34){
                    mypages=34*0.85;
                }else if(order_pages===35){
                    mypages= 35*0.85;
                 }else if(order_pages===36){
                    mypages=36*0.85;
                }else if(order_pages===37){
                    mypages= 37*0.85;
                }else if(order_pages===38){
                    mypages=38*0.85;
                }else if(order_pages===39){
                    mypages= 39*0.85;
                 }else if(order_pages===40){
                    mypages=40*0.85;
                }else if(order_pages===41){
                    mypages= 41*0.85;
                 }else if(order_pages===42){
                    mypages=42*0.85;
                }else if(order_pages===43){
                    mypages= 43*0.85;
                }else if(order_pages===44){
                    mypages=44*0.85;
                }else if(order_pages===45){
                    mypages= 45*0.85;
                 }else if(order_pages===46){
                    mypages=46*0.85;
                }else if(order_pages===47){
                    mypages=47*0.85;
                 }else if(order_pages===48){
                    mypages=48*0.85;
                }else if(order_pages===49){
                    mypages= 49*0.85;
                }else if(order_pages===50){
                    mypages=50*0.85;
                }else if(order_pages===51){
                    mypages= 51*0.85;
                 }else if(order_pages===52){
                    mypages=52*0.85;
                }else if(order_pages===53){
                    mypages= 53*0.85;
                 }else if(order_pages===54){
                    mypages=54*0.85;
                }else if(order_pages===55){
                    mypages= 55*0.85;
                }else if(order_pages===56){
                    mypages=56*0.85;
                }else if(order_pages===57){
                    mypages= 57*0.85;
                 }else if(order_pages===58){
                    mypages=58*0.85;
                }else if(order_pages===59){
                    mypages= 59*0.85;
                 }else if(order_pages===60){
                    mypages=60*0.85;
                }else if(order_pages===61){
                    mypages= 61*0.85;
                }else if(order_pages===62){
                    mypages=62*0.85;
                }else if(order_pages===63){
                    mypages= 63*0.85;
                 }else if(order_pages===64){
                    mypages=64*0.85;
                }else if(order_pages===65){
                    mypages= 65*0.85;
                 }else if(order_pages===66){
                    mypages=66*0.85;
                }else if(order_pages===67){
                    mypages= 67*0.85;
                }else if(order_pages===68){
                    mypages=68*0.85;
                }else if(order_pages===69){
                    mypages= 69*0.85;
                 }else if(order_pages===70){
                    mypages=70*0.85;
                }else if(order_pages===71){
                    mypages= 71*0.85;
                 }else if(order_pages===72){
                    mypages=72*0.85;
                }else if(order_pages===73){
                    mypages= 73*0.85;
                }else if(order_pages===74){
                    mypages=74*0.85;
                }else if(order_pages===75){
                    mypages= 75*0.85;
                 }else if(order_pages===76){
                    mypages=76*0.85;
                }else if(order_pages===77){
                    mypages= 77*0.85;
                 }else if(order_pages===78){
                    mypages=78*0.85;
                }else if(order_pages===79){
                    mypages= 79*0.85;
                }else if(order_pages===80){
                    mypages=80*0.85;
                }else if(order_pages===81){
                    mypages= 81*0.85;
                 }else if(order_pages===82){
                    mypages=82*0.85;
                }else if(order_pages===83){
                    mypages= 83*0.85;
                 }else if(order_pages===84){
                    mypages=84*0.85;
                }else if(order_pages===85){
                    mypages= 85*0.85;
                }else if(order_pages===86){
                    mypages=86*0.85;
                }else if(order_pages===87){
                    mypages= 87*0.85;
                 }else if(order_pages===88){
                    mypages=88*0.85;
                }else if(order_pages===89){
                    mypages= 89;
                 }else if(order_pages===90){
                    mypages=90*0.85;
                }else if(order_pages===91){
                    mypages= 91*0.85;
                }else if(order_pages===92){
                    mypages=92*0.85;
                }else if(order_pages===93){
                    mypages= 93*0.85;
                 }else if(order_pages===94){
                    mypages=94*0.85;
                }else if(order_pages===95){
                    mypages= 95*0.85;
                 }else if(order_pages===96){
                    mypages=96*0.85;
                }else if(order_pages===97){
                    mypages= 97*0.85;
                }else if(order_pages===98){
                    mypages=98*0.85;
                }else if(order_pages===99){
                    mypages= 99*0.85;
                 }else if(order_pages===100){
                    mypages=100*0.85;
                }else if(order_pages===101){
                    mypages= 101*0.85;
                 }else if(order_pages===102){
                    mypages=102*0.85;
                }else if(order_pages===103){
                    mypages= 103*0.85;
                }else if(order_pages===104){
                    mypages=104*0.85;
                }else if(order_pages===105){
                    mypages= 105*0.85;
                 }else if(order_pages===106){
                    mypages=106*0.85;
                }else if(order_pages===107){
                    mypages= 107*0.85;
                 }else if(order_pages===108){
                    mypages=108*0.85;
                }else if(order_pages===109){
                    mypages= 109*0.85;
                }else if(order_pages===110){
                    mypages=110*0.85;
               }else if(order_pages===111){
                    mypages= 111*0.85;
                 }else if(order_pages===112){
                    mypages=112*0.85;
                }else if(order_pages===113){
                    mypages= 113*0.85;
                }else if(order_pages===114){
                    mypages=114*0.85;
                }else if(order_pages===115){
                    mypages= 115*0.85;
                 }else if(order_pages===116){
                    mypages=116*0.85;
                }else if(order_pages===117){
                    mypages= 117*0.85;
                 }else if(order_pages===118){
                    mypages=118*0.85;
                }else if(order_pages===119){
                    mypages= 119*0.85;
                }else if(order_pages===120){
                    mypages=120*0.85;
               }else if(order_pages===121){
                    mypages= 121*0.85;
                 }else if(order_pages===122){
                    mypages=122*0.85;
                }else if(order_pages===123){
                    mypages= 123*0.85;
                }else if(order_pages===124){
                    mypages=124*0.85;
                }else if(order_pages===125){
                    mypages= 125*0.85;
                 }else if(order_pages===126){
                    mypages=126*0.85;
                }else if(order_pages===127){
                    mypages= 127*0.85;
                 }else if(order_pages===128){
                    mypages=128*0.85;
                }else if(order_pages===129){
                    mypages= 129*0.85;
                }else if(order_pages===130){
                    mypages=130*0.85;
                }else if(order_pages===131){
                    mypages= 131*0.85;
                 }else if(order_pages===132){
                    mypages=132*0.85;
                }else if(order_pages===133){
                    mypages= 133*0.85;
                }else if(order_pages===134){
                    mypages=134*0.85;
                }else if(order_pages===135){
                    mypages= 135*0.85;
                 }else if(order_pages===136){
                    mypages=136*0.85;
                }else if(order_pages===137){
                    mypages= 137*0.85;
                 }else if(order_pages===138){
                    mypages=138*0.85;
                }else if(order_pages===139){
                    mypages= 139*0.85;
                }else if(order_pages===140){
                    mypages=140*0.85;
                 }else if(order_pages===141){
                    mypages= 141*0.85;
                 }else if(order_pages===142){
                    mypages=142*0.85;
                }else if(order_pages===143){
                    mypages= 143*0.85;
                }else if(order_pages===144){
                    mypages=144*0.85;
                }else if(order_pages===145){
                    mypages= 145*0.85;
                 }else if(order_pages===146){
                    mypages=146*0.85;
                }else if(order_pages===147){
                    mypages= 147*0.85;
                 }else if(order_pages===148){
                    mypages=148*0.85;
                }else if(order_pages===149){
                    mypages= 149*0.85;
                }else if(order_pages===150){
                    mypages=150*0.85;
                 }else if(order_pages===151){
                    mypages= 151*0.85;
                 }else if(order_pages===152){
                    mypages=152*0.85;
                }else if(order_pages===153){
                    mypages= 153*0.85;
                }else if(order_pages===154){
                    mypages=154*0.85;
                }else if(order_pages===155){
                    mypages= 155*0.85;
                 }else if(order_pages===156){
                    mypages=156*0.85;
                }else if(order_pages===157){
                    mypages= 157*0.85;
                 }else if(order_pages===158){
                    mypages=158*0.85;
                }else if(order_pages===159){
                    mypages= 159*0.85;
                }else if(order_pages===160){
                    mypages=160*0.85;
                 }else if(order_pages===161){
                    mypages= 161*0.85;
                 }else if(order_pages===162){
                    mypages=162*0.85;
                }else if(order_pages===163){
                    mypages= 163*0.85;
                }else if(order_pages===164){
                    mypages=164*0.85;
                }else if(order_pages===165){
                    mypages= 165*0.85;
                 }else if(order_pages===166){
                    mypages=166*0.85;
                }else if(order_pages===167){
                    mypages= 167*0.85;
                 }else if(order_pages===168){
                    mypages=168*0.85;
                }else if(order_pages===169){
                    mypages= 169*0.85;
                }else if(order_pages===170){
                    mypages=170*0.85;
                }else if(order_pages===171){
                    mypages= 171*0.85;
                 }else if(order_pages===172){
                    mypages=172*0.85;
                }else if(order_pages===173){
                    mypages= 173*0.85;
                }else if(order_pages===174){
                    mypages=174*0.85;
                }else if(order_pages===175){
                    mypages= 175*0.85;
                 }else if(order_pages===176){
                    mypages=176*0.85;
                }else if(order_pages===177){
                    mypages= 177*0.85;
                 }else if(order_pages===178){
                    mypages=178*0.85;
                }else if(order_pages===179){
                    mypages= 179*0.85;
                }else if(order_pages===180){
                    mypages=180*0.85;
                 }else if(order_pages===181){
                    mypages= 181*0.85;
                 }else if(order_pages===182){
                    mypages=182*0.85;
                }else if(order_pages===183){
                    mypages= 183*0.85;
                }else if(order_pages===184){
                    mypages=184*0.85;
                }else if(order_pages===185){
                    mypages= 185*0.85;
                 }else if(order_pages===186){
                    mypages=186*0.85;
                }else if(order_pages===187){
                    mypages= 187*0.85;
                 }else if(order_pages===188){
                    mypages=188*0.85;
                }else if(order_pages===189){
                    mypages= 189*0.85;
                }else if(order_pages===190){
                    mypages=190*0.85;
                 }else if(order_pages===191){
                    mypages= 191*0.85;
                 }else if(order_pages===192){
                    mypages=192*0.85;
                }else if(order_pages===193){
                    mypages= 193*0.85;
                }else if(order_pages===194){
                    mypages=194*0.85;
                }else if(order_pages===195){
                    mypages= 195*0.85;
                 }else if(order_pages===196){
                    mypages=196*0.85;
                }else if(order_pages===197){
                    mypages= 197*0.85;
                 }else if(order_pages===198){
                    mypages=198*0.85;
                }else if(order_pages===199){
                    mypages= 199*0.85;
                }else if(order_pages===200){
                    mypages=200*0.85;
               }
               
                $('#min-amount').val('$'+(myservice*mytype*myurgency*mypages*mylevel).toFixed(2));
        });
          $('#frontorder-level_id').change('focusin', function(){
                order_level = parseInt($(this).val());
                
                if(order_level===1){
                    mylevel = 1;
                }else if(order_level===2){
                    mylevel=1.2;
                }else if(order_level===4){
                    mylevel= 1.3;
                 }else if(order_level===5){
                    mylevel= 1.5;
                }
                $('#min-amount').val('$'+(myservice*mytype*myurgency*mypages*mylevel).toFixed(2));
        });
    });

    $(".home-slider").slick({
        dots: true,
        infinite: true,
        speed: 1000,
        fade: true,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        prevArrow: false,
        nextArrow: false
    });
JS;
$this->registerJs($myscript);
?>

<?php $this->beginBlock('block5'); ?>
<meta property="og:site_name" content="Verified Professors">
<meta property="og:type" content="Education">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta property="og:url" content="https://www.verifiedprofessors.com">
<meta property="og:locale" content="en_UK">
<meta property="og:locale:alternate" content="en_US">
<!-- Twitter -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@verifiedprofessors"/>
<!--                <meta name="twitter:creator" content="@tonigitz" />-->
<meta name="twitter:title" content="<?= $title ?>">
<meta name="twitter:description" content="<?= $description ?>">
<meta name="twitter:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta name="twitter:url" content="https://www.verifiedprofessors.com">
<link href="https://fonts.googleapis.com/css2?family=Ranchers&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Philosopher:ital@1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="slick/slick.min.js"></script>
<style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width: 70%;
        margin: auto;
    }
</style>


<?php $this->endBlock(); ?>
<div class="site-index1" style="background: url('images/edited-cover-photo2.jpg');">
    <div class="container" style="z-index: 100; color: white;">
        <?php Yii::$app->timezone->name ?>
        <div class="row superslide">
            <div class="col-md-6 col-xs-12 hidden-xs"
                 style="background-color:white; opacity: 0.8; border-radius:10px; border-bottom-right-radius: 200px; color: black">
                <div class="image-content" style="margin-bottom:20px; ">
                    <h1 style="font-size: 40px; font-weight:bolder;">Get High-quality Paper</h1>
                    <h2 style="font-size: 40px; font-weight:bolder;">At an Affordable Price.</h2>
                    <h4 style="font-size: 25px; font-weight:bolder;">Hire us, sit back and
                        relax…….We’ll do it for you.</h4>
                    <h3>Our professional
                        Essay Writing Service is ready to help you out! Get a plagiarism-free
                        paper starting at $8 per page.
                    </h3><br>
                    <div class="row">
                    <div class="col-md-6 col-xs-12">
                        <button  class="btn btn-info btn-lg essay-font" style="color: white">
                        Order Now
                        </button>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <h3 style="color:#1695a4; margin-left: -40px; margin-top: -5px"><strong>100% Plagiarism-Free Essays.</strong></h3>
                    </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">

                    <?php $form = ActiveForm::begin(['layout' => 'horizontal',
                        'action' => Url::to(['frontorder/details']),
                        'fieldConfig' => [
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label' => 'col-sm-4',
                                'wrapper' => 'col-sm-8',
                                'error' => '',
                                'hint' => '',
                            ],
                        ],
                    ]);
                    ?>
                    <div class="row">
                        <div class="col-md-5">

                        </div>
                        <div class="col-md-7 col-sm-7 col-xs-12"
                             style="background-color: white; opacity: 0.8; border-radius: 10px; color:black">
                            <h3><strong>Calculate the Price</strong></h3>
                            <?= $form->field($fmodel, 'service_id', [
                                'template' => '<div style="font-family: \'Open Sans\', sans-serif; ">{label}</div> <div style=" padding: 0 5px 0 5px;" class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                            ])->label('Service')->dropDownList(\app\models\Service::getServices(),
                                ['options' => [1 => ['Selected' => 'selected'], 'prompt' => '...select Service....', 'id' => 'service-id']]) ?>

                            <?= $form->field($fmodel, 'type_id', [
                                'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style=" padding: 0 5px 0 5px;"  class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                            ])->label('Paper Type')->dropDownList(\app\models\Type::getTypes(),
                                ['options' => [20 => ['Selected' => 'selected'], 'prompt' => '...select Type....', 'id' => 'type-id']]) ?>

                            <?= $form->field($fmodel, 'urgency_id', [
                                'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style=" padding: 0 5px 0 5px;"  class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                            ])->label('Urgency')->dropDownList(\app\models\Urgency::getUrgency(), [
                                'options' => [12 => ['Selected' => 'selected'], 'prompt' => '...select Deadline....', 'id' => 'urgency-id']]) ?>

                            <?= $form->field($fmodel, 'pages_id', [
                                'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style="padding: 0 5px 0 5px;" class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                            ])->label('Pages')->dropDownList(\app\models\Pages::getPages(), [
                                'options' => [1 => ['Selected' => 'selected'], 'prompt' => '...select Pages....', 'id' => 'pages-id']]) ?>

                            <?= $form->field($fmodel, 'level_id', [
                                'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style="padding: 0 5px 0 5px;" class="row"><div  class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                            ])->label('Level')->dropDownList(\app\models\Level::getLevels(), [
                                'options' => [1 => ['Selected' => 'selected'], 'prompt' => '...select Level....', 'id' => 'level-id']]) ?>
                            <div class="form-group" style="margin-left: 40px">
                                <h3 style="margin-top: -10px;" class="essay-font">Price:&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?= Yii::$app->request->baseUrl ?>/images/fire.png"
                                                                                                                     width="30px"><input class="tcost"
                                                                                                       style="border: none; width: 100px"
                                                                                                       type="text"
                                                                                                       id="min-amount"
                                                                                                       value="$8.00"
                                                                                                       readonly="readonly">
                                </h3>
                            </div>
                            <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                                <?= Html::submitButton('Continue', ['class' => 'btn btn-lg btn-block btn-info', 'style' => 'font-family: \'Open Sans\', sans-serif; margin-bottom: 20px;']) ?>
                            </div>
                        </div>
                    </div>
                    <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="body-container essay-font" style="height: auto; margin-bottom: 20px; background-color: #f0f2f6">
        <div class="container">
            <h2 class="essay-font" style="font-weight:bolder; text-align: center;">HOW IT WORKS</h2>
        <center>
            <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="row">
                        <div class="col-md-8 essay-font hidden-xs">
                            <button style="border-radius: 30px;font-weight: bolder;  background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                                PLACE ORDER
                            </button>
                            <p style="vertical-align: middle">Place your order</p>
                        </div>
                        <div class="hidden-md hidden-lg hidden-sm">
                        <button style="border-radius: 30px; background-color: #4DD1F4; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                            PLACE ORDER
                        </button>
                        <p class="hidden-md hidden-lg hidden-sm">PLACE YOUR ORDER</p>
                        </div>
                        <div class="col-md-4 col-sm-2 col-xs-12">
                            <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                               class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                            <i class="fa fa-arrow-down text-success fa-3x hidden-md hidden-lg hidden-sm "
                               aria-hidden="true"></i>
                        </div>
                    </div>
            </div>
        </center>
        <center>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="row">
                    <div class="col-md-8 essay-font hidden-xs">
                        <button style="border-radius: 30px; font-weight: bolder; background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                            PREPARATION
                        </button>
                        <p style="vertical-align: middle">The writer prepares sources for your work</p>
                    </div>
                    <div class="hidden-md hidden-lg hidden-sm">
                    <button style="border-radius: 30px; background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                        PREPARATION
                    </button>
                    <p class="hidden-md hidden-lg hidden-sm">The writer prepares sources for your work</p>
                    </div>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                           class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down fa-3x text-success hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                    </div>
                </div>
        </center>
        <center>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="row">
                    <div class="col-md-8 essay-font hidden-xs">
                        <button style="border-radius: 30px;font-weight: bolder; background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                            COMPLETION
                        </button>
                        <p style="vertical-align: middle">The writer completes your paper</p>
                    </div>
                    <div class="hidden-md hidden-lg hidden-sm">
                    <button style="border-radius: 30px; background-color: #71D8EC; background-color: #71D8EC; font-family: 'Philosopher', sans-serif;" type="button" class="btn btn-lg essay-font">
                        COMPLETION
                    </button>
                    <p class="hidden-md hidden-lg hidden-sm">The writer completes your paper</p>
                    </div>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                           class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down fa-3x text-success hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </center>
        <center>
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="row">
                    <div class="col-md-8 essay-font hidden-xs">
                        <button style="border-radius: 30px; font-weight: bolder; background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                            POLISHING
                        </button>
                        <p style="vertical-align: middle">The writer polishes your paper</p>
                    </div>
                    <div class="hidden-md hidden-lg hidden-sm">
                    <button style="border-radius: 30px; background-color: #71D8EC; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;" type="button" class="btn btn-lg essay-font">
                        POLISHING
                    </button>
                    <p>The writer polishes your paper</p>
                    </div>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i style="margin-bottom: 80px; vertical-align: middle;color: #1e7e34"
                        class="fa fa-check-circle fa-5x hidden-xs" aria-hidden="true"></i></i>
                        <i class="fa fa-arrow-down fa-3x text-success hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                        <h3 style="font-family: 'Philosopher', sans-serif" class="hidden-md hidden-lg hidden-sm">You Receive your Work</h3>
                    </div>
                </div>
            </div>
        </center>
    </div>
</div>

<div class="body-container essay-font" style="background-color: white; font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;line-height: 2.0">
        <div class="container">
            <div class="col-md-4 col-sm-4">
                <h2><strong>Moneyback Guarantee</strong></h2>
                <p>We are a company that values our image and credibility.
                    Excellent customer experience and satisfaction are our primary goal and we work hard to achieve it.
                    We refund back your money in case you are not satisfied with the service offered.

                    We allow you to reserve the payment for your writer until you receive the paper and confirm that it meets your expectations.
                    You are free to cancel your order and still get back your money. Please remember to read our <a href="<?= Url::to(['site/terms_and_conditions']) ?>">Terms and Conditions.</a></p>
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/page/money-back-guarantee2.png"
                             width="222px"></center>
                <center><a href="<?= Url::to(['site/guarantee']) ?>">
                        <button style="color: white; border-radius: 30px; background-color: #1695a4" type="button" class="btn btn-lg essay-font">
                            Money back guarantee
                        </button>
                    </a></center>
                <br>
            </div>
            <div class="col-md-8 col-sm-4">
                <center><h2 style="font-weight: bolder">Who we are</h2></center>
                <p>Verified Professors is a reliable partner for professional freelance writers with experience in
                    students papers to provide high quality papers for our clients. We have an open reviews section
                    where our customers give us feedback on their experience with us. It is easy to judge yourself
                    from the reviews how satisfied our clients are with the service. You do not have to spend
                    sleepless nights thinking of how you will improve your grade. Let us do it essay for you while
                    you do other duties.
                </p>
                <center><h2><strong>24/7 Customer Support</strong></h2><br>
                    <p>With a team of experienced writers from native English speaking countries, we promise to
                        deliver quality work to you on time. Our writers highly qualified and available 24/7 to
                        handle projects regardless of the deadline or the difficulty. We guarantee 0% plagiarism
                        in all papers, ensure all papers are written from scratch and penalize any writer who tries
                        to deliver plagiarized writing to you. All revisions are free until you are 100% satisfied
                        with your paper.</p>
                    <h1 style="font-size: 100px; color: #3D715B"><strong>98.9%</strong></h1>
                </center>

                <h1
            </div>
        </div>
    </div>

<div class="body-container essay-font hidden-xs" style="background-color: #f0f2f6;">
        <div class="container" style="z-index: 100;">
            <div class="row" style="margin-top: 20px;margin-bottom: 30px;">
                <center>
                    <h1><strong>Professional Essay Writers Team</strong></h1>
                <p class="col-sm-6 col-sm-offset-3">At Verified Professors, we employ a large team of skilled writers. Their rating is based on previous
                    customer reviews and rates.
                    Before you hire a writer, you can familiarize yourself with his track record in detail.</p>
                </center>
                <div class="col-sm-3 col-xs-12"
                     style="background-color: white; margin-left: 130px; opacity: 0.8; border-radius: 10px; color: black">
                    <center>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/olivia.jpg" width="50px" style="margin-top: 20px; border-radius: 50px">
                    <h3>Tutor Olivia Fendi</h3>
                    <p>Professional Academic Writer</p>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/rating.png" width="100px" style="margin-top: -10px">
                    <hr>
                        <div class="col-sm-4 writters writters-items">5724<br>ORDERS</div>
                        <div class="col-sm-4 writters writters-items">100%<br>SUCCESS</div>
                        <div class="col-sm-4 writters">5.0<br>RATING</div>
                    </center>
                </div>
                <div class="col-sm-3 col-xs-12"
                     style="background-color: white; margin-left: 20px; opacity: 0.8; border-radius: 10px; color: black">
                    <center>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/img2" width="60px" style="margin-top: 20px; border-radius: 50px">
                    <h3>Tutor Meghan Jones</h3>
                    <p>Professional Academic Writer</p>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/rating.png" width="100px" style="margin-top: -10px">
                    <hr>
                        <div class="col-sm-4 writters writters-items">5724<br>ORDERS</div>
                        <div class="col-sm-4 writters writters-items">100%<br>SUCCESS</div>
                        <div class="col-sm-4 writters ">5.0<br>RATING</div>
                        <br>
                    </center>
                </div>
                <div class="col-sm-3 col-xs-12" style="background-color: white;margin-left: 20px; opacity: 0.8; border-radius: 10px; color: black">
                    <center>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/img3" width="60px" style="margin-top: 20px; border-radius: 50px">
                    <h3>Tutor Steve Darron</h3>
                    <p>Professional Academic Writer</p>
                    <img src="<?= Yii::$app->request->baseUrl ?>/images/rating.png" width="100px" style="margin-top: -10px">
                    <hr>
                        <div class="col-sm-4 writters writters-items">5724<br>ORDERS</div>
                        <div class="col-sm-4 writters writters-items">100%<br>SUCCESS</div>
                        <div class="col-sm-4 writters">5.0<br>RATING</div>
                    </center>
                </div>
            </div>
    </div>
</div>

<div class="body-container essay-font" style="background-color: #3D715B">
    <div class="container">
        <div class="row" style="height: auto; color: #69D9F4;margin-top: 10px">
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/approved.png"></center>
                <h1 class="numbers-with-commas"
                    style="color:white; font-size: 60px; font-weight: 900; text-align: center"><?= number_format(floatval($allorders), 0, '.', ',') ?></h1>
                <h5 style="color:white; text-align: center">COMPLETED ORDERS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/tick.png"></center>
                <h1 class="numbers-with-commas" style="color:white; font-size: 60px; font-weight: 900; text-align: center">457</h1>
                <h5 style="color:white; text-align: center">SATISFIED CLIENTS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/satisfied.png"></center>
                <h1 style="color:white; font-size: 60px; font-weight: 900; text-align: center">98.64<sup>%</sup></h1>
                <h5 style="color:white; text-align: center;">POSITIVE FEEDBACKS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img width="80px" style="border-radius: 60px" src="<?= Yii::$app->request->baseUrl ?>/images/slides/rep.jpg"></center>
                <h1 class="numbers-with-commas" style="color:white; font-size: 60px; font-weight: 900; text-align: center">8</h1>
                <h5 style="color:white; text-align: center">SUPPORT REPRESENTATIVES</h5>
            </div>
        </div>
    </div>
</div>

<div class="body-container essay-font hidden-xs" style="background-color: whitesmoke;">
            <div class="container">
            <div class="row" style="height: auto; margin-bottom: 20px;">
                <h2 style="font-weight:bolder; text-align: center; color: black;font-family: "Lato", -apple-system, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif;">WHY CHOOSE US</h2>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                        <img width="70px" style="margin-left:20px; border-radius: 30px; margin-top:10px;"
                             src="<?= Yii::$app->request->baseUrl ?>/images/slides/sms.png">
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none; color: black;">
                            <li>
                                <h4 style="color: #4DD1F4; font-weight: bolder">QUALITY</h4>
                                <p>You get an original and high-quality paper based on extensive research.
                                    The completed work will be correctly formatted, referenced and tailored to your level of study.</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                    <center><img width="65px" style="margin-left:20px; border-radius: 30px; margin-top:10px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/format.png"></center>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none;color: black;">
                        <li>
                            <h4 style="color: #4DD1F4; font-weight: bolder">ON-TIME DELIVERY</h4>
                            <p>We strive to deliver quality custom written papers before the deadline.
                                That's why you don't have to worry about missing the deadline for submitting your assignment.</p>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                    <center><img width="80px" style="margin-left:20px; border-radius: 30px; margin-top:10px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/confidential.jpg"></center>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none; color: black;">
                        <li>
                            <h4 style="color: #4DD1F4; font-weight: bolder">CONFIDENTIALITY</h4>
                            <p>We value your privacy. We do not disclose your personal information to any third party without your consent.
                                Your payment data is also safely handled as you process the payment through a secured and verified payment processor.</p>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="row" style="height: auto; margin-bottom: 20px; color: #46b8da;">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                    <center><img width="65px" style="margin-left:20px; border-radius: 60px; margin-top:10px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/pdf.png"></center>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none;color: black;">
                        <li>
                            <h4 style="color: #4DD1F4; font-weight: bolder">24/7 SUPPORT</h4>
                            <p>From answering simple questions to solving any possible issues, we're always here to help you in chat and on the phone.
                                We've got you covered at any time, day or night.</p>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                    <center><img width="68px" style="margin-left:20px; border-radius: 30px; margin-top:10px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/original.png"></center>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none; color: black;">
                        <li>
                            <h4 style="color: #4DD1F4; font-weight: bolder">ORIGINALITY</h4>
                            <p>Every single order we deliver is written from scratch according to your instructions.
                                We have zero tolerance for plagiarism, so all completed papers are unique and checked for plagiarism using a leading plagiarism detector.</p>
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="col-md-2 col-sm-4 col-xs-12">
                    <center><img width="70px" style="color:cadetblue; margin-left:20px; border-radius: 30px; margin-top:10px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/slides/revision.png"></center>
                    </div>
                    <div class="col-md-10 col-sm-10 col-xs-12">
                        <ul style="list-style: none; color: black; none;">
                        <li>
                            <h4 style="color: #4DD1F4; font-weight: bolder">FREE REVISIONS</h4>
                            <p>You can ask to revise your paper as many times as you need until you're completely satisfied with the result.
                                Provide notes about what needs to be changed, and we'll change it right away.</p>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="body-container essay-font" style="background-color: #CCE4F7;">
    <div class="container">
<div class="home-slider">
    <div class="slide1" style="min-height: 400px">
        <h1 style="text-align: center">What our customers say</h1>
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <div style="border-radius:10px; background-color: rgba(255,255,255,.8); padding: 20px 20px 20px 40px; margin-top: 30px;">
                <center>
                    <h3><strong>Order# 120636</strong></h3><br>
                    <p style="font-size: large">"These guys have been saving me big time.
                        Third time placing an order with them and they delivered quality work as always. Thanks guys.
                        Highly recommend!!"</p>
                    <h4><strong>Completed: 2 hours and 20 minutes ago</strong></h4>
                </center>
            </div>
        </div>
    </div>
    <div class="slide2" style="background-color: #CCE4F7; min-height: 400px">
        <h1 style="text-align: center">What our customers say</h1>
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <div style="border-radius:10px; background-color:rgba(255,255,255,.8); padding: 20px 20px 20px 40px; margin-top: 30px;">
                <center>
                    <h3><strong>Order# 120636</strong></h3><br>
                    <p style="font-size: large">
                    "You never disappoint. You did an AMAZING work within a very short time. It looked so easy for you.
                    Will definitely keep using your services."
                    </p>
                    <h4><strong>Completed: 2 hours and 20 minutes ago</strong></h4>
                </center>
            </div>
        </div>
    </div>
    <div class="slide3" style="background-color: #CCE4F7; min-height: 400px">
        <h1 style="text-align: center">What our customers say</h1>
        <div class="col-sm-6 col-sm-offset-3 col-xs-12">
            <div style="border-radius:10px; background: rgba(255,255,255,.8); padding: 20px 20px 20px 40px; margin-top: 30px;">
                <center>
                    <h3><strong>Order# 120636</strong></h3><br>
                    <p style="font-size: large">At Verified Professors we are very cheap
                        as compared those other sites I have visited. The quality of work is high.
                        I recommend this site."
                    </p>
                    <h4><strong>Completed: 2 hours and 20 minutes ago</strong></h4>
                </center>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</div>
