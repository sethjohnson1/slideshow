<?
//get the images
$image=array();
foreach (glob('slideshow_imgs/*.JPG') as $key=>$filename) $image[$key]=$filename;
//if it's lowercase...
if (empty($image)) foreach (glob('slideshow_imgs/*.jpg') as $key=>$filename) $image[$key]=$filename;
?>
<html>
<head>
<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="jquery.slides.min.js"></script>
<script type="text/javascript" src="jquery-easing.js"></script>
<style>
body{
	background-color:#aa9d8d;
}
#hand{
	position:absolute;
	bottom:-148px;
	right:314px;
	z-index:100;
	opacity:0;
}
#startover{
	display:none;
}
.wgwa-btn{
  background: #981e32;
  background-image: -webkit-linear-gradient(top, #981e32, #701424);
  background-image: -moz-linear-gradient(top, #981e32, #701424);
  background-image: -ms-linear-gradient(top, #981e32, #701424);
  background-image: -o-linear-gradient(top, #981e32, #701424);
  background-image: linear-gradient(to bottom, #981e32, #701424);
  -webkit-border-radius: 5;
  -moz-border-radius: 5;
  border-radius: 5px;
  -webkit-box-shadow: 0px 1px 3px #666666;
  -moz-box-shadow: 0px 1px 3px #666666;
  box-shadow: 0px 1px 3px #666666;
  font-size: 2em;
  font-family:arial;
  padding: 10px 20px 10px 20px;
  text-decoration: none;
  color:white;
  -webkit-text-shadow: none;
	-moz-text-shadow: none;
	text-shadow: none;
	font-weight:bold;
	text-align:center;
}
.wgwa-btn{
	width:100%;
	border-spacing: 5px;
}
.wgwa-btn:hover, .explore:hover{
  background: #701424;
  background-image: -webkit-linear-gradient(top, #701424, #5e101e);
  background-image: -moz-linear-gradient(top, #701424, #5e101e);
  background-image: -ms-linear-gradient(top, #701424, #5e101e);
  background-image: -o-linear-gradient(top, #701424, #5e101e);
  background-image: linear-gradient(to bottom, #701424, #5e101e);
  text-decoration: none;
  cursor: pointer;
  color: #bd4f19;
}
</style>
    <script>
	//add this to jQuery namespace and it can be called globally
		$.animateHand=function() {
		//$("#hand").css(	"bottom","-148px");
		//$("#hand").css(	"right","314px");
		//show in case it was hidden
		$("#hand").show();
		$( "#hand" ).animate({
			opacity: 0.55
			,bottom: "-70px",
		}, 2000,"easeOutQuint", function() {
			//first animation done
			$( "#hand" ).animate({
			//opacity: .55,
			right: "791px",
			}, 1500, 'easeOutQuint', function() {
			// second done, now fade out
				$( "#hand" ).animate({
				opacity: 0
				}, 5000, function() {
					//third done, reset then do again
					$( "#hand" ).animate({
						bottom: "-148px",
						right:"314px"
						}, 5, function() {
							//console.log(slidenumber);						
							//do the claw thing, one out of 100
							if (Math.floor((Math.random() * 100) + 1)==83) $("#hand").attr("src","claw_hand.png");
							else $("#hand").attr("src","pointing-finger.png");
							//notice NO parenthesis in setTimeout or it just calls the function immediately
							setTimeout($.animateHand,5000);
						});
					});
				});
			});
		}
	$(document).ready(function(){
	  var slidenumber=0;
	  $.animateHand();
	  
      $('#slides').slidesjs({
		  //use CSS as well
        width: 1656,
        height: 1080,
        navigation: {
			active: false,
			effect: "slide"
		},
		pagination:{
			active:false,
			effect: "slide"
		},
		play:{
			active:false,
			effect: "fade",
			interval: 10000,
			//auto: true,
			restartDelay:10000,
			
		},
		callback:{
			start: function(s){

			},
			complete: function(a){
				//hide the hand and show the button
				if (a==1){
					$("#startover").hide();
				}
				else{
					//hide the hand otherwise animation gets screwed up
					$("#hand").hide();
					$("#startover").show();
				}
				
				
				//console.log($("#img_0").css('z-index'));
				//console.log(a);
			}
		}
		/* if the effect is too slow and they swipe while its going it blanks out for a few moments
		,effect:{
			fade:{
				speed:1500,
				crossfade:true
			}
		}*/
      });

	});
  </script>
</head>
<body>
<!-- The width of the container is the width of the image divided by the nabi width (1656/1920) -->

  <div class="container" style="width:82%; margin: 0 auto">
    <div id="slides">
	  <?foreach ($image as $k=>$img):?>
	  <img src="<?=$img?>" alt="Slideshow item #<?=$k?>" id="img_<?=$k?>" />
	 <!-- img src=" http://placehold.it/1656x1080" style="" / -->
	  <?endforeach?>
      <!-- a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
      <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a -->  
    </div>
	<img id="hand" src="pointing-finger.png" alt="swiping hand" />
<a href="index.php" id="startover" class="wgwa-btn">&laquo; Start Over</a>

  </div>


</body>
</html>