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
			array('name' => 'ear_pain', 'drlabel' => 'Ear Pain', 'label' => 'Ear Pain', 'type' => 'radio'),
			array('name' => 'ear_drainage', 'drlabel' => 'Ear Drainage', 'label' => 'Ear Drainage', 'type' => 'radio'),
			array('name' => 'ear_pressure', 'drlabel' => 'Ear Pressure', 'label' => 'Ear Pressure', 'type' => 'radio'),
			array('name' => 'ear_fullness', 'drlabel' => 'Ear Fullness', 'label' => 'Ear Fullness', 'type' => 'radio'),
			array('name' => 'ringing', 'drlabel' => 'Ringing', 'label' => 'Ringing', 'type' => 'radio'),
			array('name' => 'roaring', 'drlabel' => 'Roaring', 'label' => 'Roaring', 'type' => 'radio'),
			array('name' => 'pulsing_noises', 'drlabel' => 'Pulsing Noises', 'label' => 'Pulsing Noises', 'type' => 'radio'),
			array('name' => 'dizziness', 'drlabel' => 'Dizziness', 'label' => 'Dizziness', 'type' => 'radio'),
			array('name' => 'vertigo', 'drlabel' => 'Vertigo', 'label' => 'Vertigo', 'type' => 'radio'),
			array('name' => 'ear_surgery', 'drlabel' => 'Ear Surgery', 'label' => 'Ear Surgery', 'type' => 'radio'),
			array('name' => 'ear_infections', 'drlabel' => 'Ear Infections', 'label' => 'Ear Infections', 'type' => 'radio'),
			array('name' => 'use_q_tips', 'drlabel' => 'Use Q-tips', 'label' => 'Use Q-tips', 'type' => 'radio'),
			array('name' => 'wax_buildup', 'drlabel' => 'Too much wax', 'label' => 'Too much wax', 'type' => 'radio'),
			array('name' => 'ear_tubes', 'drlabel' => 'Ear Tubes', 'label' => 'Ear Tubes', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Hearing',
		'fields' => array(
			array('name' => 'hearing_loss', 'drlabel' => 'Hearing Loss', 'label' => 'Hearing Loss', 'type' => 'radio'),
			array('name' => 'recent_hearing_changes', 'drlabel' => 'Recent Changes in Hearing', 'label' => 'Recent Changes in Hearing', 'type' => 'radio'),
			array('name' => 'hearing_up_down', 'drlabel' => 'Hearing going up and down', 'label' => 'Hearing going up and down', 'type' => 'radio'),
			array('name' => 'hearing_aids', 'drlabel' => 'Use Hearing Aids', 'label' => 'Use Hearing Aids', 'type' => 'radio'),
			array('name' => 'deafness', 'drlabel' => 'Deafness', 'label' => 'Deafness', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Nose',
		'fields' => array(
			array('name' => 'blocked_breathing', 'drlabel' => 'Obstruction (Can\'t breathe through nose)', 'label' => 'Obstruction (Can\'t breathe through nose)', 'type' => 'radio'),
			array('name' => 'post_nasal_drip', 'drlabel' => 'Post Nasal Drainage', 'label' => 'Post Nasal Drainage', 'type' => 'radio'),
			array('name' => 'stuffiness', 'drlabel' => 'Nasal Congestion/Stuffiness', 'label' => 'Nasal Congestion/Stuffiness', 'type' => 'radio'),
			array('name' => 'foul_nasal_drainage', 'drlabel' => 'Purulent/Foul Nasal Drainage', 'label' => 'Purulent/Foul Nasal Drainage', 'type' => 'radio'),
			array('name' => 'itchy_watery_nose', 'drlabel' => 'Itchy, Watery Nose', 'label' => 'Itchy, Watery Nose', 'type' => 'radio'),
			array('name' => 'frequent_sneezing', 'drlabel' => 'Frequent Sneezing', 'label' => 'Frequent Sneezing', 'type' => 'radio'),
			array('name' => 'allergies', 'drlabel' => 'Nasal Allergies', 'label' => 'Nasal Allergies', 'type' => 'radio'),
			array('name' => 'nosebleeds', 'drlabel' => 'Nosebleeds', 'label' => 'Nosebleeds', 'type' => 'radio'),
			array('name' => 'night_nose_breathing', 'drlabel' => 'Difficulty breathing through nose at night', 'label' => 'Difficulty breathing through nose at night', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Sinuses',
		'fields' => array(
			array('name' => 'sinus_headaches', 'drlabel' => 'Sinus Headaches', 'label' => 'Sinus Headaches', 'type' => 'radio'),
			array('name' => 'sinus_pressure', 'drlabel' => 'Sinus Pressure', 'label' => 'Sinus Pressure', 'type' => 'radio'),
			array('name' => 'sinus_pressure_cheeks', 'drlabel' => 'Sinus Pressure -- Cheeks', 'label' => 'Sinus Pressure -- Cheeks', 'type' => 'radio'),
			array('name' => 'sinus_pressure_forehead', 'drlabel' => 'Sinus Pressure -- Forehead', 'label' => 'Sinus Pressure -- Forehead', 'type' => 'radio'),
			array('name' => 'sinus_pressure_eyes', 'drlabel' => 'Sinus Pressure -- Between/Behind Eyes', 'label' => 'Sinus Pressure -- Between/Behind Eyes', 'type' => 'radio'),
			array('name' => 'long_colds', 'drlabel' => 'Colds last longer than average', 'label' => 'Colds last longer than average', 'type' => 'radio'),
			array('name' => 'frequent_sinus_infections', 'drlabel' => 'Frequent Sinus Infections', 'label' => 'Frequent Sinus Infections', 'type' => 'radio'),
			array('name' => 'chronic_sinus_infections', 'drlabel' => 'Chronic Sinus Infections', 'label' => 'Chronic Sinus Infections', 'type' => 'radio'),
			array('name' => 'sinus_surgery', 'drlabel' => 'Sinus Surgery', 'label' => 'Sinus Surgery', 'type' => 'radio'),
			array('name' => 'tooth_pain', 'drlabel' => 'Tooth Pain', 'label' => 'Tooth Pain', 'type' => 'radio'),
			array('name' => 'altered_smell_taste', 'drlabel' => 'Altered Smell/Taste', 'label' => 'Altered Smell/Taste', 'type' => 'radio')
		)
	),
	array(
		'name' => 'Throat',
		'fields' => array(
			array('name' => 'sore_throat', 'drlabel' => 'Sore Throat', 'label' => 'Sore Throat', 'type' => 'radio'),
			array('name' => 'dryness', 'drlabel' => 'Dry Mouth/Throat', 'label' => 'Dry Mouth/Throat', 'type' => 'radio'),
			array('name' => 'diff_swallowing', 'drlabel' => 'Difficulty Swallowing', 'label' => 'Difficulty Swallowing', 'type' => 'radio'),
			array('name' => 'painful_swallowing', 'drlabel' => 'Painful Swallowing', 'label' => 'Painful Swallowing', 'type' => 'radio'),
			array('name' => 'frequent_throat_infections', 'drlabel' => 'Frequent Throat Infections', 'label' => 'Frequent Throat Infections', 'type' => 'radio'),
			array('name' => 'frequent_tonsil_infections', 'drlabel' => 'Frequent Tonsil Infections', 'label' => 'Frequent Tonsil Infections', 'type' => 'radio'),
			array('name' => 'tonsil_adenoid_surgery', 'drlabel' => 'Previous Tonsil or Adenoid Surgery', 'label' => 'Previous Tonsil or Adenoid Surgery', 'type' => 'radio'),
			array('name' => 'hoarseness', 'drlabel' => 'Hoarseness', 'label' => 'Hoarseness', 'type' => 'radio'),
			array('name' => 'voice_fatigue', 'drlabel' => 'Voice wears out quickly', 'label' => 'Voice wears out quickly', 'type' => 'radio'),
			array('name' => 'weak_voice', 'drlabel' => 'Weak Voice', 'label' => 'Weak Voice', 'type' => 'radio'),
			array('name' => 'voice_tremor', 'drlabel' => 'Voice Tremor or Stutter', 'label' => 'Voice Tremor or Stutter', 'type' => 'radio'),
			array('name' => 'frequent_throat_clearing', 'drlabel' => 'Frequent Throat Clearing', 'label' => 'Frequent Throat Clearing', 'type' => 'radio'),
			array('name' => 'increased_phlegm', 'drlabel' => 'Increased Phlegm', 'label' => 'Increased Phlegm', 'type' => 'radio'),
			array('name' => 'food_sticking', 'drlabel' => 'Food Sticking or Going Down Wrong', 'label' => 'Food Sticking or Going Down Wrong', 'type' => 'radio')
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
		'name' => 'Skin',
		'fields' => array(
			array('name' => 'headache', 'drlabel' => 'Headache', 'label' => 'Headache', 'type' => 'radio'),
			array('name' => 'numbness', 'drlabel' => 'Numbness', 'label' => 'Numbness', 'type' => 'radio'),
			array('name' => 'weakness', 'drlabel' => 'Weakness', 'label' => 'Weakness', 'type' => 'radio'),
			array('name' => 'walking_problems', 'drlabel' => 'Walking Problems', 'label' => 'Walking Problems', 'type' => 'radio'),
			array('name' => 'rashes', 'drlabel' => 'Rashes', 'label' => 'Rashes', 'type' => 'radio')
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