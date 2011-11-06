package manager;

import java.sql.SQLException;
import java.util.LinkedList;

import manager.reports.Field;
import manager.reports.Report;


public class WAUsersManager extends WAManager {

	public WAUsersManager(String user, String password, String database,
			String host) {
		super(user, password, database, host, "users");
	}

	public String toString() {
		String res = new String();
		try {
			while (this.rs.next()) 
			{
				int userId = this.rs.getInt("user_id");
			    int userType = this.rs.getInt("user_type");
			    String userName = this.rs.getString("user_name");
			    String userEmail = this.rs.getString("email");
			    String regDate = this.rs.getString("register_date");
			    res = res + userId + "\t" + userType + "\t" + userEmail + "\t" + userName + "\t" + regDate + System.getProperty("line.separator");
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return res;
	}

	@Override
	public String toReport()
	{
		String res = new String();
		Report rep = new Report(this.table, this.table);
		
		try {
			while (this.rs.next()) 
			{
				LinkedList<Field> newEntry = new LinkedList<Field>();
				
				int userId = this.rs.getInt("user_id");
				newEntry.add(new Field("user_id","int",""+userId));
				
			    int userType = this.rs.getInt("user_type");
			    newEntry.add(new Field("user_type","int",""+userType));
			    
			    String userName = this.rs.getString("user_name");
			    newEntry.add(new Field("user_name","String",""+userName));
			    
			    String userEmail = this.rs.getString("email");
			    newEntry.add(new Field("email","String",""+userEmail));
			    
			    String regDate = this.rs.getString("register_date");
			    newEntry.add(new Field("register_date","String",""+regDate));
			    
			    rep.addEntry(newEntry);
			}
			res = rep.generate();
		} catch (SQLException e) {
			e.printStackTrace();
		}			
		return res;
	}
	
}