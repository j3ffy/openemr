<?php
$form_name = 'Ashford Review of Symptoms Checks';
$table_name = 'form_aec_ros';
$sectionCols = 3;
$radioOptions = array("N/A" => xl('N/A'),"YES" => xl('YES'),"NO" => xl('NO'));
$sections = array(
	array(
		'name' => 'General',
		'fields' => array(
			array('name' => 'weight_loss', 'drlabel' => 'Weight Loss', 'label' => 'Weight Loss', 'type' => 'radio'),
			array('name' => 'weight_gain', 'drlabel' => 'Weight Gain', 'label' => 'Weight Gain', 'type' => 'radio'),
			array('name' => 'fatigue', 'drlabel' => 'Fatigue', 'label' => 'Fatigue', 'type' => 'radio'),
			array('name' => 'night_sweats', 'drlabel' => 'Night Sweats', 'label' => 'Night Sweats', 'type' => 'radio'),
			array('name' => 'fevers_chills', 'drlabel' => 'Fevers/Chills', 'label' => 'Fevers/Chills', 'type' => 'radio'),
			array('name' => 'rashes', 'drlabel' => 'Rashes', 'label' => 'Rashes', 'type' => 'radio'),
			array('name' => 'hair_skin_nails', 'drlabel' => 'Changes to hair/skin/nails', 'label' => 'Changes to hair/skin/nails', 'type' => 'radio'),
			array('name' => 'heat_cold_intolerance', 'drlabel' => 'Heat/Cold Intolerance', 'label' => 'Heat/Cold Intolerance', 'type' => 'radio'),
			array('name' => 'bleeding_bruising', 'drlabel' => 'Easy Bleeding/Bruising', 'label' => 'Easy Bleeding/Bruising', 'type' => 'radio'),
			array('name' => 'heavy_menses', 'drlabel' => 'Heavy Menses', 'label' => 'Heavy Menses', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Eyes',
		'fields' => array(
			array('name' => 'vision_changes', 'drlabel' => 'Changes in Vision', 'label' => 'Changes in Vision', 'type' => 'radio'),
			array('name' => 'blurry_vision', 'drlabel' => 'Blurry Vision', 'label' => 'Blurry Vision', 'type' => 'radio'),
			array('name' => 'wear_glasses', 'drlabel' => 'Wear Glasses', 'label' => 'Wear Glasses', 'type' => 'radio'),
			array('name' => 'floaters', 'drlabel' => 'Floaters', 'label' => 'Floaters', 'type' => 'radio'),
			array('name' => 'glaucoma', 'drlabel' => 'Glaucoma', 'label' => 'Glaucoma', 'type' => 'radio'),
			array('name' => 'cataracts', 'drlabel' => 'Cataracts', 'label' => 'Cataracts', 'type' => 'radio'),
			array('name' => 'watery_itchy_eyes', 'drlabel' => 'Watery or Itchy Eyes', 'label' => 'Watery or Itchy Eyes', 'type' => 'radio'),
			array('name' => 'dry_eyes', 'drlabel' => 'Dry Eyes', 'label' => 'Dry Eyes', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Ears',
		'fields' => array(
			array('name' => 'hearing_loss', 'drlabel' => 'Hearing Loss', 'label' => 'Hearing Loss', 'type' => 'radio'),
			array('name' => 'ringing', 'drlabel' => 'Ringing', 'label' => 'Ringing', 'type' => 'radio'),
			array('name' => 'roaring', 'drlabel' => 'Roaring', 'label' => 'Roaring', 'type' => 'radio'),
			array('name' => 'dizziness', 'drlabel' => 'Dizziness', 'label' => 'Dizziness', 'type' => 'radio'),
			array('name' => 'vertigo', 'drlabel' => 'Vertigo', 'label' => 'Vertigo', 'type' => 'radio'),
			array('name' => 'ear_pain', 'drlabel' => 'Otalgia', 'label' => 'Ear Pain', 'type' => 'radio'),
			array('name' => 'ear_drainage', 'drlabel' => 'Ear Drainage', 'label' => 'Ear Drainage', 'type' => 'radio'),
			array('name' => 'ear_surgery', 'drlabel' => 'Ear Surgery', 'label' => 'Ear Surgery', 'type' => 'radio'),
			array('name' => 'ear_infections', 'drlabel' => 'Ear Infections', 'label' => 'Ear Infections', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Nose',
		'fields' => array(
			array('name' => 'allergies', 'drlabel' => 'Allergies', 'label' => 'Allergies', 'type' => 'radio'),
			array('name' => 'congestion', 'drlabel' => 'Congestion', 'label' => 'Congestion', 'type' => 'radio'),
			array('name' => 'stuffiness', 'drlabel' => 'Stuffiness', 'label' => 'Stuffiness', 'type' => 'radio'),
			array('name' => 'sinus_pain', 'drlabel' => 'Sinus Pain', 'label' => 'Sinus Pain', 'type' => 'radio'),
			array('name' => 'sinus_pressure', 'drlabel' => 'Sinus Pressure', 'label' => 'Sinus Pressure', 'type' => 'radio'),
			array('name' => 'sinus_surgery', 'drlabel' => 'Sinus Surgery', 'label' => 'Sinus Surgery', 'type' => 'radio'),
			array('name' => 'blocked_breathing', 'drlabel' => 'Blocked Breathing', 'label' => 'Blocked Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Throat',
		'fields' => array(
			array('name' => 'hoarseness', 'drlabel' => 'Hoarseness', 'label' => 'Hoarseness', 'type' => 'radio'),
			array('name' => 'dryness', 'drlabel' => 'Dryness', 'label' => 'Dryness', 'type' => 'radio'),
			array('name' => 'voice_fatigue', 'drlabel' => 'Voice Fatigue', 'label' => 'Voice Fatigue', 'type' => 'radio'),
			array('name' => 'frequent_throat_clearing', 'drlabel' => 'Frequent Throat Clearing', 'label' => 'Frequent Throat Clearing', 'type' => 'radio'),
			array('name' => 'increased_phlegm', 'drlabel' => 'Increased Phlegm', 'label' => 'Increased Phlegm', 'type' => 'radio'),
			array('name' => 'post_nasal_drip', 'drlabel' => 'Post Nasal Drip', 'label' => 'Post Nasal Drip', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Face',
		'fields' => array(
			array('name' => 'face_pain', 'drlabel' => 'Pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'face_numbness', 'drlabel' => 'Numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'twitching', 'drlabel' => 'Twitching', 'label' => 'Twitching', 'type' => 'radio'),
			array('name' => 'face_weakness', 'drlabel' => 'Weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'lopsided', 'drlabel' => 'Lopsided', 'label' => 'Lopsided', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neck',
		'fields' => array(
			array('name' => 'neck_pain', 'drlabel' => 'Pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'mass', 'drlabel' => 'Mass', 'label' => 'Mass', 'type' => 'radio'),
			array('name' => 'lump', 'drlabel' => 'Lump', 'label' => 'Lump', 'type' => 'radio'),
			array('name' => 'goiter', 'drlabel' => 'Goiter', 'label' => 'Goiter', 'type' => 'radio'),
			array('name' => 'spine_surgery', 'drlabel' => 'Spine Surgery', 'label' => 'Spine Surgery', 'type' => 'radio'),
			array('name' => 'decreased_mobility', 'drlabel' => 'Decreased Mobility', 'label' => 'Decreased Mobility', 'type' => 'radio'),
			array('name' => 'noisy_breathing', 'drlabel' => 'Noisy Breathing', 'label' => 'Noisy Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neuro',
		'fields' => array(
			array('name' => 'headache', 'drlabel' => 'Headache', 'label' => 'Headache', 'type' => 'radio'),
			array('name' => 'numbness', 'drlabel' => 'Numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'weakness', 'drlabel' => 'Weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'walking_problems', 'drlabel' => 'Walking Problems', 'label' => 'Walking Problems', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Heart',
		'fields' => array(
			array('name' => 'chest_pain', 'drlabel' => 'Chest Pain', 'label' => 'Chest Pain', 'type' => 'radio'),
			array('name' => 'heart_attack', 'drlabel' => 'Heart Attack', 'label' => 'Heart Attack', 'type' => 'radio'),
			array('name' => 'heart_failure', 'drlabel' => 'Heart Failure', 'label' => 'Heart Failure', 'type' => 'radio'),
			array('name' => 'abnormal_rhythm', 'drlabel' => 'Abnormal Rhythm', 'label' => 'Abnormal Rhythm', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Lungs',
		'fields' => array(
			array('name' => 'breathing_changes', 'drlabel' => 'Changes in Breathing', 'label' => 'Changes in Breathing', 'type' => 'radio'),
			array('name' => 'asthma', 'drlabel' => 'Asthma', 'label' => 'Asthma', 'type' => 'radio'),
			array('name' => 'copd', 'drlabel' => 'COPD', 'label' => 'COPD', 'type' => 'radio'),
			array('name' => 'smoking', 'drlabel' => 'Smoking', 'label' => 'Smoking', 'type' => 'radio'),
			array('name' => 'cough', 'drlabel' => 'Cough', 'label' => 'Cough', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Gastrointestinal',
		'fields' => array(
			array('name' => 'stomach_pain', 'drlabel' => 'Stomach Pain', 'label' => 'Stomach Pain', 'type' => 'radio'),
			array('name' => 'diarrhea', 'drlabel' => 'Diarrhea', 'label' => 'Diarrhea', 'type' => 'radio'),
			array('name' => 'constipation', 'drlabel' => 'Constipation', 'label' => 'Constipation', 'type' => 'radio'),
			array('name' => 'nausea', 'drlabel' => 'Nausea', 'label' => 'Nausea', 'type' => 'radio'),
			array('name' => 'vomiting', 'drlabel' => 'Vomiting', 'label' => 'Vomiting', 'type' => 'radio'),
			array('name' => 'cramping', 'drlabel' => 'Cramping', 'label' => 'Cramping', 'type' => 'radio'),
			array('name' => 'appetite_changes', 'drlabel' => 'Changes in Appetite', 'label' => 'Changes in Appetite', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Immune System',
		'fields' => array(
			array('name' => 'abnormal_lymph_nodes', 'drlabel' => 'Abnormal Lymph Nodes', 'label' => 'Abnormal Lymph Nodes', 'type' => 'radio'),
			array('name' => 'rheumatoid_arthritis', 'drlabel' => 'Rheumatoid Arthritis', 'label' => 'Rheumatoid Arthritis', 'type' => 'radio'),
			array('name' => 'lupus', 'drlabel' => 'Lupus', 'label' => 'Lupus', 'type' => 'radio'),
			array('name' => 'sjogrens', 'drlabel' => 'Sjorgren\'s', 'label' => 'Sjorgren\'s', 'type' => 'radio'),
			array('name' => 'wegeners', 'drlabel' => 'Wegener\'s', 'label' => 'Wegener\'s', 'type' => 'radio'),
			array('name' => 'psoriasis', 'drlabel' => 'Psoriasis', 'label' => 'Psoriasis', 'type' => 'radio'),
			array('name' => 'osteoarthritis', 'drlabel' => 'Osteoarthritis', 'label' => 'Osteoarthritis', 'type' => 'radio')
		)
	)
);


/** CHANGE THIS to match the folder you created for this form. **/
$form_folder = 'aec_ros';
?>