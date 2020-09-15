<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */

$this->title = 'Doctorate Essays - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers.';
$description = "Doctorate Essays - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers";
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
JS;
$this->registerJs($myscript);
?>

<?php $this->beginBlock('block5'); ?>
<meta property="og:site_name" content="Doctorate Essays">
<meta property="og:type" content="Education">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta property="og:url" content="https://www.doctorateessays.com">
<meta property="og:locale" content="en_UK">
<meta property="og:locale:alternate" content="en_US">
<!-- Twitter -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@doctorateessays"/>
<!--                <meta name="twitter:creator" content="@tonigitz" />-->
<meta name="twitter:title" content="<?= $title ?>">
<meta name="twitter:description" content="<?= $description ?>">
<meta name="twitter:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta name="twitter:url" content="https://www.doctorateessays.com">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
    .carousel-inner > .item > img,
    .carousel-inner > .item > a > img {
        width: 70%;
        margin: auto;
    }
</style>


<?php $this->endBlock(); ?>
<div class="site-index1" style="background-image: url('images/slides/slide11.png');">
    <div class="container" style="z-index: 100; color: white;">
        <?php Yii::$app->timezone->name ?>
        <div class="row superslide">
            <div class="col-md-6 col-xs-12"
                 style="background-color: white; opacity: 0.8; border-radius: 10px; color: black">
                <div class="hidden-xs">
                    <h1 style="font-weight: bolder; font-family: 'Open Sans', sans-serif; ">Quality Academic
                        Writing</h1>
                    <h2 style="font-weight: bolder; font-family: 'Open Sans', sans-serif;">Service at an Affordable
                        Price.</h2>
                    <h4 style="font-family: 'Open Sans', sans-serif; font-size: 18px">Hire us, sit back and
                        relax…….We’ll do it for you.</h4>
                </div>
                <div class="row hidden-xs" style="margin-top: 32px">
                    <div class="col-md-2 hidden-xs">

                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php
                        if (Yii::$app->user->isGuest) {
                            echo '<a class="btn btn-lg btn-info" href="' . Url::to(['/site/signup']) . '">Sign Up</a>';
                        } else {
                            echo '<a class="btn btn-lg btn-warning" href="' . Url::to(['/order/index']) . '">Dashboard</a>';
                        }
                        ?>
                    </div>
                    <div class="col-sm-4 col-xs-12">
                        <a class="btn btn-lg btn-primary" href="<?= Url::to(['/order/create']) ?>">Order Now</a>
                    </div>
                </div>
                <div class="hidden-xs" style="margin-top: 50px;">
                    <h4 style="font-family: 'Open Sans', sans-serif; font-size: 18px">Get 100% <strong
                                style="color: #5bc0de;">UNIQUE & QUALITY</strong> work delivered to you <strong
                                style="color: #5bc0de;">ON TIME</strong>.</h4>
                </div>
            </div>
            <div class="col-md-6">
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
                    <div class="col-md-3">

                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12"
                         style="background-color: white; opacity: 0.7; border-radius: 10px; color:black">
                        <h3 class="essay-font" style="text-align: center">Calculate the Price</h3>
                        <?= $form->field($fmodel, 'service_id', [
                            'template' => '<div style="font-family: \'Open Sans\', sans-serif; ">{label}</div> <div style=" padding: 0 5px 0 5px;" class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                        ])->label('Service')->dropDownList(\app\models\Service::getServices(),
                            ['options' => [1 => ['Selected' => 'selected'], 'prompt' => '...select Service....', 'id' => 'service-id']]) ?>

                        <?= $form->field($fmodel, 'type_id', [
                            'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style=" padding: 0 5px 0 5px;"  class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                        ])->label('Type of Paper')->dropDownList(\app\models\Type::getTypes(),
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
                        <div class="form-group" style="text-align: center">
                            <h4 style="margin-top: -10px" class="essay-font">Minimum Price: <input class="tcost"
                                                                                                   style="border: none; width: 100px"
                                                                                                   type="text"
                                                                                                   id="min-amount"
                                                                                                   value="$8.00"
                                                                                                   readonly="readonly">
                            </h4>
                        </div>
                        <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                            <?= Html::submitButton('Continue', ['class' => 'btn btn-lg btn-block btn-primary', 'style' => 'font-family: \'Open Sans\', sans-serif; margin-bottom: 20px;']) ?>
                        </div>
                    </div>
                    <div class="col-md-1 hidden-xs">

                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<div class="site-index2">
    <div class="body-container essay-font" style="background-color: white;">
        <div class="container" style="background-color: white;">
            <div class="row" style="height: auto; margin-bottom: 20px; color: #46b8da;">
                <h2 style="text-align: center; color: black">GET THESE FOR FREE</h2>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul style="list-style: none; font-size: 18px">
                        <li><i style="color: #2e6da4;" class="fa fa-check fa-2x" aria-hidden="true"></i> Free Turnitin
                            Plagiarism report
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-tasks fa-2x" aria-hidden="true"></i> Free work in
                            progress drafts
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-repeat fa-2x" aria-hidden="true"></i> Free revisions
                            for all orders
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul style="list-style: none; font-size: 18px">
                        <li><i style="color: #2e6da4;" class="fa fa-envelope-o fa-2x" aria-hidden="true"></i> Free
                            text/email updates
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-phone fa-2x" aria-hidden="true"></i> Free 24/7 VIP
                            customer support
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-file-text-o fa-2x" aria-hidden="true"></i> Free 1
                            page summary.
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <ul style="list-style: none; font-size: 18px">
                        <li><i style="color: #2e6da4;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Free cover
                            page
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-list-alt fa-2x" aria-hidden="true"></i> Free
                            references page
                        </li>
                        <li><i style="color: #2e6da4;" class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i> Free
                            formatting for your work
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row essay-font">
                <div class="col-md-5">
                    <p class="choose-body" style="font-size: 15px">Are you searching for a website that will guarantee
                        you good grades?
                        One of the best essay writing service provider is DoctorateEssays.
                        With a team of proficient writers from native English speaking countries,
                        we promise to deliver quality work to you on time. Our writers are available
                        24/7 to handle all your projects regardless of the deadline or the difficulty.
                        We write all papers from scratch and highly penalize any writer who tries to deliver
                        plagiarized writing to you. All revisions are free until you are 100% satisfied with your
                        paper. </p>
                </div>
                <div class="col-md-3">
                    <center><img src="<?= Yii::$app->request->baseUrl ?>/images/page/satisfaction-guarantee.png"
                                 width="285px"></center>
                </div>
                <div class="col-md-4">
                    <p class="choose-body" style="font-size: 15px">
                        We have an open reviews section where our customers give us
                        feedback on their experience with us. From the reviews, it is evident that most of our
                        customers are satisfied with our service and would recommend us to you.
                        You do not have to spend sleepless nights thinking of how you will improve your grade.
                        Let us do the essay for you while you study or do other duties.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="body-container essay-font" style=" background-color: #f0f2f6; ">
        <div class="container">
            <div class="row" style="height: auto; margin-bottom: 20px;">
                <div class="row" style="margin-bottom: 20px;">
                    <h2 class="essay-font" style="text-align: center">HOW IT WORKS</h2>
                </div>
                <center>
                    <div class="col-md-3">
                        <div style="height: 90px">
                            <div class="row">
                                <div class="col-md-8 essay-font hidden-xs">
                                    <p style="line-height: 90px; vertical-align: middle">PLACE YOUR ORDER</p>
                                </div>
                                <p class="hidden-md hidden-lg hidden-sm">PLACE YOUR ORDER</p>
                                <div class="col-md-4 col-sm-2 col-xs-12">
                                    <i style="line-height: 90px; vertical-align: middle"
                                       class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                                    <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                                       aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </center>
                <center>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="row">
                            <img width="100px" style="margin-right: 20px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/proccess/researcher2x.png">
                            <i style="line-height: 90px; vertical-align: middle"
                               class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        </div>
                        <div class="row essay-font">
                            <p style="margin-right: 20px">The writer prepares sources for your work</p>
                        </div>
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm " aria-hidden="true"></i>
                    </div>
                </center>
                <center>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="row">
                            <img width="100px" style="margin-right: 20px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/proccess/writer_2x.png">
                            <i style="line-height: 90px; vertical-align: middle"
                               class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        </div>
                        <div class="row essay-font">
                            <p>The writer completes your paper</p>
                        </div>
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm " aria-hidden="true"></i>
                    </div>
                </center>
                <center>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="row">
                            <img width="100px" style="margin-right: 20px;"
                                 src="<?= Yii::$app->request->baseUrl ?>/images/proccess/proofreader_2x.png">
                            <i style="line-height: 90px; vertical-align: middle"
                               class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        </div>
                        <div class="row essay-font">
                            <p>The writer polishes your paper</p>
                        </div>
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm " aria-hidden="true"></i>
                    </div>
                </center>
                <center><p class="hidden-md hidden-lg hidden-sm">YOU RECEIVE THE FINAL PAPER</p></center>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="essay-font hidden-xs" style="height: 90px">
                        <p style="line-height: 90px; vertical-align: middle">YOU RECEIVE THE FINAL PAPER</p>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 20px">
                <center><a href="<?= Url::to(['site/how_it_works']) ?>">
                        <button style="border-radius: 30px" type="button" class="btn btn-lg btn-info essay-font">Learn
                            More
                        </button>
                    </a></center>
            </div>
        </div>
    </div>
    <hr>
    <div class="body-container essay-font">
        <div class="container">
            <div class="row" style="height: auto; margin-bottom: 20px;">
                <div class="row essay-font" style="margin-bottom: 20px; text-align: center">
                    <h1>WHY CHOOSE US</h1>
                </div>
                <div class="col-md-4">
                    <div class="col-md-11">
                        <div class="row block-reason">
                            <div class="col-md-3  col-sm-3 col-xs-3 svg-back">
                                <i class="fa fa-graduation-cap fa-3x"
                                   style="color: white; line-height: 60px; vertical-align: middle"
                                   aria-hidden="true"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p style="font-size: 20px;">More than 10 years <span
                                            style="font-weight: 900">Experience</span></p>
                            </div>
                        </div>
                        <div class="row block-reason">
                            <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                                <i class="fa fa-check-circle fa-3x"
                                   style="color: white; line-height: 60px; vertical-align: middle"
                                   aria-hidden="true"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p style="font-size: 20px;">100 percent <b style="font-weight: 900">Original</b> <span>Paper</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-11">
                        <div class="row block-reason">
                            <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                                <i class="fa fa-clock-o fa-3x"
                                   style="color: white; line-height: 60px; vertical-align: middle"
                                   aria-hidden="true"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p style="font-size: 20px;">Delivers on <b style="font-weight: 900">Urgent</b> <span>Orders</span>
                                </p>
                            </div>
                        </div>
                        <div class="row block-reason">
                            <div class=" col-md-3 col-sm-3 col-xs-3 svg-back">
                                <i class="fa fa-th-list fa-3x"
                                   style="color: white; line-height: 60px; vertical-align: middle"
                                   aria-hidden="true"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p style="font-size: 20px;">All writing <b style="font-weight: 900">Subjects</b> <span>Offered</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="col-md-11">
                        <div class="row block-reason">
                            <div class="col-md-3 col-sm-3 col-xs-3 svg-back">
                                <i class="fa fa-percent fa-3x"
                                   style="color: white; line-height: 60px; vertical-align: middle"
                                   aria-hidden="true"></i>
                            </div>
                            <div class="col-md-9 col-sm-9 col-xs-9" 0
                            <p style="font-size: 20px;">Amazing <b style="font-weight: 900">Discounts</b>
                                <span>offered</span></p>
                        </div>
                    </div>
                    <div class="row block-reason">
                        <div class="col-md-3 col-sm-3 col-xs-3 svg-back">
                            <i class="fa fa-certificate fa-3x"
                               style="color: white; line-height: 60px; vertical-align: middle" aria-hidden="true"></i>
                        </div>
                        <div class="col-md-9 col-sm-9 col-xs-9">
                            <p style="font-size: 20px;">Amazing <b style="font-weight: 900">Features</b> <span>for every order</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="font-size: 16px">
            <div class="col-md-5">
                <p class="choose-body" style="margin-top: 20px">We are a company that values our image and credibility.
                    Excellent customer experience and satisfaction are essential elements that we strive to achieve.
                    We refund back your money in case you are not satisfied with the service offered.</p>
            </div>
            <div class="col-md-3">
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/page/money-back-guarantee2.png"
                             width="222px"></center>
                <center><a href="<?= Url::to(['site/guarantee']) ?>">
                        <button style="border-radius: 30px" type="button" class="btn btn-lg btn-primary essay-font">
                            Money back guarantee
                        </button>
                    </a></center>
            </div>
            <div class="col-md-4">
                <p class="choose-body" style="margin-top: 20px">Furthermore, you only pay your writer after receiving
                    the paper and confirming that it meets your expectations.
                    You are free to cancel your order and still get back your money.
                    Please remember to read our Terms and Conditions.</p>
            </div>
        </div>
    </div>

</div>
<hr>
<div class="body-container essay-font" style="background-color: midnightblue">
    <div class="container">
        <div class="row" style="height: auto; color: white">
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <h1 class="numbers-with-commas"
                    style="font-size: 60px; font-weight: 900; text-align: center"><?= number_format(floatval($allorders), 0, '.', ',') ?></h1>
                <h5 style="text-align: center">COMPLETED ORDERS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <h1 class="numbers-with-commas" style="font-size: 60px; font-weight: 900; text-align: center">52</h1>
                <h5 style="text-align: center">ACTIVE WRITERS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <h1 style="font-size: 60px; font-weight: 900; text-align: center">97.64<sup>%</sup></h1>
                <h5 style="text-align: center">POSITIVE FEEDBACKS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <h1 class="numbers-with-commas" style="font-size: 60px; font-weight: 900; text-align: center">8</h1>
                <h5 style="text-align: center">SUPPORT REPRESENTATIVES</h5>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="body-container essay-font" style="background-color: white;">
    <div class="container" style="background-color: white;">
        <div class="row" style="height: auto; margin-bottom: 20px; color: #46b8da;">
            <h2 style="text-align: center; color: black">Customer Reviews</h2>
            <h4 style="text-align: center; color: black">Avg rating for all
                reviews: <?= number_format(floatval($avgrating), 1, '.', ',') ?> / 5</h4>
            <div style="color: #424b59; text-align:center;">


                <div class="container">
                    <br>
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <style type="text/css">
                            #indicator {
                                /*#59b0dbed;*/
                                width: 10px;
                                height: 10px;
                                border-radius: 3px;
                                border: solid 1px #46b8da;
                            }

                            .carousel-indicators .active {
                                background-color: midnightblue;
                            }

                            .carousel-indicators .active li:active {
                                background-color: #46b8da;
                            }
                            #time_display{
                                clear:both;
                                color:green;
                            }
                        </style>
                        <ol class="carousel-indicators">
                            <li id="indicator" data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li id="indicator" data-target="#myCarousel" data-slide-to="1"></li>
                            <li id="indicator" data-target="#myCarousel" data-slide-to="2"></li>
                            <li id="indicator" data-target="#myCarousel" data-slide-to="3"></li>
                            <li id="indicator" data-target="#myCarousel" data-slide-to="4"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">

                            <?php

                            $counter = 0;
                            $timeHours = -1;
                            $start_class = '';
                            foreach ($ratings as $rating) {
                                $timeHours = $timeHours + 1;

                                $counter = $counter + 1;
                                if ($counter == 1) {
                                    echo ' <div class="item active">';
                                } else echo '<div class="item">';
                                //
                                echo '<div class="contain" style="float:left; margin:0px auto; padding-top:50px; height:350px; padding-left:10%; padding-right:10%; width:100%; text-align:center; ">';
                                echo '<h3 style="text-align:center; width:100%; font-size:16px; ">';
                                echo ' <div  style="border-color: #ddd; padding: 0 10px 0 10px">';
                                echo ' <p> <strong style="text-align:center; width:100%;">Order# ' . $rating->order_number . '</strong></p>';
                                echo ' <div class="row">';
                                echo '<div style="display: inline-block; font-size: 16px">Customer Feedback: &nbsp; </div> <div style="display: inline-block" >' . \kartik\rating\StarRating::widget([
                                    'name' => 'rating_21',
                                    'disabled' => true,
                                    'value' => $rating->value,
                                    'pluginOptions' => [
                                        'size' => 'xs',
                                        'filledStar' => '<i style="color: orange;" class="glyphicon glyphicon-star"></i>',
                                        'readonly' => true,
                                        'showClear' => false,
                                        'showCaption' => false,
                                    ],                                    
                                ]) . '</div>';
                                echo '&nbsp; <span> ' . $rating->value .' / 5'.'</span>';
                                
                                echo '</div>';
                                $user_id = 12069 + intval($rating->client_id);
                                echo '</br>';
                                echo '<p><strong></strong> ' . $rating->description . ' - <span style="text-transform: capitalize; font-style: italic"> Customer ' . $user_id . '</span></p>';

                                //TO DO {CAROUSOLE}
                                $minOrHour = '';

                                $startTime = Carbon::parse($rating->created_at);
                                $timeNow = \Carbon\Carbon::now();

                                $days = $startTime->diffInDays($timeNow);
                                $hours = $startTime->copy()->addDays($days)->diffInHours($timeNow);
                                $minutes = $startTime->copy()->addDays($days)->addHours($hours)->diffInMinutes($timeNow);

                                
//                    $rating->c
                                echo '<span id="time_display">';
                                echo 'Completed: ';
                                if($timeHours > 0)
                                {
                                    echo $timeHours . ' hours and ';
                                }                                
                                echo $minutes . ' minutes ago<br>';
                                echo '</span>';
                                
                                //echo $minOrHour . ' </span>  ';
                                //TO DO

                                echo '</div>';
                                echo '<br>' . '</h3>';
                                echo '</div>';
                                echo '</div>';
                                //
                            }
                            ?>

                        </div>
                        <div class="carousel-caption">

                        </div>

                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        <center><a class="btn btn-primary btn-outline" href="<?= Yii::$app->request->baseUrl ?>/site/reviews">VIEW
                ALL</a></center>
    </div>
</div>
<! ->

<! ->
<hr class="hidden-xs">
<div class="body-container hidden-xs" style="background-color: whitesmoke;">
    <div class="container" style="background-color: whitesmoke;">
        <div class="row" style="height: auto; margin-bottom: 20px">
            <div class="row" style="margin-bottom: 20px;">
                <h1 class="essay-font" style="text-align: center">Looking for a writer who can deliver a high quality
                    paper?</h1>
                <h4 class="essay-font" style="text-align: center">Our writers are well experienced to handle the
                    following projects and more:</h4>
            </div>
            <div class="col-md-3" style="text-align: center">
                <p class="essay-font">Custom Essay</p>
                <p class="essay-font">Case Study</p>
                <p class="essay-font">Business Plan</p>
                <p class="essay-font">Research Paper</p>
                <p class="essay-font">Admission Essay</p>
                <p class="essay-font">Literature Review</p>
            </div>
            <div class="col-md-3" style="text-align: center">
                <p class="essay-font">Coursework</p>
                <p class="essay-font">Term Paper</p>
                <p class="essay-font">Research Proposal</p>
                <p class="essay-font">Presentation or Speech</p>
                <p class="essay-font">Annotated Bibliography</p>
                <p class="essay-font">Multiple Choice Questions</p>
            </div>
            <div class="col-md-3" style="text-align: center">
                <p class="essay-font">Article Review</p>
                <p class="essay-font">Creative Writing</p>
                <p class="essay-font">Reflective Writing</p>
                <p class="essay-font">Thesis / Dissertation</p>
                <p>Book / Movie Review</p>
                <p class="essay-font">Critical Thinking / Review</p>
            </div>
            <div class="col-md-3 essay-font" style="text-align: center">
                <p>Report</p>
                <p>Lab Report</p>
                <p>Math Problem</p>
                <p>Capstone Project</p>
                <p>Statistical Project</p>
                <p>Editing and proofreading</p>
            </div>
            <div class="row" style="margin-top: 20px;">
                <center><a data-toggle="modal" data-target="#orderModal">
                        <button style="border-radius: 30px" type="button" class="btn btn-lg btn-primary essay-font">
                            Order Now
                        </button>
                    </a></center>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="body-container hidden-xs" style="background-color: white;">
    <div class="container" style="background-color: white;">
        <div class="row essay-font" style="height: auto; margin-bottom: 20px; font-size: 16px; color: #424b59">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h3>“Help Write My Paper” Service</h3>
                <p class="choose-body">We have a fully working system that gives our users a smooth time as they
                    navigate through all the pages on our site. It can never be any easier than we have made it.
                    We also have a team of the best customer service representatives available 24/7
                    to help you by answering any question you might have and also guide you through every step of
                    creating, reserving and downloading your paper.</p>
                <p class="choose-body">Wondering what other customers think about us? You may need to visit our
                    reviews section where we have a real-time feedback section. For every order completed,
                    the customer gives a review which automatically updates the reviews page.
                    We appreciate customer feedback and criticism, and as such, we use your feedback to serve you
                    better.
                    If you were looking for the best site to write your essay, you are just at the right place.
                    The reviews from our customers can confirm that to you.</p>
                <br>
                <h3>Need a Plagiarism Free Paper Urgently?</h3>
                <p class="choose-body">Do you have an assignment that is due in the next few hours?
                    Are your hands so occupied with other tasks that you need help? Is your professor so strict on
                    plagiarism?
                    Do you want a well-researched plagiarism free paper but you do not how to do it?
                    All these questions have an answer here. DoctorateEssays is the solution.</p>
                <p class="choose-body">Research papers, essays proposals, projects, Dissertations or any other type of
                    papers can be a challenge to write.
                    It becomes even more difficult when you have a very short deadline.
                    You might need an expert's help in such situations. That's why our team of experienced writers is
                    always on standby to help you. We pick the best writer experienced in your subject and
                    give him/he your task to handle. Having worked with us for years, we always count on the
                    writer to deliver the best quality work within the short deadline you give us. Sometimes it is
                    challenging,
                    but all our writers are dedicated to meet the expectations of the customers within the time limit
                    set.</p>
                <br>
                <h3>Need Help with my Extra Credit Paper</h3>
                <p class="choose-body">Do you have a chance to boost your grades? Do you feel you are not good at
                    writing essays,
                    but you need to pass the class? I bet you would want the best essay that will
                    make sure you get the best grade. Hire the most professional essay writer from one of the
                    best and cheapest online academic essay writing service providers.
                    We will write your extra credit paper in a way that will guarantee you the best grades
                    Log in to DoctorateEssays and give us your instructions, sit back and relax.</p>
                <p class="choose-body">If you are wondering if we maintain your privacy, we can always guarantee
                    anonymity at all times.
                    We identify our customers with unique numbers instead of their specific names and therefore no one
                    would ever guess you used our services. We provide total protection for your personal information.
                    You should feel secure whenever you are using our website and asking for essay writing service at
                    all times.</p>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <h3>Top Quality Papers for Students</h3>
                <p class="choose-body">If you are looking for a high-quality essay that will guarantee you good grades,
                    then you need the best essay writer for the task.
                    With a team of highly experienced quality writers, we are ready to deliver any essay
                    regardless of the level of difficulty or urgency. Our website is easy to navigate
                    and use while our support team is highly professional.</p>
                <p class="choose-body">Our writers will make your grade at a very affordable price, almost for free.
                    We give you a free cover page, references page, Turnitin plagiarism report among others.
                    If you need assistance with your paper, we are the best choice.</p>
                <br>
                <h3>Your Urgent Essay Help</h3>
                <p class="choose-body">When your assignment is due, you tend to panic and sometimes to write an
                    essay in panic may not be the best idea. We offer relief for you during such times.
                    Our best writers are always available to handle all urgent papers despite their technicality.
                    With more than ten years of experience, you can sit back and relax while they
                    work on delivering the best quality paper.</p>
                <p class="choose-body">If you are wondering how much it costs to have a custom essay written for you,
                    you can check your price through our price calculator. The cheapest essay writing service provider
                    you can get online is DoctorateEssays.com. We care about your pocket as a student.
                    Despite the low prices, our quality is top notch. We can guarantee a passing grade whenever you
                    order a paper with us.</p>
                <br>
                <h3>Full-Time Job and Part-Time Student?</h3>
                <p class="choose-body">Imagine having so many assignments from your professor, but still, you have to be
                    at work all day.
                    You might never get the time to do all those assignments. If you do them, the quality might not be
                    the best.
                    That's why DctorateEsssays tries to help you in such situations to save your grades.
                    We are ready to work on your projects as you work. You do not have to stay up all night
                    working on your assignment only to be sleepy the next day at work. You still need your
                    job as much as you need to pass your assignment. We will help you write your essay.</p>
                <br>
                <h3>Most Reliable Essay Writer</h3>
                <p class="choose-body">Our criteria for hiring writers is rigorous. On top of taking the best
                    academically
                    qualified writers, we also make sure that their disciple and communication skills are great.
                    We only hire native English speakers from countries such as USA, UK, Australia, and Canada among
                    others.
                    The writers have a minimum qualification of a bachelor’s degree while others have even
                    PhDs in various fields. Regardless of the level of your writing, our writers are ready to
                    write your essay to fit your level.</p>
                <p class="choose-body">We work around the clock. Therefore, our writers promise to work on all papers
                    despite their
                    complex nature or their tight deadline. We aim to help the student make their grades and therefore
                    the
                    final papers from our writers are always top notch.</p>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="body-container testim essay-font hidden-xs">
    <div class="container">
        <div class="row" style="height: auto; margin-top: 20px; margin-bottom: 20px;">
            <h1 style="text-align: center; font-weight: 900; color:#000000;">TESTIMONIALS</h1>
            <div class="row">
                <div class="col-md-6 col-md-offset-3" style="height: 220px; margin-top: 30px; border-radius: 10px">
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="8000">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" style="padding: 0 5px 0 5px;" role="listbox">
                            <div class="item active"
                                 style="height: 220px; background-color: white; padding: 15px; border-radius: 15px">
                                <p class="choose-body" style="font-size: 20px; font-style: italic"><strong>"</strong>These
                                    guys have been saving me big time.
                                    Third time placing an order with them and they delivered quality work as always.
                                    Thanks guys. Highly recommend!!<strong>"</strong></p>
                                <p style="font-style: italic; font-size: 24px; font-weight: bold; text-align: center">
                                    Jay</p>
                                <div class="carousel-caption">
                                </div>
                            </div>
                            <div class="item"
                                 style="height: 220px; background-color: white; padding: 15px; border-radius: 15px">
                                <p class="choose-body" style="font-size: 20px; font-style: italic"><strong>"</strong>You
                                    never disappoint.
                                    You did an AMAZING work within a very short time.
                                    It looked so easy for you.
                                    Will definitely keep using your services.<strong>"</strong></p>
                                <p style="font-style: italic; font-size: 24px; font-weight: bold; text-align: center">
                                    Steve002</p>
                                <div class="carousel-caption">
                                </div>
                            </div>
                            <div class="item"
                                 style="height: 220px; background-color: white; padding: 15px; border-radius: 15px">
                                <p class="choose-body" style="font-size: 20px; font-style: italic"><strong>"</strong>Doctorate
                                    essays are very cheap as
                                    compared those other sites I have visited.
                                    The quality of work is high.
                                    I recommend this site.<strong>"</strong></p>
                                <p style="font-style: italic; font-size: 24px; font-weight: bold; text-align: center">
                                    Myrah</p>
                                <div class="carousel-caption">
                                </div>
                            </div>
                            <div class="item"
                                 style="height: 220px; background-color: white; padding: 15px; border-radius: 15px">
                                <p style="font-size: 20px; font-style: italic"><strong>"</strong>Checked my paper for
                                    plagiarism and it was 100% unique.
                                    I’m expecting a passing grade from what I see on the paper.
                                    I love it!!!!. Thank you so much<strong>"</strong></p>
                                <p style="font-style: italic; font-size: 24px; font-weight: bold; text-align: center">
                                    Aggie</p>
                                <div class="carousel-caption">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

