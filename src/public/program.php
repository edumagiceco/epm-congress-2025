<?php
require_once '/var/www/src/config/config.php';

$pageTitle = '프로그램';
$pageDescription = 'EPM CONGRESS 2025 전체 프로그램 - 서울과 세종에서 진행되는 모든 세션 정보';
$bodyClass = 'program-page';
$additionalCSS = ['program.css'];
$additionalJS = ['program.js'];

// Get all sessions grouped by location and date
try {
    $db = getDB();
    
    // Get Seoul sessions
    $stmt = $db->prepare("SELECT * FROM sessions WHERE location = 'seoul' ORDER BY start_time ASC");
    $stmt->execute();
    $seoulSessions = $stmt->fetchAll();
    
    // Get Sejong sessions
    $stmt = $db->prepare("SELECT * FROM sessions WHERE location = 'sejong' ORDER BY start_time ASC");
    $stmt->execute();
    $sejongSessions = $stmt->fetchAll();
    
    // Group sessions by date
    $seoulByDate = [];
    foreach ($seoulSessions as $session) {
        $date = date('Y-m-d', strtotime($session['start_time']));
        $seoulByDate[$date][] = $session;
    }
    
    $sejongByDate = [];
    foreach ($sejongSessions as $session) {
        $date = date('Y-m-d', strtotime($session['start_time']));
        $sejongByDate[$date][] = $session;
    }
    
} catch (Exception $e) {
    logError("Failed to fetch program data: " . $e->getMessage());
    $seoulSessions = [];
    $sejongSessions = [];
    $seoulByDate = [];
    $sejongByDate = [];
}

require_once '/var/www/src/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title mb-3">전체 프로그램</h1>
                <p class="page-subtitle lead">EPM CONGRESS 2025의 모든 세션을 한눈에 확인하세요</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item"><a href="<?php echo url(); ?>" class="text-white-50">홈</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">프로그램</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Program Navigation -->
<section class="program-nav py-4 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul class="nav nav-pills justify-content-center program-nav-pills" id="programTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="pill" data-bs-target="#all" 
                                type="button" role="tab" aria-controls="all" aria-selected="true">
                            <i class="fas fa-calendar-alt me-2"></i>전체 프로그램
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="seoul-tab" data-bs-toggle="pill" data-bs-target="#seoul" 
                                type="button" role="tab" aria-controls="seoul" aria-selected="false">
                            <i class="fas fa-map-marker-alt me-2"></i>서울 행사
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="sejong-tab" data-bs-toggle="pill" data-bs-target="#sejong" 
                                type="button" role="tab" aria-controls="sejong" aria-selected="false">
                            <i class="fas fa-map-marker-alt me-2"></i>세종 행사
                        </button>
                    </li>
        </div>
    </div>
</section>

<!-- Program Content -->
<section class="program-content py-5">
    <div class="container">
        <div class="tab-content" id="programTabContent">
            
            <!-- All Programs Tab -->
            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                <div class="program-overview mb-5">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <div class="overview-card">
                                <div class="card-header">
                                    <h4><i class="fas fa-map-marker-alt text-primary me-2"></i>서울 행사</h4>
                                </div>
                                <div class="card-body">
                                    <div class="event-detail">
                                        <strong>일시:</strong> 2025년 6월 13일(금) 09:00-18:00
                                    </div>
                                    <div class="event-detail">
                                        <strong>장소:</strong> 서울대학교 39동 대강당 외
                                    </div>
                                    <div class="event-detail">
                                        <strong>세션 수:</strong> <?php echo count($seoulSessions); ?>개
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <div class="overview-card">
                                <div class="card-header">
                                    <h4><i class="fas fa-map-marker-alt text-primary me-2"></i>세종 행사</h4>
                                </div>
                                <div class="card-body">
                                    <div class="event-detail">
                                        <strong>일시:</strong> 2025년 6월 17일(화) 13:00-17:30
                                    </div>
                                    <div class="event-detail">
                                        <strong>장소:</strong> 세종공동캐퍼스 8동 대강당
                                    </div>
                                    <div class="event-detail">
                                        <strong>세션 수:</strong> <?php echo count($sejongSessions); ?>개
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Combined Timeline -->
                <div class="program-timeline">
                    <?php if (!empty($seoulByDate) || !empty($sejongByDate)): ?>
                        <?php
                        // Combine all dates and sort
                        $allDates = array_unique(array_merge(array_keys($seoulByDate), array_keys($sejongByDate)));
                        sort($allDates);
                        ?>
                        
                        <?php foreach ($allDates as $date): ?>
                            <div class="timeline-day mb-5">
                                <div class="day-header">
                                    <h3 class="day-title">
                                        <?php echo date('Y년 n월 j일 (l)', strtotime($date)); ?>
                                    </h3>
                                </div>
                                
                                <div class="row">
                                    <?php if (isset($seoulByDate[$date])): ?>
                                        <div class="col-lg-6">
                                            <h5 class="location-title text-primary">
                                                <i class="fas fa-map-marker-alt me-2"></i>서울
                                            </h5>
                                            <?php foreach ($seoulByDate[$date] as $session): ?>
                                                <?php include '/var/www/src/includes/session-card.php'; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if (isset($sejongByDate[$date])): ?>
                                        <div class="col-lg-6">
                                            <h5 class="location-title text-primary">
                                                <i class="fas fa-map-marker-alt me-2"></i>세종
                                            </h5>
                                            <?php foreach ($sejongByDate[$date] as $session): ?>
                                                <?php include '/var/www/src/includes/session-card.php'; ?>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">프로그램 정보가 곷 업데이트 됩니다.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Seoul Tab -->
            <div class="tab-pane fade" id="seoul" role="tabpanel" aria-labelledby="seoul-tab">
                <div class="location-header mb-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="location-title">서울 행사</h2>
                            <div class="location-info">
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <span>2025년 6월 13일(금) 09:00-18:00</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span>서울대학교 39동 대강당 외</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <span>대면 200명 + 온라인 200명</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <a href="<?php echo url('seoul.php'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-info-circle me-2"></i>상세 정보
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="sessions-grid">
                    <?php if (!empty($seoulSessions)): ?>
                        <?php foreach ($seoulSessions as $session): ?>
                            <div class="session-card-detailed mb-4">
                                <div class="session-header">
                                    <div class="session-time">
                                        <i class="fas fa-clock me-2"></i>
                                        <?php echo date('H:i', strtotime($session['start_time'])); ?> - 
                                        <?php echo date('H:i', strtotime($session['end_time'])); ?>
                                    </div>
                                    <div class="session-type badge bg-primary">
                                        <?php echo ensureUTF8(safeOutput($session['session_type'])); ?>
                                    </div>
                                </div>
                                <div class="session-content">
                                    <h4 class="session-title">
                                        <?php echo ensureUTF8(safeOutput($session['title'])); ?>
                                    </h4>
                                    <p class="session-description">
                                        <?php echo ensureUTF8(safeOutput($session['description'])); ?>
                                    </p>
                                    <?php if (!empty($session['speaker'])): ?>
                                        <div class="session-speaker">
                                            <i class="fas fa-user me-2"></i>
                                            <strong>연사:</strong> <?php echo ensureUTF8(safeOutput($session['speaker'])); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($session['room'])): ?>
                                        <div class="session-room">
                                            <i class="fas fa-door-open me-2"></i>
                                            <strong>장소:</strong> <?php echo ensureUTF8(safeOutput($session['room'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">서울 행사 프로그램이 곷 업데이트 됩니다.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Sejong Tab -->
            <div class="tab-pane fade" id="sejong" role="tabpanel" aria-labelledby="sejong-tab">
                <div class="location-header mb-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h2 class="location-title">세종 행사</h2>
                            <div class="location-info">
                                <div class="info-item">
                                    <i class="fas fa-calendar-alt text-primary me-2"></i>
                                    <span>2025년 6월 17일(화) 13:00-17:30</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <span>세종공동캐퍼스 8동 대강당</span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-users text-primary me-2"></i>
                                    <span>대면 100명 + 온라인 100명</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 text-end">
                            <a href="<?php echo url('sejong.php'); ?>" class="btn btn-outline-primary">
                                <i class="fas fa-info-circle me-2"></i>상세 정보
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="sessions-grid">
                    <?php if (!empty($sejongSessions)): ?>
                        <?php foreach ($sejongSessions as $session): ?>
                            <div class="session-card-detailed mb-4">
                                <div class="session-header">
                                    <div class="session-time">
                                        <i class="fas fa-clock me-2"></i>
                                        <?php echo date('H:i', strtotime($session['start_time'])); ?> - 
                                        <?php echo date('H:i', strtotime($session['end_time'])); ?>
                                    </div>
                                    <div class="session-type badge bg-primary">
                                        <?php echo ensureUTF8(safeOutput($session['session_type'])); ?>
                                    </div>
                                </div>
                                <div class="session-content">
                                    <h4 class="session-title">
                                        <?php echo ensureUTF8(safeOutput($session['title'])); ?>
                                    </h4>
                                    <p class="session-description">
                                        <?php echo ensureUTF8(safeOutput($session['description'])); ?>
                                    </p>
                                    <?php if (!empty($session['speaker'])): ?>
                                        <div class="session-speaker">
                                            <i class="fas fa-user me-2"></i>
                                            <strong>연사:</strong> <?php echo ensureUTF8(safeOutput($session['speaker'])); ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($session['room'])): ?>
                                        <div class="session-room">
                                            <i class="fas fa-door-open me-2"></i>
                                            <strong>장소:</strong> <?php echo ensureUTF8(safeOutput($session['room'])); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <p class="text-muted">세종 행사 프로그램이 곷 업데이트 됩니다.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="cta py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title">프로그램에 참여하세요</h2>
                <p class="cta-subtitle mb-4">
                    EPM CONGRESS 2025의 모든 세션에 참여하여 최신 프로젝트 관리 트렌드를 
                    경험하고 전문가들과 네트워킹할 수 있습니다.
                </p>
                <div class="cta-buttons">
                    <a href="<?php echo url('registration.php'); ?>" class="btn btn-light btn-lg me-3">
                        <i class="fas fa-user-plus me-2"></i>참가 신청
                    </a>
                    <a href="<?php echo url('guide.php'); ?>" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-info-circle me-2"></i>참가 안내
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once '/var/www/src/includes/footer.php'; ?>
