<?php include_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $answers = $_POST['answers'];
    $correctAnswerIndex = $_POST['correct_answer'];

    // Insert the question into the 'quiz' table
    $insertQuestionSql = "INSERT INTO question (question) VALUES ('$question')";
    $conn->query($insertQuestionSql);

    // Get the question ID
    $questionId = $conn->insert_id;

    // Insert answers into the 'answers' table
    foreach ($answers as $index => $answer) {
        $isCorrect = ($index == $correctAnswerIndex) ? 1 : 0;
        $insertAnswerSql = "INSERT INTO answer (question_id, answer_text, is_correct) VALUES ('$questionId', '$answer', '$isCorrect')";
        $conn->query($insertAnswerSql);
    }

    echo "Question and answers added successfully!";
} else {
    echo "Invalid request method";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question and Answers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, button {
            margin-bottom: 16px;
        }
    </style>
</head>
<body>
    <h2>Add Question and Answers</h2>
    <form action="" method="post">
        <label for="question">Question:</label>
        <input type="text" id="question" name="question" required>

        <label for="answer1">Answer 1:</label>
        <input type="text" id="answer1" name="answers[]" required>
        <input type="radio" name="correct_answer" value="0"> Correct Answer

        <label for="answer2">Answer 2:</label>
        <input type="text" id="answer2" name="answers[]" required>
        <input type="radio" name="correct_answer" value="1"> Correct Answer

        <label for="answer3">Answer 3:</label>
        <input type="text" id="answer3" name="answers[]" required>
        <input type="radio" name="correct_answer" value="2"> Correct Answer

        <label for="answer4">Answer 4:</label>
        <input type="text" id="answer4" name="answers[]" required>
        <input type="radio" name="correct_answer" value="3"> Correct Answer

        <button type="submit">Submit</button>
    </form>
</body>
</html>


