Features
------------
This module needs to alter the existing Drupal "Site Information" form. Specifics:

Installation
------------
* downlaod module form github into your 'modules' or directory.
* Enable the module at 'administer >> modules'.

Configuration
-------------
1. Visit the configuration page at:
   'Administration >> Configuration >> System >> Site Information'
2. Add the "Site API Key"


Example URL
-----------
below is sample url for access json of page type node by nid.
http://localhost/page_json/FOOBAR12345/17

Test Evaluation
--------------

* I am utilising below Drupal-specific solutions
   1. hook_form_FORM_ID_alter
   2. form api, form validate handler and form submit handler
   3. Drupal routing
   4. Controllor
   5. EntityInterface,serialize, drupal service and Response etc.
* Readability of code - yes
* Clear, concise commenting - yes
* List of resources used if any
   1.previous knowledge
   2. drupal api docs
* Total time to complete task - 2.5 hours
