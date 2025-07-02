<?php

/* Module class TopologyTile
 *
 */

declare(strict_types=1);

require_once __DIR__ . "/../libs/TopologyLibrary.inc.php";	

	class TopologyTile extends IPSModule
	{
		use IPSymconTopologyMappingLibrary\TopologyLibrary;
	
		public function Create() {
			//$this->RegisterVariableBoolean("Switch", "Tile switch", ["PRESENTATION" => VARIABLE_PRESENTATION_SWITCH]);	
			//$this->EnableAction("Switch");
			
			// Visualisierungstyp auf 1 setzen, da wir HTML anbieten möchten
			//$this->SetVisualizationType(1);
			//Never delete this line!
			parent::Create();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
		}
		

		// In your module's RequestAction() method:
		public function RequestAction($Ident, $Value) {
			switch ($Ident) {
				case "Switch":
					// Process the new value (true or false)
					SetValueBoolean($this->GetIDForIdent($Ident), $Value);
					break;
				default:
					$this->LogMessage("Invalid Ident: " . $Ident, KL_ERROR);
			}
		}
		
		void GetVisualizationTile1() {
			// Füge ein Skript hinzu, um beim laden, analog zu Änderungen bei Laufzeit, die Werte zu setzen
            // Obwohl die Rückgabe von GetFullUpdateMessage ja schon JSON-codiert ist wird dennoch ein weiteres mal json_encode ausgeführt
            // Damit wird dem String Anführungszeichen hinzugefügt und eventuelle Anführungszeichen innerhalb werden korrekt escaped
            $initialHandling = '<script>handleMessage(' . json_encode($this->GetFullUpdateMessage()) . ');</script>';

            // Füge statisches HTML aus Datei hinzu
            $module = file_get_contents('./weathershow.html');

            // Gebe alles zurück. 
            // Wichtig: $initialHandling nach hinten, da die Funktion handleMessage ja erst im HTML definiert wird
            return $module . $initialHandling;
		}

		// Generiere eine Nachricht, die alle Elemente in der HTML-Darstellung aktualisiert
		private function GetFullUpdateMessage() {
			$result = []; // Initialisiere das Ergebnis-Array

							
				
			
			
			return json_encode($result);
			
		}


		
		public function Destroy() {
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges() 		{
			//Never delete this line!
			parent::ApplyChanges();
		}
	}