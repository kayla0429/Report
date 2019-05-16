# 1조 이미지 업로드
#### 이미지 업로드라는 주제로 Laravel 프레임워크와 기타 오픈 소스를 활용하여 웹을 MVC모델로 구축하였습니다. 실질적인 발표는 웹 호스팅으로 간편하게 진행하며 관심이 있으신 분은 아래 로컬 호스팅 테스트 방법과 미리 .env.example 파일을 구현해 놨으며 mysql과 composer와 php만 설치하면 바로 로컬 테스트가 가능하도록 구현 해놓았습니다. 참고로 php는 7.2.18 버전으로 제작 및 테스트를 진행 하였으며 php_fileinfo와 php_pdo_mysql 확장 라이브러리를 사용합니다.
[![Build Status](https://www.computelabo.com/repos/github/status/running.svg)](https://phpreport.azurewebsites.net)

## 1. Url
#### 테스트 페이지 => https://phptestweb123.azurewebsites.net
#### 발표용 페이지 => https://phpreport.azurewebsites.net

## 2. 1조 조원
#### 1. 정윤석
#### 2. 홍인수
#### 3. 윤혁
#### 4. 서정민
#### 5. 전사빈
#### 6. 황승찬

## 3. 로컬 실행
#### composer로 나머지 조각 다운로드 https://getcomposer.org/
```bash
composer update
```
#### .env 설정
```bash
copy .env.example .env
notepad .env

DB_PASSWORD=비밀번호 -> 비밀번호를 각자 db root 비밀번호로
```
#### mysql report Database 생성 및 migration(5.X 버전)
```bash
create database report;
quit;
php artisan migrate
```
#### mysql report Database 생성 및 migration(8 버전 이상)
```bash
alter user 'root'@'localhost' identified with mysql_native_password by 비밀번호;
create database report;
quit;
php artisan migrate
```
#### php 설정
```bash
다음 라이브러리 추가
extension=php_fileinfo.dll
extension=php_pdo_mysql.dll
```
#### app_key 생성 및 로컬 호스트 시작
```bash
php artisan key:generate
php artisan serve
```
## 4. 사용한 라이브러리
### 1. Laravel Framework 5.8.16 => https://laravel.com/
### 2. SB Admin templete with BootStrap => https://github.com/BlackrockDigital/startbootstrap-sb-admin-2
### 3. FancyBox 1.3.4 => http://fancybox.net/

