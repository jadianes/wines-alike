package reports;

import java.sql.ResultSet;

public abstract class HTMLEntry {

	public abstract String toHTML(ResultSet rs);
	
}
