package db;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;

public class WAManager 
{
	String table;
	String user;
	String password;
	String database;
	String host;
	ResultSet rs;
	Connection conn;
	Statement stmt;
	
	public WAManager(String user, String password, String database, String host, String table)
	{
		this.user = user;
		this.password = password;
		this.database = database;
		this.host = host;
		this.table = table;
		
		this.conn = null;
		this.stmt = null;
		this.rs = null;
			
		try 
		{
		    Class.forName("com.mysql.jdbc.Driver").newInstance();
			this.conn = DriverManager.getConnection("jdbc:mysql://"
											+this.host+"/"
											+this.database+"?"
											+"user="+this.user+"&"
											+"password="+this.password);
			this.stmt = this.conn.createStatement();
			if (this.stmt.execute("SELECT * FROM "+this.database+"."+this.table)) 
			{
				this.rs = this.stmt.getResultSet();
			}
		} 
	 	catch (SQLException ex) 
		{
		    System.out.println("WAManager.SQLException: " + ex.getMessage());
		    System.out.println("WAManager.SQLState: " + ex.getSQLState());
		    System.out.println("WAManager.VendorError: " + ex.getErrorCode());
		}
		catch (Exception ex) 
		{
			System.out.println("WAManager.Exception: " + ex.getMessage());
		}		
	}
	
}