<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advising System || Login</title>

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- css -->
    <link rel="stylesheet" href="css/output.css">

</head>

<body class="coe">
    <div class="h-mobile w-dynamic flex flex-col justify-end sm:justify-center sm:items-center bg-gradient-to-b from-brand/60 via-brand/80 to-brand">
        <div class="w-full sm:w-login rounded-lg shadow-2xl">
            <!-- <div
                class="py-4 sm:py-4 rounded-t-lg bg-primary border-b-2 border-brand/50 shadow text-contrast text-center text-2xl fonr-semibold tracking-widest">
                WESTERN MINDANAO STATE UNIVERSITY
            </div> -->
            <div class="pb-3 rounded-lg bg-neutral border-brand/50 shadow flex flex-col relative overflow-hidden">
                <div class="my-3 mt-16 w-full flex justify-center items-center">
                    <div class="flex h-24 w-24">
                        <img src="<?= showImage('college_of_engineering.png') ?>" alt="coe_logo">
                    </div>
                    <div class="flex h-28 w-28">
                        <img src="<?= showImage('Western_Mindanao_State_University.png') ?>" alt="coe_logo">
                    </div>
                    <div class="flex h-24 w-24">
                        <img src="<?= showImage('computer_engineering.png') ?>" alt="coe_logo">
                    </div>
                </div>

                <div class="text-contrast text-2xl font-medium mx-auto tracking-wider mb-3">Advising System</div>

                <form method="post" id="form" class="mx-auto mt-5 text-center">
                    <div class="my-2 mx-auto w-96 mb-2">
                        <div class="relative">
                            <input type="text" id="username" name="username"
                                class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-contrast bg-white rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                                placeholder=" " required/>
                            <label for="username"
                                class="absolute text-sm text-contrast/40 duration-300 transform -translate-y-1 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Username
                            </label>
                        </div>
                    </div>

                    <div class="my-2 mx-auto w-96 mb-2">
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                class="block px-2.5 pb-2.5 pt-5 w-full text-sm text-contrast bg-white rounded-lg border border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-brand peer"
                                placeholder=" " required/>
                            <label for="password"
                                class="absolute text-sm text-contrast/40 duration-300 transform -translate-y-1 scale-75 top-2 z-10 origin-[0] bg-transparent px-2 peer-focus:px-2 peer-focus:text-brand peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-1 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1">
                                Password
                            </label>
                        </div>
                    </div>

                    <button
                        class="mx-auto w-60 mt-5 my-2 py-1 mb-32 sm:mb-16 rounded bg-primary/60 hover:bg-primary/80 text-white text-xl"
                        type="submit">
                        SUBMIT
                    </button>
                </form>

                <div class="absolute w-login p-4 text-sm text-red-800 rounded-b-lg bg-red-50 <?= isset($_SESSION['__flash']['err']) ? 'alert' : 'hidden' ?>"
                    role="alert">
                    <span class="font-medium">Error!</span> <?= $_SESSION['__flash']['err'] ?? '' ?>
                </div>
            </div>

        </div>
    </div>

    <!-- <div class="h-mobile w-dynamic flex justify-end bg-brand overflow-x-hidden">
        <div class="w-foreground relative bg-neutral flex flex-col">
            <div class="login-logo flex h-44 w-44 mx-auto mt-20">
                <img src="img/College_of_Engineering.png" alt="coe_logo">
            </div>
            <div class="text-contrast text-3xl font-medium mx-auto mt-3">Advising System</div>

            <form method="post" id="form" class="mx-auto mt-5">
                <div class="input-group relative mt-3">
                    <input class="border-b-2 border-b-contrast bg-transparent w-64 py-1 px-1 text-lg outline-none focus:border-b-brand transition-all ease-in" type="text" name="username" id="username" autocomplete="off" required>
                    <label class="absolute text-contrast/50 text-lg" for="username">Username</label>
                </div>

                <div class="input-group relative mt-8">
                    <input class="border-b-2 border-b-contrast bg-transparent w-64 py-1 px-1 text-lg outline-none focus:border-b-brand transition-all ease-in" type="password" name="password" id="password" autocomplete="off" required>
                    <label class="absolute text-contrast/50 text-lg" for="password">Password</label>
                </div>

                <button class="mt-8 w-full py-1 rounded bg-brand text-neutral" type="submit">LOGIN</button>
            </form>

            <div class="bg-red-100 py-5 px-6 text-base text-red-700 absolute w-full top-0 <? //isset($_SESSION['__flash']['err'])? 'alert' : 'hidden' ?>"  id="error">
                <? //$_SESSION['__flash']['err'] ?? '' ?>
            </div>
        </div>
    </div> -->

    <script src="js/login.js"></script>
</body>

</html>