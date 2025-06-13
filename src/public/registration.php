<?php
require_once '/var/www/src/config/config.php';

$pageTitle = '참가신청';
$pageDescription = 'EPM CONGRESS 2025 참가신청 - 지금 바로 등록하여 최고의 프로젝트 관리 전문가들과 함께하세요';
$bodyClass = 'registration-page';
$additionalCSS = ['registration.css'];
$additionalJS = ['registration.js'];

// Handle registration form submission
$formSubmitted = false;
$formSuccess = false;
$formErrors = [];
$registrationId = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_registration'])) {
    $formSubmitted = true;
    
    // Validate CSRF token
    if (!validateCSRFToken($_POST['csrf_token'] ?? '')) {
        $formErrors[] = '보안 토큰이 유효하지 않습니다.';
    } else {
        // Validate form data
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $organization = trim($_POST['organization'] ?? '');
        $position = trim($_POST['position'] ?? '');
        $participationType = $_POST['participation_type'] ?? '';
        $eventLocation = $_POST['event_location'] ?? '';
        $selectedSessions = $_POST['sessions'] ?? [];
        $specialRequests = trim($_POST['special_requests'] ?? '');
        
        // Validation
        if (empty($name)) {
            $formErrors[] = '이름을 입력해주세요.';
        }
        
        if (empty($email)) {
            $formErrors[] = '이메일을 입력해주세요.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $formErrors[] = '올바른 이메일 주소를 입력해주세요.';
        }
        
        if (empty($phone)) {
            $formErrors[] = '연락처를 입력해주세요.';
        }
        
        if (empty($organization)) {
            $formErrors[] = '소속기관을 입력해주세요.';
        }
        
        if (empty($participationType)) {
            $formErrors[] = '참가 형태를 선택해주세요.';
        }
        
        if (empty($eventLocation)) {
            $formErrors[] = '참가 행사를 선택해주세요.';
        }
        
        // If no errors, process registration
        if (empty($formErrors)) {
            try {
                $db = getDB();
                
                // Check if email already exists
                $stmt = $db->prepare("SELECT id FROM participants WHERE email = ?");
                $stmt->execute([$email]);
                if ($stmt->fetch()) {
                    $formErrors[] = '이미 등록된 이메일 주소입니다.';
                } else {
                    // Insert participant
                    $stmt = $db->prepare("
                        INSERT INTO participants (name, email, phone, organization, position, participation_type, event_location, sessions, special_requests, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())
                    ");
                    
                    $sessionsJson = json_encode($selectedSessions);
                    $stmt->execute([$name, $email, $phone, $organization, $position, $participationType, $eventLocation, $sessionsJson, $specialRequests]);
                    
                    $registrationId = $db->lastInsertId();
                    $formSuccess = true;
                    
                    // Update session participant counts
                    if (!empty($selectedSessions)) {
                        foreach ($selectedSessions as $sessionId) {
                            $stmt = $db->prepare("UPDATE sessions SET current_participants = current_participants + 1 WHERE id = ?");
                            $stmt->execute([$sessionId]);
                        }
                    }
                    
                    // Log successful registration
                    logInfo("New registration: $name ($email) - ID: $registrationId");
                }
                
            } catch (Exception $e) {
                $formErrors[] = '등록 처리 중 오류가 발생했습니다. 잠시 후 다시 시도해주세요.';
                logError("Registration error: " . $e->getMessage());
            }
        }
    }
}

// Get available sessions for the form
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
    
} catch (Exception $e) {
    logError("Failed to fetch sessions for registration: " . $e->getMessage());
    $seoulSessions = [];
    $sejongSessions = [];
}

require_once '/var/www/src/includes/header.php';
?>

<!-- Page Header -->
<section class="page-header bg-primary text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="page-title mb-3">참가신청</h1>
                <p class="page-subtitle lead">EPM CONGRESS 2025에 참가하여 메가프로젝트의 미래를 함께 만들어가세요</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item"><a href="<?php echo url(); ?>" class="text-white-50">홈</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">참가신청</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Registration Process -->
<section class="registration-process py-5 bg-light">
    <div class="container">
        <div class="row mb-5">
            <div class="col-12 text-center">
                <h2 class="section-title">참가신청 절차</h2>
                <p class="section-subtitle">간단한 3단계로 참가신청을 완료하세요</p>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h4>정보 입력</h4>
                    <p>개인정보와 소속기관 정보를 입력하세요</p>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h4>세션 선택</h4>
                    <p>참가를 원하는 세션과 행사를 선택하세요</p>
                </div>
            </div>
            
            <div class="col-lg-4 mb-4">
                <div class="process-step text-center">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h4>등록 완료</h4>
                    <p>확인 이메일을 받고 참가준비를 완료하세요</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="registration-form py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <?php if ($formSubmitted): ?>
                    <?php if ($formSuccess): ?>
                        <!-- Success Message -->
                        <div class="registration-success text-center">
                            <div class="success-icon mb-4">
                                <i class="fas fa-check-circle fa-5x text-success"></i>
                            </div>
                            <h2 class="success-title mb-3">참가신청이 완료되었습니다!</h2>
                            <p class="success-message mb-4">
                                EPM CONGRESS 2025에 참가신청해주셔서 감사합니다.<br>
                                등록번호: <strong class="text-primary"><?php echo sprintf('EPM2025-%04d', $registrationId); ?></strong>
                            </p>
                            
                            <div class="next-steps bg-light p-4 rounded mb-4">
                                <h4 class="mb-3"><i class="fas fa-list-check me-2"></i>다음 단계</h4>
                                <ul class="next-steps-list">
                                    <li><i class="fas fa-envelope text-primary me-2"></i>등록 확인 이메일을 발송해드렸습니다</li>
                                    <li><i class="fas fa-calendar text-primary me-2"></i>행사 일주일 전 상세 안내를 받으실 예정입니다</li>
                                    <li><i class="fas fa-link text-primary me-2"></i>온라인 참가자는 접속 링크를 이메일로 받으실 예정입니다</li>
                                    <li><i class="fas fa-certificate text-primary me-2"></i>참가 후 공식 인증서를 발급해드립니다</li>
                                </ul>
                            </div>
                            
                            <div class="success-actions">
                                <a href="<?php echo url('program.php'); ?>" class="btn btn-primary btn-lg me-3">
                                    <i class="fas fa-calendar-alt me-2"></i>프로그램 확인하기
                                </a>
                                <a href="<?php echo url(); ?>" class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-home me-2"></i>홈으로 돌아가기
                                </a>
                            </div>
                        </div>
                        
                    <?php else: ?>
                        <!-- Error Message -->
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>참가신청에 실패했습니다</h4>
                            <ul class="mb-0">
                                <?php foreach ($formErrors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if (!$formSuccess): ?>
                    <!-- Registration Form -->
                    <div class="registration-form-container">
                        <div class="form-header text-center mb-5">
                            <h2 class="section-title">참가신청서</h2>
                            <p class="section-subtitle">
                                아래 정보를 정확히 입력해주세요. <span class="text-danger">*</span> 표시는 필수 항목입니다.
                            </p>
                        </div>
                        
                        <form method="POST" id="registrationForm" novalidate>
                            <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                            
                            <!-- Personal Information -->
                            <div class="form-section mb-5">
                                <h4 class="form-section-title">
                                    <i class="fas fa-user me-2"></i>개인정보
                                </h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">이름 <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                                        <div class="invalid-feedback">이름을 입력해주세요.</div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">이메일 <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" 
                                               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                                        <div class="invalid-feedback">올바른 이메일 주소를 입력해주세요.</div>
                                        <div class="form-text">행사 관련 안내를 받을 이메일 주소입니다.</div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="phone" class="form-label">연락처 <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" 
                                               value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>" 
                                               placeholder="010-1234-5678" required>
                                        <div class="invalid-feedback">연락처를 입력해주세요.</div>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="position" class="form-label">직책/직위</label>
                                        <input type="text" class="form-control" id="position" name="position" 
                                               value="<?php echo htmlspecialchars($_POST['position'] ?? ''); ?>" 
                                               placeholder="예: 프로젝트 매니저, 연구원, 학생 등">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="organization" class="form-label">소속기관 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="organization" name="organization" 
                                           value="<?php echo htmlspecialchars($_POST['organization'] ?? ''); ?>" 
                                           placeholder="예: 서울대학교, 삼성전자, 현대건설 등" required>
                                    <div class="invalid-feedback">소속기관을 입력해주세요.</div>
                                </div>
                            </div>
                            
                            <!-- Participation Type -->
                            <div class="form-section mb-5">
                                <h4 class="form-section-title">
                                    <i class="fas fa-laptop me-2"></i>참가 형태 <span class="text-danger">*</span>
                                </h4>
                                
                                <div class="participation-options">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-check participation-option">
                                                <input class="form-check-input" type="radio" name="participation_type" 
                                                       id="offline" value="offline" 
                                                       <?php echo ($_POST['participation_type'] ?? '') === 'offline' ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="offline">
                                                    <div class="option-header">
                                                        <i class="fas fa-users fa-2x mb-2"></i>
                                                        <h5>대면 참가</h5>
                                                    </div>
                                                    <p class="option-description">
                                                        행사장에서 직접 참여<br>
                                                        <small class="text-muted">네트워킹 및 현장 상호작용 가능</small>
                                                    </p>
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6 mb-3">
                                            <div class="form-check participation-option">
                                                <input class="form-check-input" type="radio" name="participation_type" 
                                                       id="online" value="online" 
                                                       <?php echo ($_POST['participation_type'] ?? '') === 'online' ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="online">
                                                    <div class="option-header">
                                                        <i class="fas fa-video fa-2x mb-2"></i>
                                                        <h5>온라인 참가</h5>
                                                    </div>
                                                    <p class="option-description">
                                                        실시간 스트리밍으로 참여<br>
                                                        <small class="text-muted">Q&A 세션 참여 가능</small>
                                                    </p>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Event Location -->
                            <div class="form-section mb-5">
                                <h4 class="form-section-title">
                                    <i class="fas fa-map-marker-alt me-2"></i>참가 행사 <span class="text-danger">*</span>
                                </h4>
                                
                                <div class="event-options">
                                    <div class="row">
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check event-option">
                                                <input class="form-check-input" type="radio" name="event_location" 
                                                       id="seoul" value="seoul" 
                                                       <?php echo ($_POST['event_location'] ?? '') === 'seoul' ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="seoul">
                                                    <h5>서울 행사</h5>
                                                    <div class="event-details">
                                                        <div class="event-date">6월 13일(금)</div>
                                                        <div class="event-time">09:00-18:00</div>
                                                        <div class="event-venue">서울대학교 39동</div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check event-option">
                                                <input class="form-check-input" type="radio" name="event_location" 
                                                       id="sejong" value="sejong" 
                                                       <?php echo ($_POST['event_location'] ?? '') === 'sejong' ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="sejong">
                                                    <h5>세종 행사</h5>
                                                    <div class="event-details">
                                                        <div class="event-date">6월 17일(화)</div>
                                                        <div class="event-time">13:00-17:30</div>
                                                        <div class="event-venue">세종공동캐퍼스 8동</div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-check event-option">
                                                <input class="form-check-input" type="radio" name="event_location" 
                                                       id="both" value="both" 
                                                       <?php echo ($_POST['event_location'] ?? '') === 'both' ? 'checked' : ''; ?> required>
                                                <label class="form-check-label" for="both">
                                                    <h5>양쪽 모두</h5>
                                                    <div class="event-details">
                                                        <div class="event-date">6/13 + 6/17</div>
                                                        <div class="event-time">전체 일정</div>
                                                        <div class="event-venue">서울 + 세종</div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Session Selection -->
                            <div class="form-section">
                                <h4 class="form-section-title">
                                    <i class="fas fa-list-check me-2"></i>참가 희망 세션 선택
                                </h4>
                                <div class="form-section-content">
                                    <p class="text-muted mb-3">참가하고 싶은 세션을 선택해주세요. (복수 선택 가능)</p>
                                    
                                    <div class="session-selection">
                                        <?php if (!empty($seoulSessions)): ?>
                                        <div class="session-group mb-4">
                                            <h5 class="session-group-title">서울 행사 (6월 13일)</h5>
                                            <div class="row">
                                                <?php foreach ($seoulSessions as $session): ?>
                                                <div class="col-12 mb-3">
                                                    <div class="form-check session-check">
                                                        <input class="form-check-input" type="checkbox" name="sessions[]" 
                                                               value="<?php echo $session['id']; ?>" id="session_<?php echo $session['id']; ?>">
                                                        <label class="form-check-label" for="session_<?php echo $session['id']; ?>">
                                                            <div class="session-info">
                                                                <h6><?php echo safeOutput($session['title']); ?></h6>
                                                                <p class="session-time">
                                                                    <?php echo date('H:i', strtotime($session['start_time'])); ?> - 
                                                                    <?php echo date('H:i', strtotime($session['end_time'])); ?>
                                                                </p>
                                                                <p class="session-speaker"><?php echo safeOutput($session['speaker']); ?></p>
                                                                <?php if ($session['description']): ?>
                                                                <p class="session-description text-muted"><?php echo safeOutput($session['description']); ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if (!empty($sejongSessions)): ?>
                                        <div class="session-group">
                                            <h5 class="session-group-title">세종 행사 (6월 17일)</h5>
                                            <div class="row">
                                                <?php foreach ($sejongSessions as $session): ?>
                                                <div class="col-12 mb-3">
                                                    <div class="form-check session-check">
                                                        <input class="form-check-input" type="checkbox" name="sessions[]" 
                                                               value="<?php echo $session['id']; ?>" id="session_<?php echo $session['id']; ?>">
                                                        <label class="form-check-label" for="session_<?php echo $session['id']; ?>">
                                                            <div class="session-info">
                                                                <h6><?php echo safeOutput($session['title']); ?></h6>
                                                                <p class="session-time">
                                                                    <?php echo date('H:i', strtotime($session['start_time'])); ?> - 
                                                                    <?php echo date('H:i', strtotime($session['end_time'])); ?>
                                                                </p>
                                                                <p class="session-speaker"><?php echo safeOutput($session['speaker']); ?></p>
                                                                <?php if ($session['description']): ?>
                                                                <p class="session-description text-muted"><?php echo safeOutput($session['description']); ?></p>
                                                                <?php endif; ?>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Special Requests -->
                            <div class="form-section">
                                <h4 class="form-section-title">
                                    <i class="fas fa-comment-dots me-2"></i>특별 요청사항
                                </h4>
                                <div class="form-section-content">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="special_requests" rows="4" 
                                                  placeholder="특별한 요청사항이나 문의사항이 있으시면 작성해주세요. (예: 식단 제한, 접근성 요구사항 등)"><?php echo safeOutput($_POST['special_requests'] ?? ''); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Privacy Policy Agreement -->
                            <div class="form-section">
                                <h4 class="form-section-title">
                                    <i class="fas fa-shield-alt me-2"></i>개인정보 처리방침 동의
                                </h4>
                                <div class="form-section-content">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="privacy_agreement" 
                                               id="privacy_agreement" required>
                                        <label class="form-check-label" for="privacy_agreement">
                                            개인정보 수집 및 이용에 동의합니다. 
                                            <a href="#" class="text-primary" data-bs-toggle="modal" data-bs-target="#privacyModal">
                                                (자세히 보기)
                                            </a>
                                        </label>
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="marketing_agreement" 
                                               id="marketing_agreement">
                                        <label class="form-check-label" for="marketing_agreement">
                                            마케팅 목적의 개인정보 이용에 동의합니다. (선택사항)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="form-actions text-center">
                                <button type="submit" name="submit_registration" class="btn btn-primary btn-lg">
                                    <i class="fas fa-paper-plane me-2"></i>참가 신청하기
                                </button>
                                <p class="text-muted mt-3">
                                    <small>
                                        <i class="fas fa-info-circle me-1"></i>
                                        신청 후 확인 이메일을 보내드립니다. 스팸 메일함도 확인해주세요.
                                    </small>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Privacy Policy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="privacyModalLabel">개인정보 처리방침</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h6>1. 개인정보의 수집 및 이용 목적</h6>
                <p>EPM CONGRESS 2025 참가자 등록 및 행사 운영을 위해 개인정보를 수집합니다.</p>
                
                <h6>2. 수집하는 개인정보 항목</h6>
                <ul>
                    <li>이름, 이메일, 연락처, 소속기관, 직책</li>
                    <li>참가 유형, 참가 세션 정보</li>
                </ul>
                
                <h6>3. 개인정보의 보유 및 이용기간</h6>
                <p>행사 종료 후 1년간 보관하며, 이후 안전하게 파기됩니다.</p>
                
                <h6>4. 개인정보 제공 거부 권리</h6>
                <p>개인정보 제공을 거부할 수 있으나, 이 경우 행사 참가에 제한이 있을 수 있습니다.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>

<?php require_once '/var/www/src/includes/footer.php'; ?>
