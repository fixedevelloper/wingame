<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Lotto foot- @yield('title') </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Sites meta Data -->
    <meta name="application-name"
          content="Lotto foot - Crypto, BitCoin, Etheruim">
    <meta name="author" content="Propulse4U">
    <meta name="keywords" content="Propulse4U- Propulse4U, Propulse4U, Propulse4U">
    <meta name="description"
          content="">

    <!-- OG meta data -->
    <meta property="og:title"
          content="">
    <meta property="og:site_name" content=Propulse4U>
    <meta property="og:url" content="https://Propulse4U.com/">
    <meta property="og:description"
          content="Welcome to Infinix,">
    <meta property="og:type" content="website">
    <meta property="og:image" content="assets/images/og.png">

    <link rel="shortcut icon" href="{{asset('images/preview.svg')}}" type="image/x-icon">


    <!--Bootstrap Min Css-->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!--Macnific Popup Css-->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <!--Owl Carousel min Css-->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <!--Owl theme Default Css-->
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.css')}}">
    <!--nice select Css-->
    <link rel="stylesheet" href="{{asset('css/nice-select.css')}}">
    <!--Glyphter Css-->
    <link rel="stylesheet" href="{{asset('glyphter-font/css/Glyphter.css')}}">
    <!--animation Css-->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!--Fontawsome all min Css-->
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <!--Main custom Css-->
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <!-- main css for template -->
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link href="{{asset('css/checkbutton.scss')}}">
    <link rel="stylesheet" href="{{asset('toast/toastr.css')}}" data-n-g="">
</head>

<body>
<div class="main-wrapper">
@include('_partials._header')
    @yield('sub_header')
        <div class="page-content">
@yield('content')
        </div>

    </div>
@include('_partials._modal')


<!-- vendor plugins -->
@stack('scripts')

<script src="{{asset('js/jquery-3.7.min.js')}}"></script>
<script src="{{asset("toast/toastr.min.js")}}"></script>
<!--Bootstrap bundle min js-->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<!--Magnific Popup js-->
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<!--Owl Carousel min js-->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!--nice select min js-->
<script src="{{asset('js/jquery.nice-select.min.js')}}"></script>
<!--Wow min js-->
<script src="{{asset('js/wow.min.js')}}"></script>
<!--jquery ui min-->
<script src="{{asset('js/jquery-ui.min.js')}}"></script>


<!--Main js-->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('lottoJs/lotterie.js') }}"></script>
<script>
    var configs={
        routes:{
            index: "{{\Illuminate\Support\Facades\URL::to('/')}}",
            home: "{{\Illuminate\Support\Facades\URL::route('home')}}",
            register_ajax: "{{\Illuminate\Support\Facades\URL::route('register_ajax')}}",
            postgame_ajax: "{{\Illuminate\Support\Facades\URL::route('postGame')}}",
            login_next: "{{\Illuminate\Support\Facades\URL::route('login_next')}}",
            check_register: "{{\Illuminate\Support\Facades\URL::route('check_register')}}",
            set_balance: "{{\Illuminate\Support\Facades\URL::route('get_balance')}}",
        }
    }
    $(function () {

        $('#grille_date').change(function () {
            $('#form_grille').submit()
        })
        $('#stat_filter').change(function () {
            $('#form_stat').submit()
        })
        $('#position').change(function () {
            $('#form_position').submit()
        })
        $('#date_ontheday').change(function () {
            $('#save_input').val(0)
            $('#form_ontheday').submit()
        })
        $('#login_id').click(function () {

        })
    });
    (function($) {

        $.fn.niceSelect = function(method) {

            // Methods
            if (typeof method == 'string') {
                if (method == 'update') {
                    this.each(function() {
                        var $select = $(this);
                        var $dropdown = $(this).next('.nice-select');
                        var open = $dropdown.hasClass('open');

                        if ($dropdown.length) {
                            $dropdown.remove();
                            create_nice_select($select);

                            if (open) {
                                $select.next().trigger('click');
                            }
                        }
                    });
                } else if (method == 'destroy') {
                    this.each(function() {
                        var $select = $(this);
                        var $dropdown = $(this).next('.nice-select');

                        if ($dropdown.length) {
                            $dropdown.remove();
                            $select.css('display', '');
                        }
                    });
                    if ($('.nice-select').length == 0) {
                        $(document).off('.nice_select');
                    }
                } else {
                    console.log('Method "' + method + '" does not exist.')
                }
                return this;
            }

            // Hide native select
            this.hide();

            // Create custom markup
            this.each(function() {
                var $select = $(this);

                if (!$select.next().hasClass('nice-select')) {
                    create_nice_select($select);
                }
            });

            function create_nice_select($select) {
                $select.after($('<div></div>')
                    .addClass('nice-select')
                    .addClass($select.attr('class') || '')
                    .addClass($select.attr('disabled') ? 'disabled' : '')
                    .addClass($select.attr('multiple') ? 'has-multiple' : '')
                    .attr('tabindex', $select.attr('disabled') ? null : '0')
                    .html($select.attr('multiple') ? '<span class="multiple-options"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="Поиск..."/></div><ul class="list"></ul>' : '<span class="current"></span><div class="nice-select-search-box"><input type="text" class="nice-select-search" placeholder="Поиск..."/></div><ul class="list"></ul>')
                );

                var $dropdown = $select.next();
                var $options = $select.find('option');
                if ($select.attr('multiple')) {
                    var $selected = $select.find('option:selected');
                    var $selected_html = '';
                    $selected.each(function() {
                        $selected_option = $(this);
                        $selected_text = $selected_option.data('display') ||  $selected_option.text();

                        if (!$selected_option.val()) {
                            return;
                        }

                        $selected_html += '<span class="current">' + $selected_text + '</span>';
                    });
                    $select_placeholder = $select.data('js-placeholder') || $select.attr('js-placeholder');
                    $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
                    $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
                    $dropdown.find('.multiple-options').html($selected_html);
                } else {
                    var $selected = $select.find('option:selected');
                    $dropdown.find('.current').html($selected.data('display') ||  $selected.text());
                }


                $options.each(function(i) {
                    var $option = $(this);
                    var display = $option.data('display');

                    $dropdown.find('ul').append($('<li></li>')
                        .attr('data-value', $option.val())
                        .attr('data-display', (display || null))
                        .addClass('option' +
                            ($option.is(':selected') ? ' selected' : '') +
                            ($option.is(':disabled') ? ' disabled' : ''))
                        .html($option.text())
                    );
                });
            }

            /* Event listeners */

            // Unbind existing events in case that the plugin has been initialized before
            $(document).off('.nice_select');

            // Open/close
            $(document).on('click.nice_select', '.nice-select', function(event) {
                var $dropdown = $(this);

                $('.nice-select').not($dropdown).removeClass('open');
                $dropdown.toggleClass('open');

                if ($dropdown.hasClass('open')) {
                    $dropdown.find('.option');
                    $dropdown.find('.nice-select-search').val('');
                    $dropdown.find('.nice-select-search').focus();
                    $dropdown.find('.focus').removeClass('focus');
                    $dropdown.find('.selected').addClass('focus');
                    $dropdown.find('ul li').show();
                } else {
                    $dropdown.focus();
                }
            });

            $(document).on('click', '.nice-select-search-box', function(event) {
                event.stopPropagation();
                return false;
            });
            $(document).on('keyup.nice-select-search', '.nice-select', function() {
                var $self = $(this);
                var $text = $self.find('.nice-select-search').val();
                var $options = $self.find('ul li');
                if ($text == '')
                    $options.show();
                else if ($self.hasClass('open')) {
                    $text = $text.toLowerCase();
                    var $matchReg = new RegExp($text);
                    if (0 < $options.length) {
                        $options.each(function() {
                            var $this = $(this);
                            var $optionText = $this.text().toLowerCase();
                            var $matchCheck = $matchReg.test($optionText);
                            $matchCheck ? $this.show() : $this.hide();
                        })
                    } else {
                        $options.show();
                    }
                }
                $self.find('.option'),
                    $self.find('.focus').removeClass('focus'),
                    $self.find('.selected').addClass('focus');
            });

            // Close when clicking outside
            $(document).on('click.nice_select', function(event) {
                if ($(event.target).closest('.nice-select').length === 0) {
                    $('.nice-select').removeClass('open').find('.option');
                }
            });

            // Option click
            $(document).on('click.nice_select', '.nice-select .option:not(.disabled)', function(event) {

                var $option = $(this);
                var $dropdown = $option.closest('.nice-select');
                if ($dropdown.hasClass('has-multiple')) {
                    if ($option.hasClass('selected')) {
                        $option.removeClass('selected');
                    } else {
                        $option.addClass('selected');
                    }
                    $selected_html = '';
                    $selected_values = [];
                    $dropdown.find('.selected').each(function() {
                        $selected_option = $(this);
                        var attrValue = $selected_option.data('value');
                        var text = $selected_option.data('display') ||  $selected_option.text();
                        $selected_html += (`<span class="current" data-id=${attrValue}> ${text} <span class="remove">X</span></span>`);
                        $selected_values.push($selected_option.data('value'));
                    });
                    $select_placeholder = $dropdown.prev('select').data('js-placeholder') ||                                   $dropdown.prev('select').attr('js-placeholder');
                    $select_placeholder = !$select_placeholder ? 'Select' : $select_placeholder;
                    $selected_html = $selected_html === '' ? $select_placeholder : $selected_html;
                    $dropdown.find('.multiple-options').html($selected_html);
                    $dropdown.prev('select').val($selected_values).trigger('change');
                } else {
                    $dropdown.find('.selected').removeClass('selected');
                    $option.addClass('selected');
                    var text = $option.data('display') || $option.text();
                    $dropdown.find('.current').text(text);
                    $dropdown.prev('select').val($option.data('value')).trigger('change');
                }
                console.log($('.mySelect').val())
            });
            //---------remove item
            $(document).on('click','.remove', function(){
                var $dropdown = $(this).parents('.nice-select');
                var clickedId = $(this).parent().data('id')
                $dropdown.find('.list li').each(function(index,item){
                    if(clickedId == $(item).attr('data-value')) {
                        $(item).removeClass('selected')
                    }
                })
                $selected_values.forEach(function(item, index, object) {
                    if (item === clickedId) {
                        object.splice(index, 1);
                    }
                });
                $(this).parent().remove();
                console.log($('.mySelect').val())
            })

            // Keyboard events
            $(document).on('keydown.nice_select', '.nice-select', function(event) {
                var $dropdown = $(this);
                var $focused_option = $($dropdown.find('.focus') || $dropdown.find('.list .option.selected'));

                // Space or Enter
                if (event.keyCode == 32 || event.keyCode == 13) {
                    if ($dropdown.hasClass('open')) {
                        $focused_option.trigger('click');
                    } else {
                        $dropdown.trigger('click');
                    }
                    return false;
                    // Down
                } else if (event.keyCode == 40) {
                    if (!$dropdown.hasClass('open')) {
                        $dropdown.trigger('click');
                    } else {
                        var $next = $focused_option.nextAll('.option:not(.disabled)').first();
                        if ($next.length > 0) {
                            $dropdown.find('.focus').removeClass('focus');
                            $next.addClass('focus');
                        }
                    }
                    return false;
                    // Up
                } else if (event.keyCode == 38) {
                    if (!$dropdown.hasClass('open')) {
                        $dropdown.trigger('click');
                    } else {
                        var $prev = $focused_option.prevAll('.option:not(.disabled)').first();
                        if ($prev.length > 0) {
                            $dropdown.find('.focus').removeClass('focus');
                            $prev.addClass('focus');
                        }
                    }
                    return false;
                    // Esc
                } else if (event.keyCode == 27) {
                    if ($dropdown.hasClass('open')) {
                        $dropdown.trigger('click');
                    }
                    // Tab
                } else if (event.keyCode == 9) {
                    if ($dropdown.hasClass('open')) {
                        return false;
                    }
                }
            });

            // Detect CSS pointer-events support, for IE <= 10. From Modernizr.
            var style = document.createElement('a').style;
            style.cssText = 'pointer-events:auto';
            if (style.pointerEvents !== 'auto') {
                $('html').addClass('no-csspointerevents');
            }

            return this;

        };

    }(jQuery));


</script>
@stack('script')
</body>

</html>
