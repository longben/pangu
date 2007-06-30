<?php
class WorkstationAttornLog extends AppModel {

	var $name = 'WorkstationAttornLog';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Workstation' =>
				array('className' => 'Workstation',
						'foreignKey' => 'workstation_id',
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'counterCache' => ''
				),

	);

}
?>