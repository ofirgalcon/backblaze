MunkiReport Backblaze Module
===================

Gets data about the current Backblaze status.

Table Schema
----
* bzversion - VARCHAR(255) - Backblaze Version
* bzlogin - VARCHAR(255)
* bzlicense - VARCHAR(255) 
* bzlicense_status - VARCHAR(255)
* safety_frozen - BOOLEAN
* lastbackupcompleted - bigInt
* remainingnumfilesforbackup - bigInt
* remainingnumbytesforbackup - bigInt 
* totnumfilesforbackup - bigInt 
* totnumbytesforbackup - bigInt 
* encrypted - BOOLEAN