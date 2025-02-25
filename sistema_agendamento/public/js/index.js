$(document).ready(function () {
    $(".card").mouseenter(function () {
        $(this).find(".desc_servico").slideToggle(400);
        $(this).css({
            transform: "scale(1.01)",
            boxShadow: "0px 0px 3px #FF9D00"
        });

        $(this).find(".nome_servico").css({
            color: "#FF9D00"
        });
    });

    $(".card").mouseleave(function () {
        $(this).find(".desc_servico").slideToggle(400);
        $(this).css({
            transform: "scale(1)",
            boxShadow: "0px 0px 3px rgba(113, 103, 103, 0.46)"
        });

        $(this).find(".nome_servico").css({
            color: "#2B8BEC"
        });
    });


    let slides = $(".card_slide");
    let currentIndex = 0;

    function showSlide(index) {
        slides.removeClass("active prev");
        slides.eq(currentIndex).addClass("prev"); // Slide anterior
        slides.eq(index).addClass("active"); // Novo slide ativo
    }

    function nextSlide() {
        let nextIndex = (currentIndex + 1) % slides.length;
        showSlide(nextIndex);
        currentIndex = nextIndex;
    }

    // Inicialização: exibe o primeiro slide
    showSlide(currentIndex);

    // Intervalo automático para o slider (4 segundos)
    setInterval(nextSlide, 4000);
});
