package manager;

import java.sql.SQLException;


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
		// TODO Auto-generated method stub
		return null;
	}
	
}