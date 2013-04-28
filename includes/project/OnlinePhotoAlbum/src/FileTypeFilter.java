import java.io.File;
import java.io.FileFilter;


public class FileTypeFilter implements FileFilter {
	boolean file = false;
	String fileType = "";
	
	public FileTypeFilter(boolean filterType, String fileType) {
		super();
		file = filterType;
		if(filterType == true && fileType != "")
			this.fileType = fileType;
	}
	
	@Override
	public boolean accept(File temp) {
		boolean retVal = false;
		
		if( file == true && fileType != "")
			retVal = temp.getName().toUpperCase().endsWith(fileType);
		else if( file == true )
			retVal = temp.isFile();
		else
			retVal = temp.isDirectory();
		
		return retVal;
	}

}
