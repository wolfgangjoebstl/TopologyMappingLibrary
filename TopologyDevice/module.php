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
			
			$this->RegisterVariables();

			$this->SetInstanceStatus();			
			
			}


		/**
		 * Die folgenden Funktionen stehen automatisch zur Verfügung, wenn das Modul über die "Module Control" eingefügt wurden.
		 * Die Funktionen werden, mit dem selbst eingerichteten Prefix  - hier TOPD - in PHP und JSON-RPC wie folgt zur Verfügung gestellt:.
		 */
		 
		public function CreateReport(): void
			{
			echo "Aufruf CreateReport erfolgt, gerade eben.\n";
			}

		public function SetInstances(): void
			{
			echo "Aufruf SetInstances erfolgt, gerade eben.\n";
			}

		public function SetDeviceList($config): void
			{
			if (is_array($config))
				{
				echo "Aufruf SetDeviceList mit folgendem Array erfolgt:\n";
				print_r($config);
				foreach ($config as $order => $instance)
					{
					$ident=str_replace([" ","/",":","-"],"_",$instance["NAME"]).$instance["OID"];
					$ident=str_replace("ü","ue",$ident);
					echo "   Anlegen der neuen Variable mit Identifier $ident.\n";
					$this->RegisterVariableString($ident, $instance["NAME"], '', $order);
					$oid=$this->GetIDForIdent($ident);
					$newconfig=json_encode($instance);
					echo "       war erfolgreich. Die neue ID is $oid.\n";
					//IPS_SetIcon($oid,"Tree");   /funktioniert nicht in der Instanz Umgebung, kein direkter Zugriff möglich 
					$this->SetValue($ident,$newconfig);
					}
				}
			else
				{
				echo "Aufruf SetDeviceList mit $config erfolgt, gerade eben.\n";
				$this->SetValue('DeviceList',$config);
				}
			}

		private function RegisterProperties(): void
			{
			$this->RegisterPropertyInteger('UpdateInterval', 0);
			//echo "RegisterProperties done.\n";			// kommt als Warning
			}

		private function RegisterVariables(): void
			{
			/* integer RegisterVariableString (string $Ident, string $Name, string $Profil, integer $Position) */
			$this->RegisterVariableString('DeviceList', 'Device Liste', '', 1000);
			}
 
		 private function SetInstanceStatus(): void
			{
			if ($this->HasActiveParent()) 
				{
				$this->SetStatus(IS_ACTIVE);
				} 
			else 
				{
				$this->SetStatus(IS_INACTIVE);
				}
			}

	}