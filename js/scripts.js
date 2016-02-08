
jQuery(document).ready(function(){

    "use strict";
    if (jQuery('.l-preloader').length)
    {
        jQuery('body').queryLoader2({
            percentage: true,
            minimumTime: 7000,
            backgroundColor: '#ffffff',
            barColor: '#24388D',
            barHeight: 3,
            completeAnimation: 'fade'

        });

        jQuery(window).load(function(){
            window.addEventListener('DOMContentLoaded', function() {
            $("body").queryLoader2();

             });
            jQuery('.l-preloader-counter').text("100%");
            jQuery('.l-preloader-bar').stop().animate({
                "height": "100%"
            }, 200);
            window.setTimeout(function(){
                jQuery('.l-preloader' ).animate({height: 0}, 300, function () {
                    jQuery('.l-preloader').remove();
                    jQuery('#qLimageContainer').remove();
                });
            }, 200);
        });
    }
 

    jQuery(window).load(function(){
        jQuery('.no-touch .l-subsection.with_parallax').each(function(){
            jQuery(this).parallax('50%', '0.3');
        });
    });


});



    // Configuration API test
    Flowtime.showProgress(true);
    // Flowtime.fragmentsOnSide(true);
    // Flowtime.fragmentsOnBack(true);
    // Flowtime.useHistory(false);
    // Flowtime.slideInPx(true);
    // Flowtime.sectionsSlideToTop(true);
    // Flowtime.gridNavigation(false);
    // Flowtime.useOverviewVariant(true);
    // Flowtime.parallaxInPx(true);
    // Flowtime.clicker(true);
    Flowtime.loop(true);
    //
    //

    var prevTitle = document.querySelector(".title-prev");
    var nextTitle = document.querySelector(".title-next");

    prevTitle.addEventListener("click", Flowtime.prev, false);
    nextTitle.addEventListener("click", Flowtime.next, false);

    Flowtime.addEventListener("flowtimenavigation", onNavigation, false);

    function onNavigation(e)
    {
      var prevPage = Flowtime.getPrevPage();
      var nextPage = Flowtime.getNextPage();
      if (prevPage === null) {
        prevTitle.innerHTML = "";
      } else {
        prevTitle.innerHTML = "&lt; " + prevPage.getAttribute("data-title");
      }
      if (nextPage === null) {
        nextTitle.innerHTML = "";
      } else {
        nextTitle.innerHTML = nextPage.getAttribute("data-title") + " &gt;";
      }
    }

    // starts the application with configuration options
    Flowtime.start();
 // video backgrnd
 jQuery(function(){
            
            jQuery(".player").mb_YTPlayer();
        });
 $(document).ready(function() {
    $(".youtube-media").on("click", function(e) {
        var jWindow = $(window).width();
        if (jWindow <= 768) {
            return;
        }
        $.fancybox({
            href: this.href,
            padding: 4,
            type: "iframe",
            'href': this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
        });
        return false;
    });

});

$(document).ready(function() {
    $("a.single_image").fancybox({
        padding: 4,
    });
});
function Selected(a) {
    var label = a.value;
    if (label==1) {
        document.getElementById("Label1").style.display='block';
        document.getElementById("Label2").style.display='none';
    }
    else if (label==2) {
        document.getElementById("Label1").style.display='none';
        document.getElementById("Label2").style.display='block';
    }
    else {
       document.getElementById("Label1").style.display='none';
       document.getElementById("Label2").style.display='none'; 
    }
}
    jQuery(document).ready(function(){

    "use strict";
    jQuery('.contacts_form').each(function(){

        jQuery(this).find('.form-horizontal').submit(function(){
            var form = jQuery(this),
                name, email, phone,
                nameField = form.find('input[name=name]'),
                               
                emailField = form.find('input[name=email]'),
                phoneField = form.find('input[name=phone]'),
                message = form.find('textarea[name=message]').val(),
                errors = 0;

            if (nameField.length) {
                name = nameField.val();
            }
                                                
            if (emailField.length) {
                email = emailField.val();
            }

            if (phoneField.length) {
                phone = phoneField.val();
            }

            if (errors === 0){
                jQuery.ajax({
                    type: 'POST',
                    url: 'send_contact.php',
                    dataType: 'json',
                    data: {
                        action: 'sendContact',
                        name: name,
                                                
                        email: email,
                        phone: phone,
                        message: message
                    },
                    success: function(data){
                        if (data.success){
                            jQuery.jGrowl("Сообщение отправлено!");
                            if (nameField.length) {
                                nameField.val('');
                            }
                                                        
                            if (emailField.length) {
                                emailField.val('');
                            }
                            if (phoneField.length) {
                                phoneField.val('');
                            }
                            form.find('textarea[name=message]').val('');
                                                        
                        } else {
                            if (data.errors.name !== '' && data.errors.name !== undefined) {
                                jQuery.jGrowl(data.errors.name);
                            }
                                                        if (data.errors.org !== '' && data.errors.org !== undefined) {
                                jQuery.jGrowl(data.errors.org);
                            }
                            if (data.errors.email !== '' && data.errors.email !== undefined) {
                                jQuery.jGrowl(data.errors.email);
                            }
                            if (data.errors.phone !== '' && data.errors.phone !== undefined) {
                                jQuery.jGrowl(data.errors.phone);
                            }
                            if (data.errors.message !== '' && data.errors.message !== undefined) {
                                jQuery.jGrowl(data.errors.message);
                            }

                            if (data.errors.sending !== '' && data.errors.sending !== undefined) {
                                jQuery.jGrowl(data.errors.sending);
                            }
                        }
                    },
                    error: function(){
                    }
                });
            }

            return false;
        });

    });
});