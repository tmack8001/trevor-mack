/*
 * This is the program for auto generating an xml document for a photo album
 * xml document to be used with the web photo slbum script program originally
 * written for www.trevor-mack.com This script program is open source and
 * is made avaliable on www.trevor-mack.com under the projects section.
 *
 * Filename:	xml_generator.java
 *	Author:		Trevor Michael Mack
 * Date:			August 23rd, 2008
 *
 */

import java.awt.*;
import java.awt.event.*;
import javax.swing.*;
import java.lang.*;
import java.util.*;
import java.io.*;

//	DOM
import org.w3c.dom.*;
// Xerces classes.
import org.apache.xerces.dom.DocumentImpl;
import org.apache.xml.serialize.*;

/*
 *	xml_generator.java
 */
public class xml_generator {

public JFrame jFrame;
public JButton executeButton;

public final String ENXODING = "ISO-8859-1";
public Element e = null;
public Node n = null;
//	Document (Xerces implementation only);
Document xmldoc - new DocumentImpl();
//	Root Element
Element root = xmldoc.createElement("

public PrintWriter writer;// = new PrintWriter(new FileOutputStream("photos.xml"));

public final static String newline = "\n";
    
	 /**
     * Create the GUI for the program in the constructor.
     *
     * @param local - String representation of the local user
     * @param remote - String representation of the other user chatting
	  * @param session - the chatSession object
     *
     */
    public xml_generator() {
        
   		writer = new PrintWriter(new FileOutputStream("photos.xml"));
						
			// Create and set up the Window
         jFrame = new JFrame(("XML Photo Album Generator));
         Container container = jFrame.getContentPane();
        
         // create the un-editable textfield (JTextArea) in the center section
         JPanel center = new JPanel(new BorderLayout());
         chatArea = new JTextArea();
                 
		   // JScrollPane if the text gets too long it continues
         JScrollPane areaScrollPane = new JScrollPane(chatArea);
      
         // create the south textfield and button
         JPanel south = new JPanel(new BorderLayout());
         messageText = new JTextArea();
         messageText.setLineWrap(true);
         messageText.setWrapStyleWord(true);
         sendButton = new JButton("SEND");
				
			MyReader reader = new MyReader();
			reader.start();
			
			chatArea.setEditable(false);
         chatArea.setLineWrap(true);
         chatArea.setWrapStyleWord(true);
				
         // add components to panels
         // CENTER
         center.add(areaScrollPane);
        
         // SOUTH
         south.add(messageText);
         south.add(sendButton, BorderLayout.EAST);
        
         // add panels to container then container to the frame
         container.add(center);
         container.add(south, BorderLayout.SOUTH);
        
         // Set up the frame behavior
         jFrame.setSize(450, 300);
         jFrame.setLocation(100,100);
         jFrame.setVisible(true);
        
      }// constructor
   }// ChatWindow