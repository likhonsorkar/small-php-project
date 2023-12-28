<?php include_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="quiz.css">
</head>
<body>
    <div class="app">
        <h1>Quiz Title</h1>
            <div class="quiz">
                <h2 id="question">
                    Question goes here?
                </h2>
                <div id="answer-buttons">
                    <button class="btn">Answer 1</button>
                    <button class="btn">Answer 2</button>
                    <button class="btn">Answer 3</button>
                    <button class="btn">Answer 4</button>
                </div>
                <button id="nextbtn">Next</button>
            </div>
    </div>
    <?php include_once('question.php'); ?>
</body>
</html>