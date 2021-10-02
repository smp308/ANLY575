<!DOCTYPE html>
<html lang="en">
<head>
	<title>PHP Page</title>
</head>

<body>

<?php

$nl = "\r\r";
/*
NOTE: in all cases where the exercise asks you to echo or print the result to the web page,
please precede the value with the exercise number, and put a line break <br> at the end
(or enclose the whole thing in paragraphs, or in a <div>, if appropriate)
to separate the values visually on the web page.

Example:

echo '4.1 ' . $myVariable . '<br>';

or:

echo '<p>4.1 ' . $myVariable . '</p>';

or:

echo '<div>4.1 ' . $myVariable . '</div>';

*/



/*
TOPIC 1: THE BASICS -- VARIABLES, STRINGS, COMMENTS
*/

/*
1.1 Declare a variable without setting a value for that variable.
*/

$var1 = NULL;

echo $nl . '<p> Task 1.1</p>' ;
echo $nl . '<p> The value is:' . $var1 . '</p>';

/*
1.2 Set a variable to an empty string.
*/

$var2 = '';

echo $nl . '<p> Task 1.2</p>' ;
echo $nl . '<p> The value is:' . $var2 . '</p>';


/*
1.3 Set variable to a string of text.
*/

$var3 = 'This is text';

echo $nl . '<p> Task 1.3</p>' ;
echo $nl . '<p> The value is: ' . $var3 . '</p>';

/* 
1.4 Set a variable to an integer.
*/
$var4 = 6;

echo $nl . '<p> Task 1.4</p>' ;
echo $nl . '<p> The value is: ' . $var4 . '</p>';

/*
1.5 Set a variable to a numeric string.
*/
$var5 = '24';

echo $nl . '<p> Task 1.5</p>' ;
echo $nl . '<p> The value is: ' . $var5 . '</p>';

/*
1.6 Set one of the variables above to a new value. (Redefine the value of a the variable.)
*/

$var3 = 'the new value';

echo $nl . '<p> Task 1.6</p>' ;
echo $nl . '<p> The value is: ' . $var3 . '</p>';

/*
1.7 Set a variable to a string that starts with multiple spaces and ends with multiple spaces
*/

$var7 = '       This text has spaces on both sides.      ';

echo $nl . '<p> Task 1.7</p>' ;
echo $nl . '<p> The value is: ' . $var7 . '</p>';

/*
1.8 Use the trim() function to strip the spaces from the above variable.
*/

$var8 = trim($var7);

echo $nl . '<p> Task 1.8</p>' ;
echo $nl . '<p> The value is: ' . $var8 . '</p>';


/*
1.9 Set a new variable as the concatonation (combination) of two of the above string variables.
*/

$var9 = $var3 . ' ' . $var5;

echo $nl . '<p> Task 1.9</p>' ;
echo $nl . '<p> The value is: ' . $var9 . '</p>';

/*
1.10 Set a string variable using double quotes, with one of the above variables inside.
*/

echo $nl . '<p> Task 1.10</p>' ;
echo $nl . "<p> The value is:' . $var8 . '</p>";

/* 
1.11 Set a variable that concatonates a string in single quotes and a string in double quotes.
*/
// First String
$a = 'Hello';
  
// now $a contains "HelloWorld!"
 $a = $a.  " World!";
  
// Print the String $a
 echo $nl . '<p> Task 1.11</p>' ;
 echo $nl . '<p>'. $a. '</p>';

/*
1.12 Set a string variable with double quotes and escaped double quotes inside of it.
*/
 echo $nl . '<p> Task 1.12</p>' ;
$b = " Georgetown students say \" Hoya Saxa! \"";

echo $nl . '<p>'. $b. '</p>';

/*
1.13 Echo one of the above variables to the web page, followed by an HTML break tag.
*/
echo $nl . '<p> Task 1.13</p>' ;
echo $a ."<br> theres a  break"; #<br />

/*
1.14 Replace characters within the above variable with other characters, and echo the new value to the web page, followed by an HTML break tag.
*/

$before = "Hoya Saxa";
$after  = "I can't wait until Georgetown Day";

$newphrase = str_replace($before, $after, $b);

echo $nl . '<p> Task 1.14</p>' ;
echo $newphrase. "<br> theres a  break";

/*
1.15 Set a string variable with some HTML tags in it, and echo it to the web page, followed by an HTML break tag.
*/

$var15 = '<h2>Words</h2><br>';
echo $nl . '<p> Task 1.15</p>' ;
echo $nl . $var15 . "<br> theres a  break";


/* 
1.16 Use strip_tags() on the above variable and echo it to the web page again, followed by an HTML break tag.
*/

echo $nl . '<p> Task 1.16</p>' ;
echo strip_tags($var15) . "<br>"; 

/* 
1.17 Set a variable in single quotes that includes the following inside: double quotes, an ampersand, less than, greater than.
*/
echo $nl . '<p> Task 1.17</p>' ;
$c = ' Georgetown students say " Hoya Saxa &amp I &lt3 LAU 2 &gt Leo\'s! "';

echo $c;

/* 
1.18 Use htmlentities() on the above variable, and echo it to the web page, followed by an HTML break tag,
THEN view the source code of the page in a browser and 
THEN create a multi-line PHP comment in this file
THEN copy and paste the exact text of that variable as it appears in the HTML source code.
*/

echo $nl . '<p> Task 1.18</p>' ;
echo htmlentities($c) . "<br>"; 
/* Georgetown students say " Hoya Saxa & I <3 LAU 2 > Leo's! "
		vs.
       Georgetown students say " Hoya Saxa &amp I &lt3 LAU 2 &gt Leo's! " */

/* 
1.19 Write a single line PHP comment.
*/

// a single line comment.

/* 
1.20 Use PHP to get the current date and time, and echo it to the web page in this format: YYYY-MM-DD HH:MM:SS where HH is 24 hour time (not 12 hours).
*/

echo $nl . '<p> Task 1.20</p>' ;
$var20 = date("Y-m-d H:i:s ");
echo $nl . '<p>' . $var20 . '</p>';


/*
TOPIC 2: ARRAYS
*/

/*
2.1 Declare variable as an empty array.
*/

$array1 = array();
echo $nl . '<p> Task 2.1</p>' ;
//echo  '<pre>' . $print_r($array1, true) . '</p>' ;


/* 
2.2 Add five values, one at a time, to the above array (as a simple array)
*/

 $array1[] = 'banana' ;
 $array1[] = 'apple';
 $array1[] = 'orange';
 $array1[] = 'mango';
 $array1[] = 'pear';
 echo $nl . '<p> Task 2.2</p>' ;
 echo '<pre>'; print_r($array1); echo '</pre>';

/*
2.3 Create a simple array with 5 values already in the array when you declare it.
*/

$array3 = array('blueberry', 'strawberry', 'plum','peach','blackberry');
echo $nl . '<p> Task 2.3</p>' ;
echo '<pre>'; print_r($array3); echo '</pre>';



/*
2.4 Use print_r() on one of the arrays above REDUNDANT
*/

/*
2.5 Use print_r() surrounded by <pre> tags on one of the arrays above. REDUNDANT
*/

/*
2.6 Combine the two arrays into one array.
 */

$array6 = array_merge($array1, $array3);

echo $nl . '<p> Task 2.6</p>' ;
echo '<pre>'; print_r($array6); echo '</pre>';

/*
2.7 Use print_r() surrounded by <pre> tags on the combined array.
*/

echo $nl . '<p> Task 2.7</p>' ;
echo '<pre>'; print_r($array6); echo '</pre>';

/*
2.8 Sort the combined array alphabetically and use print_r() surrounded by <pre> tags on the array.
*/

sort($array6);

echo $nl . '<p> Task 2.8</p>' ;
echo '<pre>'; print_r($array6); echo '</pre>';

/*
2.9 Sort the combined array in reverse alphabetical order and use print_r() surrounded by <pre> tags on the array.
*/

rsort($array6);

echo $nl . '<p> Task 2.9</p>' ;
echo '<pre>'; print_r($array6); echo '</pre>';

/*
2.10 Set a new variable to the resulting value of using implode() on the combined array, and echo the result to the web page,
THEN paste the result into a PHP comment.
*/


$varar = implode(', ' , $array6);

echo $nl . '<p> Task 2.10</p>' ;
echo '<pre>'; print_r($varar); echo '</pre>';
//strawberry, plum, pear, peach, orange, mango, blueberry, blackberry, banana, apple


/* 
2.11 Use a built-in PHP function to count the total number of items in the array.
*/
echo $nl . '<p> Task 2.11</p>' ;
echo var_dump(count($array6));

/*
2.12 Echo the second item in the array, using the numeric key of the array.
*/

echo $nl . '<p> Task 2.12</p>' ;
echo '<pre>'; print_r($array6[1]); echo '</pre>';


/*
2.13 Create a multi-dimensional array of 5 key/value pairs.
*/

$array13 = [
'California' => 'Sacremento',
'Virginia' => 'Richmond',
'New York' => 'Albany',
'New Jersey' => 'Trenton',
'Maryland' => 'Annapolis'
];

echo $nl . '<p> Task 2.13</p>' ;
echo '<pre>'; print_r($array13); echo '</pre>';
/*
2.14 Use a built-in PHP function to sort this array by the keys, and use print_r() surrounded by <pre> tags on the array.
*/
echo $nl . '<p> Task 2.14</p>' ;
ksort($array13);

echo '<pre>'; print_r($array13); echo '</pre>';

/*
2.14 Use a built-in PHP function to sort this array by the values, and use print_r() surrounded by <pre> tags on the array.
*/
echo $nl . '<p> Task 2.14</p>' ;
asort($array13);

echo '<pre>'; print_r($array13); echo '</pre>';


/*
2.15 Add another key/value pair to this array, then sort it again by the keys, and use print_r() surrounded by <pre> tags on the array.
*/

$array13['Texas'] = 'Austin';
echo $nl . '<p> Task 2.15</p>' ;
ksort($array13);
echo '<pre>'; print_r($array13); echo '</pre>';


/*
TOPIC 3: CONDITIONAL LOGIC
*/


/*
3.1 Write a simple if/else test to see if a variable contains any value, and echo the result to the web page.
*/

echo $nl . '<p> Task 3.1</p>' ;

$var30 = '';
if($var30){
echo $nl . '<p> The variable has a value which is ' . $var30 . '</p>';
} else {
	echo $nl . '<p> The variable has NO value. </p>';
 }

/* 
3.2 Write an if/else test with 4 possibilities. For example, if it is equal to x, y, or z (you can choose what values to test for), else default,
and echo the result to the web page.
*/

echo $nl . '<p> Task 3.2</p>' ;

 if($var30 == 'pumpkin'){
 	echo $nl . '<p> The variable is "pumpkin" </p>';
 } elseif ($var30 ==5) {
 	echo $nl . '<p> The variable is "5" </p>';
 } elseif ($var30 == 'Sacremento') {
 	echo $nl . '<p> The variable is "Sacremento" </p>';
 } elseif ($var30 == 'hello world') {
 	echo $nl . '<p> The variable is "hello world" </p>';
 } elseif ($var30 =='universe') {
 	echo $nl . '<p> The variable is "universe" </p>';
 } else {
 	echo $nl . '<p> The variable did not match any conditions. </p>';
 }

/*
3.3 Write a test for the exact same conditions as above, but use switch/case syntax, and echo the result to the web page.
*/

echo $nl . '<p> Task 3.3</p>' ;

 switch ($var30) {
     case 'pumpkin':
         echo $nl . '<p> The variable is "pumpkin" </p>';
         break;
     case 5:
         echo $nl . '<p> The variable is "5" </p>';
         break;
     case 'Sacremento':
         echo $nl . '<p> The variable is "Sacremento" </p>';
         break;
     case 'hello world':
        echo $nl . '<p> The variable is "hello world" </p>';
        break;
     case 'universe':
       echo $nl . '<p> The variable is "universe" </p>';
         break;
     default:
       echo $nl . '<p> The variable did not match any conditions. </p>';;
 }

/*
3.4 Write an if/else test in which two conditions must both be true, and echo the result to the web page.
*/

echo $nl . '<p> Task 3.4</p>' ;

$var31 = 'California';
$var32 = 5;

if (is_int($var31) && is_int($var32)) {
 echo $nl . '<p> Both conditions are true. </p>';
 } else{
 	echo $nl . '<p> At least one of the conditions is false. </p>';
 }


/* 
3.5 Write an if/else test in which either one condition or the other must be true, and echo the result to the web page.
*/
echo $nl . '<p> Task 3.5</p>' ;

if (is_int($var31) || is_int($var32)) {
 	echo $nl . '<p> At lease one condition is true. </p>';
 } else{
 	echo $nl . '<p> At least one of the conditions is false. </p>';
 }

/*
3.6 Write an if/else test in which either two conditions must both be true or another condition must be true, and echo the result to the web page.
*/

 echo $nl . '<p> Task 3.6</p>' ;

 if (is_int($var31) || is_int($var32)) {
 	echo $nl . '<p> At lease one condition is true. </p>';
 } elseif (is_int($var31) && is_int($var32)){
 	echo $nl . '<p> Both conditions are true. </p>';
 }

/*
3.7 Write an if/else test using the not operator (the exclamation mark), and echo the result to the web page.
*/

 echo $nl . '<p> Task 3.7</p>' ;

 if (!is_int($var31) && is_int($var32)) {
 	echo $nl . '<p> Both conditions are true. </p>';
 } else{
 	echo $nl . '<p> At least one of the conditions is false. </p>';
 }

/*
3.8 Write an if/else test to find out if the first character of a string is the letter "A", and echo the result to the web page.
*/

 echo $nl . '<p> Task 3.8</p>' ;
 $thestring = "Abcdef";
 $test = $thestring[0]; 
 if ($test=='A') {
 	echo $test . ' is the first character of the string. <br>';
 } else{
 	echo $test . ' is the first character of the string, NOT A. <br>';
 }
/* 
3.9 Write an if/else test to find out if a variable value is an integer, or an array, or if neither, and echo the result to the web page.
*/


 echo $nl . '<p> Task 3.9</p>' ;
 $test1 = array(23, "23", 23.5, "23.5", "hey", 12312, "bye");
 if (is_int($test1)) {
 	echo $test1 . '<p> is an int. </p>';
 } elseif(is_array($test1)){
 	echo print_r($test1) . '<p> is an array. </p>';
 } else{
 	echo $test1 . '<p> is neither an int or array. </p>';
 }
/*
3.10 Write an if/else test to find out if a simple array contains a particular value 
(you can use one of your simple arrays that you created earlier in this file), and echo the result to the web page.
*/

 echo $nl . '<p> Task 3.10</p>' ;

 if (in_array("23", $test1)) {
 	echo '23' . '<p> is in the array! </p>';
 } else{
 	echo '23' . '<p> is NOT in the array! </p>';
 }


/*
3.11 Use the null coalescing operator to set the value of a variable to either:
1. the value of another variable, if it is not empty, or
2. a default value
and echo the resulting value of the variable to the web page.
*/

 echo $nl . '<p> Task 3.11</p>' ;


 $expr1 = 42;
 $test2 = $expr1 ?? $expr2;

 echo $test2 . ' is the value. <br>';
/*
TOPIC 4: MATH CALCULATIONS
*/

/*
4.1 Create two variables as integers, then create a third variable as the sum of the first two, and echo the result to the web page.
*/

 echo $nl . '<p> Task 4.1</p>' ;

 $vari1 = 10;
 $vari2 = 2;
 $vari3 = $vari1 + $vari2;

 echo "Sum: ". $vari3;  


/*
4.2 Create another variable as the product (multiplied value) of the two variables, and echo the result to the web page.
*/

 echo $nl . '<p> Task 4.2</p>' ;

 $vari4 = $vari1 * $vari2;
 echo "Product: ". $vari4; 

/*
4.3 Create another variable as the quotient (divided by) of the two variables, and echo the result to the web page.
*/


 echo $nl . '<p> Task 4.3</p>' ;

 $vari5 = $vari1 / $vari2;
 echo "Quotient: ". $vari5; 


/*
TOPIC 5: LOOPS
*/

/*
5.1 Write a for() loop to echo each value of a simple array (you can use one of your arrays above), with each item on its own line on the web page.
*/

 echo $nl . '<p> Task 5.1</p>' ;


 for ($x = 0; $x < count($test1); $x++) {
   echo $nl. "<p> value ". $x . " in the array is: " . $test1[$x] . "</p>";
 }

/*
5.2 Write a while() loop to do the same task as above.
*/

echo $nl . '<p> Task 5.2</p>' ;

$y = 0;
 while($y < count($test1)) {
   echo $nl . "<p>" .$y . ": " . $test1[$y] . "</p>";
   $y++;
 }

/*
5.3 Write a foreach() loop to do the same task as above.
*/

 echo $nl . '<p> Task 5.3</p>' ;

 echo $nl . '<p> Task 5.3</p>' ;
 echo '<ul>';

 foreach ($test1 as $value) {
 	echo '<li>' . $value . '</li>';
	
 }
 echo '</ul>';




//from class
// echo '<table><caption>State Capitals</caption><thead><tr><th scope= "col">State</th><th scope="col">Capital</th></tr></thead><tbody>';

// foreach ($array13 as $key => $value) {
// 	echo <'<tr><td>' . $key . ': ' . $value . '</td></tr>';
	
// }
// echo <'<tbody></table>';

/*
5.4 Write a foreach() loop to echo the key/value pairs of a multidimensional array (you can use one of your multidimensional arrays above).
*/

 echo $nl . '<p> Task 5.4</p>' ;

 echo '<ul>';

 foreach ($array13 as $key => $value) {
 	echo '<li>' . $key . ': ' . $value . '</li>';
	
 }
 echo '</ul>';

/*
5.5 Write a foreach() loop to find out if a multidimensional array contains a particular KEY, and echo the result to the web page.
*/

 echo $nl . '<p> Task 5.5</p>' ;

 $keySearch = 'New Jersey';

 echo print_r(array_keys($array13));
if(array_key_exists($keySearch, $array13)){
	echo $nl . '<p>' . $keySearch . ' is one of the array keys.</p>';
}else{
	echo $nl . '<p>' . $keySearch . ' is NOT one of the array keys. </p>';
}


/*
5.6 Write a foreach() loop to find out if a multidimensional array contains a particular VALUE, and echo the result to the web page.
*/ 

$valueSearch = 'Juneau';

echo $nl . '<p> Task 5.6</p>' ;
if(in_array($valueSearch, $array13)){
	echo $nl . '<p>' . $valueSearch . ' is one of the array values</p>';
}else{
	echo $nl . '<p>' . $valueSearch . ' is NOT one of the array values</p>';
}

/*
TOPIC 6: FUNCTIONS
*/

/*
6.6 Write a function to do the task in exercise 5.5 above, and send an array into that function, 
plus the value to check for (2 parameters in total), and echo the result to the web page.
You don't have to write new logic here. Just take the same logic as in 5.5. and wrap it in a function.
*/

echo $nl . '<p> Task 6.6</p>' ;

 function checkArrayKey($keySearch, $array){
 	$nl = "\r\r";
 	if(array_key_exists($keySearch, $array)) {
 		return $nl . '<p>' . $keySearch . ' is one of the array keys</p>';
 }else{
 		return $nl . '<p>' . $keySearch . ' is not one of the array keys</p>';
 	}
 }

 $output = checkArrayKey('North Carolina', $array13);
 echo $output;
 $output = checkArrayKey('South Carolina', $array13);
 echo $output;
 $output = checkArrayKey('California', $array13);
 echo $output;
 $output = checkArrayKey('New York', $array13);

 echo $output;





// function arrayToTable($array){
// 	$output = '';
// 	$output .= '<table><caption>State Capitals</caption><thead><tr><th scope= "col">State</th><th scope="col">Capital</th></tr></thead><tbody>';

// 	foreach ($array as $key => $value) {
// 		$output .= '<tr><td>' . $key . ': ' . $value . '</td></tr>';
		
// 	}
// 	$output .= '<tbody></table>';
// 	return $output;
// }

// arrayToTable($array13);

/*
6.7 Create another function that can check either the key or the value (the logic from 5.5. and 5.6 above). To call this function,
you want to send three parameters to it:
1. an array
2. the value you want to find
3. whether to search for it in the key or in the value of the array's key/value pairs.
*/

echo $nl . '<p> Task 6.7</p>' ;

function checkArrayforKeyValue($array, $value, $searchtable){
	$nl = "\r\r";
	if(strtolower($searchtable) == 'key'){
	 	if(array_key_exists($value, $array)) {
	 	return $nl . '<p>' . $value . ' is one of the array keys.</p>';
	 }else{
	 	return $nl . '<p>' . $value . ' is NOT one of the array keys.</p>';

	}
}
	elseif(strtolower($searchtable) == 'value'){

			if(in_array($value, $array)) {
		return $nl . '<p>' . $value . ' is one of the array values.</p>';
		}else{
		return $nl . '<p>' . $value . ' is NOT one of the array values.</p>';

	}

	}
}


 $output1 = checkArrayforKeyValue($array13, "Afdfd", 'key');
 echo $output1;

  $output1 = checkArrayforKeyValue($array13, "Texas", 'key');
 echo $output1;

   $output1 = checkArrayforKeyValue($array13, "sdfd", 'value');
 echo $output1;
 
   $output1 = checkArrayforKeyValue($array13, "Austin", 'value');
 echo $output1;







?>

</body>
</html>
