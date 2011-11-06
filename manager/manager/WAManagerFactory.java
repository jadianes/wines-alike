package manager;

public class WAManagerFactory {

	public static WAManager getWAManager(String user, String password, String database, String host, String table)
	{
		if (table.compareTo("users") == 0) return new WAUsersManager(user, password, database, host);
		if (table.compareTo("regions") == 0) return new WARegionsManager(user, password, database, host);
		if (table.compareTo("producers") == 0) return new WAProducersManager(user, password, database, host);
		if (table.compareTo("wines") == 0) return new WAWinesManager(user, password, database, host);
		if (table.compareTo("events") == 0) return new WAEventsManager(user, password, database, host);
		else return null;
	}
}
