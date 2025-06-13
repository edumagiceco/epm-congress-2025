<?php
// Explicitly set UTF-8 encoding
header('Content-Type: text/html; charset=UTF-8');
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : '제14회 엔지니어링 프로젝트 매니지먼트 콩그레스 2025 - Megaproject: Above and Beyond'; ?>">
    <meta name="keywords" content="EPM, 엔지니어링, 프로젝트매니지먼트, 메가프로젝트, 서울대학교, 콩그레스">
    <meta name="author" content="EPM CONGRESS 2025">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo asset('images/favicon.ico'); ?>">
    <link rel="apple-touch-icon" href="<?php echo asset('images/apple-touch-icon.png'); ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : '제14회 엔지니어링 프로젝트 매니지먼트 콩그레스 2025'; ?>">
    <meta property="og:image" content="<?php echo asset('images/og-image.jpg'); ?>">
    <meta property="og:url" content="<?php echo APP_URL . $_SERVER['REQUEST_URI']; ?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?php echo APP_NAME; ?>">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo isset($pageTitle) ? $pageTitle . ' - ' . APP_NAME : APP_NAME; ?>">
    <meta name="twitter:description" content="<?php echo isset($pageDescription) ? $pageDescription : '제14회 엔지니어링 프로젝트 매니지먼트 콩그레스 2025'; ?>">
    <meta name="twitter:image" content="<?php echo asset('images/og-image.jpg'); ?>">
    
    <!-- CSS Libraries -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="<?php echo asset('css/style.css'); ?>" rel="stylesheet">
    <?php if (isset($additionalCSS)): ?>
        <?php foreach ($additionalCSS as $css): ?>
            <link href="<?php echo asset('css/' . $css); ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo generateCSRFToken(); ?>">
    
    <?php if (GOOGLE_ANALYTICS_ID): ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo GOOGLE_ANALYTICS_ID; ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo GOOGLE_ANALYTICS_ID; ?>');
    </script>
    <?php endif; ?>
</head>
<body class="<?php echo isset($bodyClass) ? $bodyClass : ''; ?>">
    
    <!-- Skip to content -->
    <a href="#main-content" class="skip-link">메인 콘텐츠로 건너뛰기</a>
    
    <!-- Header -->
    <header class="header" id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="<?php echo url(); ?>">
                    <img src="<?php echo asset('images/logo.png'); ?>" alt="<?php echo APP_NAME; ?>" class="logo">
                    <span class="brand-text d-none d-md-inline">EPM CONGRESS 2025</span>
                </a>
                
                <!-- Mobile menu button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="메뉴 열기/닫기">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Navigation -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>" href="<?php echo url(); ?>">홈</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>" href="<?php echo url('about.php'); ?>">행사소개</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle <?php echo in_array(basename($_SERVER['PHP_SELF']), ['program.php', 'seoul.php', 'sejong.php']) ? 'active' : ''; ?>" href="#" id="programDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                프로그램
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="programDropdown">
                                <li><a class="dropdown-item" href="<?php echo url('program.php'); ?>">전체 프로그램</a></li>
                                <li><a class="dropdown-item" href="<?php echo url('seoul.php'); ?>">서울 행사</a></li>
                                <li><a class="dropdown-item" href="<?php echo url('sejong.php'); ?>">세종 행사</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'speakers.php' ? 'active' : ''; ?>" href="<?php echo url('speakers.php'); ?>">연사진</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'guide.php' ? 'active' : ''; ?>" href="<?php echo url('guide.php'); ?>">참가안내</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : ''; ?>" href="<?php echo url('news.php'); ?>">공지사항</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>" href="<?php echo url('contact.php'); ?>">연락처</a>
                        </li>
                    </ul>
                    
                    <!-- CTA Button -->
                    <div class="d-flex">
                        <a href="<?php echo url('registration.php'); ?>" class="btn btn-primary btn-register">
                            <i class="fas fa-user-plus me-2"></i>참가신청
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    
    <!-- Main Content -->
    <main id="main-content" class="main-content">
