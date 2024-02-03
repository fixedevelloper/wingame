
<!--Login Modal Start-->
<div class="modal register__modal" id="signin" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <div class="modal__left">
                                <img src="{{asset('images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg')}}" alt="modal">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal__right">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade  show active " id="home2" role="tabpanel">
                                        <div class="form__tabs__wrap">
                                            <div class="focus__icon">
                                                <p>
                                                    Login via social media accounts
                                                </p>
                                                <div class="social__head">
                                                    <ul class="social">
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fa-brands fa-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fab fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fa-brands fa-linkedin-in"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <form action="{{route('login')}}" method="POST">
                                                @csrf
                                                <div class="form__grp">
                                                    <label for="emailsign">Email</label>
                                                    <input type="email" name="email" id="emailsign" placeholder="Email Your">
                                                </div>
                                                <div class="form__grp">
                                                    <label for="toggle-password3">Password</label>
                                                    <input name="password" id="toggle-password3" type="password" placeholder="Your Password">
                                                    <span id="#toggle-password3" class="fa fa-fw fa-eye field-icon toggle-password3"></span>
                                                </div>
                                                <div class="login__signup">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="remem">
                                                        <label class="form-check-label" for="remem">
                                                            Remember me
                                                        </label>
                                                    </div>
                                                    <a href="#0">
                                                        Forgot Password
                                                    </a>
                                                </div>
                                                <div class="create__btn">
                                                    <button type="submit" class="cmn--btn">
                                                        <span>Login</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Login Modal End-->

<div class="modal register__modal" id="signup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row align-items-center g-4">
                        <div class="col-lg-6">
                            <div class="modal__left">
                                <img src="{{asset('images/ballon-football-enveloppe-flammes-bleues-fumee-noire.jpg')}}" alt="modal">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal__right">
                                <div class="tab-content" id="myTabContent2">
                                    <div class="tab-pane fade show active" id="contact2" role="tabpanel">
                                        <div class="form__tabs__wrap">
                                            <div class="focus__icon">
                                                <p>
                                                    registration via social media accounts
                                                </p>
                                                <div class="social__head">
                                                    <ul class="social">
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fa-brands fa-facebook-f"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fab fa-twitter"></i>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#0">
                                                                <i class="fa-brands fa-linkedin-in"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <form action="#" method="POST">
                                                @csrf
                                                <div class="form__grp">
                                                    <label for="email34">Email</label>
                                                    <input type="email" name="email" id="email34" placeholder="Email Your">
                                                </div>
                                                <div class="form__grp">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" id="name" placeholder="Your name">
                                                </div>
                                                <div class="form__grp">
                                                    <label for="toggle-password10">Password</label>
                                                    <input id="toggle-password10" name="password" type="password" placeholder="Your Password">
                                                    <span id="#toggle-password10" class="fa fa-fw fa-eye field-icon toggle-password10"></span>
                                                </div>
                                                <div class="form__grp">
                                                    <label for="toggle-password9">Confrim</label>
                                                    <input id="toggle-password9" type="password" placeholder="Password">
                                                    <span id="#toggle-password9" class="fa fa-fw fa-eye field-icon toggle-password9"></span>
                                                </div>
                                                <div class="create__btn">
                                                    <button type="submit" class="cmn--btn">
                                                        <span>Register</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
