package manager;

import java.sql.SQLException;
import java.util.LinkedList;

import manager.reports.Field;
import manager.reports.Report;


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

	@Override
	public String toReport() {
		String res = new String();
		Report rep = new Report(this.table, this.table);
		
		try {
			while (this.rs.next()) 
			{
				LinkedList<Field> newEntry = new LinkedList<Field>();
				
				int regionId = this.rs.getInt("region_id");
				newEntry.add(new Field("region_id","int",""+regionId));
				
			    String regionName = this.rs.getString("region_name");
			    newEntry.add(new Field("region_name","String",""+regionName));
			    
			    String country = this.rs.getString("country");
			    newEntry.add(new Field("country","String",""+country));
			    
			    double latitud = this.rs.getDouble("latitud");
			    newEntry.add(new Field("latitud","double",""+latitud));
			    
			    double longitud = this.rs.getDouble("latitud");
			    newEntry.add(new Field("longitud","double",""+longitud));
			    
			    rep.addEntry(newEntry);
			}
			res = rep.generate();
		} catch (SQLException e) {
			e.printStackTrace();
		}			
		return res;
	}
	
}