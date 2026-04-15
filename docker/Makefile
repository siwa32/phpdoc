COMPOSE_CMD = docker compose --file compose.yml

## ---------------------------------------
## Help
## ---------------------------------------
.DEFAULT_GOAL := help
.PHONY: help
help: ## ヘルプを表示
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' Makefile | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}'

## ---------------------------------------
## Initial setup
## ---------------------------------------
init: ## 初期セットアップ（初回のみ実行）
	[ -d "../output/php-chunked-xhtml" ] || mkdir -p ../output/php-chunked-xhtml
	$(COMPOSE_CMD) build
	$(COMPOSE_CMD) up -d --wait
	$(COMPOSE_CMD) exec php make setup

## ---------------------------------------
## Docker composer management
## ---------------------------------------
.PHONY: up down reup start stop restart build
up: ## [Docker] コンテナ起動
	$(COMPOSE_CMD) up -d
down: ## [Docker] コンテナ停止・削除
	$(COMPOSE_CMD) down
reup: down up ## [Docker] コンテナ再起動（削除 & 起動）
start: ## [Docker] コンテナ開始
	$(COMPOSE_CMD) start
stop: ## [Docker] コンテナ停止
	$(COMPOSE_CMD) stop
restart: stop start ## [Docker] コンテナ再起動（停止 & 開始）
build: ## [Docker] イメージビルド
	$(COMPOSE_CMD) build

## ---------------------------------------
## Docker composer informational
## ---------------------------------------
.PHONY: ps
ps: ## [Docker] コンテナの状態を表示
	$(COMPOSE_CMD) ps

## ---------------------------------------
## Docker container console
## ---------------------------------------
.PHONY: php
php: ## phpコンテナにログイン
	$(COMPOSE_CMD) exec php sh
