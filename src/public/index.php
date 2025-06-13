<?php
require_once '/var/www/src/config/config.php';

$pageTitle = '홈';
$pageDescription = '제14회 엔지니어링 프로젝트 매니지먼트 콩그레스 2025 - Megaproject: Above and Beyond';
$bodyClass = 'home-page';
$additionalCSS = ['home.css'];
$additionalJS = ['home.js', 'countdown.js'];

// Get featured sessions
try {
    $db = getDB();
    $stmt = $db->query("SELECT * FROM sessions WHERE is_featured = 1 ORDER BY start_time ASC LIMIT 6");
    $featuredSessions = $stmt->fetchAll();
    
    // Get latest announcements
    $stmt = $db->query("SELECT * FROM announcements WHERE is_published = 1 ORDER BY is_pinned DESC, published_at DESC LIMIT 3");
    $announcements = $stmt->fetchAll();
    
} catch (Exception $e) {
    logError("Failed to fetch homepage data: " . $e->getMessage());
    $featuredSessions = [];
    $announcements = [];
}

require_once '/var/www/src/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10">
                    <div class="hero-content">
                        <h1 class="hero-title animate-fade-in">
                            <span class="subtitle">제14회</span>
                            <span class="main-title">EPM CONGRESS 2025</span>
                        </h1>
                        <p class="hero-subtitle animate-fade-in-delay-1">
                            엔지니어링 프로젝트 매니지먼트 콩그레스
                        </p>
                        <h2 class="hero-theme animate-fade-in-delay-2">
                            Megaproject: Above and Beyond
                        </h2>
                        
                        <div class="hero-info animate-fade-in-delay-3">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="event-info-card">
                                        <div class="event-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>서울</span>
                                        </div>
                                        <div class="event-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>2025년 6월 13일(금)</span>
                                        </div>
                                        <div class="event-venue">
                                            <i class="fas fa-building"></i>
                                            <span>서울대학교 39동 대강당</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="event-info-card">
                                        <div class="event-location">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>세종</span>
                                        </div>
                                        <div class="event-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            <span>2025년 6월 17일(화)</span>
                                        </div>
                                        <div class="event-venue">
                                            <i class="fas fa-building"></i>
                                            <span>세종공동캐퍼스 8동 대강당</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="hero-actions animate-fade-in-delay-4">
                            <a href="<?php echo url('registration.php'); ?>" class="btn btn-primary btn-lg btn-register">
                                <i class="fas fa-user-plus me-2"></i>참가 신청하기
                            </a>
                            <a href="<?php echo url('program.php'); ?>" class="btn btn-outline-light btn-lg ms-3">
                                <i class="fas fa-calendar-check me-2"></i>프로그램 보기
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Countdown Section -->
<section class="countdown-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h3 class="countdown-title mb-4">행사까지 남은 시간</h3>
                <div class="countdown-timer" id="countdown">
                    <div class="countdown-item">
                        <span class="countdown-number" id="days">00</span>
                        <span class="countdown-label">일</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="hours">00</span>
                        <span class="countdown-label">시간</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="minutes">00</span>
                        <span class="countdown-label">분</span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-number" id="seconds">00</span>
                        <span class="countdown-label">초</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="about-content">
                    <h2 class="section-title">EPM CONGRESS 2025</h2>
                    <h3 class="section-subtitle text-primary">Megaproject: Above and Beyond</h3>
                    <p class="lead">
                        제14회 엔지니어링 프로젝트 매니지먼트 콩그레스는 대규모 프로젝트의 성공적 수행을 위한 
                        전문가들의 지식과 경험을 공유하는 최고의 플랫폼입니다.
                    </p>
                    <p>
                        서울대학교와 세종캐퍼스에서 개최되는 이번 행사는 국내외 전문가들의 특별강연, 
                        워크샵, 컸퍼런스를 통해 메가프로젝트 관리의 새로운 지평을 제시합니다.
                    </p>
                    <div class="about-stats mt-4">
                        <div class="row">
                            <div class="col-4 text-center">
                                <div class="stat-number h3 text-primary mb-0">400+</div>
                                <div class="stat-label">참가자</div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="stat-number h3 text-primary mb-0">20+</div>
                                <div class="stat-label">세션</div>
                            </div>
                            <div class="col-4 text-center">
                                <div class="stat-number h3 text-primary mb-0">15+</div>
                                <div class="stat-label">연사진</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-image">
                    <img src="<?php echo url('assets/images/epm-congress-main.jpg'); ?>" 
                         alt="EPM CONGRESS 2025" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Sessions Section -->
<section class="featured-sessions-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">주요 프로그램</h2>
                <p class="section-description">EPM CONGRESS 2025의 핵심 세션들을 미리 만나보세요</p>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($featuredSessions)): ?>
                <?php foreach ($featuredSessions as $session): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="session-card h-100" data-session-id="<?php echo $session['id']; ?>">
                            <div class="session-header">
                                <div class="session-type session-type-<?php echo strtolower($session['session_type']); ?>">
                                    <?php echo htmlspecialchars($session['session_type']); ?>
                                </div>
                                <div class="session-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo $session['location'] === 'seoul' ? '서울' : '세종'; ?>
                                </div>
                            </div>
                            <div class="session-content">
                                <h4 class="session-title"><?php echo ensureUTF8(safeOutput($session['title'])); ?></h4>
                                <p class="session-description">
                                    <?php echo ensureUTF8(safeOutput(mb_substr($session['description'], 0, 100, 'UTF-8'))); ?>...
                                </p>
                                <?php if (!empty($session['speaker'])): ?>
                                    <div class="session-speaker">
                                        <i class="fas fa-user me-2"></i>
                                        <?php echo ensureUTF8(safeOutput($session['speaker'])); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="session-time">
                                    <i class="fas fa-clock me-2"></i>
                                    <?php echo date('n월 j일 H:i', strtotime($session['start_time'])); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">주요 프로그램 정보가 곷 업데이트 됩니다.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="<?php echo url('program.php'); ?>" class="btn btn-outline-primary btn-lg">
                    <i class="fas fa-calendar-check me-2"></i>전체 프로그램 보기
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Announcements Section -->
<section class="announcements-section py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">공지사항</h2>
                <p class="section-description">최신 행사 소식을 확인하세요</p>
            </div>
        </div>
        <div class="row">
            <?php if (!empty($announcements)): ?>
                <?php foreach ($announcements as $announcement): ?>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="announcement-card h-100" data-announcement-id="<?php echo $announcement['id']; ?>">
                            <?php if ($announcement['is_pinned']): ?>
                                <div class="announcement-pin">
                                    <i class="fas fa-thumbtack"></i>
                                </div>
                            <?php endif; ?>
                            <div class="announcement-content">
                                <h4 class="announcement-title"><?php echo ensureUTF8(safeOutput($announcement['title'])); ?></h4>
                                <p class="announcement-excerpt">
                                    <?php echo ensureUTF8(safeOutput(mb_substr(strip_tags($announcement['content']), 0, 120, 'UTF-8'))); ?>...
                                </p>
                                <div class="announcement-date">
                                    <i class="fas fa-calendar me-2"></i>
                                    <?php echo date('Y년 n월 j일', strtotime($announcement['published_at'])); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <p class="text-muted">공지사항이 곷 업데이트 됩니다.</p>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="<?php echo url('news.php'); ?>" class="btn btn-outline-primary">
                    <i class="fas fa-bell me-2"></i>전체 공지사항 보기
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="cta-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <h2 class="cta-title mb-4">지금 참가 신청하세요!</h2>
                <p class="cta-description mb-4">
                    EPM CONGRESS 2025에서 메가프로젝트 관리의 미래를 함께 논의하고 
                    전문가들과 네트워킹할 수 있는 기회를 놓치지 마세요.
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

<!-- Initialize Countdown Timer -->
<script>
$(document).ready(function() {
    // 세종 행사 날짜: 2025년 6월 17일 13:00 (서울 행사 후 다음 세션)
    var eventDate = new Date('2025-06-17T13:00:00+09:00');
    
    // 카운트다운 초기화
    if (typeof window.initCountdown === 'function') {
        window.initCountdown(eventDate, '#countdown');
        
        // 카운트다운 완료 시 메시지 변경
        $(document).on('countdown:finished', function() {
            setTimeout(function() {
                $('.countdown-message h4').html('🎉 EPM CONGRESS 2025 모든 일정이 완료되었습니다! 🎉');
            }, 1000);
        });
    }
});
</script>

<?php require_once '/var/www/src/includes/footer.php'; ?>
