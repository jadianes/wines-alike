package manager.reports;

import java.util.Iterator;
import java.util.List;

import javax.xml.bind.JAXBContext;
import javax.xml.bind.JAXBElement;
import javax.xml.bind.JAXBException;
import javax.xml.bind.Marshaller;

import manager.reports.report.EntrySetType;
import manager.reports.report.EntryType;
import manager.reports.report.FieldType;
import manager.reports.report.ObjectFactory;

public class Report {

	String reportName;
	String table;
	private ObjectFactory of;
    private EntrySetType entries;
    
	public Report(String reportName, String table)
	{
		this.reportName = reportName;
		this.table = table;
		of = new ObjectFactory();
        entries = of.createEntrySetType();
        entries.setTable(this.table);
	}
	
	public void addEntry(List<Field> fields)
	{
		EntryType et = of.createEntryType();
		
		Iterator<Field> it = fields.iterator();
		while (it.hasNext())
		{
			Field nextField = it.next();
			FieldType newField = of.createFieldType();
			newField.setKey(nextField.key);
			newField.setType(nextField.type);
			newField.setValue(nextField.value);
			et.getField().add(newField);
		}
		
		entries.getEntry().add(et);
	}
	
	public String generate()
	{
		String res = new String();
        try {
            JAXBElement<EntrySetType> gl =
                of.createReport( entries );
            JAXBContext jc = JAXBContext.newInstance( "manager.reports.report" );
            Marshaller m = jc.createMarshaller();
            m.marshal( gl, System.out );
        } catch( JAXBException jbe ){ // Use proper exception here
            System.out.println(jbe.getStackTrace());
        }	
        return res;
	}
}
