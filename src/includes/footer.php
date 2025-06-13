    </main>
    
    <!-- Footer -->
    <footer class="footer bg-dark text-light pt-5 pb-3">
        <div class="container">
            <div class="row">
                <!-- Event Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title">EPM CONGRESS 2025</h5>
                    <p class="mb-3">제14회 엔지니어링 프로젝트 매니지먼트 콩그레스</p>
                    <p class="mb-2"><strong>주제:</strong> Megaproject: Above and Beyond</p>
                    <p class="mb-2"><strong>일정:</strong></p>
                    <ul class="list-unstyled ms-3">
                        <li>서울: 2025년 6월 13일(금)</li>
                        <li>세종: 2025년 6월 17일(화)</li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title">연락처</h5>
                    <div class="contact-info">
                        <p class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:info@epmcongress.com" class="text-light">info@epmcongress.com</a>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <a href="tel:02-880-7055" class="text-light">02-880-7055</a>
                        </p>
                        <p class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            서울특별시 관악구 관악로 1<br>
                            <span class="ms-4">서울대학교 공과대학 EPM</span>
                        </p>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <h5 class="footer-title">바로가기</h5>
                    <div class="row">
                        <div class="col-6">
                            <ul class="list-unstyled footer-links">
                                <li><a href="<?php echo url('about.php'); ?>">행사소개</a></li>
                                <li><a href="<?php echo url('program.php'); ?>">프로그램</a></li>
                                <li><a href="<?php echo url('speakers.php'); ?>">연사진</a></li>
                                <li><a href="<?php echo url('registration.php'); ?>">참가신청</a></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul class="list-unstyled footer-links">
                                <li><a href="<?php echo url('guide.php'); ?>">참가안내</a></li>
                                <li><a href="<?php echo url('news.php'); ?>">공지사항</a></li>
                                <li><a href="<?php echo url('resources.php'); ?>">자료실</a></li>
                                <li><a href="<?php echo url('contact.php'); ?>">연락처</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="social-media mt-3">
                        <h6>소셜미디어</h6>
                        <div class="social-links">
                            <a href="#" class="social-link" aria-label="페이스북"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-link" aria-label="트위터"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link" aria-label="링크드인"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#" class="social-link" aria-label="인스타그램"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sponsors -->
            <div class="row mt-4 pt-4 border-top border-secondary">
                <div class="col-12">
                    <h6 class="text-center mb-3">주최 및 후원</h6>
                    <div class="sponsors d-flex flex-wrap justify-content-center align-items-center">
                        <div class="sponsor-item mx-3 mb-2">
                            <span class="text-light">서울대학교 공과대학 EPM</span>
                        </div>
                        <div class="sponsor-item mx-3 mb-2">
                            <span class="text-light">공학전문대학원</span>
                        </div>
                        <div class="sponsor-item mx-3 mb-2">
                            <span class="text-light">산업통상자원부</span>
                        </div>
                        <div class="sponsor-item mx-3 mb-2">
                            <span class="text-light">한국산업기술진흥원</span>
                        </div>
                        <div class="sponsor-item mx-3 mb-2">
                            <span class="text-light">HKCMC</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="row mt-4 pt-3 border-top border-secondary">
                <div class="col-md-6">
                    <p class="copyright mb-0">
                        &copy; <?php echo date('Y'); ?> EPM CONGRESS 2025. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">
                        <a href="<?php echo url('privacy.php'); ?>" class="text-light me-3">개인정보처리방침</a>
                        <a href="<?php echo url('terms.php'); ?>" class="text-light">이용약관</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button class="btn-back-to-top" id="backToTop" aria-label="맨 위로 가기">
        <i class="fas fa-chevron-up"></i>
    </button>
    
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="<?php echo asset('js/common.js'); ?>"></script>
    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?php echo asset('js/' . $js); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Google Maps API -->
    <?php if (GOOGLE_MAPS_API_KEY && (basename($_SERVER['PHP_SELF']) == 'guide.php' || basename($_SERVER['PHP_SELF']) == 'venue.php')): ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_MAPS_API_KEY; ?>&callback=initMap&libraries=places" async defer></script>
    <?php endif; ?>
    
    <!-- Page specific scripts -->
    <?php if (isset($pageScript)): ?>
        <script><?php echo $pageScript; ?></script>
    <?php endif; ?>
    
</body>
</html>
