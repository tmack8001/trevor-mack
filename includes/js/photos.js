/**
 * This script reads an xml file with the photos data and displays them.
 * It uses AJAX to load the xml file. Navigation is in the same url. 
 */

/* -------------------------------------------------- */
var debug = true;
var maxPhotosPerPage = maxPhotosPerRow * maxRowsPerPage; 
var maxAlbumsPerPage = maxAlbumsPerRow * maxRowsPerPage; 
var mode; // values 'album' or 'photo'

var album; // Global current album index 
var index; // Global current photo index in the album
var page = 0; // current page if more than 1

/* Load everything. This is the starting point and the public function. */
function loadPictures () {
  loadXml();
}

/* Initialize the parameters from the url. 
 * The url can have the parameters:
 * album: can take values 0 .. albums length
 *  if ommited the first album is considered
 */
function initParamsFromUrl() {
  var query_vars = read_querystring_Ajax();
  
  var albumValue = query_vars['album'];
  if (albumValue == undefined) { // no var passed
    album = -1;
	mode = 'album';
  } else {
    try {
      album = Number(albumValue);
	  mode = 'photo';
    } catch (e) {
      album = -1;
	  mode = 'album';
    }
  }
}

/** Called after the xml data has been loaded in order to display them. */
function display() {
  initParamsFromUrl();
  if (mode == 'album') {
    loadAlbums();
  } else {
    loadPhotos();
  }
}

function loadAlbums() {  
  var tableHtml = '<ul class="gallery">';
  var photoAlbumsSize = getPhotoAlbumsSize();
  var photoAlbumsPages = getPhotoAlbumsPages();
  var rows = Math.floor((photoAlbumsSize - page * maxAlbumsPerPage)/ maxAlbumsPerRow);
  
  if (rows > maxRowsPerPage) {
    rows = maxRowsPerPage;
  }
  
  var albumIndex = page * maxAlbumsPerPage;
  tableHtml += "";
	for (var column = 0; column < photoAlbumsSize && albumIndex < photoAlbumsSize; column++) {
	  tableHtml += "<li>";
	  tableHtml += albumCover(albumIndex);
	  albumIndex++;
	  tableHtml += "</li>";
	}
  tableHtml += "</ul><br/><br/>";
  
  document.getElementById('gallery').innerHTML = tableHtml;
  document.getElementById('gallery').style.display = 'inline';
  
  // Change album description
  document.getElementById('albumDescription').innerHTML = '';
}

/* Called every time we update the view so that the url is bookmarkable */
function updateUrl(anAlbum) {
  var hashString = "album=" + album;
  //window.location.hash = hashString; // works only in FF
  hashListener.setHash(hashString);
  //display(); // if not use hashListener
}

/* Called after having set the album variable in order to load the album */
function changeAlbum(anAlbum) {
  mode = 'photo';
  updateUrl(anAlbum);
  loadPhotos();
}

function loadPhotos() {  
  var tableHtml = '<table cellpadding="5" width="100%">';
  var albumSize = getAlbumSize(album);
  var albumPages = getAlbumPages(album);
  var rows = Math.floor((albumSize - page * maxPhotosPerPage)/ maxPhotosPerRow);
  
  if (rows > maxRowsPerPage) {
    rows = maxRowsPerPage;
  }
  
  var photoIndex = page * maxPhotosPerPage;
  tableHtml += "<tbody>";
  for (var row = 0; row < rows; row ++) {
    tableHtml += "<tr>";
    for (var column = 0; column < maxPhotosPerRow && photoIndex < albumSize; column++) {
      tableHtml += thumbnail(album, photoIndex);
      photoIndex++;
    }
    tableHtml += "</tr>";
  }
  
  if (page == albumPages - 1) { // last page
    var extraPhotos = (albumSize % maxPhotosPerRow);
    if (extraPhotos > 0) {
      tableHtml += "<tr>";
      for (var column = 0; column < maxPhotosPerRow ; column++) {
        if (extraPhotos > 0) {
          tableHtml += thumbnail(album, photoIndex);
          photoIndex++;
        } else {
          tableHtml += "<td></td>";
        }
        extraPhotos --;
      }
      tableHtml += "</tr>"
    }
  }	
  tableHtml += "</tbody></table><br/><br/>";
  tableHtml += '<div id="closebutton" class="highslide-overlay closebutton" onclick="return hs.close(this)" title="Close"></div>';
  
  // Change album description
  var albumDescription = getAlbumName(album);
  document.getElementById('gallery').innerHTML = tableHtml;
  document.getElementById('albumDescription').innerHTML = albumDescription;
  document.getElementById('gallery').style.display = 'inline';
}

function loadPhoto(selectedIndex) {
  var photoname = getPhotoName(album, index);
  var photoDescription = getPhotoDescription(album, index);
  var albumDescription = getAlbumDescription(album);
  var photoSource = getPhotoSource(album, index)
  var html = "<img id=\"photo\" name=\"photo\" " + 
  	"src=\"" + photoSource + "\"title=\"" + photoDescription + "\"alt=\"" + photoDescription + "\" />" + 
   	"<br/>" + 
   	"<span class=\"caption\" id=\"photoDescription\" >" + photoDescription + "</span>" + 
   	"<br/><br/>";
  document.getElementById('albumDescription').innerHTML = albumDescription;
  document.getElementById('gallery').innerHTML = html;
  document.getElementById('gallery').style.display = 'inline';
}


/* Returns the code to write a <td> in the thumbnails table */
function thumbnail(anAlbum, anIndex) {
  var photoname = getPhotoName(anAlbum, anIndex);
  var photoDescription = getPhotoDescription(anAlbum, anIndex);
  var str;
  str = '<td height="165px" class="thumbnail" align="center" valign="middle" text-align="center">' + 
          '<a class="highslide" onclick="return hs.expand(this)" href="' + getPhotoSource(anAlbum, anIndex) + '">' + 
  	    '<img src="' + getThumbnailSource(anAlbum, anIndex) + '"' +
            'title="Click to enlarge" alt=""/></a></td>';
  return str;
}

/* Returns the code to write a <td> in the thumbnails table */
function albumCover(anAlbum) {
  var coverName = getAlbumCover(anAlbum);
  var albumName = getAlbumName(anAlbum);
  var albumDescription = getAlbumDescription(anAlbum);
  var albumDate = getAlbumDate(anAlbum);
  var albumLocation = getAlbumLocation(anAlbum);
  var str = '<a href="photos?album='+ anAlbum + '">' +
	'<h4>' + albumName + '</h4>' +
	'<img border="0" src="' + getCoverSource(anAlbum) + '">' +
	'<br/>DATE:<br/><b>' + albumDate + '</b><br/>' +
	'LOCATION:<br/><b>' + albumLocation + '</b><br/></a>';
  return str;
}

// ------------------------------------------ Data ----------------------------------------
var xmlDoc;

/* Does an AJAX call to load the xml document. */
var req;
function loadXml() {
  req = getXMLHttpRequest();
  req.onreadystatechange=postLoadXml;
  req.open("GET", xmlDir + fileName, true);
  req.send("");
}

/* Callback function after the xml has been loaded. */
function postLoadXml() {
  if (req.readyState==4 || req.readyState=="complete") {
    xmlDoc = getXMLDocumentFromString(req.responseText);
    display();
    return true;
  } else {
    return false;
  }
}

function getXmlDocument() {
  if (xmlDoc == null) { 
    alert('Error initializing data!');	
  } 
  return xmlDoc;
}
/* Return the album cover source - src attribute. */
function getCoverSource(anAlbum) {
  var photoName = getAlbumCover(anAlbum);
  var folderName = getAlbumFolder(anAlbum);
  return (photoDir + folderName + "/" + thumbPrefix + photoName);
  //return ("/images/gallery/RIT vs. Scared Heart Weekend/Game/sm_0001.jpg");
}

function getThumbnailSource(anAlbum, anIndex) {
  var photoName = getPhotoName(anAlbum, anIndex);
  var folderName = getAlbumFolder(anAlbum);
  return (photoDir + folderName + "/" + thumbPrefix + photoName + photoExtension);
  //return ("/images/gallery/RIT vs. Scared Heart Weekend/Game/sm_0001.jpg");
}

/* Return the photo source - src attribute. */
function getPhotoSource(anAlbum, anIndex) {
  var photoName = getPhotoName(anAlbum, anIndex);
  var folderName = getAlbumFolder(anAlbum);
  return (photoDir + folderName + "/" + photoPrefix + photoName + photoExtension);
  //return ("/images/gallery/RIT vs. Scared Heart Weekend/Game/sm_0001.jpg");
}

/* Return the name of the photo given the album and index number */
function getPhotoName(anAlbum, anIndex) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  var photo = album.getElementsByTagName('photo')[anIndex];
  return photo.getAttribute("name");
}

/* Return the description of the photo given the album and index number */
function getPhotoDescription(anAlbum, anIndex) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  var photo = album.getElementsByTagName('photo')[anIndex];
  return photo.getAttribute("description");
}

/* Return the name of an album */
function getAlbumName(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("name");
}

/* Return the folder name of an album */
function getAlbumFolder(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("folderName");
}

/* Return the description of an album */
function getAlbumDescription(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("description");
}

/* Return the name of an album */
function getAlbumDate(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("date");
}

/* Return the name of an album */
function getAlbumLocation(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("location");
}

/* Return the album cover source - src attribute. */
function getAlbumCover(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getAttribute("cover");
}

/* Return the size of the current album */
function getAlbumSize(anAlbum) {
  var album = getXmlDocument().getElementsByTagName('album')[anAlbum];
  return album.getElementsByTagName('photo').length;
}

/* Return the number of albums in the collection. */
function getPhotoAlbumsSize() {
  return getXmlDocument().getElementsByTagName('album').length;
}

/* Returns the number of pages of photo albums. */
function getPhotoAlbumsPages() {
  var photoAlbumsSize = getPhotoAlbumsSize();
  var photoAlbumsPages = Math.ceil(photoAlbumsSize / maxAlbumsPerPage);
  return photoAlbumsPages;
}

/* Returns the number of pages that an album contains. */
function getAlbumPages(anAlbum) {
  var albumSize = getAlbumSize(album);
  var albumPages = Math.ceil(albumSize / maxPhotosPerPage);
  return albumPages;
}

/* Returns the page index of the photo in an album. */
function getPage(anIndex) {
  var aPage = Math.floor(anIndex / maxPhotosPerPage);
  return aPage;
}
