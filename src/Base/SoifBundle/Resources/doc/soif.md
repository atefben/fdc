#SOIF

SOIF is a webservice in SOAP which enables us to get everything related to Base Films.

We developed Symfony2 Commands to call the webservice.

A soif logger writes the response of the call in a file.
You must activate it by setting soif_log: true and all the mandatories parameters (soif_preprod_url, soif_log_directory,...).

##parameters

The soif commands uses many parameters, check the app/config/parameters.yml file :

    soif_preprod_url: ~
    soif_prod_url: ~
    soif_url: '%soif_preprod_url%'
    soif_log: ~
    soif_log_directory: ~
    soif_log_expiration: ~
    soif_login: ~
    soif_password: ~
    soif_upload_directory_hd: ~
    soif_upload_directory_sd: ~

	
##commands

### GET

To import a specific entity you have to use the import commands such as :
	
	php app/console base:soif:get_festival 1 -vvv

-vvv is for extra verbosity
	
All command use a mandatory parameter ID, which refers to the SOIF identifier.

### UPDATE

To udpate all entities you have to use the following command :

    php app/console base:soif:update
    
There is 4 options :
```
--start=TIMESTAMP The start timestamp (default : the database end_timestamp value from soif_task table)
--end=TIMESTAMP   The end timestamp (default : the current timestamp)
--entity=ENTITY   Will update only the specified entity
--save            Will save the endtimestamp in the database
```
For example to update award from 1st January to 31st December 2015 you have to use :

    php app/console base:soif:update --start=1420066800 --end=1451602799 --entity=award

Update command will call also GetRemoved, to remove the entities which were deleted between the timestamp interval.

You can use websites such as :

* http://www.timestamp.fr
* http://www.epochconverter.com/

To convert date into timestamp and vice versa.

## logs

A crontask can be set to delete log files automatically.

	php app/console base:soif:log_delete -vvv
	
To change the expiration date for the file you must modify soif_log_expiration parameter.

For example to delete log file older than 1 day, it will be :
	
	soif_log_expiration: '1 day'
	
Check [here](http://php.net/manual/fr/dateinterval.createfromdatestring.php) for more informations on the format used.

## clean import

You should at least call those commands before calling other webservices to get all the mandatories tables.

    php app/console base:soif:update --start=0 --entity=country -vvv && php app/console base:soif:update --start=0 --entity=festival -vvv && php app/console base:soif:update --start=0 --entity=prize -vvv
    
## examples

    php app/console base:soif:get_media 002013c8-c64e-461a-955e-be7a7a22c166 -vvv

    php app/console base:soif:get_festival 1 -vvv

    php app/console base:soif:get_media_stream a68f9d7f-0e1a-4d92-8adc-de1ab98d16be  -vvv

    php app/console base:soif:get_award 800 -vvv
 
	php app/console base:soif:get_jury 559 -vvv
	
	php app/console base:soif:get_person 305588 -vvv
	
	php app/console base:soif:get_film 2de98426-32f6-4381-abd5-3508b969ec66 -vvv

	php app/console base:soif:get_festival_poster 72115
	
	php app/console base:soif:get_projection 724
	
	php app/console base:soif:log_delete
	
	php app/console base:soif:update --start=1420066800 --end=1451602799