<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Rodrigue mbah">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="./images/favicon.png">
    <!-- Page Title  -->
    <title>Over Score </title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{!! asset('over/css/dashlite.min.css') !!}?ver=3.2.3">
    <link id="skin-default" rel="stylesheet" href="{!! asset('over/css/theme.css') !!}?ver=3.2.3">
</head>

<body class="nk-body npc-invest bg-lighter ">
<div class="nk-app-root">
    <!-- wrap @s -->
    <div class="nk-wrap ">
        <!-- main header @s -->
       @include('over._partials._head')
        <!-- main header @e -->
        <!-- content @s -->
        <div class="nk-content nk-content-fluid">
            <div class="container-xl wide-xl">
                <div class="nk-content-inner">
                    <div class="nk-content-body">
                       @yield("content")
                    </div>
                </div>
            </div>
        </div>
        <!-- content @e -->
        <!-- footer @s -->
        <div class="nk-footer nk-footer-fluid bg-lighter">
            <div class="container-xl">
                <div class="nk-footer-wrap">
                    <div class="nk-footer-copyright"> &copy; 2024 Agensic
                    </div>
                    <div class="nk-footer-links">
                        <ul class="nav nav-sm">
                            <li class="nav-item dropup">
                                <a href="#" class="dropdown-toggle dropdown-indicator has-indicator nav-link text-base" data-bs-toggle="dropdown" data-offset="0,10"><span>English</span></a>
                                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                    <ul class="language-list">
                                        <li>
                                            <a href="#" class="language-item">
                                                <span class="language-name">English</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#" class="language-item">
                                                <span class="language-name">Français</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-bs-toggle="modal" href="#region" class="nav-link"><em class="icon ni ni-globe"></em><span class="ms-1">Select Region</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer @e -->
    </div>
    <!-- wrap @e -->
</div>
<!-- app-root @e -->
<!-- select region modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="region">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
            <div class="modal-body modal-body-md">
                <h5 class="title mb-4">Select Your Country</h5>
                <div class="nk-country-region">
                    <ul class="country-list text-center gy-2">
                        <li>
                            <a href="#" class="country-item">
                                <img src="./images/flags/arg.png" alt="" class="country-flag">
                                <span class="country-name">Cameroun</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="./images/flags/arg.png" alt="" class="country-flag">
                                <span class="country-name">Congo</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="country-item">
                                <img src="./images/flags/arg.png" alt="" class="country-flag">
                                <span class="country-name">RD Congo</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div><!-- .modal-content -->
    </div><!-- .modla-dialog -->
</div><!-- .modal -->
<!-- JavaScript -->
<script src="{!! asset("over/js/bundle.js") !!}?ver=3.2.3"></script>
<script src="{!! asset("over/js/scripts.js") !!}?ver=3.2.3"></script>
<script>
    $('#grille_date').change(function () {
        $('#form_grille').submit()
    })
</script>
</body>

</html>
