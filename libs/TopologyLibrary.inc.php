<?php

/*
* Topology Library class
*
* implementation base on: "https://github.com/wolfgangjoebstl/TopologyMappingLibrary
* 
* IPSymconTopologyMappingLibrary
*
* include class as trait
*
*/

namespace IPSymconTopologyMappingLibrary;

trait TopologyLibrary
	{

		protected function AddRegisterProperties(): void
			{
			$this->RegisterPropertyInteger('UpdateInterval', 0);				// general Requirement
			$this->RegisterPropertyString('UUID', "");							// unified unique idm generated with uuid-v4
			$this->RegisterPropertyString('UniqueName', "");					// Name is not unique, several "Wohnzimmer"  but only one unique Wohnzimmer__1
			$this->RegisterPropertyString('Path', "");								// Path is also a unique identifier
			
			// test some functions
			$this->RegisterPropertyBoolean('Open', false);					// Some status, just trying
			$this->RegisterPropertyInteger('ImportCategoryID', 0);			// let Category select
			
			$this->RegisterAttributeString('TopologySessionToken', '');
			$this->RegisterAttributeString('TopologyUserAuthToken', '');			
			//echo "RegisterProperties done.\n";			// kommt als Warning
			}


		/**
		 * return form actions by token.
		 *
		 * @return array
		 */
		protected function FormActions()
		{
			$form = [
				[
					'type'    => 'Label',
					'caption' => '1. Read Logitech Harmony Hub configuration:', ],
				[
					'type'    => 'Button',
					'caption' => 'Read configuration',
					'onClick' => 'HarmonyHub_getConfig($id);', ],
				[
					'type'    => 'Label',
					'caption' => '2. Setup Harmony Activities:', ],
				[
					'type'    => 'Button',
					'caption' => 'Setup Harmony',
					'onClick' => 'HarmonyHub_SetupHarmony($id);', ],
				[
					'type'    => 'Label',
					'caption' => '3. close this instance and open the Harmony configurator for setup of the devices.', ],
				[
					'type'    => 'Label',
					'caption' => 'reload firmware version and Logitech Harmony Hub name:', ],
				[
					'type'    => 'Button',
					'caption' => 'update Harmony info',
					'onClick' => 'HarmonyHub_getDiscoveryInfo($id);', ], ];

			return $form;
		}

		/**
		 * return from status.
		 *
		 * @return array
		 */
		protected function FormStatus()
		{
			$form = [
				[
					'code'    => 101,
					'icon'    => 'inactive',
					'caption' => 'Creating instance.', ],
				[
					'code'    => 102,
					'icon'    => 'active',
					'caption' => 'Harmony Hub accessible.', ],
				[
					'code'    => 104,
					'icon'    => 'inactive',
					'caption' => 'interface closed.', ],
				[
					'code'    => 201,
					'icon'    => 'inactive',
					'caption' => 'Please follow the instructions.', ],
				[
					'code'    => 202,
					'icon'    => 'error',
					'caption' => 'Harmony Hub IP adress must not empty.', ],
				[
					'code'    => 203,
					'icon'    => 'error',
					'caption' => 'No valid IP adress.', ],
				[
					'code'    => 204,
					'icon'    => 'error',
					'caption' => 'connection to the Harmony Hub lost.', ],
				[
					'code'    => 205,
					'icon'    => 'error',
					'caption' => 'field must not be empty.', ],
				[
					'code'    => 206,
					'icon'    => 'error',
					'caption' => 'select category for import.', ],
				[
					'code'    => 207,
					'icon'    => 'error',
					'caption' => 'Harmony Hub IO not found.', ], ];

			return $form;
		}
			
		protected function Uuid_v4() 
				{
				return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

					// 32 bits for "time_low"
					mt_rand(0, 0xffff), mt_rand(0, 0xffff),

					// 16 bits for "time_mid"
					mt_rand(0, 0xffff),

					// 16 bits for "time_hi_and_version",
					// four most significant bits holds version number 4
					mt_rand(0, 0x0fff) | 0x4000,

					// 16 bits, 8 bits for "clk_seq_hi_res",
					// 8 bits for "clk_seq_low",
					// two most significant bits holds zero and one for variant DCE1.1
					mt_rand(0, 0x3fff) | 0x8000,

					// 48 bits for "node"
					mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
					);
				}



	}


?>