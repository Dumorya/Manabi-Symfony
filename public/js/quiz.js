// on click of the validate button
$('.validateQuestionButton').click(function()
{
    // we display the answers
    $(this).parent().find('.answer').css('display', 'block');

    // get answer written by user
    let answer = $(this).parent().find('input').val();
});