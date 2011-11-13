package reports;

import java.sql.ResultSet;
import java.sql.SQLException;

public class UserHTMLEntry extends HTMLEntry {

	@Override
	public String toHTML(ResultSet rs) {
		String res = new String();
		try {
			res = res + "<h4>User id: "+rs.getString("user_id")+"</h4>";
			res = res + "<p>Name: "+rs.getString("user_name")+"</p>";
			res = res + "<p>Type: "+rs.getString("user_type")+"</p>";
			res = res + "<p>email: "+rs.getString("email")+"</p>";
			res = res + "<p>Reg. date: "+rs.getString("register_date")+"</p>";
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return res;
	}

}
