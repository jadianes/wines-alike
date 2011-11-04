import db.WAEventsManager;
import db.WAProducersManager;
import db.WARegionsManager;
import db.WAUsersManager;
import db.WAWinesManager;


public class ManagerConsole {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		
		System.out.println("== Users ==");
		WAUsersManager userManager = new WAUsersManager(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost");
		System.out.println(userManager.toString());
		
		System.out.println("== Regions ==");
		WARegionsManager regionsManager = new WARegionsManager(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost");
		System.out.println(regionsManager.toString());
		
		System.out.println("== Producers ==");
		WAProducersManager producersManager = new WAProducersManager(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost");
		System.out.println(producersManager.toString());
		
		System.out.println("== Wines ==");
		WAWinesManager winesManager = new WAWinesManager(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost");
		System.out.println(winesManager.toString());
		
		System.out.println("== Events ==");
		WAEventsManager eventsManager = new WAEventsManager(
				"wa_admin", 
				"WinesAlike#321", 
				"winesalike", 
				"localhost");
		System.out.println(eventsManager.toString());

	}

}
