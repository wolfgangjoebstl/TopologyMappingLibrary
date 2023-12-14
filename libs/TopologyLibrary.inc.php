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
			
		protected function uuid_v4() 
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