<?php

/* Name: Christopher Cox
 * Email: thetaco.dyndns@gmail.com
 * Date: 4/17/2018
 * Description: I had a lot of fun with this one! Although bloated, it functions
 *   well and has all the features it needs! This code below is simply for a quiz
 *   based on the answers below. It is dynamic, so if you change the array below
 *   following the same pattern, you can make any quiz with it!
 */

// Create a massive array filled with confusing goodness
// (But really: it's holding all the question data for a quiz)
$questions = [

 'q1' => [
           'text' => 'What does PHP stand for?', 
            'choices' => [
                'a'=>'PHP: Hypertext Preprocessor',
                'b'=>'Private Home Page',
                'c' => 'Personal Hypertext Processor'
            ],
            'correct' => 'a'
        ],
    
 'q2' => [
           'text' => ' PHP server scripts are surrounded by delimiters, which?', 
            'choices' => [
                'a'=>'<?php>...</?>', 
                'b'=>'<script>...</script>',
                'c' => '<?php...?>',
                'd' => '<&>...</&>'
            ],
            'correct' => 'c'
        ],
    
 'q3' => [
           'text' => 'How do you write "Hello World" in PHP?', 
            'choices' => [
                'a'=>'echo "Hello World";',
                'b'=>'"Hello World";',
                'c' => 'Document.Write("Hello World");'
            ],
            'correct' => 'a'
        ],


 'q4' => [
           'text' => 'All variables in PHP start with which symbol?', 
            'choices' => [
                'a'=>'!',
                'b'=>'$',
                'c' => '@'
            ],
            'correct' => 'b'
        ],

 'q5' => [
           'text' => 'What is the correct way to end a PHP statement?',
            'choices' => [
                'a'=>'New line',
                'b'=>'.',
                'c' => ';',
                'd' => '</php>'
            ],
            'correct' => 'c'
        ],
 'q6' => [
           'text' => 'The PHP syntax is most similar to:',
            'choices' => [
                'a'=>'JavaScript',
                'b'=>'VBScript',
                'c' => 'Perl and C'
            ],
            'correct' => 'c'
        ],

 'q7' => [
           'text' => 'How do you get information from a form that is submitted using the "get" method?',
            'choices' => [
                'a'=>'$_GET[]',
                'b'=>'Request.Form',
                'c' => 'Request.QueryString'
            ],
            'correct' => 'a'
        ],

 'q8' => [
           'text' => 'When using the POST method, variables are displayed in the URL:',
            'choices' => [
                'a'=>'True',
                'b'=>'False'
            ],
            'correct' => 'b'
        ],

 'q9' => [
           'text' => 'In PHP you can use both single quotes ( \' \' ) and double quotes ( " " ) for strings:',
            'choices' => [
                'a'=>'True',
                'b'=>'False'
            ],
            'correct' => 'a'
        ],
 'q10' => [
           'text' => 'What is the correct way to create a function in PHP?',
            'choices' => [
                'a'=>'new_function myFunction()',
                'b'=>'function myFunction()',
                'c'=>'create myFunction()'
            ],
            'correct' => 'b'
        ],
 'q11' => [
           'text' => 'You can use PHP delimiters anywhere in the script, as long as they are consistent',
            'choices' => [
                'a'=>'True',
                'b'=>'False'
            ],
            'correct' => 'a'
        ],
 'q12' => [
           'text' => 'What loop structure in PHP is best for associative arrays?',
            'choices' => [
                'a'=>'while',
                'b'=>'do while',
                'c'=>'foreach',
                'd'=>'for'
            ],
            'correct' => 'c'
        ]
];

// Here, we are checking to see if a GET variable is set.
// This variable is used to tell me if the user has already taken
// our quiz (to determine if we should print the questions or not)

$taken = false;

if (isset($_GET['t']))
    $taken = true;

/*
 * Now we'll decide if we should print the form or not..
 * I was trying to think of a way to do this a bit more neatly,
 * but I have just decided to do a large if/else statement because
 * it feels like the most efficient way to do it.
 * (it also allows me to inject html much easier)
 */

?>

<!-- Start by constructing all the html stuff, including the form -->

<html>
    <body>
        <h2>Super Great PHP Quiz!</h2>
<?php
if (!$taken) {    
?>
        
        <form action=".?t=HAHAHAHAHAHAHA" method="POST">
<?php
            // A counter to keep track of question numbers
            $counter = 1;
            
            // Begin looping through the questions array
            foreach ($questions as $qn => $qData) {
                
                // Print question
                echo $counter++ . ": " . $qData['text'] . "<br />\n";
                
                // Print out the options
                foreach ($qData['choices'] as $letter => $choice) {
                    
                    $fChoice = htmlspecialchars("$letter. $choice", ENT_SUBSTITUTE);
                    
                    echo "<input type=\"radio\" name=\"$qn\" value=\"$letter\">";
                    echo "$fChoice</input><br />\n";
                    
                }
                
                echo "<br />\n";
                
            }
?>
            <input type="submit" value="Submit">
        </form>
        
<?php
} else { // END if (!$taken)...
    
    // "Header"
    echo "<h2>Results:</h2><br />\n";
    
    // This segment runs if you have submitted the quiz, so formhanding here
    // Print out the results in a list
    echo "<dl>\n";
    
    // Loop through the questions array again, to check the answers
    foreach ($questions as $qn => $qData) {
        
        // Check to see if all questions were answered
        if (!isset($_POST[$qn])) {
            $errorMessage = "Not all questions were answered!<br />\n";
            echo $errorMessage;
            break;
        }
        
        echo "<dt>$qn:</dt>\n";
        
        echo "<dd>";
            
        // Check to see if the answer is right
        if ($_POST[$qn] == $qData['correct'])
            echo "Correct!";
        else
            echo "Incorrect!";
        
        echo "</dd>\n";
        
        
    }
    
    echo "</dl>\n<br />\n";

    echo "<a href=\".\">Retake Quiz</a>\n";
    
} // END else (if (!$taken))...
?>
    </body>
</html>