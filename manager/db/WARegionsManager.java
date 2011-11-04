package db;

import java.sql.SQLException;


public class WARegionsManager extends WAManager {

	public WARegionsManager(String user, String password, String database,
			String host) {
		super(user, password, database, host, "regions");
	}

	public String toString() {
		String res = new String();
		try {
			while (this.rs.next()) 
			{		
				int regionId = this.rs.getInt("region_id");
			    String regionName = this.rs.getString("region_name");
			    String country = this.rs.getString("country");
			    double latitud = this.rs.getDouble("latitud");
			    double longitud = this.rs.getDouble("latitud");
			    res = res + regionId + "\t" + regionName + "\t" + country + "\t" + latitud + "\t" + longitud + System.getProperty("line.separator");
			}
		} catch (SQLException e) {
			e.printStackTrace();
		}
		return res;
	}
	
}