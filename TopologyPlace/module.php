<?php
	
require_once __DIR__ . "/../libs/TopologyLibrary.inc.php";	
	
	class TopologyPlace extends IPSModule {

		/* optionale function, überschreibt die Parent function. Sicherheitshalber default maessig einfügen.
		 * Der Konstruktor wird bei jeglichem Funktionsaufruf aufgerufen und kümmert sich um die Instanzierung. 
		 * Die Basisklasse nutzt den Konstruktor um z.B. die InstanzID zu setzen.
		 *
		 */
		 
		public function __construct($InstanceID)
			{
			parent::__construct($InstanceID);
			}
			
		public function Create()
		{
			//Never delete this line!
			parent::Create();
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
        * TOPP_getDefinition();
        *
        */
        public function getDefinition() 
			{
            // Selbsterstellter Code
			
			
			}

		private function RegisterProperties(): void
			{
			$this->RegisterPropertyInteger('UpdateInterval', 0);
			$this->RegisterPropertyString('UID', "");
			//echo "RegisterProperties done.\n";			// kommt als Warning
			}
			
	}