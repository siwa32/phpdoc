PHD_REPO=https://github.com/php/phd.git
DOC_BASE_REPO=https://github.com/php/doc-base.git
DOC_EN_REPO=https://github.com/php/doc-en.git
DOC_JA_REPO=https://github.com/php/doc-ja.git
OUTPUT_DIR=output/php-chunked-xhtml

setup:
	@if [ ! -d "phd" ]; then \
		echo "Cloning phd..."; \
		git clone $(PHD_REPO); \
	else \
		echo "phd already cloned."; \
	fi
	@if [ ! -d "doc-base" ]; then \
		echo "Cloning doc-base..."; \
		git clone $(DOC_BASE_REPO); \
	else \
		echo "doc-base already cloned."; \
	fi
	@if [ ! -d "en" ]; then \
		echo "Cloning doc-en..."; \
		git clone $(DOC_EN_REPO) en; \
	else \
		echo "doc-en already cloned."; \
	fi
	@if [ ! -d "ja" ]; then \
		echo "Cloning doc-ja..."; \
		git clone $(DOC_JA_REPO) ja; \
	else \
		echo "doc-ja already cloned."; \
	fi

build:
	php doc-base/configure.php --with-lang=ja

xhtml:
	php phd/render.php --docbook doc-base/.manual.xml --package PHP --format xhtml

open:
	@if [ -f output/php-chunked-xhtml/index.html ]; then \
		open output/php-chunked-xhtml/index.html; \
	else \
		echo "Output file not found: output/php-chunked-xhtml/index.html"; \
	fi

open-modified:
	@PATHS=$$(php bin/getModifiedFilePath.php); \
	if [ -n "$$PATHS" ]; then \
		echo "Opening: $$PATHS"; \
		open $$PATHS || echo "Failed to open the file(s)."; \
	else \
		echo "Modified file not found."; \
	fi
