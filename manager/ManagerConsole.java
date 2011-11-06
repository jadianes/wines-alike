

import manager.Reporter;
import manager.WAEventsManager;
import manager.WAProducersManager;
import manager.WARegionsManager;
import manager.WAUsersManager;
import manager.WAWinesManager;


public class ManagerConsole {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		
		Reporter reporter = new Reporter(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost",
				"users");
		
	}

}
