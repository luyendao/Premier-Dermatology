<?php
$phone = '855-535-7175';
if(is_singular('location')){
	$status = get_post_meta(get_the_ID(), 'covid_status')[0];
	$phone = get_field('phone_number_direct');
} else {
	$status = get_option('covid_status'); 
}

$end = end(explode('/', rtrim($_SERVER['REQUEST_URI'], '/')));
$market_sub_pages_arr = _market_sub_pages_arr();
$sub_id = $market_sub_pages_arr[$end];

$sub_status = get_post_meta($sub_id, 'covid_status-'.$end)[0];
if(!empty($sub_status)) $status = $sub_status;

$hours = [];

if( have_rows('opening_hours') ):
	while ( have_rows('opening_hours') ) : the_row();
		$hours[substr(get_sub_field('day'), 0, 3)] = get_sub_field('time');
	endwhile;
endif;	

$interstitial = [
	"CLOSED" => "For the safety of our staff and patients, our office is temporarily&nbsp;closed.",
	"CLOSED_TELEDERM" => "For the safety of our staff and patients, our office is temporarily closed. However, we are offering <a href='/teledermatology/'>Teledermatology</a>, appointments at this time to help assist you from the comfort of your own&nbsp;home.",
	"OPEN" => "Our clinic is currently open and seeing patients. Our physicians & staff are following CDC guidelines to ensure your safety. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. We continue to provide dermatologic care during this challenging time, however if you are experiencing a fever, cough, shortness of breath or have come into contact with a <div class='nowrap'>COVID&#8209;19</div> patient who has tested positive, we request that you reschedule your&nbsp;appointment.",
	"OPEN_TELEDERM" => "Our location is currently open and seeing patients. Our physicians & staff are following CDC guidelines to ensure your safety. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. We are also proud to announce that we are offering teledermatology at this time to help assist you from the comfort of your own home. If you are experiencing a fever, shortness of breath or have come into contact with a <div class='nowrap'>COVID&#8209;19</div> patient who has tested positive we request that you schedule a teledermatology visit or reschedule your&nbsp;appointment.",
	"REDUCED_HOURS_TELEDERM" => "
	Our clinic is currently open but we do have reduced hours. We are currently open from ".$hours[date('D')].". Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time from ".$hours[date('D')]." and even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your&nbsp;appointment.",
    "OPEN_TELEDERM_PPE" => "Our location is currently open and seeing patients. Our physicians & staff are following CDC guidelines to ensure your safety. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. We are also proud to announce that we are offering teledermatology at this time to help assist you from the comfort of your own home. If you are experiencing a fever, cough, shortness of breath or have come into contact with a <div class='nowrap'>COVID&#8209;19</div> patient who has tested positive we request that you schedule a teledermatology visit or reschedule your&nbsp;appointment.",
	"REDUCED_HOURS_TELEDERM_PPE" => "
	Our clinic is currently open but we do have reduced hours. We are currently open from ".$hours[date('D')].". Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, cough, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"EMERGENCIES_ONLY_TELEDERM" => "During the <div class='nowrap'>COVID&#8209;19</div> pandemic, our office is OPEN for urgent care only. Our physicians & staff are following CDC guidelines to ensure your safety. We are also offering teledermatology for any skin concern. If you are experiencing a fever, cough, shortness of breath or have come into contact with a <div class='nowrap'>COVID&#8209;19</div> we request that you schedule a teledermatology visit or reschedule your appointment. We can be reached at&nbsp;<a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>.",
	"BRAND_OPTION_A" => "For the safety of our staff and patients, our offices are temporarily&nbsp;closed.",
	"BRAND_OPTION_B" => "We are sorry for the inconvenience, but unfortunately some of our offices are closed at this time. Please check your local clinic to see hours of&nbsp;operation.",
	"OPEN_TELEDERM_ORDINANCE" => "During the COVID&#8209;19 pandemic, our office is OPEN and seeing patients. We are also offering teledermatology for many skin concerns. In complying with WI Emergency Order #12 or have a fever/cough or know/suspected COVID-19 exposure, you will need to reschedule your appointment. ",
	"EMERGENCIES_ONLY" => "During the <div class='nowrap'>COVID&#8209;19</div> pandemic, our office is OPEN for urgent care only. We can be reached at&nbsp;<a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>.",
	"BRAND_TELEDERM" => "We are proud to announce that our locations are now offering teledermatology at this time to help assist you from the comfort of your own home. If you are experiencing a fever, cough, shortness or have come into contact with a COVID&#8209;19 patient who has tested positive we request that you schedule a teledermatology visit or reschedule your appointment. Please visit your local clinic to confirm hours of operation. ",
	"GRAND_RAPIDS_EAST_PARIS" => "We apologize for the inconvenience but our Grand Rapids location has been closed. Please visit our neighboring location on Cascade Road which is less than a mile away. Or call us at (616) 678-2070 to schedule an appointment today.",
	"EAST_LANSING" => "Our clinic is currently open but we do have reduced hours. We are currently open Monday (for Mohs) from 8am to 3pm. Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"CRANBERRY_TOWNSHIP" => "Our clinic is currently open but we do have reduced hours. We are currently open on Wednesday and Thursday from 7am to 5pm. Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"CORP_DRIVE" => "Our clinic is currently open but we do have reduced hours. We are currently open on Monday and Tuesday from 7am to 5pm. Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"SHAWANO" => "We apologize for the inconvenience but our Shawano location has been closed. Please visit one of our neighboring <a href='https://forefrontdermatology.com/location/green-bay-wisconsin/'>Green Bay locations</a> or call us at <a href='tel:+19206630533' rel='nofollow' class='nowrap'>920-663-0533</a> to schedule an appointment today.",
	"OCONTO_FALLS" => "We apologize for the inconvenience but our Oconto Falls location has been closed. Please visit our neighboring Marinette location or call us at <a href='tel:+17157320699' rel='nofollow' class='nowrap'>(715) 732-0699</a> to schedule an appointment today. ",
	"BELLEUVE" => "Our clinic is currently open but we do have reduced hours. We are currently open Monday, Wednesday and Friday from 8am - 12pm. Call <a href='tel:+19206630533' rel='nofollow' class='nowrap'>(920)-663-0533</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"FOND_DU_LAC" => "Our clinic is currently open but we do have reduced hours. We are currently open Monday, Tuesday, Thursday and Friday from 8am - 12pm. Call <a href='tel:+19209230788' rel='nofollow' class='nowrap'>(920) 923-0788</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"WHITEFISH_BAY" => "Our clinic is currently open but we do have reduced hours. We are currently open Tuesday from 8am - 5pm. Call <a href='tel:+14149649030' rel='nofollow' class='nowrap'>(414) 964-9030</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"NEW_RICHMOND" => "Our clinic is currently open but we do have reduced hours. We are currently open Monday and Tuesday from 8 am to 3:30 pm. Call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"HUDSON" => "Our clinic is currently open but we do have reduced hours. We are currently open Monday- Friday from 8 am to 3:30 pm. Call&nbsp;<a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a> to book an appointment today! We are also proud to announce that we are offering teledermatology at this time that is available even on the weekends to help assist you from the comfort of your own home! If you are experiencing a fever, shortness of breath or have come into contact with a COVID&#8209;19 we request that you schedule a teledermatology visit or reschedule your appointment.",
	"MARQUETTE_MEDICAL" => "We apologize for the inconvenience but our Marquette location has been closed. Please visit our neighboring location on <a href='/location/marquette-mi-49855-harbor-hills/'>Harbor&nbsp;Hills</a>. Or call us at <a href='tel:+19062255458' rel='nofollow' class='nowrap'>(906) 225-5458</a> to schedule an appointment today.",
	"COVID_SAFETY" => "Our location is currently open for essential visits and our physicians & staff are following CDC guidelines to ensure your safety. We request that all patients wear a face covering for in-office visits. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. We are also proud to announce that we are offering teledermatology at this time to help assist you from the comfort of your own home. If you are experiencing a fever, cough, shortness or have come into contact with a COVID&#8209;19 patient who has tested positive we request that you schedule a teledermatology visit or reschedule your appointment.",
    "OPEN_FACECOVERING_PPE_TELEDERM" => "
	Our location is currently open and our physicians & staff are following CDC guidelines to ensure your safety. We request that all patients wear a face covering for in-office visits. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. We are also proud to announce that we are offering teledermatology at this time to help assist you from the comfort of your own home. If you are experiencing a fever, cough, shortness of breath or have come into contact with a COVID&#8209;19 patient who has tested positive we request that you schedule a teledermatology visit or reschedule your appointment.",
    "OPEN_FACECOVERING_PPE" => "Our location is currently open and our physicians & staff are following CDC guidelines to ensure your safety.  We request that all patients wear a face covering for in&#8209;office visits. If you need to book an appointment, please call <a href='tel:+1".$phone."' rel='nofollow' class='nowrap'>".$phone."</a>. If you are experiencing a fever, cough, shortness of breath or have come into contact with a COVID&#8209;19 patient who has tested positive we request that you schedule a teledermatology visit or reschedule your appointment.", 
	"MARKET_PAGE_TELEDERM_FACECOVERING_PPE" => "Our locations are open and our physicians & staff are following CDC guidelines to ensure your safety. We request that all patients wear a face covering for in-office visits.We are now offering teledermatology to assist you from the comfort of your own home. If you are experiencing a fever, cough, shortness of breath or have come into contact with a COVID&#8209;19 patient who has tested positive we request that you schedule a teledermatology visit or reschedule your appointment. Please visit your local clinic to confirm hours of operation.", 
];
if($status != 'NONE' && !empty($status)) {
?>
<div id="interstitial">
	<div class="content">
		<?php if($status == "GRAND_RAPIDS_EAST_PARIS" || $status == "SHAWANO" || $status == "OCONTO_FALLS") { ?>
			<div class="title">ATTENTION</div>
		<?php } else { ?>
			<div class="title">Our Response To <div class="nowrap">COVID&#8209;19</div></div>
		<?php } ?>
		<?php echo $interstitial[$status]; ?><br>
		<?php if($status == "CLOSED_TELEDERM" || $status == "OPEN_TELEDERM" || $status == "EMERGENCIES_ONLY_TELEDERM" || $status == "REDUCED_HOURS_TELEDERM") { ?> <a href="tel:+1<?php echo $phone; ?>" class="button">CALL NOW TO SCHEDULE</a> <?php } ?>
		<a class="close close-interstitial" href="#"><img src="<?php echo get_template_directory_uri()."/assets/images/icons/x.svg" ?>" width="26" height="26" alt="close" /></a>
	</div>
</div>
<?php } ?>