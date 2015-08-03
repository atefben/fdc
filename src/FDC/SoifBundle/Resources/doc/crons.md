#SOIF

SOIF is a webservice in SOAP which enables us to get everything related to FDC Films.

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

To import a specific entity you have to use the import commands such as :
	
	php app/console fdc:soif:import_festival 1 -vvv

-vvv is for extra verbosity
	
All command use a mandatory parameter ID, which refers to the SOIF identifier.

## crons

A crontask can be set to delete log files automatically.

	php app/console fdc:soif:log_delete -vvv
	
To change the expiration date for the file you must modify soif_log_expiration parameter.

For example to delete log file older than 1 day, it will be :
	
	soif_log_expiration: '1 day'
	
Check [here](http://php.net/manual/fr/dateinterval.createfromdatestring.php) for more informations on the format used.