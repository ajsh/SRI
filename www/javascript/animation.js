 var imgs = [
        'images/P1010028.jpg',
        'images/Girders.jpg'];
        var cnt = imgs.length;

        $(function() {
            setInterval(Slider, 3000);
        });

        function Slider() {
        $('#imageSlide').fadeOut("slow", function() {
           $(this).attr('src', imgs[(imgs.length++) % cnt]).fadeIn("slow");
        });
        }

