<?php include_once "layout/header.php"; ?>

<header class="bg-dark py-5 ">
    <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
                <div class="my-5 text-center text-xl-start">
                    <h1 class="display-5 fw-bolder text-white mb-2">Power Monitoring System</h1>
                    <p class="lead fw-normal text-white-50 mb-4">Monitoring penggunaan daya listrik secara digital menawarkan pembacaan daya secara real-time dimanapun pengguna berada </p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="dashboard.php">Mulai Dapatkan</a>
                        <a class="btn btn-outline-light btn-lg px-4" href="#penjelasan">Penjelasan</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="./assets/img/home2.jpg" alt="home1" /></div>
        </div>
    </div>
</header>

<section id="penjelasan" class="py-3 py-md-5">
<div class="container">
    <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
    <div class="col-12 col-lg-6 col-xl-5">
        <img class="img-fluid rounded" loading="lazy" src="./assets/img/about1.jpg" alt="About">
    </div>
    <div class="col-12 col-lg-6 col-xl-7">
        <div class="row justify-content-xl-center">
        <div class="col-12 col-xl-11">
            <h2 class="mb-3">Power Monitoring System</h2>
            <p class="lead fs-4 text-secondary mb-3">Merupakan perangkat monitoring penggunaan daya yang terintegrasi database dan web server dengan berbasis mikrokontroller</p>
            <p class="mb-5">Power monitoring system menawarkan pembacaan daya secara real-time dimanapun pengguna berada dengan desain hardware yang compact memudahkan pengguna dalam instalasi </p>
            <div class="row gy-4 gy-md-0 gx-xxl-5X">
            <div class="col-12 col-md-6">
                <div class="d-flex">
                <div class="me-4 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                    <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z" />
                    </svg>
                </div>
                <div>
                    <h2 class="h4 mb-3">Real-Time</h2>
                    <p class="text-secondary mb-0">Memberikan informasi penggunaan daya secara real-time</p>
                </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="d-flex">
                <div class="me-4 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                    <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                    </svg>
                </div>
                <div>
                    <h2 class="h4 mb-3">Ease of Use</h2>
                    <p class="text-secondary mb-0">Kemudahan dalam mengoperasikan perangkat, baik melalui mobile maupun antarmuka web</p>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
</section>

<?php include_once "layout/footer.php"; ?>