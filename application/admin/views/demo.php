<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Star Rating</title>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script>
				$.fn.stars = function() {
			return $(this).each(function() {
				var rating = $(this).data("rating");
				var fullStar = new Array(Math.floor(rating + 1)).join('<i class="fas fa-star"></i>');
				var halfStar = ((rating%1) !== 0) ? '<i class="fas fa-star-half-alt"></i>': '';
				var noStar = new Array(Math.floor($(this).data("numStars") + 1 - rating)).join('<i class="far fa-star"></i>');
				$(this).html(fullStar + halfStar + noStar);
			});
		}

            $(function(){
                $('.stars').stars();
            });
        </script>
    </head>
    <body>

        <div class="stars" data-rating="4.2" data-num-stars="5" ></div>
       

    </body>
    </html>