General Structure
There are 3 Folders by default
- www
- tmp
- data

What each folder is used for
www:
  - The public web root directory for the site
  - read only permissions from the web server.
data:
  - used to keep dynamic data files (sqlite,csv,etc.)
  - read and write web permissions
tmp:
  - general use
  - read and write web permissions

Other folders can be created, but these are setup and used with the default permissions
