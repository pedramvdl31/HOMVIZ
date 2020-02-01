$(document).ready(function() {

    main.pageLoad();
    main.events();
    MakeMenuGray();

});


main = {
    pageLoad: function() {

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        //     }
        // });

        // progressively.init({
        //     onLoadComplete: function() {
        //     }
        // });


    },
    events: function() {
        $('#main-contact-formx').submit(function(e) {
            e.preventDefault();
            var postdata = $('#main-contact-formx').serialize();
            requestw.send_email_purchace(postdata)
        });
        $('.tesreadmore').on('click', function() {
            $(this).parents('.item').find('.moretes').removeClass('hide');
            $(this).addClass('hide')
        });
        $('.navbar-nav .scroll a').on('click', function() {
            $('.scroll').removeClass('active');
            $(this).parent('.scroll').addClass('active')
        });
        $('.modal-body').on('click', function() {
            alert()
        });
        $(".nav").find(".scroll").on("click", "a", function() {
            $('.navbar-collapse.in').collapse('hide')
        });
        $('.nav .dropdown').on('click', function() {
            setTimeout(function() {
                var dx = $('.navbar-collapse');
                dx.scrollTop(dx.prop("scrollHeight"))
            }, 10)
        });
        $('.dropdown-submenu a').on('click', function() {
            setTimeout(function() {
                var dx = $('.navbar-collapse');
                dx.scrollTop(dx.prop("scrollHeight"))
            }, 10)
        })
    }
}
requestw = {
    send_email_purchace: function(pform) {
        var token = $('meta[name=csrf-token]').attr('content');
        $.post('/send-email-from-site', {
            "_token": token,
            "pform": pform
        }, function(result) {
            var status = result.status;
            switch (status) {
                case 200:
                    alert('Your email has been sent.');
                    $("input[name='name']").val('');
                    $("input[name='email']").val('');
                    $("input[name='subject']").val('');
                    $("textarea[name='message']").val('');
                    break;
                case 400:
                    alert('Somthing went wrong. Please try again later. ERR400');
                    break;
                default:
                    break
            }
        })
    }
};

function MakeMenuGray() {
    $(location).attr('href');
    var pathname = window.location.pathname;
    var slug = pathname.split('/');
    slug = slug[slug.length - 1];
    if (slug == '') {
        $('a[href^="#home"]').parent('.scroll').addClass('active')
    } else {
        var newhref = "/" + slug;
        $('a[href^="' + newhref + '"]').parent('.scroll').addClass('active')
    }
}


