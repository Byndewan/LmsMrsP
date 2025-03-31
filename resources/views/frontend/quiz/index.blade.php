<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Course</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

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
            width: 25%;
            height: 100%;
            background: #2ea59d;
            border-radius: 20px;
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
        }
        .option:hover, .selected {
            border: 2px solid #2ea59d;
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
            justify-content: space-between;
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
            <div class="progress"></div>
        </div>
        <p class="question-number">Question 2 from 4</p>
        <div id="quiz-container">
            
        </div>
        <div class="line"></div>
        <div class="navigation">
            <button class="back">&#8592; Back</button>
            <button class="next">Next &#8594;</button>
        </div>
    </div>
</body>

</html>
    <script>
        const audio = document.getElementById("audio");
        const playButton = document.getElementById("play-audio");
        const audioIcon = document.getElementById("audio-icon");

        document.addEventListener("DOMContentLoaded", async function () {
            try {
                const response = await axios.get("http://127.0.0.1:8000/api/questions");
                const questions = response.data; 

                console.log("Data dari API:", response.data);
                console.log("Soal dari API:", questions);

                if (questions.length > 0) {
                    const questionTypes = ["pg_audio", "essay_text", "pg_text", "essay_audio"];
                    const randomType = questionTypes[Math.floor(Math.random() * questionTypes.length)];

                    const availableQuestions = questions.filter(q => questionTypes.includes(q.type));
                    if (availableQuestions.length > 0) {
                        const randomQuestion = availableQuestions[Math.floor(Math.random() * availableQuestions.length)];
                        console.log("Soal yang dipilih:", randomQuestion);
                        loadQuestion(randomQuestion);
                    } else {
                        console.warn("Tidak ada soal yang cocok dengan tipe yang tersedia!");
                    }
                }
            } catch (error) {
                console.error("Gagal mengambil soal!", error.response ? error.response.data : error.message);
            }
        });


        function loadQuestion(randomQuestion) {
            const container = document.getElementById("quiz-container");
            container.innerHTML = "";

            // console.log("Memuat soal:", randomQuestion);

            if (randomQuestion.type === "essay_audio") {
                container.innerHTML = `
                    <div class="question-audio">
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
                    <textarea class="answer-box" rows="4" placeholder="Write your answer"></textarea>
                `;
            } else if (randomQuestion.type === "pg_text") {
                container.innerHTML = `
                    <h2 class="question">What is the meaning of "Je m'appelle Julia"?</h2>
                    <div class="options">
                        <button class="option selected"><span class="button-text">My name is Julia</span></button>
                        <button class="option"><span class="button-text">She is eating pizza</span></button>
                        <button class="option"><span class="button-text">Her name is Julia</span></button>
                    </div>
                `;
            } else if (randomQuestion.type === "essay_text") {
                container.innerHTML = `
                    <h2 class="question">What is the meaning of "Je m'appelle Julia"?</h2>
                    <textarea class="answer-box" placeholder="Write your answer"></textarea>
                `;
            } else if (randomQuestion.type === "pg_audio") {
                container.innerHTML = `
                    <div class="question-audio">
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
                        <button class="option selected"><span class="button-text">My name is Julia</span></button>
                        <button class="option"><span class="button-text">She is eating pizza</span></button>
                        <button class="option"><span class="button-text">Her name is Julia</span></button>
                    </div>
                `;

                const audio = document.getElementById("audio");
                const playButton = document.getElementById("play-audio");
                const audioIcon = document.getElementById("audio-icon");

                playButton.addEventListener("click", function() {
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


            }
        }

    </script>
