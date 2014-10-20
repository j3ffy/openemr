<?php
$form_name = 'Ashford Review of Symptoms Checks';
$table_name = 'form_aec_ros';
$sectionCols = 3;
$radioOptions = array("N/A" => xl('N/A'),"YES" => xl('YES'),"NO" => xl('NO'));
$sections = array(
	array(
		'name' => 'General',
		'fields' => array(
			array('name' => 'weight_loss', 'label' => 'Weight Loss', 'type' => 'radio'),
			array('name' => 'weight_gain', 'label' => 'Weight Gain', 'type' => 'radio'),
			array('name' => 'fatigue', 'label' => 'Fatigue', 'type' => 'radio'),
			array('name' => 'sleep_problems', 'label' => 'Sleep Problems', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Eyes',
		'fields' => array(
			array('name' => 'vision_changes', 'label' => 'Changes in Vision', 'type' => 'radio'),
			array('name' => 'blurry_vision', 'label' => 'Blurry Vision', 'type' => 'radio'),
			array('name' => 'wear_glasses', 'label' => 'Wear Glasses', 'type' => 'radio'),
			array('name' => 'floaters', 'label' => 'Floaters', 'type' => 'radio'),
			array('name' => 'glaucoma', 'label' => 'Glaucoma', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Ears',
		'fields' => array(
			array('name' => 'hearing_loss', 'label' => 'Hearing Loss', 'type' => 'radio'),
			array('name' => 'ringing', 'label' => 'Ringing', 'type' => 'radio'),
			array('name' => 'roaring', 'label' => 'Roaring', 'type' => 'radio'),
			array('name' => 'dizziness', 'label' => 'Dizziness', 'type' => 'radio'),
			array('name' => 'vertigo', 'label' => 'Vertigo', 'type' => 'radio'),
			array('name' => 'ear_pain', 'label' => 'Ear Pain', 'type' => 'radio'),
			array('name' => 'ear_drainage', 'label' => 'Ear Drainage', 'type' => 'radio'),
			array('name' => 'ear_surgery', 'label' => 'Ear Surgery', 'type' => 'radio'),
			array('name' => 'ear_infections', 'label' => 'Ear Infections', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Nose',
		'fields' => array(
			array('name' => 'allergies', 'label' => 'Allergies', 'type' => 'radio'),
			array('name' => 'congestion', 'label' => 'Congestion', 'type' => 'radio'),
			array('name' => 'stuffiness', 'label' => 'Stuffiness', 'type' => 'radio'),
			array('name' => 'sinus_pain', 'label' => 'Sinus Pain', 'type' => 'radio'),
			array('name' => 'sinus_pressure', 'label' => 'Sinus Pressure', 'type' => 'radio'),
			array('name' => 'sinus_surgery', 'label' => 'Sinus Surgery', 'type' => 'radio'),
			array('name' => 'blocked_breathing', 'label' => 'Blocked Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Throat',
		'fields' => array(
			array('name' => 'hoarseness', 'label' => 'Hoarseness', 'type' => 'radio'),
			array('name' => 'dryness', 'label' => 'Dryness', 'type' => 'radio'),
			array('name' => 'voice_fatigue', 'label' => 'Voice Fatigue', 'type' => 'radio'),
			array('name' => 'frequent_throat_clearing', 'label' => 'Frequent Throat Clearing', 'type' => 'radio'),
			array('name' => 'increased_phlegm', 'label' => 'Increased Phlegm', 'type' => 'radio'),
			array('name' => 'post_nasal_drip', 'label' => 'Post Nasal Drip', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Face',
		'fields' => array(
			array('name' => 'face_pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'face_numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'twitching', 'label' => 'Twitching', 'type' => 'radio'),
			array('name' => 'face_weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'lopsided', 'label' => 'Lopsided', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neck',
		'fields' => array(
			array('name' => 'neck_pain', 'label' => 'Pain', 'type' => 'radio'),
			array('name' => 'mass', 'label' => 'Mass', 'type' => 'radio'),
			array('name' => 'lump', 'label' => 'Lump', 'type' => 'radio'),
			array('name' => 'goiter', 'label' => 'Goiter', 'type' => 'radio'),
			array('name' => 'spine_surgery', 'label' => 'Spine Surgery', 'type' => 'radio'),
			array('name' => 'decreased_mobility', 'label' => 'Decreased Mobility', 'type' => 'radio'),
			array('name' => 'noisy_breathing', 'label' => 'Noisy Breathing', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Neuro',
		'fields' => array(
			array('name' => 'headache', 'label' => 'Headache', 'type' => 'radio'),
			array('name' => 'numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'walking_problems', 'label' => 'Walking Problems', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Heart',
		'fields' => array(
			array('name' => 'chest_pain', 'label' => 'Chest Pain', 'type' => 'radio'),
			array('name' => 'heart_attack', 'label' => 'Heart Attack', 'type' => 'radio'),
			array('name' => 'heart_failure', 'label' => 'Heart Failure', 'type' => 'radio'),
			array('name' => 'abnormal_rhythm', 'label' => 'Abnormal Rhythm', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Lungs',
		'fields' => array(
			array('name' => 'breathing_changes', 'label' => 'Changes in Breathing', 'type' => 'radio'),
			array('name' => 'asthma', 'label' => 'Asthma', 'type' => 'radio'),
			array('name' => 'copd', 'label' => 'COPD', 'type' => 'radio'),
			array('name' => 'smoking', 'label' => 'Smoking', 'type' => 'radio'),
			array('name' => 'cough', 'label' => 'Cough', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Gastrointestinal',
		'fields' => array(
			array('name' => 'stomach_pain', 'label' => 'Stomach Pain', 'type' => 'radio'),
			array('name' => 'diarrhea', 'label' => 'Diarrhea', 'type' => 'radio'),
			array('name' => 'constipation', 'label' => 'Constipation', 'type' => 'radio'),
			array('name' => 'nausea', 'label' => 'Nausea', 'type' => 'radio'),
			array('name' => 'vomiting', 'label' => 'Vomiting', 'type' => 'radio'),
			array('name' => 'cramping', 'label' => 'Cramping', 'type' => 'radio'),
			array('name' => 'appetite_changes', 'label' => 'Changes in Appetite', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Immune System',
		'fields' => array(
			array('name' => 'abnormal_lymph_nodes', 'label' => 'Abnormal Lymph Nodes', 'type' => 'radio'),
			array('name' => 'rheumatoid_arthritis', 'label' => 'Rheumatoid Arthritis', 'type' => 'radio'),
			array('name' => 'lupus', 'label' => 'Lupus', 'type' => 'radio'),
			array('name' => 'sjogrens', 'label' => 'Sjorgren\'s', 'type' => 'radio'),
			array('name' => 'wegeners', 'label' => 'Wegener\'s', 'type' => 'radio'),
			array('name' => 'psoriasis', 'label' => 'Psoriasis', 'type' => 'radio'),
			array('name' => 'osteoarthritis', 'label' => 'Osteoarthritis', 'type' => 'radio')
		)
	)
);


/** CHANGE THIS to match the folder you created for this form. **/
$form_folder = 'aec_ros';
?>