@include('share.header')
<div class="position-relative">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Logo -->
            <div class="card p-2">
                <!-- Forgot Password -->
                <div class="app-brand justify-content-center mt-5">
                    <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                 <span class="app-brand-logo demo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100">
                              <path fill="#9c27b0" d="M16 3H6c-1.1 0-1.99.9-1.99 2L4 19c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 14H6V7h6v10zm-2-5h2v2h-2v-2z"/>
                            </svg>
                        </span>
                </span>
                        <span class="app-brand-text demo text-heading fw-semibold">Quản Lý Thư Viện</span>
                    </a>
                </div>
                <!-- /Logo -->
                <div class="card-body mt-2">
                    <h4 class="mb-2">Forgot Password? 🔒</h4>
                    <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
                    <form id="formAuthentication" class="mb-3" action="index.html">
                        <div class="form-floating form-floating-outline mb-3">
                            <input
                                type="text"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="Enter your email"
                                autofocus />
                            <label>Email</label>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Send Reset Link</button>
                    </form>
                    <div class="text-center">
                        <a href="{{route('login')}}" class="d-flex align-items-center justify-content-center">
                            <i class="mdi mdi-chevron-left scaleX-n1-rtl mdi-24px"></i>
                            Back to login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
@include('share.footer')
