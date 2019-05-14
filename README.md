# 1조 과제용 Repository
[![Build Status](https://www.computelabo.com/repos/github/status/running.svg)](https://phpreport.azurewebsites.net)

## Report(title : 이미지 업로드)
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
#### mysql report Database 생성(5.X 버전)
```bash
create database report;
quit;
```
#### mysql report Database 생성(8 버전 이상)
```bash
alter user 'root'@'localhost' identified with mysql_native_password by 비밀번호;
create database report;
quit;
```
#### app_key 생성 및 로컬 호스트 시작
```bash
php artisan key:generate
php artisan serve
```
## 4. 사용한 라이브러리
### 1. Laravel Framework 5.8.16 => https://laravel.com/
### 2. Bootstrap with SB Admin templete => https://github.com/BlackrockDigital/startbootstrap-sb-admin-2
### 3. FancyBox 1.3.4 => http://fancybox.net/

