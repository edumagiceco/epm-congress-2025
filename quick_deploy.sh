#!/bin/bash

# EPM CONGRESS 2025 - 간단 배포 스크립트
# 사용법: ./quick_deploy.sh
# 주의: 실행 전 설정 확인 필수

echo "🚀 EPM CONGRESS 2025 간단 배포"
echo "================================"

# 현재 디렉토리 확인
if [ ! -f "docker-compose.yml" ]; then
    echo "❌ 프로젝트 루트 디렉토리에서 실행해주세요"
    exit 1
fi

# 배포 전 확인
echo "📋 배포 전 체크리스트:"
echo "1. 로컬 테스트 완료됨 (http://localhost:8081)"
echo "2. 데이터베이스 백업 완료됨"
echo "3. FTP 접속 정보 확인됨"
echo ""

read -p "모든 준비가 완료되었습니까? (y/N): " confirm
if [[ $confirm != [yY] ]]; then
    echo "❌ 배포 취소됨"
    exit 0
fi

echo ""
echo "🔄 배포 방법을 선택하세요:"
echo "1. 자동 배포 (추천)"
echo "2. 수동 배포 가이드 보기"
echo "3. 데이터베이스만 배포"
echo ""

read -p "선택 (1-3): " choice

case $choice in
    1)
        echo "🚀 자동 배포 시작..."
        if [ -f "deployment/deploy_improved.sh" ]; then
            chmod +x deployment/deploy_improved.sh
            ./deployment/deploy_improved.sh
        else
            echo "❌ 배포 스크립트를 찾을 수 없습니다"
            exit 1
        fi
        ;;
    2)
        echo "📖 수동 배포 가이드를 확인하세요:"
        echo "deployment/manual_deploy_guide.md"
        if command -v open >/dev/null 2>&1; then
            open deployment/manual_deploy_guide.md
        fi
        ;;
    3)
        echo "🗄️ 데이터베이스 배포 시작..."
        echo "MySQL 명령어:"
        echo "mysql -h 112.175.185.144 -u magic7 -p magic7 < deployment/deploy_database.sql"
        echo ""
        read -p "지금 실행하시겠습니까? (y/N): " db_confirm
        if [[ $db_confirm == [yY] ]]; then
            mysql -h 112.175.185.144 -u magic7 -p magic7 < deployment/deploy_database.sql
            echo "✅ 데이터베이스 배포 완료"
        fi
        ;;
    *)
        echo "❌ 잘못된 선택입니다"
        exit 1
        ;;
esac

echo ""
echo "🌐 배포 완료 후 확인 사항:"
echo "• 사이트 접속: https://magic7.dothome.co.kr"
echo "• 관리자: https://magic7.dothome.co.kr/admin/"
echo "• 등록 테스트: https://magic7.dothome.co.kr/registration.php"
echo ""
echo "📱 모바일에서도 확인해보세요!"
