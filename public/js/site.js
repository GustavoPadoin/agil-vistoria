jQuery(document).ready(function() {
	'use strict';
	dz_rev_slider_1(); 

    $("#btn-home").click(function (){
        $('html, body').animate({
            scrollTop: $("#div-home").offset().top - 90
        }, 2000);
    });

    $(".btn-agendar").click(function (){
        $('html, body').animate({
            scrollTop: $("#div-agendar").offset().top - 90
        }, 2000);
    });

    $("#btn-fotos").click(function (){
        $('html, body').animate({
            scrollTop: $("#div-fotos").offset().top - 90
        }, 2000);
    });

    $("#btn-servicos").click(function (){
        $('html, body').animate({
            scrollTop: $("#div-servicos").offset().top - 90
        }, 2000);
    });
    
});