<?php
include 'config.php';

$sql = "SELECT * FROM question";
$result = $conn->query($sql);

$questions = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = array(
            'id' => $row['id'],
            'question' => $row['question'],
            'answer' => array(),
        );

        // Fetch answers for the current question
        $answersSql = "SELECT * FROM answer WHERE question_id = " . $row['id'];
        $answersResult = $conn->query($answersSql);

        while ($answerRow = $answersResult->fetch_assoc()) {
            $question['answer'][] = array(
                'id' => $answerRow['id'],
                'text' => $answerRow['answer_text'],
                'correct' => $answerRow['is_correct'],
            );
        }

        $questions[] = $question;
    }
}
?>
<script>
    const questions = <?php echo json_encode($questions); ?>;
//     const questions = [

// {
//     question:"Which The Largest Animal in the world",
//     answer: [
//         { text: "Shark", correct: false},
//         { text: "Blue while", correct: true},
//         { text: "Elephant", correct: false},
//         { text: "Giraffe", correct: false}
//     ]
// },
// {
//     question:"Which The Largest Desert in the world",
//     answer: [
//         { text: "Kalahari", correct: false},
//         { text: "Gobi", correct: false},
//         { text: "Shahara", correct: false},
//         { text: "Antarctica", correct: true}
//     ]
// },
// {
//     question:"Which is the smallest continent in the world",
//     answer: [
//         { text: "Asia", correct: false},
//         { text: "Australia", correct: true},
//         { text: "Arctic", correct: false},
//         { text: "Africa", correct: false}
//     ]
// },
// {
//     question:"Which The Largest Animal in the world",
//     answer: [
//         { text: "Shark", correct: false},
//         { text: "Blue while", correct: true},
//         { text: "Elephant", correct: false},
//         { text: "Giraffe", correct: false}
//     ]
// },


// ];

const questionElement = document.getElementById("question");
const answerBtn = document.getElementById("answer-buttons");
const nextBtn = document.getElementById("nextbtn");

const correct = new Audio();
correct.src = "audio/correct.mp3"; 

const wrong = new Audio();
wrong.src = "audio/wrong.mp3"; 

const levelcomplete = new Audio();
levelcomplete.src = "audio/levelcomplete.mp3"; 

let currentQuestionIndex = 0;
let score = 0;

function startquiz(){
currentQuestionIndex = 0;
score = 0;
nextBtn.innerHTML = "Next";
showquestion();
}
function showquestion(){
resetstate();
let currentQuestion = questions[currentQuestionIndex];
let questionNo = currentQuestionIndex+1;
questionElement.innerHTML = questionNo +". " + currentQuestion.question;

currentQuestion.answer.forEach(answer=>{
    const button = document.createElement("button");
    button.innerHTML = answer.text;
    button.classList.add("btn");
    answerBtn.appendChild(button);
    if(answer.correct){
        button.dataset.correct = answer.correct;
    }
    button.addEventListener("click", selectanswer);
});
}

function resetstate(){
nextBtn.style.display = "none";
while(answerBtn.firstChild){
    answerBtn.removeChild(answerBtn.firstChild);
}
}

function selectanswer(e){
const selectedbtn = e.target;
const iscorrect = selectedbtn.dataset.correct == 1;
if(iscorrect){
    selectedbtn.classList.add("correct");
    correct.play();
    score++;
}else{
    selectedbtn.classList.add("incorrect");
    wrong.play();
}
Array.from(answerBtn.children).forEach(button => {
    if(button.dataset.correct == 1){
        button.classList.add("correct");
    }
    button.disabled = true;
});
nextBtn.style.display = "block";
}
function showscore(){
resetstate();
questionElement.innerHTML = `You scored ${score} out of ${questions.length}!`;
nextBtn.innerHTML = "Play Again";
nextBtn.style.display = "block";

}
function handleNextBtn(){
currentQuestionIndex++;
if(currentQuestionIndex < questions.length){
    showquestion();
}else{
    showscore();
    levelcomplete.play();
}
}

nextBtn.addEventListener("click", ()=>{
if(currentQuestionIndex < questions.length){
    handleNextBtn();
}else{
    startquiz();
    if (!levelcomplete.paused) {
        levelcomplete.pause();
        levelcomplete.currentTime = 0;
    }
}

});
startquiz();


</script>