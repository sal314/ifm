<?php
//
// helper.php
//
//	Some common routines
//

class IFMHelper {

	function getInputVars () {

		$answers = array('concreteType'     => JRequest::getVar('concreteType'),
						 'pourType'         => JRequest::getVar('pourType'),
						 'slump'            => JRequest::getVar('slump'),
						 'pourSize'         => JRequest::getVar('pourSize'),
						 'pourRate'         => JRequest::getVar('pourRate'),
						 'reinforcement'    => JRequest::getVar('reinforcement'),
						 'flatness'         => JRequest::getVar('flatness'),
						 'gradeA'           => JRequest::getVar('gradeA'),
						 'gradeB'           => JRequest::getVar('gradeB'),
						 'gradeC'			=> JRequest::getVar('gradeC'),
						 'placementA'       => JRequest::getVar('placementA'),
						 'placementB'       => JRequest::getVar('placementB'),
						 'prepSubGrade'     => JRequest::getVar('prepSubGrade'),
						 'weight'           => JRequest::getVar('weight'));
		return $answers;

	}
}
