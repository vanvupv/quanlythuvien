@include('share.header')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Register Card -->
            <div class="card p-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-5">
                    <a href="javascript:void(0)" class="app-brand-link gap-2">
                        <span class="app-brand-logo demo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100">
                              <path fill="#9c27b0" d="M16 3H6c-1.1 0-1.99.9-1.99 2L4 19c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 14H6V7h6v10zm-2-5h2v2h-2v-2z"/>
                            </svg>
                        </span>
                        <span class="app-brand-text demo text-heading fw-semibold">Quản Lý Thư Viện</span>
                    </a>
                </div>
                <!-- /Logo -->
                <div class="card-body mt-2">
                    <h4 class="mb-4">Đăng Ký Tài Khoản</h4>
                    @include('share.error')
                    <form id="formSignup" class="mb-3" action="{{route('signup.store')}}" method="POST">
                        <div class="form-validate form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username"
                                   autofocus />
                            <label for="username">Username</label>
                        </div>
                        <div class="form-validate form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                            <label for="email">Email</label>
                        </div>
                        <div class="form-validate mb-3 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="password" class="form-control" name="password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password" />
                                    <label for="password">Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                        <div class="form-validate mb-3 form-password-toggle">
                            <div class="input-group input-group-merge">
                                <div class="form-floating form-floating-outline">
                                    <input type="password" id="re-password" class="form-control" name="re-password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password" />
                                    <label for="re-password"> Re-Password</label>
                                </div>
                                <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                            </div>
                        </div>
                        <!-- -->
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                        @csrf
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{route('login')}}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>
@include('share.footer')
