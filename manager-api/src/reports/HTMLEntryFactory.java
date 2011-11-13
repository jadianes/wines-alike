package reports;

public class HTMLEntryFactory {

	public static HTMLEntry getHTMLEntry(String table)
	{
		if (table.compareTo("user") == 0)
		{
			return new UserHTMLEntry();
		}
		return null;	
	}
}
