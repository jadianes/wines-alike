package db;

import java.sql.SQLException;


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
	
}