<?php
require_once '../src/config/config.php';

$pageTitle = '행사소개';
$pageDescription = 'EPM CONGRESS 2025 행사 소개 - 제14회 엔지니어링 프로젝트 매니지먼트 콩그레스';
$bodyClass = 'about-page';
$additionalCSS = ['about.css'];

require_once '../src/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title mb-3">행사소개</h1>
                <p class="page-subtitle lead">EPM CONGRESS 2025에 대해 알아보세요</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item"><a href="<?php echo url(); ?>" class="text-white-50">홈</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">행사소개</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- About EPM Congress -->
<section class="about-congress py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-lg-6">
                <h2 class="section-title">EPM CONGRESS 2025</h2>
                <h3 class="text-primary mb-4">Megaproject: Above and Beyond</h3>
                <p class="lead mb-4">
                    제14회 엔지니어링 프로젝트 매니지먼트 콩그레스는 메가프로젝트의 새로운 지평을 
                    탐구하는 국내 최대 규모의 프로젝트 관리 학술 행사입니다.
                </p>
                <p class="mb-4">
                    "Megaproject: Above and Beyond"라는 주제 하에, 국내외 최고의 전문가들이 
                    한자리에 모여 메가프로젝트의 성공 사례를 공유하고, 미래 엔지니어링 프로젝트 
                    매니지먼트의 방향을 제시합니다.
                </p>
                <div class="key-features">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="feature-item mb-3">
                                <i class="fas fa-users text-primary me-3"></i>
                                <span><strong>300+</strong> 전문가 참여</span>
                            </div>
                            <div class="feature-item mb-3">
                                <i class="fas fa-globe text-primary me-3"></i>
                                <span><strong>국제적</strong> 네트워킹</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="feature-item mb-3">
                                <i class="fas fa-lightbulb text-primary me-3"></i>
                                <span><strong>최신</strong> 트렌드 공유</span>
                            </div>
                            <div class="feature-item mb-3">
                                <i class="fas fa-certificate text-primary me-3"></i>
                                <span><strong>CPD</strong> 학점 인정</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?php echo asset('images/about-congress.jpg'); ?>" alt="EPM Congress" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Event Overview -->
<section class="event-overview py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">행사 개요</h2>
                <p class="section-subtitle">EPM CONGRESS 2025의 주요 정보를 확인하세요</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="info-card h-100">
                    <div class="info-header">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <h4>서울 행사</h4>
                    </div>
                    <div class="info-content">
                        <div class="info-item">
                            <strong>일시:</strong> 2025년 6월 13일(금) 09:00~18:00
                        </div>
                        <div class="info-item">
                            <strong>장소:</strong> 서울대학교 39동 대강당 외
                        </div>
                        <div class="info-item">
                            <strong>주소:</strong> 서울특별시 관악구 관악로 1
                        </div>
                        <div class="info-item">
                            <strong>참가 형태:</strong> 대면 + 온라인 하이브리드
                        </div>
                        <div class="info-item">
                            <strong>예상 참가자:</strong> 대면 200명, 온라인 200명
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="info-card h-100">
                    <div class="info-header">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <h4>세종 행사</h4>
                    </div>
                    <div class="info-content">
                        <div class="info-item">
                            <strong>일시:</strong> 2025년 6월 17일(화) 13:00~17:30
                        </div>
                        <div class="info-item">
                            <strong>장소:</strong> 세종공동캐퍼스 8동 대강당
                        </div>
                        <div class="info-item">
                            <strong>주소:</strong> 세종특별자치시 연기면 세종로 2511
                        </div>
                        <div class="info-item">
                            <strong>참가 형태:</strong> 대면 + 온라인 하이브리드
                        </div>
                        <div class="info-item">
                            <strong>예상 참가자:</strong> 대면 100명, 온라인 100명
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Organizers & Sponsors -->
<section class="organizers py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">주최 및 후원</h2>
                <p class="section-subtitle">EPM CONGRESS 2025를 함께하는 기관들</p>
            </div>
        </div>
        
        <div class="row mb-5">
            <div class="col-lg-6 mb-4">
                <div class="organizer-card">
                    <h4 class="organizer-title">
                        <i class="fas fa-university text-primary me-2"></i>주최
                    </h4>
                    <ul class="organizer-list">
                        <li>서울대학교 공과대학 EPM</li>
                        <li>공학전문대학원</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="organizer-card">
                    <h4 class="organizer-title">
                        <i class="fas fa-handshake text-primary me-2"></i>후원
                    </h4>
                    <ul class="organizer-list">
                        <li>산업통상자원부</li>
                        <li>한국산업기술진흥원</li>
                        <li>HKCMC</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Key Themes -->
<section class="key-themes py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">주요 테마</h2>
                <p class="section-subtitle">EPM CONGRESS 2025에서 다룰 핵심 주제들</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="theme-card h-100">
                    <div class="theme-icon">
                        <i class="fas fa-city"></i>
                    </div>
                    <h5 class="theme-title">메가프로젝트 관리</h5>
                    <p class="theme-description">
                        대규모 복합 프로젝트의 효과적인 관리 방법론과 성공 사례
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="theme-card h-100">
                    <div class="theme-icon">
                        <i class="fas fa-robot"></i>
                    </div>
                    <h5 class="theme-title">AI & 자동화</h5>
                    <p class="theme-description">
                        인공지능과 자동화 기술을 활용한 프로젝트 관리 혁신
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="theme-card h-100">
                    <div class="theme-icon">
                        <i class="fas fa-globe-americas"></i>
                    </div>
                    <h5 class="theme-title">국제 협력</h5>
                    <p class="theme-description">
                        글로벌 프로젝트에서의 국제 협력과 문화적 다양성 관리
                    </p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="theme-card h-100">
                    <div class="theme-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h5 class="theme-title">지속가능성</h5>
                    <p class="theme-description">
                        환경친화적이고 지속가능한 프로젝트 관리 접근법
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Target Audience -->
<section class="target-audience py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">참가 대상</h2>
                <p class="section-subtitle">EPM CONGRESS 2025는 다양한 분야의 전문가들을 위한 행사입니다</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-hard-hat"></i>
                    </div>
                    <h5>엔지니어링 전문가</h5>
                    <p>건설, 플랜트, 인프라 분야의 엔지니어 및 프로젝트 매니저</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h5>학계 관계자</h5>
                    <p>대학 교수, 연구원, 대학원생 등 학술 연구자</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h5>기업 관계자</h5>
                    <p>기업의 프로젝트 관리자, 임원진, 비즈니스 개발 담당자</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-landmark"></i>
                    </div>
                    <h5>공공기관</h5>
                    <p>정부 부처, 공기업, 공공기관의 정책 담당자 및 관리자</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h5>컸설턴트</h5>
                    <p>프로젝트 관리 컸설턴트, PMO 전문가, 비즈니스 컸설턴트</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="audience-card">
                    <div class="audience-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h5>기타 관심자</h5>
                    <p>프로젝트 관리에 관심 있는 모든 분야의 전문가</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits -->
<section class="benefits py-5 bg-primary text-white">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">참가 혜택</h2>
                <p class="section-subtitle">EPM CONGRESS 2025 참가로 얻을 수 있는 특별한 혜택들</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-item text-center">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h5>참가 인증서</h5>
                    <p>공식 참가 인증서 및 CPD 학점 인정</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-item text-center">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h5>네트워킹</h5>
                    <p>국내외 전문가들과의 네트워킹 기회</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-item text-center">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-download"></i>
                    </div>
                    <h5>발표 자료</h5>
                    <p>모든 세션의 발표 자료 무료 제공</p>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="benefit-item text-center">
                    <div class="benefit-icon mb-3">
                        <i class="fas fa-video"></i>
                    </div>
                    <h5>녹화 영상</h5>
                    <p>주요 세션 녹화 영상 시청 기회</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta py-5">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title">지금 참가 신청하세요!</h2>
                <p class="cta-subtitle mb-4">
                    EPM CONGRESS 2025에서 메가프로젝트의 미래를 함께 만들어가세요. 
                    전문가들과의 네트워킹과 최신 트렌드를 경험할 수 있는 절호의 기회입니다.
                </p>
                <div class="cta-actions">
                    <a href="<?php echo url('registration.php'); ?>" class="btn btn-primary btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i>참가 신청
                    </a>
                    <a href="<?php echo url('program.php'); ?>" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-calendar-check me-2"></i>프로그램 보기
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '../src/includes/footer.php'; ?>
