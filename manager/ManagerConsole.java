

import manager.ManagerConfig;
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
				ManagerConfig.user, 
				ManagerConfig.password, 
				ManagerConfig.database, 
				ManagerConfig.host,
				"users");
		
		reporter = new Reporter(
				ManagerConfig.user, 
				ManagerConfig.password, 
				ManagerConfig.database, 
				ManagerConfig.host,
				"regions");
		
		reporter = new Reporter(
				ManagerConfig.user, 
				ManagerConfig.password, 
				ManagerConfig.database, 
				ManagerConfig.host,
				"producers");
		
		reporter = new Reporter(
				ManagerConfig.user, 
				ManagerConfig.password, 
				ManagerConfig.database, 
				ManagerConfig.host,
				"wines");
		
		reporter = new Reporter(
				ManagerConfig.user, 
				ManagerConfig.password, 
				ManagerConfig.database, 
				ManagerConfig.host,
				"events");
		
	}

}
