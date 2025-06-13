# EPM CONGRESS 2025 홍보 웹사이트

## 프로젝트 개요

제14회 엔지니어링 프로젝트 매니지먼트(EPM) 콩그레스 2025 "Megaproject: Above and Beyond" 홍보 웹사이트입니다.

### 행사 정보
- **주제**: Megaproject: Above and Beyond
- **일정**: 
  - 서울: 2025년 6월 13일(금) 09:00~18:00
  - 세종: 2025년 6월 17일(화) 13:00~17:30
- **장소**: 
  - 서울대학교 39동 대강당
  - 세종공동캠퍼스 8동 대강당

## 기술 스택

### 백엔드
- **PHP 8.4**: 서버사이드 로직
- **MySQL 8.0**: 데이터베이스
- **Apache 2.4**: 웹서버

### 프론트엔드
- **HTML5/CSS3**: 반응형 웹 디자인
- **Bootstrap 5**: UI 프레임워크  
- **JavaScript (ES6+)**: 인터랙티브 기능
- **jQuery**: DOM 조작

### 개발 환경
- **Docker**: 로컬 개발 환경
- **Git**: 버전 관리

## 주요 기능

- ✅ **반응형 웹 디자인**: 모바일, 태블릿, 데스크톱 완벽 대응
- ✅ **참가자 등록 시스템**: 온라인/오프라인 참가 선택
- ✅ **프로그램 관리**: 세션별 상세 정보 제공
- ✅ **실시간 카운트다운**: 행사까지 남은 시간 표시
- ✅ **관리자 시스템**: CMS 기능 제공
- ✅ **보안 기능**: CSRF, XSS 방지
- ✅ **한글 완벽 지원**: UTF-8 인코딩

## 로컬 개발 환경 실행

```bash
# 도커 컨테이너 시작
docker-compose up -d

# 웹사이트 접속
http://localhost:8081

# 데이터베이스 초기화 (최초 실행시)
http://localhost:8081/init-db.php
```

## 배포

### 개발 서버 정보
- **URL**: https://magic7.dothome.co.kr
- **서버**: Apache 2.4 + PHP 8.4 + MySQL 8.0

### 자동 배포
```bash
# 자동 배포 스크립트 실행
./deployment/deploy_improved.sh

# 또는 대화형 배포
./quick_deploy.sh
```

## 프로젝트 구조

```
/
├── src/                    # 소스 코드
│   ├── public/            # 웹 루트
│   ├── includes/          # 공통 컴포넌트
│   └── config/            # 설정 파일
├── docker/                # Docker 설정
├── deployment/            # 배포 스크립트
├── docs/                  # 문서
└── README.md
```

## 주요 페이지

- **메인 페이지** (`/`): 행사 개요 및 하이라이트
- **행사 소개** (`/about.php`): 상세 행사 정보
- **프로그램** (`/program.php`): 세션별 일정표
- **참가 신청** (`/registration.php`): 온라인 등록 시스템
- **공지사항** (`/news.php`): 최신 소식
- **연락처** (`/contact.php`): 문의 정보

## 데이터베이스 구조

### 주요 테이블
- **sessions**: 세션 정보 (10개 세션)
- **participants**: 참가자 정보
- **announcements**: 공지사항
- **admin_users**: 관리자 계정

## 보안 기능

- ✅ **CSRF 토큰 검증**
- ✅ **XSS 방지** (입출력 이스케이프)
- ✅ **SQL 인젝션 방지** (PDO 사용)
- ✅ **민감정보 보호** (.env 파일 분리)

## 성능 최적화

- ✅ **이미지 최적화**
- ✅ **CSS/JS 압축**
- ✅ **브라우저 캐싱**
- ✅ **모바일 최적화**

## 브라우저 호환성

- ✅ Chrome (최신)
- ✅ Firefox (최신)  
- ✅ Safari (최신)
- ✅ Edge (최신)

## 라이센스

MIT License

## 개발자

- **개발**: edumagiceco
- **문의**: GitHub Issues

## 버전 히스토리

### v1.0.0 (2025-06-13)
- 초기 버전 완성
- 모든 핵심 기능 구현
- 배포 시스템 구축
- 한글 인코딩 문제 해결