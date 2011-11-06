package manager;

import java.sql.SQLException;
import java.util.LinkedList;

import manager.reports.Field;
import manager.reports.Report;


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
		String res = new String();
		Report rep = new Report(this.table, this.table);
		
		try {
			while (this.rs.next()) 
			{
				LinkedList<Field> newEntry = new LinkedList<Field>();
				
				int eventId = this.rs.getInt("event_id");
				newEntry.add(new Field("event_id","int",""+eventId));
				
				int eventType = this.rs.getInt("event_type");
			    newEntry.add(new Field("event_type","int",""+eventType));
			    
				int userId = this.rs.getInt("user_id");
			    newEntry.add(new Field("user_id","String",""+userId));
			    
				int eventActionId = this.rs.getInt("event_action_id");
			    newEntry.add(new Field("event_action_id","int",""+eventActionId));
			    
			    String eventDate = this.rs.getString("event_date");
			    newEntry.add(new Field("event_date","String",""+eventDate));
			    
			    String description = this.rs.getString("description");
			    newEntry.add(new Field("description","String",""+description));
			    
			    rep.addEntry(newEntry);
			}
			res = rep.generate();
		} catch (SQLException e) {
			e.printStackTrace();
		}			
		return res;
	}
	
}