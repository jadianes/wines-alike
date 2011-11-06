package manager;

import java.sql.SQLException;


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
		// TODO Auto-generated method stub
		return null;
	}
	
}