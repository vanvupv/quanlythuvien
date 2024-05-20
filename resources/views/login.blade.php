@include('share.header')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card p-2">
                <!-- Logo -->
                <div class="app-brand justify-content-center mt-5">
                    <a href="javascript:void(0);" class="app-brand-link gap-2">
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
                    <h4 class="mb-2">Chào mừng bạn đến với Hệ thống quản lý 👋</h4>
                    <p class="mb-4">Vui lòng Đăng nhập để sử dụng</p>
                    <!-- Form Đăng Nhập -->
                    @include('share.error')
                    <form id="loginForm" class="mb-3" method="POST" action="{{route('login.store')}}">
                        <div class="form-validate form-floating form-floating-outline mb-3">
                            <input type="text" class="form-control" id="email" name="username"
                                   placeholder="Enter your Username" autofocus />
                            <label for="email">Username</label>
                        </div>
                        <div class="form-validate mb-3">
                            <div class="form-password-toggle">
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
                        </div>
                        <div class="mb-3 d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" name="remember-me" type="checkbox" id="remember-me" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                            <a href="{{route('forget')}}" class="float-end mb-1">
                                <span>Forgot Password?</span>
                            </a>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        </div>
                        @csrf
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{route('signup')}}">
                            <span>Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
</div>
@include('share.footer')
