$(document).ready(function()
{
    var score = 0;

    // slider
    $('.quiz').slick({
        infinite: false,
        draggable: false,
        focusOnSelect: false,
        nextArrow: '<button type="button" class="slick-next">Question suivante</button>'
    });

    $('.startQuiz').click(function()
    {
        // let's restart from 0
        score = 0;
    });

    // on click of the validate button
    $('.validateQuestionButton').click(function()
    {
        $('.validateQuestionButton').css('display','none');
        $('.quiz .slick-next').attr('style','display: block !important');

        // we display the answers
        $(this).parent().find('.answerSentence').css('display', 'block');

        // get answer written by user
        var userAnswer = $(this).parent().find('input').val();
        var trueAnswer = $(this).parent().find('input').attr('data-answer');

        if(userAnswer === trueAnswer)
        {
            $(this).parent().find('.answerSentence').text('Bonne réponse !');
            $(this).parent().find('.answerSentence').css('color','#35A5AA');
            $(this).parent().find('input').css('border-color','#35A5AA');

            score++;
        }
        else
        {
            // display the sentence
            $(this).parent().find('.answerSentence').text('Mauvaise réponse...');
            $(this).parent().find('.answerSentence').css('color','#B63966');

            // strike the answer
            $(this).parent().find('input').css('text-decoration','line-through');
            $(this).parent().find('input').css('border-color','#B63966');

            // display the right answer
            $(this).parent().find('.answer').text(trueAnswer);
        }
    });

    // display and hide the validate and next buttons, depends on the action
    $('.quiz .slick-next').click(function(){
        $('.validateQuestionButton').css('display','block');
        $('.quiz .slick-next').attr('style','display: none !important');
    });

    // by default we disable the validate button
    $('.validateQuestionButton, .validateQuestionEnd').prop('disabled','true').addClass('validateButtonDisabled');

    // if the answer field is not empty, we enable the validate button
    $( ".quiz input" ).keyup(function()
    {
        if($(this).val() !== '')
        {
            $(this).parent().find('.validateQuestionButton, .validateQuestionEnd').removeClass('validateButtonDisabled');
            $(this).parent().find('.validateQuestionButton, .validateQuestionEnd').removeAttr("disabled");
        }
    });


    // press the validate button of the last question
    $('.validateQuestionEnd').click(function()
    {
        $('.validateQuestionEnd').css('display','none');
        $('.goToScore').css('display','block');

        // we display the answers
        $(this).parent().find('.answerSentence').css('display', 'block');

        // get answer written by user
        var userAnswer = $(this).parent().find('input').val();
        var trueAnswer = $(this).parent().find('input').attr('data-answer');

        if(userAnswer === trueAnswer)
        {
            $(this).parent().find('.answerSentence').text('Bonne réponse !');
            $(this).parent().find('.answerSentence').css('color','#35A5AA');
            $(this).parent().find('input').css('border-color','#35A5AA');

            score++;
        }
        else
        {
            // display the sentence
            $(this).parent().find('.answerSentence').text('Mauvaise réponse...');
            $(this).parent().find('.answerSentence').css('color','#B63966');

            // strike the answer
            $(this).parent().find('input').css('text-decoration','line-through');
            $(this).parent().find('input').css('border-color','#B63966');

            // display the right answer
            $(this).parent().find('.answer').text(trueAnswer);
        }
    });

    $('.goToScore').click(function(){
        $('.question').css('display','none');
        $('.finalScore').css('display','block');
        $('.score b').text(score);

        // get the number of questions in the quiz
        var wordsLength = $('.score').attr('data-words-length');

        if(score < wordsLength/4)
        {
            $('.congrats').text('Un peu d\'entrainement et ça ira !');
        }
        else if(score >= wordsLength/4 && score < wordsLength/2)
        {
            $('.congrats').text('Encore un petit effort !');
        }
        else if(score >= wordsLength/2  && score < wordsLength/4*3)
        {
            $('.congrats').text('Ca commence à venir !');
        }
        else if(score >= wordsLength/4*3 && score < wordsLength/4*3.5)
        {
            $('.congrats').text('Bon travail !');
        }
        else if(score >= wordsLength/4*3.5 && score < wordsLength)
        {
            $('.congrats').text('Très bon travail !');
        }
        else if(score === wordsLength)
        {
            $('.congrats').text('Excellent !');
        }
    });
});