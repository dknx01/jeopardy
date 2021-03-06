$(document).ready(function () {
    $('.modal').modal();
});

function showQuestion(el) {
    var el = $(el);
    var answer = el.attr('data-answer');
    var question = el.attr('data-question');
    var cell = el.attr('id');
    $('#answer').html('<h1>' + answer + '</h1>');
    $('#question').html('');
    $('.card-action').attr('data-cell', cell);
    startTimer();
    $('#modal1').modal('open');
}

function startTimer(){
    var countdown = $("#countdown").countdown360({
        radius: 60,
        seconds: 30,
        fontColor: '#FFFFFF',
        autostart: false,
        onComplete: function () {
            console.log('done')
        }
    });
    countdown.start();
}


function handleAnswer(el, choice) {
    var el = $(el);
    var cell = $('#' + el.parent().parent().attr('data-cell'));
    cell.attr('data-choice', choice);
    var cssClass = choice === 'correct' ? 'green' : 'red';
    $('#close').attr('data-choice', choice);
    $('#question').html('<h2 class="z-depth-4 ' + cssClass + '">' + cell.attr('data-question') + '</h2>');
}

function closeAnswer(el) {
    var el = $(el);
    var cell = $('#' + el.parent().attr('data-cell'));
    var cssClass = el.attr('data-choice') === 'correct' ? 'green' : 'red';
    var answer = cell.attr('data-answer');
    var question = cell.attr('data-question');
    cell.removeAttr('onclick');
    var content =
        '<div class="card ' + cssClass + '">' +
        '<div class="card-content white-text">' +
        '<div class="text-center"><strong>Answer: </strong>' + answer + '</div>' +
        '<div><strong>Question: </strong>' + question + '</div>' +
        '</div>' +
        '</div>';
    cell.html(content);
    $('#modal1').modal('close');
}