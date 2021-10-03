#=include jquery-1.11.0.min.js
#=include bootstrap.min.js
#=include jquery.validate.js
#=include jquery.steps.js
#=include slick.js
#=include roundslider.min.js

//#=include configurador.js


jQuery.validator.addMethod( "nifES", function ( value, element ) {
    "use strict";

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
        return false;
    }

    // Test NIF
    if ( /^[0-9]{8}[A-Z]{1}$/.test( value ) ) {
        return ( "TRWAGMYFPDXBNJZSQVHLCKE".charAt( value.substring( 8, 0 ) % 23 ) === value.charAt( 8 ) );
    }
    // Test specials NIF (starts with K, L or M)
    if ( /^[KLM]{1}/.test( value ) ) {
        return ( value[ 8 ] === String.fromCharCode( 64 ) );
    }

    return false;

}, "Please specify a valid NIF number." );


jQuery.validator.addMethod( "nieES", function ( value, element ) {
    "use strict";

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
        return false;
    }

    // Test NIE
    //T
    if ( /^[T]{1}/.test( value ) ) {
        return ( value[ 8 ] === /^[T]{1}[A-Z0-9]{8}$/.test( value ) );
    }

    //XYZ
    if ( /^[XYZ]{1}/.test( value ) ) {
        return (
            value[ 8 ] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(
                value.replace( 'X', '0' )
                    .replace( 'Y', '1' )
                    .replace( 'Z', '2' )
                    .substring( 0, 8 ) % 23
            )
        );
    }

    return false;

}, "Please specify a valid NIE number." );



jQuery.validator.addMethod( "cifES", function ( value, element ) {
    "use strict";

    var sum,
        num = [],
        controlDigit;

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match( '((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)' ) ) {
        return false;
    }

    for ( var i = 0; i < 9; i++ ) {
        num[ i ] = parseInt( value.charAt( i ), 10 );
    }

    // Algorithm for checking CIF codes
    sum = num[ 2 ] + num[ 4 ] + num[ 6 ];
    for ( var count = 1; count < 8; count += 2 ) {
        var tmp = ( 2 * num[ count ] ).toString(),
            secondDigit = tmp.charAt( 1 );

        sum += parseInt( tmp.charAt( 0 ), 10 ) + ( secondDigit === '' ? 0 : parseInt( secondDigit, 10 ) );
    }

    // CIF test
    if ( /^[ABCDEFGHJNPQRSUVW]{1}/.test( value ) ) {
        sum += '';
        controlDigit = 10 - parseInt( sum.charAt( sum.length - 1 ), 10 );
        value += controlDigit;
        return ( num[ 8 ].toString() === String.fromCharCode( 64 + controlDigit ) || num[ 8 ].toString() === value.charAt( value.length - 1 ) );
    }

    return false;

}, "Please specify a valid CIF number." );


jQuery.validator.addMethod( "phone", function ( value, element ) {
    "use strict";

    value = value.toUpperCase();

    if(/((\+?34([_\t|\-])?)?[9|6|7]((\d{1}([_\t|\-])?[0-9]{3})|(\d{2}([_\t|\-])?[0-9]{2}))([_\t|\-])?[0-9]{2}([_\t|\-])?[0-9]{2})/.test(value)){
        return true;
    }



    return false;

}, "Ingersa un numero de telefono valido" );

jQuery.validator.addMethod( "nifCifNie", function ( value, element ) {
    "use strict";

    value = value.toUpperCase();


    //NIF

    // Basic format test
    if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
        return false;
    }

    // Test NIF
    if ( /^[0-9]{8}[A-Z]{1}$/.test( value ) ) {
        return ( "TRWAGMYFPDXBNJZSQVHLCKE".charAt( value.substring( 8, 0 ) % 23 ) === value.charAt( 8 ) );
    }
    // Test specials NIF (starts with K, L or M)
    if ( /^[KLM]{1}/.test( value ) ) {
        return ( value[ 8 ] === String.fromCharCode( 64 ) );
    }


    //NIE

    // Basic format test
    if ( !value.match('((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)') ) {
        return false;
    }

    // Test NIE
    //T
    if ( /^[T]{1}/.test( value ) ) {
        return ( value[ 8 ] === /^[T]{1}[A-Z0-9]{8}$/.test( value ) );
    }

    //XYZ
    if ( /^[XYZ]{1}/.test( value ) ) {
        return (
            value[ 8 ] === "TRWAGMYFPDXBNJZSQVHLCKE".charAt(
                value.replace( 'X', '0' )
                    .replace( 'Y', '1' )
                    .replace( 'Z', '2' )
                    .substring( 0, 8 ) % 23
            )
        );
    }


    //CIF
    var sum,
        num = [],
        controlDigit;

    value = value.toUpperCase();

    // Basic format test
    if ( !value.match( '((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)' ) ) {
        return false;
    }

    for ( var i = 0; i < 9; i++ ) {
        num[ i ] = parseInt( value.charAt( i ), 10 );
    }

    // Algorithm for checking CIF codes
    sum = num[ 2 ] + num[ 4 ] + num[ 6 ];
    for ( var count = 1; count < 8; count += 2 ) {
        var tmp = ( 2 * num[ count ] ).toString(),
            secondDigit = tmp.charAt( 1 );

        sum += parseInt( tmp.charAt( 0 ), 10 ) + ( secondDigit === '' ? 0 : parseInt( secondDigit, 10 ) );
    }

    // CIF test
    if ( /^[ABCDEFGHJNPQRSUVW]{1}/.test( value ) ) {
        sum += '';
        controlDigit = 10 - parseInt( sum.charAt( sum.length - 1 ), 10 );
        value += controlDigit;
        return ( num[ 8 ].toString() === String.fromCharCode( 64 + controlDigit ) || num[ 8 ].toString() === value.charAt( value.length - 1 ) );
    }

    return false;

}, "Ingersa un documento válido" );







$(document).ready(function(){

    function resizeHeaderOnScroll() {
        var distanceY = window.pageYOffset || document.documentElement.scrollTop,
            shrinkOn = 20,
            headerEl = $('header');

        if (distanceY > shrinkOn) {
            headerEl.removeClass("shrink");
        } else {
            headerEl.addClass("shrink");
        }
    }

    window.addEventListener('scroll', resizeHeaderOnScroll);

    if($(window).width() > 1024){
        $('[data-toggle="tooltip"]').tooltip({trigger:'hover'});
    }



    $('.js-use-previous-data').on('change',function(e){
        var $this = $(this);
        var $form =  $this.closest('form');
       if($(this).prop('checked')){
           $.each( $form.data(), function( key, value ) {
               // console.log( key + ": " + value );
               if(key==='provincia' && value === '') value = 31;
               $form.find("[name='form["+key+"]']").val(value);
           });
       }else {
           $form.get(0).reset()
       }
    });

    //number range
    $('.js-iban-send').validate({
        errorPlacement: function errorPlacement(error, element) { element.after(error); },
        rules: {
            'userIBAN' : {
                required: true,
                minlength: 24
                /*,
                nifCifNie:true*/
            }
        },
        messages: {
            'userIBAN': {
                minlength:'Introduce un IBAN valido'
            }
        },
        submitHandler: function (form) {
            $('#loadingModal').modal('show');
            var $form = $(form);
            $.ajax({
                url: "/user-account/update/"+$form.data('id')+"/"+$('#userIBAN').val(),
                type: 'post'
            })
            .done(function( data ) {
                console.log(data);
                $form
                $form.replaceWith($('#userIBAN').val());
                $('#loadingModal').modal('hide');


            })
            .fail(function(jqXHR, textStatus) {
                // console.log(xhr);
                // console.log(ajaxOptions);
                // console.log(thrownError);
                console.log('aaaa');
            })
            .always(function() {
                // console.log('aaaaaaa')
                $('#loadingModal').modal('hide');
            });
            return false;
        }
    });

    $('.js-iban-send').on('submit',function(e){

    });

  $('.js-slick-slider').slick({
		arrows: false,
		dots: true,
		infinite: true,
		slidesToShow: 1,
		adaptiveHeight: true,
          autoplay: true,
          autoplaySpeed: 5000
  });


  $('.js-slider').slick({
        slidesToShow: 1,
        dots: true,
        fade: true,
        cssEase: 'linear',
        autoplay: true,
        autoplaySpeed: 10000,
        customPaging : function(slider, i) {
            var tooltip = $(slider.$slides[i]).data('tooltip');
            return '<div class="thumb-slider__dot"><span class="thumb-slider__number">' + (i + 1)  + '</span><span class="thumb-slider__tooltip">'+tooltip+'</span></div>';
        }
  });

    $('.js-thumb-slider').slick({
        speed: 300,
        slidesToShow: 1,
        dots: true,
        fade: true,
        dotsClass: 'thumb-dots',
        speed:0,
        cssEase: 'linear',
        customPaging : function(slider, i) {
            var img = $(slider.$slides[i]).data('thumb');
            return '<div class="thumb__dot"><img src="'+img+'"></div>';
        }
    });


  var $configuratorPanels = $('.js-configurator-panel');
  var $configuratorPanelsContainer = $configuratorPanels.parents('.configurator-panel-container');
  var $activePanel = null;

  $('.js-toggle-configurator').on('click', function(e){
      if($activePanel){
          $activePanel.removeClass('active');
          $activePanel = null;
      }else {
          $activePanel = $($('.js-configurator-button').eq(0).attr('href'));
          $activePanel.addClass('active');
      }

      if($activePanel) {
          $configuratorPanelsContainer.addClass('active');
          $('.js-toggle-configurator').addClass('active');
      }else {
          $configuratorPanelsContainer.removeClass('active');
          $('.js-toggle-configurator').removeClass('active');
      }

  });

  $('.js-configurator-button').on('click',function(e){
        e.preventDefault();
        var $panel = $($(this).attr('href'));

        if($activePanel && $activePanel.is($panel)) {
            $panel.removeClass('active');
            $activePanel = null;
        }else if($activePanel) {
            $activePanel.removeClass('active');
            $panel.addClass('active');
            $activePanel = $panel;
        }else {
            $panel.addClass('active');
            $activePanel = $panel;
        }

          if($activePanel) {
              $configuratorPanelsContainer.addClass('active');
              $('.js-toggle-configurator').addClass('active');
          }else {
              $configuratorPanelsContainer.removeClass('active');
              $('.js-toggle-configurator').removeClass('active');
          }

    });

    var form = $(".js-fosuser-form").show();

    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        enableAllSteps: true,
        enablePagination: true,
        transitionEffect: "slideLeft",
        labels: {
            cancel: "Cancelar",
            current: "current step:",
            pagination: "Pagination",
            finish: "Enviar",
            next: "Siguiente",
            previous: "Anterior",
            loading: "Cargando ..."
        },

        onStepChanging: function (event, currentIndex, newIndex)
        {
            // Allways allow previous action even if the current form is not valid!
            if (currentIndex > newIndex)
            {
                return true;
            }
            if (currentIndex < newIndex)
            {
                // To remove error styles
                form.find(".body:eq(" + newIndex + ") label.error").remove();
                form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex)
        {
            $('#steps-title').text($(this).find('.title.current').text());

            $('#step-count').text((currentIndex + 1) + ' de ' + $(this).find('.steps li').length);
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
            form.submit();
        }
    }).validate({
        errorPlacement: function errorPlacement(error, element) { element.after(error); },
        rules: {
            'fos_user_registration_form[email]': {
                required: true,
                email: true
            },
            'fos_user_registration_form[plainPassword][first]': {
                required: true,
                minlength: 5
            },
            'fos_user_registration_form[plainPassword][second]': {
                required: true,
                equalTo: "#fos_user_registration_form_plainPassword_first"
            },
            'fos_user_registration_form[cardNumber]' : {
                required: function(element) {
                    return $(element).is(':visible');
                }
            },
            'fos_user_registration_form[cardExpiration]' : {
                required: function(element) {
                    return $(element).is(':visible');
                }
            },
            'fos_user_registration_form[card_code]' : {
                required: function(element) {
                    return $(element).is(':visible');
                }
            },
            'fos_user_registration_form[ibanCode]' : {
                required: function(element) {
                    return $(element).is(':visible');
                }
            }
        },
        messages: {
            'fos_user_registration_form[email]': {
                required: 'Campo obligatorio',
                email: 'Introduce un email válido'
            },
            'fos_user_registration_form[plainPassword][first]': {
                required: 'Campo obligatorio',
                minlength: 'mínimo 5 caracteres'
            },
            'fos_user_registration_form[plainPassword][second]': {
                required: 'Campo obligatorio',
                equalTo: 'las contraseñas no coinciden'
            }
        }
    });

    $('.js-validate-form').validate({
        errorPlacement: function errorPlacement(error, element) { element.after(error); },
        rules: {
            'name' : {
                required: true
            },
            'cif' : {
                required: true,
                nifCifNie:true
            },
            'address' : {
                required: true
            },
            'population' : {
                required: true
            },
            'province' : {
                required: true
            },
            'cp' : {
                required: true,
                number:true
            },
            'phone' : {
                required: true,
                phone:true
            },
            'email' : {
                required: true,
                email: true
            },
            'pasword' : {
                required: true
            },
            'repeatPassword' : {
                required: true,
                equalTo : '#pasword'
            }
        },
        messages: {
            'email': {
                required: 'Campo obligatorio',
                email: 'Introduce un email válido'
            },
            'pasword': {
                required: 'Campo obligatorio',
                minlength: 'mínimo 5 caracteres'
            },
            'fos_user_registration_form[plainPassword][second]': {
                required: 'Campo obligatorio',
                equalTo: 'repeatPassword'
            }
        },
        submitHandler: function (form) {
            $('#loadingModal').modal('show');
            $.ajax({
                url: "/user/new",
                type: 'post',
                data: $(form).serialize()
            })
            .done(function( data ) {
                // console.log(data);
                $('#greeting').find('.js-redirect').on('click', function () {
                    window.location.href = data.page;
                });
                $('#loadingModal').modal('hide');
                $('#greeting').modal('show');


            })
            .fail(function(jqXHR, textStatus) {
                // console.log(xhr);
                // console.log(ajaxOptions);
                // console.log(thrownError);
                console.log('aaaa');
            })
            .always(function() {
                // console.log('aaaaaaa')
                $('#loadingModal').modal('hide');
            });
            return false;
        }
    });


    var adress = {};
    var $dirAdd = $('#dir-add'),
        $dirNum = $('#dir-num'),
        $dirPiso = $('#dir-piso'),
        $dirEsc = $('#dir-esc'),
        $dirProv = $('#dir-prov'),
        $dirCp = $('#dir-cp');
    var $defaulAdrresInput = $('#fos_user_registration_form_address');
    $dirAdd.on('change',setAdress);
    $dirNum.on('change',setAdress);
    $dirPiso.on('change',setAdress);
    $dirEsc.on('change',setAdress);
    $dirProv.on('change',setAdress);
    $dirCp.on('change',setAdress);

    function setAdress() {
        adress.direccion = $dirAdd.val();
        adress.num = $dirNum.val();
        adress.piso = $dirPiso.val();
        adress.esc = $dirEsc.val();
        adress.prov = $dirProv.val();
        adress.cp = $dirCp.val();
        $defaulAdrresInput.val(JSON.stringify(adress));
    }


    //PAGINA IMPRESORAS

    $('.js-printers').on('click', '.js-select-printer', function(){
        window.location.href = "configurer/"+$(this).data('id');
    });


    $('.js-printer-search').on('click', ajaxPrinterSearch);

    var $impresorasTemplate =  $('.js-ajax-list').find('.js-ajax-item').first();
    function ajaxPrinterSearch(){

        $.ajax({
            url: '/impresoras/update/'+$('#format').val()+'/'+$('#chroma').val()+'/'+$('#functionality').val()+'/'+$('#maker').val(),
            type: 'post'
        })
            .done(function( data ) {

                var $list = $('.js-ajax-list');
                var $template = $impresorasTemplate;
                $list.empty();

                if(data.length === 0) {
                    console.log('no data');
                    $list.append('<div class="alert alert-info" role="alert">No hay datos asociados a los parametros de busqueda</div>');
                    return false;
                }
                //get template


                function buildList(obj) {
                    var $list = $('<div class="js-ajax-list"></div>');
                    $.each( obj, function(index, value) {
                        //$list.append( "<h1>"+value.id+"</h1>" );
                        var $clone = $template.clone();
                        var $slider = $('<div class="js-thumb-slider imp-slider">'+
                            '<div data-thumb="/uploads/'+value.imageFront+'"><img src="/uploads/'+value.imageFront+'" class="res-img"></div>'+
                            '<div data-thumb="/uploads/'+value.imagePerspective+'"><img src="/uploads/'+value.imagePerspective+'" class="res-img"></div>'+
                            '<div data-thumb="/uploads/'+value.imageLateral+'"><img src="/uploads/'+value.imageLateral+'" class="res-img"></div>'+
                            '</div>');

                        // var $tabs = $('<ul class="print-tab-nav">'+
                        //     '<li class="active"><a href="#caract-'+value.id+'" aria-controls="home" role="tab" data-toggle="tab" class="button">Caracteristicas</a></li>'+
                        //     '<li><a href="#desc-'+value.id+'" aria-controls="home" role="tab" data-toggle="tab" class="button">Descripción</a></li>'+
                        //     '</ul>');
                        // var $panels = $('<div class="tab-content">'+
                        //     '<div id="caract-'+value.id+'" role="tabpanel" class="tab-pane active">'+
                        //     '<p>'+value.aditionalInfo+'</p>'+
                        //     '</div>'+
                        //     '<div id="desc-'+value.id+'" role="tabpanel" class="tab-pane">'+
                        //     '<p>'+value.aditionalMainInfo+'</p>'+
                        //     '</div>');
                        //
                        //
                        //
                        //
                        var $iconList = $('<ul class="iconic-list list-inline"></ul>');


                        var list = '';
                        if(value.airPrint){
                            list += '<li>'+
                                '<span class="icon-doc"></span>'+
                                '</li>';
                        }
                        if(value.wifi) {
                            list += '<li>'+
                                '<span class="icon-wifi"></span>'+
                                '</li>';
                        }
                        if(value.cloud) {
                            list += '<li>'+
                                '<span class="icon-net"></span>'+
                                '</li>';
                        }
                        if(value.nfc) {
                            list += '<li>'+
                                '<span class="icon-device"></span>'+
                                '</li>';
                        }
                        if(value.sheet) {
                            list += '<li>'+
                                '<a href="/uploads/product/sheet/'+value.sheet+'" target="_blank">'+
                                    '<span class="icon-pdf"></span>'+
                                '</a>'+
                                '</li>';
                        }

                        $iconList.append(list);
                        //
                        // $clone.find('imp-print-cost__item').eq(0).text(value.colorPageCost.toFixed(5)+' €');
                        // $clone.find('imp-print-cost__item').eq(1).text(value.blackPageCost.toFixed(5)+' €');

                        $clone.find('.js-select-printer').attr("data-id",value.id);
                        $clone.find('.js-thumb-slider').replaceWith($slider);
                        // $clone.find('.print-tab-nav').replaceWith($tabs);
                        $clone.find('.iconic-list').replaceWith($iconList);
                        // $clone.find('.tab-content').empty().append($panels);
                        $clone.find('h2').text(value.description);
                        $clone.find('.js-machine-subtitle').html(value.aditionalInfo );

                        $list.append($clone);
                    });
                    return $list;
                }

                $list.replaceWith(buildList(data.machineList));

                //re init carousels
                $('.js-thumb-slider').slick({
                    speed: 300,
                    slidesToShow: 1,
                    dots: true,
                    fade: true,
                    dotsClass: 'thumb-dots',
                    speed:0,
                    cssEase: 'linear',
                    customPaging : function(slider, i) {
                        var img = $(slider.$slides[i]).data('thumb');
                        return '<div class="thumb__dot"><img src="'+img+'"></div>';
                    }
                });
            })
            .fail(function() {
                //alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
            });

    }


    $('#submit-adress').find('.js-submit-adress').on('click',function(){
        $('#adress-form').data('isvalid',true);
        $('#adress-form').submit();
    });

    $('#adress-form').submit(function(){
        $('#submit-adress').modal('show');
        if($('#adress-form').data('isvalid')){
            return true;
        }else {
            return false;
        }
    });

    // $('.js-send-adress').on('click',function() {
    //     $('#submit-adress').find('.js-submit-adress').on('click',function() {
    //         $('#adress-form').submit();
    //     });
    //     $('#submit-adress').modal('show');
    // });


    var $numberInput = $('.number-range');
    var $numberPlus = $('.number-range-plus');
    var $numberMnus = $('.number-range-minus');
    var interval;

    $numberPlus.on({
        mousedown : function () {
            interval = window.setInterval(function(){
                $numberInput.val(parseInt($numberInput.val()) + 1);
            }, 50);
        },
        mouseup : function () {
            window.clearInterval(interval);
            checkDefaults ();
        }
    });

    $numberMnus.on({
        mousedown : function () {

            interval = window.setInterval(function(){
                if($numberInput.val() <= 250){
                    $numberInput.val(250);
                    window.clearInterval(interval);
                    return false;
                }
                $numberInput.val(parseInt($numberInput.val()) - 1);
            }, 50);
        },
        mouseup : function () {
            window.clearInterval(interval);
            checkDefaults ();
        }
    });

    $('#pages').on('change', function(){
        if($(this).val() < 250) {
            $(this).val(250)
        }
        checkDefaults ();
    });


    var defaultValues = {
        functionality : $('#funcion').data('default'),
        color : $('#color').data('default'),
        tamano : $('#tamano').data('default'),
        tiempo : $('#tiempo').data('default'),
        ink : $('#ink').data('default'),
        //tecnologia: $('#tecnologia').data('default'),
        pages : $('#pages').data('default')
    };



    $("#ink").roundSlider({
        min:15,
        max: 100,
        startAngle: 180,
        radius: 55,
        width: 4,
        value: $('#ink').data('default'),
        handleSize: "+14",
        tooltipFormat: function(args){
            return args.value + '%';
        },
        change: function(e){
            //console.log(e.value);
            checkDefaults ();
        }
    });


    $configuratorPanels.on('click', '.configurator-panel__item', function() {
        if($(this).hasClass('selected')) return;
        $(this).siblings('.configurator-panel__item.selected').removeClass('selected');
        $(this).addClass('selected');
        checkDefaults();
    });

    var $contratarButton = $('.configurator-price__ca');

    if($('#color').find('.configurator-panel__item.selected').data('id') == 2) {
        $("#ink").roundSlider("disable");
    }

    function checkDefaults (){
        var disabled = false;
        $configuratorPanels.each(function(index, value){
            var panel = $(this).attr('id');
            if(defaultValues[panel] !== $('#'+panel).find('.configurator-panel__item.selected').data('id')) {
                disabled = true;
                return;
            }
        });

        if($('#color').find('.configurator-panel__item.selected').data('id') == 2) {
            $("#ink").roundSlider("disable");
            $('#ink').css('opacity', 0);
        }else {
            $("#ink").roundSlider("enable");
            $('#ink').css('opacity', 1);
            //TODO
        }


        if(defaultValues.ink !== parseInt($("input[name='ink']").val())){
            disabled = true;
        }

        if(parseInt(defaultValues.pages) !== parseInt($('#pages').val())){
            disabled = true;
        }

        if(disabled){
            $('.js-apply-filter').attr('disabled', false);
            $contratarButton.attr('disabled', 'disabled');
            $('.machine-list__ca-button').attr('disabled', 'disabled');
        }else {
            $('.js-apply-filter').attr('disabled', 'disabled');
            $contratarButton.attr('disabled', false);
            $('.machine-list__ca-button').attr('disabled', false);
        }
    }

    $contratarButton.on('click', function(){
        $('#loadingModal').modal('show');
        var machineId = $(this).data('id');

        var porColor = $('#color').find('.configurator-panel__item.selected').data('id') === 1 ? $("input[name='ink']").val()  : 0;
        var url = '/contract-info/update/'+
                machineId+
                '/'+porColor+
                //'/'+$('#color').find('.configurator-panel__item.selected').data('id')+
                '/'+$('#pages').val()+
                '/'+($('#tiempo').find('.configurator-panel__item.selected').data('id') * 12)
        $.ajax({
            url: url,
            type: 'post'
        })
        .done(function( data ) {



            var contract = data[0];
            console.log(contract);

            if(contract.length === 0) {
                $('#configurer-notification').modal('show');
                return;
            }

            var $row =$('<div class="flex-row"><div class="flex-left"></div><div class="flex-right"></div></div>');
            var $rowCenter =$('<div class="flex-row"><div class="flex-left"></div><div class="flex-center"></div><div class="flex-right"></div></div>');
            var $rowFour =$('<div class="flex-row"><div class="flex-left"></div><div class="flex-center-left"></div><div class="flex-center-right"></div><div class="flex-right"></div></div>');

            var $cInfo1 = $('.js-contract-info-1');
            var $cInfo2 = $('.js-contract-info-2');


            //build resumend modal
            $cInfo1.empty();

            //Imagenes
            $row.find('.flex-left').html('<img src="/uploads/'+ contract.images.front +'">');
            $row.find('.flex-right').html('<img src="/uploads/'+ contract.images.lateral +'">');
            $cInfo1.append($row.clone());

            //Equipos y servicios list
            $cInfo1.append('<h3>'+contract.equipos.title+'</h3>');
            $row.find('.flex-left').text(contract.equipos.Equipo.title);
            $row.find('.flex-right').text(contract.equipos.Equipo.value);
            $cInfo1.append($row.clone());

            $row.find('.flex-left').text(contract.equipos.Servicios.title);
            $row.find('.flex-right').empty();
            $.each(contract.equipos.Servicios.value, function( index, value ) {
                $row.find('.flex-right').append('<div>'+value+'</div>')
            });
            $cInfo1.append($row.clone());

            $row.find('.flex-left').text(contract.duracion.duracion.title);
            $row.find('.flex-right').text(contract.duracion.duracion.value);
            $cInfo1.append($row.clone());


            //Volumen de impresión
            $cInfo2.empty();
            $cInfo2.append('<h3>'+contract.volumen.title+'</h3>');
            $row.find('.flex-left').text(contract.volumen.total.title);
            $row.find('.flex-right').text(contract.volumen.total.value);
            $cInfo2.append($row.clone());
            $row.find('.flex-left').text(contract.volumen.percent.title);
            $row.find('.flex-right').text(contract.volumen.percent.value);
            $cInfo2.append($row.clone());


            //Consumibles incluidos
            $cInfo2.append('<h3>'+contract.consumibles.title+'</h3>');
            console.log(contract.consumibles);

            $.each(contract.consumibles.toner, function( index, value ) {
                    value = value[0];
                    $rowFour.find('.flex-left').text(value.title);
                    $rowFour.find('.flex-center-left').text(value.name + ' (' + value.pages + ' páginas)');
                    $rowFour.find('.flex-center-right').text(value.pvp.toFixed(2) + ' ' + contract.consumibles.pvp.unit);
                    $rowFour.find('.flex-right').text(value.amount.toFixed(2) + ' ' + contract.consumibles.amount.unit);


                    $cInfo2.append($rowFour.clone());
            });



            // $rowFour.find('.flex-left').text(contract.duracion.fecha.title);
            // $rowFour.find('.flex-right').text(contract.duracion.fecha.value);
            //$cInfo2.append($rowFour.clone());

            //Cuota mes
            $cInfo2.append('<h3>'+contract.cuota.title+'</h3>');
            $row.find('.flex-left').text(contract.cuota.fijo.title);
            $row.find('.flex-right').text(contract.cuota.fijo.value + ' ' + contract.cuota.fijo.unit);
            $cInfo2.append($row.clone());
            $row.find('.flex-left').text(contract.cuota.variable.title);
            $row.find('.flex-right').text(contract.cuota.variable.value + ' ' + contract.cuota.variable.unit);
            $cInfo2.append($row.clone());
            $row.find('.flex-left').text(contract.cuota.total.title);
            $row.find('.flex-right').text(contract.cuota.total.value + ' ' + contract.cuota.total.unit);
            $cInfo2.append($row.clone());

            $('.js-go-to-adrress').data('id', machineId);




            $('#loadingModal').modal('hide');
            $('#resumen').modal('show');

        })
        .fail(function() {
            //alert( "error" );
        })
        .always(function() {
            //alert( "complete" );
            $('#loadingModal').modal('hide');
        });
        //$('#resumen').modal('show');


        // window.location = '/contratar-servicio/crear-oferta/'+
        //     $(this).data('id')+
        //     '/'+$('#color').find('.configurator-panel__item.selected').data('id')+
        //     '/'+$('#pages').val()+
        //     '/'+($('#tiempo').find('.configurator-panel__item.selected').data('id') * 12)
    });

    $('.js-go-to-adrress').on('click', function (e) {
        var porColor = $('#color').find('.configurator-panel__item.selected').data('id') === 1 ? $("input[name='ink']").val()  : 0;
        window.location = '/contratar-servicio/crear-oferta/'+
            $(this).data('id')+
            '/'+porColor+
            //'/'+$('#color').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#pages').val()+
            '/'+($('#tiempo').find('.configurator-panel__item.selected').data('id') * 12)
    });


    var $configuratorList = $('.machine-list');
    var $configuratorListTemplate = $configuratorList.find('.machine-list__item').first();

    $configuratorList.on('click', '.machine-list__ca-button',function() {
        var url = '/configurer/update-list'+
            //$('#tecnologia').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#tamano').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#color').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#funcion').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#pages').val()+
            '/'+$('#tiempo').find('.configurator-panel__item.selected').data('id')+
            '/'+$("input[name='ink']").val()+
            '/'+$(this).data('id');
            $('#loadingModal').modal('show');
        console.log(url);
        $.ajax({
            url: url,
            type: 'post'
        })
            .done(function( data ) {

                if(data.length === 0) {
                    $('#configurer-notification').modal('show');
                    return;
                }

                buildCofigurerList(data);
                buildCofigurerRecomended(data);

            })
            .fail(function() {
                //alert( "error" );
            })
            .always(function() {
                //alert( "complete" );
                $('#loadingModal').modal('hide');
            });
    });




    $('.js-apply-filter'). on('click', function() {
        var url = '/configurer/update'+
            //$('#tecnologia').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#tamano').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#color').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#funcion').find('.configurator-panel__item.selected').data('id')+
            '/'+$('#pages').val()+
            '/'+$('#tiempo').find('.configurator-panel__item.selected').data('id')+
            '/'+$("input[name='ink']").val();
        $('.js-apply-filter').attr('disabled', true);
        $('#loadingModal').modal('show');
        console.log(url);
            $.ajax({
                url: url,
                type: 'post'
            })
            .done(function( data ) {

                if(data.length === 0) {
                    $('#configurer-notification').modal('show');
                    return;
                }
                buildCofigurerList(data);
                buildCofigurerRecomended(data);


            })
            .fail(function(a,b,c) {
            })
            .always(function(a,b,c) {
                checkDefaults();
                $('#loadingModal').modal('hide');
            });
    });

    function buildCofigurerRecomended(data) {
        console.log(data);
        var recomended = data.recomended;
        recomended.funcion = recomended.functionality;
        var prices = data.prices;

        var $slider = $('<div class="configurer-slider js-slick-slider alt-dot">'+
            '<div class="configurer-slider__item">'+
                '<div class="configurer-slider__inner">'+
                    '<div class="configurer-slider__content">'+
                        '<img src="/uploads/'+recomended.imageFront+'">'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="configurer-slider__item">'+
                '<div class="configurer-slider__inner">'+
                    '<div class="configurer-slider__content">'+
                        '<img src="/uploads/'+recomended.imagePerspective+'">'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="configurer-slider__item">'+
                '<div class="configurer-slider__inner">'+
                    '<div class="configurer-slider__content">'+
                        '<img src="/uploads/'+recomended.imageLateral+'">'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>');

        $('.configurer-slider.js-slick-slider').replaceWith($slider);

        //re init carousels
        $('.configurer-slider.js-slick-slider').slick({
            arrows: false,
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });

        $('.recomended-name').text(recomended.description);
        $('.recomended-desc').html(recomended.aditionalInfo);

        $('#funcion').attr("data-default",recomended.funcion);
        $('#funcion')
            .find('.configurator-panel__item').removeClass('selected')
            .filter("[data-id='"+recomended.funcion+"']").addClass('selected');
        defaultValues.funcion = recomended.funcion;

        $('#color').attr("data-default",recomended.chromaType);
        $('#color')
            .find('.configurator-panel__item').removeClass('selected')
            .filter("[data-id='"+recomended.chromaType+"']").addClass('selected');
        defaultValues.color = recomended.chromaType;

        $('#tamano').attr("data-default",recomended.format);
        $('#tamano')
            .find('.configurator-panel__item').removeClass('selected')
            .filter("[data-id='"+recomended.format+"']").addClass('selected');
        defaultValues.tamano = recomended.format;


        if(recomended.chromaType === 2) {//b&w
            // $('#ink').attr("data-default", 0);
            //
            // $('#ink').attr("data-default", 15);
            // defaultValues.ink = 15;
            // $('#ink').hide();


            $('#ink').attr("data-default", 15);
            defaultValues.ink = 15;
            $('#ink').roundSlider("setValue", 15);
            $('#ink').css('opacity', 0);
        }else {

            $('#ink').attr("data-default", $('#ink').roundSlider("getValue"));
            $("input[name='ink']").val($('#ink').roundSlider("getValue"));
            defaultValues.ink = $('#ink').roundSlider("getValue");


            // if($('#ink').roundSlider("getValue") !== 15){
            //     $('#ink').attr("data-default", $('#ink').roundSlider("getValue"));
            //     defaultValues.ink = $('#ink').roundSlider("getValue");
            // }else {
            //     $('#ink').attr("data-default", 15);
            //     defaultValues.ink = 15;
            // }

            //set min to 15
            //$('#ink').roundSlider("min", "value", 15 );
            $('#ink').css('opacity', 1);
            $('#ink').trigger('change');
            //$('#ink').show();
        }

        $('#ink').attr("data-default",recomended.format);

        $('#pages').attr("data-default",$('#pages').val());
        defaultValues.pages = $('#pages').val();

        $('#tiempo').attr("data-default",$('#tiempo').find('.configurator-panel__item.selected').data('id'));
        defaultValues.tiempo = $('#tiempo').find('.configurator-panel__item.selected').data('id');

        // $('#tecnologia').attr("data-default",recomended.technology);
        // $('#tecnologia')
        //     .find('.configurator-panel__item').removeClass('selected')
        //     .filter("[data-id='"+recomended.technology+"']").addClass('selected');


        $('.configurator-price-fixed').text(prices[recomended.id].fixedPrice.toFixed(2)+' €');
        $('.configurator-price-variable').text(prices[recomended.id].variablePrice.toFixed(2)+' €');
        $('.configurator-price-pag').eq(0).text(prices[recomended.id].costByBlackPage.toFixed(5)+' €');


        if(prices[recomended.id].costByColorPage.toFixed(5) == 0) {
            $('.configurator-price-pag').eq(1).parent().addClass('not-visible');
        }else {
            $('.configurator-price-pag').eq(1).parent().removeClass('not-visible');
        }
        $('.configurator-price-pag').eq(1).text(prices[recomended.id].costByColorPage.toFixed(5)+' €');



        $('.configurator-price-total').text(prices[recomended.id].totalPrice.toFixed(2)+' €');

        $('.configurator-price__ca').attr("data-id",recomended.id);
        $('.configurator-price__ca').data("id",recomended.id);

        var list = '';

        if(recomended.airPrint){
            list += '<li>'+
                '<span class="icon-doc"></span>'+
                // '<div>Impresión móvil</div>'+
                '</li>';
        }

        if(recomended.wifi) {
            list += '<li>'+
                '<span class="icon-wifi"></span>'+
                // '<div>Wifi</div>'+
                '</li>';
        }

        if(recomended.cloud) {
            list += '<li>'+
                '<span class="icon-net"></span>'+
                // '<div>Cloud</div>'+
                '</li>';
        }

        if(recomended.nfc) {
            list += '<li>'+
                '<span class="icon-device"></span>'+
                // '<div>NFC</div>'+
                '</li>';
        }

        if(recomended.sheet) {
            list += '<li>'+
                '<a href="'+data.pdfroute+recomended.sheet+'" target="_blank">'+
                '<span class="icon-pdf"></span>'+
                // '<div>Ficha de producto</div>'+
                '</a>'+
                '</li>';
        }

        $('.recomended-iconic-list').html(list);



        checkDefaults ();

    }

    function buildCofigurerList(data) {
        $configuratorList.empty();
        var recomended = data.recomended;
        var prices = data.prices;

        $.each(data.machineList, function(index , value) {
            if(value.id !== recomended.id) {
                var $clone = $configuratorListTemplate.clone().removeClass('machine-list__item--hidden');

                $clone.find('.machine-list__name-text').text('Opción ' + (index + 1));
                $clone.find('.machine-list__name-name').text(value.description);

                $clone.find('.machine-list__picture img').attr('src', '/uploads/' + value.imageFront);

                $clone.find('.machine-list-fixed-price').find('.machine-list__price-price').text( prices[value.id].fixedPrice.toFixed(2) + ' €');
                $clone.find('.machine-list-variable-price').find('.machine-list__price-price').text(prices[value.id].variablePrice.toFixed(2) + ' €');
                $clone.find('.machine-list-page-price-bn').find('.machine-list__price-price').text(prices[value.id].costByBlackPage.toFixed(5) + ' €');
                $clone.find('.machine-list-page-price-color').find('.machine-list__price-price').text(prices[value.id].costByColorPage.toFixed(5) + ' €');
                $clone.find('.machine-list__price-total').find('.machine-list__price-price').text(prices[value.id].totalPrice.toFixed(2) + ' €');

                var list = '';

                if(value.airPrint){
                    list += '<li>'+
                        '<span class="icon-doc"></span>'+
                        '</li>';
                }

                if(value.wifi) {
                    list += '<li>'+
                        '<span class="icon-wifi"></span>'+
                        '</li>';
                }

                if(value.cloud) {
                    list += '<li>'+
                        '<span class="icon-net"></span>'+
                        '</li>';
                }

                if(value.nfc) {
                    list += '<li>'+
                        '<span class="icon-device"></span>'+
                        '</li>';
                }

                if(value.sheet) {
                    list += '<li>'+
                        '<a href="'+data.pdfroute+value.sheet+'" target="_blank">'+
                        '<span class="icon-pdf"></span>'+
                        '</a>'+
                        '</li>';
                }

                $clone.find('.iconic-list.list-inline').html(list);

                $clone.find('.machine-list__ca-button').attr("data-id",value.id);

                $configuratorList.append($clone);
            }
        });
    };

});