<?php
	
/* Module class TopologyDeviceGroup
 *
 */

declare(strict_types=1);
	
require_once __DIR__ . "/../libs/TopologyLibrary.inc.php";	
	
	class TopologyDeviceGroup extends IPSModule {

		use IPSymconTopologyMappingLibrary\TopologyLibrary;

		/* optionale function, überschreibt die Parent function. Sicherheitshalber default maessig einfügen.
		 * Der Konstruktor wird bei jeglichem Funktionsaufruf aufgerufen und kümmert sich um die Instanzierung. 
		 * Die Basisklasse nutzt den Konstruktor um z.B. die InstanzID zu setzen.
		 *
		 */
		 
		public function __construct($InstanceID)
			{
			parent::__construct($InstanceID);
			}
			
		/*
		 * Im Gegensatz zu Construct wird diese Funktion nur einmalig beim Erstellen der Instanz und Start von IP-Symcon aufgerufen. 
		 * Deshalb sollten hier Statusvariablen und Modul-Eigenschaften erstellt werden, die das Modul dauerhaft braucht.
		 *
		 */
		public function Create()
			{
			parent::Create();						//Never delete this line!
			$this->RegisterProperties();
			}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}



		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
		}

        /**
        * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
        * Die Funktionen werden, mit dem selbst eingerichteten Prefix, in PHP und JSON-RPC wiefolgt zur Verfügung gestellt:
        *
        * TOPDG_getDefinition();
        *
        */
        public function getDefinition() 
			{
            // Selbsterstellter Code
			
			
			}
			
        public function createUuid() 
			{
            return($this->Uuid_v4());
			
			
			}
			

		private function RegisterProperties(): void
			{
			$this->AddRegisterProperties();				// für alle Topology Instanzen gleich

			//echo "RegisterProperties done.\n";			// kommt als Warning
			}
		
		/**
		 *
		 */
		public function getConfig()
		{

		}		
	}