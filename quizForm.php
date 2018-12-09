<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">

<title>Random Quiz</title>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- customized css -->
<link rel="stylesheet" type="text/css" href="css/intro.css">

</head>

<body>

<div class="col-sm-10 border p-4">
    <h2> Quiz </h2>
    <p>Test your knowledge with this short 5 question quiz!</p>

    <?php
        //Connect to DB
        $hostdb = "";  
        $userdb = "";  
        $passdb = "";  
        $namedb = "";  
        
        $conn = new mysqli($hostdb, $userdb, $passdb, $namedb);
        if($conn->connect_errno)
        {
            echo "Connection error " . $conn->connect_errno . " " . $conn->connect_error;
        } 
    //Close php block for HTML stuff
    ?> 

    <!-- Post to results page -->
    <form action="quizResults.php" method="POST" id="quizform"> 

    <?php //Open new php block
        function GetRandomNumbers($min,$max,$count)
        {
            $nonrepeatarray = array(); 
            for($i = 0; $i < $count; $i++) 
            { 
                $rand = rand($min,$max); 
                                        
                //If value is already in the array, recalc rand until 
                //reaching value not in array
                while(in_array($rand,$nonrepeatarray)) 
                { 
                    $rand = rand($min,$max); 
                } 
                                            
                //Add it to the array 
                $nonrepeatarray[$i] = $rand; 
            } 
            return $nonrepeatarray; 	
        }

        //Set to select 5 random questions from a pool of 15 questions
        $questionNumbers = GetRandomNumbers(1, 15, 5);

        $sql = "SELECT * FROM introQuiz";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            $qCount = 1;
            $selCount = 1;
            while($row = $result->fetch_assoc()) 
            {
                if( in_array($qCount, $questionNumbers))
                {
                    //Print the question
                    echo "<div id='question'>".$selCount.".    ".$row["question"]."<br><br>";

                    $choiceArray = array();
                    //Print the selection
                    $choiceArray[0] = "<input type='radio' name='".$qCount."' value='1'style='margin: 0 10px 0 10px'>".$row[choice1]; 
                    $choiceArray[1] = "<input type='radio' name='".$qCount."' value='2'style='margin: 0 10px 0 10px'>".$row[choice2];
                    $choiceArray[2] = "<input type='radio' name='".$qCount."' value='3'style='margin: 0 10px 0 10px'>".$row[choice3];
                    $choiceArray[3] = "<input type='radio' name='".$qCount."' value='4'style='margin: 0 10px 0 10px'>".$row[answer];

                    //print_r( $choiceArray );

                    $answerOrder = GetRandomNumbers(0, 3, 4);

                    //print_r( $answerOrder );
                    for($answerSel = 0; $answerSel <= 3; $answerSel++ )
                    {
                        $selection = $answerOrder[$answerSel];
                        echo $choiceArray[$selection];
                        echo "<br>";
                    }

                    echo "</div><br><br>";
                    $selCount++;
                }
                $qCount++;
            }
            echo "<input type='submit' value='Submit' name='Submit'>";
        } 
        else 
        {
            echo "0 results";
        }
        $conn->close();
    ?>
    </form><br>
                
</div>
	<!-- Bootstrap core JavasSript -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>