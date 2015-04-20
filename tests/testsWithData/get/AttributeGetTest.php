<?php
/** ---------------------------------------------------------------------
 * tests/testsWithData/get/AttributeGetTest.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2015 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * This source code is free and modifiable under the terms of
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * @package CollectiveAccess
 * @subpackage tests
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License version 3
 *
 * ----------------------------------------------------------------------
 */

require_once(__CA_BASE_DIR__.'/tests/testsWithData/BaseTestWithData.php');

/**
 * Class AttributeGetTest
 * Note: Requires testing profile!
 */
class AttributeGetTest extends BaseTestWithData {
	# -------------------------------------------------------
	/**
	 * @var ca_objects
	 */
	private $opt_object = null;
	# -------------------------------------------------------
	public function setUp() {
		// don't forget to call parent so that the request is set up
		parent::setUp();

		/**
		 * @see http://docs.collectiveaccess.org/wiki/Web_Service_API#Creating_new_records
		 * @see https://gist.githubusercontent.com/skeidel/3871797/raw/item_request.json
		 */
		$vn_test_record = $this->addTestRecord('ca_objects', array(
			'intrinsic_fields' => array(
				'type_id' => 'image',
			),
			'attributes' => array(
				// simple text
				'internal_notes' => array(
					array(
						'internal_notes' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque ullamcorper sapien nec velit porta luctus.'
					)
				),

				// text in a container
				'external_link' => array(
					array(
						'url_source' => 'My URL source'
					),
					array(
						'url_source' => 'Another URL source'
					),
				),

				// Length
				'dimensions' => array(
					array(
						'dimensions_length' => '10 in',
						'dimensions_weight' => '2 lbs'
					),
				),

				// Integer
				'integer_test' => array(
					array(
						'integer_test' => 23,
					),
					array(
						'integer_test' => 1984,
					)
				),

				// Currency
				'currency_test' => array(
					array(
						'currency_test' => '$100',
					),
				),

				// Georeference
				'georeference' => array(
					array(
						'georeference' => '1600 Amphitheatre Parkway, Mountain View, CA',
					),
				),
			)
		));

		$this->assertGreaterThan(0, $vn_test_record);

		$this->opt_object = new ca_objects($vn_test_record);
	}
	# -------------------------------------------------------
	public function testGets() {
		$vm_ret = $this->opt_object->get('ca_objects.type_id', array('convertCodesToDisplayText' => true));
		$this->assertEquals('Image', $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.internal_notes');
		$this->assertRegExp("/^Lorem ipsum/", $vm_ret);

		$vm_ret = $this->opt_object->get('internal_notes');
		$this->assertRegExp("/^Lorem ipsum/", $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.external_link.url_source');
		$this->assertEquals("My URL source;Another URL source", $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.dimensions.dimensions_length');
		$this->assertEquals("10.0 in", $vm_ret);
		$vm_ret = $this->opt_object->get('ca_objects.dimensions.dimensions_weight');
		$this->assertEquals("2.00 lb", $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.integer_test', array('delimiter' => ' / '));
		$this->assertEquals("23 / 1984", $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.currency_test');
		$this->assertEquals("USD 100.00", $vm_ret);

		$vm_ret = $this->opt_object->get('ca_objects.georeference');
		$this->assertEquals("1600 Amphitheatre Parkway, Mountain View, CA [37.4225456,-122.0842498]", $vm_ret);
	}
	# -------------------------------------------------------
}
