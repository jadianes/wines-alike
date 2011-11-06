package manager;

public class ReporterTask extends Thread {

	String user;
	String password;
	String database;
	String host;
	String table;
	
	public ReporterTask(String user, String password, String database, String host, String table)
	{
		this.user = user;
		this.password = password;
		this.database = database;
		this.host = host;
		this.table = table;
	}
	
	public void run()
	{
		WAManager manager = WAManagerFactory.getWAManager(user, password, database, host, table);
		manager.toReport();
	}
}
