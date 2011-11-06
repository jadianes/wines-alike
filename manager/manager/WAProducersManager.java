package manager;

import java.sql.SQLException;
import java.util.LinkedList;

import manager.reports.Field;
import manager.reports.Report;


public class WAProducersManager extends WAManager {

	public WAProducersManager(String user, String password, String database,
			String host) {
		super(user, password, database, host, "producers");
	}

	public String toString() {
		String res = new String();
		try {
			while (this.rs.next()) 
			{
				int producerId = this.rs.getInt("producer_id");
			    String producerName = this.rs.getString("producer_name");
			    String country = this.rs.getString("country");
			    res = res + producerId + "\t" + producerName + "\t" + country + System.getProperty("line.separator");
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
				
				int producerId = this.rs.getInt("producer_id");
				newEntry.add(new Field("producer_id","int",""+producerId));
				
			    String producerName = this.rs.getString("producer_name");
			    newEntry.add(new Field("producer_name","int",""+producerName));
			    
			    String country = this.rs.getString("country");
			    newEntry.add(new Field("country","String",""+country));

			    rep.addEntry(newEntry);
			}
			res = rep.generate();
		} catch (SQLException e) {
			e.printStackTrace();
		}			
		return res;
	}
	
}