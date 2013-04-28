/*
 * This class holds the information for a Picture object.
 * 
 * Filename:	Photo.java
 * Author:		Trevor Michael Mack
 * Date:		August 23rd, 2008
 * Version:		1.0
 */

import org.w3c.dom.Document;
import org.w3c.dom.Element;

public class Photo {

	public String name;
	public String description;
	public String filename;
	
	public final String START_TAG = "<photo>";

	/*
	 * This is the default constructor.
	 */
	public Photo() {
	}
	
	/*
	 * The constructor for the Photo class that sets all of the photo attributes.
	 * 
	 * @param name - The name of the photo.
	 * @param description - The description of the photo.
	 * @param filename - The file name of the photo (with file extension)
	 */
	public Photo(String name, String description, String filename) {
		this.name = name;
		this.description = description;
		this.filename = filename;
	}
	
	/**
	 * Helper method which creates a XML element <photo>
	 * @param dom The document object where the XML element will be added to
	 * @return XML element snippet representing a photo
	 */
	public Element getXMLElement(Document dom) {
		Element photoElement = dom.createElement("photo");

		photoElement.setAttribute("name", this.getName());
		photoElement.setAttribute("description", this.getDescription());
		photoElement.setAttribute("filename", this.getFilename());

		return photoElement;
	}
	
	public String toString() {
		String retVal = "";
		retVal += "<photo name=\"" + name + "\" description=\"" + description +
			"\" filename=\"" + filename + "\">";
		return retVal;
	}

	public String getSTART_TAG() {
		return START_TAG;
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

	public String getFilename() {
		return filename;
	}

	public void setFilename(String filename) {
		this.filename = filename;
	}
}