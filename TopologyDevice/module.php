<?php

/* Module class TopologyDevice
 *
 */

declare(strict_types=1);

require_once __DIR__ . "/../libs/TopologyLibrary.inc.php";	

	class TopologyDevice extends IPSModule {

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
			parent::Create();							//Never delete this line!
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
				foreach ($config as $order => $instance)
					{
					$newconfig=json_encode($instance);						// Diese Config soll gespeichert werden
					$ident=str_replace([" ","/",":","-"],"_",$instance["NAME"])."_".$instance["OID"];
					$ident=str_replace("ü","ue",$ident);				// zumindest ein paar Sonderzeichen umwandeln
					$ident=str_replace("ä","ae",$ident);
					$ident=str_replace("Ö","oe",$ident);
					$ident=str_replace(["(",")","'"],"",$ident);			// Klammern und Apostroph wegnehmen
					$ID=@$this->GetIDForIdent($ident);
					if ($ID === false)
						{
						echo "Aufruf SetDeviceList mit folgendem Array erfolgt:\n";
						print_r($config);						
						echo "   Anlegen der neuen Variable mit Identifier $ident.\n";
						$this->RegisterVariableString($ident, $instance["NAME"], '', $order);
						$oid=$this->GetIDForIdent($ident);
						echo "       war erfolgreich. Die neue ID is $oid.\n";
						//IPS_SetIcon($oid,"Tree");   /funktioniert nicht in der Instanz Umgebung, kein direkter Zugriff möglich 
						$this->SetValue($ident,$newconfig);
						}
					elseif ($newconfig !== $this->GetValue($ident))
						{
						echo "Aufruf SetDeviceList mit folgendem Array erfolgt:\n";
						print_r($config);						
						echo "Neue Konfiguration speichern $newconfig \n";
						$this->SetValue($ident,$newconfig);						
						}
					}
				}
			else
				{
				echo "Aufruf SetDeviceList mit $config erfolgt, gerade eben.\n";
				$this->SetValue('DeviceList',$config);
				}
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


		/**
		 *
		 */
		public function getConfig()
		{

		}

	}