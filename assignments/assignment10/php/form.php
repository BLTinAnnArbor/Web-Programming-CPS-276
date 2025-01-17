<?php

/* HERE I REQUIRE AND USE THE STICKYFORM CLASS THAT DOES ALL THE VALIDATION AND CREATES THE STICKY 
FORM. THE STICKY FORM CLASS USES THE VALIDATION CLASS TO DO THE VALIDATION WORK.*/
require('classes/StickyForm.php');
require('classes/Pdo_methods.php');
$stickyForm = new StickyForm();


/*THE INIT FUNCTION IS WRITTEN TO START EVERYTHING OFF. IT IS CALLED FROM THE INDEX.PHP PAGE */
function init()
{
    global $elementsArr, $stickyForm;

    /* IF THE FORM WAS SUBMITTED, DO THE FOLLOWING  */
    if (isset($_POST['submit'])) {

     /* THIS METHOD TAKES THE POST ARRAY AND THE ELEMENTS ARRAY (SEE BELOW) AND PASSES THEM TO THE 
    VALIDATION FORM METHOD OF THE STICKY FORM CLASS.  IT UPDATES THE ELEMENTS ARRAY AND RETURNS 
    IT WHICH IS STORED IN THE $POSTARR VARIABLE */
        $postArr = $stickyForm->validateForm($_POST, $elementsArr);

    /* THE ELEMENTS ARRAY HAS A MASTER STATUS AREA. IF THERE ARE ANY ERRORS FOUND, THE STATUS IS 
    CHANGED TO ERRORS FROM THE DEFAULT OF NOERRORS. WHAT IS RETURNED DETERMIMES WHAT HAPPENS 
    NEXT.  IN THIS CASE, THE RETURN MESSAGE HAS NO ERRORS SO WE HAVE NO PROBLEMS WITH OUR 
    VALIDATION AND WE CAN SUBMIT THE FORM */
        if ($postArr['masterStatus']['status'] == "noerrors") {

    /*addData() IS THE METHOD TO CALL TO ADD THE FORM INFORMATION TO THE DATABASE (NOT WRITTEN IN 
    THIS EXAMPLE) THEN WE CALL THE GETFORM METHOD WHICH RETURNS AND ACKNOWLEDGEMENT AND THE 
    ORGINAL ARRAY (NOT MODIFIED). THE ACKNOWLEDGEMENT IS THE FIRST PARAMETER THE ELEMENTS ARRAY 
    IS THE ELEMENTS ARRAY WE CREATE (AGAIN SEE BELOW) */
            addData($_POST);
            return getForm("Contact Information Added", $elementsArr);
        } else {
    /* IF THERE WAS A PROBLEM WITH OUR FORM VALIDATION THEN THE MODIFIED ARRAY ($POSTARR) WILL BE 
    SENT AS THE SECOND PARAMETER.  THIS MODIFIED ARRAY IS THE SAME AS THE ELEMENTS ARRAY, BUT 
    ERROR MESSAGES AND VALUES HAVE BEEN ADDED TO DISPLAY ERRORS AND MAKE IT STICKY */
            return getForm("Please Correct Errors Below", $postArr);
        }
    } // if(isset($_POST['submit']))

    /* THIS CREATES THE FORM BASED ON THE ORIGINAL ARRAY THIS IS CALLED WHEN THE PAGE FIRST 
    LOADS AND A FORM HAS NOT BEEN SUBMITTED */ 
    else {
        return getForm("Enter Contact Info", $elementsArr);
    }
}

/* THIS IS THE DATA OF THE WHOLE FORM.  IT IS A MULTI-DIMENTIONAL ASSOCIATIVE ARRAY THAT IS USED TO 
CONTAIN FORM DATA AND ERROR MESSAGES.   EACH SUB ARRAY IS NAMED BASED UPON WHAT FORM FIELD IT IS 
ATTACHED TO. FOR EXAMPLE, "NAME" GOES TO THE TEXT FIELDS WITH THE NAME ATTRIBUTE VALUE OF "NAME". 
NOTICE THE TYPE IS "TEXT" FOR TEXT FIELD.  DEPENDING ON WHAT HAPPENS THIS ASSOCIATE ARRAY IS UPDATED.*/
$elementsArr = [
    "masterStatus" => [
        "status" => "noerrors",
        "type" => "masterStatus"
    ],
    "name" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Name cannot be blank and must, and must be a standard name</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "name"
    ],
    "address" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Address must start with numbers, a space, then letters.</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "address"
    ],
    "city" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>City must consist of letters only, and be at least two characters in length.</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "name"
    ],
    "state" => [
        "type" => "select",
        "options" => ["ca" => "California", "mi" => "Michigan", "oh" => "Ohio", "pa" => "Pennslyvania", "tx" => "Texas"],
        "selected" => "ca",
        "regex" => "name"
    ],
    "phone" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Phone cannot be blank and must be a valid phone number</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "phone"
    ],
    "email" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Cannot be blank and must be a valid email address</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "email"
    ],
    "dob" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>Cannot be blank and must be a valid date format, e.g. (07/04/2020)</span>",
        "errorOutput" => "",
        "type" => "text",
        "value" => "",
        "regex" => "dob"
    ],
    "ageRange" => [
        "errorMessage" => "<span style='color: red; margin-left: 15px;'>You must select an age range.</span>",
        "errorOutput" => "",
        "action" => "required",
        "type" => "radio",
        "value" => ["10-18" => "", "19-30" => "", "31-50" => "", "51+" => ""]
    ],
    "contactTypes" => [
        "type" => "checkbox",
        "action" => "notRequired",
        "status" => ["newsletter" => "", "emailUpdates" => "", "textUpdates" => ""]
    ]
];


// Adds data to the database
function addData($post)
{
    $name = $post['name'];
    $address = $post['address'];
    $city = $post['city'];
    $state = $post['state'];
    $phone = $post['phone'];
    $email = $post['email'];
    $dob = $post['dob'];
    $age = $post['ageRange'];

    $contacts_string = "None selected";

    if (isset($_POST['contactTypes'])) {
           $contacts_string = implode(", ",$post['contactTypes']);
        }

    $pdo = new PdoMethods();

    $sql = "INSERT INTO contacts (contact_name, address, city, state, phone, email, dob, contact_types, age_range)";
    $sql .= " VALUES (:name, :address, :city, :state, :phone, :email, :dob, :contact_types, :age_range)";

    $bindings = [
        [':name', $name, 'str'],
        [':address', $address, 'str'],
        [':city', $city, 'str'],
        [':state', $state, 'str'],
        [':phone', $phone, 'str'],
        [':email', $email, 'str'],
        [':dob', $dob, 'str'],
        [':contact_types', $contacts_string, 'str'],
        [':age_range', $age, 'str']
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === 'error') {
        return 'There was an error adding the contact';
    } else {
        return "The file has been added successfully.";
    }
} // addData()


/*THIS FUNCTION WILL BUILD THE FORM BASED UPON UPON THE 
(UNMODIFIED OR MODIFIED) ELEMENTS ARRAY. */
function getForm($acknowledgement, $elementsArr)
{
    global $stickyForm;
    $options = $stickyForm->createOptions($elementsArr['state']);

    /* THIS IS A HEREDOC STRING WHICH CREATES THE FORM AND ADDS THE APPROPRIATE VALUES AND ERROR MESSAGES */
    $form = <<<HTML
    <form method="post" action="index.php">
    <div class="form-group">
      <label for="name">Name ( Letters and spaces only ){$elementsArr['name']['errorOutput']}</label>
      <input type="text" class="form-control" id="name" name="name" value="{$elementsArr['name']['value']}" >
    </div>
    <div class="form-group">
      <label for="address">Address( Just number and street ){$elementsArr['address']['errorOutput']}</label>
      <input type="text" class="form-control" id="address" name="address" 
      value="{$elementsArr['address']['value']}" >
    </div>
    <div class="form-group">
      <label for="city">City{$elementsArr['city']['errorOutput']}</label>
      <input type="text" class="form-control" id="city" name="city" 
      value="{$elementsArr['city']['value']}" >
    </div>
    <div class="form-group">
      <label for="state">State ( Select one from drop-down menu )</label>
      <select class="form-control" id="state" name="state">
        $options
      </select>
    </div>
    <div class="form-group">
      <label for="phone">Phone ( Format 999.999.9999 ) {$elementsArr['phone']['errorOutput']}</label>
      <input type="text" class="form-control" id="phone" name="phone" value="{$elementsArr['phone']['value']}" >
    </div>
    <div class="form-group">
      <label for="email">Email Address {$elementsArr['email']['errorOutput']}</label>
      <input type="text" class="form-control" id="email" name="email" value="{$elementsArr['email']['value']}" >
    </div>
    <div class="form-group">
      <label for="dob">Date of Birth ( Format 01/01/1999 ) {$elementsArr['dob']['errorOutput']}</label>
      <input type="text" class="form-control" id="dob" name="dob" value="{$elementsArr['dob']['value']}" >
    </div>
    
    <p>Please check all contact types you would like (optional):</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contactTypes[]" id="contactType1" value="newsletter" {$elementsArr['contactTypes']['status']['newsletter']}>
      <label class="form-check-label" for="contactTypes1">Newsletter</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contactTypes[]" id="contactTypes2" value="emailUpdates" {$elementsArr['contactTypes']['status']['emailUpdates']}>
      <label class="form-check-label" for="contactTypes2">Email Updates</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="checkbox" name="contactTypes[]" id="contactTypes3" value="textUpdates" {$elementsArr['contactTypes']['status']['textUpdates']}>
      <label class="form-check-label" for="contactTypes3">Text Updates</label>
    </div>
        
    <p>Please select an age range. (you must select one):{$elementsArr['ageRange']['errorOutput']}</p>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange1" value="10-18"  {$elementsArr['ageRange']['value']['10-18']}>
      <label class="form-check-label" for="ageRange1">10-18</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange2" value="19-30"  {$elementsArr['ageRange']['value']['19-30']}>
      <label class="form-check-label" for="ageRange2">19-30</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange3" value="31-50"  {$elementsArr['ageRange']['value']['31-50']}>
      <label class="form-check-label" for="ageRange3">31-50</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="ageRange" id="ageRange4" value="51+"  {$elementsArr['ageRange']['value']['51+']}>
      <label class="form-check-label" for="ageRange4">51+</label>
    </div>
    
    <div>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>
HTML;

    /* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON 
THE INDEX PAGE. */
    return [$acknowledgement, $form];
}
