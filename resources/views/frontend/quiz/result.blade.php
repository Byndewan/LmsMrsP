<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Result Quiz</title>
</head>
<body>
    
    <div id="result">
    </div>

</body>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const result = document.getElementById("result");
    result.innerHTML = `
        <h1>Results</h1>
        <p>Correct Answers: ${correctAnswers}</p>
        <p>Wrong Answers: ${wrongAnswers}</p>
    `;
});
</script>

</html>