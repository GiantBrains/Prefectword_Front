<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */

$this->title = 'Verified Proffessors - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers.';
$description = "Verified Proffessors - Online Academic Essay Writing Service. Get Cheap Homework Help from Professional and Reliable Essay Writers";
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
<meta property="og:site_name" content="Verified Proffessors">
<meta property="og:type" content="Education">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta property="og:url" content="https://www.verifiedproffessors.com">
<meta property="og:locale" content="en_UK">
<meta property="og:locale:alternate" content="en_US">
<!-- Twitter -->
<meta name="twitter:card" content="summary"/>
<meta name="twitter:site" content="@verifiedproffessors"/>
<!--                <meta name="twitter:creator" content="@tonigitz" />-->
<meta name="twitter:title" content="<?= $title ?>">
<meta name="twitter:description" content="<?= $description ?>">
<meta name="twitter:image" content="https://www.doctorateessays.com/images/proccess/home_page.png">
<meta name="twitter:url" content="https://www.verifiedproffessors.com">
<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@700&display=swap" rel="stylesheet">
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
<div class="site-index1" style="background-image: url('images/slides/5.jpg');opacity: 0.8">
    <div class="container" style="z-index: 100; color: white;">
        <?php Yii::$app->timezone->name ?>
        <div class="row superslide">
            <div class="col-md-6 col-xs-12">
                <div class="row" style="padding:10px;font-family: 'Open Sans', sans-serif; opacity: 0.8; color: black;background-color: #90F1C8;border-radius: 20px;">
                    <h1 style="font-size: 30px;font-weight: bolder">Get Reliable a service<br>Send your request immediately!</h1>
                </div><br>
                <div class="row" style="padding:10px;font-family: 'Open Sans', sans-serif; opacity: 0.8; color: black;background-color: #90F1C8;border-radius: 20px;">
                    <h1 style="font-size: 30px;font-weight: bolder">Each Essay Writer is High Quality</h1>
                    <center><a class="btn btn-lg" href="<?= Url::to(['/order/create']) ?>" style="background-color: #3D715B;color: black ">Place your Order Now</a></center><br>
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
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="col-md-12 col-xs-12"
                             style="background-color: white; opacity: 0.8; color: black">
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
                                    echo '<a class="btn btn-lg" href="' . Url::to(['/site/signup']) . '" style="background-color: #90F1C8">Sign Up</a>';
                                } else {
                                    echo '<a class="btn btn-lg" href="' . Url::to(['/order/index']) . '" style="background-color: #90F1C8">Dashboard</a>';
                                }
                                ?>
                            </div>
                            <div class="col-sm-4 col-xs-12">
                                <a class="btn btn-lg" href="<?= Url::to(['/order/create']) ?>" style="background-color: #90F1C8">Order Now</a>
                            </div>
                        </div>
                        <div class="hidden-xs" style="margin-top: 50px;">
                            <h4 style="font-family: 'Open Sans', sans-serif; font-size: 18px">Get 100% <strong
                                        style="color: #3D715B;">UNIQUE & QUALITY</strong> work delivered to you <strong
                                        style="color: #3D715B;">ON TIME</strong>.</h4>
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
</div>
<div class="site-index2">
    <div class="body-container essay-font" style="background-color: white;">
        <div class="container" style="background-color: white;">
            <div class="row" style="height: auto; margin-bottom: 20px;">
                <h2 style="text-align: center; color: black;font-family: 'JetBrains Mono'">MAIN BENEFITS</h2>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-check fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>No registration fees</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-envelope fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none;color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Payments always on time</strong>
                        </li>

                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em;color: #3D715B;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Orders in the sphere of your interest</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em;color: #3D715B;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>24/7 available support team</strong>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row" style="height: auto; margin-bottom: 20px; color: #46b8da;">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-check fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none;color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>High wages</strong>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-envelope fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; font-size: 18px; text-align: center">
                        <li>
                            <strong>Manage your time and workload yourself</strong>
                        </li>

                    </ul>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <center><h2><i style="border-radius: 60px;box-shadow: 0px 0px 2px #888;padding: 0.5em 0.6em; color: #3D715B;" class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i></h2></center>
                    <ul style="list-style: none; color: black; none; font-size: 18px; text-align: center">
                        <li>
                            <strong>Working from home</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="body-container essay-font" style=" background-color: #f0f2f6; ">
            <div class="row" style="height: auto; margin-bottom: 20px;margin-left: 70px">
                <div class="row" style="margin-bottom: 20px;">
                    <h2 class="essay-font" style="text-align: center;font-family: 'JetBrains Mono'">HOW IT WORKS</h2>
                </div>
                <center>
                    <div class="col-md-2">
                        <div style="height: 90px">
                            <div class="row">
                                <div class="col-md-8 essay-font hidden-xs">
                                    <img width="150px" style="margin-right: 20px;border-radius: 30px"
                                         src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/place-order.png">
                                    <p style="vertical-align: middle">PLACE YOUR ORDER</p>
                                </div>
                                <p class="hidden-md hidden-lg hidden-sm">PLACE YOUR ORDER</p>
                                <div class="col-md-4 col-sm-2 col-xs-12">
                                    <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
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
                            <div class="col-md-8 essay-font hidden-xs">
                                <img width="150px" style="margin-right: 20px;border-radius: 30px"
                                     src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/preparation.png">
                                <p style="vertical-align: middle">The writer prepares sources for your work</p>
                            </div>
                            <p class="hidden-md hidden-lg hidden-sm">The writer prepares sources for your work</p>
                            <div class="col-md-4 col-sm-2 col-xs-12">
                                <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                                   class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                                <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                                   aria-hidden="true"></i>
                            </div>
                    </div>
                </center>
                <center>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="row">
                            <div class="col-md-8 essay-font hidden-xs">
                                <img width="150px" style="margin-right: 20px;border-radius: 30px"
                                     src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/complete.jpg">
                                <p style="vertical-align: middle">The writer completes your paper</p>
                            </div>
                            <p class="hidden-md hidden-lg hidden-sm">The writer completes your paper</p>
                            <div class="col-md-4 col-sm-2 col-xs-12">
                                <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                                   class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                                <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </center>
                <center>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <div class="row">
                            <div class="col-md-8 essay-font hidden-xs">
                                <img width="150px" style="margin-right: 20px;"
                                     src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/polished.png">
                                <p style="vertical-align: middle">The writer polishes your paper</p>
                            </div>
                            <p class="hidden-md hidden-lg hidden-sm">The writer polishes your paper</p>
                            <div class="col-md-4 col-sm-2 col-xs-12">
                                <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                                   class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                                <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                                   aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </center>
                <center>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="col-md-8 essay-font hidden-xs">
                        <p style="vertical-align: middle"><strong><h4 style="font-family: 'Comfortaa', cursive;">YOU RECEIVE THE FINAL PAPER</h4></strong></p>
                    </div>
                    <p class="hidden-md hidden-lg hidden-sm">YOU RECEIVE THE FINAL PAPER</p>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                           class="fa fa-arrow-right fa-3x hidden-xs" aria-hidden="true"></i>
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                    </div>
                </div>
                </center>
                <center>
                <div class="col-md-2 col-sm-2 col-xs-12">
                    <div class="col-md-8 essay-font hidden-xs">
                        <p style="vertical-align: middle"><i style="line-height: 90px; vertical-align: middle;color: #1e7e34"
                         class="fa fa-check-circle fa-5x hidden-xs" aria-hidden="true"></i></p>
                    </div>
                    <p class="hidden-md hidden-lg hidden-sm">Checked</p>
                    <div class="col-md-4 col-sm-2 col-xs-12">
                        <i class="fa fa-arrow-down fa-3x hidden-md hidden-lg hidden-sm "
                           aria-hidden="true"></i>
                    </div>
                </div>
                </center>
            </div>
            <div class="row" style="margin-bottom: 20px">
                <center><a href="<?= Url::to(['site/how_it_works']) ?>">
                        <button style="border-radius: 30px;background-color: #90F1C8" type="button" class="btn btn-lg essay-font">Learn
                            More
                        </button>
                    </a></center>

            </div>
    </div>
    <div class="row" style="background-color: white; font-family: 'Open Sans', sans-serif;line-height: 2.0">
        <div class="container">
        <div class="col-md-4 col-sm-4">
            <h2><strong>Moneyback Guarantee</strong></h2>
            <p>Are you searching for a website that will guarantee you good grades?
                One of the best essay writing service provider is DoctorateEssays.
                With a team of proficient writers from native English speaking countries,
                we promise to deliver quality work to you on time. Our writers are available 24/7
                to handle all your projects regardless of the deadline or the difficulty.
                We write all papers from scratch and highly penalize any writer who tries to
                deliver plagiarized writing to you. All revisions are free until you are 100%
                satisfied with your paper.</p>
            <center><img src="<?= Yii::$app->request->baseUrl ?>/images/page/money-back-guarantee2.png"
                         width="222px"></center>
            <center><a href="<?= Url::to(['site/guarantee']) ?>">
                    <button style="border-radius: 30px; background-color: #90F1C8" type="button" class="btn btn-lg essay-font">
                        Money back guarantee
                    </button>
                </a></center>
        </div>
        <div class="col-md-8 col-sm-4">
            <center><h2><strong>Who we are</strong></h2></center>
            <p>Verified Preffessors is a reliable partner for professional freelance writers who are looking for a trustworthy long-term cooperation. For those pursuing personal development, our company is also the right choice since we offer numerous interesting projects and opportunities for self-improvement. Besides, our support team members are always ready to help as they work 24/7.
                If writing is what you like, you are welcome to give it a try with us!</p>
            <center>
                <svg class="recharts-surface" width="710" height="450" viewBox="0 0 510 250" version="1.1"><defs><clipPath id="recharts2-clip"><rect x="15" y="10" height="210" width="480"></rect></clipPath></defs><defs><linearGradient id="colorVP" x1="0" y1="0" x2="0" y2="1"><stop offset="5%" stop-color="#90F1C8" stop-opacity="0.8"></stop><stop offset="95%" stop-color="#90F1C8" stop-opacity="0"></stop></linearGradient></defs><g class="recharts-layer recharts-cartesian-axis recharts-xAxis xAxis">
                        <line class="recharts-cartesian-axis-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="15" y1="220" x2="495" y2="220"></line><g class="recharts-cartesian-axis-ticks"><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#000" fill="none" x1="15" y1="226" x2="15" y2="220"></line><text width="480" height="30" x="415" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="15" dy="0.71em">2014</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#000" fill="none" x1="63" y1="226" x2="63" y2="220"></line><text width="480" height="30" x="63" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="63" dy="0.71em">2015</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="111" y1="226" x2="111" y2="220"></line><text width="480" height="30" x="111" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="111" dy="0.71em">2016</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="159" y1="226" x2="159" y2="220"></line><text width="480" height="30" x="159" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="159" dy="0.71em">2017</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="207" y1="226" x2="207" y2="220"></line><text width="480" height="30" x="207" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="207" dy="0.71em">2018</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="255" y1="226" x2="255" y2="220"></line><text width="480" height="30" x="255" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="255" dy="0.71em">2019</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="303" y1="226" x2="303" y2="220"></line><text width="480" height="30" x="303" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="303" dy="0.71em">2020</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="351" y1="226" x2="351" y2="220"></line><text width="480" height="30" x="351" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="351" dy="0.71em">2014</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="399" y1="226" x2="399" y2="220"></line><text width="480" height="30" x="399" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="399" dy="0.71em">2015</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="447" y1="226" x2="447" y2="220"></line><text width="480" height="30" x="447" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="447" dy="0.71em">2016</tspan></text></g><g class="recharts-layer recharts-cartesian-axis-tick">
                                <line class="recharts-cartesian-axis-tick-line" width="480" height="30" x="15" y="220" stroke="#666" fill="none" x1="495" y1="226" x2="495" y2="220"></line><text width="480" height="30" x="495" y="228" stroke="none" fill="#666" font-size="11px" class="recharts-text recharts-cartesian-axis-tick-value" text-anchor="middle"><tspan x="495" dy="0.71em">2017</tspan></text></g></g></g><g class="recharts-cartesian-grid"><g class="recharts-cartesian-grid-horizontal">
                            <line stroke-dasharray="8 8" stroke="#ccc" fill="none" x="15" y="10" width="480" height="210" x1="15" y1="220" x2="495" y2="220"></line>
                            <line stroke-dasharray="8 8" stroke="#ccc" fill="none" x="15" y="10" width="480" height="210" x1="15" y1="167.5" x2="495" y2="167.5"></line>
                            <line stroke-dasharray="8 8" stroke="#ccc" fill="none" x="15" y="10" width="480" height="210" x1="15" y1="115" x2="495" y2="115"></line>
                            <line stroke-dasharray="8 8" stroke="#ccc" fill="none" x="15" y="10" width="480" height="210" x1="15" y1="62.5" x2="495" y2="62.5"></line>
                            <line stroke-dasharray="8 8" stroke="#ccc" fill="none" x="15" y="10" width="480" height="210" x1="15" y1="10" x2="495" y2="10"></line>
                        </g></g><g class="recharts-layer recharts-area"><g class="recharts-layer">
                            <path stroke="none" fill-opacity="1" fill="url(#colorUv)" width="480" height="210" class="recharts-curve recharts-area-area" d="M15,198.475L63,188.36875L111,134.95000000000002L159,148.07500000000002L207,143.21875L255,110.14375000000001L303,79.3L351,76.675L399,27.19375000000001L447,32.44375000000001L495,11.443749999999993L495,220L447,220L399,220L351,220L303,220L255,220L207,220L159,220L111,220L63,220L15,220Z"></path>
                            <path stroke="#f29f22" fill-opacity="1" fill="none" width="480" height="210" class="recharts-curve recharts-area-curve" d="M15,198.475L63,188.36875L111,134.95000000000002L159,148.07500000000002L207,143.21875L255,110.14375000000001L303,79.3L351,76.675L399,27.19375000000001L447,32.44375000000001L495,11.443749999999993"></path></g><g class="recharts-layer recharts-area-dots">
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="15" cy="198.475"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="63" cy="188.36875"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="111" cy="134.95000000000002"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="159" cy="148.07500000000002"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="207" cy="143.21875"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="255" cy="110.14375000000001"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="303" cy="79.3"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="351" cy="76.675"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="399" cy="27.19375000000001"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="447" cy="32.44375000000001"></circle>
                            <circle r="4" stroke="#fff" fill-opacity="100" fill="#f29f22" width="480" height="210" stroke-width="1.5" class="recharts-dot recharts-area-dot" cx="495" cy="11.443749999999993"></circle>
                        </g></g></svg></center>
        </div>
        </div>
    </div>
</div>
<div class="body-container essay-font" style="background-color: #3D715B">
    <div class="container">
        <div class="row" style="height: auto; color: #69D9F4">
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/1.png"></center>
                <h1 class="numbers-with-commas"
                    style="font-size: 60px; font-weight: 900; text-align: center"><?= number_format(floatval($allorders), 0, '.', ',') ?></h1>
                <h5 style="text-align: center">COMPLETED ORDERS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/2.png"></center>
                <h1 class="numbers-with-commas" style="font-size: 60px; font-weight: 900; text-align: center">52</h1>
                <h5 style="text-align: center">SATISFIED CLIENTS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/3.png"></center>
                <h1 style="font-size: 60px; font-weight: 900; text-align: center">97.64<sup>%</sup></h1>
                <h5 style="text-align: center;">POSITIVE FEEDBACKS</h5>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 numbers-items">
                <center><img src="<?= Yii::$app->request->baseUrl ?>/images/perfomance/4.png"></center>
                <h1 class="numbers-with-commas" style="font-size: 60px; font-weight: 900; text-align: center">8</h1>
                <h5 style="text-align: center">SUPPORT REPRESENTATIVES</h5>
            </div>
        </div>
    </div>
</div>
    <div class="body-container testim essay-font hidden-xs">
        <div class="container">
            <div class="row" style="height: auto; margin-top: 20px; margin-bottom: 20px;">
                <h1 style="text-align: center; font-weight: 900; color:#000000;font-family: 'Comfortaa', cursive;">TESTIMONIALS</h1>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3" style="height: 220px; margin-top: 30px; border-radius: 10px">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="8000">
                            <!-- Indicators -->
                            <ol class="carousel-indicators" style="color: #2e6da4">
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

    <div class="row" style="height: auto; margin-bottom: 20px;">
        <div class="container">
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
                        <button style="border-radius: 30px; background-color: #90F1C8" type="button" class="btn btn-lg essay-font">
                            Order Now
                        </button>
                    </a></center>
            </div>
        </div>
    </div>
</div>
