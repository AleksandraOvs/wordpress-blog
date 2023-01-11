jQuery (function($){
    wp.customize ('my_theme_fixed_header', function(setting){
        setting.bind(function ( to ){
            false === value ? $('.navbar').removeClass ('navbar-fixed-top') : $('.navbar').addClass('navbar-fixed-top');
        });
    });
} );