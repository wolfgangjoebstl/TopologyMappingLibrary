<?php



require_once __DIR__ . "/../libs/TopologyLibrary.inc.php";	


	class TopologyDevice extends IPSModule {


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
		 * Die Funktionen werden, mit dem selbst eingerichteten Prefix  - hier tOIPD - in PHP und JSON-RPC wie folgt zur Verfügung gestellt:.
		 */
		 
		public function CreateReport(): void
			{
			echo "Aufruf erfolgt.\n";
			}

		private function RegisterProperties(): void
			{
			$this->RegisterPropertyInteger('UpdateInterval', 0);
			echo "RegisterProperties done.\n";
			}

	}