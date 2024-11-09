# PHP 日本語マニュアル　翻訳用リポジトリ

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP Version](https://img.shields.io/badge/PHP-%3E%3D8.3-8892BF.svg)

## 概要

- 日本語マニュアルの翻訳に必要なリポジトリや、ビルドなどを行うための Makefile を用意しています。
- ローカルに PHP をインストールして使用してください。
  - PHP 8.3.13 (cli)

## セットアップ

```bash
make setup
```

セットアップを行うことで、以下のようなディレクトリ構成になります。

```
.
├── Makefile            # プロジェクトのビルド・実行用のMakefile
├── doc-base            # ドキュメントベースの設定ファイル
├── en                  # 英語版のドキュメント
├── ja                  # 日本語版のドキュメント
├── output              # 生成物が格納されるディレクトリ
└── phd                 # ドキュメントビルドツール
```

## ビルド

```bash
make build
make xhtml
```

## ローカルで確認

```bash
make open
```

## 参考

https://doc.php.net/guide/local-setup.md
