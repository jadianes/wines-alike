package manager;

import java.sql.SQLException;


public class WAEventsManager extends WAManager {

	public WAEventsManager(String user, String password, String database,
			String host) {
		super(user, password, database, host, "events");
	}

	public String toString() {
		String res = new String();
		try {
			while (this.rs.next()) 
			{						
				int eventId = this.rs.getInt("event_id");
				int eventType = this.rs.getInt("event_type");
				int userId = this.rs.getInt("user_id");
				int eventActionId = this.rs.getInt("event_action_id");
			    String eventDate = this.rs.getString("event_date");
			    String description = this.rs.getString("description");
			    res = res + eventId + "\t" + eventType + "\t" + userId + "\t" + eventActionId + "\t" + eventDate + "\t" + description + System.getProperty("line.separator");
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return res;
	}

	@Override
	public String toReport() {
		// TODO Auto-generated method stub
		return null;
	}
	
}