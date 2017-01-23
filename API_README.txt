-----------------API Documentation--------------

The API is written in PHP and gives a response in JSON. 

There is following sections in this documentation:

1. HOW TO USE THE URL
2. ERROR CODES
3. FUNCTION CALLS
4. EXAMPLES

______1. HOW TO USE THE URL______

There is different ways to use the API in the application. You can either use the 
functions in the apiMethods.php file or use it directly through the url. Observe if
you use the url in the user the only method used is 'GET'.

The API works with https://iladid3.ddns.net/api/{table} where {table} is a table from the database. 
Tables in the database we use is:

Comment
Post
User
Users

So, if you for example use the url https://iladid3.ddns.net/api/comment in the browser you
should get a message similar to this

{"status":200,"status_message":"OK","data":[....]}

where "data":[....] is all table contents from the table Comment from the database. 
Each comment row have five different fields

idComment
idPost
comment
userName
time

so a row of data from the database table Comment will look like

.... = {"idComment":"6","idPost":"43","comment":"Heeej","userName":"Something","time":"2017-01-15 16:57:47"}.

You can also specify your search with an index, but you use the url
https://iladid3.ddns.net/api/{table}/{id or username or email} instead. So if you write the url

https://iladid3.ddns.net/api/comment/43 

you will get all the comments on the Post the idPost 43. If you
use the url 

https://iladid3.ddns.net/api/comment/SovaSova3 

you will get every comment the user with username "SovaSova3" have written. However, it is not 
possible to find a specific comment. If the response is 

{"status":200,"status_message":"OK","data":[]}

the request was processed correctly but returned an empty row. This can be very useful when
you need to control weither or not an email exists, just an example. 

_________2. ERROR CODES_________

We used standard http status codes which can be found in statusCode.ini. So following response

{"status":200,"status_message":"OK","data":[....]}

means everything went well. If however you receive something like 

{"status":400,"status_message":"Bad Request","data":""}

the syntax is most likely wrong in the url. If you get a

{"status":500,"status_message":"Internal Server Error","data":""}

something have gone terrible wrong. If something is wrong with the query
to the database there will be an mysqli_error message as data which can be
viewed. For example the url https://iladid3.ddns.net/api/tapp will have
following response

{"status":500,"status_message":"Internal Server Error","data":"1146 Table 'goc_DB.Tapp' doesn't exist"}

which shows that the table you tried to access does not exist. 

_________3. FUNCTION CALLS____________

You can use the functions in apiMethods.php to retrieve, create or change information in the database. 

If we begin with the GET method, the 'getExecute($url)' function in apiMethods. You just use the URL as
input and as reponse you will get information from wanted table. How to use the URL can be found in previous
section, 1. HOW TO USE THE URL. 

The POST method is the postExecute($url, $data) which you use to add information to database. 
Depending in which table you will post the new information, the varable $data varies. For the moment
you can post new information in these tables

Post
Users
Comment

the variable $data should be an PHP array and depends on the different field in each table. If we
want to create a new row in the table Post, $data should look like following

$data =  array("userName"=> ..., "postDesc"=> ..., "postLink"=> ..., );

If it is a new user, to table Users,

$data = array("userName"=>...,"name"=>..."email"=>...,"storageLink"=>...,"trustWorthy"=>100, );

If it is for a new comment, table Comment,

$data = array("idPost"=>...,"comment"=>...,"post_uname"=>...,"uname"=>..., );

The $url should look like following https://iladid3.ddns.net/api/{table}.

Now, if you want to perform a PUT method request, it is the putExecute($url, $data) which
should be used. Unfortunately the only thing implemented for the moment is so 
the user can change their email, name or username. 

$data = array("email"=>...,"name"=>...,"userName"=>..., );

where https://iladid3.ddns.net/api/user.


_________4. EXAMPLE_____________

Here is an example from the application, used to create a new user in the database.

include 'apiMethods.php'; // Here is the postExecute function

$uname = "TestUser";
$name = "Testi TestTest";
$email = "testing@work";
$path = "Images/" . $uname;

$data = array("userName"=>$uname, // All information needed to create an user
	      "name" => $name,
	      "email" => $email,
              "storageLink"=>$path,
	      "trustWorthy" => 100, );

$url = "https://iladid3.ddns.net/api/users"; // Since it is the table users we want to insert data into
$response = postExecute($url, data);
$status = $response->status; // Get the response status code, if 200 everything OK.

if($status === 200) {

  echo "Everything went well, user created";

} else {

  echo "Something went wrong: ";
  print_r($response); // So we can see what we response status code is and if any error message in data

}




