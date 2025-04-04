<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quiz Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- jQuery (required for Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 100%;
            text-align: center;
        }
        #quiz-container {
            width: 100%;
            text-align: center;
        }
        .progress-bar {
            width: 80%;
            height: 20px;
            background: #e0e0e0;
            border-radius: 20px;
            margin-bottom: 30px;
            position: relative;
            justify-self: center;
        }
        .progress {
            width: 0;
            height: 100%;
            background: #2ea59d;
            border-radius: 20px;
            transition: width 0.3s ease-in-out;
        }
        .question-number {
            width: 62%;
            color: #28a79f;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 30px;
            justify-self: start;
        }
        .question {
            width: 92%;
            font-size: 20px;
            color: #333;
            font-weight: bold;
            padding-bottom: 15px;
            justify-self: end;
        }

        .question-essay {
            font-size: 24px;
            color: #1d3557;
            font-weight: 700;
        }
    
        .options {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
            justify-self: center;
        }
        .option {
            background: white;
            color: #2ea59d;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            text-align: left;
            transition: all 0.3s ease;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            transition: border 0.3s;
        }
        .option:hover, .selected {
            border: 2px solid #2ea59d;
        }

        .option.selected {
            border: 3px solid #2ea59d;
        }

        .answer-box {
            width: 50%;
            height: 220px;
            border: 2px solid #d0d5db;
            border-radius: 8px;
            font-size: 16px;
            padding: 15px;
            outline: none;
            resize: none;
            font-family: 'Inter', sans-serif;
        }
        .answer-box::placeholder {
            color: #a0aec0;
        }
        .question-audio {
            width: 72%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        .audio-button {
            background: #14b8a6;
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 25%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }
    
        .button-text {
            margin: 10px;
            font-size: 16px;
            font-weight: bold;
            color: #2ea59d;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .btn {
            padding: 12px 25px;
            font-size: 18px;
            font-weight: 600;
            border-radius: px;
            cursor: pointer;
            transition: 0.3s ease;
        }
        .line {
            width: 100%;
            height: 2px;
            background: #2ea59d;
            margin: 30px 0;
        }
        .navigation {
            display: flex;
            justify-content: end;
            margin-top: 50px;
            width: 80%;
            justify-self: center;
        }
        .back, .next {
            background: #2ea59d;
            color: white;
            border: none;
            padding: 15px 35px;
            font-size: 20px;
            border-radius: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .back {
            background: transparent;
            border: 2px solid #2ea59d;
            color: #2ea59d;
        }
        .back:hover {
            background: #2ea59d;
            color: white;
        }
        .next:hover {
            background: transparent;
            color: #2ea59d;
            border: 1px solid #2ea59d;
        }
    
        @media screen and (min-width: 300px) {
            .question-audio {
                width: 100%;
            }
        }
        @media screen and (min-width: 768px) {
            .question-audio {
                width: 100%;
            }
        }
        @media screen and (min-width: 1350px) {
            .question-audio {
                width: 72%;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="progress-bar">
            <div class="progress" id="progress"></div>
        </div>
        <p class="question-number">Question <span id="current-question">1</span> from <span id="total-questions">0</span></p>
        <div id="quiz-container">
            
        </div>
        <div class="line"></div>
        <div class="navigation">
            <button class="next" id="submit-answer">Next &#8594;</button>
        </div>

    </div>
</body>

<script>
    const audio = document.getElementById("audio");
    const playButton = document.getElementById("play-audio");
    const audioIcon = document.getElementById("audio-icon");
    let correctAnswers = 0;
    let wrongAnswers = 0;
    let answered = false;


    

    document.addEventListener("DOMContentLoaded", async function () {
        try {
            const response = await axios.get("http://127.0.0.1:8000/api/questions");
            questions = Object.values(response.data);
            totalQuestions = questions.length;
            currentQuestionIndex = 0;
            courseId = {{ $course->id }};
            score = 0;
            

            if (Array.isArray(questions)) {
                totalQuestions = questions.length;
            } else {
                console.error("Data 'questions' bukan array!");
            }


            if (totalQuestions > 0) {
                loadQuestion(questions[currentQuestionIndex]);
                updateProgressBar();
            } else {
                console.warn("Tidak ada soal yang tersedia!");
            }
        } catch (error) {
            console.error("Gagal mengambil soal!", error.response ? error.response.data : error.message);
        }
    });


    function loadQuestion(question) {
        const container = document.getElementById("quiz-container");
        container.innerHTML = ""

        if (question.type === "essay_audio") {
            let audioPath = question.audio_path;
            let audioElement = audioPath ? `<audio id="question-audio" src="${audioPath}"></audio>` : "";

            container.innerHTML = `
                <div class="question-audio">
                    ${audioElement}
                    <button id="play-audio" class="audio-button">
                        <span id="audio-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                                <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                            </svg>                      
                        </span>
                    </button>
                    <h2 class="question-essay">What Do You Hear?</h2>
                </div>
                <textarea class="answer-box" id="essay-answer" placeholder="Write your answer"></textarea>
            `;

            
            let playButton = document.getElementById("play-audio");
            let audio = document.getElementById("question-audio");
            let audioIcon = document.getElementById("audio-icon");

            if (audio) {
                playButton.addEventListener("click", () => {
                    if (audio.paused) {
                        audio.play();
                        audioIcon.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
                            </svg>
                        `;
                    } else {
                        audio.pause();
                        audioIcon.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                                <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                            </svg>
                        `;
                    }
                });
            } else {
                playButton.disabled = true;
            }
        } else if (question.type === "pg_text") {
            let options = [];
            
            if (question.options) {
                try {
                    options = JSON.parse(question.options); 
                } catch (error) {
                    console.error("Gagal parse options:", error);
                }
            }

            container.innerHTML = `
                <h2 class="question">${question.question}</h2>
                <div class="options">
                    ${options.map((option, index) => `
                        <button class="option" onclick="selectOption(this)"><span class="button-text">${option}</span></button>
                    `).join("")}
                </div>
            `;

            document.querySelectorAll(".option").forEach(button => {
                button.addEventListener("click", function () {
                    checkAnswer(button.textContent);
                });
            });

        } else if (question.type === "essay_text") {
            container.innerHTML = `
                <h2 class="question">${question.question}</h2>
                <textarea class="answer-box" id="essay-answer" placeholder="Write your answer"></textarea>
            `;
        } else if (question.type === "pg_audio") {
            let audioPath = question.audio_path;
            let options = JSON.parse(question.options || "[]");

            let audioElement = audioPath ? `<audio id="question-audio" src="${audioPath}"></audio>` : "";

            let optionsHTML = options.map((option, index) => `
                <button class="option" onclick="selectOption(this)"><span class="button-text">${option}</span></button>
            `).join("");

            container.innerHTML = `
                <div class="question-audio">
                    ${audioElement}
                    <button id="play-audio" class="audio-button">
                        <span id="audio-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                                <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                            </svg>                      
                        </span>
                    </button>
                    <h2 class="question-essay">What Do You Hear?</h2>
                </div>
                <div class="options">
                    ${optionsHTML}
                </div>
            `;

            document.querySelectorAll(".option").forEach(button => {
                button.addEventListener("click", function () {
                    checkAnswer(button.textContent);
                });
            });

            let playButton = document.getElementById("play-audio");
            let audio = document.getElementById("question-audio");

            if (audio) {
                playButton.addEventListener("click", () => {
                    if (audio.paused) {
                        audio.play();
                        playButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
                            </svg>
                        `;
                    } else {
                        audio.pause();
                        playButton.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                <path d="M8.25 4.5a3.75 3.75 0 1 1 7.5 0v8.25a3.75 3.75 0 1 1-7.5 0V4.5Z" />
                                <path d="M6 10.5a.75.75 0 0 1 .75.75v1.5a5.25 5.25 0 1 0 10.5 0v-1.5a.75.75 0 0 1 1.5 0v1.5a6.751 6.751 0 0 1-6 6.709v2.291h3a.75.75 0 0 1 0 1.5h-7.5a.75.75 0 0 1 0-1.5h3v-2.291a6.751 6.751 0 0 1-6-6.709v-1.5A.75.75 0 0 1 6 10.5Z" />
                            </svg>
                        `;
                    }
                });
            } else {
                playButton.disabled = true;
            }
        }

        updateQuestionNumber();
    }




    document.querySelectorAll(".option").forEach(option => {
        option.addEventListener("click", checkAnswer);
    });


    function updateProgressBar() {
        const progressBar = document.getElementById("progress");

        if (!progressBar) {
            console.error("Elemen progress bar tidak ditemukan!");
            return;
        }

        if (totalQuestions === 0) {
            console.warn("Total pertanyaan = 0, progress bar tidak bisa diperbarui.");
            return;
        }

        const progressPercentage = ((currentQuestionIndex + 1) / totalQuestions) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }


    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".next").addEventListener("click", nextQuestion);
    });


    function getSelectedAnswer() {
        let currentQuestion = questions[currentQuestionIndex];

        if (currentQuestion.type === "essay_text" || currentQuestion.type === "essay_audio") {
            let textarea = document.querySelector(".answer-box");
            
            // if (textarea) {
            //     selectedAnswer = textarea.value.trim();
            // }

            let answer = textarea.value;
            
            if (answer.length === 0) {
                console.warn("⚠️ Textarea kosong! Jawaban tidak akan dihitung.");
                return "";
            }

            console.log("✅ Jawaban dari textarea:", answer);
            return answer;

        } else {
            let selectedOption = document.querySelector(".option.selected");
            return selectedOption ? selectedOption.textContent.trim() : "";
        }
    }


    document.addEventListener("DOMContentLoaded", function () {
        let button = document.getElementById("submit-answer");

        if (button) {
            button.addEventListener("click", function () {
                let selectedAnswer = "";

                let currentQuestion = questions[currentQuestionIndex];

                if (currentQuestion.type === "pg_text") {
                    let selectedOption = document.querySelector(".option.selected");
                    if (selectedOption) {
                        selectedAnswer = selectedOption.textContent.trim();
                    }
                } 
                else if (currentQuestion.type === "essay_text" || currentQuestion.type === "essay_audio") {
                    let textarea = document.querySelector(".answer-box");
                    if (textarea) {
                        selectedAnswer = textarea.value.trim();
                    }
                }

                if (selectedAnswer === "") {
                    console.warn("⚠️ Jawaban kosong! Jawaban tidak akan dihitung.");
                } else {
                    console.log("Jawaban sedang diperiksa!");
                    checkAnswer(selectedAnswer);
                }

                answered = false;
            });
        } else {
            console.log("❌ ERROR: Button tidak ditemukan!");
        }
    });



    function isCurrentQuestionAnswered() {
        const currentQuestion = questions[currentQuestionIndex];
        console.log("Memeriksa soal:", currentQuestion);

        if (currentQuestion.type === "essay_text" || currentQuestion.type === "essay_audio") {
            const answerBox = document.querySelector('.answer-box');
            console.log("Jawaban Essay:", answerBox.value);
            checkAnswer(answerBox.value);
            return answerBox && answerBox.value !== "";
        }

        if (currentQuestion.type === "pg_text" || currentQuestion.type === "pg_audio") {
            const selectedOption = document.querySelector('.option.selected');
            console.log("Opsi yang dipilih:", selectedOption);
            return selectedOption !== null;

            answered=false
        }

        return true;
    }




    function checkAnswer(selectedAnswer) {

        if (answered) {
            console.log("Soal ini sudah dijawab, tidak perlu dihitung lagi.");
            return;
        }

        answered = true;

        if (!questions[currentQuestionIndex]) {
            console.error("Pertanyaan tidak ditemukan!");
            return;
        }

        let correctAnswer = questions[currentQuestionIndex].correct_answer;

        console.log(`🔍 Jawaban: ${selectedAnswer}, Benar: ${correctAnswer}`);

        if (selectedAnswer === correctAnswer) {
            correctAnswers++;
            console.log("✅ Jawaban benar! Skor bertambah.");
        } else {
            wrongAnswers++;
            console.log("❌ Jawaban salah!");
        }

    }



    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".option").forEach(option => {
            option.addEventListener("click", function () {
                let selectedAnswer = this.textContent.trim();
                checkAnswer(selectedAnswer);
            });
        });
    });


    function nextQuestion() {

        answered = false;

        if (isCurrentQuestionAnswered()) {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                loadQuestion(questions[currentQuestionIndex]);
                updateProgressBar();
            } else {
                score = correctAnswers - wrongAnswers;
                window.location.href = `/quiz/result/${courseId}/${score * 10}/${totalQuestions * 10}/${correctAnswers}/${wrongAnswers}`;

            }
        } else {
            alert("Silakan jawab soal ini sebelum melanjutkan.");
        }
    }


    function updateQuestionNumber() {
        document.getElementById("current-question").textContent = currentQuestionIndex + 1;
        document.getElementById("total-questions").textContent = totalQuestions;
    }

    


    let lastSelected = null;

    function selectOption(element) {
        if (lastSelected) {
            lastSelected.classList.remove('selected');
        }

        element.classList.add('selected');

        lastSelected = element;
    }
</script>

    

</html>