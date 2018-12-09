<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- customized css -->
<link rel="stylesheet" type="text/css" href="css/intro.css">

</head>

<body>

<div class="col-sm-10 border p-4"> 
    <h2> Quiz Results</h2>
                     		
    <?php
        //Connect to DB
        $hostdb = "";  
        $userdb = "";  
        $passdb = "";  
        $namedb = "";  
            
        $conn = new mysqli($hostdb, $userdb, $passdb, $namedb);
            
        //Calculate score
        $score = 0;
        foreach(array_keys($_POST) as $key)
        {
            if($key != "Submit")
            {
                if( $_POST[$key] == 4)
                {
                        
                    $score++;
                }
            }
        }
            
        //Print score
        echo "<div id='finalScore'>Your Score : $score/5</div><br>";
        $result = mysqli_query($conn,$sql2);

    //Close php block to print div
    ?>

    <div id='finalResult'> Result : 
        
    <?php // New php block
        switch($score)
        {
            case 0: echo "You didn't get any questions correct. Please review and try again.";
                break; 
            case 1: echo "You only got one question correct. Please review and try again.";
                break; 
            case 2: echo "You got 2 of 5 questions correct. Please review and try again.";
                break; 
            case 3: echo "You got 3 of 5 questions correct. Please review and try again.";
                break; 
            case 4: echo "Good Job.  Try again for a perfect score.";
                break;
            case 5: echo "Perfect score!";
                break;
            default: echo "Error calculating your score.";
                }
    ////Close php block to close html div                
    ?>

    </div><br>
    <p class="quote">Review your selections below. <br>The correct answer to each question is highlighted in green.</p>
            
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

        $sql = "SELECT * FROM introQuiz";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) 
        {
            $qCount = 1;
            $selCount = 1;
            while($row = $result->fetch_assoc()) 
            {
                if( in_array($qCount, array_keys($_POST)))
                {
                    //echo "qCount=".$qCount." ";
                    $submittedAnswer = $_POST[$qCount];
                    //echo "submittedAnswer=".$submittedAnswer . " ";

                    //print the question
                    echo "<div id='question'>".$selCount.".    ".$row["question"]."<br><br>";

                    $choice_array = array();
                    //print the selection
                    if($submittedAnswer == "1" )
                    {
                        $choice_array[0] = "<input type='radio' name='".$qCount."' value='1'style='margin: 0 10px 0 10px' checked>".$row[choice1]; 
                    }
                    else
                    {
                        $choice_array[0] = "<input type='radio' name='".$qCount."' value='1'style='margin: 0 10px 0 10px'>".$row[choice1];
                    }

                    if($submittedAnswer == 2 )
                    {
                        $choice_array[1] = "<input type='radio' name='".$qCount."' value='2'style='margin: 0 10px 0 10px' checked>".$row[choice2];
                    }
                    else
                    {
                        $choice_array[1] = "<input type='radio' name='".$qCount."' value='2'style='margin: 0 10px 0 10px'>".$row[choice2];
                    }

                    if($submittedAnswer == 3 )
                    {
                        $choice_array[2] = "<input type='radio' name='".$qCount."' value='3'style='margin: 0 10px 0 10px' checked>".$row[choice3];
                    }
                    else
                    {
                        $choice_array[2] = "<input type='radio' name='".$qCount."' value='3'style='margin: 0 10px 0 10px'>".$row[choice3];
                    }

                    if( $submittedAnswer == 4)
                    {
                        $choice_array[3] = "<span style='background-color:#99ff99'><input type='radio' name='".$qCount."' value='4'style='margin: 0 10px 0 10px; background-color:green' checked>".$row[answer]."</span>";
                    }
                    else
                    {
                        $choice_array[3] = "<span style='background-color:#99ff99'><input type='radio' name='".$qCount."' value='4'style='margin: 0 10px 0 10px; background-color:green'>".$row[answer]."</span>";
                    }
                    //print_r( $choice_array );

                    $answer_order = GetRandomNumbers(0, 3, 4);

                    //print_r( $answer_order );
                    for($answerSel = 0; $answerSel <= 3; $answerSel++ )
                    {
                        $selection = $answer_order[$answerSel];
                        echo $choice_array[$selection];
                        echo "<br>";
                    }
                    echo "</div><br><br>";
                    $selCount++;
                }
                $qCount++;
            }
        } 
        else 
        {
            echo "0 results";
        }
            $conn->close();
    //Close php block
    ?>
            
    <a href= "quizForm.php"><button class="pbutton button1" >Try Again</button></a>		

</div>

	<!-- Bootstrap core JavasSript -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>