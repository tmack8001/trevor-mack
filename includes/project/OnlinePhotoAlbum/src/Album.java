/*
 * This class holds the information for a Album object.
 * 
 * Filename:	Album.java
 * Author:		Trevor Michael Mack
 * Date:		August 23rd, 2008
 * Version:		1.0
 */

import java.util.ArrayList;
import java.util.Calendar;
import java.util.Iterator;

import org.w3c.dom.Element;
import org.w3c.dom.Document;

public class Album implements Comparable {

	public String name = "";
	public String description = "";
	public String folderName = "";
	public String date = "";
	public int cal_date = 0;
	public String location = "";
	public Photo cover = new Photo();
	
	public ArrayList<Photo> photos = new ArrayList<Photo>();
	
	public final String XML_TAG = "album>";

	/*
	 * This is the default constructor.
	 */
	public Album() {
	}
	
	/*
	 * The constructor for the Album class that sets all of the album attributes.
	 * 
	 * @param name - The name of the album.
	 * @param description - The description of the album.
	 * @param folderName - The name of the folder that this album exists in
	 * @param date - The date that is associated with this album.
	 * @param location - The location that is associated with this album.
	 * @param cover - This is the cover photo that was chosen for this album.
	 */
	public Album(String name, String description, String folderName, String date, String location, Photo cover) {
		this.name = name;
		this.description = description;
		this.folderName = folderName;
		this.date = date;
		this.location = location;
		this.cover = cover;
		setCalDate(this.date);
	}

	/**
	 * Helper method which creates a XML element <album>
	 * @param dom The document object where the XML element will be added to
	 * @return XML element snippet representing an album
	 */
	public Element getXMLElement(Document dom) {
		Element albumElement = dom.createElement("album");
		albumElement.setAttribute("name", this.getName());
		albumElement.setAttribute("description", this.getDescription());
		albumElement.setAttribute("folderName", this.getFolderName());
		albumElement.setAttribute("date", this.getDate());
		albumElement.setAttribute("location", this.getLocation());
		albumElement.setAttribute("cover", this.getCover().getFilename());
		
		//No enhanced for
		Iterator<Photo> it  = photos.iterator();
		while(it.hasNext()) {
			Photo photo = (Photo)it.next();
			//For each Photo object create <photo> element and attach it to root
			Element photoElement = photo.getXMLElement(dom);
			albumElement.appendChild(photoElement);
		}
		
		return albumElement;
	}
	
	public String toString() {
		String retVal = "";
		
		retVal += "<" + getXML_TAG() + " name=\"" + name + "\" description=\"" + description +
			"\" folderName=\"" + folderName + "\" date=\"" + date +
			"\" location=\"" + location + "\" cover=\"" + cover.toString() + "\">";
		
		for(int i=0; i<photos.size(); i++) {
			retVal += photos.get(i).toString();
		}
		retVal += "</" + getXML_TAG() + ">";
		
		return retVal;
	}
	
	public void addPhoto(Photo photo) {
		photos.add(photo);
	}

	public ArrayList<Photo> getPhotos() {
		return photos;
	}

	public void setPhotos(ArrayList<Photo> photos) {
		this.photos = photos;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}

	public String getFolderName() {
		return folderName;
	}

	public void setFolderName(String folderName) {
		this.folderName = folderName;
	}

	public String getDate() {
		return date;
	}

	public void setDate(String date) {
		this.date = date;
	}

	public String getLocation() {
		return location;
	}

	public void setLocation(String location) {
		this.location = location;
	}

	public Photo getCover() {
		return cover;
	}

	public void setCover(Photo cover) {
		this.cover = cover;
	}

	public String getXML_TAG() {
		return XML_TAG;
	}

	public void setCalDate(String date2) {
		cal_date = Integer.parseInt( (date2.substring(6,10) + "" + date2.substring(0,2) + "" + date2.substring(3,5)));
		//System.out.println(cal_date);
	}

	public int getCalDate() {
		return cal_date;
	}
	
	@Override
	public int compareTo(Object other) {
		if( this.getCalDate() > ((Album)other).getCalDate() )
			return -1;
		else if( this.getCalDate() == ((Album)other).getCalDate() )
			return 0;
		else
			return 1;
		
		//return this.getCalDate().compareTo(((Album)other).getCalDate());
	}
}