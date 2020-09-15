<?php
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 2/14/19
 * Time: 6:59 PM
 */
?>
<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use dosamigos\ckeditor\CKEditor;
use kartik\social\FacebookPlugin;
use kartik\social\TwitterPlugin;
/**
 * Created by PhpStorm.
 * User: gits
 * Date: 6/16/18
 * Time: 5:19 PM
 */

$this->title = 'Sample Articles';
$this->params['breadcrumbs'][] = $this->title;

$myscript = <<< JS
  $(document).ready(function(){
         moment().format('MMMM Do YYYY, h:mm:ss a');
            var service = 8;
            var type = 1;
            var urgency = 1;
            var pages = 1;
            var level = 1;
        $('#frontorder-service_id').change('focusin', function(){
            order_service = parseInt($(this).val());
            
            if(order_service===1){
                service = 8;
            }else if(order_service===2){
                service = 6;
            }else if(order_service===3){
                service = 5;
            }
            $('#min-amount').val('$'+(service*type*urgency*pages*level).toFixed(2));
        });
        $("#frontorder-type_id").change('focusin', function(){
               typeoforder = parseInt($(this).val());
                 if(typeoforder===1){
                type = 1.2;
                }else if (typeoforder===2){
                 type = 1.2;      
                }else if (typeoforder===3){
                 type = 1.2;      
                }else if (typeoforder===4){
                 type = 1.2;      
                }else if (typeoforder===5){
                 type = 1.2;      
                 }else if (typeoforder===6){
                 type = 1.2;      
                 }else if (typeoforder===7){
                 type = 1.2;      
                 }else if (typeoforder===8){
                 type = 1.2;      
                 }else if (typeoforder===9){
                 type = 1.2;      
                 }else if (typeoforder===10){
                 type = 1.2;      
                 }else if (typeoforder===11){
                 type = 1.2;      
                 }else if (typeoforder===12){
                 type = 1.2;      
                 }else if (typeoforder===13){
                 type = 1.2;      
                 }else if (typeoforder===14){
                 type = 1.2;      
                 }else if (typeoforder===15){
                 type = 1.2;      
                 }else if (typeoforder===16){
                 type = 1.2;      
                 }else if (typeoforder===17){
                 type = 1.2;      
                 }else if (typeoforder===18){
                 type = 1.2;      
                 }else if (typeoforder===20){
                 type = 1.2;      
                 }else if (typeoforder===22){
                 type = 2.0;      
                 }else if (typeoforder===23){
                 type = 2.2;      
                 }else if (typeoforder===24){
                 type = 1.5;      
                 }else if (typeoforder===25){
                 type = 1.2;      
                 }else if (typeoforder===26){
                 type = 1.2;      
                 }else if (typeoforder===27){
                 type = 0.7;      
                 }else if (typeoforder===28){
                 type = 0.8;      
                 }else if (typeoforder===31){
                 type = 1.2;      
                 }else if (typeoforder===32){
                 type = 1.2;      
                 }else if (typeoforder===33){
                 type = 1.2;      
                 }else if (typeoforder===34){
                 type = 1.2;      
                 }else if (typeoforder===35){
                 type = 2.2;      
                 }else if (typeoforder===36){
                 type = 1.2;      
                 }else if (typeoforder===37){
                 type = 1.2;      
                 }else if (typeoforder===38){
                 type = 1.2;      
                 }else if (typeoforder===39){
                 type = 1.5;      
                 }else if (typeoforder===40){
                 type = 1.2;      
                  }else if (typeoforder===41){
                 type = 1.4;      
                  }else if (typeoforder===42){
                 type = 1.4;      
                 }else if (typeoforder===43){
                 type = 1.4;      
                 }else if (typeoforder===44){
                 type = 1.3;      
                 }else if (typeoforder===45){
                 type = 1.2;      
                 }                                                       
                $('#min-amount').val('$'+(service*type*urgency*pages*level).toFixed(2));
        });
        $("#frontorder-urgency_id").change('focusin', function(){
                order_urgency = parseInt($(this).val());
                
                if(order_urgency===1){
                urgency = 2.5;
                }else if (order_urgency===2){
                 urgency = 2.0;      
                }else if (order_urgency===3){
                 urgency = 1.8;      
                }else if (order_urgency===4){
                 urgency = 1.6;      
                }else if (order_urgency===5){
                 urgency = 1.5;      
                }else if (order_urgency===6){
                 urgency = 1.4;      
                }else if (order_urgency===7){
                 urgency = 1.3;      
                }else if (order_urgency===8){
                 urgency = 1.2;      
                }else if (order_urgency===9){
                 urgency = 1.2;      
                }else if (order_urgency===10){
                 urgency = 1.1;      
                }else if (order_urgency===11){
                 urgency = 1.1;      
                }else if (order_urgency===12){
                 urgency = 1.1;      
                }else if (order_urgency===13){
                 urgency = 1.0;      
                }else if (order_urgency===14){
                 urgency = 1.0;      
               }else if (order_urgency===15){
                 urgency = 1.0;      
                }
                $('#min-amount').val('$'+(service*type*urgency*pages*level).toFixed(2));
        });
         $('#frontorder-pages_id').change('focusin', function(){
                order_pages = parseInt($(this).val());
                if(order_pages===1){
                    pages = 1;
                }else if(order_pages===2){
                    pages=2*0.95;
                }else if(order_pages===3){
                    pages= 3*0.95;
                 }else if(order_pages===4){
                    pages=4*0.95;
                }else if(order_pages===5){
                    pages= 5*0.95;
                 }else if(order_pages===6){
                    pages=6*0.925;
                }else if(order_pages===7){
                    pages= 7*0.925;
                }else if(order_pages===8){
                    pages=8*0.925;
                }else if(order_pages===9){
                    pages= 9*0.925;
                 }else if(order_pages===10){
                    pages=10*0.9;
                }else if(order_pages===11){
                    pages= 11*0.9;
                 }else if(order_pages===12){
                    pages=12*0.9;
                }else if(order_pages===13){
                    pages= 13*0.9;
                }else if(order_pages===14){
                    pages=14*0.9;
                }else if(order_pages===15){
                    pages= 15*0.9;
                }else if(order_pages===16){
                    pages=16*0.9;
                }else if(order_pages===17){
                    pages= 17*0.9;
                }else if(order_pages===18){
                    pages=18*0.9;
                }else if(order_pages===19){
                    pages= 19*0.9;
                }else if(order_pages===20){
                    pages=20*0.9;
                }else if(order_pages===21){
                    pages= 21*0.85;
                 }else if(order_pages===22){
                    pages=22*0.85;
                }else if(order_pages===23){
                    pages= 23*0.85;
                 }else if(order_pages===24){
                    pages=24*0.85;
                }else if(order_pages===25){
                    pages= 25*0.85;
                }else if(order_pages===26){
                    pages=26*0.85;
                }else if(order_pages===27){
                    pages= 27*0.85;
                }else if(order_pages===28){
                    pages=28*0.85;
                }else if(order_pages===29){
                    pages= 29*0.85;
                }else if(order_pages===30){
                    pages=30*0.85;
                }else if(order_pages===31){
                    pages= 31*0.85;
                }else if(order_pages===32){
                    pages=32*0.85;
                }else if(order_pages===33){
                    pages= 33*0.85;
                 }else if(order_pages===34){
                    pages=34*0.85;
                }else if(order_pages===35){
                    pages= 35*0.85;
                 }else if(order_pages===36){
                    pages=36*0.85;
                }else if(order_pages===37){
                    pages= 37*0.85;
                }else if(order_pages===38){
                    pages=38*0.85;
                }else if(order_pages===39){
                    pages= 39*0.85;
                 }else if(order_pages===40){
                    pages=40*0.85;
                }else if(order_pages===41){
                    pages= 41*0.85;
                 }else if(order_pages===42){
                    pages=42*0.85;
                }else if(order_pages===43){
                    pages= 43*0.85;
                }else if(order_pages===44){
                    pages=44*0.85;
                }else if(order_pages===45){
                    pages= 45*0.85;
                 }else if(order_pages===46){
                    pages=46*0.85;
                }else if(order_pages===47){
                    pages=47*0.85;
                 }else if(order_pages===48){
                    pages=48*0.85;
                }else if(order_pages===49){
                    pages= 49*0.85;
                }else if(order_pages===50){
                    pages=50*0.85;
                }else if(order_pages===51){
                    pages= 51*0.85;
                 }else if(order_pages===52){
                    pages=52*0.85;
                }else if(order_pages===53){
                    pages= 53*0.85;
                 }else if(order_pages===54){
                    pages=54*0.85;
                }else if(order_pages===55){
                    pages= 55*0.85;
                }else if(order_pages===56){
                    pages=56*0.85;
                }else if(order_pages===57){
                    pages= 57*0.85;
                 }else if(order_pages===58){
                    pages=58*0.85;
                }else if(order_pages===59){
                    pages= 59*0.85;
                 }else if(order_pages===60){
                    pages=60*0.85;
                }else if(order_pages===61){
                    pages= 61*0.85;
                }else if(order_pages===62){
                    pages=62*0.85;
                }else if(order_pages===63){
                    pages= 63*0.85;
                 }else if(order_pages===64){
                    pages=64*0.85;
                }else if(order_pages===65){
                    pages= 65*0.85;
                 }else if(order_pages===66){
                    pages=66*0.85;
                }else if(order_pages===67){
                    pages= 67*0.85;
                }else if(order_pages===68){
                    pages=68*0.85;
                }else if(order_pages===69){
                    pages= 69*0.85;
                 }else if(order_pages===70){
                    pages=70*0.85;
                }else if(order_pages===71){
                    pages= 71*0.85;
                 }else if(order_pages===72){
                    pages=72*0.85;
                }else if(order_pages===73){
                    pages= 73*0.85;
                }else if(order_pages===74){
                    pages=74*0.85;
                }else if(order_pages===75){
                    pages= 75*0.85;
                 }else if(order_pages===76){
                    pages=76*0.85;
                }else if(order_pages===77){
                    pages= 77*0.85;
                 }else if(order_pages===78){
                    pages=78*0.85;
                }else if(order_pages===79){
                    pages= 79*0.85;
                }else if(order_pages===80){
                    pages=80*0.85;
                }else if(order_pages===81){
                    pages= 81*0.85;
                 }else if(order_pages===82){
                    pages=82*0.85;
                }else if(order_pages===83){
                    pages= 83*0.85;
                 }else if(order_pages===84){
                    pages=84*0.85;
                }else if(order_pages===85){
                    pages= 85*0.85;
                }else if(order_pages===86){
                    pages=86*0.85;
                }else if(order_pages===87){
                    pages= 87*0.85;
                 }else if(order_pages===88){
                    pages=88*0.85;
                }else if(order_pages===89){
                    pages= 89;
                 }else if(order_pages===90){
                    pages=90*0.85;
                }else if(order_pages===91){
                    pages= 91*0.85;
                }else if(order_pages===92){
                    pages=92*0.85;
                }else if(order_pages===93){
                    pages= 93*0.85;
                 }else if(order_pages===94){
                    pages=94*0.85;
                }else if(order_pages===95){
                    pages= 95*0.85;
                 }else if(order_pages===96){
                    pages=96*0.85;
                }else if(order_pages===97){
                    pages= 97*0.85;
                }else if(order_pages===98){
                    pages=98*0.85;
                }else if(order_pages===99){
                    pages= 99*0.85;
                 }else if(order_pages===100){
                    pages=100*0.85;
                }else if(order_pages===101){
                    pages= 101*0.85;
                 }else if(order_pages===102){
                    pages=102*0.85;
                }else if(order_pages===103){
                    pages= 103*0.85;
                }else if(order_pages===104){
                    pages=104*0.85;
                }else if(order_pages===105){
                    pages= 105*0.85;
                 }else if(order_pages===106){
                    pages=106*0.85;
                }else if(order_pages===107){
                    pages= 107*0.85;
                 }else if(order_pages===108){
                    pages=108*0.85;
                }else if(order_pages===109){
                    pages= 109*0.85;
                }else if(order_pages===110){
                    pages=110*0.85;
               }else if(order_pages===111){
                    pages= 111*0.85;
                 }else if(order_pages===112){
                    pages=112*0.85;
                }else if(order_pages===113){
                    pages= 113*0.85;
                }else if(order_pages===114){
                    pages=114*0.85;
                }else if(order_pages===115){
                    pages= 115*0.85;
                 }else if(order_pages===116){
                    pages=116*0.85;
                }else if(order_pages===117){
                    pages= 117*0.85;
                 }else if(order_pages===118){
                    pages=118*0.85;
                }else if(order_pages===119){
                    pages= 119*0.85;
                }else if(order_pages===120){
                    pages=120*0.85;
               }else if(order_pages===121){
                    pages= 121*0.85;
                 }else if(order_pages===122){
                    pages=122*0.85;
                }else if(order_pages===123){
                    pages= 123*0.85;
                }else if(order_pages===124){
                    pages=124*0.85;
                }else if(order_pages===125){
                    pages= 125*0.85;
                 }else if(order_pages===126){
                    pages=126*0.85;
                }else if(order_pages===127){
                    pages= 127*0.85;
                 }else if(order_pages===128){
                    pages=128*0.85;
                }else if(order_pages===129){
                    pages= 129*0.85;
                }else if(order_pages===130){
                    pages=130*0.85;
                }else if(order_pages===131){
                    pages= 131*0.85;
                 }else if(order_pages===132){
                    pages=132*0.85;
                }else if(order_pages===133){
                    pages= 133*0.85;
                }else if(order_pages===134){
                    pages=134*0.85;
                }else if(order_pages===135){
                    pages= 135*0.85;
                 }else if(order_pages===136){
                    pages=136*0.85;
                }else if(order_pages===137){
                    pages= 137*0.85;
                 }else if(order_pages===138){
                    pages=138*0.85;
                }else if(order_pages===139){
                    pages= 139*0.85;
                }else if(order_pages===140){
                    pages=140*0.85;
                 }else if(order_pages===141){
                    pages= 141*0.85;
                 }else if(order_pages===142){
                    pages=142*0.85;
                }else if(order_pages===143){
                    pages= 143*0.85;
                }else if(order_pages===144){
                    pages=144*0.85;
                }else if(order_pages===145){
                    pages= 145*0.85;
                 }else if(order_pages===146){
                    pages=146*0.85;
                }else if(order_pages===147){
                    pages= 147*0.85;
                 }else if(order_pages===148){
                    pages=148*0.85;
                }else if(order_pages===149){
                    pages= 149*0.85;
                }else if(order_pages===150){
                    pages=150*0.85;
                 }else if(order_pages===151){
                    pages= 151*0.85;
                 }else if(order_pages===152){
                    pages=152*0.85;
                }else if(order_pages===153){
                    pages= 153*0.85;
                }else if(order_pages===154){
                    pages=154*0.85;
                }else if(order_pages===155){
                    pages= 155*0.85;
                 }else if(order_pages===156){
                    pages=156*0.85;
                }else if(order_pages===157){
                    pages= 157*0.85;
                 }else if(order_pages===158){
                    pages=158*0.85;
                }else if(order_pages===159){
                    pages= 159*0.85;
                }else if(order_pages===160){
                    pages=160*0.85;
                 }else if(order_pages===161){
                    pages= 161*0.85;
                 }else if(order_pages===162){
                    pages=162*0.85;
                }else if(order_pages===163){
                    pages= 163*0.85;
                }else if(order_pages===164){
                    pages=164*0.85;
                }else if(order_pages===165){
                    pages= 165*0.85;
                 }else if(order_pages===166){
                    pages=166*0.85;
                }else if(order_pages===167){
                    pages= 167*0.85;
                 }else if(order_pages===168){
                    pages=168*0.85;
                }else if(order_pages===169){
                    pages= 169*0.85;
                }else if(order_pages===170){
                    pages=170*0.85;
                }else if(order_pages===171){
                    pages= 171*0.85;
                 }else if(order_pages===172){
                    pages=172*0.85;
                }else if(order_pages===173){
                    pages= 173*0.85;
                }else if(order_pages===174){
                    pages=174*0.85;
                }else if(order_pages===175){
                    pages= 175*0.85;
                 }else if(order_pages===176){
                    pages=176*0.85;
                }else if(order_pages===177){
                    pages= 177*0.85;
                 }else if(order_pages===178){
                    pages=178*0.85;
                }else if(order_pages===179){
                    pages= 179*0.85;
                }else if(order_pages===180){
                    pages=180*0.85;
                 }else if(order_pages===181){
                    pages= 181*0.85;
                 }else if(order_pages===182){
                    pages=182*0.85;
                }else if(order_pages===183){
                    pages= 183*0.85;
                }else if(order_pages===184){
                    pages=184*0.85;
                }else if(order_pages===185){
                    pages= 185*0.85;
                 }else if(order_pages===186){
                    pages=186*0.85;
                }else if(order_pages===187){
                    pages= 187*0.85;
                 }else if(order_pages===188){
                    pages=188*0.85;
                }else if(order_pages===189){
                    pages= 189*0.85;
                }else if(order_pages===190){
                    pages=190*0.85;
                 }else if(order_pages===191){
                    pages= 191*0.85;
                 }else if(order_pages===192){
                    pages=192*0.85;
                }else if(order_pages===193){
                    pages= 193*0.85;
                }else if(order_pages===194){
                    pages=194*0.85;
                }else if(order_pages===195){
                    pages= 195*0.85;
                 }else if(order_pages===196){
                    pages=196*0.85;
                }else if(order_pages===197){
                    pages= 197*0.85;
                 }else if(order_pages===198){
                    pages=198*0.85;
                }else if(order_pages===199){
                    pages= 199*0.85;
                }else if(order_pages===200){
                    pages=200*0.85;
               }
               
                $('#min-amount').val('$'+(service*type*urgency*pages*level).toFixed(2));
        });
          $('#frontorder-level_id').change('focusin', function(){
                order_level = parseInt($(this).val());
                
                if(order_level===1){
                    level = 1;
                }else if(order_level===2){
                    level=1.2;
                }else if(order_level===4){
                    level= 1.3;
                 }else if(order_level===5){
                    level= 1.5;
                }
                $('#min-amount').val('$'+(service*type*urgency*pages*level).toFixed(2));
        });
    });
JS;
$this->registerJs($myscript);
?>
<div class="container">
    <div class="row">
        <div class="col-md-7">
           <h1>Sample Articles</h1>
            <h3>Category: EssayShark Samples</h3>
            <p>Samples of dissertations, essays, term papers, courseworks, portfolio etc. Get Ideas for Writing and Editing your Academic Papers.</p>
        </div>
        <div class="col-md-1">

        </div>
        <div class="col-md-4">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal',
                'action'=>Url::to(['frontorder/details']),
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
                <div class="col-md-12 col-sm-12 col-xs-12" style="background-color: white; opacity: 0.7; border-radius: 10px; color:black">
                    <h3 class="essay-font" style="text-align: center">Calculate the Price</h3>
                    <?= $form->field($frontmodel, 'service_id', [
                        'template' => '<div style="font-family: \'Open Sans\', sans-serif; ">{label}</div> <div style=" padding: 0 5px 0 5px;" class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                    ])->label('Service')->dropDownList(\app\models\Service::getServices(),
                        ['options' => [1 => ['Selected'=>'selected'], 'prompt'=> '...select Service....', 'id'=>'service-id']]) ?>

                    <?= $form->field($frontmodel, 'type_id',[
                        'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style=" padding: 0 5px 0 5px;"  class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                    ])->label('Type of Paper')->dropDownList(\app\models\Type::getTypes(),
                        ['options' => [20 => ['Selected'=>'selected'], 'prompt'=> '...select Type....', 'id'=>'type-id']]) ?>

                    <?= $form->field($frontmodel, 'urgency_id',[
                        'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style=" padding: 0 5px 0 5px;"  class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                    ])->label('Urgency')->dropDownList(\app\models\Urgency::getUrgency(), [
                        'options' => [12 => ['Selected'=>'selected'],  'prompt'=> '...select Deadline....', 'id'=>'urgency-id']]) ?>

                    <?= $form->field($frontmodel, 'pages_id',[
                        'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style="padding: 0 5px 0 5px;" class="row"><div class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                    ])->label('Pages')->dropDownList(\app\models\Pages::getPages(), [
                        'options' => [1 => ['Selected'=>'selected'],  'prompt'=> '...select Pages....', 'id'=>'pages-id']]) ?>

                    <?= $form->field($frontmodel, 'level_id',[
                        'template' => '<div style="font-family: \'Open Sans\', sans-serif; margin-top: -10px">{label}</div> <div style="padding: 0 5px 0 5px;" class="row"><div  class="col-sm-7" style="font-family: \'Open Sans\', sans-serif;" >{input}{error}{hint}</div></div>'
                    ])->label('Level')->dropDownList(\app\models\Level::getLevels(), [
                        'options' => [1 => ['Selected'=>'selected'], 'prompt'=> '...select Level....', 'id'=>'level-id']]) ?>
                    <div class="form-group" style="text-align: center">
                        <h4 style="margin-top: -10px" class="essay-font">Minimum Price: <input class="tcost" style="border: none; width: 100px" type="text" id="min-amount" value="$8.00" readonly="readonly"></h4>
                    </div>
                    <div class="form-group" style="margin-left: 10px; margin-right: 10px">
                        <?= Html::submitButton('Continue', ['class' => 'btn btn-lg btn-block btn-primary','style'=>'font-family: \'Open Sans\', sans-serif; margin-bottom: 20px;']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="row" style="margin-bottom: 20px">
        <h2 style="text-align: center">Why choose us?</h2>
        <div class="col-md-4">
            <div style="border: solid; border-width: thin; border-top: none; border-radius: 5px; border-color: #aaaaaa">
                <div style="height: 50px; margin-top: -20px; text-align: center; border-top-left-radius: 5px; border-top-right-radius:  5px; color: white; background-color: black">
                    <h3 style="line-height: 50px; vertical-align: middle">Plagiarism free work</h3>
                </div>
                <ul>
                    <li>Written from scratch</li>
                    <li>100% original work</li>
                    <li>All sources referenced correctly</li>
                    <li>A free works cited page attached</li>
                    <li>Free turnitin plagiarism report</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div style="border: solid; border-width: thin; border-top: none; border-radius: 5px; border-color: #aaaaaa">
                <div style="height: 50px; margin-top: -20px; text-align: center; border-top-left-radius: 5px; border-top-right-radius:  5px; color: white; background-color: black">
                    <h3 style="line-height: 50px; vertical-align: middle">On-time delivery</h3>
                </div>
                <ul>
                    <li>Very fast and reliable writers</li>
                    <li>Quick delivery of urgent orders</li>
                    <li>Great time management skills</li>
                    <li>Constant draft updates</li>
                    <li>Quick responses from support and writers</li>
                    <li>Enough time for revisions</li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div style="border: solid; border-width: thin; border-top: none; border-radius: 5px; border-color: #aaaaaa">
                <div style="height: 50px; margin-top: -20px; text-align: center; border-top-left-radius: 5px; border-top-right-radius:  5px; color: white; background-color: black">
                    <h3 style="line-height: 50px; vertical-align: middle">Reasonable Prices</h3>
                </div>
                <ul>
                    <li>Free cover page</li>
                    <li>Student friendly prices</li>
                    <li>Free works cited page</li>
                    <li>Up to 25% discount on all orders</li>
                </ul>
            </div>
        </div>
    </div>
</div>

