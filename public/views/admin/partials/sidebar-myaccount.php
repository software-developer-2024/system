<div class="sidebar h-mobile hidden md:flex md:flex-col bg-brand py-6">
    <!-- sidebar header start -->
    <div class="text-center px-4">
        <a href="/">
            <div class="flex items-center justify-center">
                <div class="relative">
                    <img src="<?= showImage('College_of_Engineering.png') ?>" alt="cpe-logo" class="main-logo">
                    <div class="absolute sub">
                        <img src="<?= showImage('computer_engineering.png') ?>" alt="cpe-logo" class="sub-logo">
                    </div>
                </div>
                <div class="flex justify-center items-center poppins-semibold text-neutral">
                    <h3 class="text-center text-white logo-name">Advising System</h3>
                </div>
            </div>
        </a>
    </div>
    <!-- sidebar header end -->

    <div class="flex flex-col flex-1 justify-between">
        <!-- sidebar navigation -->
        <ul class="sidebar-nav p-0 list-none py-5">
            <li
                class="sidebar-item ms-4 mb-2 <?= uriIs('/myaccount/admin/password') ? '' : ' hover:ms-8 transition-all ease-in' ?>">
                <a href="/myaccount/admin/password"
                    class="sidebar-link block w-full px-4 py-3 rounded-s-lg <?= uriIs('/myaccount/admin/password') ? 'text-constrast bg-neutral' : 'text-neutral hover:bg-contrast transition-all ease-in' ?>"
                    readonly>
                    <i class="icon-faculty"></i>
                    Change Password
                </a>
            </li>
        </ul>
        <!-- sidebar navigation end -->

        <!-- sidebar footer start -->
        <ul class="sidebar-nav p-0 list-none py-5">
            <li
                class="sidebar-item ms-4 <?= uriIs('/myaccount/admin/password') ? '' : ' hover:ms-8 transition-all ease-in' ?>">
                <a href="/myaccount/admin/password"
                    class="sidebar-link block w-full px-4 py-3 rounded-s-lg <?= uriIs('/myaccount/admin/password') ? 'text-neutral bg-contrast' : 'text-neutral' ?>">
                    <i class="icon-user"></i>
                    My Account
                </a>
            </li>
            <li class="sidebar-item ms-4 hover:ms-8 transition-all ease-in">
                <a href="/logout" class="sidebar-link block w-full px-4 py-3 rounded-s-lg text-neutral">
                    <i class="icon-logout"></i>
                    Logout
                </a>
            </li>
        </ul>
        <!-- sidebar footer end -->
    </div>

</div>