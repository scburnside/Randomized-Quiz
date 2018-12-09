# Randomized Quiz

This quiz program randomly selects a set of questions from a questionbank, randomizes the order of the choices, and returns the results of the quiz.  

![screenshots](/screenshots/demo.png)

# Set-up

1) Copy the files into your working directory.
    These samples can be run from:
        - A command line on a computer that has PHP cli installed
        - Called as a webpage from a HTTP/web server capable of interpreting PHP server-side scripts

2) Create a working database
    Create a table with six fields, "quizId", "question", "choice1", "choice2", "choice3", and "answer".  The quizId field should be set as the primary key. 
    
    ![screenshots](/screenshots/tableStructure.png)

3) Add mock data or real data to create your question bank.  
    (The default files are configured for 15 questions in the question bank)
    
    ![screenshots](/screenshots/table.png)

# Configuration

1) Connect to the database (both php files)
    ```
    //Connect to DB
        $hostdb = "";  
        $userdb = "";  
        $passdb = "";  
        $namedb = ""; 
    ```

2) Configure the question bank selection in quizForm.php file
    ```
    //Default is set to select 5 random questions from a pool of 15 questions
        $questionNumbers = GetRandomNumbers(1, 15, 5);
    ```

# Contributing

Please feel free to contribute!

# License

The MIT License (MIT) 2018 - Samantha Burnside. Please have a look at the LICENSE.md for more details.
