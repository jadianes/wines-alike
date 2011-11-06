package manager;

public class WAManagerFactory {

	public static WAManager getWAManager(String user, String password, String database, String host, String table)
	{
		if (table.compareTo("users") == 0) return new WAUsersManager(user, password, database, host);
		else return null;
	}
}
