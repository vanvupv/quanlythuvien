<!-- Side Bar -->
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{route('admin.main')}}" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
              <span class="app-brand-logo demo">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="100" height="100">
                              <path fill="#9c27b0" d="M16 3H6c-1.1 0-1.99.9-1.99 2L4 19c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-4 14H6V7h6v10zm-2-5h2v2h-2v-2z"/>
                            </svg>
                        </span>
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Quản Lý Thư Viện</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Đầu Sách -->
        <li class="menu-item active">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-home-outline"></i>
                <div data-i18n="Dashboards">Quản Lý Đầu Sách</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="{{route('dausach')}}"
                      class="menu-link">
                        <div data-i18n="CRM">Danh sách Đầu Sách</div>
                        <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('dausach.add')}}" class="menu-link">
                        <div data-i18n="Analytics">Thêm Đầu Sách</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Đầu Sách -->

        <!-- Thể Loại -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-window-maximize"></i>
                <div data-i18n="Layouts">Thể Loại</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('theloai')}}" class="menu-link">
                        <div data-i18n="Without menu">Thể Loại</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('theloai.add')}}" class="menu-link">
                        <div data-i18n="Without navbar">Thêm Thể Loại</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                        <div data-i18n="Container">Xóa Thể Loại</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Thể Loại -->

        <!-- Tác Giả -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-flip-to-front"></i>
                <div data-i18n="Front Pages">Tác Giả</div>
                <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('tacgia')}}"
                       class="menu-link">
                        <div data-i18n="Landing">Tác Giả</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('tacgia.add')}}"
                       class="menu-link">
                        <div data-i18n="Pricing">Thêm Tác Giả</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);"
                       class="menu-link">
                        <div data-i18n="Payment">Xóa Tác Giả</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Tác Giả -->

        <!-- Nhà Xuất Bản -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Front Pages">Nhà Xuất Bản</div>
                <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('nhaxuatban')}}"
                       class="menu-link">
                        <div data-i18n="Landing">Nhà Xuất Bản</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('nhaxuatban.add')}}"
                       class="menu-link" >
                        <div data-i18n="Pricing">Thêm Nhà Xuất Bản</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);"
                       class="menu-link">
                        <div data-i18n="Payment">Xóa Nhà Xuất Bản</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Nhà Xuất Bản -->
        <!-- Nhà Xuất Bản -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-geo-alt"></i>
                <div data-i18n="Front Pages">Vị trí</div>
                <div class="badge bg-label-primary fs-tiny rounded-pill ms-auto"></div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('vitri')}}"
                       class="menu-link" >
                        <div data-i18n="Landing">Danh sách Vị trí</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('vitri.add')}}"
                       class="menu-link" >
                        <div data-i18n="Pricing">Thêm Vị trí</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);"
                       class="menu-link">
                        <div data-i18n="Payment">Xóa Vị trí</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Vị trí -->

        <!-- Quản Lý Độc Giả -->
        <li class="menu-header fw-medium mt-4">
            <span class="menu-header-text"> Quản Lý Độc Giả </span>
        </li>
        <!-- Độc Giả -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-account-outline"></i>
                <div data-i18n="Account Settings">Quản Lý Độc Giả</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('docgia')}}" class="menu-link">
                        <div data-i18n="Account">Danh sách Độc Giả</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('docgia.add')}}" class="menu-link">
                        <div data-i18n="Notifications">Thêm Độc Giả</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                        <div data-i18n="Connections">Xóa Độc Giả</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Độc Giả -->
        <!-- / Quản Lý Độc Giả -->

        <!-- Phiếu -->
        <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Quản Lý Phiếu</span></li>
        <!-- Phiếu Mượn -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-archive-outline"></i>
                <div data-i18n="User interface">Phiếu Mượn</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('phieumuon.create')}}" class="menu-link">
                        <div data-i18n="Accordion">Lập Phiếu Mượn</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('phieumuon.list')}}" class="menu-link">
                        <div data-i18n="Alerts">Danh Sách Phiếu</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Phiếu Mượn -->

        <!-- Phiếu Trả -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-wallet"></i>
                <div data-i18n="Extended UI">Phiếu Trả</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('phieutra')}}" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Lập Phiếu Trả</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('phieutra.list')}}" class="menu-link">
                        <div data-i18n="Text Divider">Danh Sách Phiếu Trả</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Phiếu Trả -->

        <!-- Phiếu Phạt -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-receipt"></i>
                <div data-i18n="Extended UI">Phiếu Phạt</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('phieuphat.list')}}" class="menu-link">
                        <div data-i18n="Text Divider">Danh Sách Phiếu Phạt</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Phiếu Phạt -->

        <!-- Phiếu Phạt -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bi bi-receipt"></i>
                <div data-i18n="Extended UI">Hóa Đơn</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <div data-i18n="Perfect Scrollbar">Danh Sách Hóa Đơn</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Phiếu Phạt -->


        <!-- Quản Lý Phân Quyền -->
        <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Phân Quyền</span></li>
        <!-- Quyền -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons mdi mdi-form-select"></i>
                <div data-i18n="Form Elements">Quản Lý Quyền</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('permission_role')}}" class="menu-link">
                        <div data-i18n="Basic Inputs">Danh Sách Quyền</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('permission_setting')}}" class="menu-link">
                        <div data-i18n="Input groups">Cài Đặt Quyền</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- / Quyền -->

        <!-- Cài Đặt Chung -->
        <li class="menu-header fw-medium mt-4"><span class="menu-header-text">Cài Đặt Chung</span></li>
        <li class="menu-item">
            <a href=""
               target="_blank" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-lifebuoy"></i>
                <div data-i18n="Support">Setting</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="#"
               target="_blank" class="menu-link">
                <i class="menu-icon tf-icons mdi mdi-file-document-multiple-outline"></i>
                <div data-i18n="Documentation">Logout</div>
            </a>
        </li>
        <!-- / Cài Đặt Chung -->
    </ul>
</aside>
<!-- -->




