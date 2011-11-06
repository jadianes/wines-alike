package manager;

import java.sql.SQLException;
import java.util.LinkedList;

import manager.reports.Field;
import manager.reports.Report;


public class WAWinesManager extends WAManager {

	public WAWinesManager(String user, String password, String database,
			String host) {
		super(user, password, database, host, "wines");
	}

	public String toString() {
		String res = new String();
		try {
			while (this.rs.next()) 
			{

				int wineId = this.rs.getInt("wine_id");
  				int producerId = this.rs.getInt("producer_id");
			    String wineName = this.rs.getString("wine_name");
			    String region = this.rs.getString("region");
			    String vintage = this.rs.getString("vintage_year");
			    double avgRating = this.rs.getDouble("avg_rating");
			    int numRatings = this.rs.getInt("num_ratings");
			    res = res + wineId + "\t" + producerId + "\t" + wineName + "\t" + region + "\t" + vintage + "\t" + avgRating + "\t" + numRatings + System.getProperty("line.separator");
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
				
				int wineId = this.rs.getInt("wine_id");
				newEntry.add(new Field("wine_id","int",""+wineId));
				
  				int producerId = this.rs.getInt("producer_id");
			    newEntry.add(new Field("producer_id","int",""+producerId));

			    String wineName = this.rs.getString("wine_name");
			    newEntry.add(new Field("wine_name","String",""+wineName));

			    String region = this.rs.getString("region");
			    newEntry.add(new Field("region","String",""+region));

			    String vintage = this.rs.getString("vintage_year");
			    newEntry.add(new Field("vintage_year","String",""+vintage));
			    

			    double avgRating = this.rs.getDouble("avg_rating");
			    newEntry.add(new Field("avg_rating","double",""+avgRating));
			    
			    int numRatings = this.rs.getInt("num_ratings");
			    newEntry.add(new Field("num_ratings","int",""+numRatings));
			    
			    rep.addEntry(newEntry);
			}
			res = rep.generate();
		} catch (SQLException e) {
			e.printStackTrace();
		}			
		return res;
	}
	
}