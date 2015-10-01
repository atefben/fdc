#API

An API has been developed with the following bundles :

* [FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle)
* [NelmioApiDocBundle](https://github.com/nelmio/NelmioApiDocBundle)

All the code is available in the BaseApiBundle.

##parameters

The api parameters are available in app/config/parameters.yml :

api_version : the api version number
api_page_offset : used for the offset in Api methods returning pages such as getFilms / getProjections...

##documentation

A documentation is available online at /api/doc.
    
##examples

/api/doc/films

/api/doc/film/055f33b8-0068-4632-a458-a42e67bdf099

/api/doc/projections