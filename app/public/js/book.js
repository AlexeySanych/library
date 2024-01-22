var pathname = $(location).attr('pathname');
var bookIdPosition = pathname.lastIndexOf('/') + 1;

$('.btnBookID').click(function(event) {
		$.ajax({
    url: '/book/' + pathname.substr(bookIdPosition),
    type: "POST",
    data: {clickId: pathname.substr(bookIdPosition)},
    success: function() {
        alert(
            "Книга свободна и ты можешь прийти за ней."
        );
    }
});
    
});
